<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;


class Subscription extends Authenticatable
{

    protected $table = 'subscription_plans';
    protected $fillable = [
        'id',
        'price',
        'type',
        'status',
        'deleted',
        'updated_at',
    ];

    private $descendants = [];
}
