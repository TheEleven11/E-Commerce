<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BrandProduct;
use App\Models\CategoryProduct;
use App\Models\Product;

class HomeController extends Controller
{
    public function index(){
        $category_product = CategoryProduct::where('category_status',0)->orderBy('category_id')->get();
        $brand_product = BrandProduct::where('brand_status',0)->orderBy('brand_id')->get();

        $product=Product::where('product_status','0')->limit(6)->get();

        return view('pages.home')->with('category_product',$category_product)->with('brand_product',$brand_product)->with('product',$product);
    }

    public function search(Request $request){
        $keywords = $request->keywords;

        $category_product = CategoryProduct::where('category_status',0)->orderBy('category_id')->get();
        $brand_product = BrandProduct::where('brand_status',0)->orderBy('brand_id')->get();

        $product = Product::where('product_status',0)->where('product_name','like','%'.$keywords.'%')->limit(6)->get();

        return view('pages.search')->with('category_product',$category_product)->with('brand_product',$brand_product)->with('product',$product);
    }
}
