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
use App\Models\OrderItem;
use Database\Factories\OrderItemFactory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/products', [ProductController::class, 'index']);
Route::get('/by-type', [ProductController::class, 'getAvailableProductsByType']);
Route::get('/by-category', [ProductController::class, 'getAvailableProductsByCategory']);
Route::post('/orders', [OrderController::class, 'store']);
Route::get('/top-products', [ContentController::class, 'topProducts']);
Route::get('/orders/{order_id}', [OrderController::class, 'show']);

Route::middleware(['auth:sanctum'])
    ->group(function () {
        Route::get('/users/{id}', [UserController::class, 'show']);
        Route::patch('/user', [UserController::class, 'patch']);
        Route::patch('/order/{order_id}',[OrderController::class, 'patch']);
        Route::get('/user-latest-order', [OrderController::class, 'userLatestOrder']);
        Route::get('/users/{id}/orders', [UserController::class, 'getUserOrders']);
        Route::get('/contents/{cup_id}/{product_id}', [ContentController::class, 'show']);
        Route::post('/order_items', [OrderItemController::class, 'store']);
        Route::get('/order_items', [OrderItemController::class, 'index']);
        Route::get('/last-cup/{order}',[OrderItemController::class, 'getLastCup']);
        Route::post('/logout', [AuthenticatedSessionController::class, 'destroy']);
        Route::get('/most-purchased-product', [UserController::class, 'getMostPurchasedProduct']);
        Route::get('/order-count', [UserController::class, 'countUserOrders']);
        Route::get('/user-orders-product', [OrderController::class, 'UserOrdersProduct']);
    });

Route::middleware(['auth:sanctum', Admin::class])
    ->group(function () {
        Route::get('/users', [UserController::class, 'index']);
        Route::patch('/users/{id}', [UserController::class, 'update']);
        Route::get('/orders', [OrderController::class, 'index']);
        Route::post('/users', [UserController::class, 'store']);
        Route::delete('/users/{id}', [UserController::class, 'destroy']);
        Route::put('/orders/{order_id}', [OrderController::class, 'update']);
        Route::post('/products', [ProductController::class, 'store']);
        Route::get('/products/{id}', [ProductController::class, 'show']);
        Route::put('/products/{id}', [ProductController::class, 'update']);
        Route::get('/dictionaries', [DictionaryController::class, 'index']);
        Route::post('/dictionaries', [DictionaryController::class, 'store']);
        Route::post('/product-recipes', [ProductRecipeController::class, 'store']);
        Route::get('/product-recipes/{product}/{ingredient}', [ProductRecipeController::class, 'show']);
        Route::put('/product-recipes/{product}/{ingredient}', [ProductRecipeController::class, 'update']);
        Route::get('/product_recipes/ingredients-of-product/{productId}', [ProductRecipeController::class, 'ingredientsOfProduct']);
        Route::get('/contents-of-cup', [ContentController::class, 'contentsOfCup']);
        Route::get('/usersBy-type', [UserController::class, 'usersByType']);
        Route::get('/by-status', [OrderController::class, 'getOrdersByStatus']);
        Route::get('/ready-orders', [UserController::class, 'getUsersWithReadyOrders']);
        Route::get('/subscribed', [UserController::class, 'suscribedUsers']);
        Route::patch('/orders/{orderId}/status', [OrderController::class, 'updateOrderStatus']);
        Route::get('/active-contents', [OrderController::class, 'getActiveOrdersWithContents']);
    });
