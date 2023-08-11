<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Services\SocialAccountService;
use Laravel\Socialite\Facades\Socialite;
use Laravel\Socialite\Two\InvalidStateException;

class SocialAuthController extends Controller
{

    public function redirect($social)
    {
        return Socialite::driver($social)->redirect();
    }

    public function callback($social)
    {
        try {
            try {
                $socialite = Socialite::driver($social)->user();
            } catch (InvalidStateException $e) {
                $socialite = Socialite::driver($social)->stateless()->user();
            }

            $user = SocialAccountService::createOrGetUser($socialite, $social);

            if ($user) {
                auth()->login($user, true);

                return redirect()->route('index')->with('success', trans('Login Successfully'));
            }

            return redirect()->route('login')->withErrors(trans('Error Unknown'));
        } catch (\Exception $e) {
            return redirect()->route('login')->withErrors(trans('Error Unknown'));
        }
    }
}
