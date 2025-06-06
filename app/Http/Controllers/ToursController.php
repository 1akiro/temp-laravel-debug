<?php
namespace App\Http\Controllers;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\Tour;
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
            'description' => 'nullable|string',
            'thumbnail' => 'required|image|max:2048',
            'zip' => 'required|file|mimes:zip|max:500240'
        ]);

        $slug = Str::slug($request->title);
        $zip = new ZipArchive;
        $zipPath = $request->file('zip')->getRealPath();
        $extractTo = public_path("tours/{$slug}");

        if (!file_exists($extractTo)) {
            mkdir($extractTo, 0755, true);
        }

        if ($zip->open($zipPath) === true) {
            $firstFile = $zip->getNameIndex(0);
            $topLevelFolder = explode('/', $firstFile)[0] ?? '';

            for ($i = 0; $i < $zip->numFiles; $i++) {
                $entry = $zip->getNameIndex($i);

                if (str_starts_with($entry, $topLevelFolder . '/')) {
                    // Remove top-level folder
                    $relativePath = substr($entry, strlen($topLevelFolder) + 1);
                } else {
                    $relativePath = $entry;
                }

                if (!$relativePath) {
                    continue;
                }

                $fullPath = $extractTo . '/' . $relativePath;

                if (str_ends_with($entry, '/')) {
                    // Directory
                    if (!is_dir($fullPath)) {
                        mkdir($fullPath, 0755, true);
                    }
                } else {
                    // File
                    $dir = dirname($fullPath);
                    if (!is_dir($dir)) {
                        mkdir($dir, 0755, true);
                    }
                    $stream = $zip->getStream($entry);
                    file_put_contents($fullPath, stream_get_contents($stream));
                    fclose($stream);
                }
            }

            $zip->close();
        } else {
            return back()->withErrors(['zip' => 'Unable to open ZIP file.']);
        }

        // Save thumbnail
        $thumbnailUrl = null;
        if ($request->hasFile('thumbnail')) {
            $path = $request->file('thumbnail')->store("tours/{$slug}", 'public');
            $thumbnailUrl = "/storage/{$path}";
        }

        // Save record
        Tour::create([
            'title' => $request->title,
            'description' => $request->description,
            'slug' => $slug,
            'thumbnail' => $thumbnailUrl,
            'tour_url' => "/tours/{$slug}/index.htm",
        ]);
        return redirect()->route('tour.index')->with('success', 'Tour uploaded.');
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $tour = Tour::findOrFail($id);
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
    public function update(Request $request, string $id)
    {
        $tour = Tour::findOrFail($id);
        return redirect()->route('tours.show', $tour>id)->with('success', 'Tour updated
            successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $tour = Tour::findOrFail($id);
        $tour->delete();
        return redirect()->route('tour.index')->with('success', 'Tour deleted successfully');
    }
}
