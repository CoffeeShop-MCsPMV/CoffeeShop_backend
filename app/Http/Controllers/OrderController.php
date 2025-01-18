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
        // Alapértelmezett státusz: 'Processing', ha nem adtak meg státuszt a kérésben
        $status = $request->query('status', 'Processing');
        
        // Engedélyezett státuszok listája
        $validStatuses = ['Received', 'Processing', 'Ready', 'Released', 'Archive'];
        
        // Ellenőrizzük, hogy a kapott státusz érvényes-e
        if (!in_array($status, $validStatuses)) {
            return response()->json(['error' => 'Not found status'], 400);
        }
    
        // SQL lekérdezés a megfelelő státuszú rendelések lekéréséhez, JOIN-tal a dictionaries táblával
        $sql = "
            SELECT 
                orders.order_id,  -- Az orders táblában 'order_id' van
                orders.user,  -- A 'user' oszlop tárolja a felhasználó azonosítóját
                orders.total_cost,  -- A 'total_cost' oszlop tárolja az összköltséget
                dictionaries.code as order_status,  -- A státuszt a dictionaries táblából kérdezzük le
                orders.created_at  -- A rendelés létrehozásának ideje
            FROM 
                orders
            JOIN 
                dictionaries ON orders.order_status = dictionaries.code  -- Kapcsolás a dictionaries táblával
            WHERE 
                dictionaries.code = :status  -- A státusz a dictionaries táblában található
            ORDER BY 
                orders.created_at ASC
        ";
    
        // Lekérdezzük az adatokat az adott státusz alapján
        $orders = DB::select($sql, ['status' => $status]);
    
        // Ha nincsenek rendeléshez tartozó adatok, üzenet küldése
        if (empty($orders)) {
            return response()->json(['message' => 'No orders found with status ' . $status], 404);
        }
    
        // Válasz visszaküldése
        return response()->json($orders);
    }
    

}
