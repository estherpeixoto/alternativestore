<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\Size;
use App\Models\Bag as Model;

class Bag extends Controller
{
	public function index()
	{
		$products = Model::products();

		if (!session()->exists('order_id')) {
			session(['order_id' => $products[0]->order_id]);
		}

		$price_products = Model::priceProducts();
		$price_delivery = Model::priceDelivery();
		$sizes = Size::get();

		return view('bag/index', compact('products', 'sizes', 'price_products', 'price_delivery'));
	}

	public function delivery()
	{
		$price_products = Model::priceProducts();

		if ($price_products <= 0) {
			return redirect('/sacola');
		}

		$address = Model::address();
		$price_delivery = Model::priceDelivery();

		return view('bag/delivery', compact('address', 'price_products', 'price_delivery'));
	}

	public function storeAddress(Request $request)
	{
		dd([
			str_replace('-', '', $request->postal_code),
			$request->street,
			$request->number,
			$request->complement,
			$request->neighbour,
			$request->city,
			$request->state,
		]);
	}

	public function store(Request $request)
	{
		if (is_null(Auth::user())) {
			return redirect('/login')->with('error', 'Entre para adicionar um produto');
		}

		$request->validate(['product' => 'required', 'selectedSize' => 'required']);

		$product = Product::find($request->product);

		if (!$product) {
			return redirect('/sacola')->with('error', 'Produto inexistente');
		}

		Model::storeOrder($request, $product);

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

					return response()->json(['message' => 'Size changed with success'], 200);
				}
			}
		}

		return response()->json(['message' => 'Ops'], 400);
	}
}
