<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;


class Page extends Authenticatable
{

    protected $table = 'pages';
    protected $fillable = [
        'id',
        'title',
        'slug',
        'description',
        'deleted',
        'status',
        'updated_at',
    ];

    private $descendants = [];
}
