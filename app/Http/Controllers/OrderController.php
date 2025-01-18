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

       public function getOrdersByStatus(Request $request)
    {
        $status = $request->input('status'); 

        if (!$status) {
            return response()->json(['error' => 'Status parameter is required'], 400);
        }

        $results = DB::table('orders')
            ->join('dictionaries', 'orders.order_status', '=', 'dictionaries.code')
            ->select('orders.order_id', 'orders.user', 'orders.total_cost', 'dictionaries.code as order_status')
            ->where('dictionaries.code', '=', $status)
            ->orderBy('orders.created_at', 'asc')
            ->get();

        return $results; 

}
}