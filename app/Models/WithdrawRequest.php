<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WithdrawRequest extends Model
{
    public function vendor(){
        return $this->belongsTo(User::class);
    }
}
