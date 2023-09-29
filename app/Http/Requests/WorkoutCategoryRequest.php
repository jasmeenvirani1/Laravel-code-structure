<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class WorkoutCategoryRequest extends Request
{
    public function rules()
    {
        return [
            'name' => 'required',
            // 'lastname' => 'required',
            // 'email' => 'required',
            // 'feedback' => 'required|min:5',
        ];
    }
}
