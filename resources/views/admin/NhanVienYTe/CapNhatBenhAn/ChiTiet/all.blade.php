@extends('admin.admin_layout')
@section('admin_content')
<!--Start Page Title-->
<div class="page-title-box">
    <h4 class="page-title">{{$title}} {{$elderly->hoTenNCC}}</h4>
    <ol class="breadcrumb">
        <li>
            <a href="{{route('dashboard')}}">Dashboard</a>
        </li>
        <li>
            <a>Cập nhật bệnh án người cao tuổi</a>
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
                                <th>Mã bệnh án</th>
                                <th>Tên bệnh viện</th>
                                <th>Bác sĩ</th>
                                <th>Khoa</th>
                                <th>Ngày khám</th>
                                <th>Chẩn đoán</th>
                                <th>Chi phí (VND)</th>
                                <th>Thao tác</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (count($medical_records) > 0)
                                @foreach ($medical_records as $key => $records )
                                    <tr>
                                        <td>{{$records->id_benhAn}}</td>
                                        <td>{{$records->tenBenhVien}}</td>
                                        <td>{{$records->bacSi}}</td>
                                        <td>{{$records->khoa}}</td>
                                        <td>{{date('d-m-Y', strtotime($records->ngayKham))}}</td>
                                        <td>{{$records->chanDoan}}</td>
                                        <td>{{number_format($records->chiPhi,0,',','.')}}</td>
                                        <td class="text-center">
                                            <a href="{{route('medical.records_personal.edit',$records->id_benhAn)}}" type="button" class="btn btn-info edit-elderly" style="border-radius: 7px"><i class="fa fa fa-info-circle"></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <td colspan="8" style="text-align: center">Không có bệnh án nào</td>
                            @endif
                        </tbody>
                    </table>  
                </div>
            </div>

            <div class="form-group">
                <div class="col-md-8">
                    <a href="{{route('medical.records.all')}}" class="btn btn-instagram" type="button">Quay lại</a>
                </div>
            </div>
        </div>
    </div>
</div>
<!--End row-->
@endsection
