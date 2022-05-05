<?php

namespace App\Http\Controllers;

use App\Http\Requests\ThongBaoRequest;
use App\Models\ThongBao;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Brian2694\Toastr\Facades\Toastr;
session_start();

class ThongBaoController extends Controller
{
    //
    public function all_notification(){
        $title = 'Danh sách thông báo';
        $thongbao = ThongBao::orderBy('id_thongbao','desc')
        ->join('users','users.id','=','tbl_thongbao.id_quanlytrungtam')
        ->paginate(5);
        return view('admin.QuanLyTrungTam.ThongBao.all', compact('thongbao','title'));
    }

    // public function fetch_data(Request $request){
    //     if($request->ajax()){
    //         $thongbao = ThongBao::orderBy('id_thongbao','desc')->paginate(5);
    //         return view('admin.QuanLyTrungTam.ThongBao.all', compact('thongbao'))->render();
    //     }
    // }

    public function add_notification(){
        $title = "Thêm thông báo mới";
        return view('admin.QuanLyTrungTam.ThongBao.add', compact('title'));
    }

    public function save_notification(ThongBaoRequest $request){
        $data = array();
        $data['chuDe'] = $request->chuDe;
        $data['noiDung'] = $request->noiDung;
        $data['thoiGianDang'] = $request->thoiGianDang;
        $data['id_quanlytrungtam'] = Auth::user()->id;
        ThongBao::insert($data);
        Toastr::success('Thêm thông báo mới thành công', 'Thành công',);
        return redirect()->route('add_notification');
    }

    public function delete_notification($id){
        ThongBao::find($id)->delete();
        // return redirect()->route('all_notification');
    }

    // Chỉnh sửa thông báo
    public function edit_notification($id_thongbao){
        $title = "Chỉnh sửa thông báo";
        $thongbao = ThongBao::find($id_thongbao);
        return view('admin.QuanLyTrungTam.ThongBao.edit', compact('title','thongbao'));
    }

    public function update_notification(ThongBaoRequest $request, $id){
        $data= array();
        $data['chuDe'] = $request->chuDe;
        $data['noiDung'] = $request->noiDung;
        $data['thoiGianDang'] = $request->thoiGianDang;
        $data['id_quanlytrungtam'] = Auth::user()->id;
        ThongBao::where('id_thongbao',$id)->update($data);
        Toastr::success('Cập nhật thông báo thành công', 'Thành công',);
        return redirect()->route('all_notification');
    }
}
