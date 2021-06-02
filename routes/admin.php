<?php

use App\Http\Controllers\Admin\UserController as User;
use Illuminate\Support\Facades\Route;

Route::prefix('dashboard')->middleware(['auth'])
	->group(function () {

		Route::get('/', function () {
			return view('admin/dashboard');
		})->name('dashboard');

		Route::get('/pedidos', function () {
			return view('admin/orders');
		})->name('pedidos');

		Route::get('/produtos', function () {
			return view('admin/products');
		})->name('produtos');

		Route::get('/categorias', function () {
			return view('admin/categories');
		})->name('categorias');

		Route::prefix('usuarios')->group(function() {
			Route::get('/', [User::class, 'index'])->name('user.list');

			Route::get('/incluir', [User::class, 'form']);

			Route::post('/incluir', [User::class, 'create'])->name('user.create');
		});

		Route::get('/minha-conta', function () {
			return view('admin/account');
		})->name('minha-conta');

		Route::get('/trocar-senha', function () {
			return view('admin/change-password');
		})->name('trocar-senha');

	});