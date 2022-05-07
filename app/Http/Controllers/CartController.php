<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use App\Models\Product;
use App\Models\CategoryProduct;
use App\Models\BrandProduct;
use Gloudemans\Shoppingcart\Facades\Cart;

session_start();

class CartController extends Controller
{
    public function add_to_cart(Request $request){
        $product_id = $request->id_hidden;
        $quantity = $request->quantity;

        $product = Product::where('product_id',$product_id)->limit(1)->get();

        $data['id'] = $product[0]->product_id;
        $data['qty'] = $quantity;
        $data['name'] = $product[0]->product_name;
        $data['price'] = $product[0]->product_price;
        $data['weight'] = 0;
        $data['options']['image'] = $product[0]->product_image;
        Cart::add($data);
        Cart::setGlobalTax(10);
        return Redirect::to('/show-cart');

    }

    public function show_cart(){
        $category_product = CategoryProduct::where('category_status',0)->orderBy('category_id')->get();
        $brand_product = BrandProduct::where('brand_status',0)->orderBy('brand_id')->get();

        return view('pages.show_cart')
        ->with('category_product',$category_product)
        ->with('brand_product',$brand_product);
    }

    public function delete_to_cart($rowId){
        Cart::update($rowId,0);
        return Redirect::to('show-cart');
    }

    public function update_quantity(Request $request){
        $rowId = $request->rowId;
        $quantity = $request->quantity;
        Cart::update($rowId,$quantity);
        return Redirect::to('show-cart');
    }
}
