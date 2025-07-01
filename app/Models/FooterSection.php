<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FooterSection extends Model
{
    protected $fillable = [
        'logo',
        'phone',
        'email',
        'address',
        'copyright',
        'fb_link',
        'twitter_link',
        'instagram_link',
        'youtube_link',
        'linkedin_link',
        'pinterest_link',
        'tiktok_link',
        'whatsapp_link',    
        'gateway_logo'
    ];
}
