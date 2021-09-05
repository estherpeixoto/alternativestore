<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MyAccount extends Controller
{
    public function index()
	{
		return view('my-account/index');
	}

	public function profile()
	{
		return view('my-account/profile');
	}

	public function orders()
	{
		return view('my-account/orders');
	}
}
