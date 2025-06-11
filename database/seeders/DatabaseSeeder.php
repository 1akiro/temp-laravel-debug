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
        //
        TicketTopic::insert([
            [
                'topic' => 'Technical Issue',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'topic' => 'Billing Question',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'topic' => 'Feature Request',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'topic' => 'Tour Upload Problem',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'topic' => 'Request Tour Creation',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'topic' => 'Tour Editing Assistance',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'topic' => 'Other',
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);
    }
}
