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
            <a>Quản lý bài viết</a>
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
                
                <form class="js-validation-bootstrap form-horizontal" action="{{route('posts.update',$post->id_baiViet)}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label class="col-md-2 control-label " for="val-username">Tên bài viết: <span class="text-danger">*</span></label>
                        <div class="col-md-10">
                            <input name="tenBaiViet" value="{{$post->tenBaiViet}}" class="form-control" type="text" placeholder="Nhập tên bài viết">
                            @if($errors->any('tenBaiViet'))
                                <span class="text-danger">{{$errors->first('tenBaiViet')}}</span>
                            @endif
                        </div>
                        
                    </div>
                    <div class="form-group">
                        <label class="col-md-2 control-label " for="val-username">Hình ảnh: <span class="text-danger">*</span></label>
                        <div class="col-md-10">
                            <input name="hinhAnh" class="form-control" value="{{$post->hinhAnh}}" type="file">
                            <div id="large13" style="display: none;" class="cover-image-ncc">
                                <img src="{{asset('public/storage/'.$post->hinhAnh)}}"/>
                                <div id="close13" class="close-ncc">&times</div>
                            </div>
                            <img id="small13" class="small-nd" src="{{asset('public/storage/'.$post->hinhAnh)}}" />
                        </div>
                        
                    </div>
                    <div class="form-group">
                        <label class="col-md-2 control-label" for="val-username">Nội dung <span class="text-danger">*</span></label>
                        <div class="col-md-10">
                            <textarea style="resize: none" rows="4" name="noiDung" class="form-control contenttb" id="noiDung1" placeholder="Nhập nội dung">{{$post->noiDung}}</textarea>
                        </div>
                        @if($errors->any('noiDung'))
                            <span class="text-danger">{{$errors->first('noiDung')}}</span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label class="col-md-2 control-label " for="val-username">Tác giả: <span class="text-danger">*</span></label>
                        <div class="col-md-10">
                            <input name="tacGia" value="{{$post->tacGia}}" class="form-control" type="text" placeholder="Nhập tên tác giả">
                            @if($errors->any('tacGia'))
                                <span class="text-danger">{{$errors->first('tacGia')}}</span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-2 control-label " for="val-username">Ngày đăng bài: <span class="text-danger">*</span></label>
                        <div class="col-md-10">
                            <input name="ngayDang" value="{{$post->ngayDang}}" class="form-control" type="date">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-2 control-label " for="val-username">Tình trạng: <span class="text-danger">*</span></label>
                        <div class="col-md-10" style="display: flex">
                            <select class="form-control" id="val-skill" name="tinhTrang">
                                @if ($post->tinhTrang == 1)
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
                        <label class="col-md-2 control-label " for="val-username">Người thêm: <span class="text-danger">*</span></label>
                        <div class="col-md-10">
                            <input value="{{$post->hoTen}}" class="form-control" type="text" disabled>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-8 col-md-offset-3">
                            <a href="{{route('posts.all')}}" class="btn  btn-instagram" type="button">Quay lại</a>
                            <button class="btn  btn-success save_user" type="submit">Cập nhật</button>
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
        $('#noiDung1').summernote();
        $(document).ready(function(){

            // Hình ảnh
            $('#close13').click(function(){
                $("#large13").hide();
                $("#small13").show();
            });

            $('#small13').click(function(){
                $("#large13").show();
                $("#small13").hide();
            });
            
            
        });
    </script>
@endsection