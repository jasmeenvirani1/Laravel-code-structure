<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;


class Seeker extends Authenticatable
{

    protected $table = 'seekers';
    protected $fillable = [
        'id',
        'user_id',
        'location',
        'mobile',
        'instagram',
        'tiktok',
        'facebook',
        'youtube',
        'twitter',
        'linkedin',
        'login_time_notifaction',
        'recive_email_notifaction',
        'newsletter_notifaction',
        'status',
        'deleted',
        'updated_at',
    ];

    private $descendants = [];
}
