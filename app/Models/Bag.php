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
			->where('order_id', session('order_id') ?? null)
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
			->get(['postal_code', 'street', 'a.number', 'complement', 'neighbour', 'c.name AS city', 'abbreviation AS state', 'c.ibge AS ibge'])
			->first();
	}

	public static function getState($abbreviation)
	{
		return DB::table('states')->where('abbreviation', $abbreviation)->value('id');
	}

	public static function getCity($city, $state_id)
	{
		$city_id = DB::table('cities')->where('ibge', $city['ibge'])->value('id');

		if (is_null($city_id)) {
			$city_id = DB::table('cities')->insertGetId([
				'ibge' => $city['ibge'],
				'name' => $city['description'],
				'state_id' => $state_id,
			]);
		}

		return $city_id;
	}

	public static function addAddress($address)
	{
		$state_id = Bag::getState($address->state);
		$city_id = Bag::getCity($address->city, $state_id);

		$address_id = DB::table('addresses')->where([
			'postal_code' => str_replace('-', '', $address->postal_code),
			'number' => $address->number,
			'user_id' => Auth::user()->id,
		])->value('id');

		if (is_null($address_id)) {
			$address_id = DB::table('addresses')->insertGetId([
				'user_id' => Auth::user()->id,
				'city_id' => $city_id,
				'postal_code' => str_replace('-', '', $address->postal_code),
				'street' => $address->street,
				'number' => $address->number,
				'complement' => $address->complement,
				'neighbour' => $address->neighbour
			]);
		}

		return $address_id;
	}
}
