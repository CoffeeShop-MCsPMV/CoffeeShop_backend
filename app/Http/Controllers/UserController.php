<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;

use App\Models\Order;
use App\Models\User;
// use Illuminate\Container\Attributes\Auth;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(){
        return User::all();
    }

    public function store(Request $request){
        $record = new User();
        $record->fill($request->all());
        $record->save();
    }

    public function show( $id){
        return User::find($id);
    }

    public function update(Request $request, $id){
        $record=User::find($id);
        $record->fill($request->all());
        $record->save();
        }

    public function destroy($id){
        User::find($id)->delete();
    }

    public function usersByType(){
        
        $users = User::orderBy('profile_type')
    ->orderBy('name')
    ->get(['name', 'email', 'profile_type']);
   

    }


    public function getUserOrders($userId)
{
    $user = User::find($userId);

    if (!$user) {
        return response()->json(['error' => 'User not find'], 404);
    }

    $orders = $user->userToOrders()
        ->orderBy('created_at', 'desc') 
        ->get(['order_number', 'total_price', 'status', 'created_at']);

    return response()->json([
        'user' => $user->name,
        'orders' => $orders
    ]);
}


public function countUserOrders()
{
    
    $user = Auth::user();

    
    $orderCount = Order::where('user_id', $user->id)->count();

    
    return response()->json(['order_count' => $orderCount]);
}


public function getUsersWithReadyOrders()
{
    
    $users = User::whereHas('orders', function ($query) {
        $query->where('status', 'Ready');
    })
    ->with(['orders' => function ($query) {
        $query->where('status', 'Ready');
    }]) 
    ->get([ 'name', 'order_id']); 

   
    return response()->json($users);
}

public function suscribedUsers(){
    $activeUsers = User::where('is_subscribed', 'true')->get();
    return response()->json($activeUsers);

}





public function getMostPurchasedProduct()
{
    
    $user = Auth::user();

    
    $mostPurchasedProduct = Order::where('user_id', $user->id) 
        ->whereHas('items.content.product') 
        ->withCount(['items as product_count' => function ($query) {
            $query->selectRaw('count(*)'); 
        }])
        ->join('order_items', 'orders.order_id', '=', 'order_items.order_id') 
        ->join('contents', 'order_items.cup_id', '=', 'contents.cup_id') 
        ->join('products', 'contents.product_id', '=', 'products.id') 
        ->groupBy('products.id')
        ->orderByDesc('product_count') 
        ->limit(1) 
        ->select('products.id', 'products.name', 'product_count')
        ->first();

    
    if ($mostPurchasedProduct) {
        return response()->json([
            'product_id' => $mostPurchasedProduct->id,
            'product_name' => $mostPurchasedProduct->name,
            'purchases_count' => $mostPurchasedProduct->product_count,
        ]);
    }

    
    return response()->json(['message' => 'No purchases found.']);
}




    


}


