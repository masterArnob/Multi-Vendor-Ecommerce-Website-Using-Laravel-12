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
}
