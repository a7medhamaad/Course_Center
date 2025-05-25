<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\AuthRequest;
use App\Models\User;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function register(AuthRequest $request)
    {
        $user = User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => bcrypt($request->password),
    ]);

    return response()->json([
        'token' => $user->createToken('api-token')->plainTextToken,
    ]);
    }

    public function login(Request $request)
    {
        if (!auth()->attempt($request->only('email', 'password'))) {
        return response()->json(['message' => 'Invalid credentials'], 401);
        }

        return response()->json([
            'token' => auth()->user()->createToken('api-token')->plainTextToken
        ]);
    }
}
