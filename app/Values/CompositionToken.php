<?php

namespace App\Values;

use Illuminate\Contracts\Support\Arrayable;
use Laravel\Sanctum\NewAccessToken;
use Laravel\Sanctum\PersonalAccessToken;

final class CompositionToken implements Arrayable
{

    /**
     * CompositionToken Construct
     *
     * @param string $apiToken
     * @param string $expiresAt
     */
    public function __construct(private string $apiToken = "", private string $expiresAt = "")
    {
    }

    /**
     * From access tokens
     *
     * @param NewAccessToken $api
     * @return CompositionToken|null
     */
    public static function fromAccessTokens(NewAccessToken $api, PersonalAccessToken $personalAccessToken)
    {
        return new self((string)$api->plainTextToken, (string)$personalAccessToken->expires_at);
    }

    /**
     * Get the instance as an array.
     *
     * @return array<string, string>
     */
    public function toArray(): array
    {
        return [
            'error' => false,
            'token' => $this->apiToken,
            'expires_at' => $this->expiresAt
        ];
    }
}
