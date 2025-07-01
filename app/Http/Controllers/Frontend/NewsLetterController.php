<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Newsletter;
use Illuminate\Http\Request;

class NewsLetterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
       // dd($request->all());
       $request->validate([
        'email' => ['required', 'email'],
       ]);

       $check = Newsletter::where('email', $request->email)->count();
       if($check > 0){
        notyf()->error('This email is already subscribed to our newsletter!');
        return response(['status' => 'error', 'message' => 'This email is already subscribed to our newsletter!']);
       }
       $news = new Newsletter();
       $news->email = $request->email;
       $news->save();
       return response(['status' => 'success', 'message' => 'You have successfully subscribed to our newsletter!']);
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
        //
    }
}
