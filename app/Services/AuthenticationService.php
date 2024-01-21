<?php

namespace App\Services;

use App\Models\User;
use App\Repositories\User\UserRepositoryInterface;
use Illuminate\Hashing\HashManager;
use App\Services\TokenManager;
use App\Exceptions\InvalidCredentialsException;
use App\Values\CompositionToken;

class AuthenticationService
{
    private UserRepositoryInterface $userRepository;

    private TokenManager $tokenManager;

    private HashManager $hash;

    public function __construct(
        UserRepositoryInterface $userRepository,
        TokenManager $tokenManager,
        HashManager $hash
    ) {
        $this->userRepository = $userRepository;
        $this->tokenManager = $tokenManager;
        $this->hash = $hash;
    }

    /**
     * login to admin page
     *
     * @param string $email
     * @param string $password
     * @return CompositionToken
     */
    public function login(string $email, string $password): CompositionToken
    {
        /**
         * @var User|null $user
         */
        $user = $this->userRepository->getFirstWhere('email', $email);
        if (!$user ||  !$this->hash->check($password, $user->password)) {
            throw new InvalidCredentialsException();
        }
        // needsReHash() will return false if and only if hashing algorithm has changed
        // So during the login process, 
        // you check if their stored password's algorithm differs from your current algorithm, 
        // and if so, you replace their stored password hash with a new one.
        if ($this->hash->needsRehash($user->password)) {
            $user->password = $this->hash->make($password);
            $user->save();
        }

        return $this->tokenManager->createCompositionToken($user);
    }

    /**
     * Undocumented function
     *
     * @param string $token
     * @return void
     */
    public function logout(string $token)
    {
        $this->tokenManager->deleteTokenByPlainTextToken($token);
    }
}
