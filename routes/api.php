<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomerController\UserController;
use App\Http\Controllers\CustomerController\ProfileController;
use App\Http\Controllers\CustomerController\ProductController;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post("/register", [UserController::class, 'register']);
Route::post("/login", [UserController::class, 'login']);
Route::put("/profile/{id}/update", [ProfileController::class, 'update']);
Route::post("/add-product", [ProductController::class, 'store']);
Route::get("/products", [ProductController::class, 'index']);
Route::get('/product/{id}/edit', [ProductController::class, 'edit']);
Route::put("/product/{id}/edit", [ProductController::class, 'update']);



