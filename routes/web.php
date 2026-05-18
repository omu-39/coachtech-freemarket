<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/edit', function () {
    return view('profile.edit');
});

Route::get('/profile', function () {
    return view('profile.show');
});

Route::get('/sell', function () {
    return view('sell');
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