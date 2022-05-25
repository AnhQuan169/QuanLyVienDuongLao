<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Gate;
use App\Http\Requests\UserRequest;
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
            ->get();
            return view('admin.QuanLyTrungTam.QuanLyNhanVien.all', compact('title','url','employee'));
        }
        return redirect()->back();
    }

    // Hiển thị giao diện thêm nhân viên mới
    public function add_employee(Request $request){
        if(Gate::allows('quanly')) {
            $title = "Thêm nhân viên mới";
            $url = $request->url();
            return view('admin.QuanLyTrungTam.QuanLyNhanVien.add', compact('title','url'));
        }
        return redirect()->back();
    }
    // Lưu thông tin nhân viên mới
    public function save_employee(UserRequest $request){
        $data = array();
        $data['name'] = $request->name;
        $data['email'] = $request->email;
        $data['password'] = md5($request->password);
        $data['hoTen'] = $request->hoTen;
        $data['gioiTinh'] = $request->gioiTinh;
        $data['ngaySinh'] = $request->ngaySinh;
        $data['CCCD'] = $request->CCCD;
        $data['soDienThoai'] = $request->soDienThoai;
        $data['loaiTaiKhoan'] = $request->loaiTaiKhoan;
        $data['diaChi'] = $request->diaChi;
        $data['tinhTrang'] = 1;
        $data['ngayDangKy'] = now();
        $data['nguoiDuyet'] = Auth::user()->name;

        if(User::where('email',$data['email'])->count() >0){
            Toastr::warning('Địa chỉ email này đã tồn tại', 'Thất bại',);
            return redirect()->back();
        }else{
            if(User::where('CCCD',$data['CCCD'])->count() >0){
                Toastr::warning('Số căn cước công dân này đã tồn tại', 'Thất bại',);
                return redirect()->back();
            }else{
                if(User::where('soDienThoai',$data['soDienThoai'])->count() >0){
                    Toastr::warning('Số điện thoại này đã tồn tại', 'Thất bại',);
                    return redirect()->back();
                }else{
                    if(User::where('name',$data['name'])->count() >0){
                        Toastr::warning('Tên đăng nhập này đã tồn tại', 'Thất bại',);
                        return redirect()->back();
                    }else{
                        if($data['password'] == md5($request->confirmpww)){
                            // Thêm ảnh đại diện
                            $get_image = $request->file('anhDaiDien');
                            if($get_image){
                                $get_name_image = $get_image->getClientOriginalName();
                                // Sử dụng hàm Explode() để phân tách thành 2 giá trị từ 1 giá trị với vị trị phân tách tại '.'
                                // Khi dùng explode() tách biến thành 2 giá trị rồi
                                //  + Sử dụng hàm current() để lấy giá trị đầu của của biến được phân tách
                                //  + Sử dụng hàm end() để lấy giá trị cuối của biến được phân tách
                                $name_image = current(explode('.',$get_name_image));
                                $new_image = $name_image.rand(0,99).'.'.$get_image->getClientOriginalExtension();
                                $get_image->move('public/admin/uploads/users',$new_image);
                                $data['anhDaiDien'] = $new_image;
                                User::insert($data);
                                Toastr::success('Thêm tài khoản nhân viên thành công', 'Thành công',);
                                return redirect()->back();
                            }
                            $data['anhDaiDien'] = '';
                            User::insert($data);
                            Toastr::success('Thêm tài khoản nhân viên thành công', 'Thành công',);
                            return redirect()->back();
                        }else{
                            Toastr::warning('Mật khẩu nhập lại không chính xác', 'Thất bại',);
                            return redirect()->back();
                        }
                    }
                }
            }
        }
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
    public function delete_employee($id){
        User::find($id)->delete();
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
        return redirect()->route('employee.all');
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
        return redirect()->route('employee.all');
    }

    // Tìm kiếm nhân viên với Ajax
    public function search_employee(Request $request){
        if(Gate::allows('quanly')) {
            $title='Danh sách nhân viên';
            $url = $request->url();
            $keywords = $request->keyword_employee;
            if($keywords){
                $search_employee = User::where('tinhTrang','>',0)
                ->whereBetween('loaiTaiKhoan',[1,2])
                ->orderBy('loaiTaiKhoan','asc')
                ->where('hoTen','like','%'.$keywords.'%')
                ->paginate(5);
                return view('admin.QuanLyTrungTam.QuanLyNhanVien.search', compact('search_employee','url','title'));
            }else{
                return redirect()->route('employee.all');
            }
            
        }
        return redirect()->back();
    }
}
