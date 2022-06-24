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
            <a>Quản lý nhà cung cấp</a>
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
                        <a type="button" class="btn btn-primary" style="border-radius: 7px" href="{{route('supplier.add')}}"><i class="fa fa-plus"></i> Thêm</a>
                    </div>
                </div>
            </div>
            <div id="table_data">
                <div class="table-responsive">
                    <table id="example" class="display table table-bordered">
                        <thead>
                            <tr>
                                <th>Mã nhà cung cấp</th>
                                <th>Tên nhà cung cấp</th>
                                <th>Địa chỉ</th>
                                <th>Email</th>
                                <th>Số điện thoại</th>
                                <th>Loại hàng hoá</th>
                                <th>Tình trạng</th>
                                <th>Thao tác</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (count($nhacungcap) > 0)
                                @foreach ($nhacungcap as $key => $ncc )
                                    <tr>
                                        <td>{{$ncc->id_nhacungcap}}</td>
                                        <td>{{$ncc->ten_ncc}}</td>
                                        <td>{{$ncc->diaChi_ncc}}</td>
                                        <td>{{$ncc->email_ncc}}</td>
                                        <td>{{$ncc->soDienThoai_ncc}}</td>
                                        <td>{{$ncc->ten_loaiHangHoa}}</td>
                                        <td>
                                            @if($ncc->tinhTrang_ncc == 1)
                                                <a href="{{route('supplier.unactive',$ncc->id_nhacungcap)}}" type="button" class="btn btn-success edit-user" style="border-radius: 7px;"><i class="fa fa fa-unlock"></i> Hoạt động</a>
                                            @else
                                                <a href="{{route('supplier.active',$ncc->id_nhacungcap)}}" type="button" class="btn btn-danger edit-user" style="border-radius: 7px"><i class="fa fa fa-lock"></i> khoá</a>
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            <a href="{{route('supplier.edit',$ncc->id_nhacungcap)}}" type="button" class="btn btn-info edit-user" style="border-radius: 7px"><i class="fa fa fa-info-circle"></i></a>
                                            <a href=""  type="button" data-id="{{$ncc->id_nhacungcap}}" class="btn btn-danger delete-supplier" style="border-radius: 7px"><i class="fa fa-times"></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <td colspan="9" style="text-align: center">Không có nhà cung cấp nào</td>
                            @endif
                        </tbody>
                    </table>  
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

            $(document).on('click', '.delete-supplier', function (e) {
                e.preventDefault();
                var id = $(this).data('id');
                var token = $("meta[name='csrf-token']").attr("content");
                swal({
                    title: "Bạn có chắc muốn xoá nhà cung cấp này?",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonClass: "btn-danger",
                    confirmButtonText: "Có",
                    cancelButtonText: "Không"
                    },
                    function() {
                        $.ajax({
                            type: "DELETE",
                            url: 'delete-supplier/'+id,
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