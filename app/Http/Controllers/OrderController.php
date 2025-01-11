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
        $bevetel = Order::select(
            DB::raw('YEAR(dátum) as ev'),
            DB::raw('MONTH(dátum) as honap'),
            DB::raw('SUM(végösszeg) as havi_bevetel')
        )
            ->whereYear('dátum', now()->year)
            ->groupBy(DB::raw('YEAR(dátum), MONTH(dátum)'))
            ->orderBy(DB::raw('MONTH(dátum)'))
            ->get();
        return response()->json($bevetel);
    }

    public function getOrdersByStatus(Request $request)
    {
        $status = $request->query('status', 'Processing');

        $validStatuses = ['Received', 'Processing', 'Ready', 'Released', 'Archive'];
        if (!in_array($status, $validStatuses)) {
            return response()->json(['error' => 'Not found status'], 400);
        }

        $orders = Order::where('order_status', $status)
            ->orderBy('created_at', 'asc')
            ->get(['order_number', 'user_id', 'total_price', 'order_status', 'created_at']);

        if ($orders->isEmpty()) {
            return response()->json(['message' => 'No orders found with status ' . $status], 404);
        }

        return response()->json($orders);
    }
}
