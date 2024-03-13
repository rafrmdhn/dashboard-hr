<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Staff>
 */
class StaffFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'biography' => $this->faker->paragraph(mt_rand(3, 5)),
            'instagram' => $this->faker->userName(),
            'linkedin' => $this->faker->userName(),
            'photo' => $this->withPhoto($this->faker->image('public/storage/images/staffs', 300, 300)),
            'position_id' => mt_rand(1, 11)
        ];
    }

    public function  withPhoto($path)
    {
        $pathWithoutPublic = str_replace('public/', '', $path);

        return $pathWithoutPublic;
    }
}
