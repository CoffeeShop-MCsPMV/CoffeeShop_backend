<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\User;
use App\Services\OrderService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    protected $orderService;
    public function index()
    {
        return Order::all();
    }

    public function show($order_id)
    {
        return Order::find($order_id);
    }

    public function __construct(OrderService $orderService)
    {
        $this->orderService = $orderService;
    }

    public function store(Request $request)
    {
        $userId = $request->userId;
    
        if (is_null($userId)) {
            $guestUser = User::where('email', 'guestuser@example.com')->first();
            if ($guestUser) {
                $userId = $guestUser->id;
            } else {
                return response()->json(['error' => 'Guest user not found'], 404);
            }
        }
    
        $order = $this->orderService->createOrderWithItems(
            $userId,
            $request->products
        );
    
        return response()->json(['order_id' => $order->order_id], 201);
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

    public function userLatestOrder()
{
    try {
        $user = Auth::user();

        if (!$user) {
            return response()->json(['error' => 'User not authenticated'], 401);
        }

        $lastOrderId = Order::where('user', $user->id)
            ->latest('created_at')
            ->value('order_id');

        if (!$lastOrderId) {
            return response()->json(['message' => 'No orders found'], 404);
        }

        return response()->json(['order_id' => $lastOrderId], 200);
    } catch (\Exception $e) {
        return response()->json(['error' => 'Something went wrong', 'details' => $e->getMessage()], 500);
    }
}

public function getUserOrdersProduct($orderId)
    {   
        $sql = "
        SELECT p.name, o.order_id
        FROM orders o
        JOIN order_items oi ON o.order_id = oi.order_id
        JOIN contents c ON oi.cup_id = c.cup_id
        JOIN products p ON c.product_id = p.product_id
        WHERE o.order_id = :orderId;
        ";

        $orders = DB::select($sql, ['orderId' => $orderId]);

        return response()->json([
            'orders' => $orders
        ]);
    }

}
