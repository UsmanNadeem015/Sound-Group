<!DOCTYPE html>
<html lang="en" data-theme="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SOUND GROUP - Entertainment Hub</title>
    <link href="https://cdn.jsdelivr.net/npm/daisyui@4.4.19/dist/full.min.css" rel="stylesheet" type="text/css" />
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Outfit:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/home.css') }}">
</head>
<body>
<!-- Animated BG start -->
    <div class="animated-bg"></div>
<!-- Animated BG end -->

<!-- Content Wrapper -->
<div class="content-wrapper">

<!-- NavBar start -->
    <x-navbar />
<!-- NavBar end -->


<!-- Hero start -->
        <section class="hero-section pt-20">
            <div class="container mx-auto px-4">
                <div class="grid lg:grid-cols-2 gap-12 items-center">
                    <div>
                        <h1 class="hero-title display-font mb-6">
                            YOUR ULTIMATE<br>ENTERTAINMENT<br>DESTINATION
                        </h1>
                        <p class="hero-subtitle text-xl text-gray-300 mb-8 font-light">
                            Discover millions of songs and videos from around the world. Stream, rate, and review your favorite music and videos in regional and English languages.
                        </p>
                        <div class="flex flex-wrap gap-4 mb-8">
                            <a href="{{ url('/Music') }}" class="btn btn-gradient btn-lg text-white">Explore Music</a>
                            <a href="{{ url('/Videos') }}" class="btn btn-outline btn-lg">Watch Videos</a>
                        </div>
                    </div>
                    <div class="hidden lg:block">
                        <div class="relative">
                            <img src="https://images.unsplash.com/photo-1511379938547-c1f69419868d?w=600&h=600&fit=crop" alt="Music Entertainment" class="rounded-3xl shadow-2xl">
                            <div class="absolute -bottom-6 -left-6 bg-gradient-to-r from-purple-500 to-pink-500 rounded-2xl p-6 shadow-2xl">
                                <div class="text-4xl font-bold display-font">10K+</div>
                                <div class="text-sm">Songs & Videos</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
<!-- Hero end -->

<!-- Stats start -->
        <section class="py-16">
            <div class="container mx-auto px-4">
                <div class="grid grid-cols-2 lg:grid-cols-4 gap-6">
                    <div class="stat-card rounded-2xl p-6 text-center">
                        <div class="text-4xl font-bold display-font text-purple-400 mb-2">5000+</div>
                        <div class="text-gray-400">Music Tracks</div>
                    </div>
                    <div class="stat-card rounded-2xl p-6 text-center">
                        <div class="text-4xl font-bold display-font text-pink-400 mb-2">3000+</div>
                        <div class="text-gray-400">Video Content</div>
                    </div>
                    <div class="stat-card rounded-2xl p-6 text-center">
                        <div class="text-4xl font-bold display-font text-purple-400 mb-2">50+</div>
                        <div class="text-gray-400">Artists</div>
                    </div>
                    <div class="stat-card rounded-2xl p-6 text-center">
                        <div class="text-4xl font-bold display-font text-pink-400 mb-2">20+</div>
                        <div class="text-gray-400">Languages</div>
                    </div>
                </div>
            </div>
        </section>
<!-- Stats end -->

