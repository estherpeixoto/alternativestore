<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

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

		Route::get('/usuarios', function () {
			return view('admin/users/list');
		})->name('usuarios');

		Route::get('/minha-conta', function () {
			return view('admin/account');
		})->name('minha-conta');

		Route::get('/trocar-senha', function () {
			return view('admin/change-password');
		})->name('trocar-senha');

	});

require __DIR__.'/auth.php';
