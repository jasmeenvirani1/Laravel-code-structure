<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class TransactionRequest extends Request
{

	public function rules()
	{
		return [
			'item_id' => 'required',
			'team_id' => 'required',
			'customer_id' => 'required',
		];
	}
}
