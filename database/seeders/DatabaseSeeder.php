<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
	private $users, $sizes, $categories, $created_at, $updated_at;

	public function __construct()
	{
		$this->created_at = Carbon::now()->format('Y-m-d H:i:s');
		$this->updated_at = Carbon::now()->format('Y-m-d H:i:s');

		$this->users = [
			[
				'name' => 'Esther Peixoto',
				'email' => 'estherpeixoto13@gmail.com',
				'password' => Hash::make('password'),
				'cpf' => '14601220629',
				'telephone' => '32988428988',
				'type' => 'A',
				'created_at' => $this->created_at,
				'updated_at' => $this->updated_at
			],
			[
				'name' => 'Lorena Peixoto',
				'email' => 'lorenasbpeixoto@gmail.com',
				'password' => Hash::make('password'),
				'cpf' => '12110466642',
				'telephone' => '32984771470',
				'type' => 'A',
				'created_at' => $this->created_at,
				'updated_at' => $this->updated_at
			]
		];

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
        foreach ($this->users as $user)
		{
			DB::table('users')->insert($user);
		}

        foreach ($this->sizes as $size)
		{
			DB::table('sizes')->insert([
				'description' => $size,
				'created_at' => $this->created_at,
				'updated_at' => $this->updated_at
			]);
		}

        foreach ($this->categories as $category)
		{
			DB::table('categories')->insert([
				'description' => $category,
				'created_at' => $this->created_at,
				'updated_at' => $this->updated_at
			]);
		}
    }
}
