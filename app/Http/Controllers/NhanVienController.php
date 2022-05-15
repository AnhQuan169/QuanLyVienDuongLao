<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Gate;
use App\Models\User;

class NhanVienController extends Controller
{
    //====================== Admin =======================
    // --------------- Quản lý nhân viên -------------------
    // Hiển thị danh sách nhân viên 
    public function all_employee(Request $request){
        if(Gate::allows('quanly')) {
            $title='Danh sách nhân viên';
            $url = $request->url();
            $employee = User::where('tinhTrang','>',0)
            ->whereBetween('loaiTaiKhoan',[1,2])
            ->orderBy('loaiTaiKhoan','asc')
            ->paginate(5);
            return view('admin.QuanLyTrungTam.QuanLyNhanVien.all', compact('title','url','employee'));
        }
        return redirect()->back();
    }

    // Hiển thị giao diện thêm nhân viên mới
    public function add_employee(){

    }
    // Lưu thông tin nhân viên mới
    public function save_employee(){

    }
    // Hiển thị giao diện chỉnh sửa của nhân viên được chọn
    public function edit_employee(){

    }

    // Lưu thông tin cập nhật
    public function update_employee(){

    }
    // Xoá nhân viên
    public function delete_employee(){

    }
    // Khoá tài khoản
    public function unactive_employee(){

    }
    // Khởi động tài khoản
    public function active_employee(){

    }
}
