<!DOCTYPE html>
<html lang="en" data-theme="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - SOUND GROUP</title>
    <link href="https://cdn.jsdelivr.net/npm/daisyui@4.4.19/dist/full.min.css" rel="stylesheet" type="text/css" />
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Outfit:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/admindash.css') }}">
</head>
<body>
    <!-- Animated Background -->
    <div class="animated-bg"></div>

    <!-- Content Wrapper -->
    <div class="content-wrapper">
        <!-- Navigation Component -->
        <x-navbar />

        <!-- Page Header -->
        <section class="page-header">
            <div class="container mx-auto px-4">
                <h1 class="page-title display-font mb-4">ADMIN DASHBOARD</h1>
                <p class="text-xl text-gray-300">Welcome back, Administrator!</p>
            </div>
        </section>

        <!-- Dashboard Content -->
        <section class="py-8">
            <div class="container mx-auto px-4">

                <!-- Success Message -->
                @if (session('success'))
                    <div class="alert alert-success mb-6 bg-green-500/20 border border-green-500 text-green-400 p-4 rounded-lg">
                        ✓ {{ session('success') }}
                    </div>
                @endif

                <!-- Statistics Cards -->
                <div class="grid grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                    <div class="stat-card rounded-2xl p-6 text-center">
                        <div class="text-4xl font-bold display-font text-purple-400 mb-2">{{ $stats['total_users'] ?? 0 }}</div>
                        <div class="text-gray-400">Total Users</div>
                    </div>
                    <div class="stat-card rounded-2xl p-6 text-center">
                        <div class="text-4xl font-bold display-font text-pink-400 mb-2">{{ $stats['total_music'] ?? 0 }}</div>
                        <div class="text-gray-400">Music Tracks</div>
                    </div>
                    <div class="stat-card rounded-2xl p-6 text-center">
                        <div class="text-4xl font-bold display-font text-purple-400 mb-2">{{ $stats['total_videos'] ?? 0 }}</div>
                        <div class="text-gray-400">Videos</div>
                    </div>
                    <div class="stat-card rounded-2xl p-6 text-center">
                        <div class="text-4xl font-bold display-font text-pink-400 mb-2">{{ $stats['total_categories'] ?? 0 }}</div>
                        <div class="text-gray-400">Categories</div>
                    </div>
                </div>

                <!-- Quick Actions -->
                <div class="section-card mb-8">
                    <h2 class="section-title display-font mb-6">QUICK ACTIONS</h2>
                    <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-6">
<!-- Music Management -->
<div class="action-card">
    <div class="action-icon">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-white" viewBox="0 0 20 20" fill="currentColor">
            <path d="M18 3a1 1 0 00-1.196-.98l-10 2A1 1 0 006 5v9.114A4.369 4.369 0 005 14c-1.657 0-3 .895-3 2s1.343 2 3 2 3-.895 3-2V7.82l8-1.6v5.894A4.37 4.37 0 0015 12c-1.657 0-3 .895-3 2s1.343 2 3 2 3-.895 3-2V3z" />
        </svg>
    </div>
    <h3 class="font-bold text-lg mb-2">Music</h3>
    <p class="text-sm text-gray-400 mb-4">Manage music tracks</p>
    <div class="grid grid-cols-1 sm:grid-cols-2 gap-2 mt-auto">
        <a href="{{ route('admin.addmusic') }}" class="btn btn-gradient btn-sm text-white w-full">Add</a>
        <a href="{{ route('admin.viewmusic') }}" class="btn btn-gradient btn-sm text-white w-full">View</a>
    </div>
</div>

<!-- Video Management -->
<div class="action-card">
    <div class="action-icon">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-white" viewBox="0 0 20 20" fill="currentColor">
            <path d="M2 6a2 2 0 012-2h6a2 2 0 012 2v8a2 2 0 01-2 2H4a2 2 0 01-2-2V6zM14.553 7.106A1 1 0 0014 8v4a1 1 0 00.553.894l2 1A1 1 0 0018 13V7a1 1 0 00-1.447-.894l-2 1z" />
        </svg>
    </div>
    <h3 class="font-bold text-lg mb-2">Videos</h3>
    <p class="text-sm text-gray-400 mb-4">Manage video content</p>
    <div class="grid grid-cols-1 sm:grid-cols-2 gap-2 mt-auto">
        <a href="{{ route('admin.addvideo') }}" class="btn btn-gradient btn-sm text-white w-full">Add</a>
        <a href="{{ route('admin.viewvideos') }}" class="btn btn-gradient btn-sm text-white w-full">View</a>
    </div>
</div>
                        <!-- Manage Categories -->
<div class="action-card">
    <div class="action-icon">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-white" viewBox="0 0 20 20" fill="currentColor">
            <path d="M7 3a1 1 0 000 2h6a1 1 0 100-2H7zM4 7a1 1 0 011-1h10a1 1 0 110 2H5a1 1 0 01-1-1zM2 11a2 2 0 012-2h12a2 2 0 012 2v4a2 2 0 01-2 2H4a2 2 0 01-2-2v-4z" />
        </svg>
    </div>
    <h3 class="font-bold text-lg mb-2">Categories</h3>
    <p class="text-sm text-gray-400 mb-4">Manage genres & categories</p>
    <div class="grid grid-cols-1 sm:grid-cols-2 gap-2 mt-auto">
        <a href="{{ route('admin.managecategories') }}" class="btn btn-gradient btn-sm text-white w-full">Manage</a>
        <a href="{{ route('admin.addcategory') }}" class="btn btn-gradient btn-sm text-white w-full">Add New</a>
    </div>
</div>

                        <!-- Manage Users -->
                        <div class="action-card">
                            <div class="action-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-white" viewBox="0 0 20 20" fill="currentColor">
                                    <path d="M9 6a3 3 0 11-6 0 3 3 0 016 0zM17 6a3 3 0 11-6 0 3 3 0 016 0zM12.93 17c.046-.327.07-.66.07-1a6.97 6.97 0 00-1.5-4.33A5 5 0 0119 16v1h-6.07zM6 11a5 5 0 015 5v1H1v-1a5 5 0 015-5z" />
                                </svg>
                            </div>
                            <h3 class="font-bold text-lg mb-2">Manage Users</h3>
                            <p class="text-sm text-gray-400 mb-4">View & manage user accounts</p>
                            <a href="{{ route('admin.manageusers') }}" class="btn btn-gradient btn-sm text-white">Manage</a>
                        </div>
                    </div>
                </div>

                <!-- Recent Activity (Optional - You can add this later) -->
                <div class="section-card mb-8">
                    <h2 class="section-title display-font mb-6">RECENT ACTIVITY</h2>
                    <div class="space-y-4">
                        <div class="flex items-center gap-4 p-4 bg-white/5 rounded-lg">
                            <div class="text-purple-400">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <div class="flex-1">
                                <p class="font-semibold">System is running smoothly</p>
                                <p class="text-sm text-gray-400">All services are operational</p>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </section>

        <!-- Footer start -->
        <x-footer />
        <!-- Footer end -->
    </div>
</body>
</html>