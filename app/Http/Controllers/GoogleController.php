<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class GoogleController extends Controller
{
    public function redirect()
    {
        return Socialite::driver('google')->redirect();
    }

    public function callback()
    {
        $googleUser = Socialite::driver('google')->user();

        $user = User::updateOrCreate(
            ['email' => $googleUser->getEmail()],
            [
                'name' => $googleUser->getName(),
                'provider' => 'google',
                'provider_id' => $googleUser->getId(),
                'password' => bcrypt(str()->random(16)),
                'role' => 'applicant',
            ]
        );

        Auth::login($user);

        if ($user->isAdmin()) {
            return redirect()->route('admin.dashboard');
        }

       return redirect()->route('dashboard')->with('success', 'Welcome back!');
    }
}