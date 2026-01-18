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
<!-- Filter Section end -->


<!-- Video Grid start -->
        <section class="py-8 pb-16">
            <div class="container mx-auto px-4">
                <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-6">
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
                            <div class="flex items-center justify-between mb-3">
                                <div class="stars text-sm">★★★★★</div>
                                <span class="text-xs text-gray-500">45:32</span>
                            </div>
                            <div class="flex flex-wrap gap-1 mb-3">
                                <span class="badge badge-sm badge-outline">Rock</span>
                                <span class="badge badge-sm badge-outline">English</span>
                            </div>
                            <button class="btn btn-gradient btn-sm w-full text-white">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM9.555 7.168A1 1 0 008 8v4a1 1 0 001.555.832l3-2a1 1 0 000-1.664l-3-2z" clip-rule="evenodd" />
                                </svg>
                                Watch Now
                            </button>
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
                            <div class="flex items-center justify-between mb-3">
                                <div class="stars text-sm">★★★★☆</div>
                                <span class="text-xs text-gray-500">12:45</span>
                            </div>
                            <div class="flex flex-wrap gap-1 mb-3">
                                <span class="badge badge-sm badge-outline">Dance</span>
                                <span class="badge badge-sm badge-outline">Hindi</span>
                            </div>
                            <button class="btn btn-gradient btn-sm w-full text-white">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM9.555 7.168A1 1 0 008 8v4a1 1 0 001.555.832l3-2a1 1 0 000-1.664l-3-2z" clip-rule="evenodd" />
                                </svg>
                                Watch Now
                            </button>
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
                            <div class="flex items-center justify-between mb-3">
                                <div class="stars text-sm">★★★★★</div>
                                <span class="text-xs text-gray-500">28:15</span>
                            </div>
                            <div class="flex flex-wrap gap-1 mb-3">
                                <span class="badge badge-sm badge-outline">Acoustic</span>
                                <span class="badge badge-sm badge-outline">English</span>
                            </div>
                            <button class="btn btn-gradient btn-sm w-full text-white">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM9.555 7.168A1 1 0 008 8v4a1 1 0 001.555.832l3-2a1 1 0 000-1.664l-3-2z" clip-rule="evenodd" />
                                </svg>
                                Watch Now
                            </button>
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
                            <div class="flex items-center justify-between mb-3">
                                <div class="stars text-sm">★★★★☆</div>
                                <span class="text-xs text-gray-500">35:20</span>
                            </div>
                            <div class="flex flex-wrap gap-1 mb-3">
                                <span class="badge badge-sm badge-outline">Folk</span>
                                <span class="badge badge-sm badge-outline">Regional</span>
                            </div>
                            <button class="btn btn-gradient btn-sm w-full text-white">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM9.555 7.168A1 1 0 008 8v4a1 1 0 001.555.832l3-2a1 1 0 000-1.664l-3-2z" clip-rule="evenodd" />
                                </svg>
                                Watch Now
                            </button>
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
                            <div class="flex items-center justify-between mb-3">
                                <div class="stars text-sm">★★★★★</div>
                                <span class="text-xs text-gray-500">52:10</span>
                            </div>
                            <div class="flex flex-wrap gap-1 mb-3">
                                <span class="badge badge-sm badge-outline">Jazz</span>
                                <span class="badge badge-sm badge-outline">English</span>
                            </div>
                            <button class="btn btn-gradient btn-sm w-full text-white">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM9.555 7.168A1 1 0 008 8v4a1 1 0 001.555.832l3-2a1 1 0 000-1.664l-3-2z" clip-rule="evenodd" />
                                </svg>
                                Watch Now
                            </button>
                        </div>
                    </div>

                    <!-- Video Card 6 -->
                    <div class="media-card rounded-2xl overflow-hidden fade-in">
                        <div class="relative">
                            <img src="https://images.unsplash.com/photo-1470229722913-7c0e2dbbafd3?w=400&h=400&fit=crop" alt="Video Thumbnail" class="media-image">
                            <div class="absolute inset-0 flex items-center justify-center">
                                <div class="bg-white bg-opacity-20 backdrop-blur-sm rounded-full p-4">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-white" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM9.555 7.168A1 1 0 008 8v4a1 1 0 001.555.832l3-2a1 1 0 000-1.664l-3-2z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </div>
                        </div>
                        <div class="p-4">
                            <h3 class="font-bold text-lg mb-1 truncate">Electronic Beats</h3>
                            <p class="text-gray-400 text-sm mb-2 truncate">by Synthwave Pro</p>
                            <div class="flex items-center justify-between mb-3">
                                <div class="stars text-sm">★★★★☆</div>
                                <span class="text-xs text-gray-500">18:30</span>
                            </div>
                            <div class="flex flex-wrap gap-1 mb-3">
                                <span class="badge badge-sm badge-outline">Electronic</span>
                                <span class="badge badge-sm badge-outline">English</span>
                            </div>
                            <button class="btn btn-gradient btn-sm w-full text-white">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM9.555 7.168A1 1 0 008 8v4a1 1 0 001.555.832l3-2a1 1 0 000-1.664l-3-2z" clip-rule="evenodd" />
                                </svg>
                                Watch Now
                            </button>
                        </div>
                    </div>

                    <!-- Video Card 7 -->
                    <div class="media-card rounded-2xl overflow-hidden fade-in">
                        <div class="relative">
                            <img src="https://images.unsplash.com/photo-1514320291840-2e0a9bf2a9ae?w=400&h=400&fit=crop" alt="Video Thumbnail" class="media-image">
                            <div class="absolute inset-0 flex items-center justify-center">
                                <div class="bg-white bg-opacity-20 backdrop-blur-sm rounded-full p-4">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-white" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM9.555 7.168A1 1 0 008 8v4a1 1 0 001.555.832l3-2a1 1 0 000-1.664l-3-2z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </div>
                        </div>
                        <div class="p-4">
                            <h3 class="font-bold text-lg mb-1 truncate">Punjabi Wedding</h3>
                            <p class="text-gray-400 text-sm mb-2 truncate">by Mika Singh</p>
                            <div class="flex items-center justify-between mb-3">
                                <div class="stars text-sm">★★★★★</div>
                                <span class="text-xs text-gray-500">22:45</span>
                            </div>
                            <div class="flex flex-wrap gap-1 mb-3">
                                <span class="badge badge-sm badge-outline">Bhangra</span>
                                <span class="badge badge-sm badge-outline">Punjabi</span>
                            </div>
                            <button class="btn btn-gradient btn-sm w-full text-white">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM9.555 7.168A1 1 0 008 8v4a1 1 0 001.555.832l3-2a1 1 0 000-1.664l-3-2z" clip-rule="evenodd" />
                                </svg>
                                Watch Now
                            </button>
                        </div>
                    </div>

                    <!-- Video Card 8 -->
                    <div class="media-card rounded-2xl overflow-hidden fade-in">
                        <div class="relative">
                            <img src="https://images.unsplash.com/photo-1511379938547-c1f69419868d?w=400&h=400&fit=crop" alt="Video Thumbnail" class="media-image">
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
                            <h3 class="font-bold text-lg mb-1 truncate">Tamil Cinema Hits</h3>
                            <p class="text-gray-400 text-sm mb-2 truncate">by Vijay Music</p>
                            <div class="flex items-center justify-between mb-3">
                                <div class="stars text-sm">★★★★☆</div>
                                <span class="text-xs text-gray-500">38:22</span>
                            </div>
                            <div class="flex flex-wrap gap-1 mb-3">
                                <span class="badge badge-sm badge-outline">Cinema</span>
                                <span class="badge badge-sm badge-outline">Tamil</span>
                            </div>
                            <button class="btn btn-gradient btn-sm w-full text-white">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM9.555 7.168A1 1 0 008 8v4a1 1 0 001.555.832l3-2a1 1 0 000-1.664l-3-2z" clip-rule="evenodd" />
                                </svg>
                                Watch Now
                            </button>
                        </div>
                    </div>

                    <!-- Video Card 9 -->
                    <div class="media-card rounded-2xl overflow-hidden fade-in">
                        <div class="relative">
                            <img src="https://images.unsplash.com/photo-1487180144351-b8472da7d491?w=400&h=400&fit=crop" alt="Video Thumbnail" class="media-image">
                            <div class="absolute inset-0 flex items-center justify-center">
                                <div class="bg-white bg-opacity-20 backdrop-blur-sm rounded-full p-4">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-white" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM9.555 7.168A1 1 0 008 8v4a1 1 0 001.555.832l3-2a1 1 0 000-1.664l-3-2z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </div>
                        </div>
                        <div class="p-4">
                            <h3 class="font-bold text-lg mb-1 truncate">Hip Hop Cypher</h3>
                            <p class="text-gray-400 text-sm mb-2 truncate">by Rap Battle</p>
                            <div class="flex items-center justify-between mb-3">
                                <div class="stars text-sm">★★★★★</div>
                                <span class="text-xs text-gray-500">15:40</span>
                            </div>
                            <div class="flex flex-wrap gap-1 mb-3">
                                <span class="badge badge-sm badge-outline">Hip Hop</span>
                                <span class="badge badge-sm badge-outline">English</span>
                            </div>
                            <button class="btn btn-gradient btn-sm w-full text-white">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM9.555 7.168A1 1 0 008 8v4a1 1 0 001.555.832l3-2a1 1 0 000-1.664l-3-2z" clip-rule="evenodd" />
                                </svg>
                                Watch Now
                            </button>
                        </div>
                    </div>

                    <!-- Video Card 10 -->
                    <div class="media-card rounded-2xl overflow-hidden fade-in">
                        <div class="relative">
                            <img src="https://images.unsplash.com/photo-1459749411175-04bf5292ceea?w=400&h=400&fit=crop" alt="Video Thumbnail" class="media-image">
                            <div class="absolute inset-0 flex items-center justify-center">
                                <div class="bg-white bg-opacity-20 backdrop-blur-sm rounded-full p-4">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-white" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM9.555 7.168A1 1 0 008 8v4a1 1 0 001.555.832l3-2a1 1 0 000-1.664l-3-2z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </div>
                        </div>
                        <div class="p-4">
                            <h3 class="font-bold text-lg mb-1 truncate">Classical Orchestra</h3>
                            <p class="text-gray-400 text-sm mb-2 truncate">by Symphony Hall</p>
                            <div class="flex items-center justify-between mb-3">
                                <div class="stars text-sm">★★★★★</div>
                                <span class="text-xs text-gray-500">1:02:15</span>
                            </div>
                            <div class="flex flex-wrap gap-1 mb-3">
                                <span class="badge badge-sm badge-outline">Classical</span>
                                <span class="badge badge-sm badge-outline">English</span>
                            </div>
                            <button class="btn btn-gradient btn-sm w-full text-white">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM9.555 7.168A1 1 0 008 8v4a1 1 0 001.555.832l3-2a1 1 0 000-1.664l-3-2z" clip-rule="evenodd" />
                                </svg>
                                Watch Now
                            </button>
                        </div>
                    </div>

                    <!-- Video Card 11 -->
                    <div class="media-card rounded-2xl overflow-hidden fade-in">
                        <div class="relative">
                            <img src="https://images.unsplash.com/photo-1506157786151-b8491531f063?w=400&h=400&fit=crop" alt="Video Thumbnail" class="media-image">
                            <div class="absolute inset-0 flex items-center justify-center">
                                <div class="bg-white bg-opacity-20 backdrop-blur-sm rounded-full p-4">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-white" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM9.555 7.168A1 1 0 008 8v4a1 1 0 001.555.832l3-2a1 1 0 000-1.664l-3-2z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </div>
                        </div>
                        <div class="p-4">
                            <h3 class="font-bold text-lg mb-1 truncate">Qawwali Night</h3>
                            <p class="text-gray-400 text-sm mb-2 truncate">by Sufi Masters</p>
                            <div class="flex items-center justify-between mb-3">
                                <div class="stars text-sm">★★★★★</div>
                                <span class="text-xs text-gray-500">48:30</span>
                            </div>
                            <div class="flex flex-wrap gap-1 mb-3">
                                <span class="badge badge-sm badge-outline">Qawwali</span>
                                <span class="badge badge-sm badge-outline">Regional</span>
                            </div>
                            <button class="btn btn-gradient btn-sm w-full text-white">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM9.555 7.168A1 1 0 008 8v4a1 1 0 001.555.832l3-2a1 1 0 000-1.664l-3-2z" clip-rule="evenodd" />
                                </svg>
                                Watch Now
                            </button>
                        </div>
                    </div>

                    <!-- Video Card 12 -->
                    <div class="media-card rounded-2xl overflow-hidden fade-in">
                        <div class="relative">
                            <img src="https://images.unsplash.com/photo-1619983081563-430f63602796?w=400&h=400&fit=crop" alt="Video Thumbnail" class="media-image">
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
                            <h3 class="font-bold text-lg mb-1 truncate">Metal Fest 2024</h3>
                            <p class="text-gray-400 text-sm mb-2 truncate">by Iron Brigade</p>
                            <div class="flex items-center justify-between mb-3">
                                <div class="stars text-sm">★★★★☆</div>
                                <span class="text-xs text-gray-500">55:20</span>
                            </div>
                            <div class="flex flex-wrap gap-1 mb-3">
                                <span class="badge badge-sm badge-outline">Metal</span>
                                <span class="badge badge-sm badge-outline">English</span>
                            </div>
                            <button class="btn btn-gradient btn-sm w-full text-white">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM9.555 7.168A1 1 0 008 8v4a1 1 0 001.555.832l3-2a1 1 0 000-1.664l-3-2z" clip-rule="evenodd" />
                                </svg>
                                Watch Now
                            </button>
                        </div>
                    </div>

                    <!-- Video Card 13 -->
                    <div class="media-card rounded-2xl overflow-hidden fade-in">
                        <div class="relative">
                            <img src="https://images.unsplash.com/photo-1507838153414-b4b713384a76?w=400&h=400&fit=crop" alt="Video Thumbnail" class="media-image">
                            <div class="absolute inset-0 flex items-center justify-center">
                                <div class="bg-white bg-opacity-20 backdrop-blur-sm rounded-full p-4">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-white" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM9.555 7.168A1 1 0 008 8v4a1 1 0 001.555.832l3-2a1 1 0 000-1.664l-3-2z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </div>
                        </div>
                        <div class="p-4">
                            <h3 class="font-bold text-lg mb-1 truncate">Bengali Theatre</h3>
                            <p class="text-gray-400 text-sm mb-2 truncate">by Kolkata Arts</p>
                            <div class="flex items-center justify-between mb-3">
                                <div class="stars text-sm">★★★★☆</div>
                                <span class="text-xs text-gray-500">42:15</span>
                            </div>
                            <div class="flex flex-wrap gap-1 mb-3">
                                <span class="badge badge-sm badge-outline">Theatre</span>
                                <span class="badge badge-sm badge-outline">Bengali</span>
                            </div>
                            <button class="btn btn-gradient btn-sm w-full text-white">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM9.555 7.168A1 1 0 008 8v4a1 1 0 001.555.832l3-2a1 1 0 000-1.664l-3-2z" clip-rule="evenodd" />
                                </svg>
                                Watch Now
                            </button>
                        </div>
                    </div>

                    <!-- Video Card 14 -->
                    <div class="media-card rounded-2xl overflow-hidden fade-in">
                        <div class="relative">
                            <img src="https://images.unsplash.com/photo-1510915361894-db8b60106cb1?w=400&h=400&fit=crop" alt="Video Thumbnail" class="media-image">
                            <div class="absolute inset-0 flex items-center justify-center">
                                <div class="bg-white bg-opacity-20 backdrop-blur-sm rounded-full p-4">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-white" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM9.555 7.168A1 1 0 008 8v4a1 1 0 001.555.832l3-2a1 1 0 000-1.664l-3-2z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </div>
                        </div>
                        <div class="p-4">
                            <h3 class="font-bold text-lg mb-1 truncate">EDM Festival</h3>
                            <p class="text-gray-400 text-sm mb-2 truncate">by DJ Horizon</p>
                            <div class="flex items-center justify-between mb-3">
                                <div class="stars text-sm">★★★★★</div>
                                <span class="text-xs text-gray-500">1:15:30</span>
                            </div>
                            <div class="flex flex-wrap gap-1 mb-3">
                                <span class="badge badge-sm badge-outline">EDM</span>
                                <span class="badge badge-sm badge-outline">English</span>
                            </div>
                            <button class="btn btn-gradient btn-sm w-full text-white">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM9.555 7.168A1 1 0 008 8v4a1 1 0 001.555.832l3-2a1 1 0 000-1.664l-3-2z" clip-rule="evenodd" />
                                </svg>
                                Watch Now
                            </button>
                        </div>
                    </div>

                    <!-- Video Card 15 -->
                    <div class="media-card rounded-2xl overflow-hidden fade-in">
                        <div class="relative">
                            <img src="https://images.unsplash.com/photo-1477233534935-f5e6fe7c1159?w=400&h=400&fit=crop" alt="Video Thumbnail" class="media-image">
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
                            <h3 class="font-bold text-lg mb-1 truncate">Marathi Folk</h3>
                            <p class="text-gray-400 text-sm mb-2 truncate">by Traditional Artists</p>
                            <div class="flex items-center justify-between mb-3">
                                <div class="stars text-sm">★★★★★</div>
                                <span class="text-xs text-gray-500">32:40</span>
                            </div>
                            <div class="flex flex-wrap gap-1 mb-3">
                                <span class="badge badge-sm badge-outline">Folk</span>
                                <span class="badge badge-sm badge-outline">Marathi</span>
                            </div>
                            <button class="btn btn-gradient btn-sm w-full text-white">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM9.555 7.168A1 1 0 008 8v4a1 1 0 001.555.832l3-2a1 1 0 000-1.664l-3-2z" clip-rule="evenodd" />
                                </svg>
                                Watch Now
                            </button>
                        </div>
                    </div>

                    <!-- Video Card 16 -->
                    <div class="media-card rounded-2xl overflow-hidden fade-in">
                        <div class="relative">
                            <img src="https://images.unsplash.com/photo-1470225620780-dba8ba36b745?w=400&h=400&fit=crop" alt="Video Thumbnail" class="media-image">
                            <div class="absolute inset-0 flex items-center justify-center">
                                <div class="bg-white bg-opacity-20 backdrop-blur-sm rounded-full p-4">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-white" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM9.555 7.168A1 1 0 008 8v4a1 1 0 001.555.832l3-2a1 1 0 000-1.664l-3-2z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </div>
                        </div>
                        <div class="p-4">
                            <h3 class="font-bold text-lg mb-1 truncate">Indie Rock Show</h3>
                            <p class="text-gray-400 text-sm mb-2 truncate">by Underground Sounds</p>
                            <div class="flex items-center justify-between mb-3">
                                <div class="stars text-sm">★★★★☆</div>
                                <span class="text-xs text-gray-500">38:55</span>
                            </div>
                            <div class="flex flex-wrap gap-1 mb-3">
                                <span class="badge badge-sm badge-outline">Indie</span>
                                <span class="badge badge-sm badge-outline">English</span>
                            </div>
                            <button class="btn btn-gradient btn-sm w-full text-white">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM9.555 7.168A1 1 0 008 8v4a1 1 0 001.555.832l3-2a1 1 0 000-1.664l-3-2z" clip-rule="evenodd" />
                                </svg>
                                Watch Now
                            </button>
                        </div>
                    </div>

                    <!-- Video Card 17 -->
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
                            <h3 class="font-bold text-lg mb-1 truncate">Telugu Music Video</h3>
                            <p class="text-gray-400 text-sm mb-2 truncate">by South Stars</p>
                            <div class="flex items-center justify-between mb-3">
                                <div class="stars text-sm">★★★★★</div>
                                <span class="text-xs text-gray-500">25:10</span>
                            </div>
                            <div class="flex flex-wrap gap-1 mb-3">
                                <span class="badge badge-sm badge-outline">Pop</span>
                                <span class="badge badge-sm badge-outline">Telugu</span>
                            </div>
                            <button class="btn btn-gradient btn-sm w-full text-white">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM9.555 7.168A1 1 0 008 8v4a1 1 0 001.555.832l3-2a1 1 0 000-1.664l-3-2z" clip-rule="evenodd" />
                                </svg>
                                Watch Now
                            </button>
                        </div>
                    </div>

                    <!-- Video Card 18 -->
                    <div class="media-card rounded-2xl overflow-hidden fade-in">
                        <div class="relative">
                            <img src="https://images.unsplash.com/photo-1598388993281-cecf8b71a8f8?w=400&h=400&fit=crop" alt="Video Thumbnail" class="media-image">
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
                            <h3 class="font-bold text-lg mb-1 truncate">Fusion Beats</h3>
                            <p class="text-gray-400 text-sm mb-2 truncate">by Global Artists</p>
                            <div class="flex items-center justify-between mb-3">
                                <div class="stars text-sm">★★★★☆</div>
                                <span class="text-xs text-gray-500">20:30</span>
                            </div>
                            <div class="flex flex-wrap gap-1 mb-3">
                                <span class="badge badge-sm badge-outline">Fusion</span>
                                <span class="badge badge-sm badge-outline">Multi</span>
                            </div>
                            <button class="btn btn-gradient btn-sm w-full text-white">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM9.555 7.168A1 1 0 008 8v4a1 1 0 001.555.832l3-2a1 1 0 000-1.664l-3-2z" clip-rule="evenodd" />
                                </svg>
                                Watch Now
                            </button>
                        </div>
                    </div>

                    <!-- Video Card 19 -->
                    <div class="media-card rounded-2xl overflow-hidden fade-in">
                        <div class="relative">
                            <img src="https://images.unsplash.com/photo-1514320291840-2e0a9bf2a9ae?w=400&h=400&fit=crop" alt="Video Thumbnail" class="media-image">
                            <div class="absolute inset-0 flex items-center justify-center">
                                <div class="bg-white bg-opacity-20 backdrop-blur-sm rounded-full p-4">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-white" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM9.555 7.168A1 1 0 008 8v4a1 1 0 001.555.832l3-2a1 1 0 000-1.664l-3-2z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </div>
                        </div>
                        <div class="p-4">
                            <h3 class="font-bold text-lg mb-1 truncate">Country Music Live</h3>
                            <p class="text-gray-400 text-sm mb-2 truncate">by Nashville Crew</p>
                            <div class="flex items-center justify-between mb-3">
                                <div class="stars text-sm">★★★★☆</div>
                                <span class="text-xs text-gray-500">44:20</span>
                            </div>
                            <div class="flex flex-wrap gap-1 mb-3">
                                <span class="badge badge-sm badge-outline">Country</span>
                                <span class="badge badge-sm badge-outline">English</span>
                            </div>
                            <button class="btn btn-gradient btn-sm w-full text-white">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM9.555 7.168A1 1 0 008 8v4a1 1 0 001.555.832l3-2a1 1 0 000-1.664l-3-2z" clip-rule="evenodd" />
                                </svg>
                                Watch Now
                            </button>
                        </div>
                    </div>

                    <!-- Video Card 20 -->
                    <div class="media-card rounded-2xl overflow-hidden fade-in">
                        <div class="relative">
                            <img src="https://images.unsplash.com/photo-1511671782779-c97d3d27a1d4?w=400&h=400&fit=crop" alt="Video Thumbnail" class="media-image">
                            <div class="absolute inset-0 flex items-center justify-center">
                                <div class="bg-white bg-opacity-20 backdrop-blur-sm rounded-full p-4">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-white" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM9.555 7.168A1 1 0 008 8v4a1 1 0 001.555.832l3-2a1 1 0 000-1.664l-3-2z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </div>
                        </div>
                        <div class="p-4">
                            <h3 class="font-bold text-lg mb-1 truncate">Unplugged Sessions</h3>
                            <p class="text-gray-400 text-sm mb-2 truncate">by Acoustic Legends</p>
                            <div class="flex items-center justify-between mb-3">
                                <div class="stars text-sm">★★★★★</div>
                                <span class="text-xs text-gray-500">36:45</span>
                            </div>
                            <div class="flex flex-wrap gap-1 mb-3">
                                <span class="badge badge-sm badge-outline">Acoustic</span>
                                <span class="badge badge-sm badge-outline">English</span>
                            </div>
                            <button class="btn btn-gradient btn-sm w-full text-white">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM9.555 7.168A1 1 0 008 8v4a1 1 0 001.555.832l3-2a1 1 0 000-1.664l-3-2z" clip-rule="evenodd" />
                                </svg>
                                Watch Now
                            </button>
                        </div>
                    </div>
                </div>
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