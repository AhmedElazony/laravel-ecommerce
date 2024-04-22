<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Store>
 */
class StoreFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $name = $this->faker->unique()->words(2, true);

        return [
            'name' => $name,
            'slug' => Str::slug($name),
            'description' => $this->faker->text(),
            'logo_image' => $this->faker->imageUrl(300, 300),
            'cover_image' => $this->faker->imageUrl(600, 600),
            'status' => array_rand(['active' => 0, 'inactive' => 1])
        ];
    }
}
