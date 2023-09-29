<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Option extends Authenticatable
{
    protected $table = 'options';
    protected $fillable = ['id', 'question_id', 'option', 'deleted', 'updated_at'];

    private $descendants = [];
}
