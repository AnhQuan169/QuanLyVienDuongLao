<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\BaiViet;
use App\Models\HoSoNguoiCaoTuoi;
use App\Models\LienKet;
use App\Models\Slider;
use App\Models\ThongBao;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;
// Thư viện cho phép sử dụng Session
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Carbon;

class HomeController extends Controller
{
    // Trang chủ
    public function index(){
        $title = "Trung Tâm Nuôi Dưỡng Và Công Tác Xã Hội Tỉnh Thừa Thiên Huế";

        // Hiển thị 5 thông báo mới nhất
        $tbao = ThongBao::orderBy('thoiGianDang','desc')->limit(5)->get();

        // Hiển thị các liên kết với trung tâm
        $lienket = LienKet::orderBy('id_lienket','asc')->get();

        // Hiển thị Slider
        $slider = Slider::get();

        // Hiển thị các bài viết
        $baiviet = BaiViet::where('tinhTrang',1)
        ->orderBy('ngayDang','desc')->paginate(9);
        $date = now();

        return view('client.Layout.main', compact('title','tbao','lienket','slider','baiviet','date'));
    }

    // Xem thông tin trung tâm
    public function central_information(){
        $title = "Thông tin trung tâm";
        return view('client.ThongTinChung.central_information', compact('title'));
    }

    // Thủ tục đăng ký
    public function registration_procedure(){
        $title = "Thủ tục đăng ký";
        return view('client.ThongTinChung.registration_procedure', compact('title'));
    }

    // ========== Đăng ký ===============
    public function register_client(Request $request){
       
        $validator = Validator::make($request->all(), 
        [
            'hoTenc'=>'required',
            'emailc'=>'required',
            'gioiTinhc'=>'required',
            'ngaySinhc'=>'required|date',
            'anhDaiDienc'=>'required',
            'CCCDc'=>'required',
            'soDienThoaic'=>'required',
            'diaChic'=>'required'
        ], 
        [
            'hoTenc.required'=>'Vui lòng nhập họ tên người dùng',
            'emailc.required'=>'Vui lòng nhập email',
            'gioiTinhc.required'=>'Vui lòng chọn giới tính',
            'ngaySinhc.required'=>'Vui lòng chọn ngày sinh',
            'anhDaiDienc.required'=>'Vui lòng chọn ảnh đại diện',
            'CCCDc.required'=>'Vui lòng nhập số căn cước công dân',
            'soDienThoaic.required'=>'Vui lòng nhập số điện thoại',
            'diaChic.required'=>'Vui lòng nhập địa chỉ'
        ]);
        if($validator->fails()) {
            return response()->json([
                'status' => 400, 
                'error'=> $validator->errors()->toArray()
            ]);
        }else{
            $data = $request->all();
            
            // Xét sự trùng lặp các thông tin các tài khoản
            if(User::where('email',$request->emailc)->count() >0){
                return response()->json(['errors'=>'Địa chỉ email này đã tồn tại']);
            }
            if(User::where('CCCD',$request->CCCDc)->count() >0){
                return response()->json(['errors'=>'Số căn cước công dân này đã tồn tại']);
            }
            if(User::where('soDienThoai',$request->soDienThoaic)->count() >0){
                return response()->json(['errors'=>'Số điện thoại này đã tồn tại']);
            }
            
            if($request->hasFile('anhDaiDienc')) {
                $path = $request->file('anhDaiDienc')->store('users', 'public');
                $data['anhDaiDien'] = $path;
            }
            
            $infomationacc[] = array(
                'hoTen' =>$data['hoTenc'],
                'email' => $data['emailc'],
                'gioiTinh' =>$data['gioiTinhc'],
                'ngaySinh' =>$data['ngaySinhc'],
                'anhDaiDien' =>$data['anhDaiDien'],
                'CCCD' =>$data['CCCDc'],
                'soDienThoai' =>$data['soDienThoaic'],
                'diaChi' =>$data['diaChic']
            );
            Session::put('infomationacc',$infomationacc);
            return response()->json([
                'status' => 200,
                'message' => "Thêm thành công",
                'success'=>"Thêm thông tin cá nhân thành công"
            ]);
            
        }

    }

