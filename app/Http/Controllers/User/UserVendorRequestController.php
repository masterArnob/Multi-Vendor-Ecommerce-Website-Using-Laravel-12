<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use File;
use Illuminate\Support\Facades\Auth;

class UserVendorRequestController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        if (Auth::user()->vendor_request === 1) {
            abort(404);
        }
        return view('user.vendor-request.index');
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
        if (Auth::user()->vendor_request === 1) {
            abort(404);
        }
        //dd($request->all());
        $request->validate([
            'document' => ['required', 'file', 'mimes:pdf,doc,docx,jpg,png', 'max:2048'],
            'contact' => ['required', 'integer']
        ]);

        $path = null;

        // dd($id);
        $user = User::findOrFail($id);


        if (($request->hasFile('document'))) {

            if (File::exists($user->document)) {
                File::delete($user->document);
            }

            $file = $request->document;
            $fileName = time() . '_' . $file->getClientOriginalName();
            $path = "/uploads/vendor/{$user->name}/documents/" . $fileName;
            $file->move(public_path("uploads/vendor/{$user->name}documents"), $fileName);
        }

        //dd($path);

        $user->contact = $request->contact;
        $user->document = $path;
        $user->vendor_request = 1;
        $user->vendor_status = 'pending';
        $user->save();
        return redirect()->route('user.dashboard.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
