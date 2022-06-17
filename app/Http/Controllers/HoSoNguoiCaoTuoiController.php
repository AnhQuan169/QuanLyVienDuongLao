<?php

namespace App\Http\Controllers;

use App\Http\Requests\BenhAnRequest;
use App\Http\Requests\HoSoNguoiCaoTuoiRequest;
use App\Http\Requests\ThuocDieuTriRequest;
use App\Http\Requests\TinhHinhSucKhoeRequest;
use App\Models\BenhAn;
use App\Models\HoSoNguoiCaoTuoi;
use App\Models\Thuoc;
use App\Models\ThuocDieuTri;
use App\Models\TinhHinhSucKhoe;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Brian2694\Toastr\Facades\Toastr;
use App\Models\User;
use Illuminate\Support\Facades\App;
use Barryvdh\DomPDF\Facade;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Carbon;

class HoSoNguoiCaoTuoiController extends Controller
{
    // === Quản lý trung tâm ===
    // =============== Quản lý hồ sơ người cao tuổi ==========================
    //-----------Danh sách người cao tuổi đã được duyệt----------------
    // Hiển thị danh sách
    public function all_elderly(Request $request){
        if(Gate::allows('quanly')) {
            $title='Danh sách hồ sơ người cao tuổi đã được duyệt';
            $url = $request->url();
            $elderly = HoSoNguoiCaoTuoi::where('tinhTrangNCC',1)
            ->orderBy('id_nguoicaotuoi','asc')
            ->join('users','users.id','=','tbl_hosonguoicaotuoi.id_nguoidung')
            ->get();

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
        }
        if(HoSoNguoiCaoTuoi::where('soDienThoaiNCC',$data['soDienThoaiNCC'])->count() >0){
            Toastr::warning('Số điện thoại này đã tồn tại', 'Thất bại',);
            return redirect()->back();
        }

        if($request->hasFile('anhDaiDienNCC')) {
            $path = $request->file('anhDaiDienNCC')->store('elderly/anhDaiDien', 'public');
            $data['anhDaiDienNCC'] = $path;
        }
        if($request->hasFile('anhDon')) {
            $path = $request->file('anhDon')->store('elderly/anhDon', 'public');
            $data['anhDon'] = $path;
        }
        if($request->hasFile('anhToKhaiDeNghiTroGiup')) {
            $path = $request->file('anhToKhaiDeNghiTroGiup')->store('elderly/anhToKhaiDeNghi', 'public');
            $data['anhToKhaiDeNghiTroGiup'] = $path;
        }
        if($request->hasFile('anhSoYeuLyLich')) {
            $path = $request->file('anhSoYeuLyLich')->store('elderly/anhSoYeuLyLich', 'public');
            $data['anhSoYeuLyLich'] = $path;
        }
        if($request->hasFile('anhGiayChungNhanHIV')) {
            $path = $request->file('anhGiayChungNhanHIV')->store('elderly/anhChungNhanHIV', 'public');
            $data['anhGiayChungNhanHIV'] = $path;
        }else{
            $data['anhGiayChungNhanHIV'] = null;
        }
                
        HoSoNguoiCaoTuoi::insert($data);
        Toastr::success('Thêm hồ sơ mới thành công', 'Thành công',);
        return redirect()->back();
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
            }
            if(HoSoNguoiCaoTuoi::where('soDienThoaiNCC',$data['soDienThoaiNCC'])->count() >0 && $data['soDienThoaiNCC']!=$user_dm->soDienThoaiNCC){
                Toastr::warning('Số điện thoại này đã tồn tại', 'Thất bại',);
                return redirect()->back();
            }
            if($request->hasFile('anhDaiDienNCC')) {
                $img = HoSoNguoiCaoTuoi::find($id);
                unlink(public_path('storage/'.$img->anhDaiDienNCC));

                $path = $request->file('anhDaiDienNCC')->store('elderly/anhDaiDien', 'public');
                $data['anhDaiDienNCC'] = $path;
            }
            if($request->hasFile('anhDon')) {
                $img = HoSoNguoiCaoTuoi::find($id);
                unlink(public_path('storage/'.$img->anhDon));

                $path = $request->file('anhDon')->store('elderly/anhDon', 'public');
                $data['anhDon'] = $path;
            }
            if($request->hasFile('anhToKhaiDeNghiTroGiup')) {
                $img = HoSoNguoiCaoTuoi::find($id);
                unlink(public_path('storage/'.$img->anhToKhaiDeNghiTroGiup));

                $path = $request->file('anhToKhaiDeNghiTroGiup')->store('elderly/anhToKhaiDeNghi', 'public');
                $data['anhToKhaiDeNghiTroGiup'] = $path;
            }
            if($request->hasFile('anhSoYeuLyLich')) {
                $img = HoSoNguoiCaoTuoi::find($id);
                unlink(public_path('storage/'.$img->anhSoYeuLyLich));

                $path = $request->file('anhSoYeuLyLich')->store('elderly/anhSoYeuLyLich', 'public');
                $data['anhSoYeuLyLich'] = $path;
            }
            if($request->hasFile('anhGiayChungNhanHIV')) {
                $img = HoSoNguoiCaoTuoi::find($id);
                unlink(public_path('storage/'.$img->anhGiayChungNhanHIV));

                $path = $request->file('anhGiayChungNhanHIV')->store('elderly/anhChungNhanHIV', 'public');
                $data['anhGiayChungNhanHIV'] = $path;
            }else{
                $data['anhGiayChungNhanHIV'] = null;
            }
            HoSoNguoiCaoTuoi::where('id_nguoicaotuoi',$id)->update($data);
            Toastr::success('Cập nhật thông tin hồ sơ thành công', 'Thành công',);
            return redirect()->back();
        }
    }
    // Xoá hồ sơ được chọn
    public function delete_elderly($id){
        $hoso = HoSoNguoiCaoTuoi::find($id);
        unlink(public_path('storage/'.$hoso->anhDaiDienNCC));
        unlink(public_path('storage/'.$hoso->anhDon));
        unlink(public_path('storage/'.$hoso->anhToKhaiDeNghiTroGiup));
        unlink(public_path('storage/'.$hoso->anhSoYeuLyLich));
        if($hoso->anhGiayChungNhanHIV){
            unlink(public_path('storage/'.$hoso->anhGiayChungNhanHIV));
        }
        $hoso->delete();
        return response()->json([
            'status' => 200,
            'message' => "Xoá thành công",
            'success'=>"Xoá thành công"
        ]);
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
            ->get();
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
            ->get();
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

    // === Nhân viên y tế ===
    // ================ Cập nhật tình hình sức khoẻ người cao tuổi =====================
    // ------- Danh sách người cao tuổi ----------------
    public function all_health_elderly(Request $request){
        if(Gate::allows('nhanvienyte')) {
            $title='Danh sách người cao tuổi';
            $url = $request->url();
            $elderly = HoSoNguoiCaoTuoi::where('tinhTrangNCC',1)
            ->join('users','users.id','=','tbl_hosonguoicaotuoi.id_nguoidung')
            ->get();

            return view('admin.NhanVienYTe.CapNhatTinhHinhSucKhoe.DanhSach.all', compact('title','url','elderly'));
        }
        return redirect()->back();
    }

    // Chi tiết người cao tuổi
    public function detail_health_elderly(Request $request,$id){
        if(Gate::allows('nhanvienyte')) {
            // Thêm mới
            $title='Tình hình sức khoẻ';
            $url = $request->url();
            $elderly = HoSoNguoiCaoTuoi::where('id_nguoicaotuoi',$id)->first();

            // Danh sách tình hình sức khoẻ
            $health_elderly = TinhHinhSucKhoe::where('id_nguoicaotuoi',$id)
            ->join('users','users.id','=','tbl_tinhhinhsuckhoe.id_nhanvienyte')
            ->get();

            return view('admin.NhanVienYTe.CapNhatTinhHinhSucKhoe.ChiTiet.detail', compact('title','url','elderly','health_elderly'));
        }
        return redirect()->back();
    }

    // Lưu thông tin tình hình sức khoẻ
    public function save_health_elderly(TinhHinhSucKhoeRequest $request,$id){
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $data = array();
        $data['id_nguoicaotuoi'] = $id;
        $data['huyetAp'] = $request->huyetAp;
        $data['nhipTim'] = $request->nhipTim;
        $data['canNang'] = $request->canNang;
        $data['thoiGian'] = now();
        $data['ngayKham'] = now();
        $data['trieuChung'] = $request->trieuChung;
        $data['ghiChu'] = $request->ghiChu;
        $data['id_nhanvienyte'] = Auth::user()->id;
        TinhHinhSucKhoe::insert($data);
        Toastr::success('Thêm mới thành công', 'Thành công',);
        return redirect()->back();
    }

    // Chỉnh sửa tình hình sức khoẻ người cao tuổi
    public function edit_health_elderly(Request $request,$id){
        if(Gate::allows('nhanvienyte')) {
            $title = 'Chi tiết tình hình sức khoẻ';
            $url = $request->url();
            $thsk = TinhHinhSucKhoe::where('id_thsk',$id)
            ->join('tbl_hosonguoicaotuoi','tbl_hosonguoicaotuoi.id_nguoicaotuoi','=','tbl_tinhhinhsuckhoe.id_nguoicaotuoi')
            ->join('users','users.id','=','tbl_tinhhinhsuckhoe.id_nhanvienyte')
            ->first();
            return view('admin.NhanVienYTe.CapNhatTinhHinhSucKhoe.ChiTiet.edit', compact('thsk','title','url'));
        }
        return redirect()->back();
    }

    // Lưu thông tin tình hình sức khoẻ được chỉnh sửa
    public function update_health_elderly(TinhHinhSucKhoeRequest $request,$id){
        $data = array();
        $data['huyetAp'] = $request->huyetAp;
        $data['nhipTim'] = $request->nhipTim;
        $data['canNang'] = $request->canNang;
        $data['trieuChung'] = $request->trieuChung;
        $data['ghiChu'] = $request->ghiChu;
        $data['id_nhanvienyte'] = Auth::user()->id;

        TinhHinhSucKhoe::find($id)->update($data);
        Toastr::success('Cập nhật thông tin thành công', 'Thành công',);
        return redirect()->back();
    }

    // Xoá tình hình sức khoẻ được chọn của người cao tuổi
    public function delete_health_elderly($id){
        TinhHinhSucKhoe::find($id)->delete();
    }





    // ====================== Cập nhật bệnh án người cao tuổi =========================
    // Danh sách người cao tuổi
    public function all_medical_records(Request $request){
        if(Gate::allows('nhanvienyte')) {
            $title='Danh sách người cao tuổi';
            $url = $request->url();
            $elderly = HoSoNguoiCaoTuoi::where('tinhTrangNCC',1)
            ->join('users','users.id','=','tbl_hosonguoicaotuoi.id_nguoidung')
            ->get();

            return view('admin.NhanVienYTe.CapNhatBenhAn.DanhSach.all', compact('title','url','elderly'));
        }
        return redirect()->back();
    }

    // Thêm bệnh án người cao tuổi
    public function add_medical_records(Request $request,$id){
        if(Gate::allows('nhanvienyte')) {
            // Thêm mới
            $title='Thêm bệnh án mới';
            $url = $request->url();
            $elderly = HoSoNguoiCaoTuoi::where('id_nguoicaotuoi',$id)->first();

            return view('admin.NhanVienYTe.CapNhatBenhAn.ChiTiet.add', compact('title','url','elderly'));
        }
        return redirect()->back();
    }

    // lưu thông tin bệnh án được thêm mới
    public function save_medical_records(BenhAnRequest $request,$id){
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $data = array();
        $data['id_nguoiCaoTuoi'] = $id;
        $data['tenBenhVien'] = $request->tenBenhVien;
        $data['diaChi'] = $request->diaChi;
        $data['soDienThoai'] = $request->soDienThoai;
        $data['khoa'] = $request->khoa;
        $data['bacSi'] = $request->bacSi;
        $data['ngayKham'] = $request->ngayKham;
        $data['ngayVaoVien'] = $request->ngayVaoVien;
        $data['ngayRaVien'] = $request->ngayRaVien;
        $data['tienSuBenh'] = $request->tienSuBenh;
        $data['ketQuaXetNghiem'] = $request->ketQuaXetNghiem;
        $data['chanDoan'] = $request->chanDoan;
        $data['ngayHenKham'] = $request->ngayHenKham;
        $data['ghiChu'] = $request->ghiChu;
        $data['chiPhi'] = $request->chiPhi;
        
        if($data['ngayVaoVien'] > $data['ngayRaVien']){
            Toastr::warning('Ngày vào ra viện không chính xác', 'Thất bại',);
            return redirect()->route('medicine.list.add');
        }
        
        BenhAn::insert($data);
        Toastr::success('Thêm mới bệnh án thành công', 'Thành công',);
        return redirect()->back();
    }

    // Danh sách bệnh án của từng người cao tuổi
    public function all_medical_records_personal(Request $request,$id){
        if(Gate::allows('nhanvienyte')) {
            $title='Danh sách bệnh án của ông (bà)';
            $url = $request->url();
            $medical_records = BenhAn::where('id_nguoiCaoTuoi',$id)->get();
            $elderly = HoSoNguoiCaoTuoi::find($id);

            return view('admin.NhanVienYTe.CapNhatBenhAn.ChiTiet.all', compact('title','url','medical_records','elderly'));
        }
        return redirect()->back();
    }

    // Thông tin chi tiết danh bạ
    public function edit_medical_records_personal(Request $request, $id){
        if(Gate::allows('nhanvienyte')) {
            $title = 'Chi tiết bệnh án của ông (bà)';
            $url = $request->url();
            $medical_records = BenhAn::where('id_benhAn',$id)
            ->join('tbl_hosonguoicaotuoi','tbl_hosonguoicaotuoi.id_nguoicaotuoi','=','tbl_benhan.id_nguoicaotuoi')
            ->first();
            return view('admin.NhanVienYTe.CapNhatBenhAn.ChiTiet.edit', compact('medical_records','title','url'));
        }
        return redirect()->back();
    }

    // Lưu thông tin danh bạ được chỉnh sửa
    public function update_medical_records_personal(BenhAnRequest $request,$id){
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $data = array();
        $data['tenBenhVien'] = $request->tenBenhVien;
        $data['diaChi'] = $request->diaChi;
        $data['soDienThoai'] = $request->soDienThoai;
        $data['khoa'] = $request->khoa;
        $data['bacSi'] = $request->bacSi;
        $data['ngayKham'] = $request->ngayKham;
        $data['ngayVaoVien'] = $request->ngayVaoVien;
        $data['ngayRaVien'] = $request->ngayRaVien;
        $data['tienSuBenh'] = $request->tienSuBenh;
        $data['ketQuaXetNghiem'] = $request->ketQuaXetNghiem;
        $data['chanDoan'] = $request->chanDoan;
        $data['ngayHenKham'] = $request->ngayHenKham;
        $data['ghiChu'] = $request->ghiChu;
        $data['chiPhi'] = $request->chiPhi;
        
        if($data['ngayVaoVien'] > $data['ngayRaVien']){
            Toastr::warning('Ngày vào ra viện không hợp lí', 'Thất bại',);
            return redirect()->back();
        }
        
        BenhAn::find($id)->update($data);
        Toastr::success('Cập nhật bệnh án thành công', 'Thành công',);
        return redirect()->back();
    }





    // ========= Cập nhật thuốc điều trị ==========
    public function add_medicine_list(Request $request,$id){
        if(Gate::allows('nhanvienyte')) {
            // Thêm mới
            $title='Thêm thuốc điều trị';
            $url = $request->url();
            $medical_records = BenhAn::where('id_benhAn',$id)->first();

            $medicine = Thuoc::where('tinhTrang',1)
            ->orderBy('id_thuoc','asc')
            ->get();

            $tdt = ThuocDieuTri::where('id_benhAn',$id)
            ->join('tbl_thuoc','tbl_thuoc.id_thuoc','=','tbl_thuocdieutri.id_thuoc')
            ->get();

            return view('admin.NhanVienYTe.CapNhatBenhAn.CapNhatThuocDieuTri.add', compact('title','url','medical_records','medicine','tdt'));
        }
        return redirect()->back();
    }

    public function save_medicine_list(ThuocDieuTriRequest $request,$id){
        $data = array();
        
        $data['id_thuoc'] = $request->id_thuoc;
        $data['soLuong'] = $request->soLuong;
        $data['donVi'] = $request->donVi;
        $data['ghiChu'] = $request->ghiChu;
        $thuocdieutri = ThuocDieuTri::where('id_benhAn',$id)->get();
        if($thuocdieutri){
            foreach($thuocdieutri as $key => $val){
                if($val['id_thuoc'] == $data['id_thuoc']){
                    $data['soLuong'] = $data['soLuong'] + $val['soLuong'];
                    ThuocDieuTri::where('id_thuoc',$request->id_thuoc)->update($data);
                    Toastr::success('Cập nhật thuốc điều trị thành công', 'Thành công',);
                    return redirect()->back();
                }
            }
        }else{
            $data['id_benhAn'] = $id;
            ThuocDieuTri::insert($data);
            Toastr::success('Thêm mới thuốc điều trị thành công', 'Thành công',);
            return redirect()->back();
        }
        $data['id_benhAn'] = $id;
        ThuocDieuTri::insert($data);
        Toastr::success('Thêm mới thuốc điều trị thành công', 'Thành công',);
        return redirect()->back();
        
    }

    // Xoá 
    public function delete_medicine_list($id){
        ThuocDieuTri::find($id)->delete();
    }

    // PDF đơn thuốc
    public function medicine_list_pdf($id){
        $pdf = App::make('dompdf.wrapper');
        $pdf->loadHTML($this->print_medicine_convert($id));
        return $pdf->stream();
    }

    public function print_medicine_convert($id){
        $tdt = ThuocDieuTri::where('id_benhAn',$id)
        ->join('tbl_thuoc','tbl_thuoc.id_thuoc','=','tbl_thuocdieutri.id_thuoc')
        ->get();
        $benhAn = BenhAn::find($id);
        $ncc = HoSoNguoiCaoTuoi::find($benhAn->id_nguoiCaoTuoi);
        $age = Carbon::parse($ncc->ngaySinhNCC)->age;
        $day = Carbon::parse($benhAn->ngayKham)->day;
        $month = Carbon::parse($benhAn->ngayKham)->month;
        $year = Carbon::parse($benhAn->ngayKham)->year;
        // $randomNumber = random_int(1000, 9999);
        return view('admin.NhanVienYTe.CapNhatBenhAn.CapNhatThuocDieuTri.pdf', compact('tdt','benhAn','ncc','age','day','month','year'));
    }

}
