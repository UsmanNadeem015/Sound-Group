<!DOCTYPE html>
<html lang="en" data-theme="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Music - Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/daisyui@4.4.19/dist/full.min.css" rel="stylesheet" type="text/css" />
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Outfit:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/admindash.css') }}">
</head>
<body>
    <!-- Animated Background -->
    <div class="animated-bg"></div>

    <!-- Content Wrapper -->
    <div class="content-wrapper">
        <!-- Navigation Component -->
        <x-navbar />

        <!-- Page Header -->
        <section class="page-header">
            <div class="container mx-auto px-4">
                <h1 class="page-title display-font mb-2">EDIT MUSIC</h1>
                <p class="text-xl text-gray-300">Edit "{{ $music->title }}"</p>
                <div class="mt-4">
                    <a href="{{ route('admin.viewmusic') }}" class="btn btn-sm btn-outline border-purple-500 text-purple-400 hover:bg-purple-500 hover:text-white">
                        ← Back to Music List
                    </a>
                </div>
            </div>
        </section>

        <!-- Edit Form -->
        <section class="py-8">
            <div class="container mx-auto px-4">
                <div class="section-card max-w-4xl mx-auto">
                    <h2 class="section-title display-font mb-6">Edit Music Details</h2>
                    
                    <!-- Success Message -->
                    @if (session('success'))
                        <div class="alert alert-success mb-6 bg-green-500/20 border border-green-500 text-green-400 p-4 rounded-lg">
                            ✓ {{ session('success') }}
                        </div>
                    @endif

                    <form action="{{ route('admin.updatemusic', $music->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <!-- Current Thumbnail Preview -->
                        <div class="mb-6">
                            <label class="block text-gray-300 mb-2">Current Thumbnail:</label>
                            @if($music->cover_image)
                                <img src="{{ asset('storage/' . $music->cover_image) }}" alt="{{ $music->title }}" class="w-48 h-48 object-cover rounded-lg mb-4">
                            @else
                                <div class="w-48 h-48 bg-gray-800 rounded-lg flex items-center justify-center mb-4">
                                    <span class="text-gray-500">No thumbnail</span>
                                </div>
                            @endif
                        </div>

                        <div class="grid md:grid-cols-2 gap-6">
                            <!-- Thumbnail -->
                            <div class="form-group">
                                <label class="form-label">Update Thumbnail</label>
                                <input type="file" name="thumbnail" class="file-input file-input-bordered w-full" accept="image/*">
                                <p class="text-sm text-gray-400 mt-1">Leave empty to keep current</p>
                            </div>

                            <!-- Music File -->
                            <div class="form-group">
                                <label class="form-label">Update Music File</label>
                                <input type="file" name="musicFile" class="file-input file-input-bordered w-full" accept="audio/*">
                                <p class="text-sm text-gray-400 mt-1">Leave empty to keep current</p>
                                <p class="text-sm text-gray-400">Current: {{ basename($music->file_path) }}</p>
                            </div>

                            <!-- Music Name -->
                            <div class="form-group">
                                <label class="form-label">Music Name *</label>
                                <input type="text" name="musicName" class="input input-bordered w-full" value="{{ old('musicName', $music->title) }}" required>
                            </div>

                            <!-- Artist -->
                            <div class="form-group">
                                <label class="form-label">Artist *</label>
                                <input type="text" name="artist" class="input input-bordered w-full" value="{{ old('artist', $music->artist) }}" required>
                            </div>

                            <!-- Album -->
                            <div class="form-group">
                                <label class="form-label">Album *</label>
                                <input type="text" name="album" class="input input-bordered w-full" value="{{ old('album', $music->album) }}" required>
                            </div>

                            <!-- Year -->
                            <div class="form-group">
                                <label class="form-label">Year *</label>
                                <input type="number" name="year" class="input input-bordered w-full" value="{{ old('year', $music->year) }}" required min="1900" max="{{ date('Y') + 1 }}">
                            </div>

                            <!-- Genre -->
                            <div class="form-group">
                                <label class="form-label">Genre *</label>
                                <input type="text" name="genre" class="input input-bordered w-full" value="{{ old('genre', $music->genre) }}" required>
                            </div>

                            <!-- Language -->
                            <div class="form-group">
                                <label class="form-label">Language *</label>
                                <input type="text" name="language" class="input input-bordered w-full" value="{{ old('language', $music->language) }}" required>
                            </div>
                        </div>

                        <!-- Description -->
                        <div class="form-group mt-6">
                            <label class="form-label">Description</label>
                            <textarea name="description" class="textarea textarea-bordered w-full" rows="4">{{ old('description', $music->description) }}</textarea>
                        </div>

                        <!-- Form Actions -->
                        <div class="flex gap-4 mt-8">
                            <button type="submit" class="btn btn-gradient text-white flex-1">
                                Update Music
                            </button>
                            <a href="{{ route('admin.viewmusic') }}" class="btn btn-outline border-gray-600 text-gray-400 hover:bg-gray-700 hover:text-white">
                                Cancel
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </section>

        <!-- Footer start -->
        <x-footer />
        <!-- Footer end -->
    </div>
</body>
</html>