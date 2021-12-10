<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Searchcontroller;
use App\Models\Product;
use App\Models\Admin\Category;
use App\Models\Admin\Brand;
use App\Models\Admin\Seo;
use App\Models\Admin\Site;

class Searchcontroller extends Controller
{
      public function search(request $request){

				
return view('pages/search_product',[
		'categories'=>Category::all(),
        'brands'=>Brand::all(),
        'seos'=>Seo::first(),
        'site_setting'=>Site::first(),
        'products'=>Product::where("product_name","LIKE","%".$request->search."%")
					->orwhere("product_code","LIKE","%".$request->search."%")
					->orwhere("product_details","LIKE","%".$request->search."%")
					->orwhere("product_color","LIKE","%".$request->search."%")->get(),


		]);
  }

  public function findproduct(request $request){


  	$products=Product::where("product_name","LIKE","%".$request->search."%")
					->orwhere("product_code","LIKE","%".$request->search."%")
					->orwhere("product_details","LIKE","%".$request->search."%")
					->orwhere("product_color","LIKE","%".$request->search."%")->take(10);

					return view('pages/product_suggetion',compact('products'));


  }
}
