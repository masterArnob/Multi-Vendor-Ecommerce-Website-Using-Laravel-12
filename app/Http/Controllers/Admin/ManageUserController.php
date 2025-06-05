<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\ManageUsersDataTable;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use File;
use Illuminate\Support\Facades\Auth;

class ManageUserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(ManageUsersDataTable $dataTable)
    {
          return $dataTable->render('admin.manage-user.index');
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
        $user = User::findOrFail($id);
        return view('admin.manage-user.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //dd($request->all());
        $user = User::findOrFail($id);
        $user->user_status = $request->user_status;
        $user->save();
         notyf()->success('User Status Updated Successfully!');
        return redirect()->route('admin.manage-user.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
                if (Auth::user()->id != 1) {
            abort(404);
        }
        $user = User::findOrFail($id);
        if(File::exists(public_path($user->image))){
            File::delete(public_path($user->image));
        }
        $user->delete();
         notyf()->success('User Deleted Successfully!');
        return response(['status' => 'success']);
    }
}
