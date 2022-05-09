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
            <a>Quản lý đơn đăng ký tham quan trung tâm</a>
        </li>
        <li class="active">
            <a href="{{route('registerToVisit.detail',$dangkythamquan->id_dangky)}}}">{{$title}}</a>
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
                            <input name="chuDe" class="form-control maintb" type="text" value="{{$dangkythamquan->id_dangky}}" disabled>
                        </div>
                        </span>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label " for="val-username">Tên người đại diện: </label>
                        <div class="col-md-9">
                            <input name="chuDe" class="form-control maintb" type="text" value="{{$dangkythamquan->nguoiDaiDien}}" disabled>
                        </div>
                        </span>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label " for="val-username">Số lượng người tham quan: </label>
                        <div class="col-md-9">
                            <input name="chuDe" class="form-control maintb" type="text" value="{{$dangkythamquan->soLuong}}" disabled>
                        </div>
                        </span>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label " for="val-username">Email: </label>
                        <div class="col-md-9">
                            <input name="chuDe" class="form-control maintb" type="text" value="{{$dangkythamquan->email}}" disabled>
                        </div>
                        </span>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label " for="val-username">Số điện thoại: </label>
                        <div class="col-md-9">
                            <input name="chuDe" class="form-control maintb" type="text" value="{{$dangkythamquan->soDienThoaiDK}}" disabled>
                        </div>
                        </span>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label " for="val-username">Ghi chú: </label>
                        <div class="col-md-9">
                            <input name="chuDe" class="form-control maintb" type="text" value="{{$dangkythamquan->ghiChu}}" disabled>
                        </div>
                        </span>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label " for="val-username">Ngày tham quan: </label>
                        <div class="col-md-9">
                            <input name="chuDe" class="form-control maintb" type="text" value="{{date('d-m-Y', strtotime($dangkythamquan->ngayThamQuan))}}" disabled>
                        </div>
                        </span>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label " for="val-username">Ngày đăng ký: </label>
                        <div class="col-md-9">
                            <input name="chuDe" class="form-control maintb" type="text" value="{{date('d-m-Y', $dangkythamquan->ngayDangKy)}}" disabled>
                        </div>
                        </span>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label " for="val-username">Ngày duyệt: </label>
                        <div class="col-md-9">
                            <input name="chuDe" class="form-control maintb" type="text" value="{{date('d-m-Y', $dangkythamquan->ngayDuyet)}}" disabled>
                        </div>
                        </span>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label " for="val-username">Người duyệt: </label>
                        <div class="col-md-9">
                            <input name="chuDe" class="form-control maintb" type="text" value="{{$dangkythamquan->hoTen}}" disabled>
                        </div>
                        </span>
                    </div>
                    <div class="form-group">
                      <div class="col-md-8 col-md-offset-3">
                        <a href="{{route('registerToVisit.all')}}" class="btn  btn-primary" type="button">Quay lại</a>
                      </div>
                    </div>
                </form>
        </div>  
    </div>
</div>
<!--End row-->
@endsection
