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
            <h2 class="header-title">Chi tiết tình hình sức khoẻ ông(bà) {{$thsk->hoTenNCC.' - '.date('d/m/Y', strtotime($thsk->ngayKham))}}</h2>
            <form action="{{route('health.elderly.update',$thsk->id_thsk)}}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Mã số:</label>
                                    <input value="{{$thsk->id_thsk}}" class="form-control" type="text" disabled>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Nhân viên y tế:</label>
                                    <input value="{{$thsk->hoTen}}" class="form-control" type="text" disabled>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label>Huyết áp (mmHg): <span class="text-danger">*</span></label>
                            <div>
                                <input name="huyetAp" value="{{$thsk->huyetAp}}" min="0" max="200" class="form-control" type="number" placeholder="Nhập số huyết áp (mmHg)">
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
                                <textarea style="resize: none" rows="4" name="trieuChung" class="form-control contenttb" id="ckeditor2" placeholder="Nhập triệu chứng">{{$thsk->trieuChung}}</textarea>
                                <span style="color: red;">
                                    @error('trieuChung')
                                    {{$message}}
                                    @enderror
                                </span>
                            </div>
                        </div>

                    </div> <!--/col-md-6-->
                    
                    <div class="col-md-6">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Ngày khám:</label>
                                    <input value="{{date('d-m-Y', strtotime($thsk->ngayKham))}}" class="form-control" type="text" disabled>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Thời gian khám:</label>
                                    <input value="{{date('H:i A', strtotime($thsk->thoiGian))}}" class="form-control" type="text" disabled>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Nhịp tim (nhịp/phút): <span class="text-danger">*</span></label>
                                    <div>
                                        <input name="nhipTim" value="{{$thsk->nhipTim}}" min="0" max="250" class="form-control" type="number" placeholder="Nhập số nhịp tim ">
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
                                        <input name="canNang" value="{{$thsk->canNang}}" min="0" max="200" class="form-control" type="number" placeholder="Nhập số cân nặng ">
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
                                <textarea style="resize: none" rows="4" name="ghiChu" class="form-control contenttb" id="ckeditor3" placeholder="Nhập ghi chú">{{$thsk->ghiChu}}</textarea>
                                <span style="color: red;">
                                    @error('ghiChu')
                                    {{$message}}
                                    @enderror
                                </span>
                            </div>
                        </div>
                        
                    </div> <!--/col-md-6-->

                    <div class="col-md-12">
                        <div class="form-group">
                            <div class="col-md-12">
                                <a href="{{route('health.elderly.detail',$thsk->id_nguoicaotuoi)}}" class="btn btn-instagram" type="button">Quay lại</a>
                                <button class="btn  btn-success update_health_elderly" type="submit">Cập nhật</button>
                            </div>
                        </div>
                        
                    </div>
                    
                </div>
            </form>
        </div>  
    </div>
</div>
<!--End row-->
@endsection

@section('ajax_js')
    <script>
        $(function(){
            
        });
    </script>
@endsection