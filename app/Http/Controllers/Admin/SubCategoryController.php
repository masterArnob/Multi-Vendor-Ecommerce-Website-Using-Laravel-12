<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\SubCategoryDataTable;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Http\Request;

class SubCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(SubCategoryDataTable $dataTable)
    {
         return $dataTable->render('admin.sub-category.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $cats = Category::where('status', '1')->get();
        return view('admin.sub-category.create', compact('cats'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'category_id' => ['required'],
            'name' => ['required']
        ]);

        $subcat = new SubCategory();
        $subcat->name = $request->name;
        $subcat->slug = \Str::slug($request->name);
        $subcat->status = $request->status;
        $subcat->category_id = $request->category_id;
        $subcat->save();
          notyf()->success('Sub Category Created Successfully!');
        return redirect()->route('admin.sub-category.index');
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
    
        $cats = Category::where('status', '1')->get();
       
          $subcat = SubCategory::findOrFail($id);
         return view('admin.sub-category.edit', compact('subcat', 'cats'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
          $request->validate([
            'category_id' => ['required'],
            'name' => ['required']
        ]);

        $subcat = SubCategory::findOrFail($id);
        $subcat->name = $request->name;
        $subcat->slug = \Str::slug($request->name);
        $subcat->status = $request->status;
        $subcat->category_id = $request->category_id;
        $subcat->save();
          notyf()->success('Sub Category Updated Successfully!');
        return redirect()->route('admin.sub-category.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
         $subcat = SubCategory::findOrFail($id);
        $subcat->delete();
        notyf()->success('Sub Category Deleted Successfully!');
        return response(['status' => 'success']);
    }
}
