@extends('client.client_layout')
@section('client_layout')
<section>
    <div id="content">
        <div class="main-content">
            <div class="container">
                <div class="detail-elderly shadow p-3 mb-5 bg-body rounded">
                    <div class="detail-elderly-header">
                        <p>Chi tiết thông tin ({{$ncc->gioiTinhNCC==1 ? 'Ông':'Bà'}}) {{$ncc->hoTenNCC}}</p>
                    </div>
                    <div class="detail-elderly-category">
                        <ul class="nav nav-tabs">
                            <li class="nav-item">
                              <a class="health-situation nav-link" href="#health-situation-content" data-bs-toggle="collapse" role="button" aria-expanded="false">Tình hình sức khoẻ</a>
                            </li>
                            <li class="nav-item">
                              <a class="info-elderly nav-link" href="#info-elderly-content" data-bs-toggle="collapse" role="button" aria-expanded="false">Thông tin hồ sơ</a>
                            </li>
                            <li class="nav-item">
                              <a class="medicine-records nav-link" href="#medicine-records-content" data-bs-toggle="collapse" role="button" aria-expanded="false">Bệnh án</a>
                            </li>
                        </ul>
                    </div>
                    @include('client.NguoiThan.ChiTietNguoiCaoTuoi.Modal.health_situation_content')
                    @include('client.NguoiThan.ChiTietNguoiCaoTuoi.Modal.info_elderly_content')
                    @include('client.NguoiThan.ChiTietNguoiCaoTuoi.Modal.medicine_records')

                    <a href="{{route('list_elderly.client')}}" type="button" class="btn btn-primary mt-2">Quay lại</a>
                </div>
                
            </div>
        </div>
    </div>
</section>
@endsection

@section('ajax_client')
<script type="text/javascript">
    $(document).ready(function() {
        $('.health-situation').addClass('active'); 
        $('#health-situation-content').addClass('show'); 

        $(document).on('click', '.health-situation', function () {
            $('.info-elderly').removeClass('active'); 
            $('.medicine-records').removeClass('active'); 

            $('#info-elderly-content').removeClass('show'); 
            $('#medicine-records-content').removeClass('show'); 

            $('.health-situation').addClass('active'); 
        });

        $(document).on('click', '.info-elderly', function () {
            $('.health-situation').removeClass('active'); 
            $('.medicine-records').removeClass('active'); 

            $('#health-situation-content').removeClass('show'); 
            $('#medicine-records-content').removeClass('show'); 

            $('.info-elderly').addClass('active'); 
        });

        $(document).on('click', '.medicine-records', function () {
            $('.health-situation').removeClass('active'); 
            $('.info-elderly').removeClass('active'); 

            $('#health-situation-content').removeClass('show'); 
            $('#info-elderly-content').removeClass('show'); 

            $('.medicine-records').addClass('active'); 
        });

        // $('.dateFilter').datepicker({
        //     dateFormat: "yy-mm-dd"
        // });

        // $('#btn_search').click(function (e) {
        //     var search_date = $('#search_date').val();
        //     var id = $('#id_nguoicaotuoi').val();
        //     $.ajax({
        //         url: 'search-health-situation/'+id,
        //         method: "POST",
        //         data: { search_date:search_date,id:id },
        //         success: function (data) {
        //             $('#purchase_order').html(data);
        //         }
        //     });
        // });
    });
</script>
@endsection