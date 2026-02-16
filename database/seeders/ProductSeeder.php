<?php

namespace Database\Seeders;

use App\Models\Content\Product;
use App\Models\Content\Section;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('category_product')->truncate();
        Product::truncate();
        $sections = Section::all()->each(function ($section) {
            $products = Product::factory(rand(20, 50))->make();
            $section->products()->saveMany($products);

            $categories = $section->categories;

            $section->products()->each(function ($product) use ($categories) {
                $product->categories()->sync($categories->random(rand(1, $categories->count()))->pluck('id')->toArray());
            });
        });
    }
}
