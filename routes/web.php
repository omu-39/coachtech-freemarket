<?php

use App\Http\Controllers\LoginController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ItemController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [ItemController::class, 'index'])->name('item.index');

Route::post('/login', [LoginController::class, 'login'])->name('login');

Route::middleware('auth')->group(function () {

    Route::get('/sell', [ItemController::class, 'create'])->name('item.create');
    Route::post('/sell', [ItemController::class, 'store'])->name('item.store');

});

Route::get('/item/{id}', [ItemController::class, 'show'])->name('item.show');

// 見た目確認用ルート ーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーー
Route::get('/edit', function () {
    return view('profile.edit');
});

Route::get('/profile', function () {
    return view('profile.show');
});

Route::get('/item/show', function () {
    return view('purchase.show');
});

Route::get('/purchase/buy', function () {
    return view('purchase.buy');
});

Route::get('/purchase/address', function () {
    return view('purchase.address');
});