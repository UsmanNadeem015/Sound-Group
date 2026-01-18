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

                    <form action="{{ route('admin.storecategory') }}" method="POST">
                        @csrf

                        <!-- Category Name -->
                        <div class="form-group mb-6">
                            <label class="form-label">Category Name *</label>
                            <input type="text" name="name" class="input input-bordered w-full" 
                                   value="{{ old('name') }}" required placeholder="e.g., Pop, Rock, 2024">
                            <p class="text-sm text-gray-400 mt-1">This will appear in dropdown menus</p>
                        </div>

                        <!-- Category Type -->
                        <div class="form-group mb-6">
                            <label class="form-label">Category Type *</label>
                            <select name="type" class="select select-bordered w-full" required>
                                <option value="" disabled selected>Select a type</option>
                                @foreach($categoryTypes as $type)
                                    <option value="{{ $type }}" {{ old('type') == $type ? 'selected' : '' }}>
                                        {{ ucfirst($type) }}
                                    </option>
                                @endforeach
                            </select>
                            <p class="text-sm text-gray-400 mt-1">
                                <strong>Genre:</strong> Music/Video style (Pop, Rock, Jazz)<br>
                                <strong>Year:</strong> Release year (2024, 2023)<br>
                                <strong>Artist:</strong> Performer name<br>
                                <strong>Album:</strong> Album/Collection name<br>
                                <strong>Language:</strong> Content language
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
</body>
</html>