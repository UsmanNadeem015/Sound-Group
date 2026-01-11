<!DOCTYPE html>
<html lang="en" data-theme="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up - SOUND GROUP</title>
    <link href="https://cdn.jsdelivr.net/npm/daisyui@4.4.19/dist/full.min.css" rel="stylesheet" type="text/css" />
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Outfit:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/register.css') }}">
</head>
<body>
    <!-- Animated Background -->
    <div class="animated-bg"></div>

    <!-- Content Wrapper -->
    <div class="content-wrapper">
        <!-- NavBar start -->
        <x-navbar />
        <!-- NavBar end -->
        <br><br>

        <!-- Signup Container -->
        <div class="signup-container">
            <!-- Signup Card -->
            <div class="signup-card">
                <!-- Logo -->
                <div class="logo-text">
                    <a href="{{ route('home') }}" class="text-4xl font-bold display-font">
                        <span class="bg-gradient-to-r from-purple-400 to-pink-400 bg-clip-text text-transparent">SOUND</span>
                        <span class="text-white">GROUP</span>
                    </a>
                </div>

                <!-- Title -->
                <h1 class="signup-title display-font">SIGN UP</h1>
                <p class="text-center text-gray-400 mb-8">Create your account to start exploring amazing music and videos</p>

                <!-- Display Validation Errors -->
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

                <!-- Signup Form -->
                <form method="POST" action="{{ route('register.post') }}">
                    @csrf

                    <!-- Name Field -->
                    <div class="mb-4">
                        <label for="name" class="form-label">
                            Full Name <span class="required">*</span>
                        </label>
                        <input 
                            type="text" 
                            id="name" 
                            name="name" 
                            class="input form-input w-full @error('name') error @enderror" 
                            placeholder="Enter your full name"
                            value="{{ old('name') }}"
                            required
                        />
                        @error('name')
                            <span class="input-error-text show">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Email Field -->
                    <div class="mb-4">
                        <label for="email" class="form-label">
                            Email Address <span class="required">*</span>
                        </label>
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

                    <!-- Phone Field -->
                    <div class="mb-4">
                        <label for="phone" class="form-label">
                            Phone Number <span class="required">*</span>
                        </label>
                        <input 
                            type="tel" 
                            id="phone" 
                            name="phone" 
                            class="input form-input w-full @error('phone') error @enderror" 
                            placeholder="Enter your phone number"
                            value="{{ old('phone') }}"
                            required
                        />
                        @error('phone')
                            <span class="input-error-text show">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Address Field -->
                    <div class="mb-4">
                        <label for="address" class="form-label">
                            Address <span class="required">*</span>
                        </label>
                        <textarea 
                            id="address" 
                            name="address" 
                            class="textarea form-input w-full @error('address') error @enderror" 
                            placeholder="Enter your address"
                            rows="3"
                            required
                        >{{ old('address') }}</textarea>
                        @error('address')
                            <span class="input-error-text show">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Password Field -->
                    <div class="mb-4">
                        <label for="password" class="form-label">
                            Password <span class="required">*</span>
                        </label>
                        <input 
                            type="password" 
                            id="password" 
                            name="password" 
                            class="input form-input w-full @error('password') error @enderror" 
                            placeholder="Create a password (min. 8 characters)"
                            required
                        />
                        @error('password')
                            <span class="input-error-text show">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Confirm Password Field -->
                    <div class="mb-4">
                        <label for="password_confirmation" class="form-label">
                            Confirm Password <span class="required">*</span>
                        </label>
                        <input 
                            type="password" 
                            id="password_confirmation" 
                            name="password_confirmation" 
                            class="input form-input w-full" 
                            placeholder="Confirm your password"
                            required
                        />
                    </div>

                    <!-- Signup Button -->
                    <button type="submit" class="btn btn-gradient w-full btn-lg text-white mb-4">
                        Create Account
                    </button>

                    <!-- Login Link -->
                    <p class="text-center text-gray-400">
                        Already have an account? 
                        <a href="{{ route('login') }}" class="link-text font-semibold">Login</a>
                    </p>
                </form>
            </div>
        </div>

        <!-- Footer start -->
        <x-footer />
        <!-- Footer end -->
    </div>
</body>
</html>