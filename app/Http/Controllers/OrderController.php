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
    
        // if (is_null($userId)) {
        //     $guestUser = User::where('email', 'guestuser@example.com')->first();
        //     if ($guestUser) {
        //         $userId = $guestUser->id;
        //     } else {
        //         return response()->json(['error' => 'Guest user not found'], 404);
        //     }
        // }
    
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
        // Az aktuálisan bejelentkezett felhasználó id-ja
        $userId = Auth::id();
    
        // A rendelés lekérése az ID alapján
        $order = Order::find($order_id);
    
        if (!$order) {
            return response()->json(['error' => 'Order not found'], 404);
        }
    
        // Frissítjük a rendelés user_id-ját az aktuális bejelentkezett felhasználóra
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
    
        // Érvényes státuszok sorrendje
        $statusOrder = ['ACC', 'REC', 'PRO', 'COM', 'PUP', 'CAN'];
    
        // Ha az új státusz nem szerepel a választható státuszok között
        if (!in_array($request->status, $statusOrder)) {
            return response()->json(['message' => 'Invalid status'], 400);
        }
    
        // Meghatározzuk a következő státuszt
        $currentIndex = array_search($request->status, $statusOrder);
        $nextStatus = $currentIndex < count($statusOrder) - 1 ? $statusOrder[$currentIndex + 1] : $request->status;
    
        // Frissítjük a státuszt
        $order->order_status = $nextStatus;
        $order->save();
    
        return response()->json(['message' => 'Status updated successfully', 'new_status' => $nextStatus]);
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

    

    public function getActiveOrdersWithContents(): JsonResponse
    {
        $query = "
            SELECT 
                o.order_id,
                o.order_status,
                c.cup_id,
                c.product_id,
                p.name AS product_name,
                ing.name AS ingredient_name,
                pr.quantity
            FROM 
                orders o
            JOIN 
                order_items oi ON o.order_id = oi.order_id
            JOIN 
                contents c ON oi.cup_id = c.cup_id
            LEFT JOIN 
                products p ON c.product_id = p.product_id
            LEFT JOIN 
                product_recipes pr ON c.product_id = pr.product
            LEFT JOIN 
                products ing ON pr.ingredient = ing.product_id
            WHERE 
                o.order_status IN ('Acc', 'Rec', 'Pro', 'Com')
            ORDER BY 
                o.order_id,
                oi.cup_id
        ";
    
        $rawResults = DB::select($query);
    
        // Átalakítás strukturált JSON-né: order_id -> cup_id -> product + ingredients
        $structured = [];
    
        foreach ($rawResults as $row) {
            $orderId = $row->order_id;
            $cupId = $row->cup_id;
    
            // Inicializálás
            if (!isset($structured[$orderId])) {
                $structured[$orderId] = [
                    'order_id' => $orderId,
                    'order_status' => $row->order_status, // Itt hozzáadjuk az order_status-t
                    'cups' => [],
                ];
            }
    
            if (!isset($structured[$orderId]['cups'][$cupId])) {
                $structured[$orderId]['cups'][$cupId] = [
                    'cup_id' => $cupId,
                    'product_id' => $row->product_id,
                    'product_name' => $row->product_name,
                    'ingredients' => [],
                ];
            }
    
            // Hozzávaló hozzáadása, ha van
            if ($row->ingredient_name) {
                $structured[$orderId]['cups'][$cupId]['ingredients'][] = [
                    'name' => $row->ingredient_name,
                    'quantity' => $row->quantity,
                ];
            }
        }
    
        // Az asszociatív tömb átalakítása indexelt tömbbé a cups miatt
        $final = array_values(array_map(function ($order) {
            $order['cups'] = array_values($order['cups']);
            return $order;
        }, $structured));
    
        return response()->json($final);
    }
    

}
