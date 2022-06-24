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
            <a>Quản lý người dùng</a>
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
                
            <form class="js-validation-bootstrap form-horizontal" action="{{route('supplier.save')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label class="col-md-3 control-label " for="val-username">Tên nhà cung cấp: <span class="text-danger">*</span></label>
                    <div class="col-md-9">
                        <input name="ten_ncc" value="{{old('ten_ncc')}}" class="form-control" type="text" placeholder="Nhập tên nhà cung cấp">
                        <span style="color: red;">
                            @error('ten_ncc')
                            {{$message}}
                            @enderror
                        </span>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-3 control-label " for="val-username">Địa chỉ: <span class="text-danger">*</span></label>
                    <div class="col-md-9">
                        <input name="diaChi_ncc" value="{{old('diaChi_ncc')}}" class="form-control" type="text" placeholder="Nhập địa chỉ">
                        <span style="color: red;">
                            @error('diaChi_ncc')
                            {{$message}}
                            @enderror
                        </span>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-3 control-label " for="val-username">Email: <span class="text-danger">*</span></label>
                    <div class="col-md-9">
                        <input name="email_ncc" placeholder="Nhập địa chỉ email" value="{{old('email_ncc')}}" class="form-control" type="email">
                        <span style="color: red;">
                            @error('email_ncc')
                            {{$message}}
                            @enderror
                        </span>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-3 control-label " for="val-username">Số điện thoại: <span class="text-danger">*</span></label>
                    <div class="col-md-9">
                        <input name="soDienThoai_ncc" placeholder="Nhập số điện thoại" value="{{old('soDienThoai_ncc')}}" class="form-control" type="text">
                        <span style="color: red;">
                            @error('soDienThoai_ncc')
                            {{$message}}
                            @enderror
                        </span>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-3 control-label " for="val-username">Tình trạng: <span class="text-danger">*</span></label>
                    <div class="col-md-9" style="display: flex">
                        <select class="form-control" id="val-skill" name="tinhTrang_ncc">
                            <option value="1">Hoạt động</option>
                            <option value="0">Khoá</option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-3 control-label " for="val-username">Loại hàng hoá: <span class="text-danger">*</span></label>
                    <div class="col-md-9" style="display: flex">
                        <select class="form-control" id="val-skill" name="id_loaiHangHoa">
                            @foreach ($loaiHangHoa as $key => $val )
                                <option value="{{$val->id_loaiHangHoa}}">{{$val->ten_loaiHangHoa}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-md-8 col-md-offset-3">
                        <a href="{{route('supplier.all')}}" class="btn btn-instagram" type="button">Quay lại</a>
                        <button class="btn  btn-success save_supplier" type="submit">Thêm</button>
                    </div>
                </div>
            </form>
        </div>  
    </div>
</div>
<!--End row-->
@endsection

@section('ajax_js')
    <script type="text/javascript">
        $(document).ready(function(){

            
            
        });
    </script>
@endsection