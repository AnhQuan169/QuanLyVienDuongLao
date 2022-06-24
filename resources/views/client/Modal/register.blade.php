<div class="box"> 
    <div class="content registerBox" id="bnn1" style="display:none;">
        <div class="form">
            <div id="registerederror" class="errors text-danger"></div>
            <form id="registerForm" action="{{route('register.client')}}" method="post" enctype="multipart/form-data">
                @csrf
                <h5 class="text-center">Thông tin chung</h5>
                <div class="form-group">
                    <label for="">Họ tên người dùng: <span class="text-danger">*</span></label>
                    <input id="hoTenc" value="{{old('hoTenc')}}" class="form-control" type="text" placeholder="Nhập tên đăng nhập" name="hoTenc" style="margin: 5px 0">
                    <span class="text text-danger error-text hoTenc_error"></span>
                </div>
                <div class="form-group">
                    <label for="">Email: <span class="text-danger">*</span></label>
                    <input id="emailc" value="{{old('emailc')}}" class="form-control" type="email" placeholder="Nhập địa chỉ email" name="emailc" style="margin: 5px 0">
                    <span class="text text-danger error-text emailc_error"></span>
                </div>
                <div class="form-group">
                    <label for="">Giới tính: <span class="text-danger">*</span></label>
                    <div style="margin: 5px 0;">
                        <span>
                            <label><input name="gioiTinhc" value="1" type="radio"> Nam</label>
                        </span>
                        <span style="margin-left: 20px">
                            <label><input name="gioiTinhc" value="0" type="radio"> Nữ</label>
                        </span>
                    </div>
                    <span class="text text-danger error-text gioiTinhc_error"></span>
                </div>
                <div class="form-group">
                    <label for="">Ngày sinh: <span class="text-danger">*</span></label>
                    <input id="ngaySinhc" value="{{old('ngaySinhc')}}" class="form-control" type="date" name="ngaySinhc" style="margin: 5px 0">
                    <span class="text text-danger error-text ngaySinhc_error"></span>
                </div>
                <div class="form-group">
                    <label for="">Ảnh đại diện: <span class="text-danger">*</span></label>
                    <input id="anhDaiDienc" class="form-control img-preview" type="file" name="anhDaiDienc" style="margin: 5px 0">
                    <img src="https://tintuckhanhhoa.com/uploads/no_image_available.jpg" alt="" id="previewImg" width="30%">
                    <span class="text text-danger error-text anhDaiDienc_error"></span>
                </div>
                <div class="form-group">
                    <label for="">Số căn cước công dân: <span class="text-danger">*</span></label>
                    <input id="CCCDc" value="{{old('CCCDc')}}" class="form-control" type="text" placeholder="Nhập số căn cước công dân" name="CCCDc" style="margin: 5px 0">
                    <span class="text text-danger error-text CCCDc_error"></span>
                </div>
                <div class="form-group">
                    <label for="">Số điện thoại: <span class="text-danger">*</span></label>
                    <input id="soDienThoaic" value="{{old('soDienThoaic')}}" class="form-control" type="text" placeholder="Nhập số điện thoại" name="soDienThoaic" style="margin: 5px 0">
                    <span class="text text-danger error-text soDienThoaic_error"></span>
                </div>
                <div class="form-group">
                    <label for="">Địa chỉ: <span class="text-danger">*</span></label>
                    <input id="diaChic" value="{{old('diaChic')}}" class="form-control" type="text" placeholder="Nhập địa chỉ" name="diaChic" style="margin: 5px 0">
                    <span class="text text-danger error-text diaChic_error"></span>
                </div>
                <div>
                    <button class="btn btn-primary btn-register" style="margin-top: 10px" id="btn1" type="submit">Tiếp theo</button>
                </div>
            </form>
        </div>
    </div>
    <div class="content accountBox" id="bnn2" style="display:none;">
        <div class="form">
            <div id="accounterror" class="errors text-danger"></div>
            <form id="accountForm" action="{{route('account.client')}}" method="post" enctype="multipart/form-data">
                @csrf
                <h5 class="text-center" style="margin-top: 10px">Thông tin tài khoản</h5>
                <div class="form-group">
                    <label for="">Tên tài khoản: <span class="text-danger">*</span></label>
                    <input id="namec" value="{{old('namec')}}" class="form-control" type="text" placeholder="Nhập tên tài khoản" name="namec" style="margin: 5px 0">
                    <span class="text text-danger error-text namec_error"></span>
                </div>
                <div class="form-group">
                    <label for="">Mật khẩu: <span class="text-danger">*</span></label>
                    <input id="passwordc" class="form-control" type="password" placeholder="Nhập mật khẩu" name="passwordc" style="margin: 5px 0">
                    <span class="text text-danger error-text passwordc_error"></span>
                </div>
                <div class="form-group">
                    <label for="">Nhập lại mật khẩu: <span class="text-danger">*</span></label>
                    <input id="confirmpww" class="form-control" type="password" placeholder="Nhập lại mật khẩu" name="confirmpww" style="margin: 5px 0">
                    <span class="text text-danger error-text confirmpww_error"></span>
                </div>
                <div>
                    <input class="btn btn-primary" style="margin-top: 10px" type="button" id="btn2" value="Quay lại"/>
                    <button class="btn btn-primary btn-register" style="margin-top: 10px" type="submit">Tạo</button>
                </div>
            </form>
        </div>
    </div>
</div>