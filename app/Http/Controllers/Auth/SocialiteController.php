<?php

namespace App\Http\Controllers\Auth;
use App\Http\Controllers\Controller;
use Auth;
use Socialite;

class SocialiteController extends Controller
{
    public function getSocialAuth($provider=null)
    {
        return Socialite::driver('facebook')->redirect();
    }


    public function getSocialAuthCallback($provider=null)
    {
        $user = Socialite::driver('facebook')->user();
        return redirect()->route('home');
    }
}
