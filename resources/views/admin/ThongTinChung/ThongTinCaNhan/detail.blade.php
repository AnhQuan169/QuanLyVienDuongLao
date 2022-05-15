@extends('admin.admin_layout')
@section('admin_content')
<!--Start Page Title-->
<div class="page-title-box">
    <h4 class="page-title">{{$title}}</h4>
    <ol class="breadcrumb">
        <li>
            <a href="{{route('dashboard')}}">Dashboard</a>
        </li>
        <li class="active">
            <a href="{{$url}}">{{$title}}</a>
        </li>
    </ol>
    <div class="clearfix"></div>
</div>
<!--End Page Title-->   

<!--Start row-->
<div class="row">
    <div class="col-md-12">
        <!-- Start cover-->
        <div class="profile-cover">
            <div class="overlay-profile"></div>
                <div class="profile-inner">
                    <div class="profile-info">
                        <div class="profile-media">
                            <img src="{{asset('public/admin/uploads/users/'.$user->anhDaiDien)}}" alt="" />
                        </div>
                        <div class="profile-intro">
                            <h4>{{$user->hoTen}}</h4>
                            <p></p>
                            <ul>
                                <li> <i class="fa fa-map-marker"></i>  {{$user->diaChi}} </li>
                                <li> <i class="fa fa-envelope-o"></i>  {{$user->email}} </li>
                            </ul>
                        </div>
                        
                    </div> <!--/.profile-info-->
                    
                </div>
        </div>    
        <!-- End cover-->
        
    </div>
</div>

<!--Start row-->
<div class="row">
    <div class="col-md-12">
        <div class="white-box">
                
                <form class="js-validation-bootstrap form-horizontal" action="{{route('admin.profile.update',$user->id)}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <h4 class="text-center">Thông tin người dùng</h4>
                    <div class="form-group">
                        <label class="col-md-3 control-label " for="val-username">Họ tên người dùng: <span class="text-danger">*</span></label>
                        <div class="col-md-9">
                            <input name="hoTen" value="{{$user->hoTen}}" class="form-control" type="text" placeholder="Nhập họ tên người dùng">
                            <span style="color: red;">
                                @error('hoTen')
                                {{$message}}
                                @enderror
                            </span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label " for="val-username">Email: <span class="text-danger">*</span></label>
                        <div class="col-md-9">
                            <input name="email" value="{{$user->email}}" class="form-control" type="text" placeholder="Nhập email">
                            <span style="color: red;">
                                @error('email')
                                {{$message}}
                                @enderror
                            </span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label " for="val-username">Giới tính: <span class="text-danger">*</span></label>
                        <div class="col-md-9">
                            <div style="margin-top: 5px;">
                                <span>
                                    <label><input name="gioiTinh" value="1" type="radio" {{$user->gioiTinh==1?'checked':''}}> Nam</label>
                                </span>
                                <span style="margin-left: 20px">
                                    <label><input name="gioiTinh" value="0" type="radio" {{$user->gioiTinh==0?'checked':''}}> Nữ</label>
                                </span>
                            </div>
                            <span style="color: red;">
                                @error('gioiTinh')
                                {{$message}}
                                @enderror
                            </span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label " for="val-username">Ngày sinh: <span class="text-danger">*</span></label>
                        <div class="col-md-9">
                            <input name="ngaySinh" value="{{$user->ngaySinh}}" class="form-control" type="date">
                            <span style="color: red;">
                                @error('ngaySinh')
                                {{$message}}
                                @enderror
                            </span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label " for="val-username">Ảnh đại diện: <span class="text-danger">*</span></label>
                        <div class="col-md-9">
                            <input name="anhDaiDien" class="form-control" value="{{$user->anhDaiDien}}" type="file">
                            <div id="large12" style="display: none;" class="cover-image-ncc">
                                <img src="{{asset('public/admin/uploads/users/'.$user->anhDaiDien)}}" alt="">
                                <div id="close12" class="close-ncc">&times</div>
                            </div>
                            <img id="small12" class="small-nd" src="{{asset('public/admin/uploads/users/'.$user->anhDaiDien)}}" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label " for="val-username">Số căn cước công dân: <span class="text-danger">*</span></label>
                        <div class="col-md-9">
                            <input name="CCCD" placeholder="Nhập số căn cước công dân" value="{{$user->CCCD}}" class="form-control" type="text">
                            <span style="color: red;">
                                @error('CCCD')
                                {{$message}}
                                @enderror
                            </span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label " for="val-username">Số điện thoại: <span class="text-danger">*</span></label>
                        <div class="col-md-9">
                            <input name="soDienThoai" placeholder="Nhập số điện thoại" value="{{$user->soDienThoai}}" class="form-control" type="text">
                            <span style="color: red;">
                                @error('soDienThoai')
                                {{$message}}
                                @enderror
                            </span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label " for="val-username">Địa chỉ: <span class="text-danger">*</span></label>
                        <div class="col-md-9">
                            <input name="diaChi" placeholder="Nhập địa chỉ" value="{{$user->diaChi}}" class="form-control" type="text">
                            <span style="color: red;">
                                @error('diaChi')
                                {{$message}}
                                @enderror
                            </span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label " for="val-username">Tên tài khoản: <span class="text-danger">*</span></label>
                        <div class="col-md-9">
                            <input name="name" value="{{$user->name}}" class="form-control" type="text" disabled>
                        </div>
                    </div>
                    <input name="password"  value="{{$user->password}}" class="form-control" type="hidden">
                    <div class="form-group">
                        <label class="col-md-3 control-label " for="val-username">Ngày đăng ký: <span class="text-danger">*</span></label>
                        <div class="col-md-9">
                            <input name="ngayDangKy"  value="{{$user->ngayDangKy}}" class="form-control" type="date" disabled>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label " for="val-username">Ngày duyệt: <span class="text-danger">*</span></label>
                        <div class="col-md-9">
                            <input name="ngayDangKy"  value="{{$user->ngayDuyet}}" class="form-control" type="date" disabled>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label " for="val-username">Người duyệt: <span class="text-danger">*</span></label>
                        <div class="col-md-9">
                            <input name="ngayDangKy"  value="{{$user->nguoiDuyet}}" class="form-control" disabled>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-8 col-md-offset-3">
                            <a href="{{route('dashboard')}}" class="btn  btn-instagram" type="button">Quay lại</a>
                            <button class="btn  btn-success save_user" type="submit">Cập nhật</button>
                        </div>
                    </div>
                </form>
        </div>  
    </div>
</div>
<!--End row--> 

@endsection