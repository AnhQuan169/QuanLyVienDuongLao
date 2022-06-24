<?php

namespace App\Http\Controllers;

use App\Http\Requests\NhaCungCapRequest;
use App\Models\LoaiHangHoa;
use App\Models\NhaCungCap;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Gate;

class NhaCungCapController extends Controller
{
    //Hiển thị danh sách nhà cung cấp
    public function all_supplier(Request $request){
        if(Gate::allows('quanly')) {
            $title = 'Danh sách nhà cung cấp';
            $url = $request->url();
            $nhacungcap = NhaCungCap::orderBy('id_nhacungcap','asc')
            ->join('tbl_loaihanghoa','tbl_loaihanghoa.id_loaiHangHoa','=','tbl_nhacungcap.id_loaiHangHoa')
            ->get();
            return view('admin.QuanLyTrungTam.NhaCungCap.all', compact('nhacungcap','title','url'));
        }
        return redirect()->back();
    }

    // Hiển thị giao diện thêm nhà cung cấp mới
    public function add_supplier(Request $request){
        if(Gate::allows('quanly')) {
            $title = "Thêm nhà cung cấp mới";
            $url = $request->url();
            $loaiHangHoa = LoaiHangHoa::orderBy('id_loaiHangHoa','desc')->get();
            return view('admin.QuanLyTrungTam.NhaCungCap.add', compact('title','url','loaiHangHoa'));
        }
        return redirect()->back();
    }

    // Lưu thông tin nhà cung cấp mới
    public function save_supplier(NhaCungCapRequest $request){
        $data = array();
        $data['ten_ncc'] = $request->ten_ncc;
        $data['diaChi_ncc'] = $request->diaChi_ncc;
        $data['email_ncc'] = $request->email_ncc;
        $data['soDienThoai_ncc'] = $request->soDienThoai_ncc;
        $data['tinhTrang_ncc'] = $request->tinhTrang_ncc;
        $data['id_loaiHangHoa'] = $request->id_loaiHangHoa;

        if(NhaCungCap::where('email_ncc',$data['email_ncc'])->count() >0){
            Toastr::warning('Địa chỉ email này đã tồn tại', 'Thất bại',);
            return redirect()->back();
        }else{
            if(NhaCungCap::where('soDienThoai_ncc',$data['soDienThoai_ncc'])->count() >0){
                Toastr::warning('Số điện thoại này đã tồn tại', 'Thất bại',);
                return redirect()->back();
            }else{
                NhaCungCap::insert($data);
                Toastr::success('Thêm nhà cung cấp thành công', 'Thành công',);
                return redirect()->back();
            }
        }
    }

    // Hiển thị giao diện chi tiết nhà cung cấp
    public function edit_supplier(Request $request,$id){
        if(Gate::allows('quanly')) {
            $supplier = NhaCungCap::find($id);
            $title = 'Chi tiết thông tin nhà cung cấp';
            $url = $request->url();
            $loaihanghoa = LoaiHangHoa::orderBy('id_loaiHangHoa','desc')->get();
            return view('admin.QuanLyTrungTam.NhaCungCap.detail', compact('supplier','title','url','loaihanghoa'));
        }
        return redirect()->back();
    }

    // Lưu thông tin nhà cung cấp được thay đổi
    public function update_supplier(NhaCungCapRequest $request,$id){
        $data = array();
        $data['ten_ncc'] = $request->ten_ncc;
        $data['diaChi_ncc'] = $request->diaChi_ncc;
        $data['email_ncc'] = $request->email_ncc;
        $data['soDienThoai_ncc'] = $request->soDienThoai_ncc;
        $data['tinhTrang_ncc'] = $request->tinhTrang_ncc;
        $data['id_loaiHangHoa'] = $request->id_loaiHangHoa;

        $supplier = NhaCungCap::find($id);
        if(NhaCungCap::where('email_ncc',$data['email_ncc'])->count() >0 && $data['email_ncc']!=$supplier->email_ncc){
            Toastr::warning('Địa chỉ email này đã tồn tại', 'Thất bại',);
            return redirect()->back();
        }else{
            if(NhaCungCap::where('soDienThoai_ncc',$data['soDienThoai_ncc'])->count() >0 && $data['soDienThoai_ncc']!=$supplier->soDienThoai_ncc){
                Toastr::warning('Số điện thoại này đã tồn tại', 'Thất bại',);
                return redirect()->back();
            }else{
                NhaCungCap::where('id_nhacungcap',$id)->update($data);
                Toastr::success('Cập nhật nhà cung cấp thành công', 'Thành công',);
                return redirect()->back();
            }
        }
    }

    // Xoá nhà cung cấp
    public function delete_supplier($id){
        NhaCungCap::find($id)->delete();
    }

    // Khoá nhà cung cấp
    public function unactive_supplier($id){
        if(Gate::allows('quanly')) {
            NhaCungCap::where('id_nhacungcap',$id)
            ->update([
                'tinhTrang_ncc' => 0
            ]);
            Toastr::success('Khoá nhà cung cấp', 'Thành công',);
            return redirect()->back();
        }
        return redirect()->route('supplier.all');
    }

    // Khởi động nhà cung cấp
    public function active_supplier($id){
        if(Gate::allows('quanly')) {
            NhaCungCap::where('id_nhacungcap',$id)
            ->update([
                'tinhTrang_ncc' => 1
            ]);
            Toastr::success('Khởi động nhà cung cấp', 'Thành công',);
            return redirect()->back();
        }
        return redirect()->route('supplier.all');
    }
}
