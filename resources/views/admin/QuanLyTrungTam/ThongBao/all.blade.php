@extends('admin.admin_layout')
@section('admin_content')
<!--Start Page Title-->
<div class="page-title-box">
    <h4 class="page-title">Danh sách thông báo</h4>
    <ol class="breadcrumb">
        <li>
            <a href="{{route('dashboard')}}">Dashboard</a>
        </li>
        <li>
            <a href="{{route('all_notification')}}">Quản lý thông báo</a>
        </li>
        <li class="active">
            <a href="{{route('all_notification')}}">Danh sách thông báo</a>
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
                    <h2 class="header-title">Danh sách thông báo</h2>
                </div>
                <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 col-xl-6 my-2 ">
                    <div class="log text-right">
                        <a type="button" class="btn btn-primary" style="border-radius: 7px" href="{{route('add_notification')}}" data-target="#thongbao-add" data-toggle="thongbao"><i class="fa fa-plus"></i> Thêm</a>
                    </div>
                </div>
            </div>
            
            <div id="table_data">
                {{-- @include('admin.QuanLyTrungTam.ThongBao.all_data') --}}
                <div class="table-responsive">
                    <table class="display table table-bordered">
                        <thead>
                            <tr>
                                <th>Mã thông báo</th>
                                <th>Chủ đề</th>
                                <th>Nội dung</th>
                                <th>Thời gian đăng</th>
                                <th>Quản lý trung tâm</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($thongbao as $key => $tbao )
                                <tr>
                                    <td>{{$tbao->id_thongbao}}</td>
                                    <td>{{$tbao->chuDe}}</td>
                                    <td class="text-line-long">{!!$tbao->noiDung!!}</td>
                                    <td>{{date('d-m-Y', strtotime($tbao->thoiGianDang))}}</td>
                                    <td>{{$tbao->hoTen}}</td>
                                    <td class="text-center" style="width: 100px">
                                        <a href="{{route('notification.edit',$tbao->id_thongbao)}}" type="button" class="btn btn-success edit-tb" style="border-radius: 7px"><i class="fa fa fa-pencil-square"></i></a>
                                        <a href="{{route('notification.delete',$tbao->id_thongbao)}}" type="button" data-id="{{$tbao->id_thongbao}}" class="btn btn-danger delete-tb" style="border-radius: 7px"><i class="fa fa-times"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>  
                    
                    <div class="col-sm-12 text-right text-center-xs mt-2">
                        <div class="pagination d-flex justify-content-center">
                            {!!$thongbao->links('paginationlinks')!!}
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
            // $('.delete-tb').click(function(){

            //     swal({
            //         title: "Bạn có chắc muốn xoá thông báo này?",
            //         type: "warning",
            //         showCancelButton: true,
            //         confirmButtonClass: "btn-danger",
            //         confirmButtonText: "Có",
            //         cancelButtonText: "Không",
            //         closeOnConfirm: false,
            //         closeOnCancel: false
            //         },
            //         function(isConfirm){
            //             if (isConfirm) {
            //                 // e.preventDefault();
            //                 var id = $(this).data('id');
            //                 var token = $("meta[name='csrf-token']").attr("content");

            //                 // var url = e.target;
            //                 $.ajax({
            //                     url: 'delete-notification/'+id,
            //                     // url:url.href,
            //                     method: 'DELETE',
            //                     data:{id:id,_token:token},
            //                     success:function(){
            //                         swal("Xoá thành công!", "Không thể khôi phục dữ liệu đã xoá", "success");
            //                         window.setTimeout(function(){
            //                             location.href = "{{url('/admin/thongbao/all-notification')}}";
            //                         }, 5000);
            //                     }
            //                 });
            //                 // swal("Xoá thành công!", "", "success");
            //             }else {
            //                 swal("Đóng", "", "error");
            //             }
            //         }
            //     });
            // });

            $(document).on('click', '.delete-tb', function (e) {
                e.preventDefault();
                var id = $(this).data('id');
                var token = $("meta[name='csrf-token']").attr("content");
                swal({
                    title: "Bạn có chắc muốn xoá thông báo này?",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonClass: "btn-danger",
                    confirmButtonText: "Có",
                    cancelButtonText: "Không"
                    },
                    function() {
                        $.ajax({
                            type: "DELETE",
                            url: 'delete-notification/'+id,
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