<?php
// app/Http/Middleware/VerifyTokenMiddleware.php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Services\JwtService;
use App\Models\User;
use Exception;

class VerifyTokenMiddleware
{
    protected $jwtService;

    public function __construct(JwtService $jwtService)
    {
        $this->jwtService = $jwtService;
    }

    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response) $next
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function handle(Request $request, Closure $next)
    {
        try {
            $token = $request->bearerToken();
            if (!$token || !$this->jwtService->verifyToken($token)) {
                return response()->json(['status' => 'Authorization Token not found or invalid'], 401);
            }

            // Set the authenticated user
            $userUuid = $this->jwtService->getUserUuidFromToken($token);
            $user = User::where('uuid', $userUuid)->first();

            if (!$user) {
                return response()->json(['status' => 'User not found'], 401);
            }

            $request->setUserResolver(function () use ($user) {
                return $user;
            });
        } catch (Exception $e) {
            return response()->json(['status' => 'Token is invalid or expired', 'error' => $e->getMessage()], 401);
        }

        return $next($request);
    }
}
