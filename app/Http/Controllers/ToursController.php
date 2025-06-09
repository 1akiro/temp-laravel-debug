<?php
namespace App\Http\Controllers;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\Tour;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use ZipArchive;

class ToursController extends Controller
{
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
    public function show(string $id)
    {
        $tour = Tour::with('user')->findOrFail($id);
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
            'thumbnail' => 'required|image|max:2048',
            'zip' => 'required|file|mimes:zip|max:500240',
            'is_active' => 'boolean',
        ]);

        if ($request->has('title') && $request->title !== $tour->title) {
            $curr_slug = $tour->slug;
            $slug = Str::slug($request->title);

            if (Storage::exists("tours/{$tour->slug}")) {
                Storage::move("tours/{$tour->slug}", "public/tours/{$slug}");
            }

            $tour->slug = $slug;
            $tour->tour_url = "tours/{$slug}/index.htm";
            if ($tour->thumbnail) {
                $tour->thumbnail = str_replace("tours/{$curr_slug}", "tours/{$slug}", $tour->thumbnail);
            }
        }

        if ($request->hasFile('thumbnail')) {
            if ($tour->thumbnail) {
                Storage::delete($tour->thumbnail);
            }
            $thumbnail_path = $request->file('thumbnail')->store("thumbnail/{$tour->slug}", "public");
            $tour->thumbnail = $thumbnail_path;
        }

        if ($request->hasFile('zip')) {
            Storage::deleteDirectory("tours/{$tour->slug}");

            $zip = new ZipArchive;
            $zip_path = $request->file('zip')->getRealPath();
            $extract_path = storage_path("app/public/tours/{$tour->slug}");

            if ($zip->open($zip_path) === true) {
                $zip->extractTo($extract_path);
                $zip->close();
            } else {
                return response()->json(['error' => 'Failed to extract zip file'], 500);
            }

            $tour->tour_url = "tours/{$tour->slug}/index.htm";
        }

        $tour->update($request->only(['title', 'description', 'company_name', 'is_active']));

        return redirect()->route('tours.index')->with('success', 'Tour uploaded.');
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
}
