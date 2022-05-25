<?php

namespace App\Http\Controllers;

use App\Http\Requests\CoSoVatChatRequest;
use App\Models\CoSoVatChat;
use App\Models\LoaiHangHoa;
use App\Models\NhaCungCap;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Brian2694\Toastr\Facades\Toastr;

class CoSoVatChatController extends Controller
{
    // Danh sách cơ sở vật chất
    public function all_infrastructure(Request $request){
        if(Gate::allows('nhanvienkho')) {
            $title = 'Danh sách cơ sở vật chất';
            $url = $request->url();
            $csvc = CoSoVatChat::orderBy('id_csvc','asc')
            ->where('tinhTrang',1)
            ->join('tbl_nhacungcap','tbl_nhacungcap.id_nhacungcap','=','tbl_cosovatchat.id_nhacungcap')
            ->get();
            return view('admin.NhanVienKho.CoSoVatChat.DanhSach.all', compact('csvc','title','url'));
        }
        return redirect()->back();
    }

    // Hiển thị giao diện thêm cơ sở vật chất mới
    public function add_infrastructure(Request $request){
        if(Gate::allows('nhanvienkho')) {
            $title = "Thêm cơ sở vật chất mới";
            $url = $request->url();
            $nhacungcap = NhaCungCap::orderBy('id_nhacungcap','desc')
            ->whereBetween('id_loaiHangHoa',[2,3])
            // ->join('tbl_loaihanghoa','tbl_loaihanghoa.id_loaiHangHoa','=','tbl_nhacungcap.id_loaiHangHoa')
            ->get();
            return view('admin.NhanVienKho.CoSoVatChat.DanhSach.add', compact('title','url','nhacungcap'));
        }
        return redirect()->back();
    }

    // Lưu thông tin cơ sở vật chất được thêm
    public function save_infrastructure(CoSoVatChatRequest $request){
        $data = array();
        $data['ten'] = $request->ten;
        $data['soLuong'] = $request->soLuong;
        $data['soLuongTon'] = $request->soLuongTon;
        $data['soLuongHuHong'] = $request->soLuongHuHong;
        $data['soLuongDangSuDung'] = $request->soLuongDangSuDung;
        $data['tinhTrang'] = $request->tinhTrang;
        $data['id_nhacungcap'] = $request->id_nhacungcap;
        $data['id_nhanvienkho'] = Auth::user()->id;

        if($data['soLuong'] != ( $data['soLuongTon'] + $data['soLuongHuHong'] + $data['soLuongDangSuDung'])){
            Toastr::warning('Các số lượng khác có tổng không vượt qua tổng số lượng', 'Thất bại',);
            return redirect()->back();
        }else{
            CoSoVatChat::insert($data);
            Toastr::success('Thêm cơ sở vật chất thành công', 'Thành công',);
            return redirect()->back();
        }
    }

    // Chi tiết cơ sở vật chất
    public function edit_infrastructure(Request $request,$id){
        if(Gate::allows('nhanvienkho')) {
            $csvc = CoSoVatChat::find($id);
            $title = 'Chi tiết thông tin cơ sở vật chất';
            $url = $request->url();
            $nhacungcap = NhaCungCap::orderBy('id_nhacungcap','desc')->get();
            return view('admin.NhanVienKho.CoSoVatChat.DanhSach.detail', compact('title','url','nhacungcap','csvc'));
        }
        return redirect()->back();
    }
    // Lưu thông tin cơ sở vật chất được chỉnh sửa
    public function update_infrastructure(CoSoVatChatRequest $request,$id){
        $data = array();
        $data['ten'] = $request->ten;
        $data['soLuong'] = $request->soLuong;
        $data['soLuongTon'] = $request->soLuongTon;
        $data['soLuongHuHong'] = $request->soLuongHuHong;
        $data['soLuongDangSuDung'] = $request->soLuongDangSuDung;
        $data['tinhTrang'] = $request->tinhTrang;
        $data['id_nhacungcap'] = $request->id_nhacungcap;

        if($data['soLuong'] != ( $data['soLuongTon'] + $data['soLuongHuHong'] + $data['soLuongDangSuDung'])){
            Toastr::warning('Các số lượng khác có tổng không vượt qua tổng số lượng', 'Thất bại',);
            return redirect()->back();
        }else{
            CoSoVatChat::where('id_csvc',$id)->update($data);
            Toastr::success('Cập nhật cơ sở vật chất thành công', 'Thành công',);
            return redirect()->back();
        }
    }

    // Xoá cơ sở vật chất
    public function delete_infrastructure($id){
        CoSoVatChat::find($id)->delete();
    }

    // ----------- Kho lưu trữ ---------
    public function warehouse_infrastructure(Request $request){
        if(Gate::allows('nhanvienkho')) {
            $title = 'Kho lưu trữ cơ sở vật chất';
            $url = $request->url();
            $csvc = CoSoVatChat::orderBy('id_csvc','asc')
            ->where('tinhTrang',0)
            ->join('tbl_nhacungcap','tbl_nhacungcap.id_nhacungcap','=','tbl_cosovatchat.id_nhacungcap')
            ->get();
            return view('admin.NhanVienKho.CoSoVatChat.Kho.all', compact('csvc','title','url'));
        }
        return redirect()->back();
    }

    // Khởi động cơ sở vật chất
    public function active_warehouse_infrastructure($id){
        if(Gate::allows('nhanvienkho')) {
            CoSoVatChat::where('id_csvc',$id)
            ->update([
                'tinhTrang' => 1
            ]);
            Toastr::success('Kích hoạt cơ sở vật chất thành công', 'Thành công',);
            return redirect()->back();
        }
        return redirect()->back();
    }

}
