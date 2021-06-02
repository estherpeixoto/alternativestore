<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
	{
		return view('admin/users/list');
	}

    public function form()
	{
		return view('admin/users/form');
	}

	public function create(Request $request)
	{
		var_dump($request->all());
	}
}
