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

    //     public function usersByType(){

    //         $users = User::orderBy('profile_type')
    //     ->orderBy('name')
    //     ->get(['name', 'email', 'profile_type']);


    //     }


    //     public function getUserOrders($userId)
    // {
    //     $user = User::find($userId);

    //     if (!$user) {
    //         return response()->json(['error' => 'User not find'], 404);
    //     }

    //     $orders = $user->userToOrders()
    //         ->orderBy('created_at', 'desc') 
    //         ->get(['order_number', 'total_price', 'status', 'created_at']);

    //     return response()->json([
    //         'user' => $user->name,
    //         'orders' => $orders
    //     ]);
    // }

    // public function countUserOrders()
    // {
    //     $user = Auth::user();

    //     if (!$user) {
    //         return response()->json(['message' => 'User not authenticated'], 401);
    //     }

    //     $orderCount = Order::where('user_id', $user->id)->count();

    //     return response()->json([
    //         'order_count' => $orderCount
    //     ], 200);
    // }

    // public function getUsersWithReadyOrders()
    // {
    //     $users = User::whereHas('orders', function ($query) {
    //         $query->where('status', 'Ready');
    //     })
    //     ->with(['orders' => function ($query) {
    //         $query->where('status', 'Ready');
    //     }]) 
    //     ->get([ 'name', 'order_id']); 

    //     return response()->json($users);
    // }

    // public function suscribedUsers(){

    //     return response()->json(User::where('is_subscribed', 1)->get());
    // }

    // public function getMostPurchasedProduct()
    // {
    //     $user = Auth::user();

    //     $mostPurchasedProduct = Order::where('user_id', $user->id) 
    //         ->whereHas('items.content.product') 
    //         ->withCount(['items as product_count' => function ($query) {
    //             $query->selectRaw('count(*)'); 
    //         }])
    //         ->join('order_items', 'orders.order_id', '=', 'order_items.order_id') 
    //         ->join('contents', 'order_items.cup_id', '=', 'contents.cup_id') 
    //         ->join('products', 'contents.product_id', '=', 'products.id') 
    //         ->groupBy('products.id')
    //         ->orderByDesc('product_count') 
    //         ->limit(1) 
    //         ->select('products.id', 'products.name', 'product_count')
    //         ->first();

    //     if ($mostPurchasedProduct) {
    //         return response()->json([
    //             'product_id' => $mostPurchasedProduct->id,
    //             'product_name' => $mostPurchasedProduct->name,
    //             'purchases_count' => $mostPurchasedProduct->product_count,
    //         ]);
    //     }
    //     return response()->json(['message' => 'No purchases found.']);
    // }

    public function getUsers()
    {
        $users = DB::select(
            "
          SELECT name, email, profile_type
        FROM users
        WHERE profile_type = 'U'"
        );

        if (empty($users)) {
            return response()->json(['message' => 'No users found with profile type U.'], 404);
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

        $count = DB::selectOne($sql, ['userId' => $user->user]);

        return response()->json([
            'order_count' => $count->order_count
        ], 200);
    }

    public function getUsersWithReadyOrders()
    {
        $sql = "
        SELECT users.name, orders.order_id
        FROM users
        JOIN orders ON users.id = orders.user_id
        WHERE orders.status = 'Ready'
    ";

        $users = DB::select($sql);

        return response()->json($users);
    }

    public function suscribedUsers()
    {
        $sql = "
        SELECT *
        FROM users
        WHERE is_subscribed = 1
    ";

        $users = DB::select($sql);

        return response()->json($users);
    }


    public function getMostPurchasedProduct()
    {
        $mostPurchasedProduct = DB::select(
            "
          SELECT products.product_id, products.name, COUNT(order_items.cup_id) AS product_count
        FROM orders
        JOIN order_items ON orders.order_id = order_items.order_id
        JOIN contents ON order_items.cup_id = contents.cup_id
        JOIN products ON contents.product_id = products.product_id
        WHERE orders.user = :userId
        GROUP BY products.product_id
        ORDER BY product_count DESC
        LIMIT 1;"
        );

        if ($mostPurchasedProduct) {
            return response()->json($mostPurchasedProduct);
        }

        return response()->json(['message' => 'No purchases found.']);
    }
}
