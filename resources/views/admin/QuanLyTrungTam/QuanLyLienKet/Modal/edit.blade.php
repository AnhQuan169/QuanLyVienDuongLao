<div id="EditLinksModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
      <!-- Modal content-->
        <form id="editLinksForm" method="post" enctype="multipart/form-data">
            @csrf
            <div class="modal-content">
                <div class="modal-header text-center">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Chỉnh sửa slide</h4>
                </div>
                <div class="modal-body">
                    <div>
                        <label>Mã liên kết: <span class="text-danger">*</span></label>
                        <input id="id_lienket_edit" class="form-control" type="text" style="margin: 5px 0" disabled>
                    </div>
                    <div>
                        <label>Link liên kết: <span class="text-danger">*</span></label>
                        <input id="link_lienket_edit" class="form-control" type="text" placeholder="Nhập link liên kết" name="link_lienket_edit" style="margin: 5px 0">
                        <span class="text text-danger error-text link_lienket_edit_error"></span>
                    </div>
                    <div>
                        <label>Hình ảnh: <span class="text-danger">*</span></label>
                        <input class="form-control img-preview5" type="file" name="hinhAnh_lienket_edit" style="margin: 5px 0">
                        <div id="insertedImages1"></div>
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

