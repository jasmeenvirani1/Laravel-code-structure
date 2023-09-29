<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;


class Certificate extends Authenticatable
{
    protected $table = 'certificates';
    protected $fillable = [
        'id',
        'user_id',
        'image',
        'updated_at',
    ];

    private $descendants = [];
}
