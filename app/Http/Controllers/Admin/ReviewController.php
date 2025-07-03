<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\AdminReviewsDataTable;
use App\Http\Controllers\Controller;
use App\Models\Review;
use Illuminate\Http\Request;
use File;
class ReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(AdminReviewsDataTable $dataTable)
    {
           return $dataTable->render('admin.review.index');
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
        $review = Review::findOrFail($id);
        return view('admin.review.edit', compact('review'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'status' => ['required'],
        ],
        [
            'status.required' => 'Status is required',
        ]
    );



    $review = Review::findOrFail($id);
    $review->status = $request->status;
    $review->save();
    notyf()->success('Review status updated successfully!');
    return to_route('admin.review.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        
        $review = Review::findOrFail($id);
        foreach($review->reviewImages as $image){
            if(File::exists(public_path($image->image))){
                File::delete(public_path($image->image));
            }
            $image->delete();
        }

 
        $review->delete();
         notyf()->success('Review Deleted Successfully!');
        return response(['status' => 'success']);
    }
}
