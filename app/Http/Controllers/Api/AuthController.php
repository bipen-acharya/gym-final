<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $sanitized = $request->validate([
            'email' => 'required | string | email',
            'password' => 'required',
            'user_role' => 'required'
        ]);

        if (auth()->attempt($sanitized) && $sanitized['user_role'] !== 1) {
            $user = User::where('email', $sanitized['email'])->firstOrFail();
            $user->load(['suscriptions']);
            $user->token = $user->createToken('API Token')->accessToken;
            return response()->json([
                'status' => 'success',
                'message' => 'User Logged In Successfully',
                'data' => $user,
            ], 200);
        } else {
            return response()->json([
                'message' => 'Invalid credentials'
            ], 402);
        }
    }
    public function register(Request $request)
    {
        $sanitized = $request->validate([
            'name' => 'required',
            'email' => ['required', 'unique:users'],
            'password' => ['required', 'min:6', 'confirmed'],
            'gender' => ['nullable'],
            'dob' => ['nullable'],
            'photo' => ['nullable'],
            'user_role' => ['required'],
            'description' => ['nullable'],
        ]);

        $user = User::create($sanitized);
        if ($request->has('photo') && $request->photo !== null) {
            $user->addMedia($sanitized['photo'])->toMediaCollection();
        }
        if ($user) {
            $user->token = $user->createToken('API Token')->accessToken;
            return response()->json([
                'status' => 'success',
                'message' => 'User Registered Successfully',
                'data' => $user,
            ], 200);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'User Registration Failed',
                'data' => [],
            ], 400);
        }
    }

    public function update(Request $request)
    {
        $sanitized = $request->validate([
            'name' => 'required',
            'email' => 'required',
            'password' => 'required',
            'gender' => 'nullable',
            'dob' => 'nullable'
        ]);

        auth('api')->user()->update($sanitized);

        return response()->json(['status' => 'success', 'message' => 'Profile is updated successfully']);
    }

    public function profile()
    {
        return response()->json(['data' => auth('api')->user()]);
    }
}
