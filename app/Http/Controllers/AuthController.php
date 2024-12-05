<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Interfaces\AuthRepositoryInterface;
use Illuminate\Support\Facades\Hash;
use Illuminate\Container\Attributes\Auth;
use App\Http\Responses\ApiResponse;
 use Illuminate\Http\Request;
 use App\Events\UserLoggedEvent;

class AuthController extends Controller
{

    protected $authRepository;

    public function __construct(AuthRepositoryInterface $authRepository)
    {
        $this->authRepository = $authRepository;
    }

    public function register(RegisterRequest $request)
    {
        $data = $request->only(['name', 'email', 'password']);
        $user = $this->authRepository->register($data);
        return ApiResponse::success($user, 'User registered successfully');
    }

    public function login(Request $request)
    {

        $credentials = $request->only(['email', 'password']);
        $result = $this->authRepository->login($credentials);

        if ($result) {
            $user = $result['user'];
            event(new UserLoggedEvent($user)); // Trigger the custom event


            return ApiResponse::success($result, 'Login successful');
        } else {
            return ApiResponse::error('Invalid credentials', 401);
        }








        // $credentials = $request->only(['email', 'password']);
        // $result = $this->authRepository->login($credentials);
        // if ($result) {
        //     return ApiResponse::success($result, 'Login successful');
        // } else {
        //     return ApiResponse::error('Invalid credentials', 401);
        // }


    }


}
