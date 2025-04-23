<?php

namespace App\Http\Controllers;

use App\Models\order;
use App\Models\ticket;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index() {
        return order::with(['user', 'ticket'])->get();
    }

    public function store(Request $request) {
        $ticket = ticket::findOrFail($request->ticket_id);
        $total = $ticket->price * $request->quantity;

        $order = order::create([
            'user_id' => $request->user_id,
            'ticket_id' => $request->ticket_id,
            'quantity' => $request->quantity,
            'total_price' => $total,
            'status' => 'pending'
        ]);

        return response()->json($order, 201);
    }

    public function show($id) {
        return order::with(['user', 'ticket'])->findOrFail($id);
    }

    public function update(Request $request, $id) {
        $request->validate([
            'quantity' => 'required|integer|min:1',
        ]);
    
        $order = order::findOrFail($id);
        $ticket = ticket::findOrFail($order->ticket_id);
    
        $newTotal = $ticket->price * $request->quantity;
    
        $order->update([
            'quantity' => $request->quantity,
            'total_price' => $newTotal,
        ]);
        return response()->json($order);
    }

    public function destroy($id) {
        order::destroy($id);
        return response()->json(null, 204);
    }

    public function getOrdersByUser($user_id)
    {
        $orders = Order::where('user_id', $user_id)->get();

        return response()->json($orders);
    }

    public function getOrdersByTicket($ticket_id)
    {
        $orders = Order::where('ticket_id', $ticket_id)->get();

        return response()->json($orders);
    }
}

