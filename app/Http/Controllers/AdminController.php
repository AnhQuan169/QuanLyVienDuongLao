<?php

namespace App\Http\Controllers;

use App\Http\Requests\AdminLoginRequest;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Brian2694\Toastr\Facades\Toastr;
session_start();

class AdminController extends Controller
{

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

    
    // ============= Thông tin cá nhân ====================
    // ---------------- Giao diện thông tin cá nhân -------------------
    public function admin_profile(Request $request,$id){
        $title = 'Thông tin cá nhân';
        $url = $request->url();
        $user = User::find($id);
        return view('admin.ThongTinChung.ThongTinCaNhan.detail', compact('user','title','url'));
    }

    // Cập nhật thông tin
    public function update_admin_profile(Request $request, $id){
        $data = array();
        $data['email'] = $request->email;
        $data['hoTen'] = $request->hoTen;
        $data['gioiTinh'] = $request->gioiTinh;
        $data['ngaySinh'] = $request->ngaySinh;
        $data['CCCD'] = $request->CCCD;
        $data['soDienThoai'] = $request->soDienThoai;
        $data['diaChi'] = $request->diaChi;

        if(empty($data['email']) || empty($data['hoTen']) || empty($data['CCCD']) || empty($data['soDienThoai']) || empty($data['diaChi'])){
            Toastr::warning('Vui lòng không để trống dữ liệu', 'Thất bại',);
            return redirect()->back();
        }else{
            $user_dm = User::find($id);
            if(User::where('email',$data['email'])->count() >0 && $data['email']!=$user_dm->email){
                Toastr::warning('Địa chỉ email này đã tồn tại', 'Thất bại',);
                return redirect()->back();
            }else{
                if(User::where('CCCD',$data['CCCD'])->count() >0 && $data['CCCD']!=$user_dm->CCCD){
                    Toastr::warning('Số căn cước công dân này đã tồn tại', 'Thất bại',);
                    return redirect()->back();
                }else{
                    if(User::where('soDienThoai',$data['soDienThoai'])->count() >0 && $data['soDienThoai']!=$user_dm->soDienThoai){
                        Toastr::warning('Số điện thoại này đã tồn tại', 'Thất bại',);
                        return redirect()->back();
                    }else{
                        $get_image = $request->file('anhDaiDien');
                        if($get_image){
                            $get_name_image = $get_image->getClientOriginalName();
                            $name_image = current(explode('.',$get_name_image));
                            $new_image = $name_image.rand(0,99).'.'.$get_image->getClientOriginalExtension();
                            $get_image->move('public/admin/uploads/users',$new_image);
                            $data['anhDaiDien'] = $new_image;
                            User::where('id',$id)->update($data);
                            Toastr::success('Cập nhật thông tin người dùng thành công', 'Thành công',);
                            return redirect()->back();
                        }
                        User::where('id',$id)->update($data);
                        Toastr::success('Cập nhật thông tin người dùng thành công', 'Thành công',);
                        return redirect()->back();
                    }
                }
            }
        }
    }
}
