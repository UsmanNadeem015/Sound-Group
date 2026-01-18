<!DOCTYPE html>
<html lang="en" data-theme="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Video Library - SOUND GROUP</title>
    <link href="https://cdn.jsdelivr.net/npm/daisyui@4.4.19/dist/full.min.css" rel="stylesheet" type="text/css" />
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Outfit:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/video.css') }}">
</head>
<body>
<!-- Animated Background start -->
<div class="animated-bg"></div>
<!-- Animated Background end -->

<!-- Content Wrapper -->
<div class="content-wrapper">

<!-- NavBar start -->
<x-navbar />
<!-- NavBar end -->

<!-- Page Header start -->
        <section class="page-header">
            <div class="container mx-auto px-4">
                <h1 class="page-title display-font mb-4">VIDEO LIBRARY</h1>
                <p class="text-xl text-gray-300">Watch thousands of videos from your favorite artists</p>
            </div>
        </section>
<!-- Page Header end -->

<!-- Filter Section start -->
<section class="py-8">
    <div class="container mx-auto px-4">
        <div class="filter-section">
            <!-- Filter by Category -->
            <div class="text-center">
                <h3 class="text-lg font-semibold mb-4">Filter by Category</h3>
                <div class="flex flex-wrap gap-2 justify-center">
                    <a href="{{ route('videos') }}" class="filter-btn {{ !request('category') ? 'active' : '' }} px-4 py-2 rounded-full text-sm font-semibold">All</a>
                    <a href="{{ route('videos', ['category' => 'album']) }}" class="filter-btn {{ request('category') == 'album' ? 'active' : '' }} px-4 py-2 rounded-full text-sm font-semibold">Album</a>
                    <a href="{{ route('videos', ['category' => 'artist']) }}" class="filter-btn {{ request('category') == 'artist' ? 'active' : '' }} px-4 py-2 rounded-full text-sm font-semibold">Artist</a>
                    <a href="{{ route('videos', ['category' => 'year']) }}" class="filter-btn {{ request('category') == 'year' ? 'active' : '' }} px-4 py-2 rounded-full text-sm font-semibold">Year</a>
                    <a href="{{ route('videos', ['category' => 'genre']) }}" class="filter-btn {{ request('category') == 'genre' ? 'active' : '' }} px-4 py-2 rounded-full text-sm font-semibold">Genre</a>
                    <a href="{{ route('videos', ['category' => 'language']) }}" class="filter-btn {{ request('category') == 'language' ? 'active' : '' }} px-4 py-2 rounded-full text-sm font-semibold">Language</a>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Filter Section end -->


<!-- Video Grid start -->
<section class="py-8 pb-16">
    <div class="container mx-auto px-4">
        @if($videos->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-6">
                @foreach($videos as $video)
                    <div class="media-card rounded-2xl overflow-hidden fade-in">
                        <div class="relative">
                            @if($video->thumbnail && file_exists(public_path('storage/' . $video->thumbnail)))
                                <img src="{{ asset('storage/' . $video->thumbnail) }}" alt="{{ $video->title }}" class="media-image w-full h-48 object-cover">
                            @else
                                <!-- Fallback image if no thumbnail -->
                                <div class="media-image w-full h-48 bg-gradient-to-br from-purple-900 to-pink-800 flex items-center justify-center">
                                    <span class="text-white text-xl">{{ substr($video->title, 0, 1) }}</span>
                                </div>
                            @endif
                            
@if($video->is_new_badge)
    <span class="new-badge absolute top-3 right-3 px-3 py-1 rounded-full text-xs font-bold text-white bg-gradient-to-r from-purple-600 to-pink-600">NEW</span>
@endif
                            
                            <!-- Play button overlay -->
                            <div class="absolute inset-0 flex items-center justify-center opacity-0 hover:opacity-100 transition-opacity duration-300">
                                <div class="bg-white bg-opacity-20 backdrop-blur-sm rounded-full p-4">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-white" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM9.555 7.168A1 1 0 008 8v4a1 1 0 001.555.832l3-2a1 1 0 000-1.664l-3-2z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </div>
                        </div>
                        <div class="p-4">
                            <h3 class="font-bold text-lg mb-1 truncate">{{ $video->title }}</h3>
                            <p class="text-gray-400 text-sm mb-2 truncate">by {{ $video->artist }}</p>
                            <div class="flex items-center justify-between mb-3">
    <div class="stars text-sm text-yellow-400">
        ★★★★☆
    </div>
    <span class="text-xs text-gray-500">{{ $video->year ?? 'N/A' }} | {{ $video->duration ?? 'N/A' }}</span>
</div>
                            <div class="flex flex-wrap gap-1 mb-3">
                                @if($video->genre)
                                    <span class="badge badge-sm badge-outline border-purple-500 text-purple-400">{{ $video->genre }}</span>
                                @endif
                                @if($video->language)
                                    <span class="badge badge-sm badge-outline border-pink-500 text-pink-400">{{ $video->language }}</span>
                                @endif
                            </div>
                            <a href="{{ asset('storage/' . $video->file_path) }}" target="_blank" class="btn btn-gradient btn-sm w-full text-white hover:scale-105 transition-transform">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM9.555 7.168A1 1 0 008 8v4a1 1 0 001.555.832l3-2a1 1 0 000-1.664l-3-2z" clip-rule="evenodd" />
                                </svg>
                                Watch Now
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="text-center py-12">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 mx-auto text-gray-600 mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z" />
                </svg>
                <p class="text-xl text-gray-400">No videos available yet</p>
                <p class="text-gray-500 mt-2">Check back later for new video releases</p>
                @auth
                    @if(auth()->user()->role === 'admin')
                        <a href="{{ route('admin.addvideo') }}" class="btn btn-gradient mt-4 text-white">
                            Add Videos
                        </a>
                    @endif
                @endauth
            </div>
        @endif
    </div>
</section>
<!-- Video Grid end -->



<!-- footer start  -->
<x-footer />
<!-- footer end  -->

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