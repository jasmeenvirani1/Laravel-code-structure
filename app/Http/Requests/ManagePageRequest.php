<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class ManagePageRequest extends Request
{
    public function rules()
    {
        return [
            'title' => 'required',
            'slug' => 'required',
            'description' => 'required',
        ];
    }
}
