<!DOCTYPE html>
<html lang="en" data-theme="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Users - SOUND GROUP</title>
    <link href="https://cdn.jsdelivr.net/npm/daisyui@4.4.19/dist/full.min.css" rel="stylesheet" type="text/css" />
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Outfit:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/manageusers.css') }}">
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
                <h1 class="page-title display-font mb-4">MANAGE USERS</h1>
                <p class="text-xl text-gray-300">View and manage all user accounts</p>
            </div>
        </section>

        <!-- Users Management -->
        <section class="py-8 pb-16">
            <div class="container mx-auto px-4">
                <!-- Search and Actions -->
                <div class="section-card">
                    
                    <!-- Success Message -->
                    @if (session('success'))
                        <div class="alert alert-success mb-6 bg-green-500/20 border border-green-500 text-green-400 p-4 rounded-lg">
                            ✓ {{ session('success') }}
                        </div>
                    @endif

                    <!-- Error Message -->
                    @if ($errors->any())
                        <div class="alert alert-error mb-6 bg-red-500/20 border border-red-500 text-red-400 p-4 rounded-lg">
                            @foreach ($errors->all() as $error)
                                • {{ $error }}
                            @endforeach
                        </div>
                    @endif

                    <!-- Users Table -->
                    <div class="overflow-x-auto">
                        <table class="admin-table" id="usersTable">
                            <thead>
                                <tr>
                                    <th>User ID</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Role</th>
                                    <th>Status</th>
                                    <th>Joined</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($users as $user)
                                    <tr>
                                        <td class="font-semibold text-purple-400">#{{ str_pad($user->id, 4, '0', STR_PAD_LEFT) }}</td>
                                        <td class="font-semibold">{{ $user->name }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>{{ $user->phone }}</td>
                                        <td>
                                            <span class="badge {{ $user->role === 'admin' ? 'badge-primary' : 'badge-secondary' }}">
                                                {{ ucfirst($user->role) }}
                                            </span>
                                        </td>
                                        <td>
                                            <span class="status-badge {{ $user->is_active ? 'status-active' : 'status-inactive' }}">
                                                {{ $user->is_active ? 'Active' : 'Inactive' }}
                                            </span>
                                        </td>
                                        <td>{{ $user->created_at->format('M d, Y') }}</td>
                                        <td>
                                            <button class="btn btn-sm btn-ghost text-purple-400" onclick="viewUser({{ $user->id }}, '{{ $user->name }}', '{{ $user->email }}', '{{ $user->phone }}', '{{ addslashes($user->address) }}')">
                                                View
                                            </button>
                                            @if($user->id !== auth()->id())
                                                <form method="POST" action="{{ route('admin.deleteuser', $user->id) }}" class="inline" onsubmit="return confirm('Are you sure you want to delete {{ $user->name }}?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-ghost text-red-400">
                                                        Delete
                                                    </button>
                                                </form>
                                            @else
                                                <span class="text-xs text-gray-500">(You)</span>
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="8" class="text-center py-8 text-gray-400">
                                            No users found.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    <div class="mt-6">
                        {{ $users->links() }}
                    </div>

                </div>
            </div>
        </section>

        <!-- Footer start -->
        <x-footer />
        <!-- Footer end -->
    </div>

    <!-- User Details Modal -->
    <dialog id="userModal" class="modal">
        <div class="modal-box bg-base-200">
            <h3 class="font-bold text-lg mb-4">User Details</h3>
            <div class="space-y-3">
                <div>
                    <label class="text-sm text-gray-400">Name:</label>
                    <p class="font-semibold" id="modalName"></p>
                </div>
                <div>
                    <label class="text-sm text-gray-400">Email:</label>
                    <p class="font-semibold" id="modalEmail"></p>
                </div>
                <div>
                    <label class="text-sm text-gray-400">Phone:</label>
                    <p class="font-semibold" id="modalPhone"></p>
                </div>
                <div>
                    <label class="text-sm text-gray-400">Address:</label>
                    <p class="font-semibold" id="modalAddress"></p>
                </div>
            </div>
            <div class="modal-action">
                <form method="dialog">
                    <button class="btn">Close</button>
                </form>
            </div>
        </div>
    </dialog>

    <script>
        function viewUser(id, name, email, phone, address) {
            document.getElementById('modalName').textContent = name;
            document.getElementById('modalEmail').textContent = email;
            document.getElementById('modalPhone').textContent = phone;
            document.getElementById('modalAddress').textContent = address;
            document.getElementById('userModal').showModal();
        }
    </script>
</body>
</html>