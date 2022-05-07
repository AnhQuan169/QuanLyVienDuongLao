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
            <a href="{{route('browseapplication.all')}}">{{$title}}</a>
        </li>
    </ol>
    <div class="clearfix"></div>
</div>
<!--End Page Title-->          

<!--Start row-->
<div class="row">
    <div class="col-md-12">
        <div class="white-box">
            <div class="row">
                <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 col-xl-6 my-2">
                    <h2 class="header-title">{{$title}}</h2>
                </div>
                
            </div>
            
            <div id="table_data">
                {{-- @include('admin.QuanLyTrungTam.ThongBao.all_data') --}}
                <div class="table-responsive">
                    <table class="display table table-bordered">
                        <thead>
                            <tr>
                                <th>Mã đăng ký</th>
                                <th>Người đại diện</th>
                                <th>Số lượng người</th>
                                <th>Email</th>
                                <th>Số điện thoại</th>
                                <th>Ngày tham quan</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($dangkythamquan as $key => $dky )
                                <tr>
                                    <td>{{$dky->id_dangky}}</td>
                                    <td>{{$dky->nguoiDaiDien}}</td>
                                    <td>{{$dky->soLuong}}</td>
                                    <td>{{$dky->email}}</td>
                                    <td>{{$dky->soDienThoaiDK}}</td>
                                    <td>{{date('d-m-Y', strtotime($dky->ngayThamQuan))}}</td>
                                    <td class="text-center">
                                        <a href="{{route('browseapplication.detail',$dky->id_dangky)}}" type="button" class="btn btn-success update-browse" style="border-radius: 7px"><i class="fa fa fa-check-circle"></i> Chi tiết</a>
                                        <a href=""  type="button" data-id="{{$dky->id_dangky}}" class="btn btn-danger delete-dktq" style="border-radius: 7px"><i class="fa fa-times"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>  
                    
                    <div class="col-sm-12 text-right text-center-xs mt-2">
                        <div class="pagination d-flex justify-content-center">
                            {!!$dangkythamquan->links('paginationlinks')!!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--End row-->
@endsection

@section('ajax_js')
    <script type="text/javascript">
        $(document).ready(function(){

            $(document).on('click', '.delete-dktq', function (e) {
                e.preventDefault();
                var id = $(this).data('id');
                var token = $("meta[name='csrf-token']").attr("content");
                swal({
                    title: "Bạn có chắc muốn xoá đăng ký này?",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonClass: "btn-danger",
                    confirmButtonText: "Có",
                    cancelButtonText: "Không"
                    },
                    function() {
                        $.ajax({
                            type: "DELETE",
                            url: 'delete-registerToVisit/'+id,
                            data: {id:id, _token:token},
                            success: function (data) {
                                swal("Xoá thành công!", "Không thể khôi phục dữ liệu đã xoá", "success");
                                window.setTimeout(function(){
                                    location.reload();
                                }, 2000);
                            }         
                        });
                });
            });
            
        });
    </script>
@endsection