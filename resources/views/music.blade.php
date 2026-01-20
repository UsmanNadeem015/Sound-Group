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
<!-- NavBar start -->
        <x-navbar />
<!-- NavBar end -->

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
                    
<!-- Rating Section -->
<div class="mb-4 pb-4 border-t border-gray-800 mt-4 pt-4">
    <p class="text-sm text-gray-500 mb-2 uppercase tracking-widest">
        @if($song->user_rating)
            <span class="flex items-center justify-between">
                <span>Your Rating: {{ $song->user_rating }} ★</span>
                <button type="button" class="edit-rating-btn text-xs text-purple-400 hover:text-purple-300">
                    (Change)
                </button>
            </span>
        @else
            Your Rating
        @endif
    </p>
    <div class="star-rating flex gap-2" data-current-rating="{{ $song->user_rating ?? 0 }}">
        @for($i = 1; $i <= 5; $i++)
            <button type="button" class="star-btn {{ $song->user_rating && $i <= $song->user_rating ? 'active' : '' }}" 
                    data-value="{{ $i }}" 
                    data-has-rating="{{ $song->user_rating ? 'true' : 'false' }}">
                ★
            </button>
        @endfor
    </div>
    <p class="status-msg text-xs mt-2"></p>
    @if($song->user_rating)
    <p class="text-xs text-gray-500 mt-1">
        <button type="button" class="remove-rating-btn text-red-400 hover:text-red-300">
            Remove rating
        </button>
    </p>
    @endif
</div>

<!-- Review Section -->
<div class="mb-4">
    @if($song->user_review)
        <!-- Show existing review with edit option -->
        <div class="existing-review bg-gray-900 rounded-lg p-3 mb-3" 
             data-review-id="{{ $song->user_review->id }}">
            <div class="flex justify-between items-start mb-2">
                <span class="font-medium text-sm text-gray-300">Your Review</span>
                <div class="flex space-x-2">
                    @if($song->user_review->can_edit)
                        <button type="button" class="edit-review-btn text-xs text-purple-400 hover:text-purple-300">
                            Edit
                        </button>
                    @else
                        <span class="text-xs text-gray-500">Edit expired</span>
                    @endif
                    <button type="button" class="delete-review-btn text-xs text-red-400 hover:text-red-300">
                        Delete
                    </button>
                </div>
            </div>
            <p class="text-sm text-gray-400 review-text">{{ $song->user_review->review_text }}</p>
            @if($song->user_review->edited_at)
                <p class="text-xs text-gray-500 mt-2">
                    Edited {{ $song->user_review->edited_at->diffForHumans() }}
                    @if($song->user_review->can_edit)
                        (Can edit for {{ $song->user_review->remaining_edit_time }} more hours)
                    @endif
                </p>
            @elseif($song->user_review->can_edit)
                <p class="text-xs text-gray-500 mt-2">
                    Can edit for {{ $song->user_review->remaining_edit_time }} more hours
                </p>
            @endif
        </div>
        
        <!-- Edit Review Form (Hidden by default) -->
        <div class="edit-review-form hidden">
            <textarea class="review-comment w-full bg-gray-900 border border-gray-700 rounded-lg p-2 text-sm" 
                      placeholder="Edit your review..." 
                      rows="3">{{ $song->user_review->review_text }}</textarea>
            <div class="flex gap-2 mt-3">
                <button type="button" class="save-review-btn btn btn-gradient btn-sm flex-1">
                    Save Changes
                </button>
                <button type="button" class="cancel-edit-btn btn btn-outline btn-sm flex-1">
                    Cancel
                </button>
            </div>
        </div>
    @else
        <!-- New Review Form -->
        <textarea class="review-comment w-full bg-gray-900 border border-gray-700 rounded-lg p-2 text-sm" 
                  placeholder="Write your thoughts..." rows="3"></textarea>
        <button type="button" class="submit-review btn btn-gradient btn-sm mt-3 w-full">
            Post Review
        </button>
    @endif
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

@if($song->file_path && file_exists(public_path('storage/' . $song->file_path)))
    <button class="play-music-btn btn btn-gradient btn-sm w-full text-white hover:scale-105 transition-transform mt-4" 
            data-audio-url="{{ asset('storage/' . $song->file_path) }}"
            data-music-title="{{ $song->title }}"
            data-music-artist="{{ $song->artist }}">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1 inline" viewBox="0 0 20 20" fill="currentColor">
            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM9.555 7.168A1 1 0 008 8v4a1 1 0 001.555.832l3-2a1 1 0 000-1.664l-3-2z" clip-rule="evenodd" />
        </svg>
        Play Now
    </button>
