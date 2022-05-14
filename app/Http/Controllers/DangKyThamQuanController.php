<?php

namespace App\Http\Controllers;

use App\Models\Dangkythamquan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Brian2694\Toastr\Facades\Toastr;
use App\Http\Requests\DangkythamquanRequest;
use Illuminate\Support\Facades\Gate;

class DangKyThamQuanController extends Controller
{
    // ============== Quản lí đơn đăng kí đã được duyệt===========
    // Danh sách đơn đăng kí được duyệt
    public function all_registerToVisit(){
        if(Gate::allows('quanly')) {
            date_default_timezone_set('Asia/Ho_Chi_Minh');
            $today = date("Y-m-d");
            $title = 'Danh sách đơn đăng ký được duyệt';
            $dangkythamquan = Dangkythamquan::orderBy('ngayThamQuanDK','asc')
            ->where('ngayThamQuanDK','>=',$today)
            ->join('users','users.id','=','tbl_dangkythamquan.id_quanly')
            // ->where('tinhTrang','1')
            ->paginate(5);
            return view('admin.QuanLyTrungTam.DangKyThamQuan.DanhSach.all', compact('dangkythamquan','title'));
        }
        return redirect()->back();
    }

    public function add_registerToVisit(){
        if(Gate::allows('quanly')) {
            $title = "Thêm đơn đăng ký mới";
            return view('admin.QuanLyTrungTam.DangKyThamQuan.DanhSach.add', compact('title'));
        }
        return redirect()->back();
    }

    public function save_registerToVisit(DangkythamquanRequest $request){
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $data = array();
        $data['nguoiDaiDienDK'] = $request->nguoiDaiDienDK;
        $data['soLuongDK'] = $request->soLuongDK;
        $data['emailDK'] = $request->emailDK;
        $data['soDienThoaiDK'] = $request->soDienThoaiDK;
        $data['ghiChuDK'] = $request->ghiChuDK;
        $data['ngayThamQuanDK'] = $request->ngayThamQuanDK;
        $data['thoigianTQ'] = $request->thoigianTQ;
        $data['ngayDangKyDK'] = now();
        $data['tinhTrangDK'] = '1';
        $data['ngayDuyetDK'] = now();
        $data['id_quanly'] = Auth::user()->id;
        Dangkythamquan::insert($data);
        Toastr::success('Đăng ký tham quan trung tâm thành công', 'Thành công',);
        return redirect()->route('registerToVisit.add');
    }

    // Chi tiết đơn đăng ký đã được duyệt
    public function detail_registerToVisit(Request $request,$id){
        if(Gate::allows('quanly')) {
            $title = 'Chi tiết đơn đăng ký';
            $url = $request->url();
            $dangkythamquan = Dangkythamquan::where('id_dangky',$id)
            ->join('users','users.id','=','tbl_dangkythamquan.id_quanly')->first();
            return view('admin.QuanLyTrungTam.DangKyThamQuan.DanhSach.detail', compact('dangkythamquan','title','url'));
        }
        return redirect()->back();
    }

    // Lưu thông tin đơn đăng ký được chỉnh sửa
    public function update_registerToVisit(DangkythamquanRequest $request,$id){
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $data = array();
        $data['nguoiDaiDienDK'] = $request->nguoiDaiDienDK;
        $data['soLuongDK'] = $request->soLuongDK;
        $data['emailDK'] = $request->emailDK;
        $data['soDienThoaiDK'] = $request->soDienThoaiDK;
        $data['ghiChuDK'] = $request->ghiChuDK;
        $data['ngayThamQuanDK'] = $request->ngayThamQuanDK;
        $data['thoigianTQ'] = $request->thoigianTQ;
        Dangkythamquan::find($id)->update($data);
        Toastr::success('Cập nhật đơn đăng ký thành công', 'Thành công',);
        return redirect()->back();
    }

    public function delete_registerToVisit($id){
        Dangkythamquan::find($id)->delete();
    }

    // ===============Quản lý đơn đăng ký đang chờ duyệt================
    //Hiển thị danh sách đơn đăng ký đang chờ duyệt
    public function browse_application(){
        if(Gate::allows('quanly')) {
            $title = 'Duyệt đơn đăng ký tham quan trung tâm';
            $dangkythamquan = Dangkythamquan::orderBy('id_dangky','desc')
            ->where('tinhTrangDK','0')
            ->paginate(5);
            return view('admin.QuanLyTrungTam.DangKyThamQuan.Duyet.browse_application', compact('dangkythamquan','title'));
        }
        return redirect()->back();
    }

    // Chi tiết đơn đăng ký đang chờ duyệt
    public function detail_browse_application($id){
        if(Gate::allows('quanly')) {
            $title = 'Chi tiết đơn đăng ký đang chờ duyệt';
            $dangkythamquan = Dangkythamquan::find($id);
            return view('admin.QuanLyTrungTam.DangKyThamQuan.Duyet.detail', compact('dangkythamquan','title'));
        }
        return redirect()->back();
    }

    // Duyệt đơn đang chờ 
    public function save_browse_application($id){
        if(Gate::allows('quanly')) {
            Dangkythamquan::where('id_dangky',$id)
            ->update([
                'tinhTrangDK' => 1,
                'ngayDuyetDK' => now(),
                'id_quanly' => Auth::user()->id
            ]);
            Toastr::success('Duyệt đơn đăng ký thành công', 'Thành công',);
            return redirect()->route('browseapplication.all');
        }
        return redirect()->back();
        
    }

    // ===========Thùng rác===================
    public function garbagecan_application(Request $request){
        if(Gate::allows('quanly')) {
            date_default_timezone_set('Asia/Ho_Chi_Minh');
            $today = date("Y-m-d");
            $title = "Đơn đăng ký hết hạn";
            $url = $request->url();
            $dangkythamquan = Dangkythamquan::orderBy('ngayThamQuanDK','desc')
            ->where('ngayThamQuanDK','<',$today)
            ->join('users','users.id','=','tbl_dangkythamquan.id_quanly')
            ->paginate(5);
            return view('admin.QuanLyTrungTam.DangKyThamQuan.ThungRac.all', compact('dangkythamquan','title','url'));
        }
        return redirect()->back();
    }

    // === Đơn tham quan hôm nay
    public function all_today_application(Request $request){
        if(Gate::allows('quanly')) {
            date_default_timezone_set('Asia/Ho_Chi_Minh');
            $today = date("Y-m-d");
            $title = "Khách tham quan hôm nay";
            $url = $request->url();
            $dangkythamquan = Dangkythamquan::orderBy('thoigianTQ','asc')
            ->where('ngayThamQuanDK','=',$today)
            ->join('users','users.id','=','tbl_dangkythamquan.id_quanly')
            ->paginate(5);
            return view('admin.QuanLyTrungTam.DangKyThamQuan.ThamQuanTheoNgay.all', compact('dangkythamquan','title','url'));
        }
        return redirect()->back();
    }

}
