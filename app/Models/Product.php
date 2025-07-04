<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public function variants(){
        return $this->hasMany(ProductVariant::class);
    }

    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function productGallery(){
        return $this->hasMany(ProductImageGallery::class);
    }

    public function brand(){
        return $this->belongsTo(Brand::class);
    }

    public function vendor(){
        return $this->belongsTo(User::class);
    }

    public function admin(){
        return $this->belongsTo(Admin::class);
    }

    public function reviews(){
        return $this->hasMany(Review::class);
    }
}