@else
    <button class="btn btn-gradient btn-sm w-full text-white opacity-50 cursor-not-allowed mt-4" disabled>
        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1 inline" viewBox="0 0 20 20" fill="currentColor">
            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM9.555 7.168A1 1 0 008 8v4a1 1 0 001.555.832l3-2a1 1 0 000-1.664l-3-2z" clip-rule="evenodd" />
        </svg>
        Audio Not Available
    </button>
@endif
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

    // Rating and Review System with Edit Functionality
    document.addEventListener('DOMContentLoaded', function() {
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        
        // Add CSS for better interaction
        const style = document.createElement('style');
        style.textContent = `
            .star-btn {
                cursor: pointer;
                transition: all 0.2s;
                font-size: 1.25rem;
                color: #6b7280;
            }
            .star-btn:hover {
                transform: scale(1.2);
                color: #fbbf24;
            }
            .star-btn.active {
                color: #fbbf24;
            }
            .star-btn.editing {
                animation: pulse 0.5s ease-in-out;
            }
            @keyframes pulse {
                0%, 100% { transform: scale(1); }
                50% { transform: scale(1.3); }
            }
            .submit-review, .save-review-btn {
                cursor: pointer;
                transition: all 0.3s;
            }
            .submit-review:hover, .save-review-btn:hover {
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
                font-size: 0.75rem;
                margin-top: 0.5rem;
                display: block;
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
            .existing-review {
                transition: all 0.3s ease;
            }
            .existing-review.editing {
                opacity: 0.5;
            }
            .edit-disabled {
                opacity: 0.5;
                cursor: not-allowed;
            }
            .edit-review-form.hidden {
                display: none !important;
            }
        `;
        document.head.appendChild(style);

        document.querySelectorAll('.media-card').forEach(card => {
            const musicId = card.dataset.musicId;
            const statusMsg = card.querySelector('.status-msg');
            const starRating = card.querySelector('.star-rating');
            const currentRating = parseInt(starRating?.dataset.currentRating) || 0;

            // RATING LOGIC
            card.querySelectorAll('.star-btn').forEach(star => {
                star.addEventListener('click', async function() {
                    const rating = parseInt(this.dataset.value);
                    const hasExistingRating = this.dataset.hasRating === 'true';

                    // Visual feedback
                    card.querySelectorAll('.star-btn').forEach(s => {
                        const sValue = parseInt(s.dataset.value);
                        if (sValue <= rating) {
                            s.classList.add('active');
                            s.style.color = '#fbbf24';
                            if (hasExistingRating) {
                                s.classList.add('editing');
                                setTimeout(() => s.classList.remove('editing'), 500);
                            }
                        } else {
                            s.classList.remove('active');
                            s.style.color = '#6b7280';
                        }
                    });

                    // Show immediate feedback
                    if (statusMsg) {
                        statusMsg.textContent = hasExistingRating ? "Updating rating..." : "Saving rating...";
                        statusMsg.className = 'status-msg';
                    }

                    try {
                        // Use PUT method for editing, POST for new
                        const method = hasExistingRating ? 'PUT' : 'POST';
                        
                        const response = await fetch(`/ratings/music/${musicId}`, {
                            method: method,
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': csrfToken,
                                'Accept': 'application/json'
                            },
                            body: JSON.stringify({ 
                                rating: rating
                            })
                        });

                        const data = await response.json();

                        if (response.ok) {
                            if (statusMsg) {
                                statusMsg.textContent = hasExistingRating 
                                    ? "Rating updated to " + rating + " stars!" 
                                    : "Rated " + rating + " stars!";
                                statusMsg.className = 'status-msg success';
                            }
                            // Update the hasRating flag
                            star.dataset.hasRating = 'true';
                            card.querySelectorAll('.star-btn').forEach(s => {
                                s.dataset.hasRating = 'true';
                            });
                            // Show remove rating button
                            const removeBtn = card.querySelector('.remove-rating-btn');
                            if (removeBtn) {
                                removeBtn.style.display = 'inline';
                            }
                            // Update rating label
                            const ratingLabel = card.querySelector('.star-rating').previousElementSibling;
                            if (ratingLabel) {
                                const span = ratingLabel.querySelector('span');
                                if (span) {
                                    span.innerHTML = `Your Rating: ${rating} ★`;
                                }
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

            // REMOVE RATING
            const removeRatingBtn = card.querySelector('.remove-rating-btn');
            if (removeRatingBtn) {
                removeRatingBtn.addEventListener('click', async function() {
                    if (!confirm("Are you sure you want to remove your rating?")) return;

                    try {
                        const response = await fetch(`/ratings/music/${musicId}`, {
                            method: 'DELETE',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': csrfToken,
                                'Accept': 'application/json'
                            }
                        });

                        const data = await response.json();

                        if (response.ok) {
                            // Reset stars
                            card.querySelectorAll('.star-btn').forEach(star => {
                                star.classList.remove('active');
                                star.style.color = '#6b7280';
                                star.dataset.hasRating = 'false';
                            });
                            if (statusMsg) {
                                statusMsg.textContent = "Rating removed";
                                statusMsg.className = 'status-msg success';
                            }
                            // Hide remove button
                            this.style.display = 'none';
                            // Update rating label
                            const ratingLabel = card.querySelector('.star-rating').previousElementSibling;
                            if (ratingLabel) {
                                ratingLabel.innerHTML = 'Your Rating';
                            }
                        } else {
                            alert(data.message || "Error removing rating");
                        }
                    } catch (error) {
                        alert("Please login to remove rating");
                    }
                });
            }

            // REVIEW LOGIC
            const submitReviewBtn = card.querySelector('.submit-review');
            const editReviewBtn = card.querySelector('.edit-review-btn');
            const saveReviewBtn = card.querySelector('.save-review-btn');
            const cancelEditBtn = card.querySelector('.cancel-edit-btn');
            const deleteReviewBtn = card.querySelector('.delete-review-btn');
            const existingReview = card.querySelector('.existing-review');
            const editReviewForm = card.querySelector('.edit-review-form');
            const reviewComment = card.querySelector('.review-comment');

            // Submit new review
            if (submitReviewBtn) {
                submitReviewBtn.addEventListener('click', async function() {
                    const comment = reviewComment?.value.trim();
                    if (!comment) {
                        alert("Please write something first!");
                        return;
                    }

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
                            body: JSON.stringify({ 
                                review_text: comment
                            })
                        });

                        const data = await response.json();
                        
                        if (response.ok) {
                            alert("Review submitted for approval");
                            location.reload(); // Reload to show the new review
                        } else {
                            alert(data.message || "Error submitting review");
                        }
                    } catch (error) {
                        alert("Login required to post reviews");
                    } finally {
                        this.disabled = false;
                        this.textContent = originalText;
                    }
                });
            }

            // Edit existing review
            if (editReviewBtn) {
                editReviewBtn.addEventListener('click', function() {
                    const canEdit = !this.classList.contains('edit-disabled');
                    if (!canEdit) {
                        alert("You can only edit your review within 24 hours of posting.");
                        return;
                    }
                    
                    existingReview.classList.add('editing');
                    editReviewForm.classList.remove('hidden');
                    if (reviewComment) {
                        reviewComment.focus();
                    }
                });
            }

            // Save edited review
            if (saveReviewBtn) {
                saveReviewBtn.addEventListener('click', async function() {
                    const comment = reviewComment?.value.trim();
                    if (!comment) {
                        alert("Review cannot be empty!");
                        return;
                    }

                    this.disabled = true;
                    const originalText = this.textContent;
                    this.textContent = "Saving...";

                    try {
                        const reviewId = existingReview?.dataset.reviewId;
                        const response = await fetch(`/reviews/music/${musicId}`, {
                            method: 'PUT',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': csrfToken,
                                'Accept': 'application/json'
                            },
                            body: JSON.stringify({ 
                                review_text: comment
                            })
                        });

                        const data = await response.json();
                        
                        if (response.ok) {
                            alert("Review updated! It will need re-approval.");
                            location.reload(); // Reload to show updated review
                        } else {
                            alert(data.message || "Error updating review");
                        }
                    } catch (error) {
                        alert("Error updating review");
                    } finally {
                        this.disabled = false;
                        this.textContent = originalText;
                    }
                });
            }

            // Cancel edit
            if (cancelEditBtn) {
                cancelEditBtn.addEventListener('click', function() {
                    existingReview.classList.remove('editing');
                    editReviewForm.classList.add('hidden');
                    // Reset textarea to original text
                    if (reviewComment && existingReview) {
                        const reviewText = existingReview.querySelector('.review-text').textContent;
                        reviewComment.value = reviewText;
                    }
                });
            }

            // Delete review
            if (deleteReviewBtn) {
                deleteReviewBtn.addEventListener('click', async function() {
                    if (!confirm("Are you sure you want to delete your review? This action cannot be undone.")) return;

                    try {
                        const reviewId = existingReview?.dataset.reviewId;
                        const response = await fetch(`/reviews/${reviewId}`, {
                            method: 'DELETE',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': csrfToken,
                                'Accept': 'application/json'
                            }
                        });

                        const data = await response.json();
                        
                        if (response.ok) {
                            alert("Review deleted");
                            location.reload(); // Reload to remove the review
                        } else {
                            alert(data.message || "Error deleting review");
                        }
                    } catch (error) {
                        alert("Error deleting review");
                    }
                });
            }
        });
        
        // Focus search input on page load if it has value
        const searchInput = document.getElementById('musicSearch');
        if (searchInput && searchInput.value) {
            searchInput.focus();
            searchInput.select();
        }
    });

    // Music Player Functionality - UPDATED VERSION
    document.addEventListener('DOMContentLoaded', function() {
        // Create audio player element
        const audioPlayer = document.createElement('audio');
        audioPlayer.id = 'global-audio-player';
        audioPlayer.style.display = 'none';
        document.body.appendChild(audioPlayer);
        
        // Create music player UI
        const playerUI = document.createElement('div');
        playerUI.id = 'music-player-ui';
        playerUI.innerHTML = `
            <div class="custom-player-container player-hidden">
                <div class="flex items-center justify-between">
                    <!-- Song Info -->
                    <div class="flex items-center space-x-3 flex-1 min-w-0">
                        <div class="w-10 h-10 bg-gradient-to-br from-purple-600 to-pink-600 rounded-lg flex items-center justify-center flex-shrink-0">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-white" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM9.555 7.168A1 1 0 008 8v4a1 1 0 001.555.832l3-2a1 1 0 000-1.664l-3-2z" clip-rule="evenodd" />
                            </svg>
                        </div>
                        <div class="min-w-0 flex-1">
                            <h4 id="now-playing-title" class="font-semibold text-white text-sm truncate">No song playing</h4>
                            <p id="now-playing-artist" class="text-xs text-gray-400 truncate">Select a song</p>
                        </div>
                    </div>
                    
                    <!-- Controls -->
                    <div class="flex items-center space-x-2 flex-shrink-0">
                        <button id="play-pause-btn" class="p-2 bg-gradient-to-r from-purple-600 to-pink-600 text-white rounded-full hover:opacity-90">
                            <!-- Play Icon (Visible by default) -->
                            <svg id="play-icon" class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM9.555 7.168A1 1 0 008 8v4a1 1 0 001.555.832l3-2a1 1 0 000-1.664l-3-2z" clip-rule="evenodd" />
                            </svg>
                            <!-- Pause Icon (Hidden by default) -->
                            <svg id="pause-icon" class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" style="display: none;">
                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zM7 8a1 1 0 012 0v4a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v4a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" />
                            </svg>
                        </button>
                        
                        <button id="close-player-btn" class="p-1 text-gray-400 hover:text-white">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>
                </div>
                
                <!-- Progress Bar -->
                <div class="mt-2">
                    <div class="flex items-center space-x-2">
                        <span class="text-xs text-gray-400 flex-shrink-0" id="current-time">0:00</span>
                        <input type="range" id="seek-slider" min="0" max="100" value="0" class="flex-1 h-1.5 bg-gray-700 rounded-lg appearance-none cursor-pointer">
                        <span class="text-xs text-gray-400 flex-shrink-0" id="duration">0:00</span>
                    </div>
                </div>
            </div>
        `;
        document.body.appendChild(playerUI);
        
        // Get DOM elements
        const playerContainer = document.querySelector('.custom-player-container');
        const playPauseBtn = document.getElementById('play-pause-btn');
        const playIcon = document.getElementById('play-icon');
        const pauseIcon = document.getElementById('pause-icon');
        const closePlayerBtn = document.getElementById('close-player-btn');
        const seekSlider = document.getElementById('seek-slider');
        const currentTimeEl = document.getElementById('current-time');
        const durationEl = document.getElementById('duration');
        const nowPlayingTitle = document.getElementById('now-playing-title');
        const nowPlayingArtist = document.getElementById('now-playing-artist');
        
        // Store current playing music
        let currentAudioUrl = '';
        let isPlaying = false;
        let playerVisible = false;
        
        // Format time (seconds to MM:SS)
        function formatTime(seconds) {
            if (isNaN(seconds)) return "0:00";
            const mins = Math.floor(seconds / 60);
            const secs = Math.floor(seconds % 60);
            return `${mins}:${secs < 10 ? '0' : ''}${secs}`;
        }
        
        // Update time display
        function updateTime() {
            if (audioPlayer.duration && !isNaN(audioPlayer.duration)) {
                currentTimeEl.textContent = formatTime(audioPlayer.currentTime);
                durationEl.textContent = formatTime(audioPlayer.duration);
                
                const progress = (audioPlayer.currentTime / audioPlayer.duration) * 100;
                seekSlider.value = progress || 0;
            } else {
                currentTimeEl.textContent = "0:00";
                durationEl.textContent = "0:00";
            }
        }
        
        // Show/hide player - ONLY SHOW WHEN SONG IS PLAYING
        function showPlayer() {
            if (currentAudioUrl && isPlaying) {
                playerContainer.classList.remove('player-hidden');
                playerVisible = true;
            }
        }
        
        function hidePlayer() {
            playerContainer.classList.add('player-hidden');
            playerVisible = false;
            isPlaying = false;
            showPlayIcon();
        }
        
        // Toggle play/pause icons
        function showPlayIcon() {
            playIcon.style.display = 'block';
            pauseIcon.style.display = 'none';
        }
        
        function showPauseIcon() {
            playIcon.style.display = 'none';
            pauseIcon.style.display = 'block';
        }
        
        // Play music - ONLY SHOW PLAYER WHEN SONG STARTS PLAYING
        function playMusic(audioUrl, title, artist) {
            if (currentAudioUrl !== audioUrl) {
                audioPlayer.src = audioUrl;
                currentAudioUrl = audioUrl;
                nowPlayingTitle.textContent = title;
                nowPlayingArtist.textContent = artist;
            }
            
            audioPlayer.play()
                .then(() => {
                    isPlaying = true;
                    showPauseIcon();
                    showPlayer(); // Show player when song starts
                })
                .catch(error => {
                    console.error('Error playing audio:', error);
                    alert('Error playing audio. Please check if the file exists.');
                });
        }
        
        // Toggle play/pause
        function togglePlayPause() {
            if (!currentAudioUrl) return;
            
            if (isPlaying) {
                audioPlayer.pause();
                showPlayIcon();
                // Keep player visible even when paused
            } else {
                audioPlayer.play();
                showPauseIcon();
                showPlayer();
            }
            isPlaying = !isPlaying;
        }
        
        // Event listeners for play buttons
        document.querySelectorAll('.play-music-btn').forEach(button => {
            button.addEventListener('click', function() {
                const audioUrl = this.getAttribute('data-audio-url');
                const title = this.getAttribute('data-music-title');
                const artist = this.getAttribute('data-music-artist');
                playMusic(audioUrl, title, artist);
            });
        });
        
        // Audio player events
        audioPlayer.addEventListener('timeupdate', updateTime);
        audioPlayer.addEventListener('loadedmetadata', updateTime);
        audioPlayer.addEventListener('ended', function() {
            isPlaying = false;
            showPlayIcon();
        });
        
        // Player controls
        playPauseBtn.addEventListener('click', togglePlayPause);
        
        closePlayerBtn.addEventListener('click', function() {
            audioPlayer.pause();
            currentAudioUrl = ''; // Clear current audio
            hidePlayer(); // Hide player when closed
        });
        
        // Seek functionality
        seekSlider.addEventListener('input', function() {
            if (audioPlayer.duration && !isNaN(audioPlayer.duration)) {
                const seekTime = (this.value / 100) * audioPlayer.duration;
                audioPlayer.currentTime = seekTime;
            }
        });
        
        // FIX: Prevent space bar from pausing music when typing in textareas
        document.addEventListener('keydown', function(e) {
            // Check if user is typing in a textarea or input field
            const activeElement = document.activeElement;
            const isTyping = activeElement.tagName === 'TEXTAREA' || 
                             activeElement.tagName === 'INPUT' ||
                             activeElement.isContentEditable;
            
            // Only handle space bar for music control if NOT typing
            if (e.code === 'Space' && currentAudioUrl && !isTyping) {
                e.preventDefault();
                togglePlayPause();
            }
            
            // Left/Right arrow for seek - only if not typing
            if (!isTyping && currentAudioUrl) {
                if (e.code === 'ArrowLeft') {
                    e.preventDefault();
                    audioPlayer.currentTime = Math.max(0, audioPlayer.currentTime - 5);
                }
                
                if (e.code === 'ArrowRight') {
                    e.preventDefault();
                    audioPlayer.currentTime = Math.min(audioPlayer.duration, audioPlayer.currentTime + 5);
                }
            }
        });
        
        // Initialize - player starts hidden
        hidePlayer();
        showPlayIcon();
    });
</script>
</body>
</html>