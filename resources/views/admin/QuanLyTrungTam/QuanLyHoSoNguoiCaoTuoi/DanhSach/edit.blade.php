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
                
                <form class="js-validation-bootstrap form-horizontal" action="{{route('elderly.update',$elderly->id_nguoicaotuoi)}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <h4 class="text-center">Chi tiết thông tin hồ sơ {{$elderly->gioiTinhNCC==1?'ông':'bà'}} {{$elderly->hoTenNCC}}</h4>
                    <div class="form-group">
                        <label class="col-md-3 control-label " for="val-username">Mã hồ sơ: <span class="text-danger">*</span></label>
                        <div class="col-md-9">
                            <input name="hoTen" value="{{$elderly->id_nguoicaotuoi}}" class="form-control" type="text" disabled>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label " for="val-username">Họ tên: <span class="text-danger">*</span></label>
                        <div class="col-md-9">
                            <input name="hoTenNCC" placeholder="Nhập họ tên" value="{{$elderly->hoTenNCC}}" class="form-control" type="text">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label " for="val-username">Người giám hộ: <span class="text-danger">*</span></label>
                        <div class="col-md-9" style="display: flex">
                            <input name="email" value="{{$elderly->hoTen}}" class="form-control" type="text" disabled>
                            <a href="{{route('user.edit',$elderly->id)}}" class="btn  btn-primary" type="button">Chi tiết</a>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label " for="val-username">Giới tính: <span class="text-danger">*</span></label>
                        <div class="col-md-9">
                            <div style="margin-top: 5px;">
                                <span>
                                    <label><input name="gioiTinhNCC" value="1" type="radio" {{$elderly->gioiTinhNCC==1?'checked':''}}> Nam</label>
                                </span>
                                <span style="margin-left: 20px">
                                    <label><input name="gioiTinhNCC" value="0" type="radio" {{$elderly->gioiTinhNCC==0?'checked':''}}> Nữ</label>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label " for="val-username">Ngày sinh: <span class="text-danger">*</span></label>
                        <div class="col-md-9">
                            <input name="ngaySinhNCC" value="{{$elderly->ngaySinhNCC}}" class="form-control" type="date">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label " for="val-username">Ảnh đại diện: <span class="text-danger">*</span></label>
                        <div class="col-md-9">
                            <input name="anhDaiDienNCC" class="form-control" value="{{$elderly->anhDaiDienNCC}}" type="file">
                            <div id="large1" style="display: none;" class="cover-image-ncc">
                                <img src="{{asset('public/storage/'.$elderly->anhDaiDienNCC)}}" alt="">
                                <div id="close1" class="close-ncc">&times</div>
                            </div>
                            <img id="small1" class="small-nd" src="{{asset('public/storage/'.$elderly->anhDaiDienNCC)}}" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label " for="val-username">Số căn cước công dân: <span class="text-danger">*</span></label>
                        <div class="col-md-9">
                            <input name="CCCD_NCC" placeholder="Nhập số căn cước công dân" value="{{$elderly->CCCD_NCC}}" class="form-control" type="text">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label " for="val-username">Số điện thoại: <span class="text-danger">*</span></label>
                        <div class="col-md-9">
                            <input name="soDienThoaiNCC" placeholder="Nhập số điện thoại" value="{{$elderly->soDienThoaiNCC}}" class="form-control" type="text">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label " for="val-username">Địa chỉ: <span class="text-danger">*</span></label>
                        <div class="col-md-9">
                            <input name="diaChiNCC" placeholder="Nhập địa chỉ" value="{{$elderly->diaChiNCC}}" class="form-control" type="text">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label " for="val-username">Ảnh đơn đăng ký của đối tượng hoặc người giám hộ (Theo mẫu): <span class="text-danger">*</span></label>
                        <div class="col-md-9">
                            <input name="anhDon" class="form-control" value="{{$elderly->anhDon}}" type="file">
                            <div id="large2" style="display: none;" class="cover-image-ncc">
                                <img src="{{asset('public/storage/'.$elderly->anhDon)}}" alt="">
                                <div id="close2" class="close-ncc">&times</div>
                            </div>
                            <img id="small2" class="small-nd" src="{{asset('public/storage/'.$elderly->anhDon)}}" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label " for="val-username">Ảnh tờ khai đề nghị trợ giúp (Có công chứng, theo mẫu): <span class="text-danger">*</span></label>
                        <div class="col-md-9">
                            <input name="anhToKhaiDeNghiTroGiup" class="form-control" value="{{$elderly->anhToKhaiDeNghiTroGiup}}" type="file">
                            <div id="large3" style="display: none;" class="cover-image-ncc">
                                <img src="{{asset('public/storage/'.$elderly->anhToKhaiDeNghiTroGiup)}}" alt="">
                                <div id="close3" class="close-ncc">&times</div>
                            </div>
                            <img id="small3" class="small-nd" src="{{asset('public/storage/'.$elderly->anhToKhaiDeNghiTroGiup)}}" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label " for="val-username">Ảnh sơ yếu lý lịch (Có công chứng, theo mẫu): <span class="text-danger">*</span></label>
                        <div class="col-md-9">
                            <input name="anhSoYeuLyLich" class="form-control" value="{{$elderly->anhSoYeuLyLich}}" type="file">
                            <div id="large4" style="display: none;" class="cover-image-ncc">
                                <img src="{{asset('public/storage/'.$elderly->anhSoYeuLyLich)}}" alt="">
                                <div id="close4" class="close-ncc">&times</div>
                            </div>
                            <img id="small4" class="small-nd" src="{{asset('public/storage/'.$elderly->anhSoYeuLyLich)}}" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label " for="val-username">Ảnh giấy chứng nhận HIV nếu trường hợp đối tượng là người nhiễm HIV (Nếu có): <span class="text-danger">*</span></label>
                        <div class="col-md-9">
                            <input name="anhGiayChungNhanHIV" class="form-control" value="{{$elderly->anhGiayChungNhanHIV}}" type="file">
                            @if($elderly->anhGiayChungNhanHIV)
                                <div id="large5" style="display: none;" class="cover-image-ncc">
                                    <img src="{{asset('public/storage/'.$elderly->anhGiayChungNhanHIV)}}" alt="">
                                    <div id="close5" class="close-ncc">&times</div>
                                </div>
                                <img id="small5" class="small-nd" src="{{asset('public/storage/'.$elderly->anhGiayChungNhanHIV)}}" />
                            @else
                                <p></p>
                            @endif
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label " for="val-username">Ngày đăng ký: <span class="text-danger">*</span></label>
                        <div class="col-md-9">
                            <input name="ngayDangKy"  value="{{$elderly->ngayDangKyNCC}}" class="form-control" type="date" disabled>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label " for="val-username">Ngày duyệt: <span class="text-danger">*</span></label>
                        <div class="col-md-9">
                            <input name="ngayDuyet"  value="{{$elderly->ngayDuyetNCC}}" class="form-control" type="date" disabled>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label " for="val-username">Người duyệt: <span class="text-danger">*</span></label>
                        <div class="col-md-9">
                            <input name="nguoiDuyet"  value="{{$elderly_nguoiduyet->hoTen}}" class="form-control" disabled>
                        </div>
                    </div>

                    {{-- Thông tin được thêm sau khi được duyệt --}}
                    <div class="form-group">
                        <label class="col-md-3 control-label " for="val-username">Vị trí phòng ở: <span class="text-danger">*</span></label>
                        <div class="col-md-9">
                            <input name="phong" placeholder="Nhập vị trí phòng ở" value="{{$elderly->phong}}" class="form-control" type="text">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label " for="val-username">Vị trí giường: <span class="text-danger">*</span></label>
                        <div class="col-md-9">
                            <input name="giuong" placeholder="Nhập vị trí giường" value="{{$elderly->giuong}}" class="form-control" type="text">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label " for="val-username">Ngày vào ở: <span class="text-danger">*</span></label>
                        <div class="col-md-9">
                            <input name="ngayVao" placeholder="Chọn ngày vào ở" value="{{$elderly->ngayVao}}" class="form-control" type="date">
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-8 col-md-offset-3">
                            <a href="{{route('elderly.all')}}" class="btn  btn-instagram" type="button">Quay lại</a>
                            <button class="btn  btn-success save_user" type="submit">Cập nhật</button>
                            <a style="float: right" href="{{route('elderly.save.warehouse',$elderly->id_nguoicaotuoi)}}" class="btn btn-warning" type="button">Lưu trữ hồ sơ</a>
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
            $('#close1').click(function(){
                $("#large1").hide();
                $("#small1").show();
            });

            $('#small1').click(function(){
                $("#large1").show();
                $("#small1").hide();
            });
            // Ảnh đơn đăng ký
            $('#close2').click(function(){
                $("#large2").hide();
                $("#small2").show();
            });

            $('#small2').click(function(){
                $("#large2").show();
                $("#small2").hide();
            });

            // Ảnh tờ khai đề nghị trợ giúp
            $('#close3').click(function(){
                $("#large3").hide();
                $("#small3").show();
            });

            $('#small3').click(function(){
                $("#large3").show();
                $("#small3").hide();
            });

            // Ảnh sơ yếu lý lịch
            $('#close4').click(function(){
                $("#large4").hide();
                $("#small4").show();
            });

            $('#small4').click(function(){
                $("#large4").show();
                $("#small4").hide();
            });

            // Ảnh chứng nhận HIV
            $('#close5').click(function(){
                $("#large5").hide();
                $("#small5").show();
            });

            $('#small5').click(function(){
                $("#large5").show();
                $("#small5").hide();
            });
        });
    </script>
@endsection