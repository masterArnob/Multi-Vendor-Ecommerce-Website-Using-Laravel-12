<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\SliderDataTable;
use App\Http\Controllers\Controller;
use App\Models\Slider;
use Illuminate\Http\Request;
use File;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

class SliderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(SliderDataTable $dataTable)
    {
         return $dataTable->render('admin.slider.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.slider.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
             'title' => ['required'],
            'type' => ['required'],
            'starting_price' => ['required'],
            'btn_url' => ['required', 'url'],
            'serial' => ['required', 'numeric'],
            'status' => ['required', 'boolean']
        ]);

        $slider = new Slider();

           if ($request->hasFile('banner')) {

                if (File::exists(public_path($slider->banner))) {
                    File::delete(public_path($slider->banner));
                }

                $file = $request->banner;
                $fileName = rand() . '.' . $file->getClientOriginalExtension();
                $path = '/uploads/' . $fileName;
                $file->move(public_path('uploads'), $fileName);
                $slider->banner = $path;
                //dd($path);
            }


        $slider->title = $request->title;
        $slider->type = $request->type;
        $slider->starting_price = $request->starting_price;
        $slider->btn_url = $request->btn_url;
        $slider->serial = $request->serial;
        $slider->created_by = Auth::user()->id;
        $slider->status = $request->status;
        $slider->save();

        Cache::forget('sliders');

         notyf()->success('Slider Created Successfully!');
        return redirect()->route('admin.slider.index');
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
        $slider = Slider::findOrFail($id);
        return view('admin.slider.edit', compact('slider'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
            $request->validate([
             'title' => ['required'],
            'type' => ['required'],
            'starting_price' => ['required'],
            'btn_url' => ['required', 'url'],
            'serial' => ['required', 'numeric'],
            'status' => ['required', 'boolean']
        ]);

        $slider = Slider::findOrFail($id);

           if ($request->hasFile('banner')) {

                if (File::exists(public_path($slider->banner))) {
                    File::delete(public_path($slider->banner));
                }

                $file = $request->banner;
                $fileName = rand() . '.' . $file->getClientOriginalExtension();
                $path = '/uploads/' . $fileName;
                $file->move(public_path('uploads'), $fileName);
                $slider->banner = $path;
                //dd($path);
            }


        $slider->title = $request->title;
        $slider->type = $request->type;
        $slider->starting_price = $request->starting_price;
        $slider->btn_url = $request->btn_url;
        $slider->serial = $request->serial;
        $slider->status = $request->status;
        $slider->save();
         notyf()->success('Slider Updated Successfully!');
        return redirect()->route('admin.slider.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
                if (Auth::user()->id != 1) {
            abort(404);
        }
          $slider = Slider::findOrFail($id);
        if(File::exists(public_path($slider->banner))){
            File::delete(public_path($slider->banner));
        }
        $slider->delete();
         notyf()->success('Slider Deleted Successfully!');
        return response(['status' => 'success']);
    }
}
