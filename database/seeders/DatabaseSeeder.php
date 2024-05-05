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
use Database\Seeders\IndoRegionSeeder;

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

        // Call artisan for indo region
        $this->call(IndoRegionSeeder::class);

        // Get all village_id from database and store in array
        $villageIds = \App\Models\Village::pluck('id')->toArray();

        Intern::factory(20)->create();

        Staff::factory(20)->create([
            'village_id' => function() use ($villageIds) {
                return $villageIds[array_rand($villageIds)];
            },
        ]);
        
        Talent::factory(20)->create();

        Brand::factory(20)->create();

        Agency::factory(20)->create();

        

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

        Earning::factory(20)->create();

        # earning_sow
        $earnings = Earning::all();
        $sows = Sow::all();
        foreach ($earnings as $earning) {
            $randomSow = $sows->random();
            $earning->sows()->attach($randomSow, [
                'talent_rate' => rand(1000, 1000000),
                'note' => fake()->optional()->sentence(),
            ]);

            $randomSow2 = $sows->random();
            while($randomSow == $randomSow2) {
                $randomSow2 = $sows->random();
            }
            if(rand(0, 1)) {
                $earning->sows()->attach($randomSow2, [
                    'talent_rate' => rand(1000, 1000000),
                    'note' => fake()->optional()->sentence(),
                ]);
            }
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

        $brands = Brand::all();
        $talents = Talent::all();
        $categories = Category::all();
        foreach ($brands as $brand) {
            $randomCategory = $categories->random();
            $brand->categories()->attach($randomCategory);
        }
        foreach ($talents as $talent) {
            $randomCategory = $categories->random();
            $talent->categories()->attach($randomCategory);
        }
    }
}
