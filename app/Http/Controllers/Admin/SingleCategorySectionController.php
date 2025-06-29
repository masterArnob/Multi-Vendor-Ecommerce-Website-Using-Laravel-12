<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\SingleCategorySection;
use Illuminate\Http\Request;

class SingleCategorySectionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::where('status', 1)->get();
        $singleCatOne = SingleCategorySection::first();
        $singleCatTwo = SingleCategorySection::where('id', 2)->first();
        $singleCatThree = SingleCategorySection::where('id', 3)->first();
        //dd($singleCatTwo);
        return view('admin.single-category.index', compact('categories', 'singleCatOne', 'singleCatTwo', 'singleCatThree'));
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
        //dd($request->all());
        switch ($request->single_cat_value) {
            case 1:
                $request->validate(
                    [
                        'cat_one' => ['required'],
                    ],
                    [
                        'cat_one.required' => 'Category one is required',
                    ]
                );

                $data = [
                    [
                        'category' => $request->cat_one,
                        'sub_category' => $request->sub_cat_one,
                        'child_category' => $request->child_cat_one
                    ],
                ];

                // dd($data);
                SingleCategorySection::updateOrCreate(
                    ['key' => 'single_category_section_one'],
                    ['value' => json_encode($data)]
                );

                notyf()->success('Single Category Section One Updated Successfully!');
                return to_route('admin.single-category.index');
            case 2:
                $request->validate(
                    [
                        'cat_one' => ['required'],
                    ],
                    [
                        'cat_one.required' => 'Category one is required',
                    ]
                );

                $data = [
                    [
                        'category' => $request->cat_one,
                        'sub_category' => $request->sub_cat_one,
                        'child_category' => $request->child_cat_one
                    ],
                ];

                // dd($data);
                SingleCategorySection::updateOrCreate(
                    ['key' => 'single_category_section_two'],
                    ['value' => json_encode($data)]
                );

                notyf()->success('Single Category Section Two Updated Successfully!');
                return to_route('admin.single-category.index');

            case 3:
                //dd('yes  case 3');
                   $request->validate(
                    [
                        'cat_one' => ['required'],
                        'cat_two' => ['required'],
                    ],
                    [
                        'cat_one.required' => 'Category one is required',
                        'cat_two.required' => 'Category one is required',
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
                ];

                // dd($data);
                SingleCategorySection::updateOrCreate(
                    ['key' => 'single_category_section_three'],
                    ['value' => json_encode($data)]
                );

                notyf()->success('Single Category Section Three Updated Successfully!');
                return to_route('admin.single-category.index');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
