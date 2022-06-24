<div id="EditSlides" class="modal fade" role="dialog">
    <div class="modal-dialog">
      <!-- Modal content-->
        <form id="editSlidesForm" method="post" enctype="multipart/form-data">
            @csrf
            <div class="modal-content">
                <div class="modal-header text-center">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Chỉnh sửa slide</h4>
                </div>
                <div class="modal-body">
                    <div>
                        <label>Mã slide: <span class="text-danger">*</span></label>
                        <input id="id_slide_edit" class="form-control" type="text" style="margin: 5px 0" disabled>
                    </div>
                    <div>
                        <label>Tên slide: <span class="text-danger">*</span></label>
                        <input id="ten_slide_edit" class="form-control" type="text" placeholder="Nhập tên slide" name="ten_slide_edit" style="margin: 5px 0">
                        <span class="text text-danger error-text ten_slide_edit_error"></span>
                    </div>
                    <div>
                        <label>Hình ảnh: <span class="text-danger">*</span></label>
                        <input class="form-control img-preview3" type="file" name="hinhAnh_slide_edit" style="margin: 5px 0">
                        {{-- <img src="https://tintuckhanhhoa.com/uploads/no_image_available.jpg" alt="" id="previewImg3" width="30%"> --}}
                        <div id="insertedImages"></div>
                        <span class="text text-danger error-text hinhAnh_slide_edit_error"></span>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger round" data-dismiss="modal" style="float: left;">Đóng</button>
                    <button class="btn btn-primary round" style="float: right;" type="submit">Cập nhật</button>
                </div>
            </div>
        </form>
    </div>
</div>

