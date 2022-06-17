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
            <a>Quản lý nhân viên</a>
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
        <div class="white-box">
                
                <form class="js-validation-bootstrap form-horizontal" action="{{route('employee.update',$employee->id)}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <h4 class="text-center">Thông tin nhân viên</h4>
                    <div class="form-group">
                        <label class="col-md-3 control-label " for="val-username">Họ tên nhân viên: <span class="text-danger">*</span></label>
                        <div class="col-md-9">
                            <input name="hoTen" value="{{$employee->hoTen}}" class="form-control" type="text" placeholder="Nhập họ tên nhân viên">
                            <span style="color: red;">
                                @error('hoTen')
                                {{$message}}
                                @enderror
                            </span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label " for="val-username">Loại nhân viên: <span class="text-danger">*</span></label>
                        <div class="col-md-9" style="display: flex">
                            <select class="form-control" id="val-skill" name="loaiTaiKhoan">
                                @if ($employee->loaiTaiKhoan == 1)
                                    <option value="1">Nhân viên kho</option>
                                    <option value="2">Nhân viên y tế</option>
                                @else
                                    <option value="2">Nhân viên y tế</option>
                                    <option value="1">Nhân viên kho</option>
                                @endif
                                
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label " for="val-username">Email: <span class="text-danger">*</span></label>
                        <div class="col-md-9">
                            <input name="email" value="{{$employee->email}}" class="form-control" type="text" placeholder="Nhập email">
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
                                    <label><input name="gioiTinh" value="1" type="radio" {{$employee->gioiTinh==1?'checked':''}}> Nam</label>
                                </span>
                                <span style="margin-left: 20px">
                                    <label><input name="gioiTinh" value="0" type="radio" {{$employee->gioiTinh==0?'checked':''}}> Nữ</label>
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
                            <input name="ngaySinh" value="{{$employee->ngaySinh}}" class="form-control" type="date">
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
                            <input name="anhDaiDien" class="form-control" value="{{$employee->anhDaiDien}}" type="file">
                            <div id="large12" style="display: none;" class="cover-image-ncc">
                                <img src="{{asset('public/storage/'.$employee->anhDaiDien)}}" alt="">
                                <div id="close12" class="close-ncc">&times</div>
                            </div>
                            <img id="small12" class="small-nd" src="{{asset('public/storage/'.$employee->anhDaiDien)}}" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label " for="val-username">Số căn cước công dân: <span class="text-danger">*</span></label>
                        <div class="col-md-9">
                            <input name="CCCD" placeholder="Nhập số căn cước công dân" value="{{$employee->CCCD}}" class="form-control" type="text">
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
                            <input name="soDienThoai" placeholder="Nhập số điện thoại" value="{{$employee->soDienThoai}}" class="form-control" type="text">
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
                            <input name="diaChi" placeholder="Nhập địa chỉ" value="{{$employee->diaChi}}" class="form-control" type="text">
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
                            <input name="name" value="{{$employee->name}}" class="form-control" type="text" disabled>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label " for="val-username">Ngày đăng ký: <span class="text-danger">*</span></label>
                        <div class="col-md-9">
                            <input name="ngayDangKy"  value="{{$employee->ngayDangKy}}" class="form-control" type="date" disabled>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label " for="val-username">Người thêm: <span class="text-danger">*</span></label>
                        <div class="col-md-9">
                            <input name="ngayDangKy"  value="{{$employee->nguoiDuyet}}" class="form-control" disabled>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-8 col-md-offset-3">
                            <a href="{{route('employee.all')}}" class="btn  btn-instagram" type="button">Quay lại</a>
                            <button class="btn btn-success save_employee" type="submit">Cập nhật</button>
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
            $('#close12').click(function(){
                $("#large12").hide();
                $("#small12").show();
            });

            $('#small12').click(function(){
                $("#large12").show();
                $("#small12").hide();
            });
            
            
        });
    </script>
@endsection