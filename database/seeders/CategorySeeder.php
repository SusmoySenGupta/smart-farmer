<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::factory()->count(100)->create();

        Category::create(['title' => 'leafy green']);
        Category::create(['title' => 'root']);
        Category::create(['title' => 'stem']);
        Category::create(['title' => 'legume']);
        Category::create(['title' => 'squash']);
        Category::create(['title' => 'fruit']);
        Category::create(['title' => 'tuber']);
        Category::create(['title' => 'flower']);
        Category::create(['title' => 'herb']);
    }
}
