<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        // Create Admin User
        User::create([
            'name' => 'Admin User',
            'email' => 'admin@soundgroup.com',
            'password' => Hash::make('admin123'),
            'phone' => '03001234567',
            'address' => 'Admin Office, Karachi',
            'role' => 'admin',
            'is_active' => true,
        ]);

        // Create Regular User for Testing
        User::create([
            'name' => 'Usman Nadeem',
            'email' => 'usmannadeem015@gmail.com',
            'password' => Hash::make('password123'),
            'phone' => '03318393259',
            'address' => 'Nasa space station',
            'role' => 'user',
            'is_active' => true,
        ]);

        echo "✅ Admin and User created successfully!\n";
        echo "Admin Email: admin@soundgroup.com\n";
        echo "Admin Password: admin123\n\n";
        echo "User Email: usmannadeem015@gmail.com\n";
        echo "User Password: password123\n";
    }
}