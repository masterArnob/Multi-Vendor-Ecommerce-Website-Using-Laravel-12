<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\ApprovedVendorDataTable;
use App\Helper\MailHelper;
use App\Http\Controllers\Controller;
use App\Mail\VendorStatus;
use App\Models\User;
use Illuminate\Http\Request;
use File;
use Illuminate\Support\Facades\Auth;

class ApprovedVendorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(ApprovedVendorDataTable $dataTable)
    {
          return $dataTable->render('admin.approved-vendors.index');
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
         $request = User::findOrFail($id);
        // dd($request->all());
        return view('admin.approved-vendors.edit', compact('request'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //dd($request->all());
         $user = User::findOrFail($id);
        //$user->vendor_status = $request->vendor_status;
       if($request->vendor_status === 'approved'){
            $user->is_user = 0;
            $user->is_vendor = 1;
            $user->role = 'vendor';
            $user->vendor_status = 'approved';
            $user->user_status = 'is_vendor';
        }else if($request->vendor_status === 'pending'){
            $user->is_user = 1;
            $user->is_vendor = 0;
            $user->role = 'user';
             $user->vendor_status = 'pending';
            $user->user_status = 'active';
        }else if($request->vendor_status === 'banned'){
            $user->is_user = 1;
            $user->is_vendor = 0;
            $user->role = 'user';
            $user->user_status = 'banned';
             $user->vendor_status = 'banned';
        }else if($request->vendor_status === 'rejected'){
            $user->is_user = 1;
            $user->is_vendor = 0;
            $user->role = 'user';
             $user->vendor_status = 'rejected';
            $user->user_status = 'active';
        }
        $user->save();

            // Set mail configuration
    MailHelper::setMailConfig();


    // Send mail
    \Mail::to($user->email)->send(new VendorStatus($user));


        
        notyf()->success('Vendor Status Updated Successfully!');
        return redirect()->route('admin.approved-vendors.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if (Auth::user()->id != 1) {
            abort(404);
        }
          $request = User::findOrFail($id);
        if(File::exists(public_path($request->document))){
            File::delete(public_path($request->document));
        }
        $request->delete();
        notyf()->success('Vendor Deleted Successfully!');
        return response(['status' => 'success']);
    }
}
