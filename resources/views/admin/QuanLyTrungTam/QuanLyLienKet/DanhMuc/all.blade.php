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
            <a>Quản lý liên kết</a>
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
                        <a type="button" class="btn btn-primary" style="border-radius: 7px" id="btn-add-link"><i class="fa fa-plus"></i> Thêm</a>
                    </div>
                </div>
            </div>
            
            <div id="table_data">
                <div class="table-responsive">
                    <table id="example" class="display table table-bordered">
                        <thead>
                            <tr>
                                <th>Mã liên kết</th>
                                <th>Hình ảnh</th>
                                <th>Liên kết</th>
                                <th>Thao tác</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (count($links) > 0)
                                @foreach ($links as $key => $val )
                                    <tr>
                                        <td>{{$val->id_lienket}}</td>
                                        <td><img src="{{asset('public/storage/'.$val->hinhAnh_lienket)}}" width="150px" /></td>
                                        <td class="text-line-long"><a href="{{$val->link_lienket}}" target="_blank">{{$val->link_lienket}}</a></td>
                                        <td class="text-center">
                                            <button value="{{$val->id_lienket}}"  class="btn btn-info" id="btn-detail-link" style="border-radius: 7px">
                                                <i class="fa fa fa-info-circle"></i>
                                            </button>
                                            <a type="button" data-id="{{$val->id_lienket}}" class="btn btn-danger delete-link" style="border-radius: 7px">
                                                <i class="fa fa-times"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <td colspan="9" style="text-align: center">Không có liên kết nào</td>
                            @endif
                        </tbody>
                    </table>
                    
                </div>
                @include('admin.QuanLyTrungTam.QuanLyLienKet.Modal.add')
                @include('admin.QuanLyTrungTam.QuanLyLienKet.Modal.edit')
            </div>
        </div>
    </div>
</div>
<!--End row-->
@endsection

@section('ajax_js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
  
    <script type="text/javascript">
        $(document).ready(function(){

            // ============ Thêm mới liên kết ===============
            // Mở giao diện thêm mới khi nhấp chọn nút "Thêm mới"
            jQuery('body').on('click', '#btn-add-link', function () {
                $('#AddLinksModal').modal('show');
            });
            
            // Thêm mới
            $('#addLinksForm').submit(function(e) {
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
                        else{
                            toastr.success('Thêm mới thành công');
                            jQuery('#addLinksForm').trigger("reset");
                            window.location.reload();
                        }
                    }  
                });
                
            })

            // Hiển thị hình ảnh khi chọn với thêm
            $('#addLinksForm input[name="hinhAnh_lienket"]').on('change', function() {
                var file = $('#addLinksForm').find('.img-preview4').get(0).files[0];
                if(file) {
                    var reader = new FileReader();
                    reader.onload = function() {
                        $('#addLinksForm').find('#previewImg4').attr('src', reader.result);
                    }
                    reader.readAsDataURL(file);
                }
            });

            // +========= Xoá liên kết =================
            $(document).on('click', '.delete-link', function (e) {
                e.preventDefault();
                var id = $(this).data('id');
                var token = $("meta[name='csrf-token']").attr("content");
                swal({
                    title: "Bạn có chắc muốn xoá liên kết này?",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonClass: "btn-danger",
                    confirmButtonText: "Có",
                    cancelButtonText: "Không"
                    },
                    function() {
                        $.ajax({
                            type: "DELETE",
                            url: 'delete-links/'+id,
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

            // ============== Chỉnh sửa liên kết ==============
            // Hiển thị dữ liệu đã có
            $(document).on('click', '#btn-detail-link', function () {
                var id = $(this).val();
                $.get('edit-links/'+id, function (data) {
                    var imagesa = data.hinhAnh_lienket;
                    var img = '<img src="{{asset("public/storage/")}}/'+imagesa+'" id="previewImg5" width="30%" />';
                    $("#insertedImages1").html(img); 

                    $('#id_lienket_edit').val(data.id_lienket);
                    $('#link_lienket_edit').val(data.link_lienket);
                    $('#EditLinksModal').modal('show');
                })
            });
            // Chỉnh sửa dữ liệu
            $('#editLinksForm').submit(function(e) {
                e.preventDefault();
                var id = $('#id_lienket_edit').val();
                $.ajax({
                    url: 'update-links/'+id,
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
                        else{
                            toastr.success('Cập nhật thành công');
                            // $('#editSlidesForm').trigger("reset");
                            window.location.reload();
                        }
                    }  
                });
                
            })
        });
    </script>
@endsection