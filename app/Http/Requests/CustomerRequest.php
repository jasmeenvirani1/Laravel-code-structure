<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class CustomerRequest extends Request
{

	public function rules()
	{
		return [
			'email' => 'required|email',
			'name' => 'required',
			'password' => 'required',
		];
	}
}
