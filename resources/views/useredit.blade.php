<!DOCTYPE html>
<html lang="en" data-theme="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profile - SOUND GROUP</title>
    <link href="https://cdn.jsdelivr.net/npm/daisyui@4.4.19/dist/full.min.css" rel="stylesheet" type="text/css" />
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Outfit:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/useredit.css') }}">
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
                <h1 class="page-title display-font mb-4">EDIT PROFILE</h1>
                <p class="text-xl text-gray-300">Update your personal information</p>
            </div>
        </section>

        <!-- Edit Form -->
        <section class="py-8 pb-16">
            <div class="container mx-auto px-4">
                <div class="form-card">
                    <form id="editProfileForm">
                        <!-- Full Name -->
                        <div class="mb-4">
                            <label for="name" class="form-label">Full Name</label>
                            <input 
                                type="text" 
                                id="name" 
                                name="name" 
                                class="input form-input w-full" 
                                value="John Doe"
                                required
                            />
                        </div>

                        <!-- Email -->
                        <div class="mb-4">
                            <label for="email" class="form-label">Email Address</label>
                            <input 
                                type="email" 
                                id="email" 
                                name="email" 
                                class="input form-input w-full" 
                                value="john.doe@example.com"
                                required
                            />
                        </div>

                        <!-- Phone -->
                        <div class="mb-4">
                            <label for="phone" class="form-label">Phone Number</label>
                            <input 
                                type="tel" 
                                id="phone" 
                                name="phone" 
                                class="input form-input w-full" 
                                value="+1 (555) 123-4567"
                                required
                            />
                        </div>

                        <!-- Address -->
                        <div class="mb-4">
                            <label for="address" class="form-label">Address</label>
                            <textarea 
                                id="address" 
                                name="address" 
                                class="textarea form-input w-full" 
                                rows="3"
                                required
                            >123 Main Street, New York, NY 10001, USA</textarea>
                        </div>

                        <!-- Current Password -->
                        <div class="mb-4">
                            <label for="currentPassword" class="form-label">Current Password</label>
                            <input 
                                type="password" 
                                id="currentPassword" 
                                name="currentPassword" 
                                class="input form-input w-full" 
                                placeholder="Enter current password"
                            />
                        </div>

                        <!-- New Password -->
                        <div class="mb-4">
                            <label for="newPassword" class="form-label">New Password (Optional)</label>
                            <input 
                                type="password" 
                                id="newPassword" 
                                name="newPassword" 
                                class="input form-input w-full" 
                                placeholder="Enter new password"
                            />
                        </div>

                        <!-- Confirm New Password -->
                        <div class="mb-6">
                            <label for="confirmPassword" class="form-label">Confirm New Password</label>
                            <input 
                                type="password" 
                                id="confirmPassword" 
                                name="confirmPassword" 
                                class="input form-input w-full" 
                                placeholder="Confirm new password"
                            />
                        </div>

                        <!-- Buttons -->
                        <div class="flex gap-4">
                            <button type="submit" class="btn btn-gradient text-white flex-1">
                                Save Changes
                            </button>
                            <button type="button" class="btn btn-outline flex-1" onclick="window.history.back()">
                                Cancel
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </section>

        <!-- Footer start  -->
        <x-footer />
        <!-- Footer end  -->
    </div>

    <script>
        // Form submission
        document.getElementById('editProfileForm').addEventListener('submit', function(e) {
            e.preventDefault();
            
            // Get form values
            const formData = {
                name: document.getElementById('name').value,
                email: document.getElementById('email').value,
                phone: document.getElementById('phone').value,
                address: document.getElementById('address').value,
                currentPassword: document.getElementById('currentPassword').value,
                newPassword: document.getElementById('newPassword').value,
                confirmPassword: document.getElementById('confirmPassword').value
            };

            // Basic validation
            if (formData.newPassword && formData.newPassword !== formData.confirmPassword) {
                alert('New passwords do not match!');
                return;
            }

            // In production, send data to server
            console.log('Form data:', formData);
            alert('Profile updated successfully! (Testing)');
            
            // Redirect back to dashboard
            // window.location.href = '/dashboard';
        });
    </script>
</body>
</html>