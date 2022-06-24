<?php

namespace App\Http\Controllers;

use App\Models\BenhAn;
use App\Models\HoSoNguoiCaoTuoi;
use App\Models\ThuocDieuTri;
use App\Models\TinhHinhSucKhoe;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Session;

use Illuminate\Support\Facades\App;

class NguoiThanController extends Controller
{
    //Đăng ký hồ sơ người cao tuổi
    public function register_elderly(Request $request){
        $validator = Validator::make($request->all(), 
        [
            'hoTenNCC'=>'required',
            'gioiTinhNCC'=>'required',
            'ngaySinhNCC'=>'required',
            'anhDaiDienNCC'=>'required',
            'CCCD_NCC'=>'required',
            'soDienThoaiNCC'=>'required',
            'diaChiNCC'=>'required',
            'ngayVao'=>'required',
            'anhDon'=>'required',
            'anhToKhaiDeNghiTroGiup'=>'required',
            'anhSoYeuLyLich'=>'required'
        ], 
        [
            'hoTenNCC.required'=>'Vui lòng nhập họ tên người cao tuổi',
            'gioiTinhNCC.required'=>'Vui lòng chọn giới tính',
            'ngaySinhNCC.required'=>'Vui lòng chọn ngày sinh',
            'anhDaiDienNCC.required'=>'Vui lòng chọn ảnh đại diện',
            'CCCD_NCC.required'=>'Vui lòng nhập số căn cước công dân',
            'soDienThoaiNCC.required'=>'Vui lòng nhập số điện thoại',
            'diaChiNCC.required'=>'Vui lòng nhập địa chỉ',
            'ngayVao.required'=>'Vui lòng chọn ngày vào',
            'anhDon.required'=>'Vui lòng chọn ảnh đơn đăng ký',
            'anhToKhaiDeNghiTroGiup.required'=>'Vui lòng chọn ảnh tờ khai đề nghị trợ giúp',
            'anhSoYeuLyLich.required'=>'Vui lòng chọn ảnh sơ yếu lý lịch'
        ]);
        if($validator->fails()) {
            return response()->json([
                'status' => 400, 
                'error'=> $validator->errors()->toArray()
            ]);
        }else{
            date_default_timezone_set('Asia/Ho_Chi_Minh');
            $data = array();
            $data['id_nguoidung'] = Auth::user()->id;
            $data['hoTenNCC'] = $request->hoTenNCC;
            $data['gioiTinhNCC'] = $request->gioiTinhNCC;
            $data['ngaySinhNCC'] = $request->ngaySinhNCC;
            $data['CCCD_NCC'] = $request->CCCD_NCC;
            $data['soDienThoaiNCC'] = $request->soDienThoaiNCC;
            $data['diaChiNCC'] = $request->diaChiNCC;
            $data['phong'] = null;
            $data['giuong'] = null;
            $data['ngayVao'] = $request->ngayVao;
            $data['ngayDangKyNCC'] = now();
            $data['tinhTrangNCC'] = 0;
            $data['ngayDuyetNCC'] = null;
            $data['id_quanly'] = null;

            if(HoSoNguoiCaoTuoi::where('CCCD_NCC',$request->CCCD_NCC)->count() >0){
                return response()->json(['errors'=>'Số căn cước công dân này đã tồn tại']);
            }

            if(HoSoNguoiCaoTuoi::where('soDienThoaiNCC',$request->soDienThoaiNCC)->count() >0){
                return response()->json(['errors'=>'Số điện thoại này đã tồn tại']);
            }
            
            if($request->hasFile('anhDaiDienNCC')) {
                $path = $request->file('anhDaiDienNCC')->store('elderly/anhDaiDien', 'public');
                $data['anhDaiDienNCC'] = $path;
            }
            if($request->hasFile('anhDon')) {
                $path = $request->file('anhDon')->store('elderly/anhDon', 'public');
                $data['anhDon'] = $path;
            }
            if($request->hasFile('anhToKhaiDeNghiTroGiup')) {
                $path = $request->file('anhToKhaiDeNghiTroGiup')->store('elderly/anhToKhaiDeNghi', 'public');
                $data['anhToKhaiDeNghiTroGiup'] = $path;
            }
            if($request->hasFile('anhSoYeuLyLich')) {
                $path = $request->file('anhSoYeuLyLich')->store('elderly/anhSoYeuLyLich', 'public');
                $data['anhSoYeuLyLich'] = $path;
            }
            if($request->hasFile('anhGiayChungNhanHIV')) {
                $path = $request->file('anhGiayChungNhanHIV')->store('elderly/anhChungNhanHIV', 'public');
                $data['anhGiayChungNhanHIV'] = $path;
            }else{
                $data['anhGiayChungNhanHIV'] = null;
            }
            HoSoNguoiCaoTuoi::insert($data);
            Toastr::success('Đăng ký thành công', 'Thành công',);
            return response()->json([
                'status' => 200,
                'message' => "Thêm thành công",
                'success' => 'Đăng ký thành công. Trung tâm sẽ xem xét và phản hồi sớm nhất.'
            ]);
        }
    }

    // Danh sách người cao tuổi
    public function list_elderly(){
        if(Gate::allows('nguoithan')) {
            $title = "Danh sách người cao tuổi";
            $id = Auth::user()->id;
            $count = 3;
            $title_filter = "Tất cả hồ sơ";
            $elderly_records = HoSoNguoiCaoTuoi::where('id_nguoidung',$id)->get();

            return view('client.NguoiThan.list_elderly', compact('title','elderly_records','count','title_filter'));
        }
        return redirect()->back();
    }

