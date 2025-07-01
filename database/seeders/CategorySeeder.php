<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
          $categories = [
            [
                'name' => 'Electronics',
                'slug' => 'electronics',
                'icon' => 'uploads/categories/electronics.png',
                'status' => true
            ],
            [
                'name' => 'Fashion',
                'slug' => 'fashion',
                'icon' => 'uploads/categories/fashion.png',
                'status' => true
            ],
            [
                'name' => 'Home & Kitchen',
                'slug' => 'home-kitchen',
                'icon' => 'uploads/categories/home-kitchen.png',
                'status' => true
            ],
            [
                'name' => 'Beauty & Personal Care',
                'slug' => 'beauty-personal-care',
                'icon' => 'uploads/categories/beauty.png',
                'status' => true
            ],
            [
                'name' => 'Sports & Outdoors',
                'slug' => 'sports-outdoors',
                'icon' => 'uploads/categories/sports.png',
                'status' => true
            ],
            [
                'name' => 'Toys & Games',
                'slug' => 'toys-games',
                'icon' => 'uploads/categories/toys.png',
                'status' => true
            ],
            [
                'name' => 'Books',
                'slug' => 'books',
                'icon' => 'uploads/categories/books.png',
                'status' => true
            ],
            [
                'name' => 'Automotive',
                'slug' => 'automotive',
                'icon' => 'uploads/categories/automotive.png',
                'status' => true
            ],
            [
                'name' => 'Health & Wellness',
                'slug' => 'health-wellness',
                'icon' => 'uploads/categories/health.png',
                'status' => true
            ],
            [
                'name' => 'Groceries',
                'slug' => 'groceries',
                'icon' => 'uploads/categories/groceries.png',
                'status' => true
            ]
        ];
        Category::insert($categories);
    }
}
