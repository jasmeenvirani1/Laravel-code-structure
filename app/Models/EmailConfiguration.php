<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;


class EmailConfiguration extends Authenticatable
{

    protected $table = 'email_configurations';
    protected $fillable = [
        'id',
        'key',
        'value',
        'updated_at',
    ];

    private $descendants = [];
}
