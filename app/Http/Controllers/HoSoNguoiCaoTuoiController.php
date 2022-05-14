<?php

namespace App\Http\Controllers;

use App\Http\Requests\HoSoNguoiCaoTuoiRequest;
use App\Models\HoSoNguoiCaoTuoi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Brian2694\Toastr\Facades\Toastr;
use App\Models\User;
use Illuminate\Support\Facades\Gate;

class HoSoNguoiCaoTuoiController extends Controller
{
    //-----------Danh sách người cao tuổi đã được duyệt----------------
    // Hiển thị danh sách
    public function all_elderly(Request $request){
        if(Gate::allows('quanly')) {
            $title='Danh sách hồ sơ người cao tuổi đã được duyệt';
            $url = $request->url();
            $elderly = HoSoNguoiCaoTuoi::where('tinhTrangNCC',1)
            ->orderBy('id_nguoicaotuoi','asc')
            ->join('users','users.id','=','tbl_hosonguoicaotuoi.id_nguoidung')
            ->paginate(5);

            return view('admin.QuanLyTrungTam.QuanLyHoSoNguoiCaoTuoi.DanhSach.all', compact('title','url','elderly'));
        }
        return redirect()->back();
    }
    // Hiển thị giao diện thêm mới
    public function add_elderly(Request $request){
        if(Gate::allows('quanly')) {
            $title = "Thêm hồ sơ mới";
            $url = $request->url();
            $user = User::where('loaiTaiKhoan',3)->where('tinhTrang',1)->orderBy('id','asc')->get();
            return view('admin.QuanLyTrungTam.QuanLyHoSoNguoiCaoTuoi.DanhSach.add', compact('title','url','user'));
        }
        return redirect()->back();
    }
    // Lưu dư liệu được thêm mới
    public function save_elderly(HoSoNguoiCaoTuoiRequest $request){
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $data = array();
        $data['id_nguoidung'] = $request->id_nguoidung;
        $data['hoTenNCC'] = $request->hoTenNCC;
        $data['gioiTinhNCC'] = $request->gioiTinhNCC;
        $data['ngaySinhNCC'] = $request->ngaySinhNCC;
        $data['CCCD_NCC'] = $request->CCCD_NCC;
        $data['soDienThoaiNCC'] = $request->soDienThoaiNCC;
        $data['diaChiNCC'] = $request->diaChiNCC;
        $data['phong'] = $request->phong;
        $data['giuong'] = $request->giuong;
        $data['ngayVao'] = $request->ngayVao;
        $data['ngayDangKyNCC'] = now();
        $data['tinhTrangNCC'] = 1;
        $data['ngayDuyetNCC'] = now();
        $data['id_quanly'] = Auth::user()->id;


        if(HoSoNguoiCaoTuoi::where('CCCD_NCC',$data['CCCD_NCC'])->count() >0){
            Toastr::warning('Số căn cước công dân này đã tồn tại', 'Thất bại',);
            return redirect()->back();
        }else{
            if(HoSoNguoiCaoTuoi::where('soDienThoaiNCC',$data['soDienThoaiNCC'])->count() >0){
                Toastr::warning('Số điện thoại này đã tồn tại', 'Thất bại',);
                return redirect()->back();
            }else{
                $get_image = $request->file('anhDaiDienNCC');
                $get_image2 = $request->file('anhDon');
                $get_image3 = $request->file('anhToKhaiDeNghiTroGiup');
                $get_image4 = $request->file('anhSoYeuLyLich');
                $get_image5 = $request->file('anhGiayChungNhanHIV');
                if($get_image){
                    $get_name_image = $get_image->getClientOriginalName();
                    $name_image = current(explode('.',$get_name_image));
                    $new_image = $name_image.rand(0,99).'.'.$get_image->getClientOriginalExtension();
                    $get_image->move('public/admin/uploads/nguoicaotuoi/anhdaidien',$new_image);
                    $data['anhDaiDienNCC'] = $new_image;
                }
                if($get_image2){
                    $get_name_image2 = $get_image2->getClientOriginalName();
                    $name_image2 = current(explode('.',$get_name_image2));
                    $new_image2 = $name_image2.rand(0,99).'.'.$get_image2->getClientOriginalExtension();
                    $get_image2->move('public/admin/uploads/nguoicaotuoi/anhdondangky',$new_image2);
                    $data['anhDon'] = $new_image2;
                }
                if($get_image3){
                    $get_name_image3 = $get_image3->getClientOriginalName();
                    $name_image3 = current(explode('.',$get_name_image3));
                    $new_image3 = $name_image3.rand(0,99).'.'.$get_image3->getClientOriginalExtension();
                    $get_image3->move('public/admin/uploads/nguoicaotuoi/anhtokhai',$new_image3);
                    $data['anhToKhaiDeNghiTroGiup'] = $new_image3;
                }
                if($get_image4){
                    $get_name_image4 = $get_image4->getClientOriginalName();
                    $name_image4 = current(explode('.',$get_name_image4));
                    $new_image4 = $name_image4.rand(0,99).'.'.$get_image4->getClientOriginalExtension();
                    $get_image4->move('public/admin/uploads/nguoicaotuoi/anhsoyeulylich',$new_image4);
                    $data['anhSoYeuLyLich'] = $new_image4;
                }
                if($get_image5){
                    $get_name_image5 = $get_image5->getClientOriginalName();
                    $name_image5 = current(explode('.',$get_name_image5));
                    $new_image5 = $name_image5.rand(0,99).'.'.$get_image5->getClientOriginalExtension();
                    $get_image5->move('public/admin/uploads/nguoicaotuoi/anhgiaychungnhan',$new_image5);
                    $data['anhGiayChungNhanHIV'] = $new_image5;
                }else{
                    $data['anhGiayChungNhanHIV'] = '';
                }
                HoSoNguoiCaoTuoi::insert($data);
                Toastr::success('Thêm hồ sơ mới thành công', 'Thành công',);
                return redirect()->back();
            }
        }
    }
    // Hiện thị chi tiết hồ sơ người cao tuổi được chọn
    public function edit_elderly(Request $request, $id){
        if(Gate::allows('quanly')) {
            $title='Chi tiết thông tin hồ sơ';
            $url = $request->url();
            $elderly = HoSoNguoiCaoTuoi::where('id_nguoicaotuoi',$id)
            ->join('users','users.id','=','tbl_hosonguoicaotuoi.id_nguoidung')->first();
            $elderly_nguoiduyet = HoSoNguoiCaoTuoi::where('id_nguoicaotuoi',$id)
            ->join('users','users.id','=','tbl_hosonguoicaotuoi.id_quanly')->first();
            return view('admin.QuanLyTrungTam.QuanLyHoSoNguoiCaoTuoi.DanhSach.edit', compact('title','url','elderly','elderly_nguoiduyet'));
        }
        return redirect()->back();
    }
    // Lưu dữ liệu đã được chỉnh sửa
    public function update_elderly(Request $request, $id){
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $data = array();
        $data['hoTenNCC'] = $request->hoTenNCC;
        $data['gioiTinhNCC'] = $request->gioiTinhNCC;
        $data['ngaySinhNCC'] = $request->ngaySinhNCC;
        $data['CCCD_NCC'] = $request->CCCD_NCC;
        $data['soDienThoaiNCC'] = $request->soDienThoaiNCC;
        $data['diaChiNCC'] = $request->diaChiNCC;
        $data['phong'] = $request->phong;
        $data['giuong'] = $request->giuong;
        $data['ngayVao'] = $request->ngayVao;

        if(empty($data['hoTenNCC']) || empty($data['CCCD_NCC']) || empty($data['soDienThoaiNCC']) || empty($data['diaChiNCC'])){
            Toastr::warning('Vui lòng không để trống dữ liệu', 'Thất bại',);
            return redirect()->back();
        }else{
            $user_dm = HoSoNguoiCaoTuoi::find($id);
            if(HoSoNguoiCaoTuoi::where('CCCD_NCC',$data['CCCD_NCC'])->count() >0 && $data['CCCD_NCC']!=$user_dm->CCCD_NCC){
                Toastr::warning('Số căn cước công dân này đã tồn tại', 'Thất bại',);
                return redirect()->back();
            }else{
                if(HoSoNguoiCaoTuoi::where('soDienThoaiNCC',$data['soDienThoaiNCC'])->count() >0 && $data['soDienThoaiNCC']!=$user_dm->soDienThoaiNCC){
                    Toastr::warning('Số điện thoại này đã tồn tại', 'Thất bại',);
                    return redirect()->back();
                }else{
                    $get_image = $request->file('anhDaiDienNCC');
                    $get_image2 = $request->file('anhDon');
                    $get_image3 = $request->file('anhToKhaiDeNghiTroGiup');
                    $get_image4 = $request->file('anhSoYeuLyLich');
                    $get_image5 = $request->file('anhGiayChungNhanHIV');
                    if($get_image){
                        $get_name_image = $get_image->getClientOriginalName();
                        $name_image = current(explode('.',$get_name_image));
                        $new_image = $name_image.rand(0,99).'.'.$get_image->getClientOriginalExtension();
                        $get_image->move('public/admin/uploads/nguoicaotuoi/anhdaidien',$new_image);
                        $data['anhDaiDienNCC'] = $new_image;
                    }
                    if($get_image2){
                        $get_name_image2 = $get_image2->getClientOriginalName();
                        $name_image2 = current(explode('.',$get_name_image2));
                        $new_image2 = $name_image2.rand(0,99).'.'.$get_image2->getClientOriginalExtension();
                        $get_image2->move('public/admin/uploads/nguoicaotuoi/anhdondangky',$new_image2);
                        $data['anhDon'] = $new_image2;
                    }
                    if($get_image3){
                        $get_name_image3 = $get_image3->getClientOriginalName();
                        $name_image3 = current(explode('.',$get_name_image3));
                        $new_image3 = $name_image3.rand(0,99).'.'.$get_image3->getClientOriginalExtension();
                        $get_image3->move('public/admin/uploads/nguoicaotuoi/anhtokhai',$new_image3);
                        $data['anhToKhaiDeNghiTroGiup'] = $new_image3;
                    }
                    if($get_image4){
                        $get_name_image4 = $get_image4->getClientOriginalName();
                        $name_image4 = current(explode('.',$get_name_image4));
                        $new_image4 = $name_image4.rand(0,99).'.'.$get_image4->getClientOriginalExtension();
                        $get_image4->move('public/admin/uploads/nguoicaotuoi/anhsoyeulylich',$new_image4);
                        $data['anhSoYeuLyLich'] = $new_image4;
                    }
                    if($get_image5){
                        $get_name_image5 = $get_image5->getClientOriginalName();
                        $name_image5 = current(explode('.',$get_name_image5));
                        $new_image5 = $name_image5.rand(0,99).'.'.$get_image5->getClientOriginalExtension();
                        $get_image5->move('public/admin/uploads/nguoicaotuoi/anhgiaychungnhan',$new_image5);
                        $data['anhGiayChungNhanHIV'] = $new_image5;
                    }
                    HoSoNguoiCaoTuoi::where('id_nguoicaotuoi',$id)->update($data);
                    Toastr::success('Cập nhật thông tin hồ sơ thành công', 'Thành công',);
                    return redirect()->back();
                }
            }
        }
    }
    // Xoá hồ sơ được chọn
    public function delete_elderly($id){
        HoSoNguoiCaoTuoi::find($id)->delete();
    }

