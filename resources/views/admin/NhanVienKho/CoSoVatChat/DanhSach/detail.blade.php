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
            <a>Quản lý cơ sở vật chất</a>
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
                
                <form class="js-validation-bootstrap form-horizontal" action="{{route('infrastructure.update',$csvc->id_csvc)}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <h4 class="text-center">Thông tin cơ sở vật chất</h4>
                    <div class="form-group">
                        <label class="col-md-3 control-label " for="val-username">Tên cơ sở vật chất: <span class="text-danger">*</span></label>
                        <div class="col-md-9">
                            <input name="ten" value="{{$csvc->ten}}" class="form-control" type="text" placeholder="Nhập tên cơ sở vật chất">
                            <span style="color: red;">
                                @error('ten')
                                {{$message}}
                                @enderror
                            </span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label " for="val-username">Số lượng: <span class="text-danger">*</span></label>
                        <div class="col-md-9">
                            <input name="soLuong" value="{{$csvc->soLuong}}" max="200" min="0" class="form-control" type="number" placeholder="Nhập số lượng">
                            <span style="color: red;">
                                @error('soLuong')
                                {{$message}}
                                @enderror
                            </span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label " for="val-username">Số lượng tồn: <span class="text-danger">*</span></label>
                        <div class="col-md-9">
                            <input name="soLuongTon" value="{{$csvc->soLuongTon}}" max="200" min="0" class="form-control" type="number" placeholder="Nhập số lượng tồn">
                            <span style="color: red;">
                                @error('soLuongTon')
                                {{$message}}
                                @enderror
                            </span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label " for="val-username">Số lượng hư hỏng: <span class="text-danger">*</span></label>
                        <div class="col-md-9">
                            <input name="soLuongHuHong" value="{{$csvc->soLuongHuHong}}" max="200" min="0" class="form-control" type="number" placeholder="Nhập số lượng hư hỏng">
                            <span style="color: red;">
                                @error('soLuongHuHong')
                                {{$message}}
                                @enderror
                            </span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label " for="val-username">Số lượng đang sử dụng: <span class="text-danger">*</span></label>
                        <div class="col-md-9">
                            <input name="soLuongDangSuDung" value="{{$csvc->soLuongDangSuDung}}" max="200" min="0" class="form-control" type="number" placeholder="Nhập số lượng đang sử dụng">
                            <span style="color: red;">
                                @error('soLuongDangSuDung')
                                {{$message}}
                                @enderror
                            </span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label " for="val-username">Tình trạng: <span class="text-danger">*</span></label>
                        <div class="col-md-9" style="display: flex">
                            <select class="form-control" id="val-skill" name="tinhTrang">
                                @if ($csvc->tinhTrang == 1)
                                    <option value="1">Hoạt động</option>
                                    <option value="0">Khoá</option>
                                @else
                                    <option value="0">Khoá</option>
                                    <option value="1">Hoạt động</option>
                                @endif
                                
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label " for="val-username">Nhà cung cấp: <span class="text-danger">*</span></label>
                        <div class="col-md-9" style="display: flex">
                            <select class="form-control" id="val-skill" name="id_nhacungcap">
                                @foreach ($nhacungcap as $key => $val )
                                    @if ($val->id_nhacungcap == $csvc->id_nhacungcap)
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
                            <a href="{{route('infrastructure.all')}}" class="btn  btn-instagram" type="button">Quay lại</a>
                            <button class="btn btn-success save_infrastructure" type="submit">Cập nhật</button>
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