<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\SetPasswordRequest;
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

        if ($user->otp == true) {
            return $this->loadSetPassword();
        }

        return redirect()->intended(RouteServiceProvider::HOME);
    }

    /**
     * Display the login view.
     *
     * @return \Inertia\Response
     */
    public function loadSetPassword()
    {
        return Inertia::render('Auth/OTPForm');
    }

    /**
     * Handle an incoming authentication request.
     *
     * @param  \App\Http\Requests\SetPasswordRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function setPassword(SetPasswordRequest $request)
    {
        $this->setNewPassword();

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
