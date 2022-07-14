<?php

namespace App\Traits;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;
use Illuminate\Validation\ValidationException;

trait AuthenticatedSession
{
    /**
     * Attempt to authenticate the request's credentials.
     *
     * @return void
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function authenticate()
    {
        if (! Auth::guard($this->guard())->attempt(Request::only($this->username(), 'password'))) {
            throw ValidationException::withMessages([
                'email' => 'Invalid Data Given',
            ]);
        }

        Request::session()->regenerate();
    }

    /**
     * Get the authentication guard.
     *
     * @return string
     */
    public function guard()
    {
        if (isset($this->guard) && $this->guard) {
            return $this->guard;
        }

        return config('auth.defaults.guard');
    }

    /**
     * Get the login username to be used by the controller.
     *
     * @return string
     */
    public function username()
    {
        return 'email';
    }

    /**
     * Attempt to authenticate the request's credentials.
     *
     * @return void
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function setNewPassword()
    {
        Auth::user()->update([
            'password' => bcrypt(Request::get('password')),
            'otp' => false,
            'verified_at' => now(),
        ]);
    }

    /**
     * Logout authenticated user
     *
     * @return void
     */
    public function logout()
    {
        Auth::guard($this->guard())->logout();

        Request::session()->invalidate();

        Request::session()->regenerateToken();
    }
}
