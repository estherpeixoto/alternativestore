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

		$sizes = Size::get();
		$totals = Model::getTotals();

		return view('bag/index', compact('products', 'sizes', 'totals'));
	}

	public function delivery()
	{
		$totals = Model::getTotals();

		if ($totals->price_products <= 0) {
			return redirect('/sacola');
		}

		$address = Model::address();

		return view('bag/delivery', compact('address', 'totals'));
	}

	public function storeAddress(Request $request)
	{
		$address_id = Model::addAddress($request);

		if (is_null($address_id)) {
			return redirect('sacola/entrega')->with('error', 'Não foi possível gravar dados de entrega');
		}

		return redirect('sacola/pagamento');
	}

	public function payment()
	{
		$totals = Model::getTotals();

		if ($totals->price_products <= 0) {
			return redirect('/sacola');
		}

		$address = Model::address();

		return view('bag/payment', compact('address', 'totals'));
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

	public function changeItem(Request $request)
	{
		if (isset($request->id)) {
			$orderItem = OrderItem::where('id', $request->id)->first();

			if ($orderItem) {
				if (isset($request->size_id)) {
					$orderItem->size_id = $request->size_id;
				}

				if (isset($request->quantity)) {
					$orderItem->quantity = $request->quantity;
				}

				if ($orderItem->isDirty()) {
					$orderItem->save();

					return response()->json([
						'message' => 'Item alterado com sucesso',
						'totals' => Model::getTotals()
					], 200);
				}
			}
		}

		return response()->json(['message' => 'Houve um erro. Por favor tente novamente mais tarde.'], 400);
	}
}