    // Lưu trữ hồ sơ không hoạt động
    public function save_warehouse_elderly($id){
        if(Gate::allows('quanly')) {
            HoSoNguoiCaoTuoi::where('id_nguoicaotuoi',$id)
            ->update([
                'tinhTrangNCC' => 2
            ]);
            Toastr::success('Lưu trữ hồ sơ thành công', 'Thành công',);
            return redirect()->route('elderly.all');
        }
        return redirect()->back();
    }
    
    // ----------Duyệt danh sách đang chờ----------------
    public function browse_elderly(Request $request){
        if(Gate::allows('quanly')) {
            $title='Duyệt đăng ký hồ sơ người cao tuổi';
            $url = $request->url();
            $elderly = HoSoNguoiCaoTuoi::where('tinhTrangNCC',0)
            ->orderBy('id_nguoicaotuoi','asc')
            ->join('users','users.id','=','tbl_hosonguoicaotuoi.id_nguoidung')
            ->paginate(5);
            return view('admin.QuanLyTrungTam.QuanLyHoSoNguoiCaoTuoi.Duyet.all', compact('title','url','elderly'));
        }
        return redirect()->back();
    
    }
    // Hiển thị chi tiết hồ sơ đang chờ duyệt
    public function detail_browse_elderly(Request $request,$id){
        if(Gate::allows('quanly')) {
            $title = 'Chi tiết đơn đăng ký hồ sơ đang chờ duyệt';
            $url = $request->url();
            $user = HoSoNguoiCaoTuoi::where('id_nguoicaotuoi',$id)
            ->join('users','users.id','=','tbl_hosonguoicaotuoi.id_nguoidung')
            ->first();
            return view('admin.QuanLyTrungTam.QuanLyHoSoNguoiCaoTuoi.Duyet.detail', compact('user','title','url'));
        }
        return redirect()->back();
    }
    // Duyệt hồ sơ
    public function save_browse_elderly($id){
        if(Gate::allows('quanly')) {
            HoSoNguoiCaoTuoi::where('id_nguoicaotuoi',$id)
            ->update([
                'tinhTrangNCC' => 1,
                'ngayDuyetNCC' => now(),
                'id_quanly' => Auth::user()->id
            ]);
            Toastr::success('Duyệt đơn đăng ký thành công', 'Thành công',);
            return redirect()->route('browseelderly.all');
        }
        return redirect()->back();
    }

    // -------------Kho lưu trữ hồ sơ không hoạt động---------------
    public function warehouse_elderly(Request $request){
        if(Gate::allows('quanly')) {
            $title='Kho lưu trữ hồ sơ không hoạt động';
            $url = $request->url();
            $elderly = HoSoNguoiCaoTuoi::where('tinhTrangNCC',2)
            ->orderBy('id_nguoicaotuoi','asc')
            ->join('users','users.id','=','tbl_hosonguoicaotuoi.id_nguoidung')
            ->paginate(5);
            return view('admin.QuanLyTrungTam.QuanLyHoSoNguoiCaoTuoi.KhoDuLieu.all', compact('title','url','elderly'));
        }
        return redirect()->back();
    }
    // Mở hoạt động cho hồ sơ
    public function active_warehouse_elderly($id){
        if(Gate::allows('quanly')) {
            HoSoNguoiCaoTuoi::where('id_nguoicaotuoi',$id)
            ->update([
                'tinhTrangNCC' => 1
            ]);
            Toastr::success('Kích hoạt hồ sơ thành công', 'Thành công',);
            return redirect()->route('elderly.warehouse');
        }
        return redirect()->back();
    }

}
