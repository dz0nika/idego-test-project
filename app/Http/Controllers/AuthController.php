<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use App\Traits\AuthenticatedSession;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Validation\ValidationException;
use Inertia\Inertia;

class AuthController extends Controller
{
    use AuthenticatedSession;

    /**
     * Display the login view.
     *
     * @return \Inertia\Response
     */
    public function create()
    {
        return Inertia::render('Auth/Login', [
            'canResetPassword' => Route::has('password.request'),
            'status' => session('status'),
        ]);
    }

    /**
     * Handle an incoming authentication request.
     *
     * @param  \App\Http\Requests\LoginRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(LoginRequest $request)
    {
        $user = User::whereEmail($request->email)->first();

        if (! $user) {
            throw ValidationException::withMessages([
                'email' => 'Invalid Email',
            ]);
        }

        if (! password_verify($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'password' => 'Invalid Password',
            ]);
        }

        $this->authenticate();

        if ($user->two_factor_enabled) {
            $user->generateTwoFactorAuthCode();

            return redirect()->route('2fa');
        }

        return redirect()->intended(RouteServiceProvider::HOME);
    }

    /**
     * Destroy an authenticated session.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Request $request)
    {
        $this->logout();

        return redirect('/');
    }
}
