<?php

namespace App\Http\Controllers\Services;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PicPay extends Controller
{
	public function payment()
	{
		return response()->json([
			'message' => 'PicPay'
		], 200);
	}
}
