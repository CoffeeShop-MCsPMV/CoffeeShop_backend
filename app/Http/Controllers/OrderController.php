<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\User;
use App\Services\OrderService;
use Illuminate\Http\JsonResponse;
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

    public function patch(Request $request, $order_id)
    {
        $userId = Auth::id();

        $order = Order::find($order_id);

        if (!$order) {
            return response()->json(['error' => 'Order not found'], 404);
        }

        $order->user = $userId;
        $order->save();

        return response()->json(['message' => 'Order updated successfully'], 200);
    }


    public function destroy($order_id)
    {
        $record = Order::find($order_id);

        if (!$record) {
            abort(404, 'Order not found.');
        }

        $record->delete();
    }

    public function updateOrderStatus(Request $request, $orderId)
    {
        $order = Order::find($orderId);

        if (!$order) {
            return response()->json(['message' => 'Order not found'], 404);
        }

        $statusOrder = ['ACC', 'REC', 'PRO', 'COM', 'PUP', 'CAN'];

        if (!in_array($request->status, $statusOrder)) {
            return response()->json(['message' => 'Invalid status'], 400);
        }

        
        $currentIndex = array_search($request->status, $statusOrder);
        $nextStatus = $currentIndex < count($statusOrder) - 1 ? $statusOrder[$currentIndex + 1] : $request->status;

    
        $order->order_status = $nextStatus;
        $order->save();

        return response()->json(['message' => 'Status updated successfully', 'new_status' => $nextStatus]);
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

    public function UserOrdersProduct()
    {
        $user = Auth::user(); 
        $userId=$user->id;
    
        $sql = "
       SELECT 
             o.order_id,
             o.total_cost,
            oi.cup_id,
            GROUP_CONCAT(p.name ORDER BY p.name ASC SEPARATOR ', ') AS product
        FROM orders o
        JOIN order_items oi ON o.order_id = oi.order_id
        JOIN contents c ON oi.cup_id = c.cup_id
        JOIN products p ON c.product_id = p.product_id
        WHERE o.user = :userId
        GROUP BY o.order_id, o.total_cost, oi.cup_id
        ORDER BY o.order_id DESC, oi.cup_id;";

    
        $orders = DB::select($sql, ['userId' => $userId]);
    
        return response()->json([
            'orders' => $orders
        ]);
    }
    



    public function getActiveOrdersWithContents(): JsonResponse
    {
        $query = "
            SELECT 
                o.order_id,
                o.order_status,
                oi.cup_id,
                c.product_id,
                c.product_type,
                p.name AS product_name,
                pr.ingredient,
                ing.name AS ingredient_name,
                pr.quantity
            FROM orders o
            JOIN order_items oi ON o.order_id = oi.order_id
            JOIN contents c ON oi.cup_id = c.cup_id
            LEFT JOIN products p ON c.product_id = p.product_id
            LEFT JOIN product_recipes pr ON c.product_id = pr.product
            LEFT JOIN products ing ON pr.ingredient = ing.product_id
            WHERE o.order_status IN ('Acc', 'Rec', 'Pro', 'Com')
            ORDER BY o.order_id, oi.cup_id
        ";

        $rawResults = DB::select($query);

        $cupsGrouped = [];

        foreach ($rawResults as $row) {
            $cupsGrouped[$row->cup_id][] = $row;
        }

        $structured = [];

        foreach ($cupsGrouped as $cupId => $rows) {
            $firstRow = $rows[0];
            $orderId = $firstRow->order_id;

            if (!isset($structured[$orderId])) {
                $structured[$orderId] = [
                    'order_id' => $orderId,
                    'order_status' => $firstRow->order_status,
                    'cups' => [],
                ];
            }

            $cup = [
                'cup_id' => $cupId,
                'product_id' => null,
                'product_name' => null,
                'ingredients' => [],
            ];

            if ($firstRow->product_type === 'F') {
                
                $cup['product_id'] = $firstRow->product_id;
                $cup['product_name'] = $firstRow->product_name;

                foreach ($rows as $row) {
                    if ($row->ingredient_name) {
                        $cup['ingredients'][] = [
                            'name' => $row->ingredient_name,
                            'quantity' => $row->quantity,
                        ];
                    }
                }
            } elseif ($firstRow->product_type === 'I') {
                
                foreach ($rows as $row) {
                    $cup['ingredients'][] = [
                        'name' => $row->product_name,
                    ];
                }
            }

            $structured[$orderId]['cups'][] = $cup;
        }

        $final = array_values($structured);

        return response()->json($final);
    }
}
