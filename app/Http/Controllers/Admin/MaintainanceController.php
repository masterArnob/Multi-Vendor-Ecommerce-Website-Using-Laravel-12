<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Maintainance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;

class MaintainanceController extends Controller
{
    /**
     * Display the maintenance mode settings.
     */
    public function index()
    {
        $mode = Maintainance::first() ?? new Maintainance(['mode' => 'off']);
        return view('admin.maintainance.index', compact('mode'));
    }

    /**
     * Store or update the maintenance mode settings.
     */
    public function store(Request $request)
    {
        $request->validate([
            'mode' => ['required', 'in:on,off'],
            'secret_key' => ['required'],
        ], [
            'mode.required' => 'Maintenance mode is required.',
        ]);

        $mode = $request->mode;
        $secret_key = $request->secret_key;

             Maintainance::updateOrCreate(
            ['id' => 1],
            [
                'mode' => $mode,
                'secret_key' => $secret_key,
                'down_url' => $mode === 'on' ? url("/$secret_key") : null,
            ]
        );


       // dd($request->all());
  

        if ($mode === 'on') {
            Artisan::call('down', [
                '--secret' => $secret_key,
                 '--redirect' => '/'.$secret_key, // Use PUBLIC route here
            ]);
        } else {
            Artisan::call('up');
            $secret_key = null;
        }

   

        notyf()->success('Maintenance Info Updated Successfully');
        return redirect()->back();
    }
}