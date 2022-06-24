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
            <a>Cập nhật bệnh án người cao tuổi</a>
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
            <form action="{{route('medicine.list.save',$medical_records->id_benhAn)}}" method="POST" enctype="multipart/form-data">
                @csrf
                
                <div class="form-group">
                    <label class="col-md-3 control-label " for="val-username">Thuốc: <span class="text-danger">*</span></label>
                    <div class="col-md-9" style="display: flex">
                        <select class="form-control" id="val-skill" name="id_thuoc">
                            @foreach ($medicine as $key => $val )
                                <option value="{{$val->id_thuoc}}">{{$val->tenThuoc}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-3 control-label " for="val-username">Số lượng: <span class="text-danger">*</span></label>
                    <div class="col-md-9">
                        <input name="soLuong" value="{{old('soLuong')}}" max="100" min="0" class="form-control" type="number" placeholder="Nhập số lượng">
                        <span style="color: red;">
                            @error('soLuong')
                            {{$message}}
                            @enderror
                        </span>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-3 control-label " for="val-username">Đơn vị: <span class="text-danger">*</span></label>
                    <div class="col-md-9" style="display: flex">
                        <select class="form-control" id="val-skill" name="donVi">
                            <option value="Viên">Viên</option>
                            <option value="Hộp">Hộp</option>
                            <option value="Lọ">Lọ</option>
                            <option value="Gói">Gói</option>
                            <option value="Vĩ">Vĩ</option>
                            <option value="Chai">Chai</option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-3 control-label " for="val-username">Ghi chú: <span class="text-danger">*</span></label>
                    <div class="col-md-9">
                        <input name="ghiChu" value="{{old('ghiChu')}}" class="form-control" type="text" placeholder="Nhập ghi chú">
                        <span style="color: red;">
                            @error('ghiChu')
                            {{$message}}
                            @enderror
                        </span>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-md-8">
                        <a href="{{route('medical.records_personal.edit',$medical_records->id_benhAn)}}" class="btn btn-instagram" type="button">Quay lại</a>
                        <button class="btn  btn-success save_medicine_records" type="submit">Thêm</button>
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
                        <div class="panel-body">
                            <div id="table_data">
                                <div class="table-responsive">
                                    <table class="display table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Mã số</th>
                                                <th>Tên thuốc</th>
                                                <th>Số lượng</th>
                                                <th>Đơn vị</th>
                                                <th>Ghi chú</th>
                                                <th>Thao tác</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if (count($tdt) > 0)
                                                @foreach ($tdt as $key => $val )
                                                    <tr>
                                                        <td>{{$val->id_thuocDieuTri}}</td>
                                                        <td>{{$val->tenThuoc}}</td>
                                                        <td>{{$val->soLuong}}</td>
                                                        <td>{{$val->donVi}}</td>
                                                        <td>{{$val->ghiChu}}</td>
                                                        <td class="text-center">
                                                            <a href=""  type="button" data-id="{{$val->id_thuocDieuTri}}" class="btn btn-danger delete-medicine_list" style="border-radius: 7px"><i class="fa fa-times"></i></a>
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
                <a href="{{route('medicine_list.pdf',$medical_records->id_benhAn)}}" target="_blank" class="btn btn-warning">In đơn thuốc</a>
            </div>
        </div>
    </div>
</div>

@endsection

@section('ajax_js')
    <script type="text/javascript">
        $(document).ready(function(){

            $(document).on('click', '.delete-medicine_list', function (e) {
                e.preventDefault();
                var id = $(this).data('id');
                var token = $("meta[name='csrf-token']").attr("content");
                swal({
                    title: "Bạn có chắc muốn xoá thuốc này?",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonClass: "btn-danger",
                    confirmButtonText: "Có",
                    cancelButtonText: "Không"
                    },
                    function() {
                        $.ajax({
                            type: "DELETE",
                            // url: 'delete-medicine_list/'+id,
                            // url: "{{route('medicine_list.delete',".id.")}}",
                            url: "{{url('admin/nhanvienyte/medical-records-elderly/delete-medicine-list')}}"+"/"+id,
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
