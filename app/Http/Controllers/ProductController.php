<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use App\Models\Product;
use App\Models\CategoryProduct;
use App\Models\BrandProduct;

session_start();

class ProductController extends Controller
{
    public function AuthLogin(){
        $admin_id = Session::get('admin_id');
        if($admin_id){
            return redirect('dashboard');
        }
        else{
            return redirect('admin')->send();
        }
    }
    
    public function add_product(){
        $this->AuthLogin();
        $category_product = CategoryProduct::all();
        $brand_product = BrandProduct::all();
        return view('admin.add_product')
        ->with('category_product',$category_product)
        ->with('brand_product',$brand_product);
    }

    public function all_product(){
        $this->AuthLogin();
        $all_product=Product::with('brand')->with('category')->get();
        return view('admin.all_product')->with('all_product',$all_product);
    }

    public function save_product(Request $request){
        $this->AuthLogin();
        $data = array();
        $data['product_name'] = $request->product_name;
        $data['product_desc'] = $request->product_desc;
        $data['product_price'] = $request->product_price;
        $data['product_content'] = $request->product_content;
        $data['category_id'] = $request->category_product;
        $data['brand_id'] = $request->brand_product;
        $data['product_status'] = $request->product_status;

        $get_image = $request->file('product_image');
        if($get_image){
            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.',$get_name_image));
            $get_image_extension = $get_image->getClientOriginalExtension();

            $new_image = $name_image.rand(0,99).'.'.$get_image_extension;
            $get_image->move('public/uploads/product',$new_image);
            $data['product_image']=$new_image;
        }
        else {
            $data['product_image']='';
        }
        Product::create($data);
        Session::put('message', 'Thêm sản phẩm thành công');
        return Redirect::to('add-product');
    }

    public function active_product($product_id){
        $this->AuthLogin();
        Product::where('product_id',$product_id)->update(['product_status' => 0]);
        Session::put('message', 'Kích hoạt sản phẩm thành công');
        return Redirect::to('all-product');
    }

    public function unactive_product($product_id){
        $this->AuthLogin();
        Product::where('product_id',$product_id)->update(['product_status' => 1]);
        Session::put('message', 'Không kích hoạt sản phẩm thành công');
        return Redirect::to('all-product');
    }

    public function edit_product($product_id){
        $this->AuthLogin();
        $category_product = CategoryProduct::orderBy('category_id')->get();
        $brand_product = BrandProduct::orderBy('brand_id')->get();

        $product=Product::where('product_id',$product_id)->limit(1)->get();
        return view('admin.edit_product')->with('product',$product)->with('category_product',$category_product)->with('brand_product',$brand_product);
    }

    public function update_product(Request $request, $product_id){
        $this->AuthLogin();
        $data = array();
        $data['product_name'] = $request->product_name;
        $data['product_desc'] = $request->product_desc;
        $data['product_name'] = $request->product_name;
        $data['product_desc'] = $request->product_desc;
        $data['product_price'] = $request->product_price;
        $data['product_content'] = $request->product_content;
        $data['category_id'] = $request->category_product;
        $data['brand_id'] = $request->brand_product;

        $get_image = $request->file('product_image');
        if($get_image){
            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.',$get_name_image));
            $get_image_extension = $get_image->getClientOriginalExtension();

            $new_image = $name_image.rand(0,99).'.'.$get_image_extension;
            $get_image->move('public/uploads/product',$new_image);
            $data['product_image']=$new_image;
        }

        Product::where('product_id',$product_id)->update($data);
        Session::put('message', 'Cập nhật sản phẩm thành công');
        return Redirect::to('all-product');
    }   

    public function delete_product($product_id){
        $this->AuthLogin();
        Product::where('product_id',$product_id)->delete();
        Session::put('message', 'Xóa sản phẩm thành công');
        return Redirect::to('all-product');
    }
    //End admin page

    public function show_category($category_id){
        $category_product = CategoryProduct::where('category_status',0)->orderBy('category_id')->get();
        $brand_product = BrandProduct::where('brand_status',0)->orderBy('brand_id')->get();

        $this_category_product = CategoryProduct::find($category_id)
        ->product()->where('product_status',0)->get();

        return view('pages.show_category')
        ->with('category_product',$category_product)
        ->with('brand_product',$brand_product)
        ->with('this_category_product',$this_category_product);
    }

    public function show_brand($brand_id){
        $category_product = CategoryProduct::where('category_status',0)->orderBy('category_id')->get();
        $brand_product = BrandProduct::where('brand_status',0)->orderBy('brand_id')->get();

        $this_brand_product = BrandProduct::find($brand_id)
        ->product()->where('product_status',0)->get();

        return view('pages.show_brand')
        ->with('category_product',$category_product)
        ->with('brand_product',$brand_product)
        ->with('this_brand_product',$this_brand_product);
    }

    public function product_details($product_id){
        $category_product = CategoryProduct::where('category_status',0)->orderBy('category_id')->get();
        $brand_product = BrandProduct::where('brand_status',0)->orderBy('brand_id')->get();

        $product=Product::with('brand')->with('category')->find($product_id);

        $category_id = $product->category_id;

        $related_product=Product::with('brand')->with('category')
        ->where('category_id',$category_id)
        ->whereNotIn('product_id',[$product_id])->get();

        return view('pages.product_details')
        ->with('product',$product)
        ->with('category_product',$category_product)
        ->with('brand_product',$brand_product)
        ->with('related_product',$related_product);
    }
}
