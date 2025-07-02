<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\SubscribersDataTable;
use App\Helper\MailHelper;
use App\Http\Controllers\Controller;
use App\Mail\Subscribers;
use App\Models\Newsletter;
use Illuminate\Http\Request;

class AdminNewsLetterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(SubscribersDataTable $dataTable)
    {
        return $dataTable->render('admin.subscribes.index');
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
        //dd($request->all());
        $request->validate([
            'subject' => ['required'],
            'message' => ['required'],
        ]);

        // Set mail configuration
    MailHelper::setMailConfig();

    $mails = Newsletter::all()->pluck('email')->toArray();

    $subject = $request->subject;
    $messageContent = $request->message;
    // Send mail
    \Mail::to($mails)->send(new Subscribers($subject, $messageContent));

    notyf()->success('Newsletter sent successfully!');
    return redirect()->route('admin.subscribes.index');

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
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $subscriber = Newsletter::findOrFail($id);
        $subscriber->delete();

        notyf()->success('Subscriber deleted successfully!');
        return response(['status' => 'success']);
    }
}
