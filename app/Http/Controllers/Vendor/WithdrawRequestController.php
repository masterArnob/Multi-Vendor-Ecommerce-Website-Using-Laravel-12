<?php

namespace App\Http\Controllers\Vendor;

use App\DataTables\VendorWithdrawRequestDataTable;
use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Settings;
use App\Models\WithdrawMethod;
use App\Models\WithdrawRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WithdrawRequestController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(VendorWithdrawRequestDataTable $dataTable)
    {
        return $dataTable->render('vendor.withdraw-request.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $withdraw = WithdrawMethod::all();

        // Calculate total earnings
        $totalEarnings = Order::where('order_status', 'delivered')
            ->where('payment_status', 1)
            ->whereHas('orderProducts', function ($query) {
                $query->where('vendor_id', Auth::user()->id);
            })->sum('sub_total');

        // Get current balance from the latest 'paid' withdrawal or use total earnings
        $currentBalance = null;
        $paidRequest = WithdrawRequest::where('vendor_id', Auth::user()->id)
            ->where('status', 'paid')
            ->orderBy('id', 'DESC')
            ->first();

        if ($paidRequest) {
            $currentBalance = $paidRequest->current_balance;
        } else {
            $currentBalance = $totalEarnings;
        }

        return view('vendor.withdraw-request.create', compact('withdraw', 'totalEarnings', 'currentBalance'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate request
        $request->validate([
            'method' => ['required', 'exists:withdraw_methods,name'],
            'total_earnings' => ['required', 'numeric', 'min:0'],
            'withdraw_amount' => ['required', 'numeric', 'min:0'],
            'account_info' => ['required'],
        ], [
            'method.required' => 'Please select a withdraw method',
            'withdraw_amount.min' => 'Withdrawal amount cannot be negative',
        ]);

        // Fetch withdrawal method and settings
        $method = WithdrawMethod::where('name', $request->method)->firstOrFail();
        $settings = Settings::first();

        if (!$settings) {
            notyf()->error('Withdrawal configuration not found');
            return redirect()->back();
        }

        // Check withdrawal amount limits
        if ($request->withdraw_amount < $method->minimum_amount || $request->withdraw_amount > $method->maximum_amount) {
            notyf()->error('Withdrawal amount must be between ' . $method->minimum_amount . $settings->currency_icon . ' and ' . $method->maximum_amount . $settings->currency_icon);
            return redirect()->back();
        }

        // Check if withdrawal amount exceeds available balance
        $count = WithdrawRequest::where('vendor_id', Auth::user()->id)
            ->where('status', 'paid')
            ->count();
        if ($count > 0) {
            $previousBalance = WithdrawRequest::where('vendor_id', Auth::user()->id)
                ->where('status', 'paid')
                ->orderBy('id', 'DESC')
                ->first()->current_balance;
            $withdrawCharge = number_format(($method->withdraw_charge / 100) * $request->withdraw_amount, 2);
            if ($request->withdraw_amount + $withdrawCharge > $previousBalance) {
                notyf()->error('Withdrawal amount cannot exceed current balance');
                return redirect()->back();
            }
        } else {
            if ($request->withdraw_amount > $request->total_earnings) {
                notyf()->error('Withdrawal amount cannot exceed total earnings');
                return redirect()->back();
            }
        }

        // Calculate withdrawal charge and net amount
        $withdrawCharge = number_format(($method->withdraw_charge / 100) * $request->withdraw_amount, 2);
        $withdrawAmount = $request->withdraw_amount - $withdrawCharge;

        // Create withdrawal request (do not set current_balance)
        $withdrawReq = new WithdrawRequest();
        $withdrawReq->vendor_id = Auth::user()->id;
        $withdrawReq->method = $request->method;
        $withdrawReq->total_earnings = $request->total_earnings;
        $withdrawReq->withdraw_amount = $withdrawAmount;
        $withdrawReq->withdraw_charge = $withdrawCharge;
        $withdrawReq->account_info = $request->account_info;
        $withdrawReq->status = 'pending';
        $withdrawReq->save();

        notyf()->success('Withdraw Request Created Successfully');
        return to_route('vendor.withdraw-request.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $withdraw = WithdrawRequest::findOrFail($id);
        if ($withdraw->vendor_id !== Auth::user()->id) {
            abort(404);
        }

        $settings = Settings::first();
        return view('vendor.withdraw-request.show', compact('withdraw', 'settings'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}