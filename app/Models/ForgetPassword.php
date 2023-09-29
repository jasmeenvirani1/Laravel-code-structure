<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;


class ForgetPassword extends Authenticatable
{

    protected $table = 'forget_passwords';
    protected $fillable = [
        'id',
        'user_id',
        'token',
        'status',
        'deleted',
        'updated_at',
    ];
}
