<!DOCTYPE html>
<html lang="en" data-theme="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
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
            <!-- Search Bar -->
            <div class="mb-8">
                <form action="{{ route('music') }}" method="GET" class="max-w-2xl mx-auto">
                    <div class="relative">
                        <input 
                            type="text" 
                            name="search" 
                            id="musicSearch"
                            value="{{ request('search') }}"
                            placeholder="Search music by title, artist, album, year, or genre..." 
                            class="w-full pl-12 pr-4 py-3 bg-gray-900 border border-gray-700 rounded-full text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all"
                        >
                        <div class="absolute left-4 top-1/2 transform -translate-y-1/2 text-gray-400">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                        </div>
                        @if(request('search'))
                        <a href="{{ route('music') }}" class="absolute right-4 top-1/2 transform -translate-y-1/2 text-gray-400 hover:text-white">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </a>
                        @endif
                    </div>
                    <div class="mt-3 flex flex-wrap gap-2 justify-center">
                        <button type="submit" class="px-4 py-2 bg-gradient-to-r from-purple-600 to-pink-600 text-white rounded-full text-sm font-semibold hover:opacity-90 transition-opacity">
                            Search
                        </button>
                        @if(request('search') || request('category'))
                        <a href="{{ route('music') }}" class="px-4 py-2 bg-gray-700 text-white rounded-full text-sm font-semibold hover:bg-gray-600 transition-colors">
                            Clear All
                        </a>
                        @endif
                    </div>
                </form>
            </div>

            <!-- Filter by Category -->
            <div class="text-center">
                <h3 class="text-lg font-semibold mb-4">Filter by Category</h3>
                <div class="flex flex-wrap gap-2 justify-center">
                    @php
                        $currentCategory = request('category');
                        $currentSearch = request('search');
                    @endphp
                    
                    <a href="{{ route('music') }}{{ $currentSearch ? '?search=' . $currentSearch : '' }}" 
                       class="filter-btn {{ !$currentCategory ? 'active' : '' }} px-4 py-2 rounded-full text-sm font-semibold">
                        All
                    </a>
                    <a href="{{ route('music') }}?category=album{{ $currentSearch ? '&search=' . $currentSearch : '' }}" 
                       class="filter-btn {{ $currentCategory == 'album' ? 'active' : '' }} px-4 py-2 rounded-full text-sm font-semibold">
                        Album
                    </a>
                    <a href="{{ route('music') }}?category=artist{{ $currentSearch ? '&search=' . $currentSearch : '' }}" 
                       class="filter-btn {{ $currentCategory == 'artist' ? 'active' : '' }} px-4 py-2 rounded-full text-sm font-semibold">
                        Artist
                    </a>
                    <a href="{{ route('music') }}?category=year{{ $currentSearch ? '&search=' . $currentSearch : '' }}" 
                       class="filter-btn {{ $currentCategory == 'year' ? 'active' : '' }} px-4 py-2 rounded-full text-sm font-semibold">
                        Year
                    </a>
                    <a href="{{ route('music') }}?category=genre{{ $currentSearch ? '&search=' . $currentSearch : '' }}" 
                       class="filter-btn {{ $currentCategory == 'genre' ? 'active' : '' }} px-4 py-2 rounded-full text-sm font-semibold">
                        Genre
                    </a>
                    <a href="{{ route('music') }}?category=language{{ $currentSearch ? '&search=' . $currentSearch : '' }}" 
                       class="filter-btn {{ $currentCategory == 'language' ? 'active' : '' }} px-4 py-2 rounded-full text-sm font-semibold">
                        Language
                    </a>
                </div>
                
                @if(request('search') || request('category'))
                <div class="mt-4">
                    <p class="text-gray-400 text-sm">
                        @if(request('search') && request('category'))
                            Showing results for "{{ request('search') }}" in {{ ucfirst(request('category')) }} category
                        @elseif(request('search'))
                            Showing results for "{{ request('search') }}"
                        @elseif(request('category'))
                            Showing {{ ucfirst(request('category')) }} category
                        @endif
                    </p>
                </div>
                @endif
            </div>
        </div>
    </div>
