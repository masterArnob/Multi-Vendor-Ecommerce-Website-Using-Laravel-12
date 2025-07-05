<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Maintainance extends Model
{
    protected $fillable = [
        'secret_key',
        'mode',
        'down_url'
    ];
}
