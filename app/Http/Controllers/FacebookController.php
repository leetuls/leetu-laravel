<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Auth;
use Exception;
use App\Models\User;

class FacebookController extends Controller
{

    public function signInwithFacebook()
    {
        $response = Socialite::driver('facebook')->redirect();
        return response()->json($response->headers->all()['location'][0]);
    }

    public function callbackToFacebook()
    {
        try {

            $user = Socialite::driver('facebook')->user();

            $finduser = User::where('gauth_id', $user->id)->first();

            if ($finduser) {

                Auth::login($finduser);

                return redirect()->route('home');
            } else {
                $newUser = User::create([
                    'name' => $user->name,
                    'email' => $user->email,
                    'gauth_id' => $user->id,
                    'gauth_type' => 'facebook',
                    'password' => encrypt('admin@123')
                ]);

                Auth::login($newUser);

                return redirect()->route('home');
            }
        } catch (Exception $e) {
            dd($e->getMessage());
        }
    }
}
