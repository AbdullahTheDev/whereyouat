<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Verified;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class VerifyEmailController extends Controller
{
    /**
     * Mark the authenticated user's email address as verified.
     */
    public function __invoke(EmailVerificationRequest $request): RedirectResponse
    {
        if ($request->user()->hasVerifiedEmail()) {
            $route = 'home';

            if (Auth::user()->role == 'driver') {
                $route = 'driver.dashboard';
            } else if (Auth::user()->role == 'local_driver') {
                $route = 'local_driver.dashboard';
            } else if (Auth::user()->role == 'business') {
                $route = 'businesses.dashboard';
            } else if (Auth::user()->role == 'partner_home') {
                $route = 'partner_home.dashboard';
            } else if (Auth::user()->role == 'company') {
                $route = 'company.dashboard';
            } else if (Auth::user()->role == 'user') {
                $route = 'user.dashboard';
            } else if (Auth::user()->role == 'admin') {
                $route = 'admin.dashboard';
            }

            if ($route != '') {
                return redirect()->route($route);
            }
            return redirect()->intended(route($route) . '?verified=1');

            // return redirect()->intended(RouteServiceProvider::HOME . '?verified=1');
        }

        if ($request->user()->markEmailAsVerified()) {
            event(new Verified($request->user()));
        }

        return redirect()->intended(RouteServiceProvider::HOME . '?verified=1');
    }
}
