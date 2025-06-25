<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\AdminAllOrdersDataTable;
use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;


class AllOrdersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(AdminAllOrdersDataTable $dataTable)
    {
          return $dataTable->render('admin.orders.all-orders.index');
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
        $order = Order::findOrFail($id);
        return view('admin.orders.all-orders.show', compact('order'));
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


    public function changeOrderStatus(Request $request){
        // dd($request->all());
        $order = Order::findOrFail($request->order_id);
        $order->order_status = $request->order_status;
        $order->save();
        return response(['status' => 'success', 'message' => 'Order Status Updated Successfully!']);
    }

}
