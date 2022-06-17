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
            <a>Quản lý thuốc</a>
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
                
            <form class="js-validation-bootstrap form-horizontal" action="{{route('medicine.update',$thuoc->id_thuoc)}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label class="col-md-3 control-label " for="val-username">Tên thuốc: <span class="text-danger">*</span></label>
                    <div class="col-md-9">
                        <input name="tenThuoc" value="{{$thuoc->tenThuoc}}" class="form-control" type="text" placeholder="Nhập tên thuốc">
                        <span style="color: red;">
                            @error('tenThuoc')
                            {{$message}}
                            @enderror
                        </span>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-3 control-label " for="val-username">Công dụng: <span class="text-danger">*</span></label>
                    <div class="col-md-9">
                        <input name="congDung" value="{{$thuoc->congDung}}" class="form-control" type="text" placeholder="Nhập công dụng thuốc">
                        <span style="color: red;">
                            @error('congDung')
                            {{$message}}
                            @enderror
                        </span>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-3 control-label " for="val-username">Ngày nhập: <span class="text-danger">*</span></label>
                    <div class="col-md-9">
                        <input name="ngayNhap" value="{{$thuoc->ngayNhap}}" max="200" min="0" class="form-control" type="date">
                        <span style="color: red;">
                            @error('ngayNhap')
                            {{$message}}
                            @enderror
                        </span>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-3 control-label " for="val-username">Hạn sử dụng: <span class="text-danger">*</span></label>
                    <div class="col-md-9">
                        <input name="hanSuDung" value="{{$thuoc->hanSuDung}}" class="form-control" type="date" >
                        <span style="color: red;">
                            @error('hanSuDung')
                            {{$message}}
                            @enderror
                        </span>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-3 control-label " for="val-username">Số lượng đang sử dụng: <span class="text-danger">*</span></label>
                    <div class="col-md-9">
                        <input name="soLuongNhap" value="{{$thuoc->soLuongNhap}}" max="200" min="0" class="form-control" type="number" placeholder="Nhập số lượng nhập">
                        <span style="color: red;">
                            @error('soLuongNhap')
                            {{$message}}
                            @enderror
                        </span>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-3 control-label " for="val-username">Tình trạng: <span class="text-danger">*</span></label>
                    <div class="col-md-9" style="display: flex">
                        <select class="form-control" id="val-skill" name="tinhTrang">
                            <option value="1">Hoạt động</option>
                            <option value="0">Khoá</option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-3 control-label " for="val-username">Nhà cung cấp: <span class="text-danger">*</span></label>
                    <div class="col-md-9" style="display: flex">
                        <select class="form-control" id="val-skill" name="id_nhacungcap">
                            @foreach ($nhacungcap as $key => $val )
                                @if ($val->id_nhacungcap == $thuoc->id_nhacungcap)
                                    <option selected value="{{$val->id_nhacungcap}}">{{$val->ten_ncc}}</option>
                                @else
                                    <option value="{{$val->id_nhacungcap}}">{{$val->ten_ncc}}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-md-8 col-md-offset-3">
                        <a href="{{route('medicine.all')}}" class="btn btn-instagram" type="button">Quay lại</a>
                        <button class="btn  btn-success update_medicine" type="submit">Cập nhật</button>
                    </div>
                </div>
            </form>
        </div>  
    </div>
</div>
<!--End row-->
@endsection