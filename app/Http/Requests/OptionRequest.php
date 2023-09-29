<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class OptionRequest extends Request
{
    public function rules()
    {
        return [
            'question_id' => 'required',
            'option' => 'required',
        ];
    }
}
