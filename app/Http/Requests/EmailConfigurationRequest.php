<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class EmailConfigurationRequest extends Request
{
    public function rules()
    {
        return [
            'MAIL_DRIVER' => 'required',
            'MAIL_HOST' => 'required',
            'MAIL_PORT' => 'required',
            'MAIL_USERNAME' => 'required',
            'MAIL_PASSWORD' => 'required',
            'MAIL_FROM_ADDRESS' => 'required',
        ];
    }
}
