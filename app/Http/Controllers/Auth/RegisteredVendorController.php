<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\VendorCondition;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredVendorController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        $conditions = json_decode(VendorCondition::where('key', 'vendor_conditions')->first()->value);
        return view('auth.vendor-register', compact('conditions'));
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
           'document' => ['required', 'file', 'mimes:pdf,doc,docx,jpg,png', 'max:2048'],
           'contact' => ['required', 'numeric']
        ]);

        $path = null;

        if(($request->hasFile('document'))){
            $file = $request->document;
            $fileName = time().'_'.$file->getClientOriginalName();
             $path = "/uploads/vendor/" . str_replace(' ', '_', $request->name) . "/documents/" . $fileName;
            $file->move(public_path("uploads/vendor/" . str_replace(' ', '_', $request->name) . "/documents"), $fileName);
        }

        //dd($path);
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'user',
            'contact' => $request->contact,
            'document' => $path,

            'is_user' => '1',
            'user_status' => 'active',
            'is_vendor' => '0',
            'vendor_status' => 'pending',
            'vendor_request' => '1'
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect(route('user.dashboard', absolute: false));
    }
}
