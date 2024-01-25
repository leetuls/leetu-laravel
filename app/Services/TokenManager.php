<?php

namespace App\Services;

use App\Models\User;
use App\Values\CompositionToken;
use Laravel\Sanctum\NewAccessToken;
use Laravel\Sanctum\PersonalAccessToken;
use Illuminate\Support\Carbon;
use App\Repositories\User\UserRepositoryInterface;

class TokenManager
{

    public function __construct(
        private CompositionToken $compositionToken,
        private UserRepositoryInterface $userRepository
    ) {
    }

    /**
     * Create token login
     *
     * @param User $user
     * @param array $abilities
     * @return NewAccessToken
     */
    public function createToken(User $user, array $abilities = ['*']): NewAccessToken
    {
        return $user->createToken(config('app.name'), $abilities, Carbon::now()->addDay(30));
    }

    /**
     * Composition Token
     *
     * @param User $user
     * @return CompositionToken
     */
    public function createCompositionToken(User $user): CompositionToken
    {
        $newAccessToken = $this->createToken($user);
        return $this->compositionToken::fromAccessTokens(
            api: $newAccessToken,
            personalAccessToken: $newAccessToken->accessToken,
            user: $user
        );
    }

    /**
     * Delete token by plain text token function
     *
     * @param string $plainTextToken
     * @return void
     */
    public function deleteTokenByPlainTextToken(string $plainTextToken): void
    {
        $this->getUserFromPlainTextToken($plainTextToken)?->tokens()->delete();
    }

    /**
     * 
     * Get User From Plain Text Token
     *
     * @param string $plainTextToken
     * @return User|null
     */
    public function getUserFromPlainTextToken(string $plainTextToken): ?User
    {
        return PersonalAccessToken::findToken($plainTextToken)?->tokenable;
    }

    /**
     * Refresh Api Token
     *
     * @param string $currentPlainTextToken
     * @return NewAccessToken
     */
    public function refreshApiToken(string $currentPlainTextToken): NewAccessToken
    {
        $newToken = $this->createToken($this->getUserFromPlainTextToken($currentPlainTextToken));
        $this->deleteTokenByPlainTextToken($currentPlainTextToken);

        return $newToken;
    }
}
