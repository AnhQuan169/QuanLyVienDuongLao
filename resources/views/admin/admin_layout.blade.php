<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="keywords" content="">
    <meta name="description" content="">
    <meta name="author" content="">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="icon" href="{{asset('public/admin/images/favicon.png')}}" type="image/png">
    <title>{{$title}}</title>
    
    <!--Begin  Page Level  CSS -->
    {{-- <link href="{{asset('public/admin/plugins/morris-chart/morris.css')}}" rel="stylesheet"> --}}
    <link href="{{asset('public/admin/plugins/jquery-ui/jquery-ui.min.css')}}" rel="stylesheet"/>
     <!--End  Page Level  CSS -->
    <link href="{{asset('public/admin/css/css/icons.css')}}" rel="stylesheet">
    <link href="{{asset('public/admin/css/css/bootstrap.min.css')}}" rel="stylesheet">
    {{-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css"> --}}
    <link href="{{asset('public/admin/css/css/style.css')}}" rel="stylesheet">
    {{-- SCSS --}}
    <link rel="stylesheet" href="{{asset('public/admin/css/style.css')}}">
    <link href="{{asset('public/admin/css/css/responsive.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="https://lipis.github.io/bootstrap-sweetalert/dist/sweetalert.css">
    <link href="{{asset('public/admin/css/css/icons/font-awesome/font-awesome.css')}}" rel="stylesheet"> 
    
    <link rel="stylesheet" href="http://cdn.bootcss.com/toastr.js/latest/css/toastr.min.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/fontawesome.min.css" />
    <link rel="stylesheet" href="{{asset('public/admin/css/css/fontawesome/all.min.css')}}">
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
          <script src="js/html5shiv.min.js"></script>
          <script src="js/respond.min.js"></script>
    <![endif]-->

</head>

<body class="sticky-header">


    <!--Start left side Menu-->
    <div class="left-side sticky-left-side">

        <!--logo-->
        <div class="logo">
            <a href="index.html"><img src="{{asset('public/admin/images/logo.png')}}" alt=""></a>
        </div>

        <div class="logo-icon text-center">
            <a href="index.html"><img src="{{asset('public/admin/images/logo-icon.png')}}" alt=""></a>
        </div>
        <!--logo-->

        <div class="left-side-inner">
            <!--Sidebar nav-->
            <ul class="nav nav-pills nav-stacked custom-nav">
                <li class=" nav-active"><a href="{{route('dashboard')}}"><i class="icon-home"></i> <span>Dashboard</span></a>
                    
                </li>

                @hasrole('0')
                <li class="menu-list">
                    <a href=""><i class="icon-layers"></i><span>Quản lý đơn đăng ký tham quan trung tâm</span></a>
                    <ul class="sub-menu-list">
                        <li><a href="{{route('browseapplication.all')}}">Duyệt đơn đăng ký</a></li>
                        <li><a href="{{route('registerToVisit.all')}}">Danh sách đơn đăng ký đã duyệt</a></li>
                        <li><a href="{{route('allapplicationtoday.all')}}">Khách tham quan hôm nay</a></li>
                        <li><a href="{{route('garbagecanapplication.all')}}">Thùng rác</a></li>
                    </ul>
                </li>
                <li class="menu-list">
                    <a href=""><i class="icon-layers"></i><span>Quản lý người dùng</span></a>
                    <ul class="sub-menu-list">
                        <li><a href="{{route('browseuser.all')}}">Duyệt đăng ký người dùng</a></li>
                        <li><a href="{{route('user.all')}}">Danh sách người dùng</a></li>
                    </ul>
                </li>
                <li class="menu-list">
                    <a href=""><i class="icon-layers"></i><span>Quản lý hồ sơ người cao tuổi</span></a>
                    <ul class="sub-menu-list">
                        <li><a href="{{route('browseelderly.all')}}">Duyệt đăng ký hồ sơ</a></li>
                        <li><a href="{{route('elderly.all')}}">Danh sách hồ sơ</a></li>
                        <li><a href="{{route('elderly.warehouse')}}">Kho hồ sơ</a></li>
                    </ul>
                </li>
                <li>
                    <a href=""><i class="icon-layers"></i><span>Duyệt đăng ký dịch vụ cho người cao tuổi</span></a>
                </li>
                <li>
                    <a href=""><i class="icon-layers"></i><span>Duyệt đề xuất báo cáo kho</span></a>
                </li>
                <li>
                    <a href=""><i class="icon-layers"></i><span>Quản lý dịch vụ trung tâm</span></a>
                </li>
                <li>
                    <a href=""><i class="icon-layers"></i><span>Quản lý nhà cung cấp</span></a>
                </li>
                <li>
                    <a href=""><i class="icon-layers"></i><span>Quản lý nhân viên</span></a>
                </li>
                <li>
                    <a href="{{route('all_notification')}}"><i class="icon-layers"></i><span>Quản lý thông báo</span></a>
                </li>
                <li>
                    <a href=""><i class="icon-layers"></i><span>Cập nhật lịch trực của nhân viên</span></a>
                </li>
                <li>
                    <a href=""><i class="icon-layers"></i><span>Thống kê</span></a>
                </li>
                @endhasrole
                {{-- Nhân viên kho --}}
                @hasrole('1')
                <li>
                    <a href=""><i class="icon-layers"></i><span>Quản lý xuất - nhập thuốc</span></a>
                </li>
                <li>
                    <a href=""><i class="icon-layers"></i><span>Xuất báo cáo nhập - xuất thuốc</span></a>
                </li>
                <li>
                    <a href=""><i class="icon-layers"></i><span>Quản lý cơ sở vật chất</span></a>
                </li>
                <li>
                    <a href=""><i class="icon-layers"></i><span>Đề xuất báo cáo kho</span></a>
                </li>
                @endhasrole
                @hasrole('2')
                <li>
                    <a href=""><i class="icon-layers"></i><span>Cập nhật thuốc điều trị</span></a>
                </li>
                <li>
                    <a href=""><i class="icon-layers"></i><span>Cập nhật bệnh án người cao tuổi</span></a>
                </li>
                <li>
                    <a href=""><i class="icon-layers"></i><span>Cập nhật tình trạng vật tư y tế đang dùng</span></a>
                </li>
                <li>
                    <a href=""><i class="icon-layers"></i><span>Cập nhật tình hình sức khoẻ người cao tuổi</span></a>
                </li>
                @endhasrole
                

            </ul>
            <!--End sidebar nav-->

        </div>
    </div>
    <!--End left side menu-->
    
    
    <!-- main content start-->
    <div class="main-content" >

        <!-- header section start-->
        <div class="header-section">

            <a class="toggle-btn"><i class="fa fa-bars"></i></a>

            <form class="searchform">
                <input type="text" class="form-control" name="keyword" placeholder="Search here..." />
            </form>

            <!--notification menu start -->
            <div class="menu-right">
                <ul class="notification-menu">
                   
                    @if(Auth::check())
                        <li>
                            <a href="#" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                                <img src="{{asset('public/admin/images/users/avatar-6.jpg')}}" alt="" />
                                {{Auth::user()->hoTen}}
                                <span class="caret"></span>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-usermenu pull-right">
                            <li> <a href="#"> <i class="fa fa-user"></i> Thông tin cá nhân </a> </li>
                            <li> <a href="#"> <i class="fa fa-info"></i> Thay đổi mật khẩu </a> </li>
                            <li> <a href="{{route('logout_admin')}}"> <i class="fa fa-lock"></i> Đăng xuất </a> </li>
                            </ul>
                        </li>
                    @endif

                </ul>
            </div>
            <!--notification menu end -->

        </div>
        <!-- header section end-->


        <!--body wrapper start-->
        <div class="wrapper">
            @yield('admin_content')
		</div>
        <!-- End Wrapper-->

        <!--Start  Footer -->
        <footer class="footer-main"> Created by Nguyễn Anh Quân © 2022	</footer>	
         <!--End footer -->

        </div>
        <!--End main content -->
    

      

    <!--Begin core plugin -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    {{-- <script src="{{asset('public/admin/js/jquery2.0.3.min.js')}}"></script> --}}
    {{-- <script src="{{asset('public/admin/js/jquery.min.js')}}"></script> --}}
    <script src="{{asset('public/admin/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('public/admin/plugins/moment/moment.js')}}"></script>
    <script src="{{asset('public/admin/js/jquery.slimscroll.js')}} "></script>
    <script src="{{asset('public/admin/js/jquery.nicescroll.js')}}"></script>
    <script src="{{asset('public/admin/js/functions.js')}}"></script>
    <!-- End core plugin -->
    
    {{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script> --}}
    
    <!--Begin Page Level Plugin-->
	{{-- <script src="{{asset('public/admin/plugins/morris-chart/morris.js')}}"></script>
    <script src="{{asset('public/admin/plugins/morris-chart/raphael-min.js')}}"></script> --}}
    <script src="{{asset('public/admin/plugins/jquery-sparkline/jquery.charts-sparkline.js')}}"></script>
    <script src="{{asset('public/admin/pages/dashboard.js')}}"></script>
	<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
	<script src="{{asset('public/admin/js/sweetalert.js')}}"></script>


    <script src="{{asset('public/admin/js/notification.js')}}"></script>
    
    {{-- Hiển thị thông báo --}}
    <script src="http://cdn.bootcss.com/toastr.js/latest/js/toastr.min.js"></script>
    {!! Toastr::message() !!}
    {{-- <script type="text/javascript">
        $(document).ready(function(){
           
            $(document).on('click','.pagination a', function(event){
                event.preventDefaukt();
                var page = $(this).attr('href').split('page=')[1];
                fetch_data(page);
            });

            function fetch_data(page){
                $.ajax({
                    url:"/all-notification/fetch_data?page="+page,
                    success:function(data){
                        $('#table_data').html(data);
                    }
                });
            }

            
        });
    </script> --}}
    <script src="{{asset('public/admin/ckeditor/ckeditor.js')}}"></script>
    
    @include('More.ckeditor')
    @yield('ajax_js')


    

</body>

</html>
