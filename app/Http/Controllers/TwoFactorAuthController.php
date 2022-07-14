<?php

namespace App\Http\Controllers;

use App\Http\Requests\TwoFactorVerificationRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Validation\ValidationException;
use Inertia\Inertia;

class TwoFactorAuthController extends Controller
{
    /**
     * Display the two factor auth view.
     *
     * @return \Inertia\Response
     */
    public function create()
    {
        return Inertia::render('Auth/TwoFactorVerification');
    }

    /**
     * Check two factor auth code.
     *
     * @param  \App\Http\Requests\TwoFactorVerificationRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(TwoFactorVerificationRequest $request)
    {
        if (auth()->user()?->two_factor_secret != $request->code) {
            throw ValidationException::withMessages([
                'code' => 'Invalid Two Factor Authentication Code',
            ]);
        }

        session()->put('user_2fa', auth()->user()->id);

        auth()->user()->update([
            'two_factor_confirmed_at' => now(),
        ]);

        return redirect()->intended(RouteServiceProvider::HOME);
    }
}
