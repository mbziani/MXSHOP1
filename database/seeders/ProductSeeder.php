<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $products = [
            [
                'name' => 'Fox Racing 180 Jersey',
                'slug' => 'fox-racing-180-jersey',
                'description' => 'High-performance motocross jersey with moisture-wicking technology',
                'price' => 49.99,
                'stock' => 50,
                'image' => 'https://via.placeholder.com/400x400?text=Fox+Jersey',
                'brand' => 'Fox Racing',
                'size' => 'M,L,XL',
                'color' => 'Blue/White',
                'category' => 'jerseys'
            ],
            [
                'name' => 'Alpinestars Tech 5 Pants',
                'slug' => 'alpinestars-tech-5-pants',
                'description' => 'Durable motocross pants with leather heat guards',
                'price' => 159.99,
                'stock' => 30,
                'image' => 'https://via.placeholder.com/400x400?text=Alpinestars+Pants',
                'brand' => 'Alpinestars',
                'size' => '30,32,34',
                'color' => 'Black/Red',
                'category' => 'pants'
            ],
            [
                'name' => '100% Racecraft Goggles',
                'slug' => '100-percent-racecraft-goggles',
                'description' => 'Premium motocross goggles with anti-fog lens',
                'price' => 69.99,
                'stock' => 40,
                'image' => 'https://via.placeholder.com/400x400?text=Racecraft+Goggles',
                'brand' => '100%',
                'color' => 'Black',
                'category' => 'goggles'
            ],
            [
                'name' => 'Bell Moto-9 Helmet',
                'slug' => 'bell-moto-9-helmet',
                'description' => 'Top-tier motocross helmet with MIPS technology',
                'price' => 399.99,
                'stock' => 20,
                'image' => 'https://via.placeholder.com/400x400?text=Bell+Helmet',
                'brand' => 'Bell',
                'size' => 'S,M,L,XL',
                'color' => 'Matte Black',
                'category' => 'helmets'
            ],
            [
                'name' => 'Thor Guard Gloves',
                'slug' => 'thor-guard-gloves',
                'description' => 'Lightweight motocross gloves with silicone grip',
                'price' => 29.99,
                'stock' => 100,
                'image' => 'https://via.placeholder.com/400x400?text=Thor+Gloves',
                'brand' => 'Thor',
                'size' => 'S,M,L,XL',
                'color' => 'Red/Black',
                'category' => 'gloves'
            ],
        ];

        foreach ($products as $product) {
            $category = Category::where('slug', $product['category'])->first();
            unset($product['category']);
            $product['category_id'] = $category->id;
            Product::create($product);
        }
    }
}
