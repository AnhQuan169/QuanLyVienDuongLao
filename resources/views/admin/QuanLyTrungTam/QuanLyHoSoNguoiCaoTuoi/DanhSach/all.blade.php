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
            <div class="row justify-content-end" style="margin-bottom: 10px">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 my-2">
                    <div class="log text-right">
                        <a type="button" class="btn btn-primary" style="border-radius: 7px" href="{{route('elderly.add')}}"><i class="fa fa-plus"></i> Thêm</a>
                    </div>
                </div>
            </div>
            
            <div id="table_data">
                {{-- @include('admin.QuanLyTrungTam.ThongBao.all_data') --}}
                <div class="table-responsive">
                    <table class="display table table-bordered">
                        <thead>
                            <tr>
                                <th>Mã hồ sơ</th>
                                <th style="width: 200px">Ảnh đại diện</th>
                                <th>Họ tên</th>
                                <th>Người giám hộ</th>
                                <th>Ngày sinh</th>
                                <th>Số điện thoại</th>
                                <th>CCCD</th>
                                <th>Thao tác</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (count($elderly) > 0)
                                @foreach ($elderly as $key => $usernd )
                                    <tr>
                                        <td>{{$usernd->id_nguoicaotuoi}}</td>
                                        <td><img src="{{asset('public/admin/uploads/nguoicaotuoi/anhdaidien/'.$usernd->anhDaiDienNCC)}}" width="150px" /></td>
                                        <td>{{$usernd->hoTenNCC}}</td>
                                        <td><a href="{{route('user.edit',$usernd->id)}}"  type="button">{{$usernd->hoTen}}</a></td>
                                        <td>{{date('d-m-Y', strtotime($usernd->ngaySinhNCC))}}</td>
                                        <td>{{$usernd->soDienThoaiNCC}}</td>
                                        <td>{{$usernd->CCCD_NCC}}</td>
                                        <td class="text-center">
                                            <a href="{{route('elderly.edit',$usernd->id_nguoicaotuoi)}}" type="button" class="btn btn-info edit-elderly" style="border-radius: 7px"><i class="fa fa fa-info-circle"></i></a>
                                            <a href=""  type="button" data-id="{{$usernd->id_nguoicaotuoi}}" class="btn btn-danger delete-elderly" style="border-radius: 7px"><i class="fa fa-times"></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <td colspan="8" style="text-align: center">Không có đơn đăng ký nào được duyệt</td>
                            @endif
                        </tbody>
                    </table>  
                    
                    <div class="col-sm-12 text-right text-center-xs mt-2">
                        <div class="pagination d-flex justify-content-center">
                            {!!$elderly->links('paginationlinks')!!}
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

            $(document).on('click', '.delete-elderly', function (e) {
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
                            url: 'delete-elderly/'+id,
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