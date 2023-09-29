<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;


class Keyword extends Authenticatable
{

    protected $table = 'keywords';
    protected $fillable = [
        'id',
        'keyword',
        'user_id',
        'status',
        'deleted',
        'updated_at',
    ];

    private $descendants = [];
}
