<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function register()
    {
        return 'registertest';
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
