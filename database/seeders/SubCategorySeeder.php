<?php

namespace Database\Seeders;

use App\Models\SubCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SubCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
          // SubCategory Seeder
       $subCategories = [
            // Electronics subcategories
            [
                'category_id' => 1,
                'name' => 'Smartphones',
                'slug' => 'smartphones',
                'status' => true
            ],
            [
                'category_id' => 1,
                'name' => 'Laptops',
                'slug' => 'laptops',
                'status' => true
            ],
            // Fashion subcategories
            [
                'category_id' => 2,
                'name' => "Men's Clothing",
                'slug' => 'mens-clothing',
                'status' => true
            ],
            [
                'category_id' => 2,
                'name' => "Women's Clothing",
                'slug' => 'womens-clothing',
                'status' => true
            ],
            // Home & Kitchen subcategories
            [
                'category_id' => 3,
                'name' => 'Furniture',
                'slug' => 'furniture',
                'status' => true
            ],
            [
                'category_id' => 3,
                'name' => 'Kitchen Appliances',
                'slug' => 'kitchen-appliances',
                'status' => true
            ],
            // Beauty subcategories
            [
                'category_id' => 4,
                'name' => 'Skincare',
                'slug' => 'skincare',
                'status' => true
            ],
            [
                'category_id' => 4,
                'name' => 'Makeup',
                'slug' => 'makeup',
                'status' => true
            ],
            // Sports subcategories
            [
                'category_id' => 5,
                'name' => 'Fitness Equipment',
                'slug' => 'fitness-equipment',
                'status' => true
            ],
            [
                'category_id' => 5,
                'name' => 'Outdoor Gear',
                'slug' => 'outdoor-gear',
                'status' => true
            ]
        ];

        SubCategory::insert($subCategories);
    }
}
