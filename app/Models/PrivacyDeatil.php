<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;


class PrivacyDeatil extends Authenticatable
{

    protected $table = 'privacy_deatils';
    protected $fillable = [
        'id',
        'user_id',
        'profile_public',
        'chat_button',
        'email',
        'social_media_link',
        'location',
        'deleted',
        'updated_at',
    ];

    private $descendants = [];
}
