<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;


class ProviderWorkout extends Authenticatable
{

    protected $table = 'providers_workouts';
    protected $fillable = [
        'id',
        'user_id',
        'workout_id',
        'status',
        'deleted',
        'updated_at',
    ];
}
