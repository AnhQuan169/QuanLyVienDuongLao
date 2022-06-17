@extends('admin.admin_layout')
@section('admin_content')
<!--Start Page Title-->
<div class="page-title-box">
    <h4 class="page-title">{{$title}}</h4>
    <ol class="breadcrumb">
        <li>
            <a href="{{route('dashboard')}}">Dashboard</a>
        </li>
        <li>
            <a>Quản lý người dùng</a>
        </li>
        <li class="active">
            <a href="{{$url}}">{{$title}}</a>
        </li>
    </ol>
    <div class="clearfix"></div>
</div>

<!--Start row-->
<div class="row">
    <div class="col-md-12">
        <div class="white-box">
            <h2 class="header-title">{{$title}}</h2>
                <form class="js-validation-bootstrap form-horizontal">
                    {{-- @csrf --}}
                    <div class="form-group">
                        <label class="col-md-3 control-label " for="val-username">Mã đăng ký: </label>
                        <div class="col-md-9">
                            <input name="maDangKy" class="form-control maintb" type="text" value="{{$user->id}}" disabled>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label " for="val-username">Ảnh đại diện: </label>
                        <div class="col-md-9">
                            <div id="large11" style="display: none;" class="cover-image-ncc">
                                {{-- <img src="{{asset('public/admin/uploads/users/'.$user->anhDaiDien)}}" alt=""> --}}
                                <img src="{{asset('public/storage/'.$user->anhDaiDien)}}" width="150px" />
                                <div id="close11" class="close-ncc">&times</div>
                            </div>
                            <img id="small11" class="small-nd" src="{{asset('public/storage/'.$user->anhDaiDien)}}" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label " for="val-username">Họ tên: </label>
                        <div class="col-md-9">
                            <input name="hoTen" class="form-control maintb" type="text" value="{{$user->hoTen}}" disabled>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label " for="val-username">Email: </label>
                        <div class="col-md-9">
                            <input name="email" class="form-control maintb" type="text" value="{{$user->email}}" disabled>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label " for="val-username">Giói tính: </label>
                        <div class="col-md-9">
                            <input name="gioiTinh" class="form-control maintb" type="text" value="{{$user->gioiTinh == 1 ? 'Nam' : 'Nữ' }}" disabled>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label " for="val-username">Ngày sinh: </label>
                        <div class="col-md-9">
                            <input name="ngaySinh" class="form-control maintb" type="text" value="{{date('d-m-Y', strtotime($user->ngaySinh))}}" disabled>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label " for="val-username">Số căn cước công dân: </label>
                        <div class="col-md-9">
                            <input name="soCCCD" class="form-control maintb" type="text" value="{{$user->CCCD}}" disabled>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label " for="val-username">Số điện thoại: </label>
                        <div class="col-md-9">
                            <input name="soDienThoai" class="form-control maintb" type="text" value="{{$user->soDienThoai}}" disabled>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label " for="val-username">Địa chỉ: </label>
                        <div class="col-md-9">
                            <input name="diaChi" class="form-control maintb" type="text" value="{{$user->diaChi}}" disabled>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label " for="val-username">Ngày đăng ký: </label>
                        <div class="col-md-9">
                            <input name="ngayDangKy" class="form-control maintb" type="text" value="{{date('d-m-Y', strtotime($user->ngayDangKy))}}" disabled>
                        </div>
                    </div>
                    
                    
                    <div class="form-group">
                        <div class="col-md-8 col-md-offset-3">
                            <a href="{{route('browseuser.all')}}" class="btn  btn-instagram" type="button">Quay lại</a>
                            <a href="{{route('browseuser.save',$user->id)}}" class="btn  btn-success update-browse" type="button">Duyệt</a>
                        </div>
                    </div>
                </form>
        </div>  
    </div>
</div>
<!--End row-->
@endsection
@section('ajax_js')
    <script type="text/javascript">
        $(document).ready(function(){
            // Ảnh đại diện
            $('#close11').click(function(){
                $("#large11").hide();
                $("#small11").show();
            });

            $('#small11').click(function(){
                $("#large11").show();
                $("#small11").hide();
            });
            
        });
    </script>
@endsection
