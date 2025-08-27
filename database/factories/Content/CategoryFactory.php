<?php

namespace Database\Factories\Content;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Content\Category>
 */
class CategoryFactory extends Factory
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
            'name' => $name,
            'slug' => Str::slug($name) . '_' . Str::random(4),
            'description' => fake()->paragraph(),
            'position' => fake()->numberBetween(0, 100),
            'meta_title' => fake()->text(),
            'meta_description' => fake()->text(),
            'meta_keywords' => fake()->text(),
        ];
    }
}
