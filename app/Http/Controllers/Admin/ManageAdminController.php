<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\ManageAdminsDataTable;
use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use File;

class ManageAdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(ManageAdminsDataTable $dataTable)
    {
        return $dataTable->render('admin.manage-admin.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.manage-admin.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        //dd($request->all());
        $request->validate([
            'name' => ['required'],
            'email' => ['required', 'email'],
            'password' => ['required'],
            'contact' => ['required'],
            'address' => ['required'],
        ]);

        $admin = new Admin();


        if ($request->hasFile('image')) {

            if (File::exists(public_path($admin->image))) {
                File::delete(public_path($admin->image));
            }

            $file = $request->image;
            $fileName = rand() . '.' . $file->getClientOriginalExtension();
            $path = '/uploads/' . $fileName;
            $file->move(public_path('uploads'), $fileName);
            $admin->image = $path;
            //dd($path);
        }


        $admin->name = $request->name;
        $admin->email = $request->email;
        $admin->password = bcrypt($request->password);
        $admin->contact = $request->contact;
        $admin->address = $request->address;
        $admin->status = 'approved';
        $admin->created_by = Auth::user()->id;
        $admin->save();
        notyf()->success('Admin Created Successfully!');
        return redirect()->route('admin.manage-admin.index');
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

        if($id == 1){
            abort(404);
        }
        $admin = Admin::findOrFail($id);
        return view('admin.manage-admin.edit', compact('admin'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        if($id == 1){
            abort(404);
        }


        $request->validate([
            'name' => ['required'],
            'email' => ['required', 'email'],
            'contact' => ['required'],
            'address' => ['required'],
        ]);

        $admin = Admin::findOrFail($id);


        if ($request->hasFile('image')) {

            if (File::exists(public_path($admin->image))) {
                File::delete(public_path($admin->image));
            }

            $file = $request->image;
            $fileName = rand() . '.' . $file->getClientOriginalExtension();
            $path = '/uploads/' . $fileName;
            $file->move(public_path('uploads'), $fileName);
            $admin->image = $path;
            //dd($path);
        }


        $admin->name = $request->name;
        $admin->email = $request->email;
        if (!empty($request->password)) {
            $admin->update([
                'password' => bcrypt($request->password),
            ]);
        }
        $admin->contact = $request->contact;
        $admin->address = $request->address;
        if (Auth::user()->id == '1') {
            $admin->status = $request->status;
        }
        $admin->save();
        notyf()->success('Admin Updated Successfully!');
        return redirect()->route('admin.manage-admin.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if (Auth::user()->id != 1) {
            abort(404);
        }
        $admin = Admin::findOrFail($id);
        if (File::exists(public_path($admin->image))) {
            File::delete(public_path($admin->image));
        }
        $admin->delete();
        notyf()->success('Admin Deleted Successfully!');
        return response(['status' => 'success']);
    }
}
