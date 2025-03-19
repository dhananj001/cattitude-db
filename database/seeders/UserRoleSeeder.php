<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Role;
use App\Models\UserRole;

class UserRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Assign Admin Role to User 1
        UserRole::create([
            'user_id' => 1,
            'role_id' => Role::where('name', 'admin')->first()->id,
        ]);

        // Assign Staff Role to User 2
        UserRole::create([
            'user_id' => 2,
            'role_id' => Role::where('name', 'staff')->first()->id,
        ]);
    }
}
