<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\UsersDataTable;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use File;

class VendorRequestController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(UsersDataTable $dataTable)
    {
         return $dataTable->render('admin.vendor-request.index');
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
      
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
          $request = User::where(['id' => $id, 'role' => 'user', 'vendor_request' => 1])->first();
        return view('admin.vendor-request.edit', compact('request'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //dd($request->all());
        $user = User::findOrFail($id);
        $user->vendor_status = $request->vendor_status;
        if($request->vendor_status === 'approved'){
            $user->is_user = 0;
            $user->is_vendor = 1;
            $user->role = 'vendor';
        }
        $user->save();
        notyf()->success('Vendor Status Updated Successfully!');
        return redirect()->route('admin.vendor-request.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //dd($id);
        $request = User::findOrFail($id);
        if(File::exists(public_path($request->document))){
            File::delete(public_path($request->document));
        }
        $request->delete();
        notyf()->success('Vendor Request Deleted Successfully!');
        return response(['status' => 'success']);
    }
}
