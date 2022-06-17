@extends('admin.admin_layout')
@section('admin_content')
<!--Start Page Title-->
<div class="page-title-box">
    <h4 class="page-title">{{$title}}</h4>
    <ol class="breadcrumb">
        <li>
            <a href="{{route('dashboard')}}">Dashboard</a>
        </li>
        <li>
            <a>Thống kê</a>
        </li>
        <li class="active">
            <a href="{{$url}}">{{$title}}</a>
        </li>
    </ol>
    <div class="clearfix"></div>
</div>
<!--End Page Title-->      
   
<!--Start row-->
<div class="row">
    <div class="col-md-12">
        <div class="white-box">
            <div id="donut">
                
            </div>
        </div>
    </div>
</div>
<!--End row-->
@endsection

@section('ajax_js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>
<script type="text/javascript">
    $(document).ready(function(){
        var colorDanger = "#FF1744";
        Morris.Donut({
        element: 'donut',
        resize: true,
        colors: [
            '#E0F7FA',
            '#B2EBF2',
            '#80DEEA',
            '#4DD0E1',
            '#26C6DA'
        ],
        //labelColor:"#cccccc", // text color
        //backgroundColor: '#333333', // border color
        data: [
            {label:"Bài viết", value:<?php echo $baiviet ?>},
            {label:"Đăng ký tham quan", value:<?php echo $thamquan ?>},
            {label:"Người dùng", value:<?php echo $nguoidung ?>},
            {label:"Hồ sơ người cao tuổi", value:<?php echo $hoso ?>},
            {label:"Nhân viên", value:<?php echo $nhanvien ?>}
        ]
        });
    });
</script>
@endsection