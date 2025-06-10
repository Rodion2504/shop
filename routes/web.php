<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\OrderController;

// Управление товарами:
Route::resource('products', ProductController::class);

// Управление заказами:
Route::resource('orders', OrderController::class);

// Дополнительные маршруты для изменения статуса заказа:
//Route::patch('/orders/{order}/complete', [OrderController::class, 'markAsCompleted'])->name('orders.complete');

Route::get('/', function () {
    return view('welcome');
});
