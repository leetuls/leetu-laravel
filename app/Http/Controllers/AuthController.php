<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserLoginRequest;
use Illuminate\Http\Request;
use App\Exceptions\InvalidCredentialsException;
use App\Services\AuthenticationService;

class AuthController extends Controller
{
    private AuthenticationService $auth;

    public function __construct(AuthenticationService $auth)
    {
        $this->auth = $auth;
    }

    public function login(UserLoginRequest $request)
    {
        try {
            return response()->json($this->auth->login((string)$request->email, (string)$request->password)->toArray());
        } catch (InvalidCredentialsException) {
            return response()->json(
                [
                    'error' => true,
                    'message' => 'Invalid credentials'
                ]
            );
        }
    }
}
