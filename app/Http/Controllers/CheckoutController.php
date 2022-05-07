<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use App\Models\CategoryProduct;
use App\Models\BrandProduct;
use App\Models\Customer;
use App\Models\Shipping;
use App\Models\Order;
use App\Models\OrderDetails;
use App\Models\Payment;
use Gloudemans\Shoppingcart\Facades\Cart;


session_start();

class CheckoutController extends Controller
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
    
    public function login_checkout(){
        $category_product = CategoryProduct::where('category_status',0)->orderBy('category_id')->get();
        $brand_product = BrandProduct::where('brand_status',0)->orderBy('brand_id')->get();

        return view('pages.checkout.login_checkout')
        ->with('category_product',$category_product)
        ->with('brand_product',$brand_product);
    }

    public function add_customer(Request $request){
        $data = array();
        $data['customer_email'] = $request->customer_email;
        $data['customer_password'] = MD5($request->customer_password);
        $data['customer_name'] = $request->customer_name;
        $data['customer_phone'] = $request->customer_phone;

        $customer_id = Customer::insertGetId($data);

        Session::put('customer_id',$customer_id);
        Session::put('customer_name',$data['customer_name']);

        return Redirect::to('checkout');
    }

    public function checkout(){
        $category_product = CategoryProduct::where('category_status',0)->orderBy('category_id')->get();
        $brand_product = BrandProduct::where('brand_status',0)->orderBy('brand_id')->get();

        return view('pages.checkout.show_checkout')
        ->with('category_product',$category_product)
        ->with('brand_product',$brand_product);
    }

    public function save_shipping(Request $request){
        $data = array();
        $data['shipping_email'] = $request->shipping_email;
        $data['shipping_address'] = $request->shipping_address;
        $data['shipping_name'] = $request->shipping_name;
        $data['shipping_phone'] = $request->shipping_phone;
        $data['shipping_note'] = $request->shipping_note;

        $shipping_id = Shipping::insertGetId($data);

        Session::put('shipping_id',$shipping_id);
        
        return Redirect::to('payment');
    }

    public function payment(){
        return view('pages.checkout.payment');
    }

    public function logout_checkout(){
        Session::flush();
        return Redirect::to('/login-checkout');
    }

    public function login_customer(Request $request){
        $email = $request->email_account;
        $password = MD5($request->password_account);
        $result = Customer::where('customer_email',$email)->where('customer_password',$password)->first();
        if($result){
            Session::put('customer_id',$result->customer_id);
            Session::put('customer_name',$result->customer_name);
            return Redirect::to('/checkout');
        }
        else{
            return Redirect::to('/login-checkout');
        }
    }

    public function order_place(Request $request){
        $data = array();
        $data['payment_method'] = $request->payment_option;
        $data['payment_status'] = 'Đang chờ xử lý';
        $payment_id = Payment::insertGetId($data);

        $order_data = array();
        $order_data['customer_id'] = Session::get('customer_id');
        $order_data['shipping_id'] = Session::get('shipping_id');
        $order_data['payment_id'] = $payment_id;
        $order_data['order_total'] = Cart::total();
        $order_data['order_status'] = 'Đang chờ xử lý';
        $order_id = Order::insertGetId($order_data);

        $content = Cart::content();
        foreach($content as $item){
            $detail_data = array();
            $detail_data['order_id'] = $order_id;
            $detail_data['product_id'] = $item->id;
            $detail_data['product_name'] = $item->name;
            $detail_data['product_price'] = $item->price;
            $detail_data['product_sales_quantity'] = $item->qty;
            OrderDetails::insert($detail_data);
        }
        if($data['payment_method'] == 1){
            echo 'Thanh toán bằng thẻ ATM';
        } else if($data['payment_method'] == 2){
            Cart::destroy();

            $category_product = CategoryProduct::where('category_status',0)->orderBy('category_id')->get();
            $brand_product = BrandProduct::where('brand_status',0)->orderBy('brand_id')->get();
    
            return view('pages.checkout.handcash')
            ->with('category_product',$category_product)
            ->with('brand_product',$brand_product);
        }else{
            echo 'Thanh toán bằng thẻ ghi nợ';
        }
    }

    public function manage_order(){
        $this->AuthLogin();
        $all_order = Order::with('customer')->get();
        return view('admin.manage_order')->with('all_order',$all_order);
    }

    public function view_order($order_id){
        $this->AuthLogin();
        $order_by_id = Order::with('customer')->with('shipping')->find($order_id);
        $order_details = OrderDetails::where('order_id',$order_id)->get();
        return view('admin.view_order')
        ->with('order_by_id',$order_by_id)
        ->with('order_details',$order_details);
    }

    public function delete_order($order_id){
        
    }
}
