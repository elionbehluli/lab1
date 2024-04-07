<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\UserRegisterRequest;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Exceptions\JWTException;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Facades\JWTAuth;


class UserController extends Controller
{
   
    public function register(UserRegisterRequest $request)
    {
        $request->validated();

        $userData = [
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ];

        // Check if the request is coming from an authenticated admin
        if (Auth::check() && Auth::user()->role === 'admin') {
            // If admin, assign 'employee' role
            $userData['role'] = 'employee';
        } else {
            // If not admin, assign 'customer' role by default
            $userData['role'] = 'customer';
        }

        $user = User::create($userData);

        $token = JWTAuth::fromUser($user);

        return response()->json(compact('user', 'token'), 201);

    }

    public function login()
    {
        return 'logintest';
    }

    public function logout()
    {
        return 'logouttest';
    }

    public function forgotPassword()
    {
        return 'forgotpassword';
    }
}
