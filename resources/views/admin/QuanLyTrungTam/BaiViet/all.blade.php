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
            <a>Quản lý bài viết</a>
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
                        <a type="button" class="btn btn-primary" style="border-radius: 7px" id="btn-add-posts"><i class="fa fa-plus"></i> Thêm</a>
                    </div>
                </div>
            </div>
            
            <div id="table_data">
                <div class="table-responsive">
                    <table id="example" class="display table table-bordered">
                        <thead>
                            <tr>
                                <th>Mã bài viết</th>
                                <th>Hình Ảnh</th>
                                <th>Tên bài viết</th>
                                <th>Tác giả</th>
                                <th>Ngày đăng bài</th>
                                <th>Tình trạng</th>
                                <th>Thao tác</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (count($baiviet) > 0)
                                @foreach ($baiviet as $key => $bv )
                                    <tr>
                                        <td>{{$bv->id_baiViet}}</td>
                                        <td><img src="{{asset('public/storage/'.$bv->hinhAnh)}}" width="150px" /></td>
                                        <td class="text-line-long">{{$bv->tenBaiViet}}</td>
                                        <td>{{$bv->tacGia}}</td>
                                        <td>{{date('d-m-Y', strtotime($bv->ngayDang))}}</td>
                                        <td>
                                            @if($bv->tinhTrang == 1)
                                                <a href="{{route('posts.unactive',$bv->id_baiViet)}}" type="button" class="btn btn-success" style="border-radius: 7px;"><i class="fa fa fa-unlock"></i> Hoạt động</a>
                                            @endif
                                            @if($bv->tinhTrang == 0)
                                                <a href="{{route('posts.active',$bv->id_baiViet)}}" type="button" class="btn btn-danger" style="border-radius: 7px"><i class="fa fa fa-lock"></i> khoá</a>
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            <a href="{{route('posts.edit',$bv->id_baiViet)}}" type="button" class="btn btn-info edit-user" style="border-radius: 7px">
                                                <i class="fa fa fa-info-circle"></i>
                                            </a>
                                            <a type="button" data-id="{{$bv->id_baiViet}}" class="btn btn-danger delete-posts" style="border-radius: 7px">
                                                <i class="fa fa-times"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <td colspan="9" style="text-align: center">Không có bài viết nào</td>
                            @endif
                        </tbody>
                    </table>
                    
                </div>
                @include('admin.QuanLyTrungTam.BaiViet.Modal.add')
            </div>
        </div>
    </div>
</div>
<!--End row-->
@endsection

@section('ajax_js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
  
    <script type="text/javascript">
        $('#noiDung').summernote();
        $(document).ready(function(){

            // ============ Thêm mới bài viết ===============
            // Mở giao diện thêm mới khi nhấp chọn nút "Thêm mới"
            jQuery('body').on('click', '#btn-add-posts', function () {
                $('#AddPostsForm').modal('show');
            });
            
            // Thêm mới
            $('#addPForm').submit(function(e) {
                e.preventDefault();
                $.ajax({
                    url: $(this).attr('action'),
                    method:  "POST",
                    data: new FormData(this),
                    processData: false,
                    dataType: 'json',
                    contentType: false,
                    beforeSend: function () {
                        $(document).find('span.error-text').text('');
                    },
                    success: function(data) {
                        if(data.status == 400) {
                            $.each(data.error, function(prefix, val) {
                                $('span.'+prefix + '_error').text(val[0]);
                            });
                            console.log('Fail');
                        }

                        if (data.success) {
                            toastr.success('Thêm mới thành công');
                            jQuery('#addPForm').trigger("reset");
                            window.location.reload();
                            // $('#AddPostsForm').modal('show');
                        }
                    }  
                });
                
            })

            // Hiển thị hình ảnh khi chọn với thêm
            $('#addPForm input[name="hinhAnh"]').on('change', function() {
                var file = $('#addPForm').find('.img-preview1').get(0).files[0];
                if(file) {
                    var reader = new FileReader();
                    reader.onload = function() {
                        $('#addPForm').find('#previewImg').attr('src', reader.result);
                    }
                    reader.readAsDataURL(file);
                }
            });

            // Xoá bài viết
            $(document).on('click', '.delete-posts', function (e) {
                e.preventDefault();
                var id = $(this).data('id');
                var token = $("meta[name='csrf-token']").attr("content");
                swal({
                    title: "Bạn có chắc muốn xoá bài viết này?",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonClass: "btn-danger",
                    confirmButtonText: "Có",
                    cancelButtonText: "Không"
                    },
                    function() {
                        $.ajax({
                            type: "DELETE",
                            url: 'delete-posts/'+id,
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