<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\BrandDataTable;
use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Product;
use Illuminate\Http\Request;
use File;
use Illuminate\Support\Facades\Auth;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(BrandDataTable $dataTable)
    {
          return $dataTable->render('admin.brand.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.brand.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required'],
            'logo' => ['required', 'file']
        ]);

        $brand = new Brand();

            if ($request->hasFile('logo')) {

                if (File::exists(public_path($brand->logo))) {
                    File::delete(public_path($brand->logo));
                }

                $file = $request->logo;
                $fileName = rand() . '.' . $file->getClientOriginalExtension();
                $path = '/uploads/' . $fileName;
                $file->move(public_path('uploads'), $fileName);
                $brand->logo = $path;
                //dd($path);
            }


        $brand->name = $request->name;
        $brand->is_featured = $request->is_featured;
        $brand->status = $request->status;
        $brand->slug = \Str::slug($request->name);
        $brand->save();
         notyf()->success('Brand Created Successfully!');
        return redirect()->route('admin.brand.index');
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
        $brand = Brand::findOrFail($id);
        return view('admin.brand.edit', compact('brand'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
          $request->validate([
            'name' => ['required'],
        ]);

        $brand = Brand::findOrFail($id);

            if ($request->hasFile('logo')) {

                if (File::exists(public_path($brand->logo))) {
                    File::delete(public_path($brand->logo));
                }

                $file = $request->logo;
                $fileName = rand() . '.' . $file->getClientOriginalExtension();
                $path = '/uploads/' . $fileName;
                $file->move(public_path('uploads'), $fileName);
                $brand->logo = $path;
                //dd($path);
            }


        $brand->name = $request->name;
        $brand->is_featured = $request->is_featured;
        $brand->status = $request->status;
        $brand->slug = \Str::slug($request->name);
        $brand->save();
         notyf()->success('Brand Updated Successfully!');
        return redirect()->route('admin.brand.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if (Auth::user()->id != 1) {
            abort(404);
        }

        
          $brand = Brand::findOrFail($id);

          $product = Product::where('brand_id', $brand->id)->count();
          if($product > 0){
             notyf()->error('There are product under this brand. Please delete them first!');
               return response(['status' => 'error']);
          }

        if(File::exists(public_path($brand->logo))){
            File::delete(public_path($brand->logo));
        }
        $brand->delete();
         notyf()->success('Brand Deleted Successfully!');
        return response(['status' => 'success']);
    }
    
}
