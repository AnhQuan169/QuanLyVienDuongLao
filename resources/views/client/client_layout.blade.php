<!doctype html>
<html lang="en">

<head>
    <title>{{$title}}</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" href="{{asset('public/client/images/logo.png')}}" type="image/png">

    <!-- Bootstrap CSS v5.0.2 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="{{asset('public/client/libs/bootstrap-5.1.3-dist/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('public/client/css/style.css')}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="{{asset('public/admin/css/css/icons/font-awesome/font-awesome.css')}}" rel="stylesheet"> 
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/fontawesome.min.css" />
    <link rel="stylesheet" href="{{asset('public/admin/css/css/fontawesome/all.min.css')}}">
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="http://cdn.bootcss.com/toastr.js/latest/css/toastr.min.css">
    
</head>

<body>

    <div id="wallpaper">
        <section>
            <header>
                <div class="logo-header">
                    <img src="{{asset('public/client/images/logo.png')}}" alt="" srcset="">
                    <h3>Trung tâm Công tác xã hội và Quỹ Bảo trợ trẻ em tỉnh Thừa Thiên Huế</h3>
                </div>
                <div id="myHeader">
                    <div class="top-header">
                        <div class="container">
                            <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6 my-2">
                                    <div class="input-group" style="width: 400px">
                                        <input type="text" class="form-control" placeholder="Nhập từ khoá" aria-label="Recipient's username with two button addons">
                                        <button class="btn btn-success" type="submit">Tìm kiếm</button>
                                    </div>
                                </div>
        
                                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6 my-2">
                                    <div class="log text-end">
                                        @if(Auth::check())
                                            <div class="dropdown">
                                                <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu2" data-bs-toggle="dropdown" aria-expanded="false">
                                                    <img src="{{asset('public/storage/'.Auth::user()->anhDaiDien)}}" alt="" style="width: 30px" />
                                                    {{Auth::user()->hoTen}}
                                                </button>
                                                <ul class="dropdown-menu" aria-labelledby="dropdownMenu2">
                                                    <li><button class="dropdown-item" type="button">Thông tin cá nhân</button></li>
                                                    <li><a href="{{route('logout')}}"> <button class="dropdown-item" type="button">Đăng xuất</button></a></li>
                                                </ul>
                                            </div>
                                        @else
                                            <a class="btn btn-primary big-login" data-toggle="modal" href="javascript:void(0)" onclick="openLoginModal();">Đăng nhập</a>
                                            <a class="btn btn-primary big-register" data-toggle="modal" href="javascript:void(0)" onclick="openRegisterModal();">Đăng ký</a>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- Login --}}
                    <div class="modal fade login" id="loginModal">
                        <div class="modal-dialog login animated">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true" style="width: 30px;border: none;background-color: red"><i style="color: #fff" class="fa fa-times"></i></button>
                                    <h4 class="modal-title">Đăng nhập</h4>
                                </div>
                                <div class="modal-body">
                                    @include('client.Modal.login')
                                    @include('client.Modal.register')
                                </div>
                                <div class="modal-footer">
                                    <div class="forgot login-footer">
                                        <span>
                                            <a href="javascript: showRegisterForm();">Tạo tài khoản mới ?</a>
                                        </span>
                                    </div>
                                    <div class="forgot register-footer" style="display:none">
                                        <span>Bạn đã có tài khoản?</span>
                                        <a href="javascript: showLoginForm();">Đăng nhập</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- end Login --}}
                    <div class="menu-header" >
                        <div class="container">
                            <div class="main-menu text-center">
                                <ul>
                                    <li><a href="{{route('home')}}">Trang chủ</a></li>
                                    <li><a href="#">Thông tin chung</a>
                                        <ul>
                                            <li><a href="{{route('central.information')}}">Thông tin trung tâm</a></li>
                                            <li><a href="{{route('registration.procedure')}}">Thủ tục đăng ký</a></li>
                                        </ul>
                                    </li>
                                    <li><a href="#">Tham quan trung tâm</a>
                                        <ul>
                                            <li><a href="{{route('register.visit')}}">Đăng ký tham quan</a></li>
                                            <li><a href="#">Lịch tham quan</a></li>
                                        </ul>
                                    </li>
                                    @hasrole('3')
                                        <li><a href="{{route("list_elderly.client")}}">Danh sách người cao tuổi</a></li>
                                    @endhasrole
                                    <li><a href="#">Các bài viết</a></li>
                                    <li><a href="#">Liên hệ</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                
            </header>
        </section>
        <!-- <div id="content"> -->
            @yield('client_layout')
            
        <!-- </div> -->
        @include('client.Layout.footer')
    </div>


    <!-- Bootstrap JavaScript Libraries -->
    <script src="{{asset('public/client/libs/bootstrap-5.1.3-dist/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{asset('public/client/js/main.js')}}"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
    <script src="{{asset('public/client/js/login-register.js')}}"></script>

    {{-- Hiển thị thông báo --}}
    <script src="http://cdn.bootcss.com/toastr.js/latest/js/toastr.min.js"></script>
    {!! Toastr::message() !!}

    {{-- Javascript mỗi trang --}}
    @yield('ajax_client')

    {{-- Hiển thị giao diện thêm thông tin tài khoản đăng ký --}}
    <script type="text/javascript">
        $(document).ready(function() {
            // document.getElementById("accountBox").style.display = 'none';
            // $('#btn1').click(function(e) {
            //     document.getElementById("registerBox").style.display = 'none';
            //     document.getElementById("accountBox").style.display = 'block';
            // });
            $('#btn2').click(function(e) {
                document.getElementById("bnn1").style.display = 'block';
                document.getElementById("bnn2").style.display = 'none';
            })

        })
    </script>

    <script type="text/javascript">
        $(document).ready(function() {
            $('#registerForm').submit(function(e) {
                e.preventDefault();
                $.ajax({
                    url: $(this).attr('action'),
                    method:  "POST",
                    data: new FormData(this),
                    processData: false,
                    dataType: 'json',
                    contentType: false,
                    beforeSend: function () {
                        $(document).find('span.error-text').text('');
                    },
                    success: function(data) {
                        if(data.status == 400) {
                            $.each(data.error, function(prefix, val) {
                                $('span.'+prefix + '_error').text(val[0]);
                            });
                            console.log('Fail');
                        }

                        if (data.errors) {
                            $('.errors').addClass('alert alert-danger').html(''); 
                            $('#registerederror').text(data.errors);
                        }

                        if (data.success) {
                            document.getElementById("bnn1").style.display = 'none';
                            document.getElementById("bnn2").style.display = 'block';
                            $('.errors').removeClass('alert alert-danger').html(''); 
                        }
                    }  
                });
                
            })

            $('#accountForm').submit(function(e) {
                e.preventDefault();
                $.ajax({
                    url: $(this).attr('action'),
                    method:  "POST",
                    data: new FormData(this),
                    processData: false,
                    dataType: 'json',
                    contentType: false,
                    beforeSend: function () {
                        $(document).find('span.error-text').text('');
                    },
                    success: function(data) {
                        if(data.status == 400) {
                            $.each(data.error, function(prefix, val) {
                                $('span.'+prefix + '_error').text(val[0]);
                            });
                            console.log('Fail');
                        }

                        if (data.errors) {
                            $('.errors').addClass('alert alert-danger').html('');
                            $('#accounterror').text(data.errors);
                        }

                        if (data.success) {
                            $('.success').addClass('alert alert-success').html(''); 
                            $('#registered').text(data.success);
                            jQuery('#registerForm').trigger("reset"); 
                            document.getElementById("bnn1").style.display = 'none';
                            document.getElementById("bnn2").style.display = 'none';
                            openLoginModal();
                        }
                    }  
                });
                
            })


            //Login Functionality
            $('#loginForm').submit(function(e) {
                e.preventDefault();
                var name = $('#lname').val();
                var password = $('#lpassword').val();
                var token = $('input[name="_token"').val();

                $.ajax({
                    url: '{{route("login.client")}}',
                    type: "post",
                    data: {
                        '_token': token,
                        'name': name,
                        'password': password
                    },
                    success: function(res) {
                        console.log(res)
                        if (res.error) {
                            $('.success').removeClass('alert alert-success').html(''); 
                            $('.error').addClass('alert alert-danger').html(''); 
                            $('#loginerror').text(res.error);
                        }
                        if (res.success) {
                            window.location.href = '{{route("list_elderly.client")}}';
                            // window.location.reload();
                        }
                    }
                })
            });

            // Anh dai dien 
            $('#registerForm input[name="anhDaiDienc"]').on('change', function() {
                var file = $('#registerForm').find('.img-preview').get(0).files[0];
                if(file) {
                    var reader = new FileReader();
                    reader.onload = function() {
                        $('#registerForm').find('#previewImg').attr('src', reader.result);
                    }
                    reader.readAsDataURL(file);
                }
            });
        });
    </script>
</body>

</html>