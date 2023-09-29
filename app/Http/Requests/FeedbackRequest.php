<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class FeedbackRequest extends Request
{
    public function rules()
    {
        return [
            'firstname' => 'required',
            'lastname' => 'required',
            'email' => 'required',
            'feedback' => 'required|min:5',
        ];
    }
}
