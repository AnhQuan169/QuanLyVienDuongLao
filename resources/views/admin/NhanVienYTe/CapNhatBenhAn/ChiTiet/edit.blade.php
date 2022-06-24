@extends('admin.admin_layout')
@section('admin_content')
<!--Start Page Title-->
<div class="page-title-box">
    <h4 class="page-title">{{$title}} {{$medical_records->hoTenNCC}}</h4>
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
            <h4 class="text-center">Ông (bà) {{$medical_records->hoTenNCC}}</h4>
            <form action="{{route('medical.records_personal.update',$medical_records->id_benhAn)}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label class="col-md-3 control-label " for="val-username">Tên bệnh viện:<span class="text-danger">*</span></label>
                    <div class="col-md-9">
                        <input name="tenBenhVien" value="{{$medical_records->tenBenhVien}}" class="form-control" type="text" placeholder="Nhập tên bệnh viện">
                        <span style="color: red;">
                            @error('tenBenhVien')
                            {{$message}}
                            @enderror
                        </span>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-3 control-label " for="val-username">Dịa chỉ:<span class="text-danger">*</span></label>
                    <div class="col-md-9">
                        <input name="diaChi" value="{{$medical_records->diaChi}}" class="form-control" type="text" placeholder="Nhập địa chỉ bệnh viện">
                        <span style="color: red;">
                            @error('diaChi')
                            {{$message}}
                            @enderror
                        </span>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-3 control-label " for="val-username">Số điện thoại:<span class="text-danger">*</span></label>
                    <div class="col-md-9">
                        <input name="soDienThoai" value="{{$medical_records->soDienThoai}}" class="form-control" type="text" placeholder="Nhập số điện thoại bệnh viện">
                        <span style="color: red;">
                            @error('soDienThoai')
                            {{$message}}
                            @enderror
                        </span>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-3 control-label " for="val-username">Khoa khám:<span class="text-danger">*</span></label>
                    <div class="col-md-9">
                        <input name="khoa" value="{{$medical_records->khoa}}" class="form-control" type="text" placeholder="Nhập khoa khám">
                        <span style="color: red;">
                            @error('khoa')
                            {{$message}}
                            @enderror
                        </span>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-3 control-label " for="val-username">Nhập tên bác sĩ:<span class="text-danger">*</span></label>
                    <div class="col-md-9">
                        <input name="bacSi" value="{{$medical_records->bacSi}}" class="form-control" type="text" placeholder="Nhập tên bác sĩ">
                        <span style="color: red;">
                            @error('bacSi')
                            {{$message}}
                            @enderror
                        </span>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-3 control-label date-tb" for="val-username">Ngày khám: <span class="text-danger">*</span></label>
                    <div class="col-md-9">
                        <input name="ngayKham" id="txtDate" value="{{$medical_records->ngayKham}}" class="form-control" type="date">
                        <span style="color: red;">
                            @error('ngayKham')
                            {{$message}}
                            @enderror
                        </span>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-3 control-label date-tb" for="val-username">Ngày vào viện: <span class="text-danger">*</span></label>
                    <div class="col-md-9">
                        <input name="ngayVaoVien" id="txtDate" value="{{$medical_records->ngayVaoVien}}" class="form-control" type="date">
                        <span style="color: red;">
                            @error('ngayVaoVien')
                            {{$message}}
                            @enderror
                        </span>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-3 control-label date-tb" for="val-username">Ngày ra viện: <span class="text-danger">*</span></label>
                    <div class="col-md-9">
                        <input name="ngayRaVien" id="txtDate" value="{{$medical_records->ngayRaVien}}" class="form-control" type="date">
                        <span style="color: red;">
                            @error('ngayRaVien')
                            {{$message}}
                            @enderror
                        </span>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-3 control-label" for="val-username">Tiền sử bệnh: <span class="text-danger">*</span></label>
                    <div class="col-md-9">
                        <textarea style="resize: none" rows="3" name="tienSuBenh" class="form-control contenttb" placeholder="Nhập tiền sử bệnh">{{$medical_records->tienSuBenh}}</textarea>
                        <span style="color: red;">
                            @error('tienSuBenh')
                            {{$message}}
                            @enderror
                        </span>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-3 control-label" for="val-username">Kết quả xét nghiệm: <span class="text-danger">*</span></label>
                    <div class="col-md-9">
                        <textarea style="resize: none" rows="3" name="ketQuaXetNghiem" class="form-control contenttb" placeholder="Nhập kết quả xét nghiệm">{{$medical_records->ketQuaXetNghiem}}</textarea>
                        <span style="color: red;">
                            @error('ketQuaXetNghiem')
                            {{$message}}
                            @enderror
                        </span>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-3 control-label" for="val-username">Chẩn đoán: <span class="text-danger">*</span></label>
                    <div class="col-md-9">
                        <textarea style="resize: none" rows="3" name="chanDoan" class="form-control contenttb" placeholder="Nhập chẩn đoán">{{$medical_records->chanDoan}}</textarea>
                        <span style="color: red;">
                            @error('chanDoan')
                            {{$message}}
                            @enderror
                        </span>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-3 control-label date-tb" for="val-username">Ngày hẹn khám: <span class="text-danger">*</span></label>
                    <div class="col-md-9">
                        <input name="ngayHenKham" id="txtDate" value="{{$medical_records->ngayHenKham}}" class="form-control" type="date">
                        <span style="color: red;">
                            @error('ngayHenKham')
                            {{$message}}
                            @enderror
                        </span>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-3 control-label" for="val-username">Ghi chú: <span class="text-danger">*</span></label>
                    <div class="col-md-9">
                        <textarea style="resize: none" rows="3" name="ghiChu" class="form-control contenttb" placeholder="Nhập ghi chú">{{$medical_records->ghiChu}}</textarea>
                        <span style="color: red;">
                            @error('ghiChu')
                            {{$message}}
                            @enderror
                        </span>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-3 control-label " for="val-username">Nhập tổng chi phí:<span class="text-danger">*</span></label>
                    <div class="col-md-9">
                        <input name="chiPhi" value="{{$medical_records->chiPhi}}" class="form-control" type="text" placeholder="Nhập tổng chi phí">
                        <span style="color: red;">
                            @error('chiPhi')
                            {{$message}}
                            @enderror
                        </span>
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-md-12">
                        <a href="{{route('medical.records_personal.all',$medical_records->id_nguoiCaoTuoi)}}" class="btn btn-instagram" type="button">Quay lại</a>
                        <button class="btn  btn-success update_medical_records" type="submit">Cập nhật</button>
                        <a style="float: right" href="{{route('medicine.list.add',$medical_records->id_benhAn)}}" class="btn btn-warning" type="button">Thêm thuốc điều trị</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<!--End row-->

@endsection
