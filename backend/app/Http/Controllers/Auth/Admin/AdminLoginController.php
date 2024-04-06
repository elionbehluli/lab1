<?php

namespace App\Http\Controllers\Auth\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\AdminLoginRequest;
use Tymon\JWTAuth\Facades\JWTAuth;

class AdminLoginController extends Controller
{
    public function __invoke(AdminLoginRequest $request)
    {
        $request->validated();
        
         $credentials = $request->only('email', 'password');

         if (!$token = JWTAuth::attempt($credentials)) {
             return response()->json(['error' => 'Unauthorized'], 401);
         }
 
         return response()->json(compact('token'));
    }
}
