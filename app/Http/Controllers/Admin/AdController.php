<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Advertisement;
use Illuminate\Http\Request;
use File;

class AdController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $ad_one = Advertisement::where('key', 'home_page_banner_one')->first();
        $ad_two = Advertisement::where('key', 'home_page_banner_two')->first();
        $ad_three = Advertisement::where('key', 'home_page_banner_three')->first();
        $ad_four = Advertisement::where('key', 'home_page_banner_four')->first();
        $ad_five = Advertisement::where('key', 'home_page_banner_five')->first();
        $ad_six = Advertisement::where('key', 'home_page_banner_six')->first();
        $ad_seven = Advertisement::where('key', 'home_page_banner_seven')->first();
        return view('admin.advertisement.index', compact(
            'ad_one',
            'ad_two',
            'ad_three',
            'ad_four',
            'ad_five',
            'ad_six',
            'ad_seven',
        ));
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
        if ($request->home_page_banner_one === 'home_page_banner_one') {
            $request->validate([
                'banner_url' => ['required', 'url'],
                'occassion' => ['required'],
                'offer' => ['required', 'numeric'],
                'status' => ['required'],
            ], [
                'status.required' => 'Please select a status',
            ]);

            if ($request->hasFile('banner')) {
                $request->validate([
                    'banner' => ['required', 'image', 'mimes:jpg,jpeg,png,gif,webp'],
                ]);
                $existingAd = Advertisement::where('key', 'home_page_banner_one')->first();
                if ($existingAd) {
                    $existingData = json_decode($existingAd->value, true);
                    if (!empty($existingData[0]['banner']) && File::exists(public_path($existingData[0]['banner']))) {
                        File::delete(public_path($existingData[0]['banner']));
                    }
                }

                // Handle the new banner image upload
                $file = $request->file('banner');
                $fileName = rand() . '.' . $file->getClientOriginalExtension();
                $path = '/uploads/' . $fileName;
                $file->move(public_path('uploads'), $fileName);
            } else {
                // If no new banner is uploaded, keep the existing one
                $existingAd = Advertisement::where('key', 'home_page_banner_one')->first();
                if ($existingAd) {
                    $existingData = json_decode($existingAd->value, true);
                    $path = $existingData[0]['banner'];
                }
            }





            // Prepare the data to be stored
            $data = [
                [
                    'banner' => $path,
                    'banner_url' => $request->banner_url,
                    'status' => $request->status,
                    'occassion' => $request->occassion,
                    'offer' => $request->offer,
                ]
            ];

            // Update or create the advertisement record
            Advertisement::updateOrCreate(
                ['key' => 'home_page_banner_one'],
                ['value' => json_encode($data)]
            );

            notyf()->success('Advertisement One Updated Successfully!');
            return to_route('admin.ad.index');
        } else if ($request->home_page_banner_two === 'home_page_banner_two') {
            $request->validate([
                'banner_one_url' => ['required', 'url'],
                'occassion_one' => ['required'],
                'offer_one' => ['required', 'numeric'],
                'status' => ['required'],
                'banner_two_url' => ['required', 'url'],
                'occassion_two' => ['required'],
                'offer_two' => ['required'],
            ], [
                'status.required' => 'Please select a status',
            ]);

            $path_one = '';
            $path_two = '';

            $existingAd = Advertisement::where('key', 'home_page_banner_two')->first();

            // Initialize default values for paths
            if ($existingAd) {
                $existingData = json_decode($existingAd->value, true);
                $path_one = $existingData[0]['banner_one'] ?? '';
                $path_two = $existingData[1]['banner_two'] ?? '';
            }

            // Handle banner_one upload
            if ($request->hasFile('banner_one')) {
                $request->validate([
                    'banner_one' => ['required', 'image', 'mimes:jpg,jpeg,png,gif,webp'],
                ]);

                if ($existingAd && !empty($existingData[0]['banner_one']) && File::exists(public_path($existingData[0]['banner_one']))) {
                    File::delete(public_path($existingData[0]['banner_one']));
                }

                $file = $request->file('banner_one');
                $fileName = rand() . '.' . $file->getClientOriginalExtension();
                $path_one = '/uploads/' . $fileName;
                $file->move(public_path('uploads'), $fileName);
            }

            // Handle banner_two upload
            if ($request->hasFile('banner_two')) {
                $request->validate([
                    'banner_two' => ['required', 'image', 'mimes:jpg,jpeg,png,gif,webp'],
                ]);

                if ($existingAd && !empty($existingData[1]['banner_two']) && File::exists(public_path($existingData[1]['banner_two']))) {
                    File::delete(public_path($existingData[1]['banner_two']));
                }

                $file = $request->file('banner_two');
                $fileName = rand() . '.' . $file->getClientOriginalExtension();
                $path_two = '/uploads/' . $fileName;
                $file->move(public_path('uploads'), $fileName);
            }

            $data = [
                [
                    'banner_one' => $path_one,
                    'banner_one_url' => $request->banner_one_url,
                    'status' => $request->status,
                    'occassion_one' => $request->occassion_one,
                    'offer_one' => $request->offer_one,
                ],
                [
                    'banner_two' => $path_two,
                    'banner_two_url' => $request->banner_two_url,
                    'status' => $request->status,
                    'occassion_two' => $request->occassion_two,
                    'offer_two' => $request->offer_two,
                ]
            ];

            // Update or create the advertisement record
            Advertisement::updateOrCreate(
                ['key' => 'home_page_banner_two'],
                ['value' => json_encode($data)]
            );

            notyf()->success('Advertisement Two Updated Successfully!');
            return to_route('admin.ad.index');
        } else if ($request->home_page_banner_three == 'home_page_banner_three') {
         
               $request->validate([
                'banner_one_url' => ['required', 'url'],
                'occassion_one' => ['required'],
                'offer_one' => ['required', 'numeric'],
                'status' => ['required'],
                'banner_two_url' => ['required', 'url'],
                'occassion_two' => ['required'],
                'offer_two' => ['required'],
                'banner_three_url' => ['required', 'url'],
                'occassion_three' => ['required'],
                'offer_three' => ['required'],
            ], [
                'status.required' => 'Please select a status',
            ]);
           // dd($request->all());

            $path_one = '';
            $path_two = '';
            $path_three = '';

            $existingAd = Advertisement::where('key', 'home_page_banner_three')->first();

            // Initialize default values for paths
            if ($existingAd) {
                $existingData = json_decode($existingAd->value, true);
                $path_one = $existingData[0]['banner_one'] ?? '';
                $path_two = $existingData[1]['banner_two'] ?? '';
                $path_three = $existingData[2]['banner_three'] ?? '';
            }

            // Handle banner_one upload
            if ($request->hasFile('banner_one')) {
                $request->validate([
                    'banner_one' => ['required', 'image', 'mimes:jpg,jpeg,png,gif,webp'],
                ]);

                if ($existingAd && !empty($existingData[0]['banner_one']) && File::exists(public_path($existingData[0]['banner_one']))) {
                    File::delete(public_path($existingData[0]['banner_one']));
                }

                $file = $request->file('banner_one');
                $fileName = rand() . '.' . $file->getClientOriginalExtension();
                $path_one = '/uploads/' . $fileName;
                $file->move(public_path('uploads'), $fileName);
            }

            // Handle banner_two upload
            if ($request->hasFile('banner_two')) {
                $request->validate([
                    'banner_two' => ['required', 'image', 'mimes:jpg,jpeg,png,gif,webp'],
                ]);

                if ($existingAd && !empty($existingData[1]['banner_two']) && File::exists(public_path($existingData[1]['banner_two']))) {
                    File::delete(public_path($existingData[1]['banner_two']));
                }

                $file = $request->file('banner_two');
                $fileName = rand() . '.' . $file->getClientOriginalExtension();
                $path_two = '/uploads/' . $fileName;
                $file->move(public_path('uploads'), $fileName);
            }

            // Handle banner_three upload
            if ($request->hasFile('banner_three')) {
                $request->validate([
                    'banner_three' => ['required', 'image', 'mimes:jpg,jpeg,png,gif,webp'],
                ]);

                if ($existingAd && !empty($existingData[2]['banner_three']) && File::exists(public_path($existingData[2]['banner_three']))) {
                    File::delete(public_path($existingData[2]['banner_three']));
                }

                $file = $request->file('banner_three');
                $fileName = rand() . '.' . $file->getClientOriginalExtension();
                $path_three = '/uploads/' . $fileName; // Fixed: Use $path_three
                $file->move(public_path('uploads'), $fileName);
            }

            $data = [
                [
                    'banner_one' => $path_one,
                    'banner_one_url' => $request->banner_one_url,
                    'status' => $request->status,
                    'occassion_one' => $request->occassion_one,
                    'offer_one' => $request->offer_one,
                ],
                [
                    'banner_two' => $path_two,
                    'banner_two_url' => $request->banner_two_url,
                    'status' => $request->status,
                    'occassion_two' => $request->occassion_two,
                    'offer_two' => $request->offer_two,
                ],
                [
                    'banner_three' => $path_three,
                    'banner_three_url' => $request->banner_three_url,
                    'status' => $request->status,
                    'occassion_three' => $request->occassion_three,
                    'offer_three' => $request->offer_three,
                ]
            ];

            // Update or create the advertisement record
            Advertisement::updateOrCreate(
                ['key' => 'home_page_banner_three'],
                ['value' => json_encode($data)]
            );

            notyf()->success('Advertisement Updated Successfully!');
            return to_route('admin.ad.index');
        }else if($request->home_page_banner_four == 'home_page_banner_four'){
             $request->validate([
                'banner_one_url' => ['required', 'url'],
                'occassion_one' => ['required'],
                'offer_one' => ['required', 'numeric'],
                'status' => ['required'],
                'offer_one_name' => ['required', 'string'],
              
            ], [
                'status.required' => 'Please select a status',
            ]);

            $path_one = '';

            $existingAd = Advertisement::where('key', 'home_page_banner_four')->first();

            // Initialize default values for paths
            if ($existingAd) {
                $existingData = json_decode($existingAd->value, true);
                $path_one = $existingData[0]['banner_one'] ?? '';
            }

            // Handle banner_one upload
            if ($request->hasFile('banner_one')) {
                $request->validate([
                    'banner_one' => ['required', 'image', 'mimes:jpg,jpeg,png,gif,webp'],
                ]);

                if ($existingAd && !empty($existingData[0]['banner_one']) && File::exists(public_path($existingData[0]['banner_one']))) {
                    File::delete(public_path($existingData[0]['banner_one']));
                }

                $file = $request->file('banner_one');
                $fileName = rand() . '.' . $file->getClientOriginalExtension();
                $path_one = '/uploads/' . $fileName;
                $file->move(public_path('uploads'), $fileName);
            }

       

            $data = [
                [
                    'banner_one' => $path_one,
                    'banner_one_url' => $request->banner_one_url,
                    'status' => $request->status,
                    'occassion_one' => $request->occassion_one,
                    'offer_one' => $request->offer_one,
                    'offer_one_name' => $request->offer_one_name,
                ],
            ];

            // Update or create the advertisement record
            Advertisement::updateOrCreate(
                ['key' => 'home_page_banner_four'],
                ['value' => json_encode($data)]
            );

            notyf()->success('Advertisement Four Updated Successfully!');
            return to_route('admin.ad.index');
        }else if($request->home_page_banner_five == 'home_page_banner_five'){
           // dd('yes');
              $request->validate([
                'banner_one_url' => ['required', 'url'],
                'occassion_one' => ['required'],
                'offer_one' => ['required', 'numeric'],
                'status' => ['required'],
                'offer_one_name' => ['required', 'string'],
              
            ], [
                'status.required' => 'Please select a status',
            ]);

            $path_one = '';

            $existingAd = Advertisement::where('key', 'home_page_banner_five')->first();

            // Initialize default values for paths
            if ($existingAd) {
                $existingData = json_decode($existingAd->value, true);
                $path_one = $existingData[0]['banner_one'] ?? '';
            }

            // Handle banner_one upload
            if ($request->hasFile('banner_one')) {
                $request->validate([
                    'banner_one' => ['required', 'image', 'mimes:jpg,jpeg,png,gif,webp'],
                ]);

                if ($existingAd && !empty($existingData[0]['banner_one']) && File::exists(public_path($existingData[0]['banner_one']))) {
                    File::delete(public_path($existingData[0]['banner_one']));
                }

                $file = $request->file('banner_one');
                $fileName = rand() . '.' . $file->getClientOriginalExtension();
                $path_one = '/uploads/' . $fileName;
                $file->move(public_path('uploads'), $fileName);
            }

       

            $data = [
                [
                    'banner_one' => $path_one,
                    'banner_one_url' => $request->banner_one_url,
                    'status' => $request->status,
                    'occassion_one' => $request->occassion_one,
                    'offer_one' => $request->offer_one,
                    'offer_one_name' => $request->offer_one_name,
                ],
            ];

            // Update or create the advertisement record
            Advertisement::updateOrCreate(
                ['key' => 'home_page_banner_five'],
                ['value' => json_encode($data)]
            );

            notyf()->success('Advertisement Four Updated Successfully!');
            return to_route('admin.ad.index');
        }else if($request->home_page_banner_six == 'home_page_banner_six'){
                $request->validate([
                'banner_one_url' => ['required', 'url'],
                'occassion_one' => ['required'],
                'offer_one' => ['required', 'numeric'],
                'status' => ['required'],
                'offer_one_name' => ['required', 'string'],
              
            ], [
                'status.required' => 'Please select a status',
            ]);

            $path_one = '';

            $existingAd = Advertisement::where('key', 'home_page_banner_six')->first();

            // Initialize default values for paths
            if ($existingAd) {
                $existingData = json_decode($existingAd->value, true);
                $path_one = $existingData[0]['banner_one'] ?? '';
            }

            // Handle banner_one upload
            if ($request->hasFile('banner_one')) {
                $request->validate([
                    'banner_one' => ['required', 'image', 'mimes:jpg,jpeg,png,gif,webp'],
                ]);

                if ($existingAd && !empty($existingData[0]['banner_one']) && File::exists(public_path($existingData[0]['banner_one']))) {
                    File::delete(public_path($existingData[0]['banner_one']));
                }

                $file = $request->file('banner_one');
                $fileName = rand() . '.' . $file->getClientOriginalExtension();
                $path_one = '/uploads/' . $fileName;
                $file->move(public_path('uploads'), $fileName);
            }

       

            $data = [
                [
                    'banner_one' => $path_one,
                    'banner_one_url' => $request->banner_one_url,
                    'status' => $request->status,
                    'occassion_one' => $request->occassion_one,
                    'offer_one' => $request->offer_one,
                    'offer_one_name' => $request->offer_one_name,
                ],
            ];

            // Update or create the advertisement record
            Advertisement::updateOrCreate(
                ['key' => 'home_page_banner_six'],
                ['value' => json_encode($data)]
            );

            notyf()->success('Advertisement six Updated Successfully!');
            return to_route('admin.ad.index');
        }else if($request->home_page_banner_seven == 'home_page_banner_seven'){
              $request->validate([
                'banner_one_url' => ['required', 'url'],
                'occassion_one' => ['required'],
                'offer_one' => ['required', 'numeric'],
                'status' => ['required'],
                'banner_two_url' => ['required', 'url'],
                'occassion_two' => ['required'],
                'offer_two' => ['required'],
            ], [
                'status.required' => 'Please select a status',
            ]);

            $path_one = '';
            $path_two = '';

            $existingAd = Advertisement::where('key', 'home_page_banner_seven')->first();

            // Initialize default values for paths
            if ($existingAd) {
                $existingData = json_decode($existingAd->value, true);
                $path_one = $existingData[0]['banner_one'] ?? '';
                $path_two = $existingData[1]['banner_two'] ?? '';
            }

            // Handle banner_one upload
            if ($request->hasFile('banner_one')) {
                $request->validate([
                    'banner_one' => ['required', 'image', 'mimes:jpg,jpeg,png,gif,webp'],
                ]);

                if ($existingAd && !empty($existingData[0]['banner_one']) && File::exists(public_path($existingData[0]['banner_one']))) {
                    File::delete(public_path($existingData[0]['banner_one']));
                }

                $file = $request->file('banner_one');
                $fileName = rand() . '.' . $file->getClientOriginalExtension();
                $path_one = '/uploads/' . $fileName;
                $file->move(public_path('uploads'), $fileName);
            }

            // Handle banner_two upload
            if ($request->hasFile('banner_two')) {
                $request->validate([
                    'banner_two' => ['required', 'image', 'mimes:jpg,jpeg,png,gif,webp'],
                ]);

                if ($existingAd && !empty($existingData[1]['banner_two']) && File::exists(public_path($existingData[1]['banner_two']))) {
                    File::delete(public_path($existingData[1]['banner_two']));
                }

                $file = $request->file('banner_two');
                $fileName = rand() . '.' . $file->getClientOriginalExtension();
                $path_two = '/uploads/' . $fileName;
                $file->move(public_path('uploads'), $fileName);
            }

            $data = [
                [
                    'banner_one' => $path_one,
                    'banner_one_url' => $request->banner_one_url,
                    'status' => $request->status,
                    'occassion_one' => $request->occassion_one,
                    'offer_one' => $request->offer_one,
                ],
                [
                    'banner_two' => $path_two,
                    'banner_two_url' => $request->banner_two_url,
                    'status' => $request->status,
                    'occassion_two' => $request->occassion_two,
                    'offer_two' => $request->offer_two,
                ]
            ];

            // Update or create the advertisement record
            Advertisement::updateOrCreate(
                ['key' => 'home_page_banner_seven'],
                ['value' => json_encode($data)]
            );

            notyf()->success('Advertisement Two Updated Successfully!');
            return to_route('admin.ad.index');
        }
        else {
            return 'not working';
        }
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
}
