<?php

namespace App\Http\Controllers;

use App\Models\BaiViet;
use App\Models\Dangkythamquan;
use App\Models\HoSoNguoiCaoTuoi;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;

class ThongKeController extends Controller
{
    //
    public function number_of_categories(Request $request){
        if(Gate::allows('quanly')) {
            $title = 'Thống kê số lượng các danh mục';

            $baiviet = BaiViet::all()->count();
            $thamquan =Dangkythamquan::all()->count();
            $nguoidung = User::where('loaiTaiKhoan',3)->count();
            $hoso = HoSoNguoiCaoTuoi::all()->count();
            $nhanvien = User::whereBetween('loaiTaiKhoan',[1,2])->count();
            
            $url = $request->url();
            return view('admin.QuanLyTrungTam.ThongKe.soluongcacdanhmuc', compact('title','url','baiviet','thamquan','nguoidung','hoso','nhanvien'));
        }
        return redirect()->back();
    }

    // Thống kê số lượt đăng ký theo tháng
    public function statistical_registerToVisit(Request $request){
        if(Gate::allows('quanly')) {
            $title = 'Thống kê số lượt đăng ký tham quan trung tâm';
            $year = Carbon::today()->year;
            $url = $request->url();

            $t1 = Dangkythamquan::whereMonth('ngayDangKyDK',1)->whereYear('ngayDangKyDK',$year)->count();
            $t2 = Dangkythamquan::whereMonth('ngayDangKyDK',2)->whereYear('ngayDangKyDK',$year)->count();
            $t3 = Dangkythamquan::whereMonth('ngayDangKyDK',3)->whereYear('ngayDangKyDK',$year)->count();
            $t4 = Dangkythamquan::whereMonth('ngayDangKyDK',4)->whereYear('ngayDangKyDK',$year)->count();
            $t5 = Dangkythamquan::whereMonth('ngayDangKyDK',5)->whereYear('ngayDangKyDK',$year)->count();
            $t6 = Dangkythamquan::whereMonth('ngayDangKyDK',6)->whereYear('ngayDangKyDK',$year)->count();
            $t7 = Dangkythamquan::whereMonth('ngayDangKyDK',7)->whereYear('ngayDangKyDK',$year)->count();
            $t8 = Dangkythamquan::whereMonth('ngayDangKyDK',8)->whereYear('ngayDangKyDK',$year)->count();
            $t9 = Dangkythamquan::whereMonth('ngayDangKyDK',9)->whereYear('ngayDangKyDK',$year)->count();
            $t10 = Dangkythamquan::whereMonth('ngayDangKyDK',10)->whereYear('ngayDangKyDK',$year)->count();
            $t11 = Dangkythamquan::whereMonth('ngayDangKyDK',11)->whereYear('ngayDangKyDK',$year)->count();
            $t12 = Dangkythamquan::whereMonth('ngayDangKyDK',12)->whereYear('ngayDangKyDK',$year)->count();
            
            $tong = Dangkythamquan::whereYear('ngayDangKyDK',$year)->count();
            
            return view('admin.QuanLyTrungTam.ThongKe.dangkythamquantheothang', compact('tong','title','url','t1','t2','t3','t4','t5','t6','t7','t8','t9','t10','t11','t12','year'));
        }
        return redirect()->back();
    }

    public function filter_registerToVisit(Request $request){
        if(Gate::allows('quanly')) {
            $title = 'Thống kê số lượt đăng ký tham quan trung tâm';
            $year = $request->filter_registerToVisit;
            $url = $request->url();

            $t1 = Dangkythamquan::whereMonth('ngayDangKyDK',1)->whereYear('ngayDangKyDK',$year)->count();
            $t2 = Dangkythamquan::whereMonth('ngayDangKyDK',2)->whereYear('ngayDangKyDK',$year)->count();
            $t3 = Dangkythamquan::whereMonth('ngayDangKyDK',3)->whereYear('ngayDangKyDK',$year)->count();
            $t4 = Dangkythamquan::whereMonth('ngayDangKyDK',4)->whereYear('ngayDangKyDK',$year)->count();
            $t5 = Dangkythamquan::whereMonth('ngayDangKyDK',5)->whereYear('ngayDangKyDK',$year)->count();
            $t6 = Dangkythamquan::whereMonth('ngayDangKyDK',6)->whereYear('ngayDangKyDK',$year)->count();
            $t7 = Dangkythamquan::whereMonth('ngayDangKyDK',7)->whereYear('ngayDangKyDK',$year)->count();
            $t8 = Dangkythamquan::whereMonth('ngayDangKyDK',8)->whereYear('ngayDangKyDK',$year)->count();
            $t9 = Dangkythamquan::whereMonth('ngayDangKyDK',9)->whereYear('ngayDangKyDK',$year)->count();
            $t10 = Dangkythamquan::whereMonth('ngayDangKyDK',10)->whereYear('ngayDangKyDK',$year)->count();
            $t11 = Dangkythamquan::whereMonth('ngayDangKyDK',11)->whereYear('ngayDangKyDK',$year)->count();
            $t12 = Dangkythamquan::whereMonth('ngayDangKyDK',12)->whereYear('ngayDangKyDK',$year)->count();
            $tong = Dangkythamquan::whereYear('ngayDangKyDK',$year)->count();
            
            return view('admin.QuanLyTrungTam.ThongKe.dangkythamquantheothang', compact('tong','title','url','t1','t2','t3','t4','t5','t6','t7','t8','t9','t10','t11','t12','year'));
        }
        return redirect()->back();
    }

}
