<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterRequest;
use App\Services\AuthService;
use App\Helpers\ResponseHelper;

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

}
