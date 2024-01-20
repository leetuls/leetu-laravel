<?php

namespace App\Services;

use App\Models\User;
use App\Values\CompositionToken;
use Laravel\Sanctum\NewAccessToken;
use Laravel\Sanctum\PersonalAccessToken;
use Illuminate\Support\Carbon;

class TokenManager
{

    public function __construct(private CompositionToken $compositionToken)
    {
    }

    public function createToken(User $user, array $abilities = ['*']): NewAccessToken
    {
        return $user->createToken(config('app.name'), $abilities, Carbon::now()->addMinutes(5));
    }

    public function createCompositionToken(User $user): CompositionToken
    {
        $newAccessToken = $this->createToken($user);
        return $this->compositionToken::fromAccessTokens(
            api: $newAccessToken,
            personalAccessToken: $newAccessToken->accessToken
        );
    }

    public function deleteTokenByPlainTextToken(string $plainTextToken): void
    {
        PersonalAccessToken::findToken($plainTextToken)?->delete();
    }

    public function getUserFromPlainTextToken(string $plainTextToken): ?User
    {
        return PersonalAccessToken::findToken($plainTextToken)?->tokenable;
    }

    public function refreshApiToken(string $currentPlainTextToken): NewAccessToken
    {
        $newToken = $this->createToken($this->getUserFromPlainTextToken($currentPlainTextToken));
        $this->deleteTokenByPlainTextToken($currentPlainTextToken);

        return $newToken;
    }
}
