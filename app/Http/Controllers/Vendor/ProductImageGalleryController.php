<?php

namespace App\Http\Controllers\Vendor;

use App\DataTables\VendorProductImageGalleryDataTable;
use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductImageGallery;
use Illuminate\Http\Request;
use File;
use Illuminate\Support\Facades\Auth;

class ProductImageGalleryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(VendorProductImageGalleryDataTable $dataTable)
    {
        $product_id = request()->product_id;
        $product = Product::findOrFail($product_id);
        if($product->vendor_id != Auth::user()->id){
            abort(404);
        }
        return $dataTable->render('vendor.product.image-gallery.index', compact('product'));
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
        'image.*' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
    ]);



    $product_id = request()->product_id;

    if ($request->hasFile('image')) {
        foreach ($request->file('image') as $file) {
            // Generate a unique filename
            $fileName = rand() . time() . '.' . $file->getClientOriginalExtension();
            $path = 'uploads/' . $fileName;

            // Move the file to the public/uploads directory
            $file->move(public_path('uploads'), $fileName);

            // Create a new gallery record
            $gallery = new ProductImageGallery();
            $gallery->image = $path;
            $gallery->product_id = $product_id;
            $gallery->admin_id = 0;
            $gallery->vendor_id = Auth::user()->id;
            $gallery->save();
        }
    }
    notyf()->success('Images uploaded successfully!');

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


        $gallery = ProductImageGallery::findOrFail($id);

        if (File::exists(public_path($gallery->image))) {
            File::delete(public_path($gallery->image));
        }
        $gallery->delete();
        notyf()->success('Gallery Image Deleted Successfully!');
        return response(['status' => 'success']);
    }
}
