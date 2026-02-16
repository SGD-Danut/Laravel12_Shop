<?php

namespace Database\Factories\Content;

use Illuminate\Support\Str;
use App\Models\Content\Brand;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Content\Product>
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

        $name = fake()->sentence(4);

        return [
            'brand_id' => Brand::all()->random()->id,
            'name' => $name,
            'slug' => Str::slug($name) . '_' . Str::random(4),
            'description' => fake()->randomHtml(),
            'views' => rand(20, 400),
            'price' => rand(10, 1400),
            'discount' => fake()->randomElement([5, 10, 15, 20]),
            'stock' => fake()->numberBetween(10, 400),
            'position' => fake()->randomElement([10, 20, 30, 40, 50, 60, 70, 80, 90, 100]),
            'meta_title' => fake()->text(),
            'meta_description' => fake()->text(),
            'meta_keywords' => fake()->text(),
        ];
    }
}
