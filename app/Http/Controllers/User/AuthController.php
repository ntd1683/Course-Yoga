<?php

namespace App\Http\Controllers\User;

use App\Events\UserRegisterEvent;
use App\Http\Controllers\Controller;
use App\Http\Requests\ForgotPasswordRequest;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\ProcessResetPasswordRequest;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\ResetPasswordRequest;
use App\Http\Requests\VerifyEmailRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Illuminate\View\View;

class AuthController extends Controller
{
    public function login(): View
    {
        return view('auth.user.login');
    }

    public function logout(): RedirectResponse
    {
        Auth::logout();
        return redirect()->route('login')->with('success', 'Log out successfully!');
    }

    public function processLogin(LoginRequest $request): RedirectResponse
    {
        $remember = $request->has('remember');

        $arr = $request->validated();

        if (Auth::attempt($arr, $remember)) {
            $user = User::query()
                ->where('email', $request->get('email'))
                ->firstOrFail();
            Auth::login($user, $remember);

            return redirect()
                ->route('index')
                ->with('success', 'Login successful');
        }

        return redirect()
            ->back()
            ->with('error', 'Email or password incorrect');
    }

    public function register(): View
    {
        return view('auth.user.register');
    }

    public function processRegister(RegisterRequest $request): RedirectResponse
    {
        $user = User::create([
            ...$request->validated(),
            'password' => Hash::make($request->input('password')),
            'level' => '0',
        ]);

        Auth::login($user, true);

        UserRegisterEvent::dispatch($user);

        return redirect()->route('index')
            ->with('success', 'Create new user successfully!');
    }
}
