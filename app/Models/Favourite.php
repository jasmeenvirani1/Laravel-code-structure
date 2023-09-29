<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;


class Favourite extends Authenticatable
{

    protected $table = 'favourites';
    protected $fillable = [
        'id',
        'user_id',
        'favourite_id',
        'status',
        'deleted',
        'updated_at',
    ];

    private $descendants = [];
}
