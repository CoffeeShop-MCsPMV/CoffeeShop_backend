<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
      // Összes rendelés lekérdezése
      public function index()
      {
          return Order::all();
      }
  
      // Egy adott rendelés lekérdezése az order_id alapján
      public function show($order_id)
      {
          return Order::find($order_id);
      }
  
      // Új rendelés létrehozása
      public function store(Request $request)
      {
          $record = new Order();
          $record->fill($request->all());
          $record->save();
      }
  
      // Rendelés frissítése
      public function update(Request $request, $order_id)
      {
          $record = Order::find($order_id);
  
          if (!$record) {
              abort(404, 'Order not found.');
          }
  
          $record->fill($request->all());
          $record->save();
      }
  
      // Rendelés törlése
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
          // Lekérdezzük az éves bevételt hónapokra bontva
          $bevetel = Order::select(
              DB::raw('YEAR(dátum) as ev'),
              DB::raw('MONTH(dátum) as honap'),
              DB::raw('SUM(végösszeg) as havi_bevetel')
          )
              ->whereYear('dátum', now()->year) // Csak az aktuális év
              ->groupBy(DB::raw('YEAR(dátum), MONTH(dátum)'))
              ->orderBy(DB::raw('MONTH(dátum)')) // Hónapok szerint növekvő sorrend
              ->get();
      }
  
  
      public function getOrdersByStatus(Request $request)
      {
          // Lekérdezés paraméterként kapott státusz alapján
          $status = $request->query('status', 'Processing'); 
  
          
          $validStatuses = ['Received', 'Processing', 'Ready', 'Released', 'Archive'];
          if (!in_array($status, $validStatuses)) {
              return response()->json(['error' => 'Not fund status'], 400);
          }
  
          
          $orders = Order::where('status', $status)
              ->orderBy('created_at', 'asc') // Legújabb rendelések előre
              ->get(['order_number', 'user_id', 'total_price', 'status', 'created_at']);
  
          return response()->json($orders);
      }
}
