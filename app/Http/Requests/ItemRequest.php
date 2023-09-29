<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class ItemRequest extends Request
{

	public function rules()
	{
		return [
			'type' => 'required',
			'name' => 'required',
			'image' => 'mimes:jpeg,jpg,png,gif|max:10000',
			'brand_model' => 'required',
			'uom' => 'required',
			'quantity' => 'required',
			'wedmonths' => 'required|numeric',
		];
	}
}
