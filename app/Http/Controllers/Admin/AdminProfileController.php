<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use File;

class AdminProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.profile.index');
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //dd($request->all());
        if ($request->update_type === 'profile_update') {

            $request->validate([
                'name' => ['required'],
                'email' => ['required', 'email']
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
            $admin->save();
            notyf()->success('Profile Updated Successfully!');
            return redirect()->back();
        } elseif ($request->update_type === 'password_update') {
            # code...
            //dd($request->all());
            $request->validate([
                'current_password' => ['required', 'current_password'],
                'password' => ['required', 'confirmed'],
            ]);


            //dd($request->password);

            $request->user()->update([
                'password' => bcrypt($request->password),
            ]);
            notyf()->success('Profile Updated Successfully!');
            return redirect()->back();
        }

        abort(404);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
