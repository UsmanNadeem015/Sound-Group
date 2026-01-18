<!DOCTYPE html>
<html lang="en" data-theme="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Video - SOUND GROUP</title>
    <link href="https://cdn.jsdelivr.net/npm/daisyui@4.4.19/dist/full.min.css" rel="stylesheet" type="text/css" />
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Outfit:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/addvideo.css') }}">
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
                <h1 class="page-title display-font mb-4">ADD VIDEO</h1>
                <p class="text-xl text-gray-300">Upload a new video file to the library</p>
            </div>
        </section>

        <!-- Add Video Form -->
        <section class="py-8 pb-16">
            <div class="container mx-auto px-4">
                <div class="form-card">
                    
                    <!-- Display Validation Errors -->
                    @if ($errors->any())
                        <div class="alert alert-error mb-6 bg-red-500/20 border border-red-500 text-red-400 p-4 rounded-lg">
                            <strong>Please fix the following errors:</strong>
                            <ul class="mt-2">
                                @foreach ($errors->all() as $error)
                                    <li>• {{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('admin.storevideo') }}" enctype="multipart/form-data">
                        @csrf

                        <!-- Thumbnail Upload -->
                        <div class="mb-6">
                            <label class="form-label">
                                Thumbnail Image <span class="required">*</span>
                            </label>
                            <div class="file-upload" onclick="document.getElementById('thumbnail').click()">
                                <input type="file" id="thumbnail" name="thumbnail" accept="image/*" required onchange="previewThumbnail(event)" />
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 mx-auto mb-3 text-purple-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                                <p class="text-gray-400">Click to upload thumbnail</p>
                                <p class="text-sm text-gray-500 mt-2">PNG, JPG, WEBP (Max 5MB)</p>
                            </div>
                            <img id="thumbnailPreview" class="preview-image" alt="Thumbnail Preview" />
                        </div>

                        <!-- Video File Upload -->
                        <div class="mb-6">
                            <label class="form-label">
                                Video File <span class="required">*</span>
                            </label>
                            <div class="file-upload" onclick="document.getElementById('videoFile').click()">
                                <input type="file" id="videoFile" name="videoFile" accept="video/*" required onchange="displayFileName(event)" />
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 mx-auto mb-3 text-purple-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z" />
                                </svg>
                                <p class="text-gray-400" id="fileNameDisplay">Click to upload video file</p>
                                <p class="text-sm text-gray-500 mt-2">MP4, AVI, MOV, MKV (Max 500MB)</p>
                            </div>
                        </div>

                        <div class="grid md:grid-cols-2 gap-4">
                            <!-- Video Name -->
                            <div class="mb-4">
                                <label for="videoName" class="form-label">
                                    Video Name <span class="required">*</span>
                                </label>
                                <input 
                                    type="text" 
                                    id="videoName" 
                                    name="videoName" 
                                    class="input form-input w-full @error('videoName') error @enderror" 
                                    placeholder="Enter video name"
                                    value="{{ old('videoName') }}"
                                    required
                                />
                            </div>

                            <!-- Artist -->
                            <div class="mb-4">
                                <label for="artist" class="form-label">
                                    Artist <span class="required">*</span>
                                </label>
                                <input 
                                    type="text" 
                                    id="artist" 
                                    name="artist" 
                                    class="input form-input w-full @error('artist') error @enderror" 
                                    placeholder="Enter artist name"
                                    value="{{ old('artist') }}"
                                    required
                                />
                            </div>

                            <!-- Album -->
                            <div class="mb-4">
                                <label for="album" class="form-label">
                                    Album <span class="required">*</span>
                                </label>
                                <input 
                                    type="text" 
                                    id="album" 
                                    name="album" 
                                    class="input form-input w-full @error('album') error @enderror" 
                                    placeholder="Enter album name"
                                    value="{{ old('album') }}"
                                    required
                                />
                            </div>

                            <!-- Year -->
                            <div class="mb-4">
                                <label for="year" class="form-label">
                                    Year <span class="required">*</span>
                                </label>
                                <select id="year" name="year" class="select form-input w-full @error('year') error @enderror" required>
                                    <option value="" disabled selected>Select Year</option>
                                    @for ($y = date('Y'); $y >= 2000; $y--)
                                        <option value="{{ $y }}" {{ old('year') == $y ? 'selected' : '' }}>{{ $y }}</option>
                                    @endfor
                                </select>
                            </div>

