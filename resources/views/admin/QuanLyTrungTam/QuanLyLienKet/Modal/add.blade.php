<div id="AddLinksModal" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">
      <!-- Modal content-->
        <form id="addLinksForm" action="{{route('links.save')}}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="modal-content">
                <div class="modal-header text-center">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Thêm liên kết mới</h4>
                </div>
                <div class="modal-body">
                    <div>
                        <label>Hình ảnh liên kết: <span class="text-danger">*</span></label>
                        <input class="form-control img-preview4" type="file" name="hinhAnh_lienket" style="margin: 5px 0">
                        <img src="https://tintuckhanhhoa.com/uploads/no_image_available.jpg" alt="" id="previewImg4" width="30%">
                        <span class="text text-danger error-text hinhAnh_lienket_error"></span>
                    </div>
                    <div>
                        <label>Link liên kết: <span class="text-danger">*</span></label>
                        <input value="{{old('link_lienket')}}" class="form-control" type="text" placeholder="Nhập địa chỉ liên kết" name="link_lienket" style="margin: 5px 0">
                        <span class="text text-danger error-text link_lienket_error"></span>
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

