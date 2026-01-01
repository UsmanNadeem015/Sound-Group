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

                <!-- Quick Actions -->
                <div class="section-card mb-8">
                    <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-6">
                        <!-- Add Music -->
                        <div class="action-card">
                            <div class="action-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-white" viewBox="0 0 20 20" fill="currentColor">
                                    <path d="M18 3a1 1 0 00-1.196-.98l-10 2A1 1 0 006 5v9.114A4.369 4.369 0 005 14c-1.657 0-3 .895-3 2s1.343 2 3 2 3-.895 3-2V7.82l8-1.6v5.894A4.37 4.37 0 0015 12c-1.657 0-3 .895-3 2s1.343 2 3 2 3-.895 3-2V3z" />
                                </svg>
                            </div>
                            <h3 class="font-bold text-lg mb-2">Add Music</h3>
                            <p class="text-sm text-gray-400 mb-4">Upload new music files</p>
                            <a href="{{ url('/Dashboard/Admin/Add-Music') }}" class="btn btn-gradient btn-sm text-white">Add Music</a>
                        </div>

                        <!-- Add Video -->
                        <div class="action-card">
                            <div class="action-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-white" viewBox="0 0 20 20" fill="currentColor">
                                    <path d="M2 6a2 2 0 012-2h6a2 2 0 012 2v8a2 2 0 01-2 2H4a2 2 0 01-2-2V6zM14.553 7.106A1 1 0 0014 8v4a1 1 0 00.553.894l2 1A1 1 0 0018 13V7a1 1 0 00-1.447-.894l-2 1z" />
                                </svg>
                            </div>
                            <h3 class="font-bold text-lg mb-2">Add Video</h3>
                            <p class="text-sm text-gray-400 mb-4">Upload new video files</p>
                            <a href="{{ url('/Dashboard/Admin/Add-Video') }}" class="btn btn-gradient btn-sm text-white">Add Video</a>
                        </div>

                        <!-- Manage Categories -->
                        <div class="action-card">
                            <div class="action-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-white" viewBox="0 0 20 20" fill="currentColor">
                                    <path d="M7 3a1 1 0 000 2h6a1 1 0 100-2H7zM4 7a1 1 0 011-1h10a1 1 0 110 2H5a1 1 0 01-1-1zM2 11a2 2 0 012-2h12a2 2 0 012 2v4a2 2 0 01-2 2H4a2 2 0 01-2-2v-4z" />
                                </svg>
                            </div>
                            <h3 class="font-bold text-lg mb-2">Manage Categories</h3>
                            <p class="text-sm text-gray-400 mb-4">Create & manage categories</p>
                            <button class="btn btn-gradient btn-sm text-white">Manage</button>
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
                            <a href="{{ url('/Dashboard/Admin/Manage-Users') }}" class="btn btn-gradient btn-sm text-white">Manage</a>
                        </div>
                    </div>
                </div>

            </div>
        </section>

        <!-- Footer start  -->
        <x-footer />
        <!-- Footer end  -->
    </div>
</body>
</html>