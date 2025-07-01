<?php

namespace Database\Seeders;

use App\Models\ChildCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ChildCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         $childCategories = [
            // Smartphones child categories
            [
                'category_id' => 1,
                'sub_category_id' => 1,
                'name' => 'Android Phones',
                'slug' => 'android-phones',
                'status' => true
            ],
            [
                'category_id' => 1,
                'sub_category_id' => 1,
                'name' => 'iPhones',
                'slug' => 'iphones',
                'status' => true
            ],
            // Laptops child categories
            [
                'category_id' => 1,
                'sub_category_id' => 2,
                'name' => 'Gaming Laptops',
                'slug' => 'gaming-laptops',
                'status' => true
            ],
            [
                'category_id' => 1,
                'sub_category_id' => 2,
                'name' => 'Ultrabooks',
                'slug' => 'ultrabooks',
                'status' => true
            ],
            // Men's Clothing child categories
            [
                'category_id' => 2,
                'sub_category_id' => 3,
                'name' => 'T-Shirts',
                'slug' => 'mens-t-shirts',
                'status' => true
            ],
            [
                'category_id' => 2,
                'sub_category_id' => 3,
                'name' => 'Jeans',
                'slug' => 'mens-jeans',
                'status' => true
            ],
            // Women's Clothing child categories
            [
                'category_id' => 2,
                'sub_category_id' => 4,
                'name' => 'Dresses',
                'slug' => 'womens-dresses',
                'status' => true
            ],
            [
                'category_id' => 2,
                'sub_category_id' => 4,
                'name' => 'Tops',
                'slug' => 'womens-tops',
                'status' => true
            ],
            // Kitchen Appliances child categories
            [
                'category_id' => 3,
                'sub_category_id' => 6,
                'name' => 'Blenders',
                'slug' => 'blenders',
                'status' => true
            ],
            [
                'category_id' => 3,
                'sub_category_id' => 6,
                'name' => 'Coffee Makers',
                'slug' => 'coffee-makers',
                'status' => true
            ]
        ];
          ChildCategory::insert($childCategories);
    }
}
