<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            ['name' => 'Jerseys', 'slug' => 'jerseys'],
            ['name' => 'Pants', 'slug' => 'pants'],
            ['name' => 'Gloves', 'slug' => 'gloves'],
            ['name' => 'Goggles', 'slug' => 'goggles'],
            ['name' => 'Helmets', 'slug' => 'helmets'],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}
