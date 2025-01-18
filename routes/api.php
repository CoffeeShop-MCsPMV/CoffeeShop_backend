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
        //ok
        Route::get('/users/{id}', [UserController::class, 'show']);
        //ok
        Route::put('/users/{id}', [UserController::class, 'update']);
        //ok
        Route::post('/orders', [OrderController::class, 'store']);
        //ok
        Route::get('/products', [ProductController::class, 'index']);
        //ok
        Route::get('/contents/{cup_id}/{product_id}', [ContentController::class, 'show']);
        //ok
        Route::post('/contents', [ContentController::class, 'store']);
        //ok
        Route::post('/order_items', [OrderItemController::class, 'store']);
        //ok
        Route::get('/order_items', [OrderItemController::class, 'index']);
        //ok
        Route::post('/logout', [AuthenticatedSessionController::class, 'destroy']);
        //200OK - nincs adat - ????
        Route::get('/users/most-purchased-product', [UserController::class, 'getMostPurchasedProduct']);
        //200OK - nincs adat - ????
        Route::get('/users/order-count', [UserController::class, 'countUserOrders']);
    });

Route::middleware(['auth:sanctum', Admin::class])
    ->group(function () {
        //ok
        Route::get('/users', [UserController::class, 'index']);
        //ok
        Route::get('/orders', [OrderController::class, 'index']);
        //ok
        Route::post('/users', [UserController::class, 'store']);
        //ok
        Route::delete('/users/{id}', [UserController::class, 'destroy']);
        //ok
        Route::get('/orders/{order_id}', [OrderController::class, 'show']);
        //ok
        Route::put('/orders/{order_id}', [OrderController::class, 'update']);
        //ok
        Route::post('/products', [ProductController::class, 'store']);
        //ok
        Route::get('/products/{id}', [ProductController::class, 'show']);
        //ok
        Route::put('/products/{id}', [ProductController::class, 'update']);
        //ok
        Route::get('/dictionaries', [DictionaryController::class, 'index']);
        //ok
        Route::post('/dictionaries', [DictionaryController::class, 'store']);
        //ok
        Route::post('/product-recipes', [ProductRecipeController::class, 'store']);
        //ok
        Route::get('/product-recipes/{product}/{ingredient}', [ProductRecipeController::class, 'show']);
        //???
        Route::put('/product-recipes/{product}/{ingredient}', [ProductRecipeController::class, 'update']);
        //nem jó
        Route::get('/product_recipes/ingredients-of-product', [ProductRecipeController::class, 'ingredientsOfProduct']);
        //ok
        Route::get('/contents/contents-of-cup', [ContentController::class, 'contentsOfCup']);
        //200OK - nincs adat ???
        Route::get('/orders/monthly-income', [OrderController::class, 'monthlyIncome']);
        //ok
        Route::get('/contents/top-products', [ContentController::class, 'topProducts']);
        //200OK nincs adat ???
        Route::get('/users/get-users', [UserController::class, 'getUsers']);
        //200OK nincs adat
        Route::get('/products/by-type', [ProductController::class, 'getProductsByType']);
        //ok
        Route::get('/users/{id}/orders', [UserController::class, 'getUserOrders']);
         //200 ok nincs adat
        Route::get('/orders/by-status', [OrderController::class, 'getOrdersByStatus']);
        //200 ok nincs adat
        Route::get('/users/ready-orders', [UserController::class, 'getUsersWithReadyOrders']);
         //200 ok nincs adat
        Route::get('/users/subscribed', [UserController::class, 'suscribedUsers']);
    });
