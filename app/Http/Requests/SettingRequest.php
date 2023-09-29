<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class SettingRequest extends Request
{
    public function rules()
    {
        return [
            'value' => 'required'
        ];
    }
}
