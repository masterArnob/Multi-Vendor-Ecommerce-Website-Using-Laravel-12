<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
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

        if ($request->user()->user_status === 'banned') {
            Auth::guard('web')->logout();
            $request->session()->regenerateToken();
            notyf()->error('Your account is banned. Please contact support!');
            return redirect('/');
        }

        if ($request->user()->vendor_status === 'banned') {
            Auth::guard('web')->logout();
            $request->session()->regenerateToken();
            notyf()->error('Vendor account is banned. Please contact support!');
            return redirect('/');
        }

        if ($request->user()->role === 'vendor') {
            return redirect()->intended(route('vendor.dashboard', absolute: false));
        } else if ($request->user()->role === 'user') {
            return redirect()->intended(route('user.dashboard', absolute: false));
        }
        return redirect()->intended(route('dashboard', absolute: false));
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
