<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class HirentryRequest extends Request
{

	public function rules()
	{
		return [
			'team_id' => 'required',
            'customer_id' => 'required',
		];
	}
}
