<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;


class User extends Authenticatable
{

    protected $table = 'users';
    protected $fillable = [
        'id',
        'role_id',
        'name',
        'mobile',
        'password',
        'is_disable',
        'fees',
        'status',
        'api_token',
        'deleted',
        'updated_at',
    ];
    
    private $descendants = [];
}
