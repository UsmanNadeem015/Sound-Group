<!DOCTYPE html>
<html lang="en" data-theme="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
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
            <!-- Search Bar -->
            <div class="mb-8">
                <form action="{{ route('videos') }}" method="GET" class="max-w-2xl mx-auto">
                    <div class="relative">
                        <input 
                            type="text" 
                            name="search" 
                            id="videoSearch"
                            value="{{ request('search') }}"
                            placeholder="Search videos by title, artist, album, year, or genre..." 
                            class="w-full pl-12 pr-4 py-3 bg-gray-900 border border-gray-700 rounded-full text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all"
                        >
                        <div class="absolute left-4 top-1/2 transform -translate-y-1/2 text-gray-400">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                        </div>
                        @if(request('search'))
                        <a href="{{ route('videos') }}" class="absolute right-4 top-1/2 transform -translate-y-1/2 text-gray-400 hover:text-white">
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
                        <a href="{{ route('videos') }}" class="px-4 py-2 bg-gray-700 text-white rounded-full text-sm font-semibold hover:bg-gray-600 transition-colors">
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
                    
                    <a href="{{ route('videos') }}{{ $currentSearch ? '?search=' . $currentSearch : '' }}" 
                       class="filter-btn {{ !$currentCategory ? 'active' : '' }} px-4 py-2 rounded-full text-sm font-semibold">
                        All
                    </a>
                    <a href="{{ route('videos') }}?category=album{{ $currentSearch ? '&search=' . $currentSearch : '' }}" 
                       class="filter-btn {{ $currentCategory == 'album' ? 'active' : '' }} px-4 py-2 rounded-full text-sm font-semibold">
                        Album
                    </a>
                    <a href="{{ route('videos') }}?category=artist{{ $currentSearch ? '&search=' . $currentSearch : '' }}" 
                       class="filter-btn {{ $currentCategory == 'artist' ? 'active' : '' }} px-4 py-2 rounded-full text-sm font-semibold">
                        Artist
                    </a>
                    <a href="{{ route('videos') }}?category=year{{ $currentSearch ? '&search=' . $currentSearch : '' }}" 
                       class="filter-btn {{ $currentCategory == 'year' ? 'active' : '' }} px-4 py-2 rounded-full text-sm font-semibold">
                        Year
                    </a>
                    <a href="{{ route('videos') }}?category=genre{{ $currentSearch ? '&search=' . $currentSearch : '' }}" 
                       class="filter-btn {{ $currentCategory == 'genre' ? 'active' : '' }} px-4 py-2 rounded-full text-sm font-semibold">
                        Genre
                    </a>
                    <a href="{{ route('videos') }}?category=language{{ $currentSearch ? '&search=' . $currentSearch : '' }}" 
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
<!-- Filter Section end -->


