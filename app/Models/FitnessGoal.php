<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;


class FitnessGoal extends Authenticatable
{

    protected $table = 'fitness_goals';
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
