<div class="box">
    <div class="content">
        {{-- <div class="error"></div> --}}
        <div class="form loginBox">
            <div id="loginerror" class="error text-danger"></div>
            <div id="registered" class="success text-success "></div>
            <form id="loginForm">
                @csrf
                <label for="">Tên đăng nhập: <span class="text-danger">*</span></label>
                <input id="lname" class="form-control" type="text" placeholder="Nhập tên đăng nhập" name="lname" style="margin: 10px 0">
                <label for="">Mật khẩu: <span class="text-danger">*</span></label>
                <input id="lpassword" class="form-control" type="password" placeholder="Nhập mật khẩu" name="lpassword" style="margin: 10px 0">
                <input class="btn btn-primary btn-login" type="submit" value="Đăng nhập">
            </form>
        </div>
    </div>
</div>