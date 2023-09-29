<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;


class Permission extends Authenticatable
{

    protected $table = 'permissions';
    protected $fillable = [
        'id',
        'title',
        'modual',
        'roll_ids',
        'updated_at',
    ];

    private $descendants = [];
}
