<?php

namespace App\Http\Controllers;

use App\Http\Requests\AdminLoginRequest;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
session_start();

class AdminController extends Controller
{
    // Bảo mật Login
    // public function AuthLogin(){
    //     $admin_id = Auth::id();
    //     if($admin_id){
    //         return redirect()->route('dashboard');
    //     }else{
    //         return redirect()->route('login-admin')->send();
    //     }
    // }

    // ============== Login ==================
    public function index(){
        return view('admin.admin_login');
    }

    public function show_dashboard(){
        // $this->AuthLogin();
        $title = "Dashboard";
        return view('admin.dashboard', compact('title'));
    }

    public function login_admin(Request $request){
        $request->validate([
            'name' =>'required',
            'password' =>'required',
        ]);

        if(Auth::attempt(['name'=> $request->name, 'password' => $request->password])){
            $user = User::where('name',$request->name)->first();
            if($user->tinhTrang == 1){
                Auth::login($user);
                return redirect()->route('dashboard');
            }else{
                return redirect()->route('login_admin')->with('message','Tài khoản đang bị khoá');
            }
        }else{
            return redirect()->route('login_admin')->with('message','Tên tài khoản hoặc mật khẩu không đúng');
        }
    }

    public function logout_admin(){
        // $this->AuthLogin();
        Auth::logout();
        return redirect()->route('login_admin')->with('message','Đăng xuất thành công');
    }

    // ============== Dashboard ==================
    
}
