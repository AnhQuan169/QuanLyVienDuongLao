<div id="RegisterElderlyModal" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">
      <!-- Modal content-->
        
        <form id="registerElderlyForm" action="{{route('register.elderly')}}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="modal-content">
                <div class="modal-header text-center">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Đăng ký hồ sơ người cao tuổi mới</h4>
                </div>
                <div class="modal-body">
                    <div id="registerElderlyError" class="errors text-danger"></div>
                    <div id="registerElderlySuccess" class="success text-success "></div>
                    <div>
                        <label>Họ tên: <span class="text-danger">*</span></label>
                        <input value="{{old('hoTenNCC')}}" class="form-control" type="text" placeholder="Nhập họ tên người cao tuổi" name="hoTenNCC" style="margin: 5px 0">
                        <span class="text text-danger error-text hoTenNCC_error"></span>
                    </div>
                    <div class="form-group">
                        <label for="">Giới tính: <span class="text-danger">*</span></label>
                        <div style="margin: 5px 0;">
                            <span>
                                <label><input name="gioiTinhNCC" value="1" type="radio"> Nam</label>
                            </span>
                            <span style="margin-left: 20px">
                                <label><input name="gioiTinhNCC" value="0" type="radio"> Nữ</label>
                            </span>
                        </div>
                        <span class="text text-danger error-text gioiTinhNCC_error"></span>
                    </div>
                    <div class="form-group">
                        <label for="">Ngày sinh: <span class="text-danger">*</span></label>
                        <input value="{{old('ngaySinhNCC')}}" class="form-control" type="date" name="ngaySinhNCC" style="margin: 5px 0">
                        <span class="text text-danger error-text ngaySinhNCC_error"></span>
                    </div>
                    <div class="form-group">
                        <label for="">Ảnh đại diện: <span class="text-danger">*</span></label>
                        <input class="form-control img-preview-add" type="file" name="anhDaiDienNCC" style="margin: 5px 0">
                        <img src="https://tintuckhanhhoa.com/uploads/no_image_available.jpg" alt="" id="previewImgadd" width="20%">
                        <span class="text text-danger error-text anhDaiDienNCC_error"></span>
                    </div>
                    <div class="form-group">
                        <label for="">Số căn cước công dân: <span class="text-danger">*</span></label>
                        <input value="{{old('CCCD_NCC')}}" class="form-control" type="text" placeholder="Nhập số căn cước công dân" name="CCCD_NCC" style="margin: 5px 0">
                        <span class="text text-danger error-text CCCD_NCC_error"></span>
                    </div>
                    <div class="form-group">
                        <label for="">Số điện thoại: <span class="text-danger">*</span></label>
                        <input value="{{old('soDienThoaiNCC')}}" class="form-control" type="text" placeholder="Nhập số điện thoại" name="soDienThoaiNCC" style="margin: 5px 0">
                        <span class="text text-danger error-text soDienThoaiNCC_error"></span>
                    </div>
                    <div class="form-group">
                        <label for="">Địa chỉ: <span class="text-danger">*</span></label>
                        <input value="{{old('diaChiNCC')}}" class="form-control" type="text" placeholder="Nhập địa chỉ" name="diaChiNCC" style="margin: 5px 0">
                        <span class="text text-danger error-text diaChiNCC_error"></span>
                    </div>
                    <div class="form-group">
                        <label for="">Ảnh đơn đăng ký của đối tượng hoặc người giám hộ: <span class="text-danger">*</span></label>
                        <input class="form-control" type="file" name="anhDon" style="margin: 5px 0">
                        <span class="text text-danger error-text anhDon_error"></span>
                    </div>
                    <div class="form-group">
                        <label for="">Ảnh tờ khai đề nghị trợ giúp: <span class="text-danger">*</span></label>
                        <input class="form-control" type="file" name="anhToKhaiDeNghiTroGiup" style="margin: 5px 0">
                        <span class="text text-danger error-text anhToKhaiDeNghiTroGiup_error"></span>
                    </div>
                    <div class="form-group">
                        <label for="">Ảnh sơ yếu lý lịch: <span class="text-danger">*</span></label>
                        <input class="form-control" type="file" name="anhSoYeuLyLich" style="margin: 5px 0">
                        <span class="text text-danger error-text anhSoYeuLyLich_error"></span>
                    </div>
                    <div class="form-group">
                        <label for="">Ảnh giấy chứng nhận HIV (nếu có): <span class="text-danger">*</span></label>
                        <input class="form-control" type="file" name="anhGiayChungNhanHIV" style="margin: 5px 0">
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-danger round" data-bs-dismiss="modal" style="float: left;">Đóng</button>
                    <button class="btn btn-primary round" style="float: right;" type="submit">Đăng ký</button>
                </div>
            </div>
        </form>
    </div>
</div>
