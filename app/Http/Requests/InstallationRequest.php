<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class InstallationRequest extends Request
{

	public function rules()
	{
		return [
			'customer_id' => 'required',
			'team_id' => 'required',
			'work_profile_id' => 'required',
		];
	}
}
