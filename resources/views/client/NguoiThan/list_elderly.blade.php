@extends('client.client_layout')
@section('client_layout')

<section>
    <div id="content">
        <div class="main-content">
            <div class="container">
                <div class="list-elderly shadow p-3 mb-5 bg-body rounded">
                    <div class="list-elderly-header">
                        <p>Danh sách người cao tuổi</p>
                        <div class="form-group text-end my-3">
                            <a id="btn-register-elderly" class="btn btn-primary" type="button">Đăng ký hồ sơ mới</a>
                        </div>
                    </div>
                    <form action="{{route('filter.elderly')}}">
                        <div class="list-elderly-filter">
                            <div class="d-flex">
                                <div class="list-elderly-filter-header">Loại hồ sơ:</div>
                                <div class="list-elderly-filter-choose">
                                    <select name="filter_hs" class="form-select">
                                        <option @if($count == 3) selected @endif value="3">Tất cả</option>
                                        <option @if($count == 1) selected @endif value="1">Đang hoạt động</option>
                                        <option @if($count == 0) selected @endif value="0">Đang chờ duyệt</option>
                                        <option @if($count == 2) selected @endif value="2">Đang bị khoá</option>
                                    </select>
                                </div>
                                <div class="list-elderly-filter-submit">
                                    <input type="submit" class="btn btn-primary" value="Tìm kiếm">
                                </div>
                            </div>
                        </div>
                    </form>
                    <div class="list-elderly-approved">
                        @if(count($elderly_records) > 0)

                            <h5>{{$title_filter}}</h5>
                            <div class="row">
                                @foreach ($elderly_records as $key => $val )
                                    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-3">
                                        <div class="card shadow p-3 mb-3 bg-body rounded">
                                            <a class="card-a" href="{{route('detail.elderly',$val->id_nguoicaotuoi)}}">
                                                <img src="{{asset('public/storage/'.$val->anhDaiDienNCC)}}" class="card-img-top" alt="...">
                                                <div class="card-body">
                                                    <p class="card-text">{{$val->hoTenNCC}}</p>
                                                    @if($val->tinhTrangNCC == 1)
                                                        <span class="btn btn-success">Đang hoạt động</span>
                                                    @elseif ($val->tinhTrangNCC == 0)
                                                        <span class="btn btn-warning">Đang chờ duyệt</span>
                                                    @else
                                                        <span class="btn btn-danger">Bị khoá</span>
                                                    @endif
                                                </div>
                                            </a>
                                            <div class="card-info card shadow">
                                                <a href="{{route('detail.elderly',$val->id_nguoicaotuoi)}}">
                                                    <div class="card-body">
                                                        <p class="card-text">{{$val->hoTenNCC}}</p>
                                                        <div class="card-information d-flex flex-column">
                                                            <span><strong>Giới tính</strong> : {{$val->gioiTinhNCC == 1 ? 'Nam' : 'Nữ'}}</span>
                                                            <span><strong>Ngày sinh</strong> : {{date('d-m-Y', strtotime($val->ngaySinhNCC))}}</span>
                                                            <span><strong>Căn cước công dân</strong> : {{$val->CCCD_NCC}}</span>
                                                            <span><strong>Số điện thoại</strong> : {{$val->soDienThoaiNCC}}</span>
                                                            <span><strong>Địa chỉ</strong> : {{$val->diaChiNCC}}</span>
                                                            <span><strong>Ngày đăng ký</strong> : {{$val->ngayDangKyNCC}}</span>
                                                            <span><strong>Tình trạng</strong> : 
                                                                @if($val->tinhTrangNCC == 1)
                                                                    <strong class="text-success">Đang hoạt động</strong>
                                                                @elseif ($val->tinhTrangNCC == 0)
                                                                    <strong class="text-warning">Đang chờ duyệt</strong>
                                                                @else
                                                                    <strong class="text-danger">Bị khoá</strong>
                                                                @endif
                                                            </span>
                                                        </div>
                                                    </div>
                                                </a>
                                                
                                            </div>
                                        </div>
                                        
                                        
                                    </div>

                                    
                                @endforeach
                            </div>
                        @else
                            <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-3">
                                    <div class="elderly-none card shadow p-3 mb-3 bg-body rounded">
                                        <i class="fa-solid fa-plus"></i>
                                        <span>Không có hồ sơ nào</span>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                    
                </div>
                @include('client.NguoiThan.Modal.register_elderly')
            </div>
        </div>
    </div>
</section>
@endsection

@section('ajax_client')
<script type="text/javascript">
    $(document).ready(function(){

        // ============ Đăng ký hồ sơ ===============
        // Mở giao diện đăng ký
        jQuery('body').on('click', '#btn-register-elderly', function () {
            $('#RegisterElderlyModal').modal('show');
        });
        
        // Đăng ký
        $('#registerElderlyForm').submit(function(e) {
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
                        $('.success').removeClass('alert alert-success').html(''); 
                        $('.errors').addClass('alert alert-danger').html('');
                        $('#registerElderlyError').text(data.errors);
                    }

                    if (data.success) {
                        $('.errors').removeClass('alert alert-danger').html('');
                        $('.success').addClass('alert alert-success').html(''); 
                        $('#registerElderlySuccess').text(data.success);
                        jQuery('#registerElderlyForm').trigger("reset");
                        // window.location.reload();
                    }
                }  
            });
            
        })


    });
</script>
@endsection
