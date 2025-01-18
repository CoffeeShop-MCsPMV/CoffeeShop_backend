<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\ContentController;
use App\Http\Controllers\DictionaryController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\OrderItemController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductRecipeController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\Admin;
use Database\Factories\OrderItemFactory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::post('/register', [RegisteredUserController::class, 'store']);
Route::post('/login', [AuthenticatedSessionController::class, 'store']);

Route::middleware(['auth:sanctum'])
    ->group(function () {
        Route::get('/users/{id}', [UserController::class, 'show']);
        Route::put('/users/{id}', [UserController::class, 'update']);
        Route::post('/orders', [OrderController::class, 'store']);
        Route::get('/products', [ProductController::class, 'index']);
        Route::get('/contents/{cup_id}/{product_id}', [ContentController::class, 'show']);
        Route::post('/contents', [ContentController::class, 'store']);
        Route::post('/order_items', [OrderItemController::class, 'store']);
        Route::get('/order_items', [OrderItemController::class, 'index']);
        Route::post('/logout', [AuthenticatedSessionController::class, 'destroy']);
        Route::get('/users/most-purchased-product', [UserController::class, 'getMostPurchasedProduct']);
        Route::get('/users/order-count', [UserController::class, 'countUserOrders']);
    });

Route::middleware(['auth:sanctum', Admin::class])
    ->group(function () {
        Route::get('/users', [UserController::class, 'index']);
        Route::get('/orders', [OrderController::class, 'index']);
        Route::post('/users', [UserController::class, 'store']);
        Route::delete('/users/{id}', [UserController::class, 'destroy']);
        Route::get('/orders/{order_id}', [OrderController::class, 'show']);
        Route::put('/orders/{order_id}', [OrderController::class, 'update']);
        Route::post('/products', [ProductController::class, 'store']);
        Route::get('/products/{id}', [ProductController::class, 'show']);
        Route::put('/products/{id}', [ProductController::class, 'update']);
        Route::get('/dictionaries', [DictionaryController::class, 'index']);
        Route::post('/dictionaries', [DictionaryController::class, 'store']);
        Route::post('/product-recipes', [ProductRecipeController::class, 'store']);
        Route::get('/product-recipes/{product}/{ingredient}', [ProductRecipeController::class, 'show']);
        Route::put('/product-recipes/{product}/{ingredient}', [ProductRecipeController::class, 'update']);
        Route::get('/product_recipes/ingredients-of-product', [ProductRecipeController::class, 'ingredientsOfProduct']);
        Route::get('/contents/contents-of-cup', [ContentController::class, 'contentsOfCup']);
        Route::get('/orders/monthly-income', [OrderController::class, 'monthlyIncome']);
        Route::get('/contents/top-products', [ContentController::class, 'topProducts']);
        Route::get('/users/by-type', [UserController::class, 'usersByType']);
        Route::get('/products/by-type', [ProductController::class, 'getProductsByType']);
        Route::get('/users/{id}/orders', [UserController::class, 'getUserOrders']);
        Route::get('/orders/by-status', [OrderController::class, 'getOrdersByStatus']);
        Route::get('/users/ready-orders', [UserController::class, 'getUsersWithReadyOrders']);
        Route::get('/users/subscribed', [UserController::class, 'suscribedUsers']);
    });
