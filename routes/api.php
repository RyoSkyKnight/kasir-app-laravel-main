<?php

use App\Http\Controllers\Api\ProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


// Add a new product
Route::post('/products', [ProductController::class, 'store']);

// Show all products
Route::get('/products', [ProductController::class, 'index']);

// Delete a product
Route::delete('/products/{id}', [ProductController::class, 'delete']);

// Update a product
Route::put('/products/{id}', [ProductController::class, 'update']);

//