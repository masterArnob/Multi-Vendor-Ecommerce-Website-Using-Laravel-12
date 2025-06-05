<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminDashboardController extends Controller
{
    public function index(){
        //dd(Auth::user());
         if (auth()->check() && auth()->user()->status === 'banned') {
            // Log out the user
            Auth::guard('admin')->logout();

            // Invalidate the current session
            session()->invalidate();

            // Regenerate the CSRF token
            session()->regenerateToken();

            // Flash an error message
            notyf()->error('Your account is banned. Please contact other admins!');

            // Redirect to the homepage
            return redirect('/');
        }
        return view('admin.dashboard');
    }
}
