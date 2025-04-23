<?php

namespace App\Http\Controllers;

use App\Models\ticket;
use Illuminate\Http\Request;

class TiketController extends Controller
{
    public function index() {
        return ticket::all();
    }

    public function store(Request $request) {
        $validated = $request->validate([
            'destination' => 'required|string',
            'departure_time' => 'required|date_format:Y-m-d H:i:s',
            'price' => 'required|numeric|min:0'
        ]);

        $ticket = ticket::create($validated);
        return response()->json($ticket, 201);
    }

    public function show($id) {
        return ticket::findOrFail($id);
    }

    public function update(Request $request, $id) {
        $ticket = ticket::findOrFail($id);
        $ticket->update($request->all());
        return response()->json($ticket);
    }

    public function destroy($id) {
        ticket::destroy($id);
        return response()->json(null, 204);
    }
}
