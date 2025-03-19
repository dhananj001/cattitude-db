<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\UserRole;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Creating an admin user
        $admin = User::create([
            'name' => 'Admin User',
            'email' => 'admin@cattitudedb.com',
            'password' => Hash::make('password'),
        ]);

        // Assigning the admin role to the user
        UserRole::create([
            'user_id' => $admin->id,
            'role_id' => 1, //1 is Admin
        ]);
    }
}
