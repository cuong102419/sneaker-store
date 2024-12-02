<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use Exception;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class LoginGoogleController extends Controller
{
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        try {
            $user = Socialite::driver('google')->user();
            $finduser = User::where('google_id', $user->id)->first();

            if ($finduser) {
                Auth::login($finduser);

                return redirect()->intended('/')->with('success-auth', 'Đăng nhập thành công.');
            } else {
                $newUser = User::updateOrCreate(['email' => $user->email], [
                    'fullname' => $user->name,
                    'google_id' => $user->id,
                    'password' => encrypt('123456789')
                ]);
                Auth::login($newUser);

                return redirect()->intended('/')->with('success-auth', 'Đăng nhập thành công.');
            }
        } catch (Exception $e) {
            dd($e->getMessage());
        }

    }
}
