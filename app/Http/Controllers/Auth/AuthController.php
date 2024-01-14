<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class AuthController extends Controller
{
    public function redirect()
    {
        return Socialite::driver('google')->redirect();
    }

    public function callback()
    {
        $socialUser = Socialite::driver('google')->user();

        if ($user = User::query()
            ->where('email', $socialUser->getEmail())
            ->orWhere('google_id', $socialUser->getId())
            ->first()
        ) {
            Auth::login($user);

            return redirect()->route('app.index');
        }

        // create user
        $user = User::create([
            'name' => $socialUser->getName(),
            'email' => $socialUser->getEmail(),
            'google_id' => $socialUser->getId(),
            'password' => bcrypt(Str::random(32)),
        ]);

        Auth::login($user);

        return redirect()->route('app.index');
    }
}
