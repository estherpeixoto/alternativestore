<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class Bag extends Model
{
    use HasFactory;

	protected $fillable = [
		'category_id',
		'title',
		'description',
		'price',
		'visibility'
	];

	public $timestamps = false;

	public static function storeOrder($request, $product)
	{
		return DB::transaction(function () use ($request, $product) {
			$order = Order::where('user_id', Auth::user()->id)->first();

			if (is_null($order)) {
				$order = Order::create([
					'user_id' => Auth::user()->id,
					'price_products' => $product->price,
					'total' => $product->price
				]);
			}

			OrderItem::create([
				'order_id' => $order->id,
				'product_id' => (int) $request->product,
				'size_id' => (int) $request->selectedSize,
				'quantity' => 1,
				'price' => $product->price,
				'total' => $product->price
			]);
		});
	}

	public static function products()
	{
		return DB::select(
			"SELECT oi.id,
				o.id AS order_id,
				p.title,
				p.price,
				oi.size_id,
				oi.quantity,
				(SELECT filename
				FROM product_images
				WHERE product_id = oi.product_id
				LIMIT 1) AS image
			FROM order_items oi
			INNER JOIN orders o ON o.id = oi.order_id
			INNER JOIN products p ON oi.product_id = p.id
			WHERE o.status = 'W' AND o.user_id = ?",
			[Auth::user()->id]
		);
	}

	public static function priceProducts()
	{
		return DB::table('order_items')
			->where('order_id', session()->exists('order_id') ?? null)
			->sum('price');
	}

	public static function priceDelivery()
	{
		return 0;
	}

	public static function address()
	{
		return DB::table('addresses as a')
			->join('cities as c', 'c.id', '=', 'city_id')
			->join('states as s', 's.id', '=', 'state_id')
			->where('user_id', Auth::user()->id)
			->get(['postal_code', 'street', 'a.number', 'complement', 'neighbour', 'c.name AS city', 'abbreviation AS state'])
			->first();
	}
}
