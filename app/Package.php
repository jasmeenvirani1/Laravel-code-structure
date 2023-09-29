<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
	protected $table = 'packages';

	protected $fillable = [
		'master_package_id',
		'name',
		'date',
		'adult_twin_room',
		'adult_triple_room',
		'adult_single_room',
		'child_twin',
		'child_with_bed',
		'child_without_bed',
		'infant',
		'total_seat',
		'sold_seat',
		'balance_seat',
		'website_link',
		'package_pdf',
		'status',
		'deleted',
		'updated_at',
	];
}
