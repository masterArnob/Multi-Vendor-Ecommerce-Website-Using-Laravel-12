<?php

namespace App\Http\Controllers\Frontend;

use App\DataTables\UserReviewsDataTable;
use App\Http\Controllers\Controller;
use App\Models\Review;
use App\Models\ReviewGallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(UserReviewsDataTable $dataTable)
    {
         return $dataTable->render('user.review.index');
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
            'product_id' => ['required', 'numeric'],
            'vendor_id' => ['required', 'numeric'],
            'review' => ['required', 'string'],
            'rating' => ['required', 'numeric']
        ],[
            'rating.required' => 'Rating is required',
        ]
    );


    $admin_id = null; 
    if($request->vendor_id === 0){
        $admin_id = 0;
    }


        $review = new Review();
        $review->product_id = $request->product_id;
    $review->user_id = Auth::user()->id;
    $review->vendor_id = $request->vendor_id;
    $review->admin_id = $admin_id; // Assuming admin_id is not set for user
    $review->review = $request->review;
    $review->rating = $request->rating;
    $review->status = 0;
    $review->save();


     if ($request->hasFile('review_images')) {
        foreach ($request->file('review_images') as $file) {
            // Generate a unique filename
            $fileName = rand() . time() . '.' . $file->getClientOriginalExtension();
            $path = 'uploads/' . $fileName;

            // Move the file to the public/uploads directory
            $file->move(public_path('uploads'), $fileName);

            // Create a new gallery record
            $reviewImages = new ReviewGallery();
            $reviewImages->image = $path;
            $reviewImages->review_id = $review->id;
            $reviewImages->save();
        }
    }



    notyf()->success('Review Submitted Successfully!');
    return redirect()->back();

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
