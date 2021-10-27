<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\DB;

class StateSeeder extends Seeder
{
	/**
	 * Seed the application's database.
	 *
	 * @return void
	 */
	public function run()
	{
		$response = Http::get('https://servicodados.ibge.gov.br/api/v1/localidades/estados');

		foreach ($response->object() as $state) {
			DB::table('states')->insert([
				'ibge' => $state->id,
				'abbreviation' => $state->sigla,
				'description' => $state->nome,
				'region' => $state->regiao->nome
			]);
		}
	}
}
