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
                    <div class="flex flex-col md:flex-row gap-4 justify-between items-center mb-6">

                        <!-- Add User Button -->
                        <button class="btn btn-gradient text-white">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                                <path d="M8 9a3 3 0 100-6 3 3 0 000 6zM8 11a6 6 0 016 6H2a6 6 0 016-6zM16 7a1 1 0 10-2 0v1h-1a1 1 0 100 2h1v1a1 1 0 102 0v-1h1a1 1 0 100-2h-1V7z" />
                            </svg>
                            Create New User
                        </button>
                    </div>

                    <!-- Users Table -->
                    <div class="overflow-x-auto">
                        <table class="admin-table" id="usersTable">
                            <thead>
                                <tr>
                                    <th>User ID</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Address</th>
                                    <th>Role</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="font-semibold text-purple-400">USER001</td>
                                    <td class="font-semibold">John Doe</td>
                                    <td>john.doe@example.com</td>
                                    <td>+1 (555) 123-4567</td>
                                    <td>123 Main St, New York, NY</td>
                                    <td>Admin</td>
                                    <td>
                                        <button class="btn btn-sm btn-ghost text-purple-400" onclick="viewUser('USER001')">View</button>
                                        <button class="btn btn-sm btn-ghost text-blue-400" onclick="editUser('USER001')">Edit</button>
                                        <button class="btn btn-sm btn-ghost text-red-400" onclick="deleteUser('USER001')">Delete</button>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="font-semibold text-purple-400">USER002</td>
                                    <td class="font-semibold">Jane Smith</td>
                                    <td>jane.smith@example.com</td>
                                    <td>+1 (555) 234-5678</td>
                                    <td>456 Oak Ave, Los Angeles, CA</td>
                                    <td>User</td>
                                    <td>
                                        <button class="btn btn-sm btn-ghost text-purple-400" onclick="viewUser('USER002')">View</button>
                                        <button class="btn btn-sm btn-ghost text-blue-400" onclick="editUser('USER002')">Edit</button>
                                        <button class="btn btn-sm btn-ghost text-red-400" onclick="deleteUser('USER002')">Delete</button>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="font-semibold text-purple-400">USER003</td>
                                    <td class="font-semibold">Mike Johnson</td>
                                    <td>mike.j@example.com</td>
                                    <td>+1 (555) 345-6789</td>
                                    <td>789 Pine Rd, Chicago, IL</td>
                                    <td>User</td>
                                    <td>
                                        <button class="btn btn-sm btn-ghost text-purple-400" onclick="viewUser('USER003')">View</button>
                                        <button class="btn btn-sm btn-ghost text-blue-400" onclick="editUser('USER003')">Edit</button>
                                        <button class="btn btn-sm btn-ghost text-red-400" onclick="deleteUser('USER003')">Delete</button>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="font-semibold text-purple-400">USER004</td>
                                    <td class="font-semibold">Sarah Williams</td>
                                    <td>sarah.w@example.com</td>
                                    <td>+1 (555) 456-7890</td>
                                    <td>321 Elm St, Houston, TX</td>
                                    <td>User</td>
                                    <td>
                                        <button class="btn btn-sm btn-ghost text-purple-400" onclick="viewUser('USER004')">View</button>
                                        <button class="btn btn-sm btn-ghost text-blue-400" onclick="editUser('USER004')">Edit</button>
                                        <button class="btn btn-sm btn-ghost text-red-400" onclick="deleteUser('USER004')">Delete</button>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="font-semibold text-purple-400">USER005</td>
                                    <td class="font-semibold">David Brown</td>
                                    <td>david.b@example.com</td>
                                    <td>+1 (555) 567-8901</td>
                                    <td>654 Maple Dr, Phoenix, AZ</td>
                                    <td>User</td>
                                    <td>
                                        <button class="btn btn-sm btn-ghost text-purple-400" onclick="viewUser('USER005')">View</button>
                                        <button class="btn btn-sm btn-ghost text-blue-400" onclick="editUser('USER005')">Edit</button>
                                        <button class="btn btn-sm btn-ghost text-red-400" onclick="deleteUser('USER005')">Delete</button>
                                    </td>
                                </tr>

                                <tr>
                                    <td class="font-semibold text-purple-400">USER010</td>
                                    <td class="font-semibold">Patricia Martinez</td>
                                    <td>patricia.m@example.com</td>
                                    <td>+1 (555) 012-3456</td>
                                    <td>741 Ash Blvd, San Jose, CA</td>
                                    <td>User</td>
                                    <td>
                                        <button class="btn btn-sm btn-ghost text-purple-400" onclick="viewUser('USER010')">View</button>
                                        <button class="btn btn-sm btn-ghost text-blue-400" onclick="editUser('USER010')">Edit</button>
                                        <button class="btn btn-sm btn-ghost text-red-400" onclick="deleteUser('USER010')">Delete</button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </section>

        <!-- Footer start  -->
        <x-footer />
        <!-- Footer end  -->
    </div>

    <script>
        // Search functionality
        document.getElementById('searchInput').addEventListener('input', function(e) {
            const searchTerm = e.target.value.toLowerCase();
            const table = document.getElementById('usersTable');
            const rows = table.getElementsByTagName('tbody')[0].getElementsByTagName('tr');

            for (let row of rows) {
                const userId = row.cells[0].textContent.toLowerCase();
                const name = row.cells[1].textContent.toLowerCase();
                const email = row.cells[2].textContent.toLowerCase();

                if (userId.includes(searchTerm) || name.includes(searchTerm) || email.includes(searchTerm)) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            }
        });

        // View user
        function viewUser(userId) {
            alert('Viewing details for ' + userId);
            // In production: redirect to user details page
            // window.location.href = '/admin/users/view/' + userId;
        }

        // Edit user
        function editUser(userId) {
            alert('Editing user ' + userId);
            // In production: redirect to edit user page
            // window.location.href = '/admin/users/edit/' + userId;
        }

        // Delete user
        function deleteUser(userId) {
            if (confirm('Are you sure you want to delete ' + userId + '? This action cannot be undone.')) {
                alert('User ' + userId + ' deleted successfully! (This is a demo)');
                // In production: send delete request to server
            }
        }
    </script>
</body>
</html>