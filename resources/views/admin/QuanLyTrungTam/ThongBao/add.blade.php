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
            <a>Quản lý thông báo</a>
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
                <form class="js-validation-bootstrap form-horizontal" action="{{route('save_notification')}}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label class="col-md-3 control-label " for="val-username">Chủ đề <span class="text-danger">*</span></label>
                        <div class="col-md-9">
                            <input name="chuDe" class="form-control maintb" type="text" placeholder="Nhập chủ đề thông báo">
                            <span style="color: red;">
                                @error('chuDe')
                                {{$message}}
                                @enderror
                            </span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label" for="val-username">Nội dung <span class="text-danger">*</span></label>
                        <div class="col-md-9">
                            <textarea style="resize: none" rows="4" name="noiDung" class="form-control contenttb" id="ckeditor1" placeholder="Nhập nội dung thông báo"></textarea>
                            <span style="color: red;">
                                @error('noiDung')
                                {{$message}}
                                @enderror
                            </span>
                        </div>
                        
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label date-tb" for="val-username">Thời gian đăng <span class="text-danger">*</span></label>
                        <div class="col-md-9">
                            <input name="thoiGianDang" class="form-control datetb" type="date">
                            <span style="color: red;">
                                @error('thoiGianDang')
                                {{$message}}
                                @enderror
                            </span>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-8 col-md-offset-3">
                            <a href="{{route('notification.all')}}" class="btn btn-instagram" type="button">Quay lại</a>
                            <button class="btn  btn-success save_notification" type="submit">Thêm</button>
                        </div>
                    </div>
                </form>
        </div>  
    </div>
</div>
<!--End row-->
@endsection
