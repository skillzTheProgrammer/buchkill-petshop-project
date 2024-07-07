<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterRequest;
use App\Services\AuthService;
use App\Helpers\ResponseHelper;
use App\Http\Requests\LoginRequest;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    protected $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    public function register(RegisterRequest $request)
    {
        try {
            $result = $this->authService->register($request->validated());
            return ResponseHelper::success($result, 'User registered successfully', 201);
        } catch (\Exception $e) {
            return ResponseHelper::error($e->getMessage());
        }
    }

     public function login(LoginRequest $request)
    {
        try {
            $token = $this->authService->login($request->validated());
            return ResponseHelper::success(['token' => $token], 'Login successful');
        } catch (\Exception $e) {
            return ResponseHelper::error($e->getMessage(), [], 401);
        }
    }


    public function logout(Request $request)
    {
        try {
            $this->authService->logout($request->bearerToken());
            return ResponseHelper::success(null, 'Logged out successfully');
        } catch (\Exception $e) {
            return ResponseHelper::error($e->getMessage());
        }
    }

}
