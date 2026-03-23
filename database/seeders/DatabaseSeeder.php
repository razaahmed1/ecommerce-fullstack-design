<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Users
        User::updateOrCreate(['email' => 'admin@autopartshub.com'], [
            'name' => 'VIP Admin',
            'role' => 'admin',
            'password' => bcrypt('password'), // password
        ]);

        // Categories matching the image strip exactly
        $categories = [
            ['name' => 'Car Accessories', 'slug' => 'car-accessories', 'icon' => 'grid-fill'],
            ['name' => 'Car Care', 'slug' => 'car-care', 'icon' => 'stars'],
            ['name' => 'Oil & Additives', 'slug' => 'oil-additives', 'icon' => 'droplet-fill'],
            ['name' => 'Car Filter', 'slug' => 'car-filter', 'icon' => 'funnel-fill'],
            ['name' => 'Car Electronics', 'slug' => 'car-electronics', 'icon' => 'cpu-fill'],
            ['name' => 'LED Lights', 'slug' => 'led-lights', 'icon' => 'lightbulb-fill'],
            ['name' => 'Car Parts', 'slug' => 'car-parts', 'icon' => 'gear-fill'],
        ];

        foreach ($categories as $cat) {
            DB::table('categories')->updateOrInsert(['slug' => $cat['slug']], [
                'name' => $cat['name'],
                'icon' => $cat['icon'],
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        // Brands
        $brands = [
            ['name' => 'Generic', 'slug' => 'generic'],
            ['name' => 'Turtle Wax', 'slug' => 'turtle-wax'],
            ['name' => 'Liqui Moly', 'slug' => 'liqui-moly'],
            ['name' => 'Philips', 'slug' => 'philips'],
            ['name' => 'Pioneer', 'slug' => 'pioneer'],
            ['name' => 'K&N', 'slug' => 'k-and-n'],
        ];

        foreach ($brands as $brand) {
            DB::table('brands')->updateOrInsert(['slug' => $brand['slug']], [
                'name' => $brand['name'],
                'logo' => null,
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        // Products
        $products = [
            // Car Accessories
            [
                'name' => 'Premium 7D Custom Fit Leather Car Mats - Black/Red',
                'category_slug' => 'car-accessories',
                'brand_slug' => 'generic',
                'price' => 125.00,
                'old_price' => 160.00,
                'is_featured' => true,
                'is_new' => true,
                'stock' => 15,
                'image' => 'https://images.unsplash.com/photo-1542282088-72c9c27ed0cd?auto=format&fit=crop&w=600&q=80',
            ],
            [
                'name' => 'Waterproof All-Weather Premium Car Cover',
                'category_slug' => 'car-accessories',
                'brand_slug' => 'generic',
                'price' => 65.99,
                'old_price' => null,
                'is_featured' => false,
                'is_new' => false,
                'stock' => 40,
                'image' => 'https://images.unsplash.com/photo-1492144534655-ae79c964c9d7?auto=format&fit=crop&w=600&q=80',
            ],
            // Car Care
            [
                'name' => 'Turtle Wax Hybrid Solutions Ceramic Spray Coating',
                'category_slug' => 'car-care',
                'brand_slug' => 'turtle-wax',
                'price' => 19.99,
                'old_price' => 24.99,
                'is_featured' => true,
                'is_new' => false,
                'stock' => 120,
                'image' => 'https://images.unsplash.com/photo-1619642751034-765dfdf7c58e?auto=format&fit=crop&w=600&q=80',
            ],
            // Oil & Additives
            [
                'name' => 'Liqui Moly Ceratec Engine Wear Protection (300ml)',
                'category_slug' => 'oil-additives',
                'brand_slug' => 'liqui-moly',
                'price' => 28.50,
                'old_price' => null,
                'is_featured' => true,
                'is_new' => true,
                'stock' => 85,
                'image' => 'https://images.unsplash.com/photo-1635316524388-72de6f3be4fb?auto=format&fit=crop&w=600&q=80',
            ],
            [
                'name' => 'Liqui Moly Molygen New Generation 5W-40',
                'category_slug' => 'oil-additives',
                'brand_slug' => 'liqui-moly',
                'price' => 45.99,
                'old_price' => 52.00,
                'is_featured' => false,
                'is_new' => false,
                'stock' => 3, // low stock test
                'image' => 'https://images.unsplash.com/photo-1510468087948-d3e9c6f2a281?auto=format&fit=crop&w=600&q=80',
            ],
            // Car Electronics
            [
                'name' => 'Pioneer DMH-W4600NEX Apple CarPlay Receiver',
                'category_slug' => 'car-electronics',
                'brand_slug' => 'pioneer',
                'price' => 649.00,
                'old_price' => 699.00,
                'is_featured' => true,
                'is_new' => true,
                'stock' => 8,
                'image' => 'https://images.unsplash.com/photo-1610444583162-8e1008be5dd7?auto=format&fit=crop&w=600&q=80',
            ],
            // LED Lights
            [
                'name' => 'Philips Ultinon Pro9000 LED Headlight Bulbs',
                'category_slug' => 'led-lights',
                'brand_slug' => 'philips',
                'price' => 145.00,
                'old_price' => null,
                'is_featured' => true,
                'is_new' => false,
                'stock' => 25,
                'image' => 'https://images.unsplash.com/photo-1555543444-2f22b826b651?auto=format&fit=crop&w=600&q=80',
            ],
            // Car Filter
            [
                'name' => 'K&N High Performance Replacement Air Filter',
                'category_slug' => 'car-filter',
                'brand_slug' => 'k-and-n',
                'price' => 55.00,
                'old_price' => 65.00,
                'is_featured' => false,
                'is_new' => false,
                'stock' => 18,
                'image' => 'https://images.unsplash.com/photo-1620021545645-ec09e51cceba?auto=format&fit=crop&w=600&q=80',
            ],
        ];

        foreach ($products as $prod) {
            $catId = DB::table('categories')->where('slug', $prod['category_slug'])->value('id');
            $brandId = DB::table('brands')->where('slug', $prod['brand_slug'])->value('id');
            $slug = Str::slug($prod['name']);

            $productId = DB::table('products')->updateOrInsert(['slug' => $slug], [
                'name' => $prod['name'],
                'description' => 'A highly requested authentic automotive accessory, verified for quality.',
                'price' => $prod['price'],
                'old_price' => $prod['old_price'],
                'sku' => strtoupper(Str::random(8)),
                'stock' => $prod['stock'] ?? 10,
                'category_id' => $catId,
                'brand_id' => $brandId,
                'is_featured' => $prod['is_featured'],
                'is_new' => $prod['is_new'] ?? false,
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            $actualProdId = DB::table('products')->where('slug', $slug)->value('id');

            DB::table('product_images')->updateOrInsert(['product_id' => $actualProdId], [
                'image_path' => $prod['image'],
                'is_primary' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
