<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use Exception;
use App\Models\User;

class GoogleController extends Controller
{
    public function signInwithGoogle()
    {
        $response = Socialite::driver('google')->redirect();
        return response()->json($response->headers->all()['location'][0]);
    }
    public function callbackToGoogle()
    {
        try {

            $user = Socialite::driver('google')->user();

            $finduser = User::where('gauth_id', $user->id)->first();

            if ($finduser) {

                Auth::login($finduser);

                return redirect()->route('home');
            } else {
                $newUser = User::create([
                    'name' => $user->name,
                    'email' => $user->email,
                    'gauth_id' => $user->id,
                    'gauth_type' => 'google',
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
