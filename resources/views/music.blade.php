<!DOCTYPE html>
<html lang="en" data-theme="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Music Library - SOUND GROUP</title>
    <link href="https://cdn.jsdelivr.net/npm/daisyui@4.4.19/dist/full.min.css" rel="stylesheet" type="text/css" />
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Outfit:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/music.css') }}">

</head>
<body>
<!-- Animated Background -->
    <div class="animated-bg"></div>

<!-- Content Wrapper -->
<div class="content-wrapper">
<!-- Navbar start -->
<x-navbar />
<!-- Navbar start -->

<!-- Page Header start -->
        <section class="page-header">
            <div class="container mx-auto px-4">
                <h1 class="page-title display-font mb-4">MUSIC LIBRARY</h1>
                <p class="text-xl text-gray-300">Discover thousands of songs from your favorite artists</p>
            </div>
        </section>
<!-- Page Header end -->


<!-- Filter and Sort Section start -->
<section class="py-8">
    <div class="container mx-auto px-4">
        <div class="filter-section">
            <!-- Filter by Category -->
            <div class="text-center">
                <h3 class="text-lg font-semibold mb-4">Filter by Category</h3>
                <div class="flex flex-wrap gap-2 justify-center">
                    <a href="{{ route('music') }}" class="filter-btn {{ !request('category') ? 'active' : '' }} px-4 py-2 rounded-full text-sm font-semibold">All</a>
                    <a href="{{ route('music', ['category' => 'album']) }}" class="filter-btn {{ request('category') == 'album' ? 'active' : '' }} px-4 py-2 rounded-full text-sm font-semibold">Album</a>
                    <a href="{{ route('music', ['category' => 'artist']) }}" class="filter-btn {{ request('category') == 'artist' ? 'active' : '' }} px-4 py-2 rounded-full text-sm font-semibold">Artist</a>
                    <a href="{{ route('music', ['category' => 'year']) }}" class="filter-btn {{ request('category') == 'year' ? 'active' : '' }} px-4 py-2 rounded-full text-sm font-semibold">Year</a>
                    <a href="{{ route('music', ['category' => 'genre']) }}" class="filter-btn {{ request('category') == 'genre' ? 'active' : '' }} px-4 py-2 rounded-full text-sm font-semibold">Genre</a>
                    <a href="{{ route('music', ['category' => 'language']) }}" class="filter-btn {{ request('category') == 'language' ? 'active' : '' }} px-4 py-2 rounded-full text-sm font-semibold">Language</a>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Filter and Sort Section end -->

<!-- Music Grid start -->
<section class="container mx-auto px-4 mb-16">
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
        @forelse ($music as $song)
            <div class="media-card rounded-2xl overflow-hidden fade-in">
                <div class="relative">
                    <!-- Fix the cover image path -->
                    @if($song->cover_image && file_exists(public_path('storage/' . $song->cover_image)))
                        <img src="{{ asset('storage/' . $song->cover_image) }}" alt="{{ $song->title }}" class="media-image w-full h-48 object-cover" />
                    @else
                        <!-- Fallback image -->
                        <div class="media-image w-full h-48 bg-gradient-to-br from-purple-900 to-pink-800 flex items-center justify-center">
                            <span class="text-white text-xl">{{ substr($song->title, 0, 1) }}</span>
                        </div>
                    @endif

                    @if ($song->is_new_badge)
                        <span class="new-badge absolute top-3 right-3 px-3 py-1 rounded-full text-xs font-bold text-white bg-gradient-to-r from-purple-600 to-pink-600">NEW</span>
                    @endif
                </div>
                <div class="p-4">
                    <h3 class="font-bold text-lg mb-1 truncate">{{ $song->title }}</h3>
                    <p class="text-gray-400 text-sm mb-2 truncate">by {{ $song->artist }}</p>
                    <p class="text-xs text-gray-400 mb-2">
                        Album: {{ $song->album ?? 'Unknown' }} | 
                        Duration: {{ $song->duration ?? 'N/A' }}
                    </p>
                    <div class="flex items-center justify-between mb-3">
                        <div class="stars text-sm text-yellow-400">
                            {{ str_repeat('★', $song->average_rating) }}{{ str_repeat('☆', 5 - $song->average_rating) }}
                        </div>
                        <span class="text-xs text-gray-500">{{ $song->year ?? 'N/A' }}</span>
                    </div>
                    <div class="flex flex-wrap gap-1 mb-3">
                        @if($song->genre)
                            <span class="badge badge-sm badge-outline border-purple-500 text-purple-400">{{ $song->genre }}</span>
                        @endif
                        @if($song->language)
                            <span class="badge badge-sm badge-outline border-pink-500 text-pink-400">{{ $song->language }}</span>
                        @endif
                    </div>
                    <button class="btn btn-gradient btn-sm w-full text-white hover:scale-105 transition-transform">
                        ▶ Play Now
                    </button>
                </div>
            </div>
        @empty
            <div class="col-span-full text-center py-12">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 mx-auto text-gray-600 mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 19V6l12-3v13M9 19c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zm12-3c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zM9 10l12-3" />
                </svg>
                <p class="text-xl text-gray-400 mb-2">No music available right now.</p>
                <p class="text-gray-500">Check back later or add some music from the admin panel.</p>
            </div>
        @endforelse
    </div>
</section>
<!-- Music Grid end -->

<!-- Footer start -->
    <x-footer />    
<!-- Footer end -->

</div>

    <script>
        // Filter button interactivity
        document.querySelectorAll('.filter-btn').forEach(button => {
            button.addEventListener('click', function() {
                document.querySelectorAll('.filter-btn').forEach(btn => btn.classList.remove('active'));
                this.classList.add('active');
            });
        });

        // Smooth scroll
        window.addEventListener('scroll', function() {
            const fadeIns = document.querySelectorAll('.fade-in');
            fadeIns.forEach(element => {
                const elementTop = element.getBoundingClientRect().top;
                const windowHeight = window.innerHeight;
                if (elementTop < windowHeight - 100) {
                    element.style.opacity = '1';
                    element.style.transform = 'translateY(0)';
                }
            });
        });
    </script>
</body>
</html>