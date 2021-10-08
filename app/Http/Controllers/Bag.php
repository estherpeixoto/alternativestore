<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Bag as BagModel;
use App\Models\Size;
use App\Models\BagItem;

class Bag extends Controller
{
    public function index()
	{
		if (is_null(Auth::user())) {
			return redirect('/');
		}

		$products = DB::select(
			'SELECT p.id,
				p.title,
				p.price,
				bi.size_id,
				bi.quantity,
				(SELECT filename
				FROM product_images
				WHERE product_id = bi.product_id
				LIMIT 1) AS image
			FROM bag_items bi
			INNER JOIN bags b ON b.id = bi.bag_id
			INNER JOIN products p ON bi.product_id = p.id
			WHERE b.user_id = ?',
			[Auth::user()->id]
		);

		$sizes = Size::get();

		return view('bag/index', compact('products', 'sizes'));
	}

	public function store(Request $request)
	{
		if (is_null(Auth::user())) {
			return redirect('/login')->with('error', 'Entre para adicionar um produto');
		}

		$request->validate([
			'product' => 'required',
			'selectedSize' => 'required'
		]);

		DB::transaction(function () use ($request) {
			$bag_id = BagModel::create([
				'user_id' => Auth::user()->id,
			]);

			BagItem::create([
				'bag_id' => $bag_id->id,
				'product_id' => (int) $request->product,
				'size_id' => (int) $request->selectedSize,
				'quantity' => 1
			]);
		});

		return redirect('/sacola')->with('success', 'Produto adicionado à sacola');
	}

	public function destroy($id)
	{
		$product = BagItem::find($id);

		if ($product->delete()) {
			return redirect('/dashboard/produtos')->with('success', 'Produto excluído');
		}

		return redirect('/dashboard/produtos')->with('error', 'Erro ao excluir produto');
	}
}
