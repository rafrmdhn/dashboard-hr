<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Intern;
use App\Models\Position;
use App\Models\Staff;
use App\Models\Talent;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        // User::factory()->create();

        // Intern::factory(20)->create();

        Talent::factory(20)->create();

        // Staff::factory(20)->create();

        // Position::factory(5)->create();
    }
}