<!-- Video Grid start -->
<section class="py-8 pb-16">
    <div class="container mx-auto px-4">
        @if(request('search') && $videos->isEmpty())
        <div class="text-center py-12">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 mx-auto text-gray-600 mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            <p class="text-xl text-gray-400 mb-2">No results found for "{{ request('search') }}"</p>
            <p class="text-gray-500">Try different keywords or browse all videos.</p>
            <a href="{{ route('videos') }}" class="mt-4 inline-block px-6 py-2 bg-gradient-to-r from-purple-600 to-pink-600 text-white rounded-full text-sm font-semibold hover:opacity-90 transition-opacity">
                View All Videos
            </a>
        </div>
        @endif
        
        @if($videos->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                @foreach($videos as $video)
                    <div class="media-card rounded-2xl overflow-hidden fade-in" data-video-id="{{ $video->id }}">
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
                            <!-- <div class="absolute inset-0 flex items-center justify-center opacity-0 hover:opacity-100 transition-opacity duration-300">
                                <div class="bg-white bg-opacity-20 backdrop-blur-sm rounded-full p-4">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-white" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM9.555 7.168A1 1 0 008 8v4a1 1 0 001.555.832l3-2a1 1 0 000-1.664l-3-2z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </div> -->
                        </div>
                        <div class="p-4">
                            <h3 class="font-bold text-lg mb-1 truncate">{{ $video->title }}</h3>
                            <p class="text-gray-400 text-sm mb-2 truncate">by {{ $video->artist }}</p>
                            <p class="text-xs text-gray-400 mb-2">
                                Album: {{ $video->album ?? 'Unknown' }} | 
                                Duration: {{ $video->duration ?? 'N/A' }}
                            </p>
                            <div class="flex items-center justify-between mb-3">
                                <div class="stars text-sm text-yellow-400">
                                    {{ str_repeat('★', $video->average_rating) }}{{ str_repeat('☆', 5 - $video->average_rating) }}
                                </div>
                                <span class="text-xs text-gray-500">{{ $video->year ?? 'N/A' }}</span>
                            </div>
                            <div class="flex flex-wrap gap-1 mb-3">
                                @if($video->genre)
                                    <span class="badge badge-sm badge-outline border-purple-500 text-purple-400">{{ $video->genre }}</span>
                                @endif
                                @if($video->language)
                                    <span class="badge badge-sm badge-outline border-pink-500 text-pink-400">{{ $video->language }}</span>
                                @endif
                            </div>
<!-- Rating Section -->
<div class="mb-4 pb-4 border-t border-gray-800 mt-4 pt-4">
    <p class="text-sm text-gray-500 mb-2 uppercase tracking-widest">
        @if($video->user_rating)
            <span class="flex items-center justify-between">
                <span>Your Rating: {{ $video->user_rating }} ★</span>
                <button type="button" class="edit-rating-btn text-xs text-purple-400 hover:text-purple-300">
                    (Change)
                </button>
            </span>
        @else
            Your Rating
        @endif
    </p>
    <div class="star-rating flex gap-2" data-current-rating="{{ $video->user_rating ?? 0 }}">
        @for($i = 1; $i <= 5; $i++)
            <button type="button" class="star-btn {{ $video->user_rating && $i <= $video->user_rating ? 'active' : '' }}" 
                    data-value="{{ $i }}" 
                    data-has-rating="{{ $video->user_rating ? 'true' : 'false' }}">
                ★
            </button>
        @endfor
    </div>
    <p class="status-msg text-xs mt-2"></p>
    @if($video->user_rating)
    <p class="text-xs text-gray-500 mt-1">
        <button type="button" class="remove-rating-btn text-red-400 hover:text-red-300">
            Remove rating
        </button>
    </p>
    @endif
</div>

<!-- Review Section -->
<div class="mb-4">
    @if($video->user_review)
        <!-- Show existing review with edit option -->
        <div class="existing-review bg-gray-900 rounded-lg p-3 mb-3" 
             data-review-id="{{ $video->user_review->id }}">
            <div class="flex justify-between items-start mb-2">
                <span class="font-medium text-sm text-gray-300">Your Review</span>
                <div class="flex space-x-2">
                    @if($video->user_review->can_edit)
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
            <p class="text-sm text-gray-400 review-text">{{ $video->user_review->review_text }}</p>
            @if($video->user_review->edited_at)
                <p class="text-xs text-gray-500 mt-2">
                    Edited {{ $video->user_review->edited_at->diffForHumans() }}
                    @if($video->user_review->can_edit)
                        (Can edit for {{ $video->user_review->remaining_edit_time }} more hours)
                    @endif
                </p>
            @elseif($video->user_review->can_edit)
                <p class="text-xs text-gray-500 mt-2">
                    Can edit for {{ $video->user_review->remaining_edit_time }} more hours
                </p>
            @endif
        </div>
        
        <!-- Edit Review Form (Hidden by default) -->
        <div class="edit-review-form hidden">
            <textarea class="review-comment w-full bg-gray-900 border border-gray-700 rounded-lg p-2 text-sm" 
                      placeholder="Edit your review..." 
                      rows="3">{{ $video->user_review->review_text }}</textarea>
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
                            
                            <!-- Approved Reviews Section -->
                            @php
                                // Get approved reviews for this video
                                $approvedReviews = $video->reviews()
                                    ->where('is_approved', true)
                                    ->with('user')
                                    ->orderBy('created_at', 'desc')
                                    ->take(3) // Show last 3 reviews
                                    ->get();
                            @endphp

                            @if($approvedReviews->count() > 0)
                                <div class="mt-4 pt-4 border-t border-gray-800">
                                    <h4 class="font-semibold mb-2 text-sm text-gray-300">User Reviews</h4>
                                    <div class="space-y-2 max-h-40 overflow-y-auto pr-2">
                                        @foreach($approvedReviews as $review)
                                            <div class="bg-gray-900 rounded p-2">
                                                <div class="flex justify-between items-start mb-1">
                                                    <span class="font-medium text-xs text-gray-300">
                                                        {{ $review->user->name ?? 'Anonymous' }}
                                                    </span>
                                                    <span class="text-xs text-gray-500">
                                                        {{ $review->created_at->format('M d') }}
                                                    </span>
                                                </div>
                                                <p class="text-xs text-gray-400 truncate">{{ $review->review_text }}</p>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            @endif

                            <a href="{{ asset('storage/' . $video->file_path) }}" target="_blank" class="btn btn-gradient btn-sm w-full text-white hover:scale-105 transition-transform mt-4">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM9.555 7.168A1 1 0 008 8v4a1 1 0 001.555.832l3-2a1 1 0 000-1.664l-3-2z" clip-rule="evenodd" />
                                </svg>
                                Watch Now
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
            
            @if($videos->hasPages())
            <div class="mt-8">
                {{ $videos->withQueryString()->links() }}
            </div>
            @endif
            
        @elseif(!request('search'))
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

    // Rating and Review System with Edit Functionality for Videos
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

        document.querySelectorAll('.media-card[data-video-id]').forEach(card => {
            const videoId = card.dataset.videoId;
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
                        
                        const response = await fetch(`/ratings/video/${videoId}`, {
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
                        const response = await fetch(`/ratings/video/${videoId}`, {
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
                        const response = await fetch(`/reviews/video/${videoId}`, {
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
                        const response = await fetch(`/reviews/video/${videoId}`, {
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
        const searchInput = document.getElementById('videoSearch');
        if (searchInput && searchInput.value) {
            searchInput.focus();
            searchInput.select();
        }
    });
</script>
</body>
</html>