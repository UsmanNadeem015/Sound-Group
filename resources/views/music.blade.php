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
        <section class="py-8 pb-16">
            <div class="container mx-auto px-4">
                <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-6">
                    <!-- Music Card 1 -->
                    <div class="media-card rounded-2xl overflow-hidden fade-in">
                        <div class="relative">
                            <img src="https://images.unsplash.com/photo-1470225620780-dba8ba36b745?w=400&h=400&fit=crop" alt="Album Cover" class="media-image">
                            <span class="new-badge absolute top-3 right-3 px-3 py-1 rounded-full text-xs font-bold text-white">NEW</span>
                        </div>
                        <div class="p-4">
                            <h3 class="font-bold text-lg mb-1 truncate">Midnight Dreams</h3>
                            <p class="text-gray-400 text-sm mb-2 truncate">by The Dreamers</p>
                            <div class="flex items-center justify-between mb-3">
                                <div class="stars text-sm">★★★★☆</div>
                                <span class="text-xs text-gray-500">2024</span>
                            </div>
                            <div class="flex flex-wrap gap-1 mb-3">
                                <span class="badge badge-sm badge-outline">Pop</span>
                                <span class="badge badge-sm badge-outline">English</span>
                            </div>
                            <button class="btn btn-gradient btn-sm w-full text-white">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM9.555 7.168A1 1 0 008 8v4a1 1 0 001.555.832l3-2a1 1 0 000-1.664l-3-2z" clip-rule="evenodd" />
                                </svg>
                                Play Now
                            </button>
                        </div>
                    </div>

                    <!-- Music Card 2 -->
                    <div class="media-card rounded-2xl overflow-hidden fade-in">
                        <div class="relative">
                            <img src="https://images.unsplash.com/photo-1493225457124-a3eb161ffa5f?w=400&h=400&fit=crop" alt="Album Cover" class="media-image">
                            <span class="new-badge absolute top-3 right-3 px-3 py-1 rounded-full text-xs font-bold text-white">NEW</span>
                        </div>
                        <div class="p-4">
                            <h3 class="font-bold text-lg mb-1 truncate">Dil Ki Baatein</h3>
                            <p class="text-gray-400 text-sm mb-2 truncate">by Arijit Kumar</p>
                            <div class="flex items-center justify-between mb-3">
                                <div class="stars text-sm">★★★★★</div>
                                <span class="text-xs text-gray-500">2024</span>
                            </div>
                            <div class="flex flex-wrap gap-1 mb-3">
                                <span class="badge badge-sm badge-outline">Romantic</span>
                                <span class="badge badge-sm badge-outline">Hindi</span>
                            </div>
                            <button class="btn btn-gradient btn-sm w-full text-white">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM9.555 7.168A1 1 0 008 8v4a1 1 0 001.555.832l3-2a1 1 0 000-1.664l-3-2z" clip-rule="evenodd" />
                                </svg>
                                Play Now
                            </button>
                        </div>
                    </div>

                    <!-- Music Card 3 -->
                    <div class="media-card rounded-2xl overflow-hidden fade-in">
                        <div class="relative">
                            <img src="https://images.unsplash.com/photo-1514320291840-2e0a9bf2a9ae?w=400&h=400&fit=crop" alt="Album Cover" class="media-image">
                        </div>
                        <div class="p-4">
                            <h3 class="font-bold text-lg mb-1 truncate">Electric Pulse</h3>
                            <p class="text-gray-400 text-sm mb-2 truncate">by DJ Neon</p>
                            <div class="flex items-center justify-between mb-3">
                                <div class="stars text-sm">★★★★☆</div>
                                <span class="text-xs text-gray-500">2024</span>
                            </div>
                            <div class="flex flex-wrap gap-1 mb-3">
                                <span class="badge badge-sm badge-outline">Electronic</span>
                                <span class="badge badge-sm badge-outline">English</span>
                            </div>
                            <button class="btn btn-gradient btn-sm w-full text-white">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM9.555 7.168A1 1 0 008 8v4a1 1 0 001.555.832l3-2a1 1 0 000-1.664l-3-2z" clip-rule="evenodd" />
                                </svg>
                                Play Now
                            </button>
                        </div>
                    </div>

                    <!-- Music Card 4 -->
                    <div class="media-card rounded-2xl overflow-hidden fade-in">
                        <div class="relative">
                            <img src="https://images.unsplash.com/photo-1487180144351-b8472da7d491?w=400&h=400&fit=crop" alt="Album Cover" class="media-image">
                        </div>
                        <div class="p-4">
                            <h3 class="font-bold text-lg mb-1 truncate">Raat Ka Safar</h3>
                            <p class="text-gray-400 text-sm mb-2 truncate">by Shreya Malhotra</p>
                            <div class="flex items-center justify-between mb-3">
                                <div class="stars text-sm">★★★★★</div>
                                <span class="text-xs text-gray-500">2024</span>
                            </div>
                            <div class="flex flex-wrap gap-1 mb-3">
                                <span class="badge badge-sm badge-outline">Folk</span>
                                <span class="badge badge-sm badge-outline">Regional</span>
                            </div>
                            <button class="btn btn-gradient btn-sm w-full text-white">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM9.555 7.168A1 1 0 008 8v4a1 1 0 001.555.832l3-2a1 1 0 000-1.664l-3-2z" clip-rule="evenodd" />
                                </svg>
                                Play Now
                            </button>
                        </div>
                    </div>

                    <!-- Music Card 5 -->
                    <div class="media-card rounded-2xl overflow-hidden fade-in">
                        <div class="relative">
                            <img src="https://images.unsplash.com/photo-1459749411175-04bf5292ceea?w=400&h=400&fit=crop" alt="Album Cover" class="media-image">
                            <span class="new-badge absolute top-3 right-3 px-3 py-1 rounded-full text-xs font-bold text-white">NEW</span>
                        </div>
                        <div class="p-4">
                            <h3 class="font-bold text-lg mb-1 truncate">Summer Vibes</h3>
                            <p class="text-gray-400 text-sm mb-2 truncate">by Beach Boys Crew</p>
                            <div class="flex items-center justify-between mb-3">
                                <div class="stars text-sm">★★★★☆</div>
                                <span class="text-xs text-gray-500">2024</span>
                            </div>
                            <div class="flex flex-wrap gap-1 mb-3">
                                <span class="badge badge-sm badge-outline">Pop Rock</span>
                                <span class="badge badge-sm badge-outline">English</span>
                            </div>
                            <button class="btn btn-gradient btn-sm w-full text-white">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM9.555 7.168A1 1 0 008 8v4a1 1 0 001.555.832l3-2a1 1 0 000-1.664l-3-2z" clip-rule="evenodd" />
                                </svg>
                                Play Now
                            </button>
                        </div>
                    </div>

                    <!-- Music Card 6 -->
                    <div class="media-card rounded-2xl overflow-hidden fade-in">
                        <div class="relative">
                            <img src="https://images.unsplash.com/photo-1511379938547-c1f69419868d?w=400&h=400&fit=crop" alt="Album Cover" class="media-image">
                        </div>
                        <div class="p-4">
                            <h3 class="font-bold text-lg mb-1 truncate">Urban Legends</h3>
                            <p class="text-gray-400 text-sm mb-2 truncate">by MC Flow</p>
                            <div class="flex items-center justify-between mb-3">
                                <div class="stars text-sm">★★★★☆</div>
                                <span class="text-xs text-gray-500">2023</span>
                            </div>
                            <div class="flex flex-wrap gap-1 mb-3">
                                <span class="badge badge-sm badge-outline">Hip Hop</span>
                                <span class="badge badge-sm badge-outline">English</span>
                            </div>
                            <button class="btn btn-gradient btn-sm w-full text-white">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM9.555 7.168A1 1 0 008 8v4a1 1 0 001.555.832l3-2a1 1 0 000-1.664l-3-2z" clip-rule="evenodd" />
                                </svg>
                                Play Now
                            </button>
                        </div>
                    </div>

                    <!-- Music Card 7 -->
                    <div class="media-card rounded-2xl overflow-hidden fade-in">
                        <div class="relative">
                            <img src="https://images.unsplash.com/photo-1506157786151-b8491531f063?w=400&h=400&fit=crop" alt="Album Cover" class="media-image">
                        </div>
                        <div class="p-4">
                            <h3 class="font-bold text-lg mb-1 truncate">Classical Fusion</h3>
                            <p class="text-gray-400 text-sm mb-2 truncate">by Maestro Ensemble</p>
                            <div class="flex items-center justify-between mb-3">
                                <div class="stars text-sm">★★★★★</div>
                                <span class="text-xs text-gray-500">2023</span>
                            </div>
                            <div class="flex flex-wrap gap-1 mb-3">
                                <span class="badge badge-sm badge-outline">Classical</span>
                                <span class="badge badge-sm badge-outline">English</span>
                            </div>
                            <button class="btn btn-gradient btn-sm w-full text-white">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM9.555 7.168A1 1 0 008 8v4a1 1 0 001.555.832l3-2a1 1 0 000-1.664l-3-2z" clip-rule="evenodd" />
                                </svg>
                                Play Now
                            </button>
                        </div>
                    </div>

                    <!-- Music Card 8 -->
                    <div class="media-card rounded-2xl overflow-hidden fade-in">
                        <div class="relative">
                            <img src="https://images.unsplash.com/photo-1501612780327-45045538702b?w=400&h=400&fit=crop" alt="Album Cover" class="media-image">
                        </div>
                        <div class="p-4">
                            <h3 class="font-bold text-lg mb-1 truncate">Punjabi Beats</h3>
                            <p class="text-gray-400 text-sm mb-2 truncate">by Diljit Singh</p>
                            <div class="flex items-center justify-between mb-3">
                                <div class="stars text-sm">★★★★★</div>
                                <span class="text-xs text-gray-500">2024</span>
                            </div>
                            <div class="flex flex-wrap gap-1 mb-3">
                                <span class="badge badge-sm badge-outline">Bhangra</span>
                                <span class="badge badge-sm badge-outline">Punjabi</span>
                            </div>
                            <button class="btn btn-gradient btn-sm w-full text-white">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM9.555 7.168A1 1 0 008 8v4a1 1 0 001.555.832l3-2a1 1 0 000-1.664l-3-2z" clip-rule="evenodd" />
                                </svg>
                                Play Now
                            </button>
                        </div>
                    </div>

                    <!-- Music Card 9 -->
                    <div class="media-card rounded-2xl overflow-hidden fade-in">
                        <div class="relative">
                            <img src="https://images.unsplash.com/photo-1598387993281-cecf8b71a8f8?w=400&h=400&fit=crop" alt="Album Cover" class="media-image">
                        </div>
                        <div class="p-4">
                            <h3 class="font-bold text-lg mb-1 truncate">Tamil Melodies</h3>
                            <p class="text-gray-400 text-sm mb-2 truncate">by AR Rahman Jr</p>
                            <div class="flex items-center justify-between mb-3">
                                <div class="stars text-sm">★★★★☆</div>
                                <span class="text-xs text-gray-500">2023</span>
                            </div>
                            <div class="flex flex-wrap gap-1 mb-3">
                                <span class="badge badge-sm badge-outline">Melody</span>
                                <span class="badge badge-sm badge-outline">Tamil</span>
                            </div>
                            <button class="btn btn-gradient btn-sm w-full text-white">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM9.555 7.168A1 1 0 008 8v4a1 1 0 001.555.832l3-2a1 1 0 000-1.664l-3-2z" clip-rule="evenodd" />
                                </svg>
                                Play Now
                            </button>
                        </div>
                    </div>

                    <!-- Music Card 10 -->
                    <div class="media-card rounded-2xl overflow-hidden fade-in">
                        <div class="relative">
                            <img src="https://images.unsplash.com/photo-1511671782779-c97d3d27a1d4?w=400&h=400&fit=crop" alt="Album Cover" class="media-image">
                        </div>
                        <div class="p-4">
                            <h3 class="font-bold text-lg mb-1 truncate">Jazz Standards</h3>
                            <p class="text-gray-400 text-sm mb-2 truncate">by Blue Notes Band</p>
                            <div class="flex items-center justify-between mb-3">
                                <div class="stars text-sm">★★★★★</div>
                                <span class="text-xs text-gray-500">2023</span>
                            </div>
                            <div class="flex flex-wrap gap-1 mb-3">
                                <span class="badge badge-sm badge-outline">Jazz</span>
                                <span class="badge badge-sm badge-outline">English</span>
                            </div>
                            <button class="btn btn-gradient btn-sm w-full text-white">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM9.555 7.168A1 1 0 008 8v4a1 1 0 001.555.832l3-2a1 1 0 000-1.664l-3-2z" clip-rule="evenodd" />
                                </svg>
                                Play Now
                            </button>
                        </div>
                    </div>

                    <!-- Music Card 11 -->
                    <div class="media-card rounded-2xl overflow-hidden fade-in">
                        <div class="relative">
                            <img src="https://images.unsplash.com/photo-1619983081563-430f63602796?w=400&h=400&fit=crop" alt="Album Cover" class="media-image">
                        </div>
                        <div class="p-4">
                            <h3 class="font-bold text-lg mb-1 truncate">Rock Anthems</h3>
                            <p class="text-gray-400 text-sm mb-2 truncate">by Thunder Strike</p>
                            <div class="flex items-center justify-between mb-3">
                                <div class="stars text-sm">★★★★☆</div>
                                <span class="text-xs text-gray-500">2024</span>
                            </div>
                            <div class="flex flex-wrap gap-1 mb-3">
                                <span class="badge badge-sm badge-outline">Rock</span>
                                <span class="badge badge-sm badge-outline">English</span>
                            </div>
                            <button class="btn btn-gradient btn-sm w-full text-white">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM9.555 7.168A1 1 0 008 8v4a1 1 0 001.555.832l3-2a1 1 0 000-1.664l-3-2z" clip-rule="evenodd" />
                                </svg>
                                Play Now
                            </button>
                        </div>
                    </div>

                    <!-- Music Card 12 -->
                    <div class="media-card rounded-2xl overflow-hidden fade-in">
                        <div class="relative">
                            <img src="https://images.unsplash.com/photo-1477233534935-f5e6fe7c1159?w=400&h=400&fit=crop" alt="Album Cover" class="media-image">
                            <span class="new-badge absolute top-3 right-3 px-3 py-1 rounded-full text-xs font-bold text-white">NEW</span>
                        </div>
                        <div class="p-4">
                            <h3 class="font-bold text-lg mb-1 truncate">Lofi Chill</h3>
                            <p class="text-gray-400 text-sm mb-2 truncate">by Chill Vibes</p>
                            <div class="flex items-center justify-between mb-3">
                                <div class="stars text-sm">★★★★★</div>
                                <span class="text-xs text-gray-500">2024</span>
                            </div>
                            <div class="flex flex-wrap gap-1 mb-3">
                                <span class="badge badge-sm badge-outline">Lofi</span>
                                <span class="badge badge-sm badge-outline">English</span>
                            </div>
                            <button class="btn btn-gradient btn-sm w-full text-white">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM9.555 7.168A1 1 0 008 8v4a1 1 0 001.555.832l3-2a1 1 0 000-1.664l-3-2z" clip-rule="evenodd" />
                                </svg>
                                Play Now
                            </button>
                        </div>
                    </div>

                    <!-- Music Card 13 -->
                    <div class="media-card rounded-2xl overflow-hidden fade-in">
                        <div class="relative">
                            <img src="https://images.unsplash.com/photo-1507838153414-b4b713384a76?w=400&h=400&fit=crop" alt="Album Cover" class="media-image">
                        </div>
                        <div class="p-4">
                            <h3 class="font-bold text-lg mb-1 truncate">Bengali Folk</h3>
                            <p class="text-gray-400 text-sm mb-2 truncate">by Baul Fusion</p>
                            <div class="flex items-center justify-between mb-3">
                                <div class="stars text-sm">★★★★☆</div>
                                <span class="text-xs text-gray-500">2023</span>
                            </div>
                            <div class="flex flex-wrap gap-1 mb-3">
                                <span class="badge badge-sm badge-outline">Folk</span>
                                <span class="badge badge-sm badge-outline">Bengali</span>
                            </div>
                            <button class="btn btn-gradient btn-sm w-full text-white">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM9.555 7.168A1 1 0 008 8v4a1 1 0 001.555.832l3-2a1 1 0 000-1.664l-3-2z" clip-rule="evenodd" />
                                </svg>
                                Play Now
                            </button>
                        </div>
                    </div>

                    <!-- Music Card 14 -->
                    <div class="media-card rounded-2xl overflow-hidden fade-in">
                        <div class="relative">
                            <img src="https://images.unsplash.com/photo-1510915361894-db8b60106cb1?w=400&h=400&fit=crop" alt="Album Cover" class="media-image">
                        </div>
                        <div class="p-4">
                            <h3 class="font-bold text-lg mb-1 truncate">EDM Paradise</h3>
                            <p class="text-gray-400 text-sm mb-2 truncate">by DJ Voltage</p>
                            <div class="flex items-center justify-between mb-3">
                                <div class="stars text-sm">★★★★★</div>
                                <span class="text-xs text-gray-500">2024</span>
                            </div>
                            <div class="flex flex-wrap gap-1 mb-3">
                                <span class="badge badge-sm badge-outline">EDM</span>
                                <span class="badge badge-sm badge-outline">English</span>
                            </div>
                            <button class="btn btn-gradient btn-sm w-full text-white">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM9.555 7.168A1 1 0 008 8v4a1 1 0 001.555.832l3-2a1 1 0 000-1.664l-3-2z" clip-rule="evenodd" />
                                </svg>
                                Play Now
                            </button>
                        </div>
                    </div>

                    <!-- Music Card 15 -->
                    <div class="media-card rounded-2xl overflow-hidden fade-in">
                        <div class="relative">
                            <img src="https://images.unsplash.com/photo-1493225457124-a3eb161ffa5f?w=400&h=400&fit=crop" alt="Album Cover" class="media-image">
                        </div>
                        <div class="p-4">
                            <h3 class="font-bold text-lg mb-1 truncate">Marathi Classics</h3>
                            <p class="text-gray-400 text-sm mb-2 truncate">by Lata Memories</p>
                            <div class="flex items-center justify-between mb-3">
                                <div class="stars text-sm">★★★★★</div>
                                <span class="text-xs text-gray-500">2022</span>
                            </div>
                            <div class="flex flex-wrap gap-1 mb-3">
                                <span class="badge badge-sm badge-outline">Classic</span>
                                <span class="badge badge-sm badge-outline">Marathi</span>
                            </div>
                            <button class="btn btn-gradient btn-sm w-full text-white">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM9.555 7.168A1 1 0 008 8v4a1 1 0 001.555.832l3-2a1 1 0 000-1.664l-3-2z" clip-rule="evenodd" />
                                </svg>
                                Play Now
                            </button>
                        </div>
                    </div>

                    <!-- Music Card 16 -->
                    <div class="media-card rounded-2xl overflow-hidden fade-in">
                        <div class="relative">
                            <img src="https://images.unsplash.com/photo-1470225620780-dba8ba36b745?w=400&h=400&fit=crop" alt="Album Cover" class="media-image">
                            <span class="new-badge absolute top-3 right-3 px-3 py-1 rounded-full text-xs font-bold text-white">NEW</span>
                        </div>
                        <div class="p-4">
                            <h3 class="font-bold text-lg mb-1 truncate">Indie Vibes</h3>
                            <p class="text-gray-400 text-sm mb-2 truncate">by Urban Poets</p>
                            <div class="flex items-center justify-between mb-3">
                                <div class="stars text-sm">★★★★☆</div>
                                <span class="text-xs text-gray-500">2024</span>
                            </div>
                            <div class="flex flex-wrap gap-1 mb-3">
                                <span class="badge badge-sm badge-outline">Indie</span>
                                <span class="badge badge-sm badge-outline">English</span>
                            </div>
                            <button class="btn btn-gradient btn-sm w-full text-white">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM9.555 7.168A1 1 0 008 8v4a1 1 0 001.555.832l3-2a1 1 0 000-1.664l-3-2z" clip-rule="evenodd" />
                                </svg>
                                Play Now
                            </button>
                        </div>
                    </div>

                    <!-- Music Card 17 -->
                    <div class="media-card rounded-2xl overflow-hidden fade-in">
                        <div class="relative">
                            <img src="https://images.unsplash.com/photo-1514320291840-2e0a9bf2a9ae?w=400&h=400&fit=crop" alt="Album Cover" class="media-image">
                        </div>
                        <div class="p-4">
                            <h3 class="font-bold text-lg mb-1 truncate">Telugu Hits</h3>
                            <p class="text-gray-400 text-sm mb-2 truncate">by Devi Sri</p>
                            <div class="flex items-center justify-between mb-3">
                                <div class="stars text-sm">★★★★★</div>
                                <span class="text-xs text-gray-500">2024</span>
                            </div>
                            <div class="flex flex-wrap gap-1 mb-3">
                                <span class="badge badge-sm badge-outline">Pop</span>
                                <span class="badge badge-sm badge-outline">Telugu</span>
                            </div>
                            <button class="btn btn-gradient btn-sm w-full text-white">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM9.555 7.168A1 1 0 008 8v4a1 1 0 001.555.832l3-2a1 1 0 000-1.664l-3-2z" clip-rule="evenodd" />
                                </svg>
                                Play Now
                            </button>
                        </div>
                    </div>

                    <!-- Music Card 18 -->
                    <div class="media-card rounded-2xl overflow-hidden fade-in">
                        <div class="relative">
                            <img src="https://images.unsplash.com/photo-1487180144351-b8472da7d491?w=400&h=400&fit=crop" alt="Album Cover" class="media-image">
                        </div>
                        <div class="p-4">
                            <h3 class="font-bold text-lg mb-1 truncate">Sufi Nights</h3>
                            <p class="text-gray-400 text-sm mb-2 truncate">by Spiritual Souls</p>
                            <div class="flex items-center justify-between mb-3">
                                <div class="stars text-sm">★★★★★</div>
                                <span class="text-xs text-gray-500">2023</span>
                            </div>
                            <div class="flex flex-wrap gap-1 mb-3">
                                <span class="badge badge-sm badge-outline">Sufi</span>
                                <span class="badge badge-sm badge-outline">Regional</span>
                            </div>
                            <button class="btn btn-gradient btn-sm w-full text-white">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM9.555 7.168A1 1 0 008 8v4a1 1 0 001.555.832l3-2a1 1 0 000-1.664l-3-2z" clip-rule="evenodd" />
                                </svg>
                                Play Now
                            </button>
                        </div>
                    </div>

                    <!-- Music Card 19 -->
                    <div class="media-card rounded-2xl overflow-hidden fade-in">
                        <div class="relative">
                            <img src="https://images.unsplash.com/photo-1459749411175-04bf5292ceea?w=400&h=400&fit=crop" alt="Album Cover" class="media-image">
                        </div>
                        <div class="p-4">
                            <h3 class="font-bold text-lg mb-1 truncate">Country Roads</h3>
                            <p class="text-gray-400 text-sm mb-2 truncate">by Nashville Band</p>
                            <div class="flex items-center justify-between mb-3">
                                <div class="stars text-sm">★★★★☆</div>
                                <span class="text-xs text-gray-500">2023</span>
                            </div>
                            <div class="flex flex-wrap gap-1 mb-3">
                                <span class="badge badge-sm badge-outline">Country</span>
                                <span class="badge badge-sm badge-outline">English</span>
                            </div>
                            <button class="btn btn-gradient btn-sm w-full text-white">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM9.555 7.168A1 1 0 008 8v4a1 1 0 001.555.832l3-2a1 1 0 000-1.664l-3-2z" clip-rule="evenodd" />
                                </svg>
                                Play Now
                            </button>
                        </div>
                    </div>

                    <!-- Music Card 20 -->
                    <div class="media-card rounded-2xl overflow-hidden fade-in">
                        <div class="relative">
                            <img src="https://images.unsplash.com/photo-1511671782779-c97d3d27a1d4?w=400&h=400&fit=crop" alt="Album Cover" class="media-image">
                            <span class="new-badge absolute top-3 right-3 px-3 py-1 rounded-full text-xs font-bold text-white">NEW</span>
                        </div>
                        <div class="p-4">
                            <h3 class="font-bold text-lg mb-1 truncate">Acoustic Dreams</h3>
                            <p class="text-gray-400 text-sm mb-2 truncate">by Sara James</p>
                            <div class="flex items-center justify-between mb-3">
                                <div class="stars text-sm">★★★★★</div>
                                <span class="text-xs text-gray-500">2024</span>
                            </div>
                            <div class="flex flex-wrap gap-1 mb-3">
                                <span class="badge badge-sm badge-outline">Acoustic</span>
                                <span class="badge badge-sm badge-outline">English</span>
                            </div>
                            <button class="btn btn-gradient btn-sm w-full text-white">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM9.555 7.168A1 1 0 008 8v4a1 1 0 001.555.832l3-2a1 1 0 000-1.664l-3-2z" clip-rule="evenodd" />
                                </svg>
                                Play Now
                            </button>
                        </div>
                    </div>
                </div>
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