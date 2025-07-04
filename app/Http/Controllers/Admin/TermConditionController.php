<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TermCondition;
use Illuminate\Http\Request;

class TermConditionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $content = TermCondition::where('key', 'content')->first();
        return view('admin.term-page.index', compact('content'));
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
           $request->validate([
            'content' => ['required']
        ]);

             $data = [
                [
                    'content' => $request->content,
                ]
            ];

            // Update or create the advertisement record
            TermCondition::updateOrCreate(
                ['key' => 'content'],
                ['value' => json_encode($data)]
            );

            notyf()->success('Term Page Updated Successfully!');
            return to_route('admin.term-page.index');
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
