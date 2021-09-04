<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class Home extends Controller
{
	public function index()
	{
		$products = DB::select('select * from allproducts');
		return view('home', compact('products'));
	}

	public function products($category = '')
	{
		$products = DB::select(
			'select * from allproducts' . (!empty($category) ? " where category like '$category'" : '')
		);

		return view('home', compact('products', 'category'));
	}

	public function search(Request $request)
	{
		$search = $request->q;

		$products = DB::select(
			'select * from allproducts' . (!empty($search) ? " where title like '$search'" : '')
		);

		return view('home', compact('products', 'search'));
	}
}
