<?php

namespace App\Http\Controllers;

use App\Models\user_travel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index() {
        return user_travel::all();
    }

    public function store(Request $request) {
        $validated = $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users_travels,email',
            'password' => 'required|string|min:6',
        ]);

        $validated['password'] = Hash::make($validated['password']);

        $user = user_travel::create($validated);
        return response()->json($user, 201);
    }

    public function show($id) {
        return user_travel::findOrFail($id);
    }

    public function update(Request $request, $id) {
        $user = user_travel::findOrFail($id);

        if ($request->has('password')) {
            $request['password'] = Hash::make($request->password);
        }

        $user->update($request->all());
        return response()->json($user);
    }

    public function destroy($id) {
        user_travel::destroy($id);
        return response()->json(null, 204);
    }
}

