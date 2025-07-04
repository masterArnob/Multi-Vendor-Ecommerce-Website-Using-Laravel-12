<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Advertisement;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Newsletter;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\Product;
use App\Models\Review;
use App\Models\User;
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

        $CancelledOrders = OrderProduct::where('vendor_id', Auth::user()->id)->get();

        $todayEarnings = Order::where('order_status', 'delivered')
        ->where('payment_status',1)
        ->whereDate('created_at', now()->toDateString())
        ->whereHas('orderProducts', function($query){
            $query->where('vendor_id', 0);
        })->sum('sub_total');
        
        $totalEarnings = Order::where('order_status', 'delivered')
        ->where('payment_status',1)
        ->whereHas('orderProducts', function($query){
            $query->where('vendor_id', 0);
        })->sum('sub_total');;
        $monthlyEarnings = Order::where('order_status', 'delivered')
    ->where('payment_status', 1)
    ->whereMonth('created_at', now()->month)
    ->whereYear('created_at', now()->year)
    ->whereHas('orderProducts', function ($query) {
        $query->where('vendor_id', 0);
    })
    ->sum('sub_total');
        $yearlyEarnings = Order::where('order_status', 'delivered')
    ->where('payment_status', 1)
    ->whereYear('created_at', now()->year)
    ->whereHas('orderProducts', function ($query) {
        $query->where('vendor_id', 0);
    })
    ->sum('sub_total');;

        
        $todaysOrders = Order::whereIn('transaction_id', $CancelledOrders->pluck('transaction_id')->toArray())
                            ->whereDate('created_at', now()->toDateString())
                            ->count();;
 $todaysPendingOrders = Order::whereIn('transaction_id', $CancelledOrders->pluck('transaction_id')->toArray())
                            ->where('order_status', 'pending')
                            ->whereDate('created_at', now()->toDateString())
                            ->count();

        $totalOrders = Order::whereIn('transaction_id', $CancelledOrders->pluck('transaction_id')->toArray())
                             ->count();
        $totalPendingOrders = Order::whereIn('transaction_id', $CancelledOrders->pluck('transaction_id')->toArray())
                             ->where('order_status', 'pending')
                             ->count();
        $totalCompletedOrders = Order::whereIn('transaction_id', $CancelledOrders->pluck('transaction_id')->toArray())
                             ->where('order_status', 'delivered')
                             ->count();

$totalCancelledOrders = Order::whereIn('transaction_id', $CancelledOrders->pluck('transaction_id')->toArray())
                             ->where('order_status', 'canceled')
                             ->count();

        $totalProducts = Product::where(['admin_id' => 1, 'is_approved' => 1])->count();
        $totalReviews = Review::where(['status' => 1, 'vendor_id' => Auth::user()->id])->count();


        $totalBrands = Brand::count();
        $totalCategories = Category::count();
        $totalSubscribers = Newsletter::count();
        $totalVendors = User::where('role', 'vendor')->count();
        $totalUsers = User::where('role', 'user')->count();
        $totalAdmins = Admin::count();
        $totalVendorReq = User::where(['role' => 'user', 'vendor_request' => 1])->count();
        $ad_running = Advertisement::count();
        return view('admin.dashboard', compact(
               'todayEarnings',
            'totalEarnings',
            'monthlyEarnings',
            'yearlyEarnings',
            'todaysOrders',
            'todaysPendingOrders',
            'totalOrders',
            'totalPendingOrders',
            'totalCompletedOrders',
            'totalCancelledOrders',
            'totalProducts',
            'totalReviews',

            'totalBrands',
            'totalCategories',
            'totalSubscribers',
            'totalVendors',
            'totalUsers',
            'totalAdmins',
            'totalVendorReq',
            'ad_running'
        ));
    }
}
