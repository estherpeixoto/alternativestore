<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class Home extends Controller
{
	public function index()
	{
		$products = DB::select('select * from all_products');
		return view('home', compact('products'));
	}

	public function showProduct($category = '', $product = '')
	{
		// Produto
		$product = DB::table('products')->where('title', 'like', '%' . str_replace('-', ' ', $product) . '%')->first();

		if ($product) {
			// Imagens do produto
			$productImages = [];

			foreach (DB::table('product_images')->where('product_id', $product->id)->get() as $k => $images) {
				$productImages[$k] = (object) [
					'id' => $k,
					'filename' => asset("storage/products/$images->filename")
				];
			}

			// Montar tabela de tamanhos
			$productSizes = DB::table('product_sizes')->where('product_id', $product->id)->get();

			// Listar todos os tamanhos
			$sizes = DB::table('sizes')->get(['id', 'description']);

			return view('product-detail', compact('product', 'productImages', 'productSizes', 'sizes'));
		}

		return redirect('/');
	}

	public function allProducts($category = '', $product = '')
	{
		$products = DB::select(
			'select * from all_products' . (!empty($category) ? " where category like '%$category%'" : '')
		);

		return view('home', compact('products', 'category'));
	}

	public function search(Request $request)
	{
		$search = $request->q;

		$products = DB::select(
			'select * from all_products' . (!empty($search) ? " where title like '%$search%'" : '')
		);

		return view('home', compact('products', 'search'));
	}
}
