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
            
            <div class="row justify-content-end" style="margin-bottom: 10px">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 my-2">
                    <div class="log text-right">
                        <a type="button" class="btn btn-primary" style="border-radius: 7px" href="{{route('notification.add')}}" data-target="#thongbao-add" data-toggle="thongbao"><i class="fa fa-plus"></i> Thêm</a>
                    </div>
                </div>
            </div>
            
            <div id="table_data">
                <div class="table-responsive">
                    <table id="example" class="display table table-bordered">
                        <thead>
                            <tr>
                                <th>Mã thông báo</th>
                                <th>Chủ đề</th>
                                {{-- <th>Nội dung</th> --}}
                                <th>Thời gian đăng</th>
                                <th>Người đăng</th>
                                <th>Thao tác</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($thongbao as $key => $tbao )
                                <tr>
                                    <td>{{$tbao->id_thongbao}}</td>
                                    <td class="text-line-long">{{$tbao->chuDe}}</td>
                                    {{-- <td class="text-line-long" style="width: 200px">{!!$tbao->noiDung!!}</td> --}}
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
                    
                    {{-- <div class="col-sm-12 text-right text-center-xs mt-2">
                        <div class="pagination d-flex justify-content-center">
                            {!!$thongbao->links('paginationlinks')!!}
                        </div>
                    </div> --}}
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