<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    public function run()
    {
        // Daftar user yang akan dibuat
        $users = [
            [
                'name' => 'Super Admin',
                'email' => 'admin@example.com',
                'password' => 'password123', // Gantilah dengan password yang lebih aman
                'role' => 'Admin'
            ],
            [
                'name' => 'Officer User',
                'email' => 'officer@example.com',
                'password' => 'password123', // Gantilah dengan password yang lebih aman
                'role' => 'Officer'
            ]
        ];

        foreach ($users as $userData) {
            // Cek atau buat role jika belum ada
            $role = Role::firstOrCreate(['name' => $userData['role']]);

            // Buat user jika belum ada berdasarkan email
            $user = User::firstOrCreate(
                ['email' => $userData['email']],
                [
                    'name' => $userData['name'],
                    'password' => Hash::make($userData['password']),
                ]
            );

            // Assign role ke user jika belum memiliki role
            if (!$user->hasRole($userData['role'])) {
                $user->assignRole($role);
            }

            // Log hasil
            $this->command->info("User '{$user->name}' with role '{$userData['role']}' created successfully.");
        }
    }
}
