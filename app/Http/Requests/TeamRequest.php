<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class TeamRequest extends Request
{

	public function rules()
	{
		return [
			'name' => 'required',
		];
	}
}
