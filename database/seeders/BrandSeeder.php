<?php

namespace Database\Seeders;

use App\Models\Brand;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
          $brands = [
            // Electronics brands
            [
                'logo' => 'uploads/brands/apple.png',
                'name' => 'Apple',
                'slug' => 'apple',
                'is_featured' => true,
                'status' => true
            ],
            [
                'logo' => 'uploads/brands/samsung.png',
                'name' => 'Samsung',
                'slug' => 'samsung',
                'is_featured' => true,
                'status' => true
            ],
            [
                'logo' => 'uploads/brands/sony.png',
                'name' => 'Sony',
                'slug' => 'sony',
                'is_featured' => true,
                'status' => true
            ],
            [
                'logo' => 'uploads/brands/lg.png',
                'name' => 'LG',
                'slug' => 'lg',
                'is_featured' => false,
                'status' => true
            ],
            // Fashion brands
            [
                'logo' => 'uploads/brands/nike.png',
                'name' => 'Nike',
                'slug' => 'nike',
                'is_featured' => true,
                'status' => true
            ],
            [
                'logo' => 'uploads/brands/adidas.png',
                'name' => 'Adidas',
                'slug' => 'adidas',
                'is_featured' => true,
                'status' => true
            ],
            [
                'logo' => 'uploads/brands/zara.png',
                'name' => 'Zara',
                'slug' => 'zara',
                'is_featured' => false,
                'status' => true
            ],
            [
                'logo' => 'uploads/brands/hm.png',
                'name' => 'H&M',
                'slug' => 'h&m',
                'is_featured' => false,
                'status' => true
            ],
            // Home & Kitchen brands
            [
                'logo' => 'uploads/brands/ikea.png',
                'name' => 'IKEA',
                'slug' => 'ikea',
                'is_featured' => true,
                'status' => true
            ],
            [
                'logo' => 'uploads/brands/kitchenaid.png',
                'name' => 'KitchenAid',
                'slug' => 'kitchenaid',
                'is_featured' => false,
                'status' => true
            ],
            // Beauty brands
            [
                'logo' => 'uploads/brands/loreal.png',
                'name' => "L'Oréal",
                'slug' => 'loreal',
                'is_featured' => true,
                'status' => true
            ],
            [
                'logo' => 'uploads/brands/maybelline.png',
                'name' => 'Maybelline',
                'slug' => 'maybelline',
                'is_featured' => false,
                'status' => true
            ],
            // Sports brands
            [
                'logo' => 'uploads/brands/underarmour.png',
                'name' => 'Under Armour',
                'slug' => 'under-armour',
                'is_featured' => false,
                'status' => true
            ],
            [
                'logo' => 'uploads/brands/puma.png',
                'name' => 'Puma',
                'slug' => 'puma',
                'is_featured' => false,
                'status' => true
            ],
            // Other brands
            [
                'logo' => 'uploads/brands/levis.png',
                'name' => 'Levi\'s',
                'slug' => 'levis',
                'is_featured' => false,
                'status' => true
            ],
            [
                'logo' => 'uploads/brands/dell.png',
                'name' => 'Dell',
                'slug' => 'dell',
                'is_featured' => false,
                'status' => true
            ],
            [
                'logo' => 'uploads/brands/hp.png',
                'name' => 'HP',
                'slug' => 'hp',
                'is_featured' => false,
                'status' => true
            ],
            [
                'logo' => 'uploads/brands/canon.png',
                'name' => 'Canon',
                'slug' => 'canon',
                'is_featured' => false,
                'status' => true
            ],
            [
                'logo' => 'uploads/brands/bosch.png',
                'name' => 'Bosch',
                'slug' => 'bosch',
                'is_featured' => false,
                'status' => true
            ],
            [
                'logo' => 'uploads/brands/philips.png',
                'name' => 'Philips',
                'slug' => 'philips',
                'is_featured' => false,
                'status' => true
            ]
        ];
         Brand::insert($brands);
    }
}
