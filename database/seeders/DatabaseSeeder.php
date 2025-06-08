<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\UserRole;
use App\Models\ActivityType;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // UserRole::create(['role' => 'Administrator']);
        // UserRole::create(['role' => 'Manager']);
        //UserRole::create(['role' => 'User']);
        //
        ActivityType::insert([
            [
                'action' => 'create',
                'description' => 'User created a tour',
            ],
            [
                'action' => 'update',
                'description' => 'User updated a tour',
            ],
            [
                'action' => 'delete',
                'description' => 'User deleted a tour',
            ],
            [
                'action' => 'view',
                'description' => 'User viewed a tour',
            ],
            [
                'action' => 'login',
                'description' => 'User logged in',
            ],
            [
                'action' => 'logout',
                'description' => 'User logged out',
            ],
            [
                'action' => 'register',
                'description' => 'User registered an account',
            ],
            [
                'action' => 'upload',
                'description' => 'User uploaded a file',
            ],
            [
                'action' => 'activate',
                'description' => 'User activated a tour',
            ],
            [
                'action' => 'deactivate',
                'description' => 'User deactivated a tour',
            ],
            [
                'action' => 'assign',
                'description' => 'User assigned a role or tour',
            ],
            [
                'action' => 'unassign',
                'description' => 'User unassigned a role or tour',
            ],
        ]);

    }
}
