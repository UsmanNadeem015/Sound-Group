<!DOCTYPE html>
<html lang="en" data-theme="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Music - SOUND GROUP</title>
    <link href="https://cdn.jsdelivr.net/npm/daisyui@4.4.19/dist/full.min.css" rel="stylesheet" type="text/css" />
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Outfit:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/addmusic.css') }}">
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
                <h1 class="page-title display-font mb-4">ADD MUSIC</h1>
                <p class="text-xl text-gray-300">Upload a new music file to the library</p>
            </div>
        </section>

        <!-- Add Music Form -->
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

                    <form method="POST" action="{{ route('admin.storemusic') }}" enctype="multipart/form-data">
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

                        <!-- Music File Upload -->
                        <div class="mb-6">
                            <label class="form-label">
                                Music File <span class="required">*</span>
                            </label>
                            <div class="file-upload" onclick="document.getElementById('musicFile').click()">
                                <input type="file" id="musicFile" name="musicFile" accept="audio/*" required onchange="displayFileName(event)" />
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 mx-auto mb-3 text-purple-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19V6l12-3v13M9 19c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zm12-3c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zM9 10l12-3" />
                                </svg>
                                <p class="text-gray-400" id="fileNameDisplay">Click to upload music file</p>
                                <p class="text-sm text-gray-500 mt-2">MP3, WAV, OGG (Max 50MB)</p>
                            </div>
                        </div>

                        <div class="grid md:grid-cols-2 gap-4">
    <!-- Music Name -->
    <div class="mb-4">
        <label for="musicName" class="form-label">
            Music Name <span class="required">*</span>
        </label>
        <input 
            type="text" 
            id="musicName" 
            name="musicName" 
            class="input form-input w-full @error('musicName') error @enderror" 
            placeholder="Enter music name"
            value="{{ old('musicName') }}"
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
            @foreach(\App\Models\Category::where('type', 'year')->where('is_active', true)->orderBy('name', 'desc')->get() as $yearCategory)
                <option value="{{ $yearCategory->name }}" {{ old('year') == $yearCategory->name ? 'selected' : '' }}>
                    {{ $yearCategory->name }}
                </option>
            @endforeach
            <option value="custom">+ Add New Year</option>
        </select>
        
        <!-- Hidden input for custom year -->
        <div id="customYearContainer" class="hidden mt-2">
            <input type="text" name="custom_year" class="input input-bordered w-full" 
                   placeholder="Enter new year (e.g., 1998)" 
                   pattern="\d{4}" 
                   title="Enter a 4-digit year">
            <p class="text-sm text-gray-400 mt-1">Enter a 4-digit year (e.g., 1998, 2005)</p>
        </div>
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
    <div class="form-group">
        <label class="form-label">Duration *</label>
        <input type="text" name="duration" class="input input-bordered w-full" 
               value="{{ old('duration') }}" required placeholder="3:45">
        <p class="text-sm text-gray-400 mt-1">Format: MM:SS or HH:MM:SS</p>
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
                                placeholder="Enter music description"
                            >{{ old('description') }}</textarea>
                        </div>

                        <!-- Buttons -->
                        <div class="flex gap-4">
                            <button type="submit" class="btn btn-gradient text-white flex-1">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-11a1 1 0 10-2 0v2H7a1 1 0 100 2h2v2a1 1 0 102 0v-2h2a1 1 0 100-2h-2V7z" clip-rule="evenodd" />
                                </svg>
                                Add Music
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

        // Display music file name
        function displayFileName(event) {
            const file = event.target.files[0];
            if (file) {
                document.getElementById('fileNameDisplay').textContent = file.name;
            }
        }

        document.querySelector('select[name="genre"]').addEventListener('change', function() {
    const customContainer = document.getElementById('customGenreContainer');
    if (this.value === 'custom') {
        customContainer.classList.remove('hidden');
    } else {
        customContainer.classList.add('hidden');
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

// Handle custom year selection
const yearSelect = document.querySelector('select[name="year"]');
const customYearContainer = document.getElementById('customYearContainer');

if (yearSelect && customYearContainer) {
    // Check initial value
    if (yearSelect.value === 'custom') {
        customYearContainer.classList.remove('hidden');
    }
    
    // Handle change event
    yearSelect.addEventListener('change', function() {
        if (this.value === 'custom') {
            customYearContainer.classList.remove('hidden');
            // Make custom year field required
            customYearContainer.querySelector('input').required = true;
        } else {
            customYearContainer.classList.add('hidden');
            // Remove required attribute
            customYearContainer.querySelector('input').required = false;
        }
    });
}


    </script>


</body>
</html>