<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\FooterSection;
use Illuminate\Http\Request;
use File;
class FooterSectionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $footer = FooterSection::first();
        return view('admin.manage-footer.index', compact('footer'));
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
     */public function update(Request $request, string $id)
{
    $request->validate([
        'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        'phone' => 'required|string|max:255',
        'email' => 'required|email|max:255',
        'address' => 'nullable|string|max:500',
    ]);

    $footer = FooterSection::first();

    // Prepare data for updateOrCreate
    $data = [
        'phone' => $request->phone,
        'email' => $request->email,
        'address' => $request->address,
         'copyright' => $request->copyright ? 'Copyright © ' . now()->year . ' ' . $request->copyright . ' shop. All Rights Reserved.' : 'Copyright © ' . now()->year . ' shop. All Rights Reserved.',
        'fb_link' => $request->fb_link,
        'twitter_link' => $request->twitter_link,
        'instagram_link' => $request->instagram_link,
        'youtube_link' => $request->youtube_link,
        'linkedin_link' => $request->linkedin_link,
        'tiktok_link' => $request->tiktok_link,
        'pinterest_link' => $request->pinterest_link,
        'whatsapp_link' => $request->whatsapp_link,
    ];

    // Handle logo upload
    if ($request->hasFile('logo')) {
        // Delete old logo if it exists
        if ($footer && File::exists(public_path($footer->logo))) {
            File::delete(public_path($footer->logo));
        }

        $file = $request->file('logo');
        $fileName = rand() . '.' . $file->getClientOriginalExtension();
        $path = '/uploads/' . $fileName;
        $file->move(public_path('uploads'), $fileName);
        $data['logo'] = $path; // Update logo in data array
    } elseif ($footer && $footer->logo) {
        // Preserve existing logo if no new logo is uploaded
        $data['logo'] = $footer->logo;
    }



    
    // Handle logo upload
    if ($request->hasFile('gateway_logo')) {
        // Delete old logo if it exists
        if ($footer && File::exists(public_path($footer->gateway_logo))) {
            File::delete(public_path($footer->gateway_logo));
        }

        $file = $request->file('gateway_logo');
        $fileName = rand() . '.' . $file->getClientOriginalExtension();
        $path = '/uploads/' . $fileName;
        $file->move(public_path('uploads'), $fileName);
        $data['gateway_logo'] = $path; // Update logo in data array
    } elseif ($footer && $footer->gateway_logo) {
        // Preserve existing logo if no new logo is uploaded
        $data['gateway_logo'] = $footer->gateway_logo;
    }

    

    // Update or create the record
    FooterSection::updateOrCreate(
        ['id' => 1],
        $data
    );

    notyf()->success('Footer Updated Successfully!');
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
