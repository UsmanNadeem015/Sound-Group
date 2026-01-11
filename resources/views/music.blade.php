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
                            <button class="filter-btn active px-4 py-2 rounded-full text-sm font-semibold">All</button>
                            <button class="filter-btn px-4 py-2 rounded-full text-sm font-semibold">Album</button>
                            <button class="filter-btn px-4 py-2 rounded-full text-sm font-semibold">Artist</button>
                            <button class="filter-btn px-4 py-2 rounded-full text-sm font-semibold">Year</button>
                            <button class="filter-btn px-4 py-2 rounded-full text-sm font-semibold">Genre</button>
                            <button class="filter-btn px-4 py-2 rounded-full text-sm font-semibold">Language</button>
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
                    <!-- <img src="{{ $song->thumbnail_url }}" alt="{{ $song->title }}" class="media-image" /> -->
                    <!-- <img src="{{ asset($song->cover_image) }}" alt="{{ $song->title }}" class="media-image" /> -->
                    <img src="{{ asset('storage/music/covers/' . basename($song->cover_image)) }}" alt="{{ $song->title }}" class="media-image" />


                    @if ($song->is_new_badge)
                        <span class="new-badge absolute top-3 right-3 px-3 py-1 rounded-full text-xs font-bold text-white">NEW</span>
                    @endif
                </div>
                <div class="p-4">
                    <h3 class="font-bold text-lg mb-1 truncate">{{ $song->title }}</h3>
                    <p class="text-gray-400 text-sm mb-2 truncate">by {{ $song->artist }}</p>
                    <p class="text-xs text-gray-400 mb-2">{{ $song->duration }}</p>
                    <div class="flex items-center justify-between mb-3">
                        <div class="stars text-sm">{{ str_repeat('★', round($song->average_rating)) }}</div>
                        <span class="text-xs text-gray-500">{{ $song->year }}</span>
                    </div>
                    <div class="flex flex-wrap gap-1 mb-3">
                        <span class="badge badge-sm badge-outline">{{ $song->genre }}</span>
                        <span class="badge badge-sm badge-outline">{{ $song->language }}</span>
                    </div>
                    <button class="btn btn-gradient btn-sm w-full text-white">▶ Play Now</button>
                </div>
            </div>
        @empty
            <p class="text-center col-span-full text-gray-400">No music available right now.</p>
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