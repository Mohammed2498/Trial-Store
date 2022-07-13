<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProductController;
use App\Models\Category;
use Database\Seeders\ProductsTableSeeder;
use Illuminate\Routing\Route as RoutingRoute;
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
// Route::get('/welcome', function () {
//     return view('welcome');
// });

// Route::get('/main', function () {
//     return view('main');
// });

// Route::get(
//     '/main',
//     [ProdcutController::class, 'products']
// );
// Route::get(
//     '/categories/index',
//     [CategoryController::class, 'index']
// );
// Route::get(
//     '/products/index',
//     [ProductController::class, 'index']
// );
// Route::view('categories/create','categories.create');
route::get('/starter', function () {
    return view('layout.app');
});
//Route::controller(CategoryController::class)->
Route::group([
    'prefix' => 'dashboard',
    'as' => 'categories.'
], function () {
    Route::get('categories', [CategoryController::class, 'index'])->name('index');
    Route::get('categories/create', [CategoryController::class, 'create'])->name('create');
    Route::post('categories/create', [CategoryController::class, 'store'])->name('store');
    Route::get('categories/{id}/edit', [CategoryController::class, 'edit'])->name('edit');
    Route::put('categories/{id}', [CategoryController::class, 'update'])->name('update');
    Route::delete('categories/{id}', [CategoryController::class, 'destroy'])->name('destroy');
    Route::get('categories/{category}', [CategoryController::class, 'show'])->name('show');
});
Route::group([
    'prefix' => 'dashboard',
], function () {
    Route::resource('products', ProductController::class);
});

