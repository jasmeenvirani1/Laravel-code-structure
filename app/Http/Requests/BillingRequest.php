<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class BillingRequest extends Request
{

	public function rules()
	{
			return [
				'name' => 'required',
				'card_number' => 'required',
				'billing_address' => 'required',
				'country' => 'required',
				'state' => 'required',
				'phone' => 'required',
				'last_name' => 'required',
				'month' => 'required',
				'year' => 'required',
				'cvv' => 'required',
				'city' => 'required',
				'zip_code' => 'required',
			];
	}
}
