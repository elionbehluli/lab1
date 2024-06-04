<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Resources\UserResource;

class ManageUsersController extends Controller
{
    public function index()
    {
        $usersWithoutAdminRole = User::where('role', '<>', 'admin')->get();
        return UserResource::collection($usersWithoutAdminRole);
    }

    public function editRole(Request $request, int $id)
    {
        $user = User::findOrFail($id);

        // Validate the request
        $validatedData = $request->validate([
            'role' => 'required|string'
        ]);

        // Update the user's role
        $user->role = $validatedData['role'];

        if ($user->save()) {
            return response()->json(['success' => 'Role updated successfully.'], 200);
        } else {
            return response()->json(['error' => 'Failed to update role.'], 500);
        }
    }

    public function destroy($id): bool
    {
        $user = User::findOrFail($id);
        
        return $user->delete();
    }
}
