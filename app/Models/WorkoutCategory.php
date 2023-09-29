<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;


class WorkoutCategory extends Authenticatable
{

    protected $table = 'workout_categorys';
    protected $fillable = [
        'id',
        'name',
        'status',
        'deleted',
        'created_at',
        'updated_at',
    ];

    private $descendants = [];
}
