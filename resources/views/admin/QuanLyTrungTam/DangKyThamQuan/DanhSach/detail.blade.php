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
            <h2 class="header-title">Chi tiết đơn đăng ký</h2>
                
                <form name="form1" class="js-validation-bootstrap form-horizontal" action="{{route('registerToVisit.update',$dangkythamquan->id_dangky)}}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label class="col-md-3 control-label " for="val-username">Mã đơn đăng ký</label>
                        <div class="col-md-9">
                            <input name="nguoiDaiDienDK" value="{{$dangkythamquan->id_dangky}}" class="form-control" type="text" disabled>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label " for="val-username">Tên người đại diện<span class="text-danger">*</span></label>
                        <div class="col-md-9">
                            <input name="nguoiDaiDienDK" value="{{$dangkythamquan->nguoiDaiDienDK}}" class="form-control" type="text" placeholder="Nhập tên người đại diện">
                            <span style="color: red;">
                                @error('nguoiDaiDienDK')
                                {{$message}}
                                @enderror
                            </span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label " for="val-username">Số lượng người tham quan<span class="text-danger">*</span></label>
                        <div class="col-md-9">
                            <input name="soLuongDK" value="{{$dangkythamquan->soLuongDK}}" class="form-control" type="text" placeholder="Nhập số lượng người tham quan">
                            <span style="color: red;">
                                @error('soLuongDK')
                                {{$message}}
                                @enderror
                            </span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label " for="val-username">Email<span class="text-danger">*</span></label>
                        <div class="col-md-9">
                            <input name="emailDK" value="{{$dangkythamquan->emailDK}}" class="form-control" type="email" placeholder="Nhập email">
                            <span style="color: red;">
                                @error('emailDK')
                                {{$message}}
                                @enderror
                            </span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label " for="val-username">Số điện thoại<span class="text-danger">*</span></label>
                        <div class="col-md-9">
                            <input name="soDienThoaiDK" value="{{$dangkythamquan->soDienThoaiDK}}" class="form-control" type="text" placeholder="Nhập số điện thoại">
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
                            <textarea style="resize: none" rows="3" name="ghiChuDK" class="form-control" placeholder="Nhập ghi chú">{{$dangkythamquan->ghiChuDK}}</textarea>
                            <span style="color: red;">
                                @error('ghiChuDK')
                                {{$message}}
                                @enderror
                            </span>
                        </div>
                        
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label date-tb" for="val-username">Ngày tham quan <span class="text-danger">*</span></label>
                        <div class="col-md-9">
                            <input name="ngayThamQuanDK" id="txtDate" value="{{$dangkythamquan->ngayThamQuanDK}}" class="form-control" type="date">
                            <span style="color: red;">
                                @error('ngayThamQuanDK')
                                {{$message}}
                                @enderror
                            </span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label date-tb" for="val-username">Thời gian tham quan <span class="text-danger">*</span></label>
                        <div class="col-md-9">
                            <input name="thoigianTQ" value="{{$dangkythamquan->thoigianTQ}}" class="form-control" type="time">
                            <span style="color: red;">
                                @error('thoigianTQ')
                                {{$message}}
                                @enderror
                            </span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label " for="val-username">Ngày đăng ký: </label>
                        <div class="col-md-9">
                            <input name="sdtndd" class="form-control sdtndd" type="date" value="{{$dangkythamquan->ngayDangKyDK}}" disabled>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label " for="val-username">Ngày duyệt: </label>
                        <div class="col-md-9">
                            <input name="sdtndd" class="form-control sdtndd" type="date" value="{{$dangkythamquan->ngayDuyetDK}}" disabled>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label " for="val-username">Người duyệt: </label>
                        <div class="col-md-9">
                            <input name="sdtndd" class="form-control sdtndd" type="text" value="{{$dangkythamquan->hoTen}}" disabled>
                        </div>
                    </div>
                    <div class="form-group">
                      <div class="col-md-8 col-md-offset-3">
                        <a href="{{route('registerToVisit.all')}}" class="btn btn-instagram" type="button">Quay lại</a>
                        <button class="btn btn-success update_registerToVisit" type="submit">Cập nhật</button>
                      </div>
                    </div>
                </form>
        </div>  
    </div>
</div>
<!--End row-->
@endsection

@section('ajax_js')
    <script>
        $(function(){
            var dtToday = new Date();
            
            var month = dtToday.getMonth() + 1;
            var day = dtToday.getDate();
            var year = dtToday.getFullYear();
            if(month < 10)
                month = '0' + month.toString();
            if(day < 10)
                day = '0' + day.toString();
            var maxDate = year + '-' + month + '-' + day;
            // or instead:
            // var maxDate = dtToday.toISOString().substr(0, 10);
            $('#txtDate').attr('min', maxDate);
        });
    </script>
@endsection