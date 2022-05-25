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
            <a>Quản lý người cao tuổi</a>
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
            
            <div id="table_data">
                <div class="table-responsive">
                    <table id="example" class="display table table-bordered">
                        <thead>
                            <tr>
                                <th>Mã hồ sơ</th>
                                <th style="width: 200px">Ảnh đại diện</th>
                                <th>Họ tên</th>
                                <th>Người giám hộ</th>
                                <th>Ngày sinh</th>
                                <th>Số điện thoại</th>
                                <th>CCCD</th>
                                <th>Thao tác</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (count($elderly) > 0)
                                @foreach ($elderly as $key => $usernd )
                                    <tr>
                                        <td>{{$usernd->id_nguoicaotuoi}}</td>
                                        <td><img src="{{asset('public/admin/uploads/nguoicaotuoi/anhdaidien/'.$usernd->anhDaiDienNCC)}}" width="150px" /></td>
                                        <td>{{$usernd->hoTenNCC}}</td>
                                        <td>{{$usernd->hoTen}}</td>
                                        <td>{{date('d-m-Y', strtotime($usernd->ngaySinhNCC))}}</td>
                                        <td>{{$usernd->soDienThoaiNCC}}</td>
                                        <td>{{$usernd->CCCD_NCC}}</td>
                                        <td class="text-center">
                                            <a href="{{route('health.elderly.detail',$usernd->id_nguoicaotuoi)}}" type="button" class="btn btn-info edit-elderly" style="border-radius: 7px"><i class="fa fa fa-info-circle"></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <td colspan="8" style="text-align: center">Không có hồ sơ nào</td>
                            @endif
                        </tbody>
                    </table>  
                </div>
            </div>
        </div>
    </div>
</div>
<!--End row-->
@endsection

@section('ajax_js')
    <script type="text/javascript">
        $(document).ready(function(){

            
            
        });
    </script>
@endsection