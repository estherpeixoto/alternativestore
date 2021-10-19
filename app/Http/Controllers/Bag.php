<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\Size;

class Bag extends Controller
{
    public function index()
	{
		if (is_null(Auth::user())) {
			return redirect('/login');
		}

		$products = DB::select(
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

		$sizes = Size::get();

		$subtotal = DB::table('order_items')->where('order_id', $products[0]->order_id ?? null)->sum('price');
		$entrega = 5;

		return view('bag/index', compact('products', 'sizes', 'subtotal', 'entrega'));
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

		$product = Product::find($request->product);

		if (!$product) {
			return redirect('/sacola')->with('error', 'Produto inexistente');
		}

		DB::transaction(function () use ($request, $product) {
			$order = Order::where('user_id', Auth::user()->id)->first();

			if (is_null($order)) {
				$order = Order::create([
					'user_id' => Auth::user()->id,
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

		return redirect('/sacola')->with('success', 'Produto adicionado à sacola');
	}

	public function destroy($id)
	{
		$product = OrderItem::find($id);

		if ($product) {
			if ($product->delete()) {
				return redirect('/sacola')->with('success', 'Produto excluído');
			}
		}

		return redirect('/sacola')->with('error', 'Erro ao excluir produto');
	}

	public function changeSize(Request $request)
	{
		if (isset($request->id) && isset($request->size_id)) {
			$orderItem = OrderItem::where('id', $request->id)->first();

			if ($orderItem) {
				$orderItem->size_id = $request->size_id;

				if ($orderItem->isDirty()) {
					$orderItem->save();

					return response()->json([
						'message' => 'Size changed with success'
					], 200);
				}
			}
		}

		return response()->json([
			'message' => 'Ops'
		], 400);
	}
}
