<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function index()
    {
        return Order::all();
    }

    public function show($order_id)
    {
        return Order::find($order_id);
    }

    public function store(Request $request)
    {
        $record = new Order();
        $record->fill($request->all());
        $record->save();
    }

    public function update(Request $request, $order_id)
    {
        $record = Order::find($order_id);

        if (!$record) {
            abort(404, 'Order not found.');
        }

        $record->fill($request->all());
        $record->save();
    }

    public function destroy($order_id)
    {
        $record = Order::find($order_id);

        if (!$record) {
            abort(404, 'Order not found.');
        }

        $record->delete();
    }

    public function monthlyIncome()
    {
        $income = DB::select(
            "
            SELECT 
                    YEAR(date) AS ev,
                    MONTH(date) AS honap,
                    SUM(total_cost) AS havi_bevetel
                FROM 
                    orders
                WHERE 
                    YEAR(date) = YEAR(CURDATE()) 
                GROUP BY 
                    YEAR(date), MONTH(date)
                ORDER BY 
                    MONTH(date);

           "
        );

        return response()->json($income);
    }

    // public function getOrdersByStatus(Request $request)
    // {
    //     $status = $request->query('status', 'Processing');

    //     $validStatuses = ['Received', 'Processing', 'Ready', 'Released', 'Archive'];
    //     if (!in_array($status, $validStatuses)) {
    //         return response()->json(['error' => 'Not found status'], 400);
    //     }

    //     $orders = Order::where('order_status', $status)
    //         ->orderBy('created_at', 'asc')
    //         ->get(['order_number', 'user_id', 'total_price', 'order_status', 'created_at']);

    //     if ($orders->isEmpty()) {
    //         return response()->json(['message' => 'No orders found with status ' . $status], 404);
    //     }

    //     return response()->json($orders);
    // }

    public function getOrdersByStatus(Request $request)
    {
        $status = $request->query('status', 'Processing');
        
        $validStatuses = ['Received', 'Processing', 'Ready', 'Released', 'Archive'];
        
        if (!in_array($status, $validStatuses)) {
            return response()->json(['error' => 'Not found status'], 400);
        }
    
        $sql = "
            SELECT 
                orders.order_id,  
                orders.user,  
                orders.total_cost,  
                dictionaries.code as order_status
            FROM 
                orders
            JOIN 
                dictionaries ON orders.order_status = dictionaries.description 
            WHERE 
                dictionaries.code = :status 
            ORDER BY 
                orders.created_at ASC
        ";

        $orders = DB::select($sql, ['status' => $status]);
 
        if (empty($orders)) {
            return response()->json(['message' => 'No orders found with status ' . $status], 404);
        }

        return response()->json($orders);
    }
    

}
