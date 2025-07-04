<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\Product;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VendorDashboardController extends Controller
{
    public function index(){
        $CancelledOrders = OrderProduct::where('vendor_id', Auth::user()->id)->get();

        $toadyEarnings = Order::where('order_status', 'delivered')
        ->where('payment_status',1)
        ->whereDate('created_at', now()->toDateString())
        ->whereHas('orderProducts', function($query){
            $query->where('vendor_id', Auth::user()->id);
        })->sum('sub_total');
        
        $totalEarnings = Order::where('order_status', 'delivered')
        ->where('payment_status',1)
        ->whereHas('orderProducts', function($query){
            $query->where('vendor_id', Auth::user()->id);
        })->sum('sub_total');;
        $monthlyEarnings = Order::where('order_status', 'delivered')
    ->where('payment_status', 1)
    ->whereMonth('created_at', now()->month)
    ->whereYear('created_at', now()->year)
    ->whereHas('orderProducts', function ($query) {
        $query->where('vendor_id', Auth::user()->id);
    })
    ->sum('sub_total');
        $yearlyEarnings = Order::where('order_status', 'delivered')
    ->where('payment_status', 1)
    ->whereYear('created_at', now()->year)
    ->whereHas('orderProducts', function ($query) {
        $query->where('vendor_id', Auth::user()->id);
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

        $totalProducts = Product::where(['vendor_id' => Auth::user()->id, 'is_approved' => 1])->count();
        $totalReviews = Review::where(['status' => 1, 'vendor_id' => Auth::user()->id])->count();
        return view('vendor.dashboard',compact(
            'toadyEarnings',
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
            'totalReviews'
        ));
    }
}
