<?php

namespace App\Http\Controllers;

use App\Models\Dangkythamquan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Brian2694\Toastr\Facades\Toastr;
use App\Http\Requests\DangkythamquanRequest;

class DangKyThamQuanController extends Controller
{
    // Danh sách đơn đăng kí được duyệt
    public function all_registerToVisit(){
        $title = 'Danh sách đơn đăng ký được duyệt';
        $dangkythamquan = Dangkythamquan::orderBy('id_dangky','desc')
        ->join('users','users.id','=','tbl_dangkythamquan.id_quanlytrungtam')
        // ->where('tinhTrang','1')
        ->paginate(5);
        return view('admin.QuanLyTrungTam.DuyetDangKyThamQuan.all', compact('dangkythamquan','title'));
    }

    public function add_registerToVisit(){
        $title = "Thêm đơn đăng ký mới";
        return view('admin.QuanLyTrungTam.DuyetDangKyThamQuan.add', compact('title'));
    }

    public function save_registerToVisit(DangkythamquanRequest $request){
        $data = array();
        $data['nguoiDaiDien'] = $request->nguoiDaiDien;
        $data['soLuong'] = $request->soLuong;
        $data['email'] = $request->email;
        $data['soDienThoaiDK'] = $request->soDienThoaiDK;
        $data['ghiChu'] = $request->ghiChu;
        $data['ngayThamQuan'] = $request->ngayThamQuan;
        $data['ngayDangKy'] = now();
        $data['tinhTrang'] = '0';
        $data['ngayDuyet'] = null;
        $data['id_quanlytrungtam'] = null;
        Dangkythamquan::insert($data);
        Toastr::success('Đăng ký tham quan trung tâm thành công', 'Thành công',);
        return redirect()->route('registerToVisit.add');
    }

    // Chi tiết đơn đăng ký đã được duyệt
    public function detail_registerToVisit($id){
        $title = 'Chi tiết đơn đăng ký';
        $dangkythamquan = Dangkythamquan::where('id_dangky',$id)
        ->join('users','users.id','=','tbl_dangkythamquan.id_quanlytrungtam')->first();
        return view('admin.QuanLyTrungTam.DuyetDangKyThamQuan.detail', compact('dangkythamquan','title'));
    }

    public function delete_registerToVisit($id){
        Dangkythamquan::find($id)->delete();
    }

    //Hiển thị danh sách đơn đăng ký đang chờ duyệt
    public function browse_application(){
        $title = 'Duyệt đơn đăng ký tham quan trung tâm';
        $dangkythamquan = Dangkythamquan::orderBy('id_dangky','desc')
        // ->join('users','users.id','=','tbl_dangkythamquan.id_quanlytrungtam')
        ->where('tinhTrang','0')
        ->paginate(5);
        return view('admin.QuanLyTrungTam.DuyetDangKyThamQuan.Duyet.browse_application', compact('dangkythamquan','title'));
    }

    // Chi tiết đơn đăng ký đang chờ duyệt
    public function detail_browse_application($id){
        $title = 'Chi tiết đơn đăng ký đang chờ duyệt';
        $dangkythamquan = Dangkythamquan::find($id);
        return view('admin.QuanLyTrungTam.DuyetDangKyThamQuan.Duyet.detail', compact('dangkythamquan','title'));
    }

    // Duyệt đơn đang chờ 
    public function save_browse_application($id){
        // Dangkythamquan::find($id)->delete();
        Dangkythamquan::where('id_dangky',$id)
        ->update([
            'tinhTrang' => 1,
            'ngayDuyet' => now(),
            'id_quanlytrungtam' => Auth::user()->id
        ]);
        Toastr::success('Duyệt đơn đăng ký thành công', 'Thành công',);
        return redirect()->route('browseapplication.all');
        
    }

}
