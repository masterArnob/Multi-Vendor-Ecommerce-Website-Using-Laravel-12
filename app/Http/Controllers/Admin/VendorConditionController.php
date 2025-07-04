<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\VendorCondition;
use Illuminate\Http\Request;

class VendorConditionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $condition = VendorCondition::where('key', 'vendor_conditions')->first();
        return view('admin.vendor-condition.index', compact('condition'));
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
        $request->validate([
            'content' => ['required']
        ]);

             $data = [
                [
                    'content' => $request->content,
                ]
            ];

            // Update or create the advertisement record
            VendorCondition::updateOrCreate(
                ['key' => 'vendor_conditions'],
                ['value' => json_encode($data)]
            );

            notyf()->success('Vendor Condition Updated Successfully!');
            return to_route('admin.vendor-condition.index');
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
