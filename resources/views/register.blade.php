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
    <!-- NavBar start  -->
    <x-navbar />
    <!-- NavBar end  -->
<br><br>

        <!-- Signup Container -->
        <div class="signup-container">
            <!-- Signup Card -->
            <div class="signup-card">
                <!-- Logo -->
                <div class="logo-text">
                    <a href="/" class="text-4xl font-bold display-font">
                        <span class="bg-gradient-to-r from-purple-400 to-pink-400 bg-clip-text text-transparent">SOUND</span>
                        <span class="text-white">GROUP</span>
                    </a>
                </div>

                <!-- Title -->
                <h1 class="signup-title display-font">SIGN UP</h1>
                <p class="text-center text-gray-400 mb-8">Create your account to start exploring amazing music and videos</p>

                <!-- Error Message -->
                <div id="errorMessage" class="error-message">
                    <strong>Error:</strong> Please fix the errors below.
                </div>

                <!-- Signup Form -->
                <form id="signupForm">
                    <!-- Name Field -->
                    <div class="mb-4">
                        <label for="name" class="form-label">
                            Full Name <span class="required">*</span>
                        </label>
                        <input 
                            type="text" 
                            id="name" 
                            name="name" 
                            class="input form-input w-full" 
                            placeholder="Enter your full name"
                            required
                        />
                        <span class="input-error-text" id="nameError">Please enter your full name</span>
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
                            class="input form-input w-full" 
                            placeholder="Enter your email"
                            required
                        />
                        <span class="input-error-text" id="emailError">Please enter a valid email address</span>
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
                            class="input form-input w-full" 
                            placeholder="Enter your phone number"
                            required
                        />
                        <span class="input-error-text" id="phoneError">Please enter a valid phone number</span>
                    </div>

                    <!-- Address Field -->
                    <div class="mb-4">
                        <label for="address" class="form-label">
                            Address <span class="required">*</span>
                        </label>
                        <textarea 
                            id="address" 
                            name="address" 
                            class="textarea form-input w-full" 
                            placeholder="Enter your address"
                            rows="3"
                            required
                        ></textarea>
                        <span class="input-error-text" id="addressError">Please enter your address</span>
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
                            class="input form-input w-full" 
                            placeholder="Create a password (min. 6 characters)"
                            required
                        />
                        <span class="input-error-text" id="passwordError">Password must be at least 6 characters</span>
                    </div>

                    <!-- Confirm Password Field -->
                    <div class="mb-4">
                        <label for="confirmPassword" class="form-label">
                            Confirm Password <span class="required">*</span>
                        </label>
                        <input 
                            type="password" 
                            id="confirmPassword" 
                            name="confirmPassword" 
                            class="input form-input w-full" 
                            placeholder="Confirm your password"
                            required
                        />
                        <span class="input-error-text" id="confirmPasswordError">Passwords do not match</span>
                    </div>

                    <!-- Signup Button -->
                    <button type="submit" class="btn btn-gradient w-full btn-lg text-white mb-4">
                        Create Account
                    </button>

                    <!-- Login Link -->
                    <p class="text-center text-gray-400">
                        Already have an account? 
                        <a href="/login" class="link-text font-semibold">Login</a>
                    </p>
                </form>
            </div>
        </div>

        <!-- Footer start  -->
        <x-footer />
        <!-- Footer end  -->
    </div>

    <script>
        // Form validation
        const signupForm = document.getElementById('signupForm');
        const errorMessage = document.getElementById('errorMessage');

        // Remove error styling when user starts typing
        const inputs = ['name', 'email', 'phone', 'address', 'password', 'confirmPassword'];
        inputs.forEach(inputId => {
            const input = document.getElementById(inputId);
            input.addEventListener('input', function() {
                this.classList.remove('error');
                document.getElementById(inputId + 'Error').classList.remove('show');
                errorMessage.classList.remove('show');
            });
        });

        document.getElementById('terms').addEventListener('change', function() {
            document.getElementById('termsError').classList.remove('show');
            errorMessage.classList.remove('show');
        });

        signupForm.addEventListener('submit', function(e) {
            e.preventDefault();
            
            // Reset all errors
            inputs.forEach(inputId => {
                document.getElementById(inputId).classList.remove('error');
                document.getElementById(inputId + 'Error').classList.remove('show');
            });
            document.getElementById('termsError').classList.remove('show');
            errorMessage.classList.remove('show');

            let hasError = false;

            // Get form values
            const name = document.getElementById('name').value.trim();
            const email = document.getElementById('email').value.trim();
            const phone = document.getElementById('phone').value.trim();
            const address = document.getElementById('address').value.trim();
            const password = document.getElementById('password').value;
            const confirmPassword = document.getElementById('confirmPassword').value;
            const terms = document.getElementById('terms').checked;

            // Name validation
            if (!name || name.length < 2) {
                showFieldError('name', 'Please enter your full name');
                hasError = true;
            }

            // Email validation
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!email || !emailRegex.test(email)) {
                showFieldError('email', 'Please enter a valid email address');
                hasError = true;
            }

            // Phone validation
            const phoneRegex = /^[\d\s\-\+\(\)]{10,}$/;
            if (!phone || !phoneRegex.test(phone)) {
                showFieldError('phone', 'Please enter a valid phone number (min. 10 digits)');
                hasError = true;
            }

            // Address validation
            if (!address || address.length < 10) {
                showFieldError('address', 'Please enter your complete address');
                hasError = true;
            }

            // Password validation
            if (!password || password.length < 6) {
                showFieldError('password', 'Password must be at least 6 characters');
                hasError = true;
            }

            // Confirm password validation
            if (password !== confirmPassword) {
                showFieldError('confirmPassword', 'Passwords do not match');
                hasError = true;
            }

            // Terms validation
            if (!terms) {
                document.getElementById('termsError').classList.add('show');
                hasError = true;
            }

            if (hasError) {
                errorMessage.classList.add('show');
                // Scroll to first error
                const firstError = document.querySelector('.form-input.error');
                if (firstError) {
                    firstError.scrollIntoView({ behavior: 'smooth', block: 'center' });
                }
                return;
            }

            // If validation passes, you would typically send the data to your server
            console.log('Signup data:', { 
                name, 
                email, 
                phone, 
                address, 
                password 
            });
            
            // For demo purposes, show success (in production, this would redirect)
            alert('Account created successfully! (This is a demo)');
        });

        function showFieldError(fieldId, message) {
            const field = document.getElementById(fieldId);
            const errorSpan = document.getElementById(fieldId + 'Error');
            
            field.classList.add('error');
            errorSpan.textContent = message;
            errorSpan.classList.add('show');
        }
    </script>
</body>
</html>