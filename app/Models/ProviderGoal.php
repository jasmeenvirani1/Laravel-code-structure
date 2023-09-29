<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;


class ProviderGoal extends Authenticatable
{

    protected $table = 'provider_goals';
    protected $fillable = [
        'id',
        'user_id',
        'goal_id',
        'status',
        'deleted',
        'updated_at',
    ];
}
