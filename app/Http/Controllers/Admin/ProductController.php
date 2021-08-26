<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;
use App\Models\Size;
use App\Models\ProductImage;
use App\Models\ProductSize;

class ProductController extends Controller
{
	public function index()
	{
		$products = Product::getProductList();
		return view('admin/products/list', compact('products'));
	}

	public function form($action = 'cadastrar', $id = '')
	{
		if (in_array($action, ['cadastrar', 'alterar', 'excluir'])) {
			$categories = Category::orderBy('description')->get();
			$sizes = Size::get();

			if (!empty($id)) {
				$product = Product::find($id);
				$images = ProductImage::select('*')->where('product_id', $id)->get();
				$productSizes = ProductSize::select('*')->where('product_id', $id)->get();

				if ($product) {
					return view('admin/products/form', compact(['product', 'categories', 'images', 'action', 'sizes', 'productSizes']));
				}
			} else {
				return view('admin/products/form', compact('categories', 'sizes'));
			}
		}

		return redirect()->route('product.list');
	}

	public function store(Request $request)
	{
		$request->validate([
			'category_id' => 'required',
			'title' => 'required',
			'description' => 'required',
			'price' => 'required',
			'visibility' => 'required'
		]);

		$product = Product::create([
			'category_id' => $request->category_id,
			'title' => $request->title,
			'description' => $request->description,
			'price' => Product::price($request->price),
			'visibility' => $request->visibility
		]);

		$this->upload($request, $product->id);

		foreach ($request->sizes as $k => $size) {
			ProductSize::create([
				'size_id' => $k,
				'product_id' => $product->id,
				'chest' => ProductSize::format($size['chest'][0]),
				'shoulder' => ProductSize::format($size['shoulder'][0]),
				'length' => ProductSize::format($size['length'][0]),
				'sleeve' => ProductSize::format($size['sleeve'][0]),
				'waist' => ProductSize::format($size['waist'][0])
			]);
		}

		return redirect('/dashboard/produtos')->with('success', 'Produto criado');
	}

	public function edit(Request $request, $id)
	{
		$product = Product::find($id);

		if ($product) {
			$product->category_id = $request->category_id;
			$product->title = $request->title;
			$product->description = $request->description;
			$product->price = Product::price($request->price);
			$product->visibility = $request->visibility;

			if ($product->isDirty()) {
				$product->save();
			}

			if (is_array($request->images)) {
				$this->destroyImages($product->id);
				$this->upload($request, $product->id);
			}

			foreach ($request->sizes as $k => $size) {
				ProductSize::where('size_id', '=', $k)
					->where('product_id', '=', $id)
					->update([
						'chest' => ProductSize::format($size['chest'][0]),
						'shoulder' => ProductSize::format($size['shoulder'][0]),
						'length' => ProductSize::format($size['length'][0]),
						'sleeve' => ProductSize::format($size['sleeve'][0]),
						'waist' => ProductSize::format($size['waist'][0])
					]);
			}

			return redirect('/dashboard/produtos')->with('success', 'Produto alterado');
		}

		return redirect('/dashboard/produtos')->with('error', 'Erro ao alterar produto');
	}

	public function destroy($id)
	{
		$product = Product::find($id);

		if ($product->delete()) {
			return redirect('/dashboard/produtos')->with('success', 'Produto excluído');
		}

		return redirect('/dashboard/produtos')->with('error', 'Erro ao excluir produto');
	}

	private function destroyImages($id = null)
	{
		ProductImage::where('product_id', $id)->delete();
	}

	private function upload(Request $request, $id = null)
	{
		if (is_null($id)) {
			return false;
		}

		foreach ($request->images as $file) {
			$filename = $id . '_' . $file->getClientOriginalName();

			$file->storePubliclyAs('public/products', $filename);

			ProductImage::create([
				'product_id' => $id,
				'filename' => $filename
			]);
		}

		return true;
	}
}
