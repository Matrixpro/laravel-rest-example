<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model {
	
	use SoftDeletes;
	
	protected $fillable = [
		'type',
		'msrp',
		'year',
		'make',
		'model',
		'miles',
		'vin',
	];
	
   protected $hidden = [
   	'deleted_at'
   ];
	
	public function getFillablesArr()
	{
		return $this->fillable;
	}
	
	
}