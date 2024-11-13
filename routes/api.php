<?php

use App\Http\Controllers\ProductsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::post('/products', [ProductsController::class, 'create'])->name('products.create');
Route::put('/edit-products/{id}', [ProductsController::class, 'edit'])->name('products.edit');