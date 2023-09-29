<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;


class SocialMediaLink extends Authenticatable
{

    protected $table = 'social_media_links';
    protected $fillable = [
        'id',
        'user_id',
        'name',
        'social_media_link',
        'status',
        'deleted',
        'updated_at',
    ];

    private $descendants = [];
}
