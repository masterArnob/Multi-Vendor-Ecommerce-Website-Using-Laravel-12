<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserDashboardController extends Controller
{
    public function index()
    {
        if (auth()->check() && auth()->user()->user_status === 'banned') {
            // Log out the user
            Auth::guard('web')->logout();

            // Invalidate the current session
            session()->invalidate();

            // Regenerate the CSRF token
            session()->regenerateToken();

            // Flash an error message
            notyf()->error('Your account is banned. Please contact support!');

            // Redirect to the homepage
            return redirect('/');
        }
        return view('user.dashboard');
    }
}
