<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

session_start();

class AdminController extends Controller
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

    public function index(){
        return view('admin.admin_login');
    }

    public function check(Request $request){
        $admin_email = $request->admin_email;
        $admin_password = MD5($request->admin_password);

        $result = DB::table('tbl_admin')->where('admin_email',$admin_email)->where('admin_password',$admin_password)->first();
        if($result) {
            Session::put('admin_name', $result->admin_name);
            Session::put('admin_id', $result->admin_id);
            return Redirect::to('/dashboard');
        }
        else{
            $request->session()->put('message', 'Tài khoản hoặc mật khẩu chưa đúng');
            return Redirect::to('/admin');
        }
    }

    public function dashboard(){
        $this->AuthLogin();
        return view('admin.dashboard');
    }
    
    public function logout(){
        $this->AuthLogin();
        Session::put('admin_name', null);
        Session::put('admin_id', null);
        return redirect('/admin');
    }
}
