<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ThuocRequest;
use App\Models\NhaCungCap;
use App\Models\Thuoc;
use Illuminate\Support\Facades\Gate;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Auth;


class ThuocController extends Controller
{
    // Danh sách thuốc
    public function all_medicine(Request $request){
        if(Gate::allows('nhanvienkho')) {
            $title = 'Danh sách thuốc';
            $url = $request->url();
            $thuoc = Thuoc::orderBy('id_thuoc','asc')
            ->where('tinhTrang',1)
            ->join('tbl_nhacungcap','tbl_nhacungcap.id_nhacungcap','=','tbl_thuoc.id_nhacungcap')
            ->get();
            return view('admin.NhanVienKho.Thuoc.all', compact('thuoc','title','url'));
        }
        return redirect()->back();
    }

    // Xoá thuốc
    public function delete_medicine($id){
        Thuoc::find($id)->delete();
    }

    // Giao diện thêm thuốc mới
    public function add_medicine(Request $request){
        if(Gate::allows('nhanvienkho')) {
            $title = "Thêm thuốc mới";
            $url = $request->url();
            $nhacungcap = NhaCungCap::orderBy('id_nhacungcap','desc')
            ->where('id_loaiHangHoa',1)
            ->get();
            return view('admin.NhanVienKho.Thuoc.add', compact('title','url','nhacungcap'));
        }
        return redirect()->back();
    }

    // Lưu thông tin thuốc mới
    public function save_medicine(ThuocRequest $request){
        $data = array();
        $data['tenThuoc'] = $request->tenThuoc;
        $data['congDung'] = $request->congDung;
        $data['ngayNhap'] = $request->ngayNhap;
        $data['hanSuDung'] = $request->hanSuDung;
        $data['soLuongNhap'] = $request->soLuongNhap;
        $data['tinhTrang'] = $request->tinhTrang;
        $data['id_nhacungcap'] = $request->id_nhacungcap;
        $data['id_nhanvienkho'] = Auth::user()->id;

        Thuoc::insert($data);
        Toastr::success('Thêm thuốc thành công', 'Thành công',);
        return redirect()->back();
    }

    // Giao diện chỉnh sửa thông tin thuốc
    public function edit_medicine(Request $request,$id){
        if(Gate::allows('nhanvienkho')) {
            $thuoc = Thuoc::find($id);
            $title = 'Chi tiết thông tin thuốc';
            $url = $request->url();
            $nhacungcap = NhaCungCap::orderBy('id_nhacungcap','desc')
            ->where('id_loaiHangHoa',1)
            ->get();
            return view('admin.NhanVienKho.Thuoc.edit', compact('title','url','nhacungcap','thuoc'));
        }
        return redirect()->back();
    }

    public function update_medicine(ThuocRequest $request,$id){
        $data = array();
        $data['tenThuoc'] = $request->tenThuoc;
        $data['congDung'] = $request->congDung;
        $data['ngayNhap'] = $request->ngayNhap;
        $data['hanSuDung'] = $request->hanSuDung;
        $data['soLuongNhap'] = $request->soLuongNhap;
        $data['tinhTrang'] = $request->tinhTrang;
        $data['id_nhacungcap'] = $request->id_nhacungcap;

        Thuoc::where('id_thuoc',$id)->update($data);
        Toastr::success('Thêm thuốc thành công', 'Thành công',);
        return redirect()->back();
    }
}
