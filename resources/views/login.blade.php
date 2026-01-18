<!DOCTYPE html>
<html lang="en" data-theme="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - SOUND GROUP</title>
    <link href="https://cdn.jsdelivr.net/npm/daisyui@4.4.19/dist/full.min.css" rel="stylesheet" type="text/css" />
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Outfit:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
</head>
<body>
    <!-- Animated Background -->
    <div class="animated-bg"></div>

    <!-- Content Wrapper -->
    <div class="content-wrapper">
        <!-- NavBar start -->
        <x-navbar />
        <!-- NavBar end -->
        <br><br><br><br><br><br><br>

        <!-- Login Container -->
        <div class="login-container">
            <!-- Login Card -->
            <div class="login-card">
                <!-- Logo -->
                <div class="logo-text">
                    <a href="{{ route('home') }}" class="text-4xl font-bold display-font">
                        <span class="bg-gradient-to-r from-purple-400 to-pink-400 bg-clip-text text-transparent">SOUND</span>
                        <span class="text-white">GROUP</span>
                    </a>
                </div>

                <!-- Title -->
                <h1 class="login-title display-font">LOGIN</h1>

                <!-- Success Message (from registration) -->
                @if (session('success'))
                    <div class="alert alert-success mb-4 bg-green-500/20 border border-green-500 text-green-400 p-3 rounded-lg">
                        {{ session('success') }}
                    </div>
                @endif

                <!-- Error Messages -->
                @if ($errors->any())
                    <div class="error-message show">
                        <strong>Error:</strong>
                        <ul class="mt-2">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <!-- Login Form -->
                <form method="POST" action="{{ route('login.post') }}">
                    @csrf

                    <!-- Email Field -->
                    <div class="mb-4">
                        <label for="email" class="form-label">Email Address</label>
                        <input 
                            type="email" 
                            id="email" 
                            name="email" 
                            class="input form-input w-full @error('email') error @enderror" 
                            placeholder="Enter your email"
                            value="{{ old('email') }}"
                            required
                        />
                        @error('email')
                            <span class="input-error-text show">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Password Field -->
                    <div class="mb-6">
                        <label for="password" class="form-label">Password</label>
                        <input 
                            type="password" 
                            id="password" 
                            name="password" 
                            class="input form-input w-full @error('password') error @enderror" 
                            placeholder="Enter your password"
                            required
                        />
                        @error('password')
                            <span class="input-error-text show">{{ $message }}</span>
                        @enderror
                    </div>
                    <br>

                    <!-- Login Button -->
                    <button type="submit" class="btn btn-gradient w-full btn-lg text-white mb-4">
                        Login
                    </button>

                    <!-- Sign Up Link -->
                    <p class="text-center text-gray-400">
                        Don't have an account? 
                        <a href="{{ route('register') }}" class="link-text font-semibold">Sign Up</a>
                    </p>
                </form>
            </div>
        </div>
        <br><br><br><br>

        <!-- Footer start -->
        <x-footer />
        <!-- Footer end -->
    </div>
</body>
</html>