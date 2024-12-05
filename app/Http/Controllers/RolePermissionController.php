<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Http\Controllers\Controller;
use App\Http\Responses\ApiResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class RolePermissionController extends Controller
{

    public function test(){

        return response()->json(['message' => 'permission test successfully.'],200);
    }

    public function checkEmailRole()
    {

        $user =Auth::user()->email;

        $role = ['writer', 'moderator', 'super_admin'];
        if ($user && $role) {

            return ApiResponse::success([], 'Role assigned successfully');
        }

        return ApiResponse::error('User or role not found', 404);
    }




}
