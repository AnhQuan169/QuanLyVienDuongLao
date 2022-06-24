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
            <a>Quản lý nhân viên</a>
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
                {{-- <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3 col-xl-3 my-2">
                    <div class="form-group">
                        <form action="{{route('employee.search')}}" method="POST">
							@csrf
							<div class="search_box pull-right">
								<input type="text" name="keyword_employee" placeholder="Tìm kiếm"/>
								<input type="submit" style="display: none" name="search_item" class="btn btn-primary get" value="Tìm kiếm"/>
							</div>								
						</form>
                    </div>
                </div> --}}
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 my-2">
                    <div class="log text-right">
                        <a type="button" class="btn btn-primary" style="border-radius: 7px" href="{{route('employee.add')}}"><i class="fa fa-plus"></i> Thêm</a>
                    </div>
                </div>
            </div>
            
            <div id="table_data">
                <div class="table-responsive">
                    <table id="example" class="display table table-bordered">
                        <thead>
                            <tr>
                                <th>Mã người dùng</th>
                                <th>Ảnh đại diện</th>
                                <th>Họ tên</th>
                                <th>Email</th>
                                <th>CCCD</th>
                                <th>Số điện thoại</th>
                                <th>Loại nhân viên</th>
                                <th>Tình trạng</th>
                                <th>Thao tác</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (count($employee) > 0)
                                @foreach ($employee as $key => $val )
                                    <tr>
                                        <td>{{$val->id}}</td>
                                        <td><img src="{{asset('public/storage/'.$val->anhDaiDien)}}" width="150px" /></td>
                                        <td>{{$val->hoTen}}</td>
                                        <td>{{$val->email}}</td>
                                        <td>{{$val->CCCD}}</td>
                                        <td>{{$val->soDienThoai}}</td>
                                        <td>
                                            @if ($val->loaiTaiKhoan == 1)
                                                Nhân viên kho
                                            @else
                                                Nhân viên y tế
                                            @endif
                                        </td>
                                        <td>
                                            @if($val->tinhTrang == 1)
                                                <a href="{{route('employee.unactive',$val->id)}}" type="button" class="btn btn-success edit-user" style="border-radius: 7px;"><i class="fa fa fa-unlock"></i> Hoạt động</a>
                                            @else
                                                <a href="{{route('employee.active',$val->id)}}" type="button" class="btn btn-danger edit-user" style="border-radius: 7px"><i class="fa fa fa-lock"></i> Bị khoá</a>
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            <a href="{{route('employee.edit',$val->id)}}" type="button" class="btn btn-info edit-user" style="border-radius: 7px"><i class="fa fa fa-info-circle"></i></a>
                                            <a href=""  type="button" data-id="{{$val->id}}" class="btn btn-danger delete-employee" style="border-radius: 7px"><i class="fa fa-times"></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <td colspan="9" style="text-align: center">Không có nhân viên nào</td>
                            @endif
                        </tbody>
                    </table>  
                    
                    {{-- <div class="col-sm-12 text-right text-center-xs mt-2">
                        <div class="pagination d-flex justify-content-center">
                            {!!$employee->links('paginationlinks')!!}
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

            $(document).on('click', '.delete-employee', function (e) {
                e.preventDefault();
                var id = $(this).data('id');
                var token = $("meta[name='csrf-token']").attr("content");
                swal({
                    title: "Bạn có chắc muốn xoá nhân viên này?",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonClass: "btn-danger",
                    confirmButtonText: "Có",
                    cancelButtonText: "Không"
                    },
                    function() {
                        $.ajax({
                            type: "DELETE",
                            url: 'delete-employee/'+id,
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

        $('#search-nv').on('keyup',function(){
            $value = $(this).val();
            $.ajax({
                type: 'get',
                url: 'search-employee',
                data: {
                    'search': $value
                },
                success:function(data){
                    $('tbody').html(data);
                }
            });
        })
        $.ajaxSetup({ headers: { 'csrftoken' : '{{ csrf_token() }}' } });
        
    </script>
@endsection