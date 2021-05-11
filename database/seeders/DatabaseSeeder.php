<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Esther Peixoto',
            'email' => 'estherpeixoto13@gmail.com',
            'password' => Hash::make('password'),
            'cpf' => '14601220629',
            'telephone' => '32988428988',
            'type' => 'A'
        ]);
    }
}
