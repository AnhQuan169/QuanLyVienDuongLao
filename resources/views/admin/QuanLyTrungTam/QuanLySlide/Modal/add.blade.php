<div id="AddSlides" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">
      <!-- Modal content-->
        <form id="addSlidesForm" action="{{route('slides.save')}}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="modal-content">
                <div class="modal-header text-center">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Thêm slide mới</h4>
                </div>
                <div class="modal-body">
                    <div>
                        <label>Tên slide: <span class="text-danger">*</span></label>
                        <input value="{{old('ten_slide')}}" class="form-control" type="text" placeholder="Nhập tên slide" name="ten_slide" style="margin: 5px 0">
                        <span class="text text-danger error-text ten_slide_error"></span>
                    </div>
                    <div>
                        <label>Hình ảnh: <span class="text-danger">*</span></label>
                        <input class="form-control img-preview2" type="file" name="hinhAnh_slide" style="margin: 5px 0">
                        <img src="https://tintuckhanhhoa.com/uploads/no_image_available.jpg" alt="" id="previewImg2" width="30%">
                        <span class="text text-danger error-text hinhAnh_slide_error"></span>
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

