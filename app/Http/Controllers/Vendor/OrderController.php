<?php

namespace App\Http\Controllers\Vendor;

use App\DataTables\VendorOrdersDataTable;
use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(VendorOrdersDataTable $dataTable)
    {
        if (Auth::user()->vendor_status !== 'approved') {
            abort(404);
        }
        return $dataTable->render('vendor.orders.index');
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
        if (Auth::user()->vendor_status !== 'approved') {
            abort(404);
        }
        $order = Order::with(['orderProducts'])->findOrFail($id);

        // Check if the order has at least one product belonging to the vendor
        $hasVendorProduct = $order->orderProducts->contains(function ($product) {
            return $product->vendor_id === Auth::user()->id;
        });

        if (!$hasVendorProduct) {
            abort(403, 'Unauthorized: You do not have access to this order');
        }
        return view('vendor.orders.show', compact('order'));
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


    public function changeOrderStatus(Request $request)
    {
        // dd($request->all());
        $order = Order::findOrFail($request->order_id);
        $order->order_status = $request->order_status;
        $order->save();
        return response(['status' => 'success', 'message' => 'Order Status Updated Successfully!']);
    }
}
