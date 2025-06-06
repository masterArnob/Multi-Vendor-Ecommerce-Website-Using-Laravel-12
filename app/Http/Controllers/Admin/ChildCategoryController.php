<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\ChildCategoryDataTable;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\ChildCategory;
use App\Models\SubCategory;
use Illuminate\Http\Request;

class ChildCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(ChildCategoryDataTable $dataTable)
    {
          return $dataTable->render('admin.child-category.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $cats = Category::where(['status' => '1'])->get();
        $subcats = SubCategory::where(['status' => '1'])->get();
        return view('admin.child-category.create', compact('cats', 'subcats'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
          $request->validate([
            'category_id' => ['required'],
            'name' => ['required'],
            'sub_category_id' => ['required']
        ]);

        $childcat = new ChildCategory();
        $childcat->name = $request->name;
        $childcat->slug = \Str::slug($request->name);
        $childcat->status = $request->status;
        $childcat->category_id = $request->category_id;
        $childcat->sub_category_id = $request->sub_category_id;
        $childcat->save();
          notyf()->success('Child Category Created Successfully!');
        return redirect()->route('admin.child-category.index');
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
        $cats = Category::where(['status' => '1'])->get();
        $subcats = SubCategory::where(['status' => '1'])->get();
        $childCat = ChildCategory::findOrFail($id);
        return view('admin.child-category.edit', compact('cats', 'subcats', 'childCat'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
          $request->validate([
            'category_id' => ['required'],
            'name' => ['required'],
            'sub_category_id' => ['required']
        ]);

        $childcat = ChildCategory::findOrFail($id);
        $childcat->name = $request->name;
        $childcat->slug = \Str::slug($request->name);
        $childcat->status = $request->status;
        $childcat->category_id = $request->category_id;
        $childcat->sub_category_id = $request->sub_category_id;
        $childcat->save();
          notyf()->success('Child Category Updated Successfully!');
        return redirect()->route('admin.child-category.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $childCat = ChildCategory::findOrFail($id);
        $childCat->delete();
        notyf()->success('Child Category Deleted Successfully!');
        return response(['status' => 'success']);
    }
}
