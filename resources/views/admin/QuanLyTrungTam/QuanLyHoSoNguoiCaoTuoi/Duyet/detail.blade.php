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

<!--Start row-->
<div class="row">
    <div class="col-md-12">
        <div class="white-box">
            <h2 class="header-title">{{$title}}</h2>
                <form class="js-validation-bootstrap form-horizontal">
                    {{-- @csrf --}}
                    <div class="form-group">
                        <label class="col-md-3 control-label " for="val-username">Mã hồ sơ: </label>
                        <div class="col-md-9">
                            <input name="maDangKy" class="form-control maintb" type="text" value="{{$user->id_nguoicaotuoi}}" disabled>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label " for="val-username">Ảnh đại diện: </label>
                        <div class="col-md-9">
                            <div id="large6" style="display: none;" class="cover-image-ncc">
                                <img src="{{asset('public/admin/uploads/nguoicaotuoi/anhdaidien/'.$user->anhDaiDienNCC)}}" alt="">
                                <div id="close6" class="close-ncc">&times</div>
                            </div>
                            <img id="small6" class="small-nd" src="{{asset('public/admin/uploads/nguoicaotuoi/anhdaidien/'.$user->anhDaiDienNCC)}}" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label " for="val-username">Người giám hộ: </label>
                        <div class="col-md-9" style="display: flex">
                            <input name="hoTen" class="form-control maintb" type="text" value="{{$user->hoTen}}" disabled>
                            <a href="{{route('user.edit',$user->id)}}" class="btn  btn-primary" type="button">Chi tiết</a>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label " for="val-username">Họ tên: </label>
                        <div class="col-md-9">
                            <input name="hoTen" class="form-control maintb" type="text" value="{{$user->hoTenNCC}}" disabled>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label " for="val-username">Giói tính: </label>
                        <div class="col-md-9">
                            <input name="gioiTinh" class="form-control maintb" type="text" value="{{$user->gioiTinhNCC == 1 ? 'Nam' : 'Nữ' }}" disabled>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label " for="val-username">Ngày sinh: </label>
                        <div class="col-md-9">
                            <input name="ngaySinh" class="form-control maintb" type="text" value="{{date('d-m-Y', strtotime($user->ngaySinhNCC))}}" disabled>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label " for="val-username">Số căn cước công dân: </label>
                        <div class="col-md-9">
                            <input name="soCCCD" class="form-control maintb" type="text" value="{{$user->CCCD_NCC}}" disabled>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label " for="val-username">Số điện thoại: </label>
                        <div class="col-md-9">
                            <input name="soDienThoai" class="form-control maintb" type="text" value="{{$user->soDienThoaiNCC}}" disabled>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label " for="val-username">Địa chỉ: </label>
                        <div class="col-md-9">
                            <input name="diaChi" class="form-control maintb" type="text" value="{{$user->diaChiNCC}}" disabled>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label " for="val-username">Ảnh đơn đăng ký của đối tượng hoặc người giám hộ (Theo mẫu): </label>
                        <div class="col-md-9">
                            <div id="large7" style="display: none;" class="cover-image-ncc">
                                <img src="{{asset('public/admin/uploads/nguoicaotuoi/anhdondangky/'.$user->anhDon)}}" alt="">
                                <div id="close7" class="close-ncc">&times</div>
                            </div>
                            <img id="small7" class="small-nd" src="{{asset('public/admin/uploads/nguoicaotuoi/anhdondangky/'.$user->anhDon)}}" />
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-3 control-label " for="val-username">Ảnh tờ khai đề nghị trợ giúp (Có công chứng, theo mẫu): </label>
                        <div class="col-md-9">
                            <div id="large8" style="display: none;" class="cover-image-ncc">
                                <img src="{{asset('public/admin/uploads/nguoicaotuoi/anhtokhai/'.$user->anhToKhaiDeNghiTroGiup)}}" alt="">
                                <div id="close8" class="close-ncc">&times</div>
                            </div>
                            <img id="small8" class="small-nd" src="{{asset('public/admin/uploads/nguoicaotuoi/anhtokhai/'.$user->anhToKhaiDeNghiTroGiup)}}" />
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label class="col-md-3 control-label " for="val-username">Ảnh sơ yếu lý lịch (Có công chứng, theo mẫu): </label>
                        <div class="col-md-9">
                            <div id="large9" style="display: none;" class="cover-image-ncc">
                                <img src="{{asset('public/admin/uploads/nguoicaotuoi/anhsoyeulylich/'.$user->anhSoYeuLyLich)}}" alt="">
                                <div id="close9" class="close-ncc">&times</div>
                            </div>
                            <img id="small9" class="small-nd" src="{{asset('public/admin/uploads/nguoicaotuoi/anhsoyeulylich/'.$user->anhSoYeuLyLich)}}" />
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-3 control-label " for="val-username">Ảnh giấy chứng nhận HIV nếu trường hợp đối tượng là người nhiễm HIV (Nếu có): </label>
                        <div class="col-md-9">
                            @if($user->anhGiayChungNhanHIV)
                                <div id="large10" style="display: none;" class="cover-image-ncc">
                                    <img src="{{asset('public/admin/uploads/nguoicaotuoi/anhgiaychungnhan/'.$user->anhGiayChungNhanHIV)}}" alt="">
                                    <div id="close10" class="close-ncc">&times</div>
                                </div>
                                <img id="small10" class="small-nd" src="{{asset('public/admin/uploads/nguoicaotuoi/anhgiaychungnhan/'.$user->anhGiayChungNhanHIV)}}" />
                            @else
                                <input name="diaChi" class="form-control maintb" type="text" value="Không có" disabled>
                            @endif
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-3 control-label " for="val-username">Ngày đăng ký: </label>
                        <div class="col-md-9">
                            <input name="ngayDangKy" class="form-control maintb" type="text" value="{{date('d-m-Y', strtotime($user->ngayDangKyNCC))}}" disabled>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <div class="col-md-8 col-md-offset-3">
                            <a href="{{route('browseelderly.all')}}" class="btn  btn-instagram" type="button">Quay lại</a>
                            <a href="{{route('browseelderly.save',$user->id_nguoicaotuoi)}}" class="btn  btn-success update-browse" type="button">Duyệt</a>
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
            $('#close6').click(function(){
                $("#large6").hide();
                $("#small6").show();
            });

            $('#small6').click(function(){
                $("#large6").show();
                $("#small6").hide();
            });
            // Ảnh đơn đăng ký
            $('#close7').click(function(){
                $("#large7").hide();
                $("#small7").show();
            });

            $('#small7').click(function(){
                $("#large7").show();
                $("#small7").hide();
            });

            // Ảnh tờ khai đề nghị trợ giúp
            $('#close8').click(function(){
                $("#large8").hide();
                $("#small8").show();
            });

            $('#small8').click(function(){
                $("#large8").show();
                $("#small8").hide();
            });

            // Ảnh sơ yếu lý lịch
            $('#close9').click(function(){
                $("#large9").hide();
                $("#small9").show();
            });

            $('#small9').click(function(){
                $("#large9").show();
                $("#small9").hide();
            });

            // Ảnh chứng nhận HIV
            $('#close10').click(function(){
                $("#large10").hide();
                $("#small10").show();
            });

            $('#small10').click(function(){
                $("#large10").show();
                $("#small10").hide();
            });
        });
    </script>
@endsection
