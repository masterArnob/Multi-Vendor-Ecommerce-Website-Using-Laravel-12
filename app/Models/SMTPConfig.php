<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SMTPConfig extends Model
{
    protected $fillable = [
        'email',
        'host',
        'username',
        'password',
        'port',
        'encryption',
        'status'
    ];
}
