<?php

namespace App\Http\Controllers;

use App\Http\Requests\ThongBaoRequest;
use App\Models\ThongBao;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Gate;
session_start();

class ThongBaoController extends Controller
{
    // Hiển thị danh sách thông báo
    public function all_notification(Request $request){
        if(Gate::allows('quanly')) {
            $title = 'Danh sách thông báo';
            $url = $request->url();
            $thongbao = ThongBao::orderBy('thoiGianDang','desc')
            ->join('users','users.id','=','tbl_thongbao.id_quanlytrungtam')
            ->get();
            return view('admin.QuanLyTrungTam.ThongBao.all', compact('thongbao','url','title'));
        }
        return redirect()->back();
    }

    // Hiển thị giao diện thêm thông báo mới
    public function add_notification(Request $request){
        if(Gate::allows('quanly')) {
            $title = "Thêm thông báo mới";
            $url = $request->url();
            return view('admin.QuanLyTrungTam.ThongBao.add', compact('title','url'));
        }
        return redirect()->back();
    }

    // Lưu thông báo được thêm mới
    public function save_notification(ThongBaoRequest $request){
        $data = array();
        $data['chuDe'] = $request->chuDe;
        $data['noiDung'] = $request->noiDung;
        $data['thoiGianDang'] = $request->thoiGianDang;
        $data['id_quanlytrungtam'] = Auth::user()->id;
        ThongBao::insert($data);
        Toastr::success('Thêm thông báo mới thành công', 'Thành công',);
        return redirect()->back();
    }

    // Xoá thông báo
    public function delete_notification($id){
        ThongBao::find($id)->delete();
    }

    // Giao diện chỉnh sửa thông báo
    public function edit_notification(Request $request,$id_thongbao){
        if(Gate::allows('quanly')) {
            $title = "Chỉnh sửa thông báo";
            $url = $request->url();
            $thongbao = ThongBao::find($id_thongbao);
            return view('admin.QuanLyTrungTam.ThongBao.edit', compact('title','thongbao','url'));
        }
        return redirect()->back();
    }

    // Lưu thông báo được cập nhật
    public function update_notification(ThongBaoRequest $request, $id){
        $data= array();
        $data['chuDe'] = $request->chuDe;
        $data['noiDung'] = $request->noiDung;
        $data['thoiGianDang'] = $request->thoiGianDang;
        $data['id_quanlytrungtam'] = Auth::user()->id;
        ThongBao::where('id_thongbao',$id)->update($data);
        Toastr::success('Cập nhật thông báo thành công', 'Thành công',);
        return redirect()->back();
    }
}
