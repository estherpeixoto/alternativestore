<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
	{
        $categories = Category::orderBy('description')->paginate(10);
        return view('admin/categories/list', compact('categories'));
	}

    public function form($action = 'cadastrar', $id = '')
	{
		if (!empty($id)) {
			$category = Category::find($id);
			return view('admin/categories/form', compact(['category', 'action']));
		}

		return view('admin/categories/form');
	}

	public function store(Request $request)
	{
		$request->validate(['description' => 'required']);
		Category::create(['description' => $request->description]);
		return redirect('/dashboard/categorias')->with('success', 'Categoria criada');
	}

	public function edit(Request $request, $id)
	{
		$category = Category::find($id);

		if ($category) {
			$category->description = $request->description;

			if ($category->isDirty()) {
				$category->save();
				return redirect('/dashboard/categorias')->with('success', 'Categoria alterado');
			}
		}

		return redirect('/dashboard/categorias')->with('error', 'Erro ao alterar categoria');
	}

	public function destroy($id)
	{
		$category = Category::find($id);

		if ($category->delete()) {
			return redirect('/dashboard/categorias')->with('success', 'Categoria excluído');
		}

		return redirect('/dashboard/categorias')->with('error', 'Erro ao excluir categoria');
	}
}