    public function account_client(Request $request){
        $validator = Validator::make($request->all(), 
        [
            'namec'=>'required|min:6|max:20',
            'passwordc'=>'required|min:6|max:20',
            'confirmpww'=>'required|same:passwordc'
        ], 
        [
            'namec.required'=>'Vui lòng nhập tên tài khoản',
            'passwordc.required'=>'Vui lòng nhập mật khẩu',
            'confirmpww.required'=>'Vui lòng nhập lại mật khẩu'
        ]);
        if($validator->fails()) {
            return response()->json([
                'status' => 400, 
                'error'=> $validator->errors()->toArray()
            ]);
        }else{
            $acc = Session::get('infomationacc');
            $data = array();

            if(User::where('name',$request->namec)->count() >0){
                return response()->json(['errors'=>'Tên đăng nhập này đã tồn tại']);
            }

            foreach($acc as $key => $val){
                $data['name'] = $request->namec;
                $data['email'] = $val['email'];
                $data['password'] = md5($request->passwordc);
                $data['hoTen'] = $val['hoTen'];
                $data['gioiTinh'] = $val['gioiTinh'];
                $data['ngaySinh'] = $val['ngaySinh'];
                $data['anhDaiDien'] = $val['anhDaiDien'];
                $data['CCCD'] = $val['email'];
                $data['soDienThoai'] = $val['soDienThoai'];
                $data['loaiTaiKhoan'] = 3;
                $data['diaChi'] = $val['diaChi'];
                $data['tinhTrang'] = 0;
                $data['ngayDangKy'] = now();
                $data['ngayDuyet'] = null;
                $data['nguoiDuyet'] = null;
                User::insert($data);
            }
            return response()->json([
                'status' => 200,
                'message' => "Thêm thành công",
                'success'=>"Đăng ký tài khoản thành công"
            ]);
            
        }
    }

    // ---------- Đăng nhập -----------
    public function login_client(Request $request){

        $user = User::where('name', $request->name)->first();
       
        if (empty($request->name)||empty($request->password)) {
            return response()->json(['error'=>'Tên người dùng hoặc mật khẩu không được để trống']);
        }

        if (!$user) {
            return response()->json(['error'=>'Tên người dùng không hợp lệ']);
        }
        if(Auth::attempt(['name'=> $request->name, 'password' => $request->password])){
            $user = User::where('name',$request->name)->first();
            if($user->loaiTaiKhoan == 3){
                if($user->tinhTrang == 1){
                    Auth::login($user);
                    Toastr::success('Đăng nhập thành công', 'Thành công',);
                    return response()->json(['success'=>'Đăng nhập thành công']);
                }else{
                    Auth::logout();
                    return response()->json(['error'=>'Tài khoản đang bị khoá']);
                }
            }else{
                Auth::logout();
                return response()->json(['error'=>'Bạn không có quyền thực hiện chức năng này']);
            }
            
        }else{
            Auth::logout();
            return response()->json(['error'=>'Tên tài khoản hoặc mật khẩu không đúng']);
        }
        
    }

    // Đăng xuất
    public function logout(){
        Auth::logout();
        Toastr::success('Đăng xuất thành công', 'Thành công',);
        return redirect()->route('home');
    }


    // Chi tiết bài đăng
    public function detail_posts(Request $request,$id){
        $title = 'Chi tiết bài viết';
        $url = $request->url();
        $post = BaiViet::find($id);

        // Hiển thị 5 thông báo mới nhất
        $tbao = ThongBao::orderBy('thoiGianDang','desc')->limit(5)->get();

        // Hiển thị các liên kết với trung tâm
        $lienket = LienKet::orderBy('id_lienket','asc')->get();

        $list_post = BaiViet::where('tinhTrang',1)
        ->whereNotIn('id_baiViet',[$id])
        ->orderBy('ngayDang','desc')->paginate(5);


        return view('client.ThongTinChung.BaiViet.detail', compact('title','url','post','tbao','lienket','list_post'));
    }

    public function detail_notification(Request $request,$id){
        $title = 'Chi tiết thông báo';
        $url = $request->url();
        $tbao_a = ThongBao::where('id_thongbao',$id)
        ->join('users','users.id','=','tbl_thongbao.id_quanlytrungtam')
        ->first();

        // Hiển thị 5 thông báo mới nhất
        $tbao = ThongBao::orderBy('thoiGianDang','desc')->limit(5)->get();

        // Hiển thị các liên kết với trung tâm
        $lienket = LienKet::orderBy('id_lienket','asc')->get();

        $list_tbao = ThongBao::whereNotIn('id_thongbao',[$id])
        ->orderBy('thoiGianDang','desc')->paginate(5);


        return view('client.ThongTinChung.ThongBao.detail', compact('title','url','tbao_a','tbao','lienket','list_tbao'));
    }
}

