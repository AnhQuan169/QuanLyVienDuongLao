<?php

namespace App\Http\Controllers;

use App\Models\HoSoNguoiCaoTuoi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Brian2694\Toastr\Facades\Toastr;

class HoSoNguoiCaoTuoiController extends Controller
{
    //-----------Danh sách người cao tuổi đã được duyệt----------------
    // Hiển thị danh sách
    public function all_elderly(){

    }
    // Hiển thị giao diện thêm mới
    public function add_elderly(){

    }
    // Lưu dư liệu được thêm mới
    public function save_elderly(){

    }
    // Hiện thị chi tiết hồ sơ người cao tuổi được chọn
    public function edit_elderly(){

    }
    // Lưu dữ liệu đã được chỉnh sửa
    public function update_elderly(){

    }
    // Xoá hồ sơ được chọn
    public function delete_elderly($id){
        HoSoNguoiCaoTuoi::find($id)->delete();
    }
    
    // ----------Duyệt danh sách đang chờ----------------
    public function browse_elderly(Request $request){
        $title='Duyệt đăng ký hồ sơ người cao tuổi';
        $url = $request->url();
        $elderly = HoSoNguoiCaoTuoi::where('tinhTrangNCC',0)
        ->orderBy('id_nguoicaotuoi','asc')
        ->join('users','users.id','=','tbl_hosonguoicaotuoi.id_nguoidung')
        ->paginate(5);
        return view('admin.QuanLyTrungTam.QuanLyHoSoNguoiCaoTuoi.Duyet.all', compact('title','url','elderly'));
    
    }
    // Hiển thị chi tiết hồ sơ đang chờ duyệt
    public function detail_browse_elderly(){

    }
    // Duyệt hồ sơ
    public function save_browse_elderly(){

    }

}
