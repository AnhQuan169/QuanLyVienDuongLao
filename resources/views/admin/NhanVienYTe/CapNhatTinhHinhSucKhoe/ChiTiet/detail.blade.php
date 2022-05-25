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
            <a>Quản lý người cao tuổi</a>
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
            <h4 class="text-center">Ông (bà) {{$elderly->hoTenNCC}}</h4>
            <form action="{{route('health.elderly.save',$elderly->id_nguoicaotuoi)}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Huyết áp (mmHg): <span class="text-danger">*</span></label>
                            <div>
                                <input name="huyetAp" value="{{old('huyetAp')}}" min="0" max="200" class="form-control" type="number" placeholder="Nhập số huyết áp (mmHg)">
                                <span style="color: red;">
                                    @error('huyetAp')
                                    {{$message}}
                                    @enderror
                                </span>
                            </div>
                        </div>

                        <div class="form-group">
                            <label>Triệu chứng: <span class="text-danger">*</span></label>
                            <div>
                                <textarea style="resize: none" rows="4" name="trieuChung" class="form-control contenttb" id="ckeditor2" placeholder="Nhập triệu chứng">{{old('trieuChung')}}</textarea>
                                <span style="color: red;">
                                    @error('trieuChung')
                                    {{$message}}
                                    @enderror
                                </span>
                            </div>
                        </div>

                    </div>

                    <div class="col-md-6">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Nhịp tim (nhịp/phút): <span class="text-danger">*</span></label>
                                    <div>
                                        <input name="nhipTim" value="{{old('nhipTim')}}" min="0" max="250" class="form-control" type="number" placeholder="Nhập số nhịp tim (nhịp/phút)">
                                        <span style="color: red;">
                                            @error('nhipTim')
                                            {{$message}}
                                            @enderror
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Cân nặng (Kilogram/kg): <span class="text-danger">*</span></label>
                                    <div>
                                        <input name="canNang" value="{{old('canNang')}}" min="0" max="200" class="form-control" type="number" placeholder="Nhập số cân nặng (Kg)">
                                        <span style="color: red;">
                                            @error('canNang')
                                            {{$message}}
                                            @enderror
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Ghi chú: <span class="text-danger">*</span></label>
                            <div>
                                <textarea style="resize: none" rows="4" name="ghiChu" class="form-control contenttb" id="ckeditor3" placeholder="Nhập ghi chú">{{old('ghiChu')}}</textarea>
                                <span style="color: red;">
                                    @error('ghiChu')
                                    {{$message}}
                                    @enderror
                                </span>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="form-group">
                    <div class="col-md-8">
                        <a href="{{route('health.elderly.all')}}" class="btn btn-instagram" type="button">Quay lại</a>
                        <button class="btn  btn-success save_supplier" type="submit">Thêm</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<!--End row-->

<div class="row">
    <div class="col-md-12">
        <div class="white-box">
            <div class="panel-group accordion-main faq-main" id="accordion">
                <!--FAQ Item-->
                <div class="panel">
                    <div class="panel-heading collapsed" data-toggle="collapse" data-parent="#accordion" data-target="#collapseTwo">
                        {{-- <h6 class="panel-title accordion-toggle">Danh sách tình hình sức khoẻ</h6>
                    </div>
                    <div id="collapseTwo" class="panel-collapse collapse"> --}}
                        <div class="panel-body">
                            <div id="table_data">
                                <div class="table-responsive">
                                    <table id="example" class="display table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Mã số</th>
                                                <th>Huyết áp (mmHg)</th>
                                                <th>Nhịp tim (nhịp/phút)</th>
                                                <th>Cân nặng (Kg)</th>
                                                <th>Thời gian</th>
                                                <th>Ngày khám</th>
                                                <th>Triệu chứng</th>
                                                <th>Ghi chú</th>
                                                <th>Thao tác</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if (count($health_elderly) > 0)
                                                @foreach ($health_elderly as $key => $val )
                                                    <tr>
                                                        <td>{{$val->id_thsk}}</td>
                                                        <td>{{$val->huyetAp}}</td>
                                                        <td>{{$val->nhipTim}}</td>
                                                        <td>{{$val->canNang}}</td>
                                                        <td>{{date('H:i A', strtotime($val->thoiGian))}}</td>
                                                        <td>{{date('d-m-Y', strtotime($val->ngayKham))}}</td>
                                                        <td> {!!$val->trieuChung!!}</td>
                                                        <td> {!!$val->ghiChu!!}</td>
                                                        <td class="text-center">
                                                            <a href="{{route('health.elderly.edit',$val->id_thsk)}}" type="button" class="btn btn-info edit-elderly" style="border-radius: 7px"><i class="fa fa fa-info-circle"></i></a>
                                                            <a href=""  type="button" data-id="{{$val->id_thsk}}" class="btn btn-danger delete-health-elderly" style="border-radius: 7px"><i class="fa fa-times"></i></a>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            @else
                                                <td colspan="8" style="text-align: center">Không có thông tin nào</td>
                                            @endif
                                        </tbody>
                                    </table>  
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('ajax_js')
    <script type="text/javascript">
        $(document).ready(function(){
            $(document).on('click', '.delete-health-elderly', function (e) {
                e.preventDefault();
                var id = $(this).data('id');
                var token = $("meta[name='csrf-token']").attr("content");
                swal({
                    title: "Bạn có chắc muốn xoá?",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonClass: "btn-danger",
                    confirmButtonText: "Có",
                    cancelButtonText: "Không"
                    },
                    function() {
                        $.ajax({
                            type: "DELETE",
                            url: 'delete-health-elderly/'+id,
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