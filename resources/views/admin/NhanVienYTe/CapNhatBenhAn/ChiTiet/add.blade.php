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
            <h4 class="text-center">Ông (bà) {{$elderly->hoTenNCC}}</h4>
            <form action="{{route('medical.records.save',$elderly->id_nguoicaotuoi)}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label class="col-md-3 control-label " for="val-username">Tên bệnh viện:<span class="text-danger">*</span></label>
                    <div class="col-md-9">
                        <input name="tenBenhVien" value="{{old('tenBenhVien')}}" class="form-control" type="text" placeholder="Nhập tên bệnh viện">
                        <span style="color: red;">
                            @error('tenBenhVien')
                            {{$message}}
                            @enderror
                        </span>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-3 control-label " for="val-username">Địa chỉ:<span class="text-danger">*</span></label>
                    <div class="col-md-9">
                        <input name="diaChi" value="{{old('diaChi')}}" class="form-control" type="text" placeholder="Nhập địa chỉ bệnh viện">
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
                        <input name="soDienThoai" value="{{old('soDienThoai')}}" class="form-control" type="number" placeholder="Nhập số điện thoại bệnh viện">
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
                        <input name="khoa" value="{{old('khoa')}}" class="form-control" type="text" placeholder="Nhập khoa khám">
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
                        <input name="bacSi" value="{{old('bacSi')}}" class="form-control" type="text" placeholder="Nhập tên bác sĩ">
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
                        <input name="ngayKham" id="txtDate" value="{{old('ngayKham')}}" class="form-control" type="date">
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
                        <input name="ngayVaoVien" id="txtDate" value="{{old('ngayVaoVien')}}" class="form-control" type="date">
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
                        <input name="ngayRaVien" id="txtDate" value="{{old('ngayRaVien')}}" class="form-control" type="date">
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
                        <textarea style="resize: none" rows="3" name="tienSuBenh" class="form-control contenttb" placeholder="Nhập tiền sử bệnh">{{old('tienSuBenh')}}</textarea>
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
                        <textarea style="resize: none" rows="3" name="ketQuaXetNghiem" class="form-control contenttb" placeholder="Nhập kết quả xét nghiệm">{{old('ketQuaXetNghiem')}}</textarea>
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
                        <textarea style="resize: none" rows="3" name="chanDoan" class="form-control contenttb" placeholder="Nhập chẩn đoán">{{old('chanDoan')}}</textarea>
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
                        <input name="ngayHenKham" id="txtDate" value="{{old('ngayHenKham')}}" class="form-control" type="date">
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
                        <textarea style="resize: none" rows="3" name="ghiChu" class="form-control contenttb" placeholder="Nhập ghi chú">{{old('ghiChu')}}</textarea>
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
                        <input name="chiPhi" value="{{old('chiPhi')}}" class="form-control" type="text" placeholder="Nhập tổng chi phí">
                        <span style="color: red;">
                            @error('chiPhi')
                            {{$message}}
                            @enderror
                        </span>
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-md-8">
                        <a href="{{route('medical.records.all')}}" class="btn btn-instagram" type="button">Quay lại</a>
                        <button class="btn  btn-success save_medical_records" type="submit">Thêm</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<!--End row-->

@endsection
