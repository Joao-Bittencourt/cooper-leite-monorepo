<?php

declare(strict_types=1);

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller as Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\JsonResponse;

class RegisterController extends Controller
{
    public function register(Request $request): JsonResponse
    {
        $request->validate([
            'name' => ['required'],
            'email' => ['required','email', 'unique:users'],
            'password' => ['required'],
            'c_password' => ['required', 'same:password'],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password
        ]);

        $success['token'] =  $user->createToken('MyApp')->plainTextToken;
        $success['name'] =  $user->name;

        return response()->json([
            'data' => $success,
            'message' => 'User register successfully.',
        ]);
    }

    public function login(Request $request): JsonResponse
    {
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $user = Auth::user();
            $success['token'] =  $user?->createToken('MyApp')->plainTextToken;
            $success['name'] =  $user?->name;
            $success['email'] =  $user?->email;

            return response()->json([
                'data' => $success,
                'message' => 'User login successfully.',
            ]);
        }

        return response()->json([
            'message' => 'Unauthenticated.',
            'error' => 'Unauthenticated'
        ], 401);
    }
}
