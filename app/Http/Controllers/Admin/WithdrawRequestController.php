<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\AdminWithdrawRequestDataTable;
use App\Http\Controllers\Controller;
use App\Models\Settings;
use App\Models\WithdrawRequest;
use Illuminate\Http\Request;

class WithdrawRequestController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(AdminWithdrawRequestDataTable $dataTable)
    {
        return $dataTable->render('admin.withdraw-requests.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $withdraw = WithdrawRequest::findOrFail($id);

        $settings = Settings::first();
        return view('admin.withdraw-requests.show', compact('withdraw', 'settings'));
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
        $request->validate([
            'status' => ['required', 'in:pending,decline,paid'],
        ], [
            'status.required' => 'The status field is required.',
        ]);

        // Fetch withdrawal request
        $withdraw = WithdrawRequest::findOrFail($id);

        // Update balance only if transitioning to 'paid'
        if ($request->status === 'paid' && $withdraw->status !== 'paid') {
            $count = WithdrawRequest::where('vendor_id', $withdraw->vendor_id)
                ->where('id', '<', $withdraw->id)
                ->count();
            if ($count > 0) {
                $previousBalance = WithdrawRequest::where('vendor_id', $withdraw->vendor_id)
                    ->where('id', '<', $withdraw->id)
                    ->orderBy('id', 'DESC')
                    ->first()->current_balance;
                $withdraw->current_balance = $previousBalance - ($withdraw->withdraw_amount + $withdraw->withdraw_charge);
            } else {
                $withdraw->current_balance = $withdraw->total_earnings - ($withdraw->withdraw_amount + $withdraw->withdraw_charge);
            }
        }

        // Update status
        $withdraw->status = $request->status;
        $withdraw->save();

        notyf()->success('Withdraw Request Status Updated Successfully');
        return to_route('admin.withdraw-request.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
