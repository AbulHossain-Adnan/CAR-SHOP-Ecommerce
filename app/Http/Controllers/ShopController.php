<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin\Seo;
use App\Models\Admin\Site;
use App\Models\Admin\Category;
use App\Models\Admin\Brand;

use App\Models\Product;





class ShopController extends Controller
{

  
      
       


    public function shoppage(){
    	$brands=Brand::all();
    		$seos=Seo::first();
        $categories=Category::all();
        $site_setting=Site::first();
	 $products=Product::OrderBy('discount_price','ASC')->paginate(12);

    	return view('pages/shop',compact('categories','seos','site_setting','products','brands'));
	
    }
    public function categoryshopproducts($id){
    		$brands=Brand::all();
    		$seos=Seo::first();
        $categories=Category::all();
        $category_name=Category::first();

        $site_setting=Site::first();
        $products=Product::where('status',1)->with('category','brand')->where('category_id',$id)->paginate(20);
    	  return view('pages/shop',compact('categories','seos','site_setting','products','brands','category_name'));



    }
    public function brandshopproducts($id){
    	$brands=Brand::all();
    		$seos=Seo::first();
        $categories=Category::all();
        $site_setting=Site::first();
        $products=Product::where('status',1)->with('category','brand')->where('brand_id',$id)->paginate(20);
    	  return view('pages/shop',compact('categories','seos','site_setting','products','brands'));

    }



    public function sorting(Request $request){

    	
    	if($request->select == 'option1'){
    			$brands=Brand::all();
    		$seos=Seo::first();
        $categories=Category::all();
        $site_setting=Site::first();
	 $products=Product::where('discount_price', '<=', 500000 )->paginate(12);
  return view('pages/shop',compact('categories','seos','site_setting','products','brands'));
	 
    		
    	}
    	elseif($request->select == 'option2'){
 	$brands=Brand::all();
    		$seos=Seo::first();
        $categories=Category::all();
        $site_setting=Site::first();
	 	 $products=Product::where('discount_price','>',500000)->where('discount_price','<=',1000000)->paginate(12);
  return view('pages/shop',compact('categories','seos','site_setting','products','brands'));
	 }
	 elseif($request->select == 'option3'){
 	$brands=Brand::all();
    		$seos=Seo::first();
        $categories=Category::all();
        $site_setting=Site::first();
	 	 $products=Product::where('discount_price','>',1000000)->where('discount_price','<=',5000000)->paginate(12);
  return view('pages/shop',compact('categories','seos','site_setting','products','brands'));
	 }
    	
    	 elseif($request->select == 'option4'){
 	$brands=Brand::all();
    		$seos=Seo::first();
        $categories=Category::all();
        $site_setting=Site::first();
	 	 $products=Product::where('discount_price','>',5000000)->where('discount_price','<=',10000000)->paginate(12);
  return view('pages/shop',compact('categories','seos','site_setting','products','brands'));
	 }

	  elseif($request->select == 'option5'){
 	$brands=Brand::all();
    		$seos=Seo::first();
        $categories=Category::all();
        $site_setting=Site::first();
	 	 $products=Product::where('discount_price','>',10000000)->where('discount_price','<=',100000000)->paginate(12);
  return view('pages/shop',compact('categories','seos','site_setting','products','brands'));
	 }

	  elseif($request->select == 'option6'){
 	$brands=Brand::all();
    		$seos=Seo::first();
        $categories=Category::all();
        $site_setting=Site::first();
	 	 $products=Product::where('discount_price','>',100000000)->where('discount_price','<=',500000000)->paginate(12);
  return view('pages/shop',compact('categories','seos','site_setting','products','brands'));
	 }


    	
    }




    public function sortingred(){
    	$testred=Product::where('color','=','red')->get();
    	return $testred;
    }


}
