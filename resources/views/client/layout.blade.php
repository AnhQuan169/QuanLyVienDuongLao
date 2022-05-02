<!doctype html>
<html lang="en">

<head>
    <title>Quản lý viện dưỡng lão</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS v5.0.2 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="../assets/libs/bootstrap-5.1.3-dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
</head>

<body>

    <div id="wallpaper">
        <section>
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
                        <div class="logo text-center">
                            <img src="../assets/images/ant-man-and-the-wasp-movie-w03.jpg" alt="">
                        </div>
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
        </section>
        <section>
            <div class="slide-show">
                <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-indicators">
                        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
                        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
                        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="3" aria-label="Slide 4"></button>
                    </div>
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <img src="../assets/images/1025031-trn0010compv145.1062-1200.jpg" class="d-block w-100" alt="...">
                        </div>
                        <div class="carousel-item">
                            <img src="../assets/images/ant-man.jpg" class="d-block w-100" alt="...">
                        </div>
                        <div class="carousel-item">
                            <img src="../assets/images/1025031-trn0010compv145.1062-1200.jpg" class="d-block w-100" alt="...">
                        </div>
                        <div class="carousel-item">
                            <img src="../assets/images/ant-man.jpg" class="d-block w-100" alt="...">
                        </div>
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                      <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                      <span class="carousel-control-next-icon" aria-hidden="true"></span>
                      <span class="visually-hidden">Next</span>
                    </button>
                </div>
            </div>
        </section>
        <!-- <div id="content"> -->
            
        <section>
            <div id="content">
                <div class="main-content">
                    <div class="container">
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-4">
                                <div class="main-right">
                                    <div class="card">
                                        <div class="card-header">
                                            Danh mục dịch vụ
                                        </div>
                                        <ul class="list-group list-group-flush">
                                            <li class="list-group-item">An item</li>
                                            <li class="list-group-item">A second item</li>
                                            <li class="list-group-item">A third item</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-4">
                                <div class="main-center">
                                    <div class="card">
                                        <div class="card-header">
                                            Danh mục dịch vụ
                                        </div>
                                        <ul class="list-group list-group-flush">
                                            <li class="list-group-item">An item</li>
                                            <li class="list-group-item">A second item</li>
                                            <li class="list-group-item">A third item</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-4">
                                <div class="main-left">
                                    <div class="card">
                                        <div class="card-header">
                                            Danh mục dịch vụ
                                        </div>
                                        <ul class="list-group list-group-flush">
                                            <li class="list-group-item">An item</li>
                                            <li class="list-group-item">A second item</li>
                                            <li class="list-group-item">A third item</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- </div> -->
        <section>
            <footer>
                <div class="footer-top">
                    <div class="container">
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-4">
                                <div class="box-footer">
                                    <h3>Thông tin trung tâm</h3>
                                    <p>Trung Tâm Nuôi Dưỡng Và Công Tác Xã Hội Tỉnh Thừa Thiên Huế (Center for Nurturing and Social Work of Thua Thien Hue Province) là cơ sở bảo trợ xã hội công lập, đơn vị sự nghiệp trực thuộc Sở LĐTBXH tại phường An Hòa, thành
                                        phố Huế.
                                    </p>
                                    <p>
                                        <i class="fa fa-home" aria-hidden="true"></i> 35 Ham Nghi, Da Nang
                                    </p>
                                    <p>
                                        <i class="fa fa-envelope" aria-hidden="true"></i> Email: anhquannguyen124@gmail.com
                                    </p>
                                    <p>
                                        <i class="fa fa-phone" aria-hidden="true"></i> Phone: 0914561892
                                    </p>
                                    <p>
                                        <i class="fa fa-globe" aria-hidden="true"></i> Website: anhquan.com
                                    </p>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-4">
                                <div class="box-footer ms-5">
                                    <h3>Danh mục</h3>
                                    <ul>
                                        <li><a href="#"><i class="fa-solid fa-caret-right"></i>Trang chủ</a></li>
                                        <li><a href="#"><i class="fa-solid fa-caret-right"></i>Thông tin chung</a></li>
                                        <li><a href="#"><i class="fa-solid fa-caret-right"></i>Tham quan trung tâm</a></li>
                                        <li><a href="#"><i class="fa-solid fa-caret-right"></i>Các dịch vụ</a></li>
                                        <li><a href="#"><i class="fa-solid fa-caret-right"></i>Liên hệ</a></li>
                                        <li><a href="#"><i class="fa-solid fa-caret-right"></i>Hỗ trợ</a></li>
                                    </ul>
                                </div>
                            </div>
    
                            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-4">
                                <div class="box-footer">
                                    <h3>Hỗ trợ</h3>
                                    <form action="">
                                        <div class="row">
                                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 mb-2">
                                                <input type="text" class="form-control" placeholder="Nhập email">
                                            </div>
                                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 mb-2">
                                                <textarea name="" id="" cols="30" rows="3" class="form-control" placeholder="Nhập nội dung"></textarea>
                                            </div>
                                        </div>
                                        <button type="button" class="btn btn-success">Gửi</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="footer-bottom text-center">
                    <div class="container">
                        <div class="row">
                            <p class="pull-left">Created by Nguyễn Anh Quân © 2022</p>
                        </div>
                    </div>
                </div>
            </footer>
        </section>
    </div>


    <!-- Bootstrap JavaScript Libraries -->
    <script src="../assets/libs/bootstrap-5.1.3-dist/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/js/main.js"></script>
</body>

</html>