<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\AdminProductDataTable;
use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\ChildCategory;
use App\Models\Product;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use File;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(AdminProductDataTable $dataTable)
    {
        return $dataTable->render('admin.product.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $brands = Brand::where('status', 1)->get();
        $categories = Category::where('status', 1)->get();
        return view('admin.product.create', compact('brands', 'categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required'],
            'thumb_image' => ['required'],
            'category_id' => ['required'],
            'brand_id' => ['required'],
            'qty' => ['required'],
            'short_description' => ['required'],
            'long_description' => ['required'],
            'price' => ['required', 'numeric'],
            'product_type' => ['required'],
        ]);

        $product = new Product();

        if ($request->hasFile('thumb_image')) {

            if (File::exists(public_path($product->thumb_image))) {
                File::delete(public_path($product->thumb_image));
            }

            $file = $request->thumb_image;
            $fileName = rand() . '.' . $file->getClientOriginalExtension();
            $path = '/uploads/' . $fileName;
            $file->move(public_path('uploads'), $fileName);
            $product->thumb_image = $path;
            //dd($path);
        }



        $product->name = $request->name;
        $product->slug = \Str::slug($request->name);
        $product->vendor_id = 0;
        $product->admin_id = Auth::user()->id;
        $product->category_id = $request->category_id;
        $product->sub_category_id = $request->sub_category_id;
        $product->child_category_id = $request->child_category_id;
        $product->brand_id = $request->brand_id;
        $product->qty = $request->qty;
        $product->short_description = $request->short_description;
        $product->long_description = $request->long_description;
        $product->video_link = $request->video_link;
        $product->sku = $request->sku;
        $product->price = $request->price;
        $product->offer_price = $request->offer_price;
        $product->offer_start_date = $request->offer_start_date;
        $product->offer_end_date = $request->offer_end_date;
        $product->product_type = $request->product_type;
        $product->status = $request->status;
        $product->is_approved = 1;
        $product->seo_title = $request->seo_title;
        $product->seo_description = $request->seo_description;
        $product->save();
        notyf()->success('Product Created Successfully!');
        return redirect()->route('admin.product.index');
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

        $brands = Brand::where('status', 1)->get();
        $categories = Category::where('status', 1)->get();
        $product = Product::findOrFail($id);
        $subCategories = SubCategory::where(['status' => 1, 'category_id' => $product->category_id])->get();
        $childCategories = ChildCategory::where(['status' => 1, 'sub_category_id' => $product->sub_category_id])->get();

        return view('admin.product.edit', compact('product', 'categories', 'brands', 'subCategories', 'childCategories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => ['required'],
            'category_id' => ['required'],
            'brand_id' => ['required'],
            'qty' => ['required'],
            'short_description' => ['required'],
            'long_description' => ['required'],
            'price' => ['required', 'numeric'],
            'product_type' => ['required'],
        ]);

        $product = Product::findOrFail($id);

        if ($request->hasFile('thumb_image')) {

            $request->validate([
                'thumb_image' => ['required'],
            ]);
            if (File::exists(public_path($product->thumb_image))) {
                File::delete(public_path($product->thumb_image));
            }

            $file = $request->thumb_image;
            $fileName = rand() . '.' . $file->getClientOriginalExtension();
            $path = '/uploads/' . $fileName;
            $file->move(public_path('uploads'), $fileName);
            $product->thumb_image = $path;
            //dd($path);
        }



        $product->name = $request->name;
        $product->slug = \Str::slug($request->name);
        $product->vendor_id = 0;
        $product->admin_id = Auth::user()->id;
        $product->category_id = $request->category_id;
        $product->sub_category_id = $request->sub_category_id;
        $product->child_category_id = $request->child_category_id;
        $product->brand_id = $request->brand_id;
        $product->qty = $request->qty;
        $product->short_description = $request->short_description;
        $product->long_description = $request->long_description;
        $product->video_link = $request->video_link;
        $product->sku = $request->sku;
        $product->price = $request->price;
        $product->offer_price = $request->offer_price;
        $product->offer_start_date = $request->offer_start_date;
        $product->offer_end_date = $request->offer_end_date;
        $product->product_type = $request->product_type;
        $product->status = $request->status;
        $product->is_approved = 1;
        $product->seo_title = $request->seo_title;
        $product->seo_description = $request->seo_description;
        $product->save();
        notyf()->success('Product Updated Successfully!');
        return redirect()->route('admin.product.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if (Auth::user()->id != 1) {
            abort(404);
        }
        $product = Product::findOrFail($id);
        if (File::exists(public_path($product->thumb_image))) {
            File::delete(public_path($product->thumb_image));
        }
        $product->delete();
        notyf()->success('Product Deleted Successfully!');
        return response(['status' => 'success']);
    }


    public function getSubCategories(Request $request)
    {
        //dd($request->all());
        $subCategories = SubCategory::where(['category_id' => $request->category_id, 'status' => '1'])->get();
        return response(['status' => 'success', 'subCategories' => $subCategories]);
    }


    public function getChildCategories(Request $request)
    {
        //dd($request->all());
        $childCategories = ChildCategory::where(['sub_category_id' => $request->sub_category_id, 'status' => '1'])->get();
        return response(['status' => 'success', 'childCategories' => $childCategories]);
    }
}
