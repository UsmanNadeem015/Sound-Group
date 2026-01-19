<!DOCTYPE html>
<html lang="en" data-theme="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Categories - Admin Dashboard</title>
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
                <h1 class="page-title display-font mb-2">MANAGE CATEGORIES</h1>
                <p class="text-xl text-gray-300">View and manage all categories</p>
                <div class="mt-4">
                    <a href="{{ route('admin.dashboard') }}" class="btn btn-sm btn-outline border-purple-500 text-purple-400 hover:bg-purple-500 hover:text-white">
                        ← Back to Dashboard
                    </a>
                </div>
            </div>
        </section>

        <!-- Categories Content -->
        <section class="py-8">
            <div class="container mx-auto px-4">

                <!-- Success Message -->
                @if (session('success'))
                    <div class="alert alert-success mb-6 bg-green-500/20 border border-green-500 text-green-400 p-4 rounded-lg">
                        ✓ {{ session('success') }}
                    </div>
                @endif

                <!-- Action Bar -->
                <div class="flex justify-between items-center mb-6">
                    <div>
                        <h2 class="text-2xl font-bold">All Categories</h2>
                        <p class="text-gray-400">Total: {{ $categories->count() }} categories</p>
                    </div>
                    <a href="{{ route('admin.addcategory') }}" class="btn btn-gradient text-white">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10 3a1 1 0 00-1 1v5H4a1 1 0 100 2h5v5a1 1 0 102 0v-5h5a1 1 0 100-2h-5V4a1 1 0 00-1-1z" clip-rule="evenodd" />
                        </svg>
                        Add New Category
                    </a>
                </div>

                <!-- Categories Table -->
                <div class="section-card">
                    @if($categories->isEmpty())
                        <div class="text-center py-12">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 mx-auto text-gray-500 mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
                            </svg>
                            <h3 class="text-xl font-bold mb-2">No Categories Found</h3>
                            <p class="text-gray-400 mb-4">Start by adding your first category</p>
                            <a href="{{ route('admin.addcategory') }}" class="btn btn-gradient text-white">Add Category</a>
                        </div>
                    @else
                        <div class="overflow-x-auto">
                            <table class="w-full">
                                <thead>
                                    <tr class="border-b border-gray-700">
                                        <th class="text-left py-3 px-4 text-gray-400 font-semibold">#</th>
                                        <th class="text-left py-3 px-4 text-gray-400 font-semibold">Name</th>
                                        <th class="text-left py-3 px-4 text-gray-400 font-semibold">Type</th>
                                        <!-- <th class="text-left py-3 px-4 text-gray-400 font-semibold">Music Count</th> -->
                                        <!-- <th class="text-left py-3 px-4 text-gray-400 font-semibold">Video Count</th> -->
                                        <th class="text-left py-3 px-4 text-gray-400 font-semibold">Status</th>
                                        <th class="text-left py-3 px-4 text-gray-400 font-semibold">Date Added</th>
                                        <th class="text-left py-3 px-4 text-gray-400 font-semibold">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($categories as $index => $category)
                                    <tr class="border-b border-gray-800 hover:bg-white/5 transition-colors">
                                        <td class="py-3 px-4">{{ $index + 1 }}</td>
                                        <td class="py-3 px-4 font-semibold">{{ $category->name }}</td>
                                        <td class="py-3 px-4">
                                            @php
                                                $typeColors = [
                                                    'genre' => 'bg-purple-500/20 text-purple-300',
                                                    'year' => 'bg-blue-500/20 text-blue-300',
                                                    'artist' => 'bg-pink-500/20 text-pink-300',
                                                    'album' => 'bg-green-500/20 text-green-300',
                                                    'language' => 'bg-yellow-500/20 text-yellow-300',
                                                ];
                                            @endphp
                                            <span class="px-3 py-1 rounded-full text-xs {{ $typeColors[$category->type] ?? 'bg-gray-500/20 text-gray-300' }}">
                                                {{ ucfirst($category->type) }}
                                            </span>
                                        </td>
                                        <!-- <td class="py-3 px-4">
                                            <span class="text-sm text-gray-400">{{ $category->music_count }}</span>
                                        </td> -->
                                        <!-- <td class="py-3 px-4">
                                            <span class="text-sm text-gray-400">{{ $category->videos_count }}</span>
                                        </td> -->
                                        <td class="py-3 px-4">
                                            @if($category->is_active)
                                                <span class="px-3 py-1 rounded-full text-xs bg-green-500/20 text-green-300">Active</span>
                                            @else
                                                <span class="px-3 py-1 rounded-full text-xs bg-red-500/20 text-red-300">Inactive</span>
                                            @endif
                                        </td>
                                        <td class="py-3 px-4 text-gray-400">{{ $category->created_at->format('M d, Y') }}</td>
                                        <td class="py-3 px-4">
                                            <div class="flex gap-2">
                                                <!-- Delete Button -->
                                                <form action="{{ route('admin.deletecategory', $category->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this category?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-outline border-red-500 text-red-400 hover:bg-red-500 hover:text-white">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                                                            <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" />
                                                        </svg>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif
                </div>

            </div>
        </section>

        <!-- Footer start -->
        <x-footer />
        <!-- Footer end -->
    </div>
</body>
</html>