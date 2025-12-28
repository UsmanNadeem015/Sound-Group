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
    
    <!-- NavBar start  -->
    <x-navbar />
    <!-- NavBar end  -->
<br><br><br><br><br><br><br>
        <!-- Login Container -->
        <div class="login-container">
            <!-- Login Card -->
            <div class="login-card">
            <!-- Logo -->
            <div class="logo-text">
                <a href="#" class="text-4xl font-bold display-font">
                    <span class="bg-gradient-to-r from-purple-400 to-pink-400 bg-clip-text text-transparent">SOUND</span>
                    <span class="text-white">GROUP</span>
                </a>
            </div>

            <!-- Title -->
            <h1 class="login-title display-font">LOGIN</h1>

            <!-- Error Message -->
            <div id="errorMessage" class="error-message">
                <strong>Error:</strong> Invalid email or password.
            </div>

            <!-- Login Form -->
            <form id="loginForm">
                <!-- Email Field -->
                <div class="mb-4">
                    <label for="email" class="form-label">Email Address</label>
                    <input 
                        type="email" 
                        id="email" 
                        name="email" 
                        class="input form-input w-full" 
                        placeholder="Enter your email"
                        required
                    />
                </div>

                <!-- Password Field -->
                <div class="mb-4">
                    <label for="password" class="form-label">Password</label>
                    <input 
                        type="password" 
                        id="password" 
                        name="password" 
                        class="input form-input w-full" 
                        placeholder="Enter your password"
                        required
                    />
                </div>
<br>
                <!-- Login Button -->
                <button type="submit" class="btn btn-gradient w-full btn-lg text-white mb-4">
                    Login
                </button>

                <!-- Sign Up Link -->
                <p class="text-center text-gray-400">
                    Don't have an account? 
                    <a href="{{ url('/Register') }}" class="link-text font-semibold">Sign Up</a>
                </p>
            </form>


            
        </div>
    </div>
<br><br><br><br>
    <!-- Footer start  -->
    <x-footer />
    <!-- Footer end  -->
</div>

<script>
        // Form validation
        const loginForm = document.getElementById('loginForm');
        const errorMessage = document.getElementById('errorMessage');

        loginForm.addEventListener('submit', function(e) {
            e.preventDefault();
            
            const email = document.getElementById('email').value;
            const password = document.getElementById('password').value;

            // Basic validation
            if (!email || !password) {
                showError('Please fill in all fields.');
                return;
            }

            // Email validation
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!emailRegex.test(email)) {
                showError('Please enter a valid email address.');
                return;
            }

            // Password validation (minimum 6 characters)
            if (password.length < 6) {
                showError('Password must be at least 6 characters long.');
                return;
            }

            // If validation passes, you would typically send the data to your server
            console.log('Login attempt:', { email, password });
            
            // For demo purposes, show success (in production, this would redirect)
            alert('Login successful! (This is a demo)');
            
            // Hide error message if shown
            errorMessage.classList.remove('show');
        });

        function showError(message) {
            errorMessage.innerHTML = '<strong>Error:</strong> ' + message;
            errorMessage.classList.add('show');
            
            // Auto-hide after 5 seconds
            setTimeout(() => {
                errorMessage.classList.remove('show');
            }, 5000);
        }

        // Remove error message when user starts typing
        document.getElementById('email').addEventListener('input', function() {
            errorMessage.classList.remove('show');
        });

        document.getElementById('password').addEventListener('input', function() {
            errorMessage.classList.remove('show');
        });
    </script>
</body>
</html>