<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderProduct extends Model
{
    public function product(){
        return $this->belongsTo(Product::class);
    }


    public function vendor(){
        return $this->belongsTo(User::class);
    }
}
