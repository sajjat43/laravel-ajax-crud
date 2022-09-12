<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\userController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\productController;
use App\Models\Product;

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
    return view('ajax');
});

Route::get('/ajax/get', [CategoryController::class, 'get'])->name('ajax.get');


Route::get('/ajax/list', [CategoryController::class, 'list'])->name('list');
Route::post('/ajax/category/create', [CategoryController::class, 'categoryCreate'])->name('ajax.category.create');
Route::get('/ajax/category/delete/{id}', [CategoryController::class, 'categoryDelete'])->name('ajax.category.delete');


// -------- product -----

route::get('product/blade',[productController::class, 'productBlade'])->name('product.blade');
route::get('product/view',[productController::class,'productView'])->name('product.view');

route::POST('product/store',[productController::class,'productStore'])->name('product.store');


route::get('edit/product/{id}',[productController::class,'editProduct'])->name('edit.product');

route::post('/product/update/{id}',[productController::class,  'updateProduct'])->name('update.product');

route::get('/product/delete/{id}',[productController::class, 'deleteProduct'])->name('delete.product');