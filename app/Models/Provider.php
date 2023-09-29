<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;


class Provider extends Authenticatable
{
    protected $table = 'providers';
    protected $fillable = [
        'id',
        'user_id',
        'address',
        'mobile',
        'phone',
        'about',
        'service_id',
        'experience',
        'expertise',
        'testimonials',
        'website_link',
        'contact_button',
        'deleted',
        'updated_at',
    ];

    private $descendants = [];
}
