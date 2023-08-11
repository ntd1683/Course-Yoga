<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Laravel\Socialite\Contracts\User as ProviderUser;
use App\Models\SocialAccount;

class SocialAccountService
{
    public static function createOrGetUser(ProviderUser $providerUser, $social)
    {
        try {
            $account = SocialAccount::query()
                ->where('provider', $social)
                ->where('provider_user_id', $providerUser->getId())
                ->first();

            if ($account) {
                return $account->user;
            } else {
                $email = $providerUser->getEmail() ?? $providerUser->getNickname();

                if ($email == null) {
                    return false;
                }

                $account = new SocialAccount([
                    'provider_user_id' => $providerUser->getId(),
                    'provider' => $social,
                ]);

                $user = User::whereEmail($email)->first();

                if (! $user) {
                    $user = User::create([
                        'email' => $email,
                        'name' => $providerUser->getName(),
                        'password' => Hash::make('12345678'),
                        'email_verified' => 1,
                        'level' => '0',
                    ]);
                }

                Mail::send('email.create-user', compact('user'), function ($email) use ($user) {
                    $email->subject(option('site_name') . trans(' - invitation to join'));
                    $email->to($user->email, $user->name);
                });

                $account->user()->associate($user);
                $account->save();

                return $user;
            }
        } catch (\Exception $e) {
            return redirect()->route('login')->withErrors(trans('Error Unknown'));
        }
    }
}
