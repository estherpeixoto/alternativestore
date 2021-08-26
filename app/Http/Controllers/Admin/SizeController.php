<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Size;

class SizeController extends Controller
{
	public function index()
	{
		$sizes = Size::orderBy('description')->paginate(10);
		return view('admin/sizes/list', compact('sizes'));
	}

	public function form($action = 'cadastrar', $id = '')
	{
		if (!empty($id))
		{
			$size = Size::find($id);
			return view('admin/sizes/form', compact(['size', 'action']));
		}

		return view('admin/sizes/form');
	}

	public function store(Request $request)
	{
		$request->validate(['description' => 'required']);

		Size::create(['description' => $request->description]);

		return redirect('/dashboard/tamanhos')->with('success', 'Tamanho criado');
	}

	public function edit(Request $request, $id)
	{
		$size = Size::find($id);

		if ($size)
		{
			$size->description = $request->description;

			if ($size->isDirty())
			{
				$size->save();
				return redirect('/dashboard/tamanhos')->with('success', 'Tamanho alterado');
			}
		}

		return redirect('/dashboard/tamanhos')->with('error', 'Erro ao alterar tamanho');
	}

	public function destroy($id)
	{
		$size = Size::find($id);

		if ($size->delete())
		{
			return redirect('/dashboard/tamanhos')->with('success', 'Tamanho excluído');
		}

		return redirect('/dashboard/tamanhos')->with('error', 'Erro ao excluir tamanho');
	}
}
