<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;  // Import base Controller
use App\Models\User;
use App\Models\Music;
use App\Models\Video;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class AdminController extends Controller
{
    /**
     * Show admin dashboard
     */
    public function dashboard()
    {
        $stats = [
            'total_users' => User::count(),
            'total_music' => Music::count(),
            'total_videos' => Video::count(),
            'total_categories' => Category::count(),
        ];

        return view('admindash', compact('stats'));
    }

    /**
     * Show add music form
     */
    public function addMusic()
    {
        $categories = Category::where('is_active', true)->get();
        return view('addmusic', compact('categories'));
    }

/**
 * View all music
 */
public function viewMusic()
{
    $music = Music::with('categories')->latest()->get();
    
    return view('viewmusic', compact('music'));
}




    /**
     * Store new music
     */
public function storeMusic(Request $request)
{
    // Validate
    $validatedData = $request->validate([
        'thumbnail' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
        'musicFile' => 'required|mimes:mp3,wav,ogg|max:51200',
        'musicName' => 'required|string|max:255',
        'artist' => 'required|string|max:255',
        'album' => 'required|string|max:255',
        'year' => 'required|digits:4',
        'genre' => 'required|string',
        'language' => 'required|string',
        'duration' => 'required|string|max:10',
        'description' => 'nullable|string',
    ]);

    // Handle custom genre if selected
    if ($request->genre === 'custom' && $request->has('custom_genre')) {
        $validatedData['genre'] = $request->custom_genre;
        
        // Also auto-create the category in database
        $category = Category::firstOrCreate(
            ['name' => $request->custom_genre, 'type' => 'genre'],
            ['slug' => Str::slug($request->custom_genre), 'is_active' => true]
        );
    }

    // Upload thumbnail
    $thumbnailPath = null;
    if ($request->hasFile('thumbnail')) {
        $thumbnail = $request->file('thumbnail');
        $thumbnailName = time() . '_' . Str::slug($validatedData['musicName']) . '.' . $thumbnail->getClientOriginalExtension();
        $thumbnailPath = $thumbnail->storeAs('images/music', $thumbnailName, 'public');
    }

    // Upload music file
    $musicFile = $request->file('musicFile');
    $musicFileName = time() . '_' . Str::slug($validatedData['musicName']) . '.' . $musicFile->getClientOriginalExtension();
    $musicFilePath = $musicFile->storeAs('music', $musicFileName, 'public');

    // Create music record
    $music = Music::create([
        'title' => $validatedData['musicName'],
        'slug' => Str::slug($validatedData['musicName']),
        'description' => $validatedData['description'] ?? null,
        'artist' => $validatedData['artist'],
        'album' => $validatedData['album'],
        'year' => $validatedData['year'],
        'genre' => $validatedData['genre'],
        'language' => $validatedData['language'],
        'duration' => $validatedData['duration'],
        'file_path' => $musicFilePath,
        'cover_image' => $thumbnailPath,
        'is_new' => true,
        'is_active' => true,
    ]);

    // Attach categories
    $this->attachMusicCategories($music, $validatedData);

    return redirect()->route('admin.dashboard')
        ->with('success', 'Music added successfully!');
}

/**
 * Show edit music form
 */
public function editMusic($id)
{
    $music = Music::findOrFail($id);
    $categories = Category::where('is_active', true)->get();
    
    return view('editmusic', compact('music', 'categories'));
}

/**
 * Update music
 */
public function updateMusic(Request $request, $id)
{
    $music = Music::findOrFail($id);
    
    // Validate
    $validatedData = $request->validate([
        'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
        'musicFile' => 'nullable|mimes:mp3,wav,ogg|max:51200',
        'musicName' => 'required|string|max:255',
        'artist' => 'required|string|max:255',
        'album' => 'required|string|max:255',
        'year' => 'required|digits:4',
        'genre' => 'required|string',
        'language' => 'required|string',
        'duration' => 'required|string|max:10',
        'description' => 'nullable|string',
    ]);

    // Handle custom genre if selected
    if ($request->genre === 'custom' && $request->has('custom_genre')) {
        $validatedData['genre'] = $request->custom_genre;
        
        // Also auto-create the category in database
        $category = Category::firstOrCreate(
            ['name' => $request->custom_genre, 'type' => 'genre'],
            ['slug' => Str::slug($request->custom_genre), 'is_active' => true]
        );
    }

    // Rest of your updateMusic method...
    // ... existing code for updating thumbnail, music file, etc.
    
    $music->update([
        'title' => $validatedData['musicName'],
        'slug' => Str::slug($validatedData['musicName']),
        'description' => $validatedData['description'] ?? null,
        'artist' => $validatedData['artist'],
        'album' => $validatedData['album'],
        'year' => $validatedData['year'],
        'genre' => $validatedData['genre'],
        'language' => $validatedData['language'],
        'duration' => $validatedData['duration'],
    ]);

    // Update categories
    $this->attachMusicCategories($music, $validatedData);

    return redirect()->route('admin.viewmusic')
        ->with('success', 'Music updated successfully!');
}

    /**
     * Show add video form
     */
    public function addVideo()
    {
        $categories = Category::where('is_active', true)->get();
        return view('addvideo', compact('categories'));
    }

    /**
     * Store new video
     */
    public function storeVideo(Request $request)
    {
        // Validate
        $validatedData = $request->validate([
            'thumbnail' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
            'videoFile' => 'required|mimes:mp4,avi,mov,mkv|max:512000',
            'videoName' => 'required|string|max:255',
            'artist' => 'required|string|max:255',
            'album' => 'required|string|max:255',
            'year' => 'required|digits:4',
            'genre' => 'required|string',
            'language' => 'required|string',
            'duration' => 'required|string',
            'description' => 'nullable|string',
        ]);

        // Upload thumbnail
        $thumbnailPath = null;
        if ($request->hasFile('thumbnail')) {
            $thumbnail = $request->file('thumbnail');
            $thumbnailName = time() . '_' . Str::slug($validatedData['videoName']) . '.' . $thumbnail->getClientOriginalExtension();
            $thumbnailPath = $thumbnail->storeAs('images/videos', $thumbnailName, 'public');
        }

        // Upload video file
        $videoFile = $request->file('videoFile');
        $videoFileName = time() . '_' . Str::slug($validatedData['videoName']) . '.' . $videoFile->getClientOriginalExtension();
        $videoFilePath = $videoFile->storeAs('videos', $videoFileName, 'public');

        // Create video record
        $video = Video::create([
            'title' => $validatedData['videoName'],
            'slug' => Str::slug($validatedData['videoName']),
            'description' => $validatedData['description'] ?? null,
            'artist' => $validatedData['artist'],
            'album' => $validatedData['album'],
            'year' => $validatedData['year'],
            'genre' => $validatedData['genre'],
            'language' => $validatedData['language'],
            'duration' => $validatedData['duration'],
            'file_path' => $videoFilePath,
            'thumbnail' => $thumbnailPath,
            'is_new' => true,
            'is_active' => true,
        ]);

        // Attach categories
        $this->attachVideoCategories($video, $validatedData);

        return redirect()->route('admin.dashboard')
            ->with('success', 'Video added successfully!');
    }

    /**
    * View all videos
    */
    public function viewVideos()
    {
        $videos = Video::latest()->get();
        return view('admin.viewvideos', compact('videos'));
    }

    /**
     * Show manage users page
     */
    public function manageUsers()
    {
        $users = User::orderBy('created_at', 'desc')->paginate(15);
        return view('manageusers', compact('users'));
    }

    /**
     * Delete music
     */
    public function deleteMusic($id)
    {
        $music = Music::findOrFail($id);
        
        // Delete files
        if ($music->cover_image) {
            Storage::disk('public')->delete($music->cover_image);
        }
        Storage::disk('public')->delete($music->file_path);
        
        $music->delete();

        return back()->with('success', 'Music deleted successfully!');
    }

    /**
     * Delete video
     */
    public function deleteVideo($id)
    {
        $video = Video::findOrFail($id);
        
        // Delete files
        if ($video->thumbnail) {
            Storage::disk('public')->delete($video->thumbnail);
        }
        Storage::disk('public')->delete($video->file_path);
        
        $video->delete();

        return back()->with('success', 'Video deleted successfully!');
    }

    /**
     * Delete user
     */
    public function deleteUser($id)
    {
        $user = User::findOrFail($id);
        
        // Prevent deleting yourself
        
        $user->delete();

        return back()->with('success', 'User deleted successfully!');
    }

    /**
     * Helper: Attach categories to music
     */
private function attachMusicCategories($music, $data)
{
    $categoryIds = [];

    // Year
    if (isset($data['year'])) {
        $cat = Category::firstOrCreate(
            ['name' => $data['year'], 'type' => 'year'],
            ['slug' => Str::slug($data['year']), 'is_active' => true]
        );
        $categoryIds[] = $cat->id;
    }

    // Artist
    if (isset($data['artist'])) {
        $cat = Category::firstOrCreate(
            ['name' => $data['artist'], 'type' => 'artist'],
            ['slug' => Str::slug($data['artist']), 'is_active' => true]
        );
        $categoryIds[] = $cat->id;
    }

    // Album
    if (isset($data['album'])) {
        $cat = Category::firstOrCreate(
            ['name' => $data['album'], 'type' => 'album'],
            ['slug' => Str::slug($data['album']), 'is_active' => true]
        );
        $categoryIds[] = $cat->id;
    }

    // Genre (this is already handled in storeMusic/updateMusic, but just in case)
    if (isset($data['genre'])) {
        $cat = Category::firstOrCreate(
            ['name' => $data['genre'], 'type' => 'genre'],
            ['slug' => Str::slug($data['genre']), 'is_active' => true]
        );
        $categoryIds[] = $cat->id;
    }

    // Language
    if (isset($data['language'])) {
        $cat = Category::firstOrCreate(
            ['name' => $data['language'], 'type' => 'language'],
            ['slug' => Str::slug($data['language']), 'is_active' => true]
        );
        $categoryIds[] = $cat->id;
    }

    $music->categories()->sync($categoryIds);
}

    /**
     * Helper: Attach categories to video
     */
    private function attachVideoCategories($video, $data)
    {
        $categoryIds = [];

        // Year
        if (isset($data['year'])) {
            $cat = Category::firstOrCreate(
                ['name' => $data['year'], 'type' => 'year'],
                ['slug' => Str::slug($data['year']), 'is_active' => true]
            );
            $categoryIds[] = $cat->id;
        }

        // Artist
        if (isset($data['artist'])) {
            $cat = Category::firstOrCreate(
                ['name' => $data['artist'], 'type' => 'artist'],
                ['slug' => Str::slug($data['artist']), 'is_active' => true]
            );
            $categoryIds[] = $cat->id;
        }

        // Album
        if (isset($data['album'])) {
            $cat = Category::firstOrCreate(
                ['name' => $data['album'], 'type' => 'album'],
                ['slug' => Str::slug($data['album']), 'is_active' => true]
            );
            $categoryIds[] = $cat->id;
        }

        // Genre
        if (isset($data['genre'])) {
            $cat = Category::firstOrCreate(
                ['name' => $data['genre'], 'type' => 'genre'],
                ['slug' => Str::slug($data['genre']), 'is_active' => true]
            );
            $categoryIds[] = $cat->id;
        }

        // Language
        if (isset($data['language'])) {
            $cat = Category::firstOrCreate(
                ['name' => $data['language'], 'type' => 'language'],
                ['slug' => Str::slug($data['language']), 'is_active' => true]
            );
            $categoryIds[] = $cat->id;
        }

        $video->categories()->sync($categoryIds);
    }
     
    /**
 * Show manage categories page
 */
public function manageCategories()
{
    $categories = Category::withCount(['music', 'videos'])
        ->orderBy('created_at', 'desc')
        ->get();
    
    return view('managecategories', compact('categories'));
}

/**
 * Show add category form
 */
public function addCategory()
{
    $categoryTypes = ['genre', 'year', 'artist', 'album', 'language'];
    return view('addcategory', compact('categoryTypes'));
}

/**
 * Store new category
 */
public function storeCategory(Request $request)
{
    $validatedData = $request->validate([
        'name' => 'required|string|max:255|unique:categories,name',
        'type' => 'required|string|in:genre,year,artist,album,language',
        'description' => 'nullable|string',
    ]);

    Category::create([
        'name' => $validatedData['name'],
        'slug' => Str::slug($validatedData['name']),
        'type' => $validatedData['type'],
        'description' => $validatedData['description'] ?? null,
        'is_active' => true,
    ]);

    return redirect()->route('admin.managecategories')
        ->with('success', 'Category added successfully!');
}

/**
 * Delete category
 */
public function deleteCategory($id)
{
    $category = Category::findOrFail($id);
    
    // Detach from all music and videos first
    $category->music()->detach();
    $category->videos()->detach();
    
    $category->delete();

    return back()->with('success', 'Category deleted successfully!');
}




}

