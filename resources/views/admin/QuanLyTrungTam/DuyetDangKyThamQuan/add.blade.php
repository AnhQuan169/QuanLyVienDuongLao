@extends('admin.admin_layout')
@section('admin_content')
<!--Start Page Title-->
<div class="page-title-box">
    <h4 class="page-title">Thêm đăng ký tham quan mới</h4>
    <ol class="breadcrumb">
        <li>
            <a href="{{route('dashboard')}}">Dashboard</a>
        </li>
        <li>
            <a>Quản lý đơn đăng ký tham quan trung tâm</a>
        </li>
        <li class="active">
            <a href="{{route('registerToVisit.all')}}">Danh sách đăng ký tham quan</a>
        </li>
    </ol>
    <div class="clearfix"></div>
</div>
<!--End Page Title-->       


<!--Start row-->
<div class="row">
    <div class="col-md-12">
        <div class="white-box">
            <h2 class="header-title">Thêm đăng ký tham quan mới</h2>
                
                <form class="js-validation-bootstrap form-horizontal" action="{{route('registerToVisit.save')}}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label class="col-md-3 control-label " for="val-username">Tên người đại diện<span class="text-danger">*</span></label>
                        <div class="col-md-9">
                            <input name="nguoiDaiDien" class="form-control" type="text" placeholder="Nhập tên người đại diện">
                            <span style="color: red;">
                                @error('nguoiDaiDien')
                                {{$message}}
                                @enderror
                            </span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label " for="val-username">Số lượng người tham quan<span class="text-danger">*</span></label>
                        <div class="col-md-9">
                            <input name="soLuong" class="form-control" type="text" placeholder="Nhập số lượng người tham quan">
                            <span style="color: red;">
                                @error('soLuong')
                                {{$message}}
                                @enderror
                            </span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label " for="val-username">Email<span class="text-danger">*</span></label>
                        <div class="col-md-9">
                            <input name="email" class="form-control" type="email" placeholder="Nhập email">
                            <span style="color: red;">
                                @error('email')
                                {{$message}}
                                @enderror
                            </span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label " for="val-username">Số điện thoại<span class="text-danger">*</span></label>
                        <div class="col-md-9">
                            <input name="soDienThoaiDK" class="form-control" type="text" placeholder="Nhập số điện thoại">
                            <span style="color: red;">
                                @error('soDienThoaiDK')
                                {{$message}}
                                @enderror
                            </span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label" for="val-username">Ghi chú <span class="text-danger">*</span></label>
                        <div class="col-md-9">
                            <textarea style="resize: none" rows="3" name="ghiChu" class="form-control" placeholder="Nhập ghi chú"></textarea>
                            <span style="color: red;">
                                @error('ghiChu')
                                {{$message}}
                                @enderror
                            </span>
                        </div>
                        
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label date-tb" for="val-username">Ngày tham quan <span class="text-danger">*</span></label>
                        <div class="col-md-9">
                            <input name="ngayThamQuan" class="form-control" type="date">
                            <span style="color: red;">
                                @error('ngayThamQuan')
                                {{$message}}
                                @enderror
                            </span>
                        </div>
                    </div>
                    <div class="form-group">
                      <div class="col-md-8 col-md-offset-3">
                        <button class="btn  btn-primary save_registerToVisit" type="submit">Thêm mới</button>
                      </div>
                    </div>
                </form>
        </div>  
    </div>
</div>
<!--End row-->
@endsection
