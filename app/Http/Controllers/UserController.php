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
        $users = User::orderBy('profil_type')
    ->orderBy('name')
    ->get(['name', 'email', 'profil_type']);

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
    // Az autentikált felhasználó lekérése
    $user = Auth::user();

    // Az autentikált felhasználó rendeléseinek számának lekérése
    $orderCount = Order::where('user_id', $user->id)->count();

    // Visszaadjuk a rendelés számát
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
    // Az aktuálisan bejelentkezett felhasználó
    $user = Auth::user();

    // Lekérjük a leggyakrabban vásárolt készterméket
    $mostPurchasedProduct = Order::where('user_id', $user->id) // A bejelentkezett felhasználó rendelései
        ->whereHas('items.content.product') // Csak azok a rendelési tételek, amelyekhez termék tartozik a content-en keresztül
        ->withCount(['items as product_count' => function ($query) {
            $query->selectRaw('count(*)'); // Összesíti a termékek számát
        }])
        ->join('order_items', 'orders.order_id', '=', 'order_items.order_id') // Csatlakoztatjuk az order_items táblát
        ->join('contents', 'order_items.cup_id', '=', 'contents.cup_id') // Csatlakoztatjuk a content-táblát
        ->join('products', 'contents.product_id', '=', 'products.id') // Csatlakoztatjuk a termékeket
        ->groupBy('products.id') // Csoportosítjuk termékek szerint
        ->orderByDesc('product_count') // Legnagyobb számú vásárlás szerint rendezzük
        ->limit(1) // Csak az első (leggyakrabban vásárolt) terméket kérjük le
        ->select('products.id', 'products.name', 'product_count')
        ->first();

    // Ha van leggyakrabban vásárolt termék, visszaadjuk
    if ($mostPurchasedProduct) {
        return response()->json([
            'product_id' => $mostPurchasedProduct->id,
            'product_name' => $mostPurchasedProduct->name,
            'purchases_count' => $mostPurchasedProduct->product_count,
        ]);
    }

    // Ha nincs vásárolt termék, üzenet
    return response()->json(['message' => 'No purchases found.']);
}




    


}


