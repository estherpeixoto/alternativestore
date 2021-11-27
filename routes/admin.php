<?php

use App\Http\Controllers\Admin\ProductController as Product;
use App\Http\Controllers\Admin\CategoryController as Category;
use App\Http\Controllers\Admin\SizeController as Size;
use App\Http\Controllers\Admin\UserController as User;
use App\Http\Controllers\Admin\AccountController as Account;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::prefix('dashboard')->middleware(['auth'])
	->group(function () {

		Route::get('/', function () {
			if (Auth::user()->type != 'C') {
				return view('admin/dashboard');
			} else {
				return redirect('/dashboard/minha-conta/dados');
			}
		})->name('dashboard');

		Route::prefix('pedidos')->group(function () {
			Route::get('/', [Order::class, 'index'])->name('order.list');
			Route::get('/cadastrar', [Order::class, 'form']);
			Route::get('/{action}/{id}', [Order::class, 'form']);
			Route::post('/', [Order::class, 'store']);
			Route::put('/{id}', [Order::class, 'edit']);
			Route::delete('/{id}', [Order::class, 'destroy']);
		});

		Route::prefix('produtos')->group(function () {
			Route::get('/', [Product::class, 'index'])->name('product.list');
			Route::get('/cadastrar', [Product::class, 'form']);
			Route::post('/upload/{id?}', [Product::class, 'upload']);
			Route::get('/{action}/{id}', [Product::class, 'form']);
			Route::post('/', [Product::class, 'store']);
			Route::put('/{id}', [Product::class, 'edit']);
			Route::delete('/{id}', [Product::class, 'destroy']);
		});

		Route::prefix('categorias')->group(function () {
			Route::get('/', [Category::class, 'index'])->name('category.list');
			Route::get('/cadastrar', [Category::class, 'form']);
			Route::get('/{action}/{id}', [Category::class, 'form']);
			Route::post('/', [Category::class, 'store']);
			Route::put('/{id}', [Category::class, 'edit']);
			Route::delete('/{id}', [Category::class, 'destroy']);
		});

		Route::prefix('tamanhos')->group(function () {
			Route::get('/', [Size::class, 'index'])->name('size.list');
			Route::get('/cadastrar', [Size::class, 'form']);
			Route::get('/{action}/{id}', [Size::class, 'form']);
			Route::post('/', [Size::class, 'store']);
			Route::put('/{id}', [Size::class, 'edit']);
			Route::delete('/{id}', [Size::class, 'destroy']);
		});

		Route::prefix('usuarios')->group(function () {
			Route::get('/', [User::class, 'index'])->name('user.list');
			Route::get('/cadastrar', [User::class, 'form']);
			Route::get('/{action}/{id}', [User::class, 'form']);
			Route::post('/', [User::class, 'store']);
			Route::put('/{id}', [User::class, 'edit']);
			Route::delete('/{id}', [User::class, 'destroy']);
		});

		Route::prefix('minha-conta')->group(function () {
            Route::get('/', [Account::class, 'index'])->name('minha-conta');
            Route::get('/dados', [Account::class, 'dados'])->name('dados');
            Route::put('/{id}', [Account::class, 'edit']);
			//return view('admin/account');

        });

		Route::get('/trocar-senha', function () {
			return view('admin/change-password');
		})->name('trocar-senha');
	});
