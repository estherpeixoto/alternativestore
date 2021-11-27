<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Home;
use App\Http\Controllers\MyAccount;
use App\Http\Controllers\Bag;

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

Route::get('/', [Home::class, 'index'])->name('home');

Route::get('/sobre-nos', [Home::class, 'sobrenos'])->name('sobre-nos');
Route::get('/contato', [Home::class, 'contato'])->name('contato');
Route::get('/termos', [Home::class, 'termos'])->name('termos');
Route::get('/politica', [Home::class, 'politica'])->name('politica');


Route::prefix('produtos')->group(function () {
    Route::get('/', [Home::class, 'index']);
    Route::get('/{category}', [Home::class, 'allProducts']);
    Route::get('/{category}/{product}', [Home::class, 'showProduct']);
});

Route::get('/search', [Home::class, 'search']);

Route::prefix('minha-conta')->group(function () {
    Route::get('/', [MyAccount::class, 'index']);
    Route::get('/pedidos', [MyAccount::class, 'orders']);
    Route::get('/dados', [MyAccount::class, 'profile']);
});

Route::prefix('sacola')->middleware('auth')->group(function () {
    Route::get('/', [Bag::class, 'index'])->name('sacola');
    Route::get('/entrega', [Bag::class, 'delivery']);
    Route::get('/pagamento', [Bag::class, 'payment']);

    Route::post('/adicionar', [Bag::class, 'store']);
    Route::delete('/remover/{id}', [Bag::class, 'destroy']);
    Route::post('/alterar-tamanho', [Bag::class, 'changeItem']);
    Route::post('/alterar-quantidade', [Bag::class, 'changeItem']);
    Route::post('/entrega', [Bag::class, 'storeAddress']);
});

require __DIR__ . '/auth.php';

require __DIR__ . '/admin.php';
