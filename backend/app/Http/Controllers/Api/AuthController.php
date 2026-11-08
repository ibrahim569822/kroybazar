<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
            'role' => 'required|in:2,3',
            'business_name' => 'required|string|max:255',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password,
            'role' => $request->role
        ]);

        if ($user->role == 2) {
                $user->vendor()->create(['warehouse_name' => $request->business_name]);
            } else {
                $user->shop()->create(['shop_name' => $request->business_name]);
            }

        return response()->json([
        'message' => 'User registered successfully', 
        'user' => $user
        ], 201);
    }

    public function login(Request $request)
{
    $request->validate([
        'email' => 'required|email',
        'password' => 'required',
    ]);

    $user = User::where('email', $request->email)->first();

    if (! $user || ! Hash::check($request->password, $user->password)) {
        return response()->json(['message' => 'Invalid email or password'], 401);
    }

    if ($user->status != 1) {
        return response()->json(['message' => 'Your account is not approved yet'], 403);
    }

    $token = $user->createToken('kroybazar')->plainTextToken;

    return response()->json([
        'token' => $token,
        'user' => $user,
    ]);
}

public function logout(Request $request)
{
    $request->user()->currentAccessToken()->delete();

    return response()->json(['message' => 'Logged out']);
}
}
