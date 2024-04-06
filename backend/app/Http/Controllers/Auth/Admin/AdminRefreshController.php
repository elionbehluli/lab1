<?php

namespace App\Http\Controllers\Auth\Admin;

use App\Http\Controllers\Controller;
use Tymon\JWTAuth\Facades\JWTAuth;

class AdminRefreshController extends Controller
{
    public function __invoke()
    {
        return response()->json([
            'token' => JWTAuth::parseToken()->refresh(),
        ]);
    }
}

