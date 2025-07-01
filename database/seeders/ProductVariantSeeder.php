<?php

namespace Database\Seeders;

use App\Models\ProductVariant;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductVariantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         $variants = [
            // iPhone 15 Pro (admin)
            ['admin_id'=>1, 'vendor_id'=>0, 'product_id'=>1, 'name'=>'Storage', 'status'=>true, 'created_at'=>now(), 'updated_at'=>now()],
            ['admin_id'=>1, 'vendor_id'=>0, 'product_id'=>1, 'name'=>'Color', 'status'=>true, 'created_at'=>now(), 'updated_at'=>now()],
            
            // MacBook Pro (admin)
            ['admin_id'=>1, 'vendor_id'=>0, 'product_id'=>2, 'name'=>'RAM', 'status'=>true, 'created_at'=>now(), 'updated_at'=>now()],
            ['admin_id'=>1, 'vendor_id'=>0, 'product_id'=>2, 'name'=>'Storage', 'status'=>true, 'created_at'=>now(), 'updated_at'=>now()],
            
            // Sony Headphones (admin)
            ['admin_id'=>1, 'vendor_id'=>0, 'product_id'=>3, 'name'=>'Color', 'status'=>true, 'created_at'=>now(), 'updated_at'=>now()],
            
            // Dell XPS (admin)
            ['admin_id'=>1, 'vendor_id'=>0, 'product_id'=>4, 'name'=>'Processor', 'status'=>true, 'created_at'=>now(), 'updated_at'=>now()],
            ['admin_id'=>1, 'vendor_id'=>0, 'product_id'=>4, 'name'=>'Graphics', 'status'=>true, 'created_at'=>now(), 'updated_at'=>now()],
            
            // Canon Camera (admin)
            ['admin_id'=>1, 'vendor_id'=>0, 'product_id'=>5, 'name'=>'Lens Kit', 'status'=>true, 'created_at'=>now(), 'updated_at'=>now()],
            
            // LG TV (admin)
            ['admin_id'=>1, 'vendor_id'=>0, 'product_id'=>7, 'name'=>'Size', 'status'=>true, 'created_at'=>now(), 'updated_at'=>now()],
            
            // Apple Watch (admin)
            ['admin_id'=>1, 'vendor_id'=>0, 'product_id'=>8, 'name'=>'Size', 'status'=>true, 'created_at'=>now(), 'updated_at'=>now()],
            ['admin_id'=>1, 'vendor_id'=>0, 'product_id'=>8, 'name'=>'Color', 'status'=>true, 'created_at'=>now(), 'updated_at'=>now()],
            
            // Samsung Galaxy (vendor1)
            ['admin_id'=>0, 'vendor_id'=>1, 'product_id'=>11, 'name'=>'Storage', 'status'=>true, 'created_at'=>now(), 'updated_at'=>now()],
            ['admin_id'=>0, 'vendor_id'=>1, 'product_id'=>11, 'name'=>'Color', 'status'=>true, 'created_at'=>now(), 'updated_at'=>now()],
            
            // Nike Shoes (vendor2)
            ['admin_id'=>0, 'vendor_id'=>2, 'product_id'=>12, 'name'=>'Size', 'status'=>true, 'created_at'=>now(), 'updated_at'=>now()],
            
            // Levi's Jeans (vendor1)
            ['admin_id'=>0, 'vendor_id'=>1, 'product_id'=>13, 'name'=>'Waist Size', 'status'=>true, 'created_at'=>now(), 'updated_at'=>now()],
            ['admin_id'=>0, 'vendor_id'=>1, 'product_id'=>13, 'name'=>'Length', 'status'=>true, 'created_at'=>now(), 'updated_at'=>now()],
            
            // Adidas Shoes (vendor2)
            ['admin_id'=>0, 'vendor_id'=>2, 'product_id'=>14, 'name'=>'Size', 'status'=>true, 'created_at'=>now(), 'updated_at'=>now()],
            
            // Zara Blazer (vendor1)
            ['admin_id'=>0, 'vendor_id'=>1, 'product_id'=>15, 'name'=>'Size', 'status'=>true, 'created_at'=>now(), 'updated_at'=>now()],
            ['admin_id'=>0, 'vendor_id'=>1, 'product_id'=>15, 'name'=>'Color', 'status'=>true, 'created_at'=>now(), 'updated_at'=>now()],
            
            // KitchenAid Mixer (vendor2)
            ['admin_id'=>0, 'vendor_id'=>2, 'product_id'=>16, 'name'=>'Color', 'status'=>true, 'created_at'=>now(), 'updated_at'=>now()],
            
            // L'Oréal Skincare (vendor1)
            ['admin_id'=>0, 'vendor_id'=>1, 'product_id'=>17, 'name'=>'Skin Type', 'status'=>true, 'created_at'=>now(), 'updated_at'=>now()]
        ];

         ProductVariant::insert($variants);
    }
}
