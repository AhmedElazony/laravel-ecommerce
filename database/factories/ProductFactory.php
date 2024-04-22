<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Store;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $name = $this->faker->unique()->words(5, true);

        return [
            'name' => $name,
            'slug' => Str::slug($name),
            'description' => $this->faker->text(),
            'image' => $this->faker->imageUrl(600, 600),
            'price' => $this->faker->randomFloat(2, 10, 100),
            'featured' => $this->faker->boolean(),
            'status' => array_rand(['active' => 0, 'draft' => 1, 'archived' => 2]),
            'category_id' => Category::factory(),
            'store_id' => Store::inRandomOrder()->first()->id
        ];
    }
}
