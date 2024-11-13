<?php

use App\Http\Controllers\ProductsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('/products', [ProductsController::class, 'create'])->name('products.create');
Route::put('/edit-products/{id}', [ProductsController::class, 'edit'])->name('products.edit');