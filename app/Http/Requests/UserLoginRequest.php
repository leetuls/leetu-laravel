<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

/**
 * @property string $email
 * @property string $password
 */
class UserLoginRequest extends Request
{
    /** @return array<mixed> */
    public function rules(): array
    {
        return [
            'email' => 'required|email',
            'password' => 'required',
        ];
    }
}
