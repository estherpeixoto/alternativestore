<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductSize extends Model
{
	use HasFactory;

	protected $fillable = [
		'size_id',
		'product_id',
		'chest',
		'shoulder',
		'length',
		'sleeve',
		'waist'
	];

	protected $primaryKey = ['size_id', 'product_id'];

	public $incrementing = false;

	public static function format($number)
	{
		return number_format(str_replace(',', '.', str_replace('.', '', $number)), 2, '.', '');
	}
}
