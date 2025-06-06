<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ChildCategory extends Model
{
    public function subCategory(){
        return $this->belongsTo(SubCategory::class);
    }

        public function Category(){
        return $this->belongsTo(Category::class);
    }
}