    // Lọc hồ sơ
    public function filter_elderly(Request $request){
        if(Gate::allows('nguoithan')) {
            $title = "Danh sách người cao tuổi";

            $id = Auth::user()->id;
            $count = $request->filter_hs;

            if($count == 3){
                // Tát cả hồ sơ
                $title_filter = "Tất cả hồ sơ";
                $elderly_records = HoSoNguoiCaoTuoi::where('id_nguoidung',$id)->get();
            }elseif($count==1){
                // Hồ sơ đang hoạt động
                $title_filter = "Hồ sơ đang hoạt động";
                $elderly_records = HoSoNguoiCaoTuoi::where('id_nguoidung',$id)
                ->where('tinhTrangNCC',1)->get();
            }elseif($count==0){
                // Hồ sơ đang chờ duyệt
                $title_filter = "Hồ sơ đang chờ duyệt";
                $elderly_records = HoSoNguoiCaoTuoi::where('id_nguoidung',$id)
                ->where('tinhTrangNCC',0)->get();
            }else{
                // Hồ sơ đang bị khoá
                $title_filter = "Hồ sơ đang bị khoá";
                $elderly_records = HoSoNguoiCaoTuoi::where('id_nguoidung',$id)
                ->where('tinhTrangNCC',2)->get();
            }

            return view('client.NguoiThan.list_elderly', compact('title','count','elderly_records','title_filter'));
        }
        return redirect()->back();
    }

    // Xem chi tiết hồ sơ người cao tuổi
    public function detail_elderly(Request $request, $id){
        $title = "Chi tiết người cao tuổi";
        $date = Carbon::today()->toDateString();

        $ncc = HoSoNguoiCaoTuoi::find($id);
        $benhan = BenhAn::where('id_nguoiCaoTuoi',$id)
        ->orderBy('ngayKham','desc')
        ->get();
        $thsk = TinhHinhSucKhoe::where('id_nguoicaotuoi',$id)
        ->whereDate('ngayKham','=',$date)
        ->get();

        return view('client.NguoiThan.ChiTietNguoiCaoTuoi.detail_elderly',compact('title','ncc','benhan','thsk','date'));
    }

    // Tìm kiếm tình hình sức khoẻ theo ngày
    public function search_health_situation(Request $request,$id){
        if(Gate::allows('nguoithan')) {

            $title = "Chi tiết người cao tuổi";
            $date = $request->search_date;
            $ncc = HoSoNguoiCaoTuoi::find($id);
            $benhan = BenhAn::where('id_nguoiCaoTuoi',$id)->get();
            $thsk = TinhHinhSucKhoe::where('id_nguoicaotuoi',$id)
            ->whereDate('ngayKham','=',$date)
            ->get();

            $donthuoc = ThuocDieuTri::orderBy('id_thuocDieuTri','desc')
            ->join('tbl_thuoc','tbl_thuoc.id_thuoc','=','tbl_thuocdieutri.id_thuoc')
            ->get();

            return view('client.NguoiThan.ChiTietNguoiCaoTuoi.detail_elderly', compact('title','ncc','benhan','thsk','date','donthuoc'));
        }
        return redirect()->back();

    }

    // // Xem đơn thuốc theo mã bệnh án
    // public function prescription_elderly(Request $request,$id){
    //     if(Gate::allows('nguoithan')) {
    //         $title = "Chi tiết người cao tuổi";
    //         $date = $request->search_date;
    //         $ncc = HoSoNguoiCaoTuoi::find($id);
    //         $benhan = BenhAn::where('id_nguoiCaoTuoi',$id)->get();
    //         $thsk = TinhHinhSucKhoe::where('id_nguoicaotuoi',$id)
    //         ->whereDate('ngayKham','=',$date)
    //         ->get();
    //         $id_benhan = Session::get('id_benhan');
    //         $donthuoc = ThuocDieuTri::where('id_benhAn',$id_benhan)
    //         ->join('tbl_thuoc','tbl_thuoc.id_thuoc','=','tbl_thuocdieutri.id_thuoc')
    //         ->get();

    //         return view('client.NguoiThan.ChiTietNguoiCaoTuoi.detail_elderly', compact('title','ncc','benhan','thsk','date','donthuoc'));
    //     }
    //     return redirect()->back();
    // }

    // In đơn thuốc
    public function prescription_pdf($id){
        $pdf = App::make('dompdf.wrapper');
        $pdf->loadHTML($this->print_medicine_convert($id));
        return $pdf->stream();
    }

    public function print_medicine_convert($id){
        $tdt = ThuocDieuTri::where('id_benhAn',$id)
        ->join('tbl_thuoc','tbl_thuoc.id_thuoc','=','tbl_thuocdieutri.id_thuoc')
        ->get();
        $benhAn = BenhAn::find($id);
        $ncc = HoSoNguoiCaoTuoi::find($benhAn->id_nguoiCaoTuoi);
        $age = Carbon::parse($ncc->ngaySinhNCC)->age;
        $day = Carbon::parse($benhAn->ngayKham)->day;
        $month = Carbon::parse($benhAn->ngayKham)->month;
        $year = Carbon::parse($benhAn->ngayKham)->year;
        // $randomNumber = random_int(1000, 9999);
        return view('admin.NhanVienYTe.CapNhatBenhAn.CapNhatThuocDieuTri.pdf', compact('tdt','benhAn','ncc','age','day','month','year'));
    }
}
