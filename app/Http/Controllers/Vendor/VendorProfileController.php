<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use File;
class VendorProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
         return view('vendor.profile.index');
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
                'email' => ['required', 'email'],
                'contact' => ['required', 'numeric'],
                'address' => ['required'],
                'desc' => ['required'],
            ]);
            $user = User::findOrFail($id);
            if ($request->hasFile('image')) {

                if (File::exists(public_path($user->image))) {
                    File::delete(public_path($user->image));
                }

                $file = $request->image;
                $fileName = rand() . '.' . $file->getClientOriginalExtension();
                $path = '/uploads/' . $fileName;
                $file->move(public_path('uploads'), $fileName);
                $user->image = $path;
                //dd($path);
            }




             if ($request->hasFile('banner')) {

                if (File::exists(public_path($user->banner))) {
                    File::delete(public_path($user->banner));
                }

                $file = $request->banner;
                $fileName = rand() . '.' . $file->getClientOriginalExtension();
                $path = '/uploads/' . $fileName;
                $file->move(public_path('uploads'), $fileName);
                $user->banner = $path;
                //dd($path);
            }

            $user->name = $request->name;
            $user->email = $request->email;
            $user->contact = $request->contact;
            $user->desc = $request->desc;
            $user->address = $request->address;
            $user->fb_link = $request->fb_link;
            $user->tw_link = $request->tw_link;
            $user->insta_link = $request->insta_link;
            $user->tiktok_link = $request->tiktok_link;
            $user->yt_link = $request->yt_link;
 


            $user->save();
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
            notyf()->success('Password Updated Successfully!');
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
