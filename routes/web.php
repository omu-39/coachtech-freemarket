<?php

use App\Http\Controllers\LoginController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PurchaseController;

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
Route::get('/item/{item_id}', [ItemController::class, 'show'])->name('item.show');

Route::post('/login', [LoginController::class, 'login'])->name('login');

Route::middleware(['auth', 'verified'])->group(function () {

    Route::controller(ItemController::class)->group(function () {
        Route::get('/sell', 'create')->name('item.create');
        Route::post('/sell', 'store')->name('item.store');
    });
    Route::post('/item/{item_id}', [CommentController::class, 'store'])->name('comment.store');

    Route::controller(LikeController::class)->prefix('item/{item_id}/like')->group(function () {
        Route::post('/', 'store')->name('like.store');
        Route::post('/destroy', 'destroy')->name('like.destroy');
    });

    Route::controller(ProfileController::class)->group(function () {
        Route::get('/mypage', 'index')->name('profile.index');
        Route::get('/mypage/profile', 'show')->name('profile.show');
        Route::put('/mypage/profile', 'edit')->name('profile.edit');
    });

    Route::controller(PurchaseController::class)->group(function () {
        Route::get('/purchase/address/{item_id}', 'show')->name('purchase.show');
        Route::patch('/purchase/address/{item_id}', 'update')->name('purchase.update');
        Route::get('/purchase/{item_id}', 'index')->name('purchase.index');
        Route::post('/purchase/{item_id}', 'store')->name('purchase.store');
    });

});