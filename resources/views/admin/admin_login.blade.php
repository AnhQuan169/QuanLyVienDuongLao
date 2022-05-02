<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="keywords" content="">
  <meta name="description" content="">
  <meta name="author" content="">
  <link rel="icon" href="{{asset('public/admin/images/favicon.png')}}" type="image/png">
  <title>Đăng nhập</title>
   <link href="{{asset('public/admin/css/css/icons.css')}}" rel="stylesheet">
    <link href="{{asset('public/admin/css/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('public/admin/css/css/style.css')}}" rel="stylesheet">
    <link href="{{asset('public/admin/css/css/responsive.css')}}" rel="stylesheet">
    
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
          <script src="js/html5shiv.min.js"></script>
          <script src="js/respond.min.js"></script>
    <![endif]-->

</head>

<body class="sticky-header">

 
 <!--Start login Section-->
  <section class="login-section">
       <div class="container">
           <div class="row">
               <div class="login-wrapper">
                   <div class="login-inner">
                   		
                   		<h2 class="header-title text-center">Đăng nhập</h2>
                        <p class="text-center">
                            <?php 
                                $message = Session::get('message');
                                if($message){
                                    echo '<span class="text-alert ">',$message,'</span>';
                                    Session::put('message', null);
                                }
                
                            ?>
                        </p>
                        <form action="{{URL::to('/login-admin')}}" method="POST">
                            {{ csrf_field() }}
                            @foreach ($errors->all() as $val)
                                <p class="text-center">{{$val}}</p>
                            @endforeach
                            <div class="form-group">
                                <input type="text" class="form-control" name="name" value="{{old('name')}}"  placeholder="Tên tài khoản" >
                            </div>
                            
                            <div class="form-group">
                                <input type="password" class="form-control" name="password"  placeholder="Mật khẩu" >
                            </div>

                            <div class="form-group">
                                <div class="pull-left">
                                    <div class="checkbox primary">
                                        <input  id="checkbox-2" type="checkbox">
                                        <label for="checkbox-2">Nhớ mật khẩu</label>
                                    </div>
                                </div>
                           
                                <div class="pull-right">
                                    <a href="reset-password.html" class="a-link">
                                        <i class="fa fa-unlock-alt"></i> Quên mật khẩu ?
                                    </a>
                                </div>
                            </div>
                          
                            <div class="form-group">
                                <input type="submit" value="Đăng nhập" class="btn btn-primary btn-block" >
                            </div>
                           
                            <div class="form-group text-center">
                                Không có tài khoản?  <a href="registration.html">Đăng ký </a>
                            </div>
                        </form>
                    
                   </div>
               </div>
               
           </div>
       </div>
  </section>
 <!--End login Section-->




    <!--Begin core plugin -->
    <script src="{{asset('public/admin/js/jquery.min.js')}}"></script>
    <script src="{{asset('public/admin/js/bootstrap.min.js')}}"></script>
    <!-- End core plugin -->

</body>

</html>
