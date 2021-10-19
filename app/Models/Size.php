<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Size extends Model
{
    use HasFactory;

	/*'size_id',
		'category_id',
		'chest',
		'shoulder',
		'length',
		'sleeve',
		'waist'*/
	protected $fillable = [
		'description'
	];

	public $timestamps = true;
}
