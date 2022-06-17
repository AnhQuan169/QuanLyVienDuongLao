<?php

namespace App\Http\Controllers;

use App\Models\BaiViet;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class BaiVietController extends Controller
{
    public function all_posts(Request $request){
        if(Gate::allows('quanly')) {
            $title = 'Danh sách bài viết';
            $url = $request->url();
            $baiviet = BaiViet::orderBy('id_baiViet','asc')
            // ->where('tinhTrang','1')
            // ->join('users','users.id','=','tbl_baiviet.id_quanly')
            ->get();
            return view('admin.QuanLyTrungTam.BaiViet.all', compact('baiviet','title','url'));
        }
        return redirect()->back();
    }

    // Lưu thông tin nhà cung cấp mới
    public function save_posts(Request $request){
        $validator = Validator::make($request->all(), 
        [
            'tenBaiViet'=>'required',
            'hinhAnh'=>'required',
            'noiDung'=>'required',
            'tacGia'=>'required',
            'ngayDang'=>'required|date',
            'tinhTrang'=>'required'
        ], 
        [
            'tenBaiViet.required'=>'Vui lòng nhập tên bài viết',
            'hinhAnh.required'=>'Vui lòng chọn hình ảnh',
            'noiDung.required'=>'Vui lòng nhập nội dung',
            'tacGia.required'=>'Vui lòng nhập tên tác giả',
            'ngayDang.required'=>'Vui lòng chọn ngày đăng',
            'tinhTrang.required'=>'Vui lòng chọn tình trạng'
        ]);
        if($validator->fails()) {
            return response()->json([
                'status' => 400, 
                'error'=> $validator->errors()->toArray()
            ]);
        }else{
            date_default_timezone_set('Asia/Ho_Chi_Minh');
            $data = array();
            $data['tenBaiViet'] = $request->tenBaiViet;
            if($request->hasFile('hinhAnh')) {
                $path = $request->file('hinhAnh')->store('posts', 'public');
                $data['hinhAnh'] = $path;
            }
            $data['noiDung'] = $request->noiDung;
            $data['tacGia'] = $request->tacGia;
            $data['ngayDang'] = $request->ngayDang;
            $data['tinhTrang'] = $request->tinhTrang;
            $data['id_quanly'] = Auth::user()->id;
            BaiViet::insert($data);
            return response()->json([
                'status' => 200,
                'message' => "Thêm thành công",
                'success'=>"Đăng ký thành công. Hãy kiểm tra email để xác nhận đơn đăng ký được duyệt"
            ]);
        }
    }

    // Gido diện chỉnh sửa bài viết
    public function edit_posts(Request $request,$id){
        if(Gate::allows('quanly')) {
            $post = BaiViet::where('id_baiViet',$id)
            ->join('users','users.id','=','tbl_baiviet.id_quanly')->first();
            $title = 'Chi tiết thông tin bài viết';
            $url = $request->url();
            return view('admin.QuanLyTrungTam.BaiViet.edit', compact('post','title','url'));
        }
        return redirect()->back();
    }

    // Lưu thông tin bài viết được chỉnh sửa
    public function update_posts(Request $request,$id){
        $request->validate([
            'tenBaiViet'=>'required',
            'noiDung'=>'required',
            'tacGia'=>'required'
        ], 
        [
            'tenBaiViet.required'=>'Vui lòng nhập tên bài viết',
            'noiDung.required'=>'Vui lòng nhập nội dung',
            'tacGia.required'=>'Vui lòng nhập tên tác giả'
        ]);

        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $data = array();
        $data['tenBaiViet'] = $request->tenBaiViet;
        if($request->hasFile('hinhAnh')) {
            // Xoá ảnh cũ
            $img = BaiViet::find($id);
            unlink(public_path('storage/'.$img->hinhAnh));

            $path = $request->file('hinhAnh')->store('posts', 'public');
            $data['hinhAnh'] = $path;
        }
        $data['noiDung'] = $request->noiDung;
        $data['tacGia'] = $request->tacGia;
        $data['ngayDang'] = $request->ngayDang;
        $data['tinhTrang'] = $request->tinhTrang;
        BaiViet::where('id_baiViet',$id)->update($data);
        Toastr::success('Cập nhật thông tin bài viết thành công', 'Thành công',);
        return redirect()->back();
    }

    // Xoá bài viết
    public function delete_posts($id){
        $post = BaiViet::find($id);
        unlink(public_path('storage/'.$post->hinhAnh));
        $post->delete();
        return response()->json([
            'status' => 200,
            'message' => "Xoá thành công",
            'success'=>"Xoá thành công"
        ]);
    }

    // Khoá bài viết
    public function unactive_posts($id){
        if(Gate::allows('quanly')) {
            BaiViet::where('id_baiViet',$id)
            ->update([
                'tinhTrang' => 0
            ]);
            Toastr::success('Khoá bài viết', 'Thành công',);
            return redirect()->back();
        }
        return redirect()->back();
    }
    // Khởi động bài viết
    public function active_posts($id){
        if(Gate::allows('quanly')) {
            BaiViet::where('id_baiViet',$id)
            ->update([
                'tinhTrang' => 1
            ]);
            Toastr::success('Khởi động bài viết', 'Thành công',);
            return redirect()->back();
        }
        return redirect()->back();
    }
}
