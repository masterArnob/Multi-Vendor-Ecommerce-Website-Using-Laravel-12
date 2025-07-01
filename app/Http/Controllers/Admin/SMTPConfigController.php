<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SMTPConfig;
use Illuminate\Http\Request;

class SMTPConfigController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $smtpConfig = SMTPConfig::first();
        return view('admin.smtp-settings.index', compact('smtpConfig'));
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
        $request->validate([
            'email' => ['required', 'email'],
            'host' => ['required'],
            'username' => ['required'],
            'password' => ['required'],
            'port' => ['required', 'numeric'],
            'encryption' => ['required']
        ],
        [
            'encryption.required' => 'The encryption field is required.',
        ]
    );


    SMTPConfig::updateOrCreate(
            ['id' => $id],
            [
                'email' => $request->email,
                'host' => $request->host,
                'username' => $request->username,
                'password' => $request->password,
                'port' => $request->port,
                'encryption' => $request->encryption
            ]
        );

        notyf()->success('SMTP settings updated successfully!');
        return redirect()->back();


    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
