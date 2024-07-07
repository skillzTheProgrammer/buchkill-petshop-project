<?php

namespace App\Http\Controllers;

use App\Services\UserService;
use App\Helpers\ResponseHelper;
use App\Http\Requests\UpdateUserRequest;
use Illuminate\Http\Request;

class UserController extends Controller
{
    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function show(Request $request)
    {
        try {
            $user = $this->userService->show($request->user());
            return ResponseHelper::success($user, 'User details retrieved successfully');
        } catch (\Exception $e) {
            return ResponseHelper::error($e->getMessage());
        }
    }

     public function update(UpdateUserRequest $request)
    {
        try {
            $user = $request->user(); // Get the authenticated user
            $userData = $this->userService->update($user, $request->validated());
            return ResponseHelper::success($userData, 'User details updated successfully');
        } catch (\Exception $e) {
            return ResponseHelper::error($e->getMessage());
        }
    }
}
