<?php

namespace App\Http\Controllers;

use App\Services\UserService;
use App\Helpers\ResponseHelper;
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
}
