<?php

namespace App\Http\Controllers\Admin\Product;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Admin\Category;
use App\Models\Admin\Brand;
use App\Models\Admin\Seo;
use App\Models\Admin\Site;
use App\Models\Sub_category;
use Image;
use DB;

class ProductController extends Controller
{

   
    public function index(){
        $brands=Brand::all();
        $products = DB::table('products')
                        ->join('categories','products.category_id','categories.id')
                        ->join('brands','products.brand_id','brands.id')  
                        ->select('products.*','categories.category_name','brands.brand_name')->get();

                       
                     // return response()->json($products);

        return view('admin.product.index',compact('products','brands'));
        
    }
    public function create(){
        $categories =Category::all();
        $brands =Brand::all();
       
        return view('admin.product.create', compact('categories','brands'));

    }
    public function store(request $request){ 

        $validated = $request->validate([
            'category_id' => 'required',
            'brand_id' => 'required',
            'Product_name' => 'required|unique:products',
            'Product_code' => 'required',
            'Product_quantity' => 'required|numeric',
            'product_size' => 'required',
            'Product_color' => 'required',
            'selling_price' => 'required|integer',
            'video_link' => 'required',
                  
            'product_details' => 'required',
            'image_one'=>'required|mimes:jpg,bmp,png,jpeg',
            'image_two'=>'required|mimes:jpg,bmp,png,jpeg',
            'image_three'=>'required|mimes:jpg,bmp,png,jpeg',
        ]);
        $product = new product();
        $product->category_id=$request->category_id;
        $product->subcategory_id=$request->subcategory_id;

        $product->brand_id=$request->brand_id;
        $product->product_name=$request->Product_name;
        $product->product_code=$request->Product_code;
        $product->product_quantity=$request->Product_quantity;
        $product->product_details=$request->product_details;
        $product->product_color=$request->Product_color;
        $product->product_size=$request->product_size;
        $product->selling_price=$request->selling_price;
        $product->discount_price=$request->discount_price;
        $product->video_link=$request->video_link;
        $product->main_slider=$request->main_slider;
        $product->hot_deal=$request->hot_deal;
        $product->best_rated=$request->best_rated;
        $product->mid_slider=$request->mid_slider;
        $product->hot_new=$request->hot_new;
        $product->trend=$request->trend;
        $product->byeonegetone=$request->byeonegetone;    
        $image_one=$request->image_one;
        $image_two=$request->image_two;
        $image_three=$request->image_three;
        if($image_one){
            // image_one
            $image_name1=hexdec(uniqid()).'.'.$image_one->extension();
            Image::make($image_one)->save(public_path('product_images/'.$image_name1));
            $product->image_one=$image_name1;
      }
      if($image_two){
            // image_two
            $image_name2=hexdec(uniqid()).'.'.$image_two->extension();
            Image::make($image_two)->save(public_path('product_images/'.$image_name2));
            $product->image_two=$image_name2;
      }
      if($image_three){
            // image_three
            $image_name3=hexdec(uniqid()).'.'.$image_three->extension();
            Image::make($image_three)->save(public_path('product_images/'.$image_name3));
            $product->image_three=$image_name3;
      }
       $product->save();
       // return response()->json($product);
        return redirect()->route('all.product')->with('message','product created successfully');
    }
    public function edit($id){
        return view('admin/product/edit',[
            'product'=>Product::find($id),
            'categories'=>Category::all(),
            'brands'=>Brand::all(),
        ]);       
    }
    public function update( request $request)
    {


        $product =Product::find($request->id);
        $product->category_id=$request->category_id;
        $product->brand_id=$request->brand_id;
        $product->product_name=$request->Product_name;
        $product->product_code=$request->Product_code;
        $product->product_quantity=$request->Product_quantity;
        $product->product_details=$request->product_details;
        $product->product_color=$request->Product_color;
        $product->product_size=$request->product_size;
        $product->selling_price=$request->selling_price;
        $product->discount_price=$request->discount_price;
        $product->video_link=$request->video_link;
        $product->main_slider=$request->main_slider;
        $product->hot_deal=$request->hot_deal;
        $product->best_rated=$request->best_rated;
        $product->mid_slider=$request->mid_slider;
        $product->hot_new=$request->hot_new;
        $product->trend=$request->trend; 
        $product->byeonegetone=$request->byeonegetone; 
        $image_one=$request->image_one;
        $image_two=$request->image_two;
        $image_three=$request->image_three;
        if($image_one){
              // image_one
              $image_name1=hexdec(uniqid()).'.'.$image_one->extension();
              Image::make($image_one)->save(public_path('product_images/'.$image_name1));
              $product->image_one=$image_name1;
        }
        if($image_two){
              // image_two
              $image_name2=hexdec(uniqid()).'.'.$image_two->extension();
              Image::make($image_two)->save(public_path('product_images/'.$image_name1));
              $product->image_two=$image_name2;
        }
        if($image_three){
              // image_three
              $image_name3=hexdec(uniqid()).'.'.$image_three->extension();
              Image::make($image_three)->save(public_path('product_images/'.$image_name1));
              $product->image_three=$image_name3;
        }

    

        
    if($product->save()){
        return redirect()->route('all.product')->with('message','product updated successfully');
    }

    }
    public function destroy($id){
    $product_id=Product::find($id);

  $image_one=$product_id->image_one;
  $image_two=$product_id->image_two;
  $image_three=$product_id->image_three;

  if($image_one){
    unlink('product_images/'.$product_id->image_one);
  }
  if($image_two){
    unlink('product_images/'.$product_id->image_two);
  }
  if($image_three){
    unlink('product_images/'.$product_id->image_three);
  }

    $product_id->delete();
    return redirect()->back()->with('message','product deleted succesfully');
    

    }
    public function show($id){


        $product = DB::table('products')
                    ->join('categories','products.category_id','categories.id')
                    ->join('brands','products.brand_id','brands.id')
                    ->select('products.*','categories.category_name','brands.brand_name')
                    ->where('products.id',$id)->first();
                    // return response()->json($product);
                    return view('admin/product/show',compact('product'));

    }
    public function getsubcat($id){
        // $cat = Sub_category::find($id)->where('category_id',$id)->get();
       $cat = DB::table('sub_categories')->where('category_id',$id)->get();
       
    return json_encode($cat);
    // return response()->json($cat);

    }
 
  



}

