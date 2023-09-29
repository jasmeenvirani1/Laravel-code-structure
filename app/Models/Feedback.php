<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;


class Feedback extends Authenticatable
{

    protected $table = 'feedbacks';
    protected $fillable = [
        'id',
        'fristname',
        'lastname',
        'email',
        'feedback',
        'deleted',
        'created_at',
        'updated_at',
    ];

    private $descendants = [];
}
