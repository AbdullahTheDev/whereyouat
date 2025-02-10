<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        $request->session()->regenerate();


        $route = 'home';

        if(Auth::user()->role == 'driver'){
            $route = 'driver.dashboard';
        }else if(Auth::user()->role == 'local_driver'){
            $route = 'local_driver.dashboard';
        }else if(Auth::user()->role == 'business'){
            $route = 'businesses.dashboard';
        }else if(Auth::user()->role == 'partner_home'){
            $route = 'partner_home.dashboard';
        }else if(Auth::user()->role == 'company'){
            $route = 'company.dashboard';
        }else if(Auth::user()->role == 'user'){
            $route = 'user.dashboard';
        }else if(Auth::user()->role == 'admin'){
            $route = 'admin.dashboard';
        }

        if($route != ''){
            return redirect()->route($route);
        }

        return redirect()->intended(redirect()->route($route));
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
