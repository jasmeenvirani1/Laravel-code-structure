<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class QuestionRequest extends Request
{

	public function rules()
	{
		
			return [
				'question' => 'required|string|min:3',
			];
		
	}
}
