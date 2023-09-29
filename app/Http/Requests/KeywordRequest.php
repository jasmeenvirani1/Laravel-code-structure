<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class KeywordRequest extends Request
{

	public function rules()
	{
		return [
			'keyword' => 'required',
		];
	}
}

