<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AccountController extends Controller
{
    public function index()
	{

        //return view('admin/account');
        return view('my-account/index');
	}

    public function dados()
	{
		

		$account['id'] = Auth::user()->id;
        $account['nome'] = Auth::user()->name;
        $account['email'] = Auth::user()->email;
        $account['senha'] = Auth::user()->password;
        $account['cpf'] = Auth::user()->cpf;
        $account['telefone'] = Auth::user()->telephone;


        //return view('admin/account');
        return view('my-account/profile', compact('account'));
	}

    public function edit(Request $request, $id)
	{
		$user = User::find($id);

		if ($user) {
			$user->name = $request->name;
			$user->email = $request->email;

			$user->cpf = $request->cpf;
			$user->telephone = $request->telephone;

			if ($user->isDirty()) {
				$user->save();

				return redirect('/dashboard/minha-conta/dados')->with('success', 'Usuário alterado');
			}
		}

		return redirect('/dashboard/minha-conta/dados')->with('error', 'Erro ao alterar usuário');
	}

}
