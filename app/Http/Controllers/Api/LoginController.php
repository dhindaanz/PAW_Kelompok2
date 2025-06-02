<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $validatedData = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string|min:8',
            'device_name' => 'nullable|string|max:255',
        ]);

        $user = User::where('email', $validatedData['email'])->first();

        if (!$user || !password_verify($validatedData['password'], $user->password)) {
            return response()->json([
                'status' => 'error',
                'message' => 'Invalid credentials.',
            ], 401);
        }

        $emailParts = explode('@', $user->email);
        $deviceName = $validatedData['device_name'] ?? $emailParts[0] . ' Device';
        $user->currentAccessToken()->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Login successful.',
            'data' => [
                'user' => $user->only(['id', 'name', 'email']),
                'token' => $user->createToken($deviceName)->plainTextToken,
            ],
        ]);
    }
}
