<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class UserRequest extends Request
{

	public function rules()
	{
		return [
			'user_id' => 'required',
			'name' => 'required',
			'address' => 'required',
			'mobile' => 'required|numeric|digits:10',
			'phone' => 'required|numeric|digits:10',
			'country' => 'required',
			'city' => 'required',
			'postal_code' => 'required',
			'about' => 'required',
			'service' => 'required',
			'workout' => 'required',
			'goals' => 'required',
			'experience' => 'required',
			'expertise' => 'required',
			'testimonials' => 'required',
			'website_link' => 'required|url',
			'contact_button' => 'required',
			'caption' => 'required',
			'fees' => 'required|numeric',
		];
	}
}
