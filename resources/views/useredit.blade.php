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
                    
                    <!-- Error Messages -->
                    @if ($errors->any())
                        <div class="alert alert-error mb-6 bg-red-500/20 border border-red-500 text-red-400 p-4 rounded-lg">
                            <strong>Please fix the following errors:</strong>
                            <ul class="mt-2">
                                @foreach ($errors->all() as $error)
                                    <li>• {{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('user.update') }}">
                        @csrf
                        @method('PUT')

                        <!-- Full Name -->
                        <div class="mb-4">
                            <label for="name" class="form-label">Full Name</label>
                            <input 
                                type="text" 
                                id="name" 
                                name="name" 
                                class="input form-input w-full @error('name') error @enderror" 
                                value="{{ old('name', $user->name) }}"
                                required
                            />
                            @error('name')
                                <span class="text-red-400 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Email (Read-only) -->
                        <div class="mb-4">
                            <label for="email" class="form-label">Email Address</label>
                            <input 
                                type="email" 
                                id="email" 
                                class="input form-input w-full bg-gray-700 cursor-not-allowed" 
                                value="{{ $user->email }}"
                                disabled
                            />
                            <p class="text-xs text-gray-500 mt-1">Email cannot be changed</p>
                        </div>

                        <!-- Phone -->
                        <div class="mb-4">
                            <label for="phone" class="form-label">Phone Number</label>
                            <input 
                                type="tel" 
                                id="phone" 
                                name="phone" 
                                class="input form-input w-full @error('phone') error @enderror" 
                                value="{{ old('phone', $user->phone) }}"
                                required
                            />
                            @error('phone')
                                <span class="text-red-400 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Address -->
                        <div class="mb-4">
                            <label for="address" class="form-label">Address</label>
                            <textarea 
                                id="address" 
                                name="address" 
                                class="textarea form-input w-full @error('address') error @enderror" 
                                rows="3"
                                required
                            >{{ old('address', $user->address) }}</textarea>
                            @error('address')
                                <span class="text-red-400 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <hr class="border-gray-700 my-6">

                        <h3 class="text-xl font-bold mb-4">Change Password (Optional)</h3>

                        <!-- Current Password -->
                        <div class="mb-4">
                            <label for="current_password" class="form-label">Current Password</label>
                            <input 
                                type="password" 
                                id="current_password" 
                                name="current_password" 
                                class="input form-input w-full @error('current_password') error @enderror" 
                                placeholder="Enter current password to change"
                            />
                            @error('current_password')
                                <span class="text-red-400 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- New Password -->
                        <div class="mb-4">
                            <label for="new_password" class="form-label">New Password</label>
                            <input 
                                type="password" 
                                id="new_password" 
                                name="new_password" 
                                class="input form-input w-full @error('new_password') error @enderror" 
                                placeholder="Enter new password (min. 8 characters)"
                            />
                            @error('new_password')
                                <span class="text-red-400 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Confirm New Password -->
                        <div class="mb-6">
                            <label for="new_password_confirmation" class="form-label">Confirm New Password</label>
                            <input 
                                type="password" 
                                id="new_password_confirmation" 
                                name="new_password_confirmation" 
                                class="input form-input w-full" 
                                placeholder="Confirm new password"
                            />
                        </div>

                        <!-- Buttons -->
                        <div class="flex gap-4">
                            <button type="submit" class="btn btn-gradient text-white flex-1">
                                Save Changes
                            </button>
                            <a href="{{ route('user.dashboard') }}" class="btn btn-outline flex-1">
                                Cancel
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </section>

        <!-- Footer start -->
        <x-footer />
        <!-- Footer end -->
    </div>
</body>
</html>