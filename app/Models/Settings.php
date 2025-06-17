<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Settings extends Model
{
    protected $fillable = [
        'site_name',
        'layout',
        'site_description',
        'contact_email',
        'contact_phone',
        'contact_address',
        'map',
        'currency_name',
        'currency_icon',
        'time_zone'
    ];

    public $timestamps = false;
}


