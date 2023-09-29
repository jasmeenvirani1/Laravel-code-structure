<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;


class CardDetail extends Authenticatable
{

    protected $table = 'card_details';
    protected $fillable = [
        'id',
        'user_id',
        'card_number',
        'next_payment',
        'due_payment',
        'plan_id',
        'renew_automatic',
        'updated_at',
    ];

    private $descendants = [];
}
