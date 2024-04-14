<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use App\Http\Requests\Auth\UserRegisterRequest;
use Illuminate\Support\Facades\Password;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function register(UserRegisterRequest $request)
    {
        $request->validated();

        $userData = [
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'customer',
        ];

        $user = User::create($userData);

        $token = JWTAuth::fromUser($user);

        return response()->json(compact('user', 'token'), 201);
    }

    public function login(LoginRequest $request)
    {
        $credentials = $request->only('email', 'password');

        try {
            if (! $token = JWTAuth::attempt($credentials)) {
                return response()->json(['error' => 'Invalid credentials'], 401);
            }
        } catch (JWTException $e) {
            return response()->json(['error' => 'Could not create token'], 500);
        }

        // Retrieve the authenticated user
        $user = auth()->user();

        // Return the token along with user information
        return response()->json([
            'token' => $token,
            'user' => $user
        ]);
    }

    public function refreshToken()
    {
        return response()->json([
            'token' => JWTAuth::parseToken()->refresh(),
        ]);
    }
    public function logout()
    {
        auth()->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }

    public function forgotPassword(Request $request)
    {
            
            // Validate request
        $request->validate([
            'email' => 'required|email|exists:users,email',
        ]);

        try {
            // Send reset link
            $status = Password::sendResetLink($request->only('email'));
            
            // Check the status of the reset link sending
            if ($status == Password::RESET_LINK_SENT) {
                return response()->json([
                    'message' => 'Password reset link sent to your email.',
                ]);
            } else {
                // Handle the case where the reset link could not be sent
                return response()->json([
                    'error' => 'Failed to send password reset link.',
                    'status' => $status, // Provide the status code for further context
                ], 400);
            }
        } catch (\Exception $e) {
            // Catch any exceptions and return a detailed error message
            return response()->json([
                'error' => 'An unexpected error occurred while sending the password reset link.',
                'message' => $e->getMessage(),
            ], 500);
        }
    }

    public function resetPassword(Request $request): JsonResponse
{
    // Validate the request data
    $validator = Validator::make($request->all(), [
        'token' => 'required',
        'email' => 'required|email',
        'password' => 'required|string|min:8|confirmed',
    ]);

    if ($validator->fails()) {
        return response()->json([
            'errors' => $validator->errors(),
        ], 422);
    }

    // Reset the user's password
    $status = Password::reset([
        'token' => $request->token,
        'email' => $request->email,
        'password' => $request->password,
        'password_confirmation' => $request->password_confirmation,
    ], function ($user, $password) {
        $user->password = bcrypt($password);
        $user->save();

        // Fire a password reset event
        event(new \Illuminate\Auth\Events\PasswordReset($user));
    });

    // Check the status of the password reset
    if ($status == Password::PASSWORD_RESET) {
        return response()->json([
            'message' => 'Password has been reset successfully.',
        ]);
    } else {
        return response()->json([
            'error' => 'Failed to reset password.',
            'status' => $status, // Provide the status code for further context
        ], 400);
    }
}
}
