<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProdcutController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProductController;

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
Route::get('/welcome', function () {
    return view('welcome');
});

Route::get('/main', function () {
    return view('main');
});

Route::get(
    '/main',
    [ProdcutController::class, 'products']
);
Route::get(
    '/categories/index',
    [CategoryController::class, 'index']
);
Route::get(
    '/products/index',
    [ProductController::class, 'index']
);

