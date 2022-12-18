<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(Request $request) {
        // Validation
        $validation = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Check email
        $user = User::where('email', $validation['email'])->first();

        // Check password
        if($user && Hash::check($validation['password'], $user->password)) {

            // Token
            $token = $user->createToken('myapptoken')->plainTextToken;

            return response()->json([
                'code' => 200,
                'message' => 'Success',
                'data' => $user,
                'token' => $token,
            ]);
        } else {
            return response()->json([
                'code' => 400,
                'message' => 'Failed',
                'data' => [],
            ]);
        }
    }

    public function logout() {
        // Delete token
        auth()->user()->tokens()->delete();

        return response()->json([
            'code' => 200,
            'message' => 'Logged out',
        ]);
    }
}
