<!DOCTYPE html>
<html lang="en" data-theme="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Dashboard - SOUND GROUP</title>
    <link href="https://cdn.jsdelivr.net/npm/daisyui@4.4.19/dist/full.min.css" rel="stylesheet" type="text/css" />
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Outfit:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/userdash.css') }}">
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
                <h1 class="page-title display-font mb-4">MY DASHBOARD</h1>
            </div>
        </section>

        <!-- Dashboard Content -->
        <section class="py-8">
            <div class="container mx-auto px-4">
                <!-- Welcome Card -->
                <div class="section-card mb-8">
                    <h2 class="section-title display-font mb-4">WELCOME, Usman939!</h2>
                    <p class="text-gray-300 text-lg">Glad to have you back. Explore and enjoy your favorite music and videos.</p>
                </div>

                <!-- Profile Information -->
                <div class="section-card mb-8">
                    <div class="flex justify-between items-center mb-6">
                        <h2 class="section-title display-font">MY PROFILE</h2>
                        <a href="{{ url('/Dashboard/User/Edit') }}" class="btn btn-gradient text-white">Edit Profile</a>
                    </div>
                    <div class="grid md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm text-gray-400 mb-2">Full Name</label>
                            <p class="text-lg font-semibold">Usman Nadeem</p>
                        </div>
                        <div>
                            <label class="block text-sm text-gray-400 mb-2">Email Address</label>
                            <p class="text-lg font-semibold">usmannadeem015@gmail.com</p>
                        </div>
                        <div>
                            <label class="block text-sm text-gray-400 mb-2">Phone Number</label>
                            <p class="text-lg font-semibold">03318393259</p>
                        </div>
                        <div>
                            <label class="block text-sm text-gray-400 mb-2">User ID</label>
                            <p class="text-lg font-semibold">01</p>
                        </div>
                        <div class="md:col-span-2">
                            <label class="block text-sm text-gray-400 mb-2">Address</label>
                            <p class="text-lg font-semibold">Nasa space station</p>
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