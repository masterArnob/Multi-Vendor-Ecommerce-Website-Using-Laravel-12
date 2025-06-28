<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\TopCategorySection;
use Illuminate\Http\Request;

class TopCategorySectionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::where('status', 1)->get();
        $topCat = TopCategorySection::first();
        return view('admin.top-category.index', compact('categories', 'topCat'));
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // dd($request->all());
        $request->validate(
            [
                'cat_one' => ['required'],
                'cat_two' => ['required'],
                'cat_three' => ['required'],
                'cat_four' => ['required'],
            ],
            [
                'cat_one.required' => 'Category one is required',
                'cat_two.required' => 'Category Two is required',
                'cat_three.required' => 'Category Three is required',
                'cat_four.required' => 'Category Four is required',
            ]
        );

        $data = [
            [
                'category' => $request->cat_one,
                'sub_category' => $request->sub_cat_one,
                'child_category' => $request->child_cat_one
            ],
             [
                'category' => $request->cat_two,
                'sub_category' => $request->sub_cat_two,
                'child_category' => $request->child_cat_two
            ],
             [
                'category' => $request->cat_three,
                'sub_category' => $request->sub_cat_three,
                'child_category' => $request->child_cat_three
            ],
             [
                'category' => $request->cat_four,
                'sub_category' => $request->sub_cat_four,
                'child_category' => $request->child_cat_four
            ],
        ];

        //dd($data);
        TopCategorySection::updateOrCreate(
            ['key' => 'top_category_section'],
            ['value' => json_encode($data)]
        );

        notyf()->success('Top Category Section Updated Successfully!');
        return to_route('admin.top-category.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
