<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
	private $sizes, $categories;

	public function __construct()
	{
		$this->sizes = ['P', 'M', 'G', 'GG'];
		$this->categories = ['Camisetas', 'Croppeds', 'Saias', 'Shorts', 'Máscaras'];
	}

	/**
	 * Seed the application's database.
	 *
	 * @return void
	 */
	public function run()
	{
		$created_at = Carbon::now()->format('Y-m-d H:i:s');
		$updated_at = Carbon::now()->format('Y-m-d H:i:s');

		DB::table('users')->insert([
			'name' => 'Esther Peixoto',
			'email' => 'estherpeixoto13@gmail.com',
			'password' => Hash::make('password'),
			'cpf' => '14601220629',
			'telephone' => '32988428988',
			'type' => 'A',
			'created_at' => $created_at,
			'updated_at' => $updated_at
		]);

		foreach ($this->sizes as $size) {
			DB::table('sizes')->insert([
				'description' => $size,
				'created_at' => $created_at,
				'updated_at' => $updated_at
			]);
		}

		foreach ($this->categories as $category) {
			DB::table('categories')->insert([
				'description' => $category,
				'created_at' => $created_at,
				'updated_at' => $updated_at
			]);
		}
	}
}
