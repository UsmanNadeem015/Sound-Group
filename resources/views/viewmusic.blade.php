<!DOCTYPE html>
<html lang="en" data-theme="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Music - Admin Dashboard</title>
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
                <h1 class="page-title display-font mb-2">MANAGE MUSIC</h1>
                <p class="text-xl text-gray-300">View and manage all music tracks</p>
                <div class="mt-4">
                    <a href="{{ route('admin.dashboard') }}" class="btn btn-sm btn-outline border-purple-500 text-purple-400 hover:bg-purple-500 hover:text-white">
                        ← Back to Dashboard
                    </a>
                </div>
            </div>
        </section>

        <!-- Music Content -->
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
                        <h2 class="text-2xl font-bold">All Music Tracks</h2>
                        <p class="text-gray-400">Total: {{ $music->count() }} tracks</p>
                    </div>
                    <a href="{{ route('admin.addmusic') }}" class="btn btn-gradient text-white">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10 3a1 1 0 00-1 1v5H4a1 1 0 100 2h5v5a1 1 0 102 0v-5h5a1 1 0 100-2h-5V4a1 1 0 00-1-1z" clip-rule="evenodd" />
                        </svg>
                        Add New Music
                    </a>
                </div>

                <!-- Music Table -->
                <div class="section-card">
                    @if($music->isEmpty())
                        <div class="text-center py-12">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 mx-auto text-gray-500 mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 19V6l12-3v13M9 19c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zm12-3c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zM9 10l12-3" />
                            </svg>
                            <h3 class="text-xl font-bold mb-2">No Music Tracks Found</h3>
                            <p class="text-gray-400 mb-4">Start by adding your first music track</p>
                            <a href="{{ route('admin.addmusic') }}" class="btn btn-gradient text-white">Add Music</a>
                        </div>
                    @else
                        <div class="overflow-x-auto">
<table class="w-full">
    <thead>
        <tr class="border-b border-gray-700">
            <th class="text-left py-3 px-4 text-gray-400 font-semibold">#</th>
            <th class="text-left py-3 px-4 text-gray-400 font-semibold">Title</th>
            <th class="text-left py-3 px-4 text-gray-400 font-semibold">Artist</th>
            <th class="text-left py-3 px-4 text-gray-400 font-semibold">Genre</th> 
            <th class="text-left py-3 px-4 text-gray-400 font-semibold">File</th>
            <th class="text-left py-3 px-4 text-gray-400 font-semibold">Date Added</th>
            <th class="text-left py-3 px-4 text-gray-400 font-semibold">Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach($music as $index => $track)
        <tr class="border-b border-gray-800 hover:bg-white/5 transition-colors">
            <td class="py-3 px-4">{{ $index + 1 }}</td>
            <td class="py-3 px-4 font-semibold">{{ $track->title }}</td>
            <td class="py-3 px-4">{{ $track->artist }}</td>
            <td class="py-3 px-4">
                <span class="text-sm text-gray-400">{{ $track->genre ?? 'N/A' }}</span>
            </td>
            <td class="py-3 px-4">
                <span class="text-sm text-gray-400">{{ pathinfo($track->file_path, PATHINFO_EXTENSION) }}</span>
            </td>
            <td class="py-3 px-4 text-gray-400">{{ $track->created_at->format('M d, Y') }}</td>
            <td class="py-3 px-4">
                <div class="flex gap-2">
                    
                    <!-- Edit Button -->
                    <a href="{{ route('admin.editmusic', $track->id) }}" class="btn btn-sm btn-outline border-blue-500 text-blue-400 hover:bg-blue-500 hover:text-white">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                            <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
                        </svg>
                    </a>
                    
                    <!-- Delete Button -->
                    <form action="{{ route('admin.deletemusic', $track->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this track?')">
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