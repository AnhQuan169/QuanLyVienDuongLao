<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\Quanhuyen;
use App\Models\Tinh;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Xaphuong;
use Illuminate\Support\Facades\Auth;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Gate;


class UserController extends Controller
{
    //================== Admin ======================
    // --------------- Quản lý người dùng -----------------
    // Hiển thị danh sách người dùng đã được duyệt
    public function all_user(Request $request){
        if(Gate::allows('quanly')) {
            $title='Danh sách người dùng được duyệt';
            $url = $request->url();
            $user = User::where('tinhTrang','>',0)
            ->where('loaiTaiKhoan',3)
            ->orderBy('id','desc')
            ->paginate(5);
            return view('admin.QuanLyTrungTam.QuanLyNguoiDung.DanhSach.all', compact('title','url','user'));
        }
        return redirect()->back();
    }
    // Thêm người dùng mới
    public function add_user(Request $request){
        if(Gate::allows('quanly')) {
            $title = "Thêm người dùng mới";
            $url = $request->url();
            $city = Tinh::orderBy('city_id','desc')->get();
            return view('admin.QuanLyTrungTam.QuanLyNguoiDung.DanhSach.add', compact('title','url','city'));
        }
        return redirect()->back();
    }

    // Chọn địa chỉ người dùng
    public function select_address_user(Request $request){
        $data = $request->all();
        if($data['action']){
            $output = '';
            if($data['action']=='city'){
                $select_province = Quanhuyen::where('city_id',$data['dd_id'])->orderby('qh_id','asc')->get();
                $output.='<option>---Chọn quận, huyện---</option>';
                foreach($select_province as $key => $province){
                    $output.= '<option value="'.$province->qh_id.'">'.$province->qh_name.'</option>';
                }
            }else{
                $select_wards = Xaphuong::where('qh_id',$data['dd_id'])->orderby('xa_id','asc')->get();
                $output.='<option>---Chọn xã, phường, thị trấn---</option>';
                foreach($select_wards as $key => $ward){
                    $output.= '<option value="'.$ward->xa_id.'">'.$ward->xa_name.'</option>';
                }
            }
        }
        echo $output;
    }

    // Lưu người dùng
    public function save_user(UserRequest $request){
        $data = array();
        $data['name'] = $request->name;
        $data['email'] = $request->email;
        $data['password'] = md5($request->password);
        $data['hoTen'] = $request->hoTen;
        $data['gioiTinh'] = $request->gioiTinh;
        $data['ngaySinh'] = $request->ngaySinh;
        $data['CCCD'] = $request->CCCD;
        $data['soDienThoai'] = $request->soDienThoai;
        $data['loaiTaiKhoan'] = 3;
        $data['diaChi'] = $request->diaChi;
        $data['tinhTrang'] = 0;
        $data['ngayDangKy'] = now();
        $data['ngayDuyet'] = null;
        $data['nguoiDuyet'] = null;

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
                                Toastr::success('Đăng ký tài khoản thành công', 'Thành công',);
                                return redirect()->route('user.add');
                            }
                            $data['anhDaiDien'] = '';
                            User::insert($data);
                            Toastr::success('Đăng ký tài khoản thành công', 'Thành công',);
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

    // Chi tiết thông tin người dùng
    public function edit_user(Request $request,$id){
        if(Gate::allows('quanly')) {
            $user = User::find($id);
            $title = 'Chi tiết thông tin người dùng ';
            $url = $request->url();
            return view('admin.QuanLyTrungTam.QuanLyNguoiDung.DanhSach.edit', compact('user','title','url'));
        }
        return redirect()->back();
    }

    // Lưu thông tin người dùng được chỉnh sửa
    public function update_user(Request $request, $id){
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
                            return redirect()->route('user.all');
                        }
                        User::where('id',$id)->update($data);
                        Toastr::success('Cập nhật thông tin người dùng thành công', 'Thành công',);
                        return redirect()->back();
                    }
                }
            }
        }
    }

    // Khoá tài khoản
    public function unactive_user($id){
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
    public function active_user($id){
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


    //------------ Duyệt danh sách người dùng --------------
    // === Danh sách người dùng đang chờ duyệt
    public function browse_user(Request $request){
        if(Gate::allows('quanly')) {
            $title='Duyệt đăng ký người dùng';
            $url = $request->url();
            $user = User::where('tinhTrang',0)
            ->where('loaiTaiKhoan',3)
            // ->join('tbl_xaphuongthitran','tbl_xaphuongthitran.xa_id','=','users.diaChi')
            ->orderBy('id','asc')
            ->paginate(5);
            return view('admin.QuanLyTrungTam.QuanLyNguoiDung.Duyet.all', compact('title','url','user'));
        }
        return redirect()->back();
    }

    // === Chi tiết người dùng đang chờ duyệt
    // Chi tiết đơn đăng ký đang chờ duyệt
    public function detail_browse_user(Request $request,$id){
        if(Gate::allows('quanly')) {
            $title = 'Chi tiết đơn đăng ký đang chờ duyệt';
            $url = $request->url();
            $user = User::where('id',$id)
            // ->join('tbl_xaphuongthitran','tbl_xaphuongthitran.xa_id','=','users.diaChi')
            // ->join('tbl_quanhuyen','tbl_quanhuyen.qh_id','=','tbl_xaphuongthitran.qh_id')
            // ->join('tbl_tinhthanhpho','tbl_tinhthanhpho.city_id','=','tbl_quanhuyen.city_id')
            ->first();
            return view('admin.QuanLyTrungTam.QuanLyNguoiDung.Duyet.detail', compact('user','title','url'));
        }
        return redirect()->back();
    }

    // Duyệt
    public function save_browse_user($id){
        if(Gate::allows('quanly')) {
            User::where('id',$id)
            ->update([
                'tinhTrang' => 1,
                'ngayDuyet' => now(),
                'nguoiDuyet' => Auth::user()->hoTen
            ]);
            Toastr::success('Duyệt đơn đăng ký thành công', 'Thành công',);
            return redirect()->route('browseuser.all');
        }
        return redirect()->back();
    }

    // Xoá đơn đăng ký
    public function delete_user($id){
        User::find($id)->delete();
    }

    

}
