<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;


class WorkoutSubCategory extends Authenticatable
{
    protected $table = 'workout_sub_categorys';
    protected $fillable = [
        'id',
        'cat_id',
        'name',
        'status',
        'deleted',
        'created_at',
        'updated_at',
    ];
}
