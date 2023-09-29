<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class ServiceRequest extends Request
{
    public function rules()
    {
        return [
            'name' => 'required',
        ];
    }
}
