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

        // Convert address to array if it is stored as JSON
        $userArray = $user->toArray();
        if (isset($userArray['address'])) {
            $userArray['address'] = json_decode($userArray['address'], true);
        }

        return ['user' => $userArray, 'token' => $token];
    }

     public function login(array $data)
    {
        $user = User::where('email', $data['email'])->first();

        if (!$user || !Hash::check($data['password'], $user->password)) {
            throw new \Exception('Invalid credentials');
        }

        return $this->jwtService->createToken($user);
    }

    public function logout($token)
    {
        $this->jwtService->invalidateToken($token);
    }
   
}
