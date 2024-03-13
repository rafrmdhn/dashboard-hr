<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Intern>
 */
class InternFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'email' => $this->faker->unique()->safeEmail(),
            'name' => $this->faker->name(),
            'photo' => $this->withPhoto($this->faker->image('public/storage/images/interns', 300, 300)),
            'biography' => $this->faker->paragraph(mt_rand(3, 5)),
            'university' => $this->faker->company(),
            'instagram' => $this->faker->userName(),
            'linkedin' => $this->faker->userName(),
            'position_id' => mt_rand(1, 11)
        ];
    }

    public function  withPhoto($path)
    {
        $pathWithoutPublic = str_replace('public/', '', $path);

        return $pathWithoutPublic;
    }
}
