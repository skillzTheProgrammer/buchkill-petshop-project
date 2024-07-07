<?php


namespace App\Services;

use App\Exceptions\ForbiddenException;
use App\Models\User;
use App\Models\JwtToken;
use Lcobucci\JWT\Configuration;
use Lcobucci\JWT\Signer\Hmac\Sha256;
use Lcobucci\JWT\Signer\Key\InMemory;
use Lcobucci\JWT\UnencryptedToken;
use DateTimeImmutable;
use Illuminate\Support\Facades\Log;

class JwtService
{
    protected $config;

    public function __construct()
    {
        $jwtSecret = config('app.jwt_secret');

        if (!$jwtSecret) {
            throw new \Exception('JWT secret is not set in the environment variables');
        }

        $this->config = Configuration::forSymmetricSigner(
            new Sha256(),
            InMemory::plainText($jwtSecret)
        );
    }

    public function createToken(User $user, $title = 'default', $permissions = [], $restrictions = [])
    {
        // Check if a token already exists for the user and delete it
        $existingToken = JwtToken::where('user_id', $user->id)->first();
        if ($existingToken) {
            $existingToken->delete();
        }
        $now = new DateTimeImmutable();
        $expiresAt = $now->modify('+30 days');
        $token = $this->config->builder()
            ->issuedBy(config('app.url'))
            ->withClaim('user_uuid', $user->uuid)
            ->issuedAt($now)
            ->expiresAt($expiresAt)
            ->getToken($this->config->signer(), $this->config->signingKey())
            ->toString();
        Log::info('Creating JWT token: ' . $token);
        JwtToken::create([
            'unique_id' => $token,
            'user_id' => $user->id,
            'token_title' => $title,
            'permissions' => json_encode($permissions),
            'restrictions' => json_encode($restrictions),
            'expires_at' => $expiresAt,
            'last_used_at' => $now,
            'refreshed_at' => $now,
        ]);
        return $token;
    }

    public function verifyToken($token)
    {
         try {
            $parsedToken = $this->config->parser()->parse($token);

            assert($parsedToken instanceof UnencryptedToken);

            $uuid = $parsedToken->claims()->get('user_uuid');

            $jwtToken = JwtToken::where('unique_id', $token)
                ->where('expires_at', '>', new DateTimeImmutable())
                ->first();

            if (!$jwtToken) {
                return throw new ForbiddenException();
            }

            $jwtToken->update(['last_used_at' => new DateTimeImmutable()]);

            return true;
        } catch (\Exception $e) {
            return false;
        }
    }

    public function invalidateToken($token)
    {
        try {
            $jwtToken = JwtToken::where('unique_id', $token)->first();
            if ($jwtToken) {
                $jwtToken->delete();
            }

            return true;
        } catch (\Exception $e) {
            return false;
        }
    }

        public function getUserUuidFromToken($token)
    {
        $parsedToken = $this->config->parser()->parse($token);
        assert($parsedToken instanceof UnencryptedToken);
        return $parsedToken->claims()->get('user_uuid');
    }

}
