<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

use App\Models\Order;
use App\Models\User;
// use Illuminate\Container\Attributes\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function index()
    {
        return User::all();
    }

    public function store(Request $request)
    {
        $record = new User();
        $record->fill($request->all());
        $record->save();
    }

    public function show($id)
    {
        return User::find($id);
    }

    public function update(Request $request, $id)
    {
        $record = User::find($id);
        $record->fill($request->all());
        $record->save();
    }

    public function destroy($id)
    {
        User::find($id)->delete();
    }

    public function usersByType(Request $request)
    {
        $profileType = $request->input('profile_type'); 

        if (!$profileType) {
            return response()->json(['message' => 'Profile type parameter is required.'], 400);
        }

        $users = DB::table('users')
            ->select('name', 'email', 'profile_type')
            ->where('profile_type', '=', $profileType)
            ->get();

        if ($users->isEmpty()) {
            return response()->json(['message' => 'No users found with the specified profile type.'], 404);
        }

        return response()->json($users);
    }

    public function getUserOrders($userId)
    {
        $sql = "
        SELECT order_id, total_cost, order_status
        FROM orders
        WHERE user = :userId
        ";

        $orders = DB::select($sql, ['userId' => $userId]);

        if (empty($orders)) {
            return response()->json(['error' => 'User not found'], 404);
        }

        return response()->json([
            'orders' => $orders
        ]);
    }


    public function countUserOrders()
    {
        $user = Auth::user();

        if (!$user) {
            return response()->json(['message' => 'User not authenticated'], 401);
        }

        $sql = "
        SELECT COUNT(*) AS order_count
        FROM orders
        WHERE user = :userId
    ";

        $count = DB::selectOne($sql, ['userId' => $user->id]);

        return response()->json([
            
            'order_count' => $count->order_count
        ], 200);
    }

    public function getUsersWithReadyOrders()
    {
        $users = DB::select(
            "
        SELECT *
        FROM users
        JOIN orders ON users.id = orders.user
        WHERE orders.order_status = 'ABC'
        "
        );

        return response()->json($users);
    }

    public function suscribedUsers()
    {
        $sql = "
        SELECT name, email
        FROM users
        WHERE is_subscribed = 1";

        $users = DB::select($sql);

        return response()->json($users);
    }


    
    public function getMostPurchasedProduct()
{
    $user = Auth::user();

    if (!$user) {
        return response()->json(['message' => 'User not authenticated.'], 401);
    }

    // A felhasználó ID-ja
    $userId = $user->id;

    $mostPurchasedProduct = DB::table('orders')
        ->join('order_items', 'orders.order_id', '=', 'order_items.order_id')
        ->join('contents', 'order_items.cup_id', '=', 'contents.cup_id')
        ->join('products', 'contents.product_id', '=', 'products.product_id')
        ->select(
            'products.product_id',
            'products.name',
            DB::raw('COUNT(order_items.cup_id) AS product_count')
        )
        ->where('orders.user', $userId) // Használjuk a $userId-t, nem az egész objektumot
        ->groupBy('products.product_id', 'products.name') 
        ->orderBy('product_count', 'DESC')
        ->limit(1)
        ->first(); 

    if ($mostPurchasedProduct) {
        return response()->json($mostPurchasedProduct);
    }

    return response()->json(['message' => 'No purchases found.']);
}

        
    }

