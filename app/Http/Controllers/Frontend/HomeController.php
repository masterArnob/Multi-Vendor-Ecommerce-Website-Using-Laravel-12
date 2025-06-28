<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\FlashSale;
use App\Models\FlashSaleItem;
use App\Models\Slider;
use App\Models\TopCategorySection;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function home(){
        $sliders = Slider::where('status', '1')->orderBy('serial', 'ASC')->get();
        $flashSaleDate = FlashSale::first();
        $flashSaleItemsSliders = FlashSaleItem::where(['status' => '1', 'show_at_home' => '1'])->orderBy('id', 'DESC')->get();
        $topCategories = TopCategorySection::first();
        $brands = Brand::where('status', 1)
        ->where('is_featured', 1)
        ->orderBy('id', 'DESC')
        ->get();
        return view('frontend.home', compact(
            'sliders', 
           'flashSaleItemsSliders',
                       'flashSaleDate',
                       'topCategories',
                       'brands',
            ));
    }
}
