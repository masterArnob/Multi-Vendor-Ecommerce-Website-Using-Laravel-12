<?php

namespace Database\Seeders;

use App\Models\ProductVariantItem;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductVariantItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         $variantItems = [
            // iPhone 15 Pro storage (admin)
            ['product_variant_id'=>1, 'product_id'=>1, 'admin_id'=>1, 'vendor_id'=>0, 'name'=>'128GB', 'price'=>999.00, 'is_default'=>false, 'status'=>true, 'created_at'=>now(), 'updated_at'=>now()],
            ['product_variant_id'=>1, 'product_id'=>1, 'admin_id'=>1, 'vendor_id'=>0, 'name'=>'256GB', 'price'=>1099.00, 'is_default'=>true, 'status'=>true, 'created_at'=>now(), 'updated_at'=>now()],
            
            // iPhone 15 Pro colors (admin)
            ['product_variant_id'=>2, 'product_id'=>1, 'admin_id'=>1, 'vendor_id'=>0, 'name'=>'Titanium', 'price'=>0, 'is_default'=>true, 'status'=>true, 'created_at'=>now(), 'updated_at'=>now()],
            
            // MacBook Pro RAM (admin)
            ['product_variant_id'=>3, 'product_id'=>2, 'admin_id'=>1, 'vendor_id'=>0, 'name'=>'16GB', 'price'=>0, 'is_default'=>true, 'status'=>true, 'created_at'=>now(), 'updated_at'=>now()],
            
            // MacBook Pro storage (admin)
            ['product_variant_id'=>4, 'product_id'=>2, 'admin_id'=>1, 'vendor_id'=>0, 'name'=>'512GB SSD', 'price'=>0, 'is_default'=>true, 'status'=>true, 'created_at'=>now(), 'updated_at'=>now()],
            
            // Sony Headphones colors (admin)
            ['product_variant_id'=>5, 'product_id'=>3, 'admin_id'=>1, 'vendor_id'=>0, 'name'=>'Black', 'price'=>0, 'is_default'=>true, 'status'=>true, 'created_at'=>now(), 'updated_at'=>now()],
            
            // LG TV sizes (admin)
            ['product_variant_id'=>8, 'product_id'=>7, 'admin_id'=>1, 'vendor_id'=>0, 'name'=>'55-inch', 'price'=>1999.00, 'is_default'=>false, 'status'=>true, 'created_at'=>now(), 'updated_at'=>now()],
            ['product_variant_id'=>8, 'product_id'=>7, 'admin_id'=>1, 'vendor_id'=>0, 'name'=>'65-inch', 'price'=>2499.00, 'is_default'=>true, 'status'=>true, 'created_at'=>now(), 'updated_at'=>now()],
            
            // Apple Watch colors (admin)
            ['product_variant_id'=>10, 'product_id'=>8, 'admin_id'=>1, 'vendor_id'=>0, 'name'=>'Midnight', 'price'=>0, 'is_default'=>true, 'status'=>true, 'created_at'=>now(), 'updated_at'=>now()],
            
            // Samsung Galaxy storage (vendor1)
            ['product_variant_id'=>11, 'product_id'=>11, 'admin_id'=>0, 'vendor_id'=>1, 'name'=>'256GB', 'price'=>1199.99, 'is_default'=>true, 'status'=>true, 'created_at'=>now(), 'updated_at'=>now()],
            
            // Samsung Galaxy colors (vendor1)
            ['product_variant_id'=>12, 'product_id'=>11, 'admin_id'=>0, 'vendor_id'=>1, 'name'=>'Phantom Black', 'price'=>0, 'is_default'=>true, 'status'=>true, 'created_at'=>now(), 'updated_at'=>now()],
            
            // Nike Shoes sizes (vendor2)
            ['product_variant_id'=>13, 'product_id'=>12, 'admin_id'=>0, 'vendor_id'=>2, 'name'=>'US 8', 'price'=>0, 'is_default'=>false, 'status'=>true, 'created_at'=>now(), 'updated_at'=>now()],
            ['product_variant_id'=>13, 'product_id'=>12, 'admin_id'=>0, 'vendor_id'=>2, 'name'=>'US 9', 'price'=>0, 'is_default'=>true, 'status'=>true, 'created_at'=>now(), 'updated_at'=>now()],
            
            // Levi's Jeans waist sizes (vendor1)
            ['product_variant_id'=>14, 'product_id'=>13, 'admin_id'=>0, 'vendor_id'=>1, 'name'=>'32', 'price'=>0, 'is_default'=>false, 'status'=>true, 'created_at'=>now(), 'updated_at'=>now()],
            
            // Zara Blazer sizes (vendor1)
            ['product_variant_id'=>17, 'product_id'=>15, 'admin_id'=>0, 'vendor_id'=>1, 'name'=>'S', 'price'=>0, 'is_default'=>false, 'status'=>true, 'created_at'=>now(), 'updated_at'=>now()],
            
            // KitchenAid Mixer colors (vendor2)
            ['product_variant_id'=>19, 'product_id'=>16, 'admin_id'=>0, 'vendor_id'=>2, 'name'=>'Empire Red', 'price'=>0, 'is_default'=>true, 'status'=>true, 'created_at'=>now(), 'updated_at'=>now()],
            
            // L'Oréal Skincare types (vendor1)
            ['product_variant_id'=>20, 'product_id'=>17, 'admin_id'=>0, 'vendor_id'=>1, 'name'=>'Dry Skin', 'price'=>0, 'is_default'=>false, 'status'=>true, 'created_at'=>now(), 'updated_at'=>now()],
            ['product_variant_id'=>20, 'product_id'=>17, 'admin_id'=>0, 'vendor_id'=>1, 'name'=>'Oily Skin', 'price'=>0, 'is_default'=>false, 'status'=>true, 'created_at'=>now(), 'updated_at'=>now()]
        ];
        ProductVariantItem::insert($variantItems);
    }
}
