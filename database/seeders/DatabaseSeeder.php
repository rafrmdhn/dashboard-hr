<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Sow;
use App\Models\User;
use App\Models\Brand;
use App\Models\Staff;
use App\Models\Agency;
use App\Models\Intern;
use App\Models\Talent;
use App\Models\Earning;
use App\Models\Category;
use App\Models\Position;
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
        User::factory()->create();

        $positions = [
            'Business Development',
            'Copy Writer',
            'Media And P.R Spesialist',
            'UI/UX',
            'SEO',
            'Designer',
            'Video Editor',
            'Content Creator',
            'Programmer',
            'Project Manager',
            'Digital Marketing (Ads)'
        ];
        foreach ($positions as $position) {
            Position::create([
                'name' => $position,
            ]);
        }

        $sows = [
            'IG Feed',
            'IG Story',
            'IG Reels',
            'IG Live',
            'Tiktok',
            'Tiktok Live',
            'Youtube',
            'Attandance'
        ]; 
        foreach ($sows as $sow) {
            Sow::create([
                'name' => $sow,
            ]);
        }

        $categories = [
            'Model, Fashion',
            'Food',
            'Dancer, Singer',
            'Education',
            'Travel',
            'Finance',
            'Beauty',
            'Health',
            'Mom',
            'Lifestyle',
            'Music',
            'Sport',
            'Entertaiment',
            'Otomotif',
            'Gadget'
        ];
        foreach ($categories as $category) {
            Category::create([
                'name' => $category,
            ]);
        }
    }
}
