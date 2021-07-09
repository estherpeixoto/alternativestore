<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
	{
        $users = User::orderBy('name')->paginate(10);
        return view('admin/users/list', compact('users'));
	}

    public function form($action = 'cadastrar', $id = '')
	{
		if (!empty($id)) {
			$user = User::find($id);
			return view('admin/users/form', compact(['user', 'action']));
		}

		return view('admin/users/form');
	}

	public function store(Request $request)
	{
		$request->validate([
			'name' => 'required',
			'email' => 'required|email|unique:users',
			'password' => 'required',
			'cpf' => 'required|min:11|unique:users',
			'telephone' => 'required|min:11'
		]);

		User::create([
			'name' => $request->name,
			'email' => $request->email,
			'password' => Hash::make($request->password),
			'cpf' => $request->cpf,
			'telephone' => $request->telephone,
			'type' => 'A'
		]);

		return redirect('/dashboard/usuarios')->with('success', 'Usuário criado');
	}

	public function edit(Request $request, $id)
	{
		$user = User::find($id);

		if ($user) {
			$user->name = $request->name;
			$user->email = $request->email;

			if ($request->password !== $user->password) {
				$user->password = Hash::make($request->password);
			}

			$user->cpf = $request->cpf;
			$user->telephone = $request->telephone;

			if ($user->isDirty()) {
				$user->save();

				return redirect('/dashboard/usuarios')->with('success', 'Usuário alterado');
			}
		}

		return redirect('/dashboard/usuarios')->with('error', 'Erro ao alterar usuário');
	}

	public function destroy($id)
	{
		$user = User::find($id);

		if ($user->delete()) {
			return redirect('/dashboard/usuarios')->with('success', 'Usuário excluído');
		}

		return redirect('/dashboard/usuarios')->with('error', 'Erro ao excluir usuário');
	}
}
