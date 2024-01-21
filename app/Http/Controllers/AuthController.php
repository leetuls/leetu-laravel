<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserLoginRequest;
use Illuminate\Http\Request;
use App\Exceptions\InvalidCredentialsException;
use App\Services\AuthenticationService;

class AuthController extends Controller
{
    private AuthenticationService $auth;

    /**
     * AuthController Contruct
     *
     * @param AuthenticationService $auth
     */
    public function __construct(AuthenticationService $auth)
    {
        $this->auth = $auth;
    }

    /**
     * Login method
     *
     * @param UserLoginRequest $request
     * @return void
     */
    public function login(UserLoginRequest $request)
    {
        try {
            return response()->json($this->auth->login((string)$request->email, (string)$request->password)->toArray());
        } catch (InvalidCredentialsException $error) {
            return response()->json(
                [
                    'error' => true,
                    'message' => $error->getMessage()
                ]
            );
        }
    }

    /**
     * logout and remove token
     *
     * @param Request $request
     * @return void
     */
    public function logout(Request $request)
    {
        $this->auth->logout($request->bearerToken());

        return response()->noContent();
    }
}
