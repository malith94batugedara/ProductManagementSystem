<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ProductController;

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

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::post('/saveProduct', [ProductController::class, 'saveProduct'])->name('product.save');

Route::group(['middleware'=>'auth'],function(){

Route::get('/allProducts', [ProductController::class, 'viewAllProduct'])->name('product.all');

Route::get('/editProduct/{product_id}', [ProductController::class, 'editProduct'])->name('product.edit');

Route::post('/updateProduct/{product_id}', [ProductController::class, 'updateProduct'])->name('product.update');

Route::post('/deleteProduct', [ProductController::class, 'deleteProduct'])->name('product.delete');

});