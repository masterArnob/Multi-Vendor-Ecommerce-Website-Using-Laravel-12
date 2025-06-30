<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WishlistController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $wishes = Wishlist::where('user_id', Auth::user()->id)
        ->orderBy('id', 'DESC')
        ->get();

        return view('frontend.pages.wishlist', compact('wishes'));
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
            'id' => ['required'],
        ]);
        $count = Wishlist::where(['product_id' => $request->id, 'user_id' => Auth::user()->id])->count();
        if($count > 0){
           notyf()->error('Product already exists in your wishlist!');
           return response(['status' => 'error']);
        }
        $wish = new Wishlist();
        $wish->product_id = $request->id;
        $wish->user_id = Auth::user()->id;
        $wish->save();
        return response(['status' => 'success', 'message' => 'Product added to wishlist successfully!']);
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

    public function wishCount(){
        $count = Wishlist::where('user_id', Auth::user()->id)->count();
        //dd($count);
        return response(['status' => 'success', 'count' => $count]);
    }


    public function wishRemoveProduct(Request $request){
       // dd($request->all());
        $wish = Wishlist::where(['product_id' => $request->product_id, 'user_id' => Auth::user()->id])->first();
        $wish->delete();
        notyf()->success('Product removed from wishlist successfully!');
        return redirect()->back();
    }
}