<!-- Genre -->
<div class="form-group">
    <label class="form-label">Genre *</label>
    <select name="genre" class="select select-bordered w-full" required>
        <option value="" disabled selected>Select a genre</option>
        @foreach(\App\Models\Category::where('type', 'genre')->where('is_active', true)->orderBy('name')->get() as $genre)
            <option value="{{ $genre->name }}" {{ old('genre') == $genre->name ? 'selected' : '' }}>
                {{ $genre->name }}
            </option>
        @endforeach
        <option value="custom">+ Add New Genre</option>
    </select>
    <!-- Hidden input for custom genre -->
    <div id="customGenreContainer" class="hidden mt-2">
        <input type="text" name="custom_genre" class="input input-bordered w-full" placeholder="Enter new genre name">
    </div>
</div>

<!-- Language -->
<div class="form-group">
    <label class="form-label">Language *</label>
    <select name="language" class="select select-bordered w-full" required>
        <option value="" disabled selected>Select a language</option>
        @foreach(\App\Models\Category::where('type', 'language')->where('is_active', true)->orderBy('name')->get() as $language)
            <option value="{{ $language->name }}" {{ old('language') == $language->name ? 'selected' : '' }}>
                {{ $language->name }}
            </option>
        @endforeach
        <option value="custom">+ Add New Language</option>
    </select>
    <!-- Hidden input for custom language -->
    <div id="customLanguageContainer" class="hidden mt-2">
        <input type="text" name="custom_language" class="input input-bordered w-full" placeholder="Enter new language name">
    </div>
</div>

                            <!-- Duration -->
                            <div class="mb-4">
                                <label for="duration" class="form-label">
                                    Duration <span class="required">*</span>
                                </label>
                                <input 
                                    type="text" 
                                    id="duration" 
                                    name="duration" 
                                    class="input form-input w-full @error('duration') error @enderror" 
                                    placeholder="e.g., 45:32"
                                    value="{{ old('duration') }}"
                                    required
                                />
                            </div>
                        </div>

                        <!-- Description (Optional) -->
                        <div class="mb-6">
                            <label for="description" class="form-label">Description (Optional)</label>
                            <textarea 
                                id="description" 
                                name="description" 
                                class="textarea form-input w-full" 
                                rows="3"
                                placeholder="Enter video description"
                            >{{ old('description') }}</textarea>
                        </div>

                        <!-- Buttons -->
                        <div class="flex gap-4">
                            <button type="submit" class="btn btn-gradient text-white flex-1">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-11a1 1 0 10-2 0v2H7a1 1 0 100 2h2v2a1 1 0 102 0v-2h2a1 1 0 100-2h-2V7z" clip-rule="evenodd" />
                                </svg>
                                Add Video
                            </button>
                            <a href="{{ route('admin.dashboard') }}" class="btn btn-outline flex-1">
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

    <script>
        // Preview thumbnail
        function previewThumbnail(event) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const preview = document.getElementById('thumbnailPreview');
                    preview.src = e.target.result;
                    preview.classList.add('show');
                };
                reader.readAsDataURL(file);
            }
        }

        // Display video file name
        function displayFileName(event) {
            const file = event.target.files[0];
            if (file) {
                document.getElementById('fileNameDisplay').textContent = file.name;
            }
        }
            // Handle custom genre selection for video form
    document.addEventListener('DOMContentLoaded', function() {
        const genreSelect = document.querySelector('select[name="genre"]');
        const customContainer = document.getElementById('customGenreContainer');
        
        if (genreSelect && customContainer) {
            // Check initial value
            if (genreSelect.value === 'custom') {
                customContainer.classList.remove('hidden');
            }
            
            // Handle change event
            genreSelect.addEventListener('change', function() {
                if (this.value === 'custom') {
                    customContainer.classList.remove('hidden');
                } else {
                    customContainer.classList.add('hidden');
                }
            });
        }
    });

    // Handle custom language selection
const languageSelect = document.querySelector('select[name="language"]');
const customLanguageContainer = document.getElementById('customLanguageContainer');

if (languageSelect && customLanguageContainer) {
    // Check initial value
    if (languageSelect.value === 'custom') {
        customLanguageContainer.classList.remove('hidden');
    }
    
    // Handle change event
    languageSelect.addEventListener('change', function() {
        if (this.value === 'custom') {
            customLanguageContainer.classList.remove('hidden');
        } else {
            customLanguageContainer.classList.add('hidden');
        }
    });
}
    </script>


</body>
</html>