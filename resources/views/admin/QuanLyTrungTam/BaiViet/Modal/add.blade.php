<div  id="AddPostsForm" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">
      <!-- Modal content-->
        <form id="addPForm" action="{{route('posts.save')}}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="modal-content">
                <div class="modal-header text-center">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Thêm bài viết mới</h4>
                </div>
                <div class="modal-body">
                    <div>
                        <label>Tên bài viết: <span class="text-danger">*</span></label>
                        <input value="{{old('tenBaiViet')}}" class="form-control" type="text" placeholder="Nhập tên bài viết" name="tenBaiViet" style="margin: 5px 0">
                        <span class="text text-danger error-text tenBaiViet_error"></span>
                    </div>
                    <div>
                        <label>Ảnh đại diện: <span class="text-danger">*</span></label>
                        <input class="form-control img-preview1" type="file" name="hinhAnh" style="margin: 5px 0">
                        <img src="https://tintuckhanhhoa.com/uploads/no_image_available.jpg" alt="" id="previewImg" width="30%">
                        <span class="text text-danger error-text hinhAnh_error"></span>
                    </div>
                    <div>
                        <label>Nội dung: <span class="text-danger">*</span></label>
                        <textarea rows="2" name="noiDung" class="form-control" id="noiDung" placeholder="Nhập nội dung">{{old('noiDung')}}</textarea>
                        <span class="text text-danger error-text noiDung_error"></span>
                    </div>
                    <div>
                        <label>Tác giả: <span class="text-danger">*</span></label>
                        <input value="{{old('tacGia')}}" class="form-control" type="text" placeholder="Nhập tên tác giả" name="tacGia" style="margin: 5px 0">
                        <span class="text text-danger error-text tacGia_error"></span>
                    </div>
                    <div>
                        <label>Ngày đăng: <span class="text-danger">*</span></label>
                        <input value="{{old('ngayDang')}}" class="form-control" type="date" name="ngayDang" style="margin: 5px 0">
                        <span class="text text-danger error-text ngayDang_error"></span>
                    </div>
                    <div>
                        <label>Tình trạng: <span class="text-danger">*</span></label>
                        <div style="display: flex">
                            <select class="form-control" id="val-skill" name="tinhTrang">
                                <option value="1">Hoạt động</option>
                                <option value="0">Khoá</option>
                            </select>
                        </div>
                        <span class="text text-danger error-text tinhTrang_error"></span>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger round" data-dismiss="modal" style="float: left;">Đóng</button>
                    <button class="btn btn-primary round" style="float: right;" type="submit">Thêm</button>
                </div>
            </div>
        </form>
    </div>
</div>

