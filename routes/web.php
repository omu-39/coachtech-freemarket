<?php

use App\Http\Controllers\LoginController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\ProfileController;


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
    Route::post('/item/{item_id}', [CommentController::class, 'store'])->name('comment.store');
    Route::post('/item/{item_id}/like', [LikeController::class, 'store'])->name('like.store');
    Route::post('/item/{item_id}/like/destroy', [LikeController::class, 'destroy'])->name('like.destroy');
    Route::get('/mypage', [ProfileController::class, 'index'])->name('profile.index');
    Route::get('/mypage/profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::patch('/mypage/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::get('/purchase/{item_id}', [PurchaseController::class, 'index'])->name('purchase.index');
    Route::post('/purchase/{item_id}', [PurchaseController::class, 'store'])->name('purchase.store');
    Route::get('/purchase/address/{item_id}', [PurchaseController::class, 'address'])->name('purchase.address');

});

Route::get('/item/{id}', [ItemController::class, 'show'])->name('item.show');

// 見た目確認用ルート ーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーー

Route::get('/item/show', function () {
    return view('purchase.show');
});

Route::get('/purchase/buy', function () {
    return view('purchase.buy');
});

Route::get('/purchase/address', function () {
    return view('purchase.address');
});