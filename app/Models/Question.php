<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;


class Question extends Authenticatable
{

    protected $table = 'question';
    protected $fillable = [
        'id',
        'question',
        'status',
        'deleted',
        'updated_at',
    ];

    private $descendants = [];
}
