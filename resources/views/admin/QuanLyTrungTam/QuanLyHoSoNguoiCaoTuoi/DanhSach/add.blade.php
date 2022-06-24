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
            <a>Quản lý hố sơ người cao tuổi</a>
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
                
                <form class="js-validation-bootstrap form-horizontal" action="{{route('elderly.save')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    
                    <div class="form-group">
                        <label class="col-md-3 control-label " for="val-username">Họ tên: <span class="text-danger">*</span></label>
                        <div class="col-md-9">
                            <input name="hoTenNCC" placeholder="Nhập họ tên" value="{{old('hoTenNCC')}}" class="form-control" type="text">
                            <span style="color: red;">
                                @error('hoTenNCC')
                                {{$message}}
                                @enderror
                            </span>
                        </div>
                        
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label " for="val-username">Người giám hộ: <span class="text-danger">*</span></label>
                        <div class="col-md-9" style="display: flex">
                            <select class="form-control" id="val-skill" name="id_nguoidung">
                                <option value="1">Trung tâm</option>
                                @foreach ($user as $key => $usernd )
                                    <option value="{{$usernd->id}}">{{$usernd->hoTen}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label " for="val-username">Giới tính: <span class="text-danger">*</span></label>
                        <div class="col-md-9">
                            <div style="margin-top: 5px;">
                                <span>
                                    <label><input name="gioiTinhNCC" value="1" type="radio" checked> Nam</label>
                                </span>
                                <span style="margin-left: 20px">
                                    <label><input name="gioiTinhNCC" value="0" type="radio"> Nữ</label>
                                </span>
                            </div>
                            <span style="color: red;">
                                @error('gioiTinhNCC')
                                {{$message}}
                                @enderror
                            </span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label " for="val-username">Ngày sinh: <span class="text-danger">*</span></label>
                        <div class="col-md-9">
                            <input name="ngaySinhNCC" value="{{old('ngaySinhNCC')}}" class="form-control" type="date">
                            <span style="color: red;">
                                @error('ngaySinhNCC')
                                {{$message}}
                                @enderror
                            </span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label " for="val-username">Ảnh đại diện: <span class="text-danger">*</span></label>
                        <div class="col-md-9">
                            <input name="anhDaiDienNCC" class="form-control" type="file">
                            <span style="color: red;">
                                @error('anhDaiDienNCC')
                                {{$message}}
                                @enderror
                            </span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label " for="val-username">Số căn cước công dân: <span class="text-danger">*</span></label>
                        <div class="col-md-9">
                            <input name="CCCD_NCC" placeholder="Nhập số căn cước công dân" value="{{old('CCCD_NCC')}}" class="form-control" type="text">
                            <span style="color: red;">
                                @error('CCCD_NCC')
                                {{$message}}
                                @enderror
                            </span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label " for="val-username">Số điện thoại: <span class="text-danger">*</span></label>
                        <div class="col-md-9">
                            <input name="soDienThoaiNCC" placeholder="Nhập số điện thoại" value="{{old('soDienThoaiNCC')}}" class="form-control" type="text">
                            <span style="color: red;">
                                @error('soDienThoaiNCC')
                                {{$message}}
                                @enderror
                            </span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label " for="val-username">Địa chỉ: <span class="text-danger">*</span></label>
                        <div class="col-md-9">
                            <input name="diaChiNCC" placeholder="Nhập địa chỉ" value="{{old('diaChiNCC')}}" class="form-control" type="text">
                            <span style="color: red;">
                                @error('diaChiNCC')
                                {{$message}}
                                @enderror
                            </span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label " for="val-username">Ảnh đơn đăng ký của đối tượng hoặc người giám hộ (Theo mẫu): <span class="text-danger">*</span></label>
                        <div class="col-md-9">
                            <input name="anhDon" class="form-control" type="file">
                            <span style="color: red;">
                                @error('anhDon')
                                {{$message}}
                                @enderror
                            </span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label " for="val-username">Ảnh tờ khai đề nghị trợ giúp (Có công chứng, theo mẫu): <span class="text-danger">*</span></label>
                        <div class="col-md-9">
                            <input name="anhToKhaiDeNghiTroGiup" class="form-control" type="file">
                            <span style="color: red;">
                                @error('anhToKhaiDeNghiTroGiup')
                                {{$message}}
                                @enderror
                            </span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label " for="val-username">Ảnh sơ yếu lý lịch (Có công chứng, theo mẫu): <span class="text-danger">*</span></label>
                        <div class="col-md-9">
                            <input name="anhSoYeuLyLich" class="form-control" type="file">
                            <span style="color: red;">
                                @error('anhSoYeuLyLich')
                                {{$message}}
                                @enderror
                            </span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label " for="val-username">Ảnh giấy chứng nhận HIV nếu trường hợp đối tượng là người nhiễm HIV (Nếu có):</label>
                        <div class="col-md-9">
                            <input name="anhGiayChungNhanHIV" class="form-control" type="file">
                        </div>
                    </div>
                    {{-- Thông tin được thêm sau khi được duyệt --}}
                    <div class="form-group">
                        <label class="col-md-3 control-label " for="val-username">Vị trí phòng ở: <span class="text-danger">*</span></label>
                        <div class="col-md-9">
                            <input name="phong" placeholder="Nhập vị trí phòng ở" value="{{old('phong')}}" class="form-control" type="text">
                            <span style="color: red;">
                                @error('phong')
                                {{$message}}
                                @enderror
                            </span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label " for="val-username">Vị trí giường: <span class="text-danger">*</span></label>
                        <div class="col-md-9">
                            <input name="giuong" placeholder="Nhập vị trí giường" value="{{old('giuong')}}" class="form-control" type="text">
                            <span style="color: red;">
                                @error('giuong')
                                {{$message}}
                                @enderror
                            </span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label " for="val-username">Ngày vào ở: <span class="text-danger">*</span></label>
                        <div class="col-md-9">
                            <input name="ngayVao" placeholder="Chọn ngày vào ở" value="{{old('ngayVao')}}" class="form-control" type="date">
                            <span style="color: red;">
                                @error('ngayVao')
                                {{$message}}
                                @enderror
                            </span>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-8 col-md-offset-3">
                            <a href="{{route('elderly.all')}}" class="btn  btn-instagram" type="button">Quay lại</a>
                            <button class="btn  btn-success save_elderly" type="submit">Thêm mới</button>
                        </div>
                    </div>
                </form>
        </div>  
    </div>
</div>
<!--End row-->
@endsection