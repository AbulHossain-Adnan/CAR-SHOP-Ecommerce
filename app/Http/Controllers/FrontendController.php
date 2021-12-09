<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin\Category;
use App\Models\Admin\Brand;
use App\Models\Product;
use App\Models\Admin\Seo;
use App\Models\Admin\Site;

class FrontendController extends Controller
{
    public function index(){
    	return view('frontend/index',[
  'seos'=>Seo::first(),
    'categories'=>Category::OrderBy('id','desc')->limit(11)->get(),
    'products'=>Product::all(),
    'brands'=>Brand::all(),
    'main_sliders'=>Product::where('status',1)->where('main_slider',1)->with('brand')->orderBy('id','desc')->first(),
    'feachereds'=>Product::orderBy('id','desc')->with('brand')->where('status',1)->get(),
    'tends'=>Product::where('status',1)->where('trend',1)->with('brand')->orderBy('id','desc')->get(),
    'best_rateds'=>Product::where('status',1)->where('best_rated',1)->with('brand')->orderBy('id','desc')->get(),
    'middle_sliders'=>Product::where('status',1)->where('mid_slider',1)->with('Category','brand')->orderBy('id','desc')->limit(3)->get(),
    'byeonegetones'=>Product::where('status',1)->where('byeonegetone',1)->with('Category','brand')->orderBy('id','desc')->limit(6)->get(),
    'site_setting'=>Site::first(),
    'hot_deals'=>Product::where('status',1)->where('hot_deal',1)->with('category')->get(),
    'best_sellers'=>Product::where('status',1)->where('hot_deal',1)->where('best_rated',1)->with('category')->get(),
]);
    }
}
