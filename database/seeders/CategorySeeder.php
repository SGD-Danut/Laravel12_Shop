<?php

namespace Database\Seeders;

use App\Models\Content\Category;
use App\Models\Content\Section;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Category::truncate();
        $sections = Section::all()->each(function ($section) {
            $categories = Category::factory(rand(4, 8))->make();
            $section->categories()->saveMany($categories);
        });
    }
}
