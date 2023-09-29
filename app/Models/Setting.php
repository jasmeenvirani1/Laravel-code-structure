<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;


class Setting extends Authenticatable
{

    protected $table = 'settings';
    protected $fillable = [
        'id',
        'title',
        'value',
        'updated_at',
    ];

    private $descendants = [];
}
