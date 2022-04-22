<!doctype html>
<html lang="en">
    <head>
        <title>Quản lý viện dưỡng lão</title>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <!-- Bootstrap CSS v5.0.2 -->
        <link rel="stylesheet" href="{{asset('public/client/libs/bootstrap-5.1.3-dist/css/bootstrap.min.css')}}">
        <link rel="stylesheet" href="{{asset('public/client/css/style.css')}}">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" />
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    </head>
    <body>

        <div id="wallpaper">
            <header>
                <div class="top-header my-2">
                    <div class="container">
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6 my-2">
                                <div class="input-group">
                                    <input type="text" class="form-control" placeholder="Nhập từ khoá" aria-label="Recipient's username with two button addons">
                                    <button class="btn btn-success" type="submit">Tìm kiếm</button>
                                </div>
                            </div>
    
                            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6 my-2">
                                <div class="log text-end">
                                    <a type="button" class="btn btn-primary" href="../pages/login.html">Đăng nhập</a>
                                    <a type="button" class="btn btn-primary" href="../pages/register.html">Đăng ký</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="main-header">
                    <div class="container">
                        {{-- <div class="logo text-center">
                            <img src="{{asset('public/client/images/ant-man-and-the-wasp-movie-w03.jpg')}}" alt="">
                        </div> --}}
                    </div>
                </div>
                <div class="menu-header">
                    <div class="container">
                        <div class="main-menu text-center">
                            <ul>
                                <li><a href="index.html">Trang chủ</a></li>
                                <li><a href="#">Thông tin chung</a>
                                    <ul>
                                        <li><a href="../pages/XemThongTinTrungTam.html">Thông tin trung tâm</a></li>
                                        <li><a href="../pages/ThuTucDangKy.html">Thủ tục đăng ký</a></li>
                                    </ul>
                                </li>
                                <li><a href="#">Tham quan trung tâm</a>
                                    <ul>
                                        <li><a href="../pages/DangKyThamQuan.html">Đăng ký tham quan</a></li>
                                        <li><a href="#">Lịch tham quan</a></li>
                                    </ul>
                                </li>
                                <li><a href="#">Các bài báo</a></li>
                                <li><a href="#">Các dịch vụ</a></li>
                                <li><a href="#">Liên hệ</a></li>
                                <li><a href="#">Hỗ trợ</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </header>