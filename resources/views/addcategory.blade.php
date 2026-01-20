<!DOCTYPE html>
<html lang="en" data-theme="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Category - Admin Dashboard</title>
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
                <h1 class="page-title display-font mb-2">ADD NEW CATEGORY</h1>
                <p class="text-xl text-gray-300">Add new genres and categories</p>
                <div class="mt-4">
                    <a href="{{ route('admin.managecategories') }}" class="btn btn-sm btn-outline border-purple-500 text-purple-400 hover:bg-purple-500 hover:text-white">
                        ← Back to Categories
                    </a>
                </div>
            </div>
        </section>

        <!-- Add Category Form -->
        <section class="py-8">
            <div class="container mx-auto px-4">
                <div class="section-card max-w-2xl mx-auto">
                    <h2 class="section-title display-font mb-6">Add New Category</h2>
                    
                    <!-- Success Message -->
                    @if (session('success'))
                        <div class="alert alert-success mb-6 bg-green-500/20 border border-green-500 text-green-400 p-4 rounded-lg">
                            ✓ {{ session('success') }}
                        </div>
                    @endif

                    @if ($errors->any())
                        <div class="alert alert-error mb-6 bg-red-500/20 border border-red-500 text-red-400 p-4 rounded-lg">
                            <ul class="list-disc list-inside">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('admin.storecategory') }}" method="POST" id="categoryForm">
                        @csrf

                        <!-- Category Name (for non-year types) -->
                        <div class="form-group mb-6" id="regularNameContainer">
                            <label class="form-label">Category Name *</label>
                            <input type="text" name="name" id="nameInput" class="input input-bordered w-full" 
                                   value="{{ old('name') }}" placeholder="e.g., Pop, Rock, Hindi">
                            <p class="text-sm text-gray-400 mt-1" id="nameHelpText">This will appear in dropdown menus</p>
                        </div>

                        <!-- Year Selection (hidden by default) -->
                        <div class="form-group mb-6 hidden" id="yearContainer">
                            <label class="form-label">Select Year *</label>
                            <select id="yearSelect" class="select select-bordered w-full">
                                <option value="" disabled selected>Select a year</option>
                                @for ($y = date('Y'); $y >= 1900; $y--)
                                    <option value="{{ $y }}">{{ $y }}</option>
                                @endfor
                            </select>
                            <p class="text-sm text-gray-400 mt-1">Select the year from the dropdown</p>
                        </div>

                        <!-- Category Type -->
                        <div class="form-group mb-6">
                            <label class="form-label">Category Type *</label>
                            <select name="type" id="categoryType" class="select select-bordered w-full" required>
                                <option value="" disabled selected>Select a type</option>
                                <option value="genre" {{ old('type') == 'genre' ? 'selected' : '' }}>Genre</option>
                                <option value="year" {{ old('type') == 'year' ? 'selected' : '' }}>Year</option>
                                <option value="language" {{ old('type') == 'language' ? 'selected' : '' }}>Language</option>
                                <!-- <option value="artist" {{ old('type') == 'artist' ? 'selected' : '' }}>Artist</option> -->
                                <!-- <option value="album" {{ old('type') == 'album' ? 'selected' : '' }}>Album</option> -->
                            </select>
                            <p class="text-sm text-gray-400 mt-1">
                                <strong>Genre:</strong> Music style (Pop, Rock, Jazz)<br>
                                <strong>Year:</strong> Release year (2024, 2023)<br>
                                <strong>Language:</strong> Content language (English, Hindi, Spanish)<br>
                                <!-- <strong>Artist:</strong> Artist/Performer name<br>
                                <strong>Album:</strong> Album/Collection name -->
                            </p>
                        </div>

                        <!-- Description (Optional) -->
                        <div class="form-group mb-8">
                            <label class="form-label">Description (Optional)</label>
                            <textarea name="description" class="textarea textarea-bordered w-full" rows="4" 
                                      placeholder="Optional description for this category">{{ old('description') }}</textarea>
                        </div>

                        <!-- Form Actions -->
                        <div class="flex gap-4">
                            <button type="submit" class="btn btn-gradient text-white flex-1">
                                Add Category
                            </button>
                            <a href="{{ route('admin.managecategories') }}" class="btn btn-outline border-gray-600 text-gray-400 hover:bg-gray-700 hover:text-white">
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
        document.addEventListener('DOMContentLoaded', function() {
            const typeSelect = document.getElementById('categoryType');
            const nameInput = document.getElementById('nameInput');
            const nameHelpText = document.getElementById('nameHelpText');
            const regularNameContainer = document.getElementById('regularNameContainer');
            const yearContainer = document.getElementById('yearContainer');
            const yearSelect = document.getElementById('yearSelect');
            const form = document.getElementById('categoryForm');

            // Handle type change
            typeSelect.addEventListener('change', function() {
                if (this.value === 'year') {
                    // Show year dropdown, hide text input
                    regularNameContainer.classList.add('hidden');
                    yearContainer.classList.remove('hidden');
                    
                    // Clear the name input but set a hidden value
                    nameInput.value = '';
                    nameInput.required = false;
                    yearSelect.required = true;
                    
                    // Set placeholder based on type
                    nameHelpText.textContent = "Select a year from the dropdown above";
                } else {
                    // Show text input, hide year dropdown
                    regularNameContainer.classList.remove('hidden');
                    yearContainer.classList.add('hidden');
                    
                    // Update placeholder based on type
                    nameInput.required = true;
                    yearSelect.required = false;
                    
                    let placeholder = '';
                    let helpText = 'This will appear in dropdown menus';
                    
                    switch(this.value) {
                        case 'genre':
                            placeholder = 'e.g., Pop, Rock, Jazz';
                            helpText = 'Enter a music genre';
                            break;
                        case 'language':
                            placeholder = 'e.g., English, Hindi, Spanish';
                            helpText = 'Enter a language name';
                            break;
                        case 'artist':
                            placeholder = 'e.g., Artist Name, Band Name';
                            helpText = 'Enter artist or performer name';
                            break;
                        case 'album':
                            placeholder = 'e.g., Album Name, Collection Name';
                            helpText = 'Enter album or collection name';
                            break;
                        default:
                            placeholder = 'e.g., Category Name';
                    }
                    
                    nameInput.placeholder = placeholder;
                    nameHelpText.textContent = helpText;
                    
                    // Clear year selection
                    yearSelect.value = '';
                }
            });

            // Handle form submission
            form.addEventListener('submit', function(e) {
                if (typeSelect.value === 'year' && yearSelect.value) {
                    // Copy the selected year value to the name field
                    const hiddenYearInput = document.createElement('input');
                    hiddenYearInput.type = 'hidden';
                    hiddenYearInput.name = 'name';
                    hiddenYearInput.value = yearSelect.value;
                    form.appendChild(hiddenYearInput);
                }
                
                // Ensure name field is required for non-year types
                if (typeSelect.value !== 'year' && !nameInput.value.trim()) {
                    e.preventDefault();
                    alert('Please enter a category name');
                    nameInput.focus();
                }
            });

            // Initialize based on existing value
            if (typeSelect.value === 'year') {
                typeSelect.dispatchEvent(new Event('change'));
                // If there's an old value, select it
                const oldValue = "{{ old('name') }}";
                if (oldValue) {
                    yearSelect.value = oldValue;
                }
            }
        });
    </script>
</body>
</html>
