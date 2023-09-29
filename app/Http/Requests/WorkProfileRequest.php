<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class WorkProfileRequest extends Request
{

	public function rules()
	{
		return [
			'name' => 'required|unique:work_profiles,name,' . $this->id,
		];
	}
}
