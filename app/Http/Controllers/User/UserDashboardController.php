<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Wishlist;
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




        $total_orders = Order::where('user_id', Auth::user()->id)->count();
        $pending_orders = Order::where('user_id', Auth::user()->id)
        ->where('order_status', '!=', 'delivered')
        ->where('order_status', '!=', 'cancelled')
        ->count();
        $complete_orders = Order::where(['user_id' => Auth::user()->id, 'order_status' => 'delivered'])->count();
        $wishlist_count = Wishlist::where('user_id', Auth::user()->id)->count();
        return view('user.dashboard', compact(
            'total_orders',
            'pending_orders',
            'complete_orders',
            'wishlist_count'
        ));
    }
}
