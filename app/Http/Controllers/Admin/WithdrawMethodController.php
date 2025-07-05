<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\AdminWithdrawMethodDataTable;
use App\Http\Controllers\Controller;
use App\Models\WithdrawMethod;
use Illuminate\Http\Request;

class WithdrawMethodController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(AdminWithdrawMethodDataTable $dataTable)
    {
         return $dataTable->render('admin.withdraw-method.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.withdraw-method.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required'],
            'minimum_amount' => ['required', 'numeric'],
            'maximum_amount' => ['required', 'numeric'],
            'withdraw_charge' => ['required', 'numeric'],
            'description' => ['required'],
        ]);

        $withdraw = new WithdrawMethod();
        $withdraw->name = $request->name;
        $withdraw->minimum_amount = $request->minimum_amount;
        $withdraw->maximum_amount = $request->maximum_amount;
        $withdraw->withdraw_charge = $request->withdraw_charge;
        $withdraw->description = $request->description;
        $withdraw->save();
        notyf()->success('Withdraw Method Created Successfully');
        return to_route('admin.withdraw-method.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $withdraw = WithdrawMethod::findOrFail($id);
         return view('admin.withdraw-method.edit', compact('withdraw'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
          $request->validate([
            'name' => ['required'],
            'minimum_amount' => ['required', 'numeric'],
            'maximum_amount' => ['required', 'numeric'],
            'withdraw_charge' => ['required', 'numeric'],
            'description' => ['required'],
        ]);

        $withdraw = WithdrawMethod::findOrFail($id);;
        $withdraw->name = $request->name;
        $withdraw->minimum_amount = $request->minimum_amount;
        $withdraw->maximum_amount = $request->maximum_amount;
        $withdraw->withdraw_charge = $request->withdraw_charge;
        $withdraw->description = $request->description;
        $withdraw->save();
        notyf()->success('Withdraw Method Updated Successfully');
        return to_route('admin.withdraw-method.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $withdraw = WithdrawMethod::findOrFail($id);
        $withdraw->delete();
         notyf()->success('Method Deleted Successfully!');
        return response(['status' => 'success']);
    }
}
