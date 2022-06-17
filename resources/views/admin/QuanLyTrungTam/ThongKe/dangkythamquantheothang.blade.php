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
            <form action="{{route('filter.registerToVisit')}}">
                <div class="form-group" style="display: flex;flex-direction: row;">
                    <div style="line-height: 34px;height: 34px;margin-right: 10px;font-weight: 600">Năm : </div>
                    <div style="line-height: 34px;margin-right: 10px">
                        <select name="filter_registerToVisit" class="form-select" style="height: 34px;">
                            <option value="2021">2021</option>
                            <option value="2022">2022</option>
                            <option value="2023">2023</option>
                            <option value="2024">2024</option>
                        </select>
                    </div>
                    <div class="list-elderly-filter-submit">
                        <input type="submit" class="btn btn-primary" value="Tìm kiếm">
                    </div>
                </div>
            </form>
            <div class="col-md-12">
                <div id="columnchart_material" style="width: 800px; height: 500px;"></div>
            </div>
        </div>
    </div>
    
</div>
<!--End row-->
@endsection

@section('ajax_js')

<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['bar']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Tháng', 'Số lượng đăng ký'],
          ['Tháng 1', <?php echo $t1?>],
          ['Tháng 2', <?php echo $t2?>],
          ['Tháng 3', <?php echo $t3?>],
          ['Tháng 4', <?php echo $t4?>],
          ['Tháng 5', <?php echo $t5?>],
          ['Tháng 6', <?php echo $t6?>],
          ['Tháng 7', <?php echo $t7?>],
          ['Tháng 8', <?php echo $t8?>],
          ['Tháng 9', <?php echo $t9?>],
          ['Tháng 10', <?php echo $t10?>],
          ['Tháng 11', <?php echo $t11?>],
          ['Tháng 12', <?php echo $t12?>],
        ]);

        var options = {
          chart: {
            title: 'Thống kê số lượt đăng ký tham quan trung tâm trong năm '+ <?php echo $year?> ,
            subtitle: 'Tổng số lượt đăng ký : '+<?php echo $tong ?>+' (lượt)',
          }
        };

        var chart = new google.charts.Bar(document.getElementById('columnchart_material'));

        chart.draw(data, google.charts.Bar.convertOptions(options));
    }
</script>
@endsection