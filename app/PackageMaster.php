<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PackageMaster extends Model
{
	protected $table = 'package_masters';
	protected $fillable = [
		'name',
		'status',
		'deleted',
		'updated_at',
	];
}
