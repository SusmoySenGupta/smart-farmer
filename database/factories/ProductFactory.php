<?php

namespace Database\Factories;

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
    public function definition()
    {
        return [
            'title' => Str::title($this->faker->words(2, true)),
            'slug' => $this->faker->slug,
            'description' => $this->faker->paragraph,
            'price' => $this->faker->numberBetween(100, 10000),
            'stock' => $this->faker->numberBetween(0, 100),
            'is_active' => $this->faker->boolean,
            'image_url' => null,
            'category_id' => $this->faker->numberBetween(1, 10),
            'user_id' => $this->faker->randomElement([2, 4]),
        ];
    }
}
