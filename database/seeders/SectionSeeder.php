<?php

namespace Database\Seeders;

use App\Models\Content\Section;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class SectionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Section::truncate();
        Section::factory(6)->create();
    }
}
