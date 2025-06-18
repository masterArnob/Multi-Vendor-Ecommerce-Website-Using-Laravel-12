<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\AdminShippingRuleDataTable;
use App\Http\Controllers\Controller;
use App\Models\ShippingRule;
use Illuminate\Http\Request;

class ShippingRuleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(AdminShippingRuleDataTable $dataTable)
    {
          return $dataTable->render('admin.shipping-rule.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.shipping-rule.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //dd($request->all());
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'type' => ['required'],
            'cost' => ['required', 'numeric'],
            'status' => ['required', 'boolean'],
        ]);

        $rule = new ShippingRule();
        $rule->name = $request->name;
        $rule->type = $request->type;
        $rule->min_cost = $request->min_cost;
        $rule->cost = $request->cost;
        $rule->status = $request->status;
        $rule->save();
        notyf()->success('Shipping Rules Created Successfully!');
        return redirect()->route('admin.shipping-rule.index');
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
        $rule = ShippingRule::findOrFail($id);
          return view('admin.shipping-rule.edit', compact('rule'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
           $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'type' => ['required'],
            'cost' => ['required', 'numeric'],
            'status' => ['required', 'boolean'],
        ]);

        $rule = ShippingRule::findOrFail($id);
        $rule->name = $request->name;
        $rule->type = $request->type;
        $rule->min_cost = $request->min_cost;
        $rule->cost = $request->cost;
        $rule->status = $request->status;
        $rule->save();
        notyf()->success('Shipping Rules Updated Successfully!');
        return redirect()->route('admin.shipping-rule.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $rule = ShippingRule::findOrFail($id);
        $rule->delete();
        notyf()->success('Shipping Rule Deleted Successfully!');
         return response(['status' => 'success']);
    }
}
