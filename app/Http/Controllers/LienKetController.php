<?php

namespace App\Http\Controllers;

use App\Models\LienKet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class LienKetController extends Controller
{
    // Danh sách slide
    public function all_links(Request $request){
        if(Gate::allows('quanly')) {
            $title = 'Danh sách liên kết';
            $url = $request->url();
            $links = LienKet::orderBy('id_lienket','asc')->get();
            return view('admin.QuanLyTrungTam.QuanLyLienKet.DanhMuc.all', compact('links','title','url'));
        }
        return redirect()->back();
    }

    // Lưu thông tin nhà cung cấp mới
    public function save_links(Request $request){
        $validator = Validator::make($request->all(), 
        [
            'link_lienket'=>'required',
            'hinhAnh_lienket'=>'required'
        ], 
        [
            'link_lienket.required'=>'Vui lòng nhập địa chỉ liên kết',
            'hinhAnh_lienket.required'=>'Vui lòng chọn hình ảnh liên kết'
        ]);
        if($validator->fails()) {
            return response()->json([
                'status' => 400, 
                'error'=> $validator->errors()->toArray()
            ]);
        }else{
            date_default_timezone_set('Asia/Ho_Chi_Minh');
            $data = array();
            if($request->hasFile('hinhAnh_lienket')) {
                $path = $request->file('hinhAnh_lienket')->store('links', 'public');
                $data['hinhAnh_lienket'] = $path;
            }
            $data['link_lienket'] = $request->link_lienket;
            LienKet::insert($data);
            return response()->json([
                'status' => 200,
                'message' => "Thêm thành công"
            ]);
        }
    }

    // Xoá SLide
    public function delete_links($id){
        $link = LienKet::find($id);
        unlink(public_path('storage/'.$link->hinhAnh_lienket));
        $link->delete();
        return response()->json([
            'status' => 200,
            'success'=>"Xoá thành công"
        ]);
    }

    // Chi tiết slide
    public function edit_links($id){
        if(Gate::allows('quanly')) {
            $link = LienKet::find($id);
            return response()->json($link);
        }
        return redirect()->back();
    }

    // Cập nhật slide
    public function update_links(Request $request,$id){
        $validator = Validator::make($request->all(), 
        [
            'link_lienket_edit'=>'required'
        ], 
        [
            'link_lienket_edit.required'=>'Vui lòng nhập link liên kết'
        ]);
        if($validator->fails()) {
            return response()->json([
                'status' => 400, 
                'error'=> $validator->errors()->toArray()
            ]);
        }else{
            date_default_timezone_set('Asia/Ho_Chi_Minh');
            $data = array();
            $data['link_lienket'] = $request->link_lienket_edit;
            if($request->hasFile('hinhAnh_lienket_edit')) {
                // Xoá ảnh cũ
                $img = LienKet::find($id);
                unlink(public_path('storage/'.$img->hinhAnh_lienket));

                $path = $request->file('hinhAnh_lienket_edit')->store('links', 'public');
                $data['hinhAnh_lienket'] = $path;
            }
            LienKet::where('id_lienket',$id)->update($data);
            return response()->json([
                'status' => 200,
                'message' => "Cập nhật thành công"
            ]);
        }
    }
}
