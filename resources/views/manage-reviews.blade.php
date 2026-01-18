<!DOCTYPE html>
<html lang="en" data-theme="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Reviews - Admin Panel</title>
    <link href="https://cdn.jsdelivr.net/npm/daisyui@4.4.19/dist/full.min.css" rel="stylesheet" type="text/css" />
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
</head>
<body class="bg-gray-900 text-white">
    
    <!-- Navbar -->
    <x-navbar />
    
    <div class="container mx-auto px-4 py-8">
        <!-- Header -->
        <div class="mb-8">
            <h1 class="text-3xl font-bold mb-2">Manage Reviews</h1>
            <p class="text-gray-400">Approve or reject user-submitted reviews</p>
        </div>
        
        <!-- Pending Reviews Section -->
        <div class="mb-12">
            <h2 class="text-2xl font-bold mb-4 text-yellow-400">Pending Reviews ({{ $pendingReviews->count() }})</h2>
            
            @if($pendingReviews->count() > 0)
                <div class="bg-gray-800 rounded-lg p-6">
                    @foreach($pendingReviews as $review)
                        <div class="border border-gray-700 rounded-lg p-4 mb-4">
                            <div class="flex justify-between items-start mb-3">
                                <div>
                                    <h3 class="font-bold text-lg">
                                        @if($review->reviewable_type === 'App\Models\Music')
                                            Music: {{ $review->reviewable->title ?? 'Unknown' }}
                                        @else
                                            Video: {{ $review->reviewable->title ?? 'Unknown' }}
                                        @endif
                                    </h3>
                                    <p class="text-sm text-gray-400">
                                        By: {{ $review->user->name ?? 'Unknown User' }} | 
                                        {{ $review->created_at->format('M d, Y h:i A') }}
                                    </p>
                                </div>
                                <div class="flex gap-2">
                                    <form action="{{ route('admin.approve-review', $review->id) }}" method="POST" class="inline">
                                        @csrf
                                        <button type="submit" class="btn btn-success btn-sm">Approve</button>
                                    </form>
                                    <form action="{{ route('admin.delete-review', $review->id) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-error btn-sm">Delete</button>
                                    </form>
                                </div>
                            </div>
                            
                            <div class="bg-gray-900 p-3 rounded">
                                <p class="text-gray-300">{{ $review->review_text }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="text-center py-8 bg-gray-800 rounded-lg">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 mx-auto text-gray-600 mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <p class="text-xl text-gray-400">No pending reviews to approve!</p>
                </div>
            @endif
        </div>
        
        <!-- Approved Reviews Section -->
        <div>
            <h2 class="text-2xl font-bold mb-4 text-green-400">Approved Reviews</h2>
            
            @if($approvedReviews->count() > 0)
                <div class="bg-gray-800 rounded-lg p-6">
                    @foreach($approvedReviews as $review)
                        <div class="border border-gray-700 rounded-lg p-4 mb-4">
                            <div class="flex justify-between items-start mb-3">
                                <div>
                                    <h3 class="font-bold text-lg">
                                        @if($review->reviewable_type === 'App\Models\Music')
                                            🎵 {{ $review->reviewable->title ?? 'Unknown' }}
                                        @else
                                            🎬 {{ $review->reviewable->title ?? 'Unknown' }}
                                        @endif
                                    </h3>
                                    <p class="text-sm text-gray-400">
                                        By: {{ $review->user->name ?? 'Unknown User' }} | 
                                        {{ $review->created_at->format('M d, Y h:i A') }}
                                    </p>
                                </div>
                                <form action="{{ route('admin.delete-review', $review->id) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-error btn-sm">Delete</button>
                                </form>
                            </div>
                            
                            <div class="bg-gray-900 p-3 rounded">
                                <p class="text-gray-300">{{ $review->review_text }}</p>
                            </div>
                        </div>
                    @endforeach
                    
                    <!-- Pagination -->
                    <div class="mt-6">
                        {{ $approvedReviews->links() }}
                    </div>
                </div>
            @else
                <div class="text-center py-8 bg-gray-800 rounded-lg">
                    <p class="text-xl text-gray-400">No approved reviews yet.</p>
                </div>
            @endif
        </div>
    </div>
    
    <!-- Footer -->
    <x-footer />
    
</body>
</html>