<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;


class Service extends Authenticatable
{

    protected $table = 'services';
    protected $fillable = [
        'id',
        'name',
        'status',
        'deleted',
        'updated_at',
    ];

    private $descendants = [];
}
