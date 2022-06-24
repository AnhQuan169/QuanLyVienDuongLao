<?php

namespace App\Http\Controllers;

use App\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class SliderController extends Controller
{
    // Danh sách slide
    public function all_slides(Request $request){
        if(Gate::allows('quanly')) {
            $title = 'Danh sách Slide';
            $url = $request->url();
            $slide = Slider::orderBy('id_slide','asc')
            ->get();
            return view('admin.QuanLyTrungTam.QuanLySlide.DanhMuc.all', compact('slide','title','url'));
        }
        return redirect()->back();
    }

    // Lưu thông tin nhà cung cấp mới
    public function save_slides(Request $request){
        $validator = Validator::make($request->all(), 
        [
            'ten_slide'=>'required',
            'hinhAnh_slide'=>'required'
        ], 
        [
            'ten_slide.required'=>'Vui lòng nhập tên slide',
            'hinhAnh_slide.required'=>'Vui lòng chọn hình ảnh'
        ]);
        if($validator->fails()) {
            return response()->json([
                'status' => 400, 
                'error'=> $validator->errors()->toArray()
            ]);
        }else{
            date_default_timezone_set('Asia/Ho_Chi_Minh');
            $data = array();
            $data['ten_slide'] = $request->ten_slide;
            if($request->hasFile('hinhAnh_slide')) {
                $path = $request->file('hinhAnh_slide')->store('slides', 'public');
                $data['hinhAnh_slide'] = $path;
            }
            Slider::insert($data);
            return response()->json([
                'status' => 200,
                'message' => "Thêm thành công"
            ]);
        }
    }

    // Xoá SLide
    public function delete_slides($id){
        $slide = Slider::find($id);
        unlink(public_path('storage/'.$slide->hinhAnh_slide));
        $slide->delete();
        return response()->json([
            'status' => 200,
            'success'=>"Xoá thành công"
        ]);
    }

    // Chi tiết slide
    public function edit_slides($id){
        if(Gate::allows('quanly')) {
            $slide = Slider::find($id);
            return response()->json($slide);
        }
        return redirect()->back();
    }

    // Cập nhật slide
    public function update_slides(Request $request,$id){
        $validator = Validator::make($request->all(), 
        [
            'ten_slide_edit'=>'required'
        ], 
        [
            'ten_slide_edit.required'=>'Vui lòng nhập tên slide'
        ]);
        if($validator->fails()) {
            return response()->json([
                'status' => 400, 
                'error'=> $validator->errors()->toArray()
            ]);
        }else{
            date_default_timezone_set('Asia/Ho_Chi_Minh');
            $data = array();
            $data['ten_slide'] = $request->ten_slide_edit;
            if($request->hasFile('hinhAnh_slide_edit')) {
                // Xoá ảnh cũ
                $img = Slider::find($id);
                unlink(public_path('storage/'.$img->hinhAnh_slide));

                $path = $request->file('hinhAnh_slide_edit')->store('slides', 'public');
                $data['hinhAnh_slide'] = $path;
            }
            Slider::where('id_slide',$id)->update($data);
            return response()->json([
                'status' => 200,
                'message' => "Cập nhật thành công"
            ]);
        }
    }
}
