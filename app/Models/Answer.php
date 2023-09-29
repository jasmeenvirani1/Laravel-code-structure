<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;


class Answer extends Authenticatable
{

    protected $table = 'answers';
    protected $fillable = [
        'id',
        'user_id',
        'question_id',
        'opction_id',
        'status',
        'deleted',
        'updated_at',
    ];

    private $descendants = [];
}
