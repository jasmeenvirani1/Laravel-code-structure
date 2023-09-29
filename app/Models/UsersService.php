<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;


class UsersService extends Authenticatable
{
    protected $table = 'users_services';
    protected $fillable = [
        'id',
        'user_id',
        'service',
        'updated_at',
    ];

    private $descendants = [];
}