</section>
<!-- Filter and Sort Section end -->

<!-- Music Grid start -->
<section class="container mx-auto px-4 mb-16">
    @if(request('search') && $music->isEmpty())
    <div class="text-center py-12">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 mx-auto text-gray-600 mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
        </svg>
        <p class="text-xl text-gray-400 mb-2">No results found for "{{ request('search') }}"</p>
        <p class="text-gray-500">Try different keywords or browse all music.</p>
        <a href="{{ route('music') }}" class="mt-4 inline-block px-6 py-2 bg-gradient-to-r from-purple-600 to-pink-600 text-white rounded-full text-sm font-semibold hover:opacity-90 transition-opacity">
            View All Music
        </a>
    </div>
    @endif
    
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
        @forelse ($music as $song)
            <div class="media-card rounded-2xl overflow-hidden fade-in" data-music-id="{{ $song->id }}">
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
                    
                    <!-- Rating Section (From Friend's Version) -->
                    <div class="mb-4 pb-4 border-t border-gray-800 mt-4 pt-4">
                        <p class="text-sm text-gray-500 mb-2 uppercase tracking-widest">Your Rating</p>
                        <div class="star-rating flex gap-2">
                            <button type="button" class="star-btn" data-value="1">★</button>
                            <button type="button" class="star-btn" data-value="2">★</button>
                            <button type="button" class="star-btn" data-value="3">★</button>
                            <button type="button" class="star-btn" data-value="4">★</button>
                            <button type="button" class="star-btn" data-value="5">★</button>
                        </div>
                        <p class="status-msg text-xs mt-2"></p>
                    </div>

                    <!-- Review Section (From Friend's Version) -->
                    <div class="mb-4">
                        <textarea class="review-comment w-full bg-gray-900 border border-gray-700 rounded-lg p-2 text-sm" placeholder="Write your thoughts..." rows="2"></textarea>
                        <button type="button" class="submit-review btn btn-gradient btn-sm mt-3 w-full">
                            Post Review
                        </button>
                    </div>

                    <!-- Approved Reviews Section - PUT IT HERE -->
                    @php
                        // Get approved reviews for this music
                        $approvedReviews = $song->reviews()
                            ->where('is_approved', true)
                            ->with('user')
                            ->orderBy('created_at', 'desc')
                            ->take(5) // Show last 5 reviews
                            ->get();
                    @endphp

                    @if($approvedReviews->count() > 0)
                        <div class="mt-6 pt-6 border-t border-gray-800">
                            <h4 class="font-semibold mb-3 text-gray-300">User Reviews</h4>
                            <div class="space-y-3 max-h-60 overflow-y-auto pr-2">
                                @foreach($approvedReviews as $review)
                                    <div class="bg-gray-900 rounded-lg p-3">
                                        <div class="flex justify-between items-start mb-1">
                                            <span class="font-medium text-sm text-gray-300">
                                                {{ $review->user->name ?? 'Anonymous' }}
                                            </span>
                                            <span class="text-xs text-gray-500">
                                                {{ $review->created_at->format('M d, Y') }}
                                            </span>
                                        </div>
                                        <p class="text-sm text-gray-400">{{ $review->review_text }}</p>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    <button class="btn btn-gradient btn-sm w-full text-white hover:scale-105 transition-transform mt-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1 inline" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM9.555 7.168A1 1 0 008 8v4a1 1 0 001.555.832l3-2a1 1 0 000-1.664l-3-2z" clip-rule="evenodd" />
                        </svg>
                        Play Now
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
    
    @if($music->hasPages())
    <div class="mt-8">
        {{ $music->withQueryString()->links() }}
    </div>
    @endif
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

    // Smooth scroll animation
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

    // Rating and Review System - FINAL WORKING VERSION
    document.addEventListener('DOMContentLoaded', function() {
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        
        // Add CSS for better interaction
        const style = document.createElement('style');
        style.textContent = `
            .star-btn {
                cursor: pointer;
                transition: all 0.2s;
                font-size: 1.25rem;
            }
            .star-btn:hover {
                transform: scale(1.2);
                color: #fbbf24;
            }
            .star-btn.active {
                color: #fbbf24;
            }
            .submit-review {
                cursor: pointer;
                transition: all 0.3s;
            }
            .submit-review:hover {
                transform: translateY(-2px);
            }
            .review-comment {
                resize: vertical;
                transition: border-color 0.3s;
            }
            .review-comment:focus {
                border-color: rgba(102, 126, 234, 0.5);
                outline: none;
            }
            .status-msg {
                min-height: 1.25rem;
            }
            .status-msg.success {
                color: #10b981;
            }
            .status-msg.error {
                color: #f5576c;
            }
            .status-msg.warning {
                color: #fbbf24;
            }
        `;
        document.head.appendChild(style);

        document.querySelectorAll('.media-card').forEach(card => {
            const musicId = card.dataset.musicId;
            const statusMsg = card.querySelector('.status-msg');

            // Rating Logic
            card.querySelectorAll('.star-btn').forEach(star => {
                star.addEventListener('click', async function() {
                    const rating = this.dataset.value;

                    // Visual feedback first
                    card.querySelectorAll('.star-btn').forEach(s => {
                        if (s.dataset.value <= rating) {
                            s.classList.add('active');
                            s.style.color = '#fbbf24';
                        } else {
                            s.classList.remove('active');
                            s.style.color = '#6b7280';
                        }
                    });

                    // Show immediate feedback
                    if (statusMsg) {
                        statusMsg.textContent = "Saving rating...";
                        statusMsg.className = 'status-msg';
                    }

                    // Send to backend
                    try {
                        const response = await fetch(`/ratings/music/${musicId}`, {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': csrfToken,
                                'Accept': 'application/json'
                            },
                            body: JSON.stringify({ rating: rating })
                        });

                        const data = await response.json();

                        if (response.ok) {
                            if (statusMsg) {
                                statusMsg.textContent = "Rating saved: " + rating + " Stars!";
                                statusMsg.className = 'status-msg success';
                            }
                        } else {
                            if (statusMsg) {
                                statusMsg.textContent = data.message || "Error saving rating";
                                statusMsg.className = 'status-msg error';
                            }
                        }
                    } catch (error) {
                        if (statusMsg) {
                            statusMsg.textContent = "Please login to rate";
                            statusMsg.className = 'status-msg warning';
                        }
                    }
                });
            });

            // Review Logic
            card.querySelector('.submit-review').addEventListener('click', async function() {
                const comment = card.querySelector('.review-comment').value.trim();
                if (!comment) {
                    alert("Please write something first!");
                    return;
                }

                // Disable button during submission
                this.disabled = true;
                const originalText = this.textContent;
                this.textContent = "Posting...";

                try {
                    const response = await fetch(`/reviews/music/${musicId}`, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': csrfToken,
                            'Accept': 'application/json'
                        },
                        body: JSON.stringify({ review_text: comment })
                    });

                    const data = await response.json();
                    
                    if (response.ok) {
                        alert("Review submitted for approval");
                        card.querySelector('.review-comment').value = '';
                    } else {
                        alert(data.message || "Error submitting review");
                    }
                } catch (error) {
                    alert("Login required to post reviews");
                } finally {
                    // Re-enable button
                    this.disabled = false;
                    this.textContent = originalText;
                }
            });
        });
        
        // Focus search input on page load if it has value
        const searchInput = document.getElementById('musicSearch');
        if (searchInput && searchInput.value) {
            searchInput.focus();
            searchInput.select();
        }
    });
</script>

</body>
</html>