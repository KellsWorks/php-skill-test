<?php

use App\Http\Controllers\ProductsController;
use Illuminate\Support\Facades\Route;

Route::get('/', [ProductsController::class, 'index'])->name('index');
Route::post('/products', [ProductsController::class, 'create'])->name('products.create');