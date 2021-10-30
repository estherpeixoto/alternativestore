<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
	/**
	 * Seed the application's database.
	 *
	 * @return void
	 */
	public function run()
	{
		$product_id = DB::table('products')->insertGetId([
			'category_id' => 9,
			'title' => 'Divination',
			'description' => 'teste',
			'price' => 10.0,
			'visibility' => 'V'
		]);

		DB::table('product_images')->insert([
			'product_id' => $product_id,
			'filename' => '8_10_divinationback_2048x2048.png'
		]);
	}
}
