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
    public function edit_employee(Request $request,$id){
        if(Gate::allows('quanly')) {
            $employee = User::find($id);
            $title = 'Chi tiết thông tin nhân viên';
            $url = $request->url();
            return view('admin.QuanLyTrungTam.QuanLyNhanVien.detail', compact('employee','title','url'));
        }
        return redirect()->back();
    }

    // Lưu thông tin cập nhật
    public function update_employee(Request $request, $id){
        $data = array();
        $data['email'] = $request->email;
        $data['hoTen'] = $request->hoTen;
        $data['loaiTaiKhoan'] = $request->loaiTaiKhoan;
        $data['gioiTinh'] = $request->gioiTinh;
        $data['ngaySinh'] = $request->ngaySinh;
        $data['CCCD'] = $request->CCCD;
        $data['soDienThoai'] = $request->soDienThoai;
        $data['diaChi'] = $request->diaChi;

        if(empty($data['email']) || empty($data['hoTen']) || empty($data['CCCD']) || empty($data['soDienThoai']) || empty($data['diaChi'])){
            Toastr::warning('Vui lòng không để trống dữ liệu', 'Thất bại',);
            return redirect()->back();
        }else{
            $employee = User::find($id);
            if(User::where('email',$data['email'])->count() >0 && $data['email']!=$employee->email){
                Toastr::warning('Địa chỉ email này đã tồn tại', 'Thất bại',);
                return redirect()->back();
            }else{
                if(User::where('CCCD',$data['CCCD'])->count() >0 && $data['CCCD']!=$employee->CCCD){
                    Toastr::warning('Số căn cước công dân này đã tồn tại', 'Thất bại',);
                    return redirect()->back();
                }else{
                    if(User::where('soDienThoai',$data['soDienThoai'])->count() >0 && $data['soDienThoai']!=$employee->soDienThoai){
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
                            Toastr::success('Cập nhật thông tin nhân viên thành công', 'Thành công',);
                            return redirect()->back();
                        }
                        User::where('id',$id)->update($data);
                        Toastr::success('Cập nhật thông tin nhân viên thành công', 'Thành công',);
                        return redirect()->back();
                    }
                }
            }
        }
    }
    // Xoá nhân viên
    public function delete_employee(){

    }
    // Khoá tài khoản
    public function unactive_employee($id){
        if(Gate::allows('quanly')) {
            User::where('id',$id)
            ->update([
                'tinhTrang' => 2
            ]);
            Toastr::success('Khoá tài khoản', 'Thành công',);
            return redirect()->back();
        }
        return redirect()->back();
    }
    // Khởi động tài khoản
    public function active_employee($id){
        if(Gate::allows('quanly')) {
            User::where('id',$id)
            ->update([
                'tinhTrang' => 1
            ]);
            Toastr::success('Khởi động tài khoản', 'Thành công',);
            return redirect()->back();
        }
        return redirect()->back();
    }
}
