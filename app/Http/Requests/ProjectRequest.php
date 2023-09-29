<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class ProjectRequest extends Request
{

	public function rules()
	{
		return [
			'name' => 'required|unique:projects,name,' . $this->id,
			'start_date' => 'required',
			'end_date' => 'required',
		];
	}
}
