<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\CategoryDataTable;
use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(CategoryDataTable $dataTable)
    {
         return $dataTable->render('admin.category.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.category.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required'],
            'icon' => ['required']
        ]);

        $category = new Category();
        $category->name = $request->name;
        $category->icon = $request->icon;
        $category->slug = \Str::slug($request->name);
        $category->status = $request->status;
        $category->save();
         notyf()->success('Category Created Successfully!');
        return redirect()->route('admin.category.index');
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
        $cat = Category::findOrFail($id);
         return view('admin.category.edit', compact('cat'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
         $request->validate([
            'name' => ['required'],
            'icon' => ['required']
        ]);

        $category = Category::findOrFail($id);
        $category->name = $request->name;
        $category->icon = $request->icon;
        $category->slug = \Str::slug($request->name);
        $category->status = $request->status;
        $category->save();
         notyf()->success('Category Updated Successfully!');
        return redirect()->route('admin.category.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $cat = Category::findOrFail($id);
        $cat->delete();
        notyf()->success('Category Deleted Successfully!');
        return response(['status' => 'success']);
    }
}
