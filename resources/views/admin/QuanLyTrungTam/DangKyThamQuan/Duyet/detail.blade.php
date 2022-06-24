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
                <form class="js-validation-bootstrap form-horizontal" method="POST">
                    @csrf
                    <div class="form-group">
                        <label class="col-md-3 control-label " for="val-username">Mã đăng ký: </label>
                        <div class="col-md-9">
                            <input name="madk" class="form-control madk" type="text" value="{{$dangkythamquan->id_dangky}}" disabled>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label " for="val-username">Tên người đại diện: </label>
                        <div class="col-md-9">
                            <input name="nguoidd" class="form-control nguoidd" type="text" value="{{$dangkythamquan->nguoiDaiDienDK}}" disabled>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label " for="val-username">Số lượng người tham quan: </label>
                        <div class="col-md-9">
                            <input name="soluongntq" class="form-control soluongntq" type="text" value="{{$dangkythamquan->soLuongDK}}" disabled>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label " for="val-username">Email: </label>
                        <div class="col-md-9">
                            <input name="emailndd" class="form-control emailndd" type="text" value="{{$dangkythamquan->emailDK}}" disabled>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label " for="val-username">Số điện thoại: </label>
                        <div class="col-md-9">
                            <input name="sdtndd" class="form-control sdtndd" type="text" value="{{$dangkythamquan->soDienThoaiDK}}" disabled>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label " for="val-username">Ghi chú: </label>
                        <div class="col-md-9">
                            <textarea style="resize: none" rows="3" name="ghiChuDK" class="form-control" placeholder="Nhập ghi chú" disabled>{{$dangkythamquan->ghiChuDK}}</textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label " for="val-username">Ngày tham quan: </label>
                        <div class="col-md-9">
                            <input name="ngaytq" class="form-control ngaytq" type="text" value="{{date('d-m-Y', strtotime($dangkythamquan->ngayThamQuanDK))}}" disabled>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label " for="val-username">Thời gian tham quan: </label>
                        <div class="col-md-9">
                            <input name="ngaytq" class="form-control ngaytq" type="text" value="{{date('H:i A', strtotime($dangkythamquan->thoigianTQ))}}" disabled>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label " for="val-username">Ngày đăng ký: </label>
                        <div class="col-md-9">
                            <input name="ngaydk" class="form-control ngaydk" type="text" value="{{date('d-m-Y', strtotime($dangkythamquan->ngayDangKyDK))}}" disabled>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-8 col-md-offset-3">
                            <a href="{{route('browseapplication.all')}}" class="btn btn-instagram" type="button">Quay lại</a>
                            <a href="{{route('browseapplication.save',$dangkythamquan->id_dangky)}}" data-iddangky="{{$dangkythamquan->id_dangky}}" class="btn  btn-success update-browse" type="button">Duyệt</a>
                        </div>
                    </div>
                </form>
        </div>  
    </div>
</div>
<!--End row-->
@endsection

{{-- @section('ajax_js')
    <script type="text/javascript">
        $(document).ready(function(){

            $(document).on('click', '.update-browse', function (e) {
                e.preventDefault();
                var id = $(this).data('iddangky');
                var token = $("meta[name='csrf-token']").attr("content");
                swal({
                    title: "Bạn có chắc muốn duyệt đơn đăng ký này?",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonClass: "btn-danger",
                    confirmButtonText: "Có",
                    cancelButtonText: "Không"
                    },
                    function() {
                        $.ajax({
                            type: "DELETE",
                            url: 'save-browse-application/'+id,
                            data: {id:id,_token:token},
                            success: function (data) {
                                swal("Duyệt thành công!", "ABC", "success");
                                window.setTimeout(function(){
                                    location.href = '/admin/dangkythamquan/browse-application';
                                }, 2000);
                            }         
                        });
                    
                });
            });
            
        });
    </script>
@endsection --}}
