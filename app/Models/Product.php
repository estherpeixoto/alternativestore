<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\ProductImage;
use Illuminate\Support\Facades\DB;

class Product extends Model
{
	use HasFactory;

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'category_id',
		'title',
		'description',
		'price',
		'visibility'
	];

	public static function price($price)
	{
		return str_replace(',', '.', str_replace('.', '', str_replace('_', '', $price)));
	}

	public static function getProductList()
	{
		return DB::table('products')
			->join('categories', 'category_id', '=', 'categories.id')
			->orderBy('title')
			->select('products.*', 'categories.description')
			->paginate(10);
	}
}
