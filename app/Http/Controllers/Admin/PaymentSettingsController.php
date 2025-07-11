<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PaymentSettings;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;

class PaymentSettingsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.settings.payment-settngs');
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

        if ($request->payment_method === 'paypal') {
            //dd($request->all());
            $validatedData = $request->validate([
                'paypal_mode' => ['required', 'in:sandbox,live'],
                'paypal_currency' => ['required'],
                'paypal_rate' => ['required', 'numeric'],
                'paypal_client_id' => ['required'],
                'paypal_client_secret' => ['required'],
                'paypal_app_id' => ['required']
            ]);

            foreach ($validatedData as $key => $value) {
                PaymentSettings::updateOrCreate(
                    ['key' => $key],
                    ['value' => $value]
                );
            }

            Artisan::call('config:clear');
            notyf()->success('Paypal Settings Updated Successfully!');
            return redirect()->back();
        } else if ($request->payment_method === 'stripe') {
            //dd($request->all());
            $validatedData = $request->validate([
                'stripe_status' => ['required'],
                'stripe_currency' => ['required'],
                'stripe_rate' => ['required', 'numeric'],
                'stripe_publish_key' => ['required'],
                'stripe_client_secret' => ['required'],
            ]);

              foreach ($validatedData as $key => $value) {
                PaymentSettings::updateOrCreate(
                    ['key' => $key],
                    ['value' => $value]
                );
            }

            Artisan::call('config:clear');
            notyf()->success('Stripe Settings Updated Successfully!');
            return redirect()->back();
        }else if($request->payment_method === 'ssl'){
            //dd($request->all());
            $validatedData = $request->validate([
                'ssl_mode' => ['nullable'],
                'ssl_status' => ['required', 'in:active,inactive'],
                'ssl_currency' => ['required'],
                'ssl_store_id' => ['required'],
                'store_pass' => ['required']
            ]);

          

              foreach ($validatedData as $key => $value) {
                PaymentSettings::updateOrCreate(
                    ['key' => $key],
                    ['value' => $value]
                );
            }

            Artisan::call('config:clear');
            notyf()->success('SslCommerz Settings Updated Successfully!');
            return redirect()->back();
        }


    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
