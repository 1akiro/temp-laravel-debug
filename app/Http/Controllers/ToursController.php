<?php
namespace App\Http\Controllers;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\Tour;
use App\Models\User;
use App\Models\TourView;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use ZipArchive;
use Illuminate\Routing\Controller;

class ToursController extends Controller
{
    public function __construct(){
        $this->middleware('auth')->except(['index', 'show']);
    }


    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tours = Tour::all();
        return view('tours.index', compact('tours'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('tours.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'company_name' => 'nullable|max:255',
            'description' => 'nullable|string',
            'thumbnail' => 'required|image|max:2048',
            'zip' => 'required|file|mimes:zip|max:500240',
        ]);

        $slug = Str::slug($request->title);

        $thumb_url = null;
        if ($request->hasFile('thumbnail')) {

            $thumb_url = $request->file('thumbnail')->store("/thumbnail/{$slug}", 'public');
        }

        $zip = new ZipArchive;
        $zip_file = $request->file('zip');
        $zip_path = $zip_file->getRealPath();
        $extract_path = storage_path("app/public/tours/{$slug}");
        // $files = scandir($extract_path);
        // dd($files); // Should list contents like index
        if ($zip->open($zip_path) === true) {
            $zip->extractTo($extract_path);
            $zip->close();
        } else {
            return response()->json(['error' => 'Failed to extract zip file'], 500);
        }

        $tour_url = "tours/{$slug}/index.htm";

        // Save record
        Tour::create([
            'title' => $request->title,
            'description' => $request->description,
            'company_name' => $request->company_name,
            'slug' => $slug,
            'thumbnail' => $thumb_url,
            'tour_url' => $tour_url,
            'user_id' => Auth::id(),
        ]);
        return redirect()->route('tour.index')->with('success', 'Tour uploaded.');
    }


    /**
     * Display the specified resource.
     */
    public function show(Request $request, string $id)
    {
        $tour = Tour::with('user')->findOrFail($id);

        TourView::create([
            'tour_id' => $tour->id,
            'user_id' => Auth::check() ? Auth::id() : null,
            'ip_address' => $request->ip(),
            'user_agent' => $request->userAgent(),
            'viewed_at' => now(),
        ]);
        return view('tours.show', compact('tour'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $tour = Tour::findOrFail($id);
        return view('tours.edit', compact('tour'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Tour $tour)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'company_name' => 'nullable|max:255',
            'description' => 'nullable|string',
            'thumbnail' => 'nullable|image|max:2048',
            'zip' => 'nullable|file|mimes:zip|max:500240',
        ]);

        // maina 'slug', ja virsraksts maināss
        if ($request->has('title') && $request->title !== $tour->title) {
            $old_slug = $tour->slug;
            $new_slug = Str::slug($request->title);

            // atjaunina glabāšanas ceļu

            $storage_path = "public/tours/{$old_slug}";
            $new_storage_path = "public/tours/{$new_slug}";

            if (Storage::exists($storage_path)) {
                Storage::move($storage_path, $new_storage_path);
            }

            // Atjaunina sīktēla faila ceļu
            if ($tour->thumbnail) {
                $new_thumbnail = str_replace("thumbnail/{$old_slug}", "thumbnail/{$new_slug}", $tour->thumbnail);
                $old_thumbnail_path = "public/" . $tour->thumbnail;
                $new_thumbnail_path = "public/" . $new_thumbnail;

                if (Storage::exists($old_thumbnail_path)) {
                    Storage::move($old_thumbnail_path, $new_thumbnail_path);
                }

                $tour->thumbnail = $new_thumbnail;
            }

            $tour->slug = $new_slug;
            $tour->tour_url = "tours/{$new_slug}/index.htm";
        }

        // atjaunina sīktēlu
        if ($request->hasFile('thumbnail')) {
            if ($tour->thumbnail) {
                Storage::delete('public/' . $tour->thumbnail);
            }
            $thumbnail_path = $request->file('thumbnail')->store("thumbnail/{$tour->slug}", "public");
            $tour->thumbnail = $thumbnail_path;
        }

        // atjaunina zip failu
        if ($request->hasFile('zip')) {
            Storage::deleteDirectory("public/tours/{$tour->slug}");

            $zip = new ZipArchive;
            $zip_path = $request->file('zip')->getRealPath();
            $extract_path = storage_path("app/public/tours/{$tour->slug}");

            if ($zip->open($zip_path) === true) {
                $zip->extractTo($extract_path);
                $zip->close();
            } else {
                return back()->withErrors(['zip' => 'Failed to extract zip file']);
            }
        }

        // Atjaunina pārējos laukus
        $tour->title = $request->title;
        $tour->description = $request->description;
        $tour->company_name = $request->company_name;
        $tour->save();

        return redirect()->route('tour.index')->with('success', 'Tour updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tour $tour)
    {

        Storage::disk('public')->deleteDirectory("tours/{$tour->slug}");
        Storage::disk('public')->deleteDirectory("thumbnail/{$tour->slug}");
        $tour->delete();
        return redirect()->route('tour.index')->with('success', 'Tour deleted successfully');
    }

    public function toggleVisibility(Request $request, Tour $tour)
    {
        $tour->is_active = $request->has('is_active');
        $tour->save();

        return redirect()->route('tour.show', $tour)->with('success', 'Tour visibility updated.');
    }
    public function changeOwner(Request $request, Tour $tour)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email'
        ]);

        $user = User::where('email', $request->email)->firstOrFail();

        $tour->user_id = $user->id;
        $tour->save();

        return response()->json([
            'new_owner' => [
                'name' => $user->name,
                'email' => $user->email,
            ]
        ]);
    }
}