<!-- Latest Music start -->
<section class="py-16">
    <div class="container mx-auto px-4">
        <div class="flex justify-between items-center mb-8">
            <h2 class="section-title display-font">LATEST MUSIC</h2>
            <a href="{{ url('/Music') }}" class="text-purple-400 hover:text-purple-300 transition-colors font-semibold">View All →</a>
        </div>
        
        @if($latestMusic->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-5 gap-6">
                @foreach($latestMusic as $song)
                    <div class="media-card rounded-2xl overflow-hidden fade-in">
                        <div class="relative">
                            @if($song->cover_image && file_exists(public_path('storage/' . $song->cover_image)))
                                <img src="{{ asset('storage/' . $song->cover_image) }}" alt="{{ $song->title }}" class="media-image w-full h-48 object-cover">
                            @else
                                <!-- Fallback image if no cover -->
                                <div class="media-image w-full h-48 bg-gradient-to-br from-purple-900 to-pink-800 flex items-center justify-center">
                                    <span class="text-white text-xl">{{ substr($song->title, 0, 1) }}</span>
                                </div>
                            @endif
                            
                            @if($song->is_new)
                                <span class="new-badge absolute top-3 right-3 px-3 py-1 rounded-full text-xs font-bold text-white bg-gradient-to-r from-purple-600 to-pink-600">NEW</span>
                            @endif
                        </div>
                        <div class="p-4">
                            <h3 class="font-bold text-lg mb-1 truncate">{{ $song->title }}</h3>
                            <p class="text-gray-400 text-sm mb-2 truncate">by {{ $song->artist }}</p>
                            <div class="flex items-center justify-between">
                                <div class="stars text-sm text-yellow-400">
                                    <!-- Placeholder for ratings - you can add ratings later -->
                                    ★★★★☆
                                </div>
                                <span class="text-xs text-gray-500">{{ $song->year ?? 'N/A' }}</span>
                            </div>
                            <div class="mt-3">
                                @if($song->genre)
                                    <span class="badge badge-sm badge-outline border-purple-500 text-purple-400">{{ $song->genre }}</span>
                                @endif
                                @if($song->language)
                                    <span class="badge badge-sm badge-outline border-pink-500 text-pink-400 ml-1">{{ $song->language }}</span>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="text-center py-12">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 mx-auto text-gray-600 mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 19V6l12-3v13M9 19c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zm12-3c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zM9 10l12-3" />
                </svg>
                <p class="text-xl text-gray-400">No music available yet</p>
                <p class="text-gray-500 mt-2">Check back later for new releases</p>
            </div>
        @endif
    </div>
</section>
<!-- Latest Music end -->

<!-- Latest Videos start -->
        <section class="py-16">
            <div class="container mx-auto px-4">
                <div class="flex justify-between items-center mb-8">
                    <h2 class="section-title display-font">LATEST VIDEOS</h2>
                    <a href="{{ url('/Videos') }}" class="text-purple-400 hover:text-purple-300 transition-colors font-semibold">View All →</a>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-5 gap-6">
                    <!-- Video Card 1 -->
                    <div class="media-card rounded-2xl overflow-hidden fade-in">
                        <div class="relative">
                            <img src="https://images.unsplash.com/photo-1516450360452-9312f5e86fc7?w=400&h=400&fit=crop" alt="Video Thumbnail" class="media-image">
                            <span class="new-badge absolute top-3 right-3 px-3 py-1 rounded-full text-xs font-bold text-white">NEW</span>
                            <div class="absolute inset-0 flex items-center justify-center">
                                <div class="bg-white bg-opacity-20 backdrop-blur-sm rounded-full p-4">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-white" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM9.555 7.168A1 1 0 008 8v4a1 1 0 001.555.832l3-2a1 1 0 000-1.664l-3-2z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </div>
                        </div>
                        <div class="p-4">
                            <h3 class="font-bold text-lg mb-1 truncate">Concert Live 2024</h3>
                            <p class="text-gray-400 text-sm mb-2 truncate">by Rock Legends</p>
                            <div class="flex items-center justify-between">
                                <div class="stars text-sm">★★★★★</div>
                                <span class="text-xs text-gray-500">45:32</span>
                            </div>
                            <div class="mt-3">
                                <span class="badge badge-sm badge-outline">Rock</span>
                                <span class="badge badge-sm badge-outline ml-1">English</span>
                            </div>
                        </div>
                    </div>

                    <!-- Video Card 2 -->
                    <div class="media-card rounded-2xl overflow-hidden fade-in">
                        <div class="relative">
                            <img src="https://images.unsplash.com/photo-1598387993281-cecf8b71a8f8?w=400&h=400&fit=crop" alt="Video Thumbnail" class="media-image">
                            <span class="new-badge absolute top-3 right-3 px-3 py-1 rounded-full text-xs font-bold text-white">NEW</span>
                            <div class="absolute inset-0 flex items-center justify-center">
                                <div class="bg-white bg-opacity-20 backdrop-blur-sm rounded-full p-4">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-white" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM9.555 7.168A1 1 0 008 8v4a1 1 0 001.555.832l3-2a1 1 0 000-1.664l-3-2z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </div>
                        </div>
                        <div class="p-4">
                            <h3 class="font-bold text-lg mb-1 truncate">Bollywood Mashup</h3>
                            <p class="text-gray-400 text-sm mb-2 truncate">by DJ Rohan</p>
                            <div class="flex items-center justify-between">
                                <div class="stars text-sm">★★★★☆</div>
                                <span class="text-xs text-gray-500">12:45</span>
                            </div>
                            <div class="mt-3">
                                <span class="badge badge-sm badge-outline">Dance</span>
                                <span class="badge badge-sm badge-outline ml-1">Hindi</span>
                            </div>
                        </div>
                    </div>

                    <!-- Video Card 3 -->
                    <div class="media-card rounded-2xl overflow-hidden fade-in">
                        <div class="relative">
                            <img src="https://images.unsplash.com/photo-1501612780327-45045538702b?w=400&h=400&fit=crop" alt="Video Thumbnail" class="media-image">
                            <div class="absolute inset-0 flex items-center justify-center">
                                <div class="bg-white bg-opacity-20 backdrop-blur-sm rounded-full p-4">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-white" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM9.555 7.168A1 1 0 008 8v4a1 1 0 001.555.832l3-2a1 1 0 000-1.664l-3-2z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </div>
                        </div>
                        <div class="p-4">
                            <h3 class="font-bold text-lg mb-1 truncate">Acoustic Sessions</h3>
                            <p class="text-gray-400 text-sm mb-2 truncate">by Sarah Mitchell</p>
                            <div class="flex items-center justify-between">
                                <div class="stars text-sm">★★★★★</div>
                                <span class="text-xs text-gray-500">28:15</span>
                            </div>
                            <div class="mt-3">
                                <span class="badge badge-sm badge-outline">Acoustic</span>
                                <span class="badge badge-sm badge-outline ml-1">English</span>
                            </div>
                        </div>
                    </div>

                    <!-- Video Card 4 -->
                    <div class="media-card rounded-2xl overflow-hidden fade-in">
                        <div class="relative">
                            <img src="https://images.unsplash.com/photo-1493225457124-a3eb161ffa5f?w=400&h=400&fit=crop" alt="Video Thumbnail" class="media-image">
                            <div class="absolute inset-0 flex items-center justify-center">
                                <div class="bg-white bg-opacity-20 backdrop-blur-sm rounded-full p-4">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-white" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM9.555 7.168A1 1 0 008 8v4a1 1 0 001.555.832l3-2a1 1 0 000-1.664l-3-2z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </div>
                        </div>
                        <div class="p-4">
                            <h3 class="font-bold text-lg mb-1 truncate">Regional Folk Dance</h3>
                            <p class="text-gray-400 text-sm mb-2 truncate">by Cultural Troupe</p>
                            <div class="flex items-center justify-between">
                                <div class="stars text-sm">★★★★☆</div>
                                <span class="text-xs text-gray-500">35:20</span>
                            </div>
                            <div class="mt-3">
                                <span class="badge badge-sm badge-outline">Folk</span>
                                <span class="badge badge-sm badge-outline ml-1">Regional</span>
                            </div>
                        </div>
                    </div>

                    <!-- Video Card 5 -->
                    <div class="media-card rounded-2xl overflow-hidden fade-in">
                        <div class="relative">
                            <img src="https://images.unsplash.com/photo-1511671782779-c97d3d27a1d4?w=400&h=400&fit=crop" alt="Video Thumbnail" class="media-image">
                            <span class="new-badge absolute top-3 right-3 px-3 py-1 rounded-full text-xs font-bold text-white">NEW</span>
                            <div class="absolute inset-0 flex items-center justify-center">
                                <div class="bg-white bg-opacity-20 backdrop-blur-sm rounded-full p-4">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-white" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM9.555 7.168A1 1 0 008 8v4a1 1 0 001.555.832l3-2a1 1 0 000-1.664l-3-2z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </div>
                        </div>
                        <div class="p-4">
                            <h3 class="font-bold text-lg mb-1 truncate">Jazz Night Special</h3>
                            <p class="text-gray-400 text-sm mb-2 truncate">by Jazz Collective</p>
                            <div class="flex items-center justify-between">
                                <div class="stars text-sm">★★★★★</div>
                                <span class="text-xs text-gray-500">52:10</span>
                            </div>
                            <div class="mt-3">
                                <span class="badge badge-sm badge-outline">Jazz</span>
                                <span class="badge badge-sm badge-outline ml-1">English</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
<!-- Latest Videos end -->

<!-- About start -->
        <section class="py-16 bg-gradient-to-r from-purple-900/20 to-pink-900/20">
            <div class="container mx-auto px-4">
                <div class="max-w-4xl mx-auto text-center">
                    <h2 class="section-title display-font mb-6">ABOUT SOUND GROUP</h2>
                    <p class="text-gray-300 text-lg leading-relaxed mb-6">
                        Welcome to SOUND GROUP, your ultimate destination for music and video entertainment. We bring you an extensive collection of the latest and classic songs and videos from around the world, featuring both regional and English language content.
                    </p>
                    <p class="text-gray-300 text-lg leading-relaxed mb-8">
                        Discover music organized by album, artist, year, genre, and language. Rate your favorites, write reviews, and connect with a community of music and video enthusiasts. Join us today and explore unlimited entertainment at your fingertips.
                    </p>
                    <a href="{{ url('/About') }}" class="btn btn-gradient btn-lg text-white">Learn More About Us</a>
                </div>
            </div>
        </section>
<!-- About end -->


<!-- Newsletter start -->
        <!-- <section class="py-16">
            <div class="container mx-auto px-4">
                <div class="max-w-2xl mx-auto text-center">
                    <h2 class="text-4xl font-bold display-font mb-4">STAY UPDATED</h2>
                    <p class="text-gray-400 mb-6">Subscribe to our newsletter for the latest music and video releases</p>
                    <div class="join w-full">
                        <input type="email" placeholder="Enter your email" class="input search-bar join-item w-full" />
                        <button class="btn btn-gradient join-item text-white">Subscribe</button>
                    </div>
                </div>
            </div>
        </section> -->
<!-- Newsletter start -->

<!-- Footer start -->
    <x-footer />    
<!-- Footer end -->

</div>

    <script>
        // Smooth scroll for anchor links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth'
                    });
                }
            });
        });

        // Add scroll effect to navbar
        // window.addEventListener('scroll', function() {
        //     const navbar = document.querySelector('.navbar-custom');
        //     if (window.scrollY > 50) {
        //         navbar.style.background = 'rgba(22, 22, 29, 0.95)';
        //     } else {
        //         navbar.style.background = 'rgba(22, 22, 29, 0.8)';
        //     }
        // });
    </script>
</body>
</html>