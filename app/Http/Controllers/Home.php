<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

class Home extends Controller
{
	public function index()
	{
		$products = DB::select('select * from allproducts');

		return view('home', compact('products'));
	}
}
