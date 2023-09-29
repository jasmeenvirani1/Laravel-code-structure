<?php

namespace App\Http\Requests;

use Auth;
use App\Business;
use App\Http\Requests\Request;

class RegisterRequest extends Request
{

	public function rules()
	{
		return [
			'company_name' => 'required',
			'kpl_licence' => 'required',
			'ssm_licence' => 'required',
			'office_address' => 'required',
			'state_id' => 'required',
			'office_phone' => 'required|numeric',
			'office_email' => 'required|email',
			'person_in_charge' => 'required',
			'designation' => 'required',
			'mobile' => 'required|numeric',
			'email' => 'required|unique:users,email,' . $this->id,
			'kpl_licence_img' => 'required|mimes:jpeg,jpg,png,pdf',
			'business_card_img' => 'required|mimes:jpeg,jpg,png,pdf',
		];
	}
}
