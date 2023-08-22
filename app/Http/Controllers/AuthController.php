<?php

namespace App\Http\Controllers;

use App\Events\UserRegisterEvent;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\ProcessResetPasswordRequest;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\VerifyEmailRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

class AuthController extends Controller
{
    public $route;
    public function __construct() {
        $this->route =  explode('.', request()->route()->getName())[0];
    }

    public function login(): View
    {
        if($this->route == 'admin') {
            return view('auth.admin.login');
        }
        return view('auth.user.login');
    }

    public function logout(): RedirectResponse
    {
        Auth::logout();
        if($this->route == 'admin') {
            return redirect()->route('admin.login')->with('success', 'Log out successfully!');
        }

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

            if($this->route == 'admin') {
                return redirect()
                    ->route('admin.index')
                    ->with('success', 'Login successful');
            }
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

    public function verifyEmail(VerifyEmailRequest $request): RedirectResponse
    {
        User::where(['remember_token' => $request->get('token')])->update([
            'email_verified' => 1,
        ]);

        if($this->route == 'admin') {
            return redirect()->route('admin.index')->with('success', trans('Verify Email Successfully !!!'));
        }

        return redirect()->route('index')->with('success', trans('Verify Email Successfully !!!'));
    }
}
