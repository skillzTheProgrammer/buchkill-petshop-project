<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthService
{
    protected $jwtService;

    public function __construct(JwtService $jwtService)
    {
        $this->jwtService = $jwtService;
    }

    public function register(array $data)
    {
        $data['password'] = Hash::make($data['password']);
        $user = User::create($data);

        $token = $this->jwtService->createToken($user);

        return ['user' => $user, 'token' => $token];
    }

   
}
