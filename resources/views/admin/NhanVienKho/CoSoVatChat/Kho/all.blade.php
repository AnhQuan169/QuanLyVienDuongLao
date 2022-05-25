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
            <a>Quản lý cơ sở vật chất</a>
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
            <div class="row">
                <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 col-xl-6 my-2">
                    <h2 class="header-title">{{$title}}</h2>
                </div>
            </div>
            <div class="table-responsive">
                <table id="example" class="display table table-bordered">
                    <thead>
                        <tr>
                            <th>Mã số</th>
                            <th>Tên cơ sở vật chất</th>
                            <th>Số lượng</th>
                            <th>Số lượng tồn</th>
                            <th>Số lượng đang dùng</th>
                            <th>Số lượng hư hỏng</th>
                            <th>Tên nhà cung cấp</th>
                            <th>Thao tác</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (count($csvc) > 0)
                            @foreach ($csvc as $key => $val )
                                <tr>
                                    <td>{{$val->id_csvc}}</td>
                                    <td>{{$val->ten}}</td>
                                    <td>{{$val->soLuong}}</td>
                                    <td>{{$val->soLuongTon}}</td>
                                    <td>{{$val->soLuongDangSuDung}}</td>
                                    <td>{{$val->soLuongHuHong}}</td>
                                    <td>{{$val->ten_ncc}}</td>
                                    <td class="text-center">
                                        <a href="{{route('active.warehouse.infrastructure',$val->id_csvc)}}" type="button" class="btn btn-warning edit-elderly" style="border-radius: 7px"><i class="fa fa fa-lock"></i></a>
                                        <a href=""  type="button" data-id="{{$val->id_csvc}}" class="btn btn-danger delete-infrastructure" style="border-radius: 7px"><i class="fa fa-times"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <td colspan="9" style="text-align: center">Không có cơ sở vật chất nào</td>
                        @endif
                    </tbody>
                </table>  
            </div>
        </div>
    </div>
</div>
<!--End row-->
@endsection

@section('ajax_js')
    <script type="text/javascript">
        $(document).ready(function(){

            $(document).on('click', '.delete-infrastructure', function (e) {
                e.preventDefault();
                var id = $(this).data('id');
                var token = $("meta[name='csrf-token']").attr("content");
                swal({
                    title: "Bạn có chắc muốn xoá cơ sở vật chất này?",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonClass: "btn-danger",
                    confirmButtonText: "Có",
                    cancelButtonText: "Không"
                    },
                    function() {
                        $.ajax({
                            type: "DELETE",
                            url: 'delete-infrastructure/'+id,
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