<?php

namespace App\Http\Controllers;

use App\Models\User;
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
}
