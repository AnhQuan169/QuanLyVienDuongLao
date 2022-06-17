@extends('client.client_layout')
@section('client_layout')
<section>
    <div id="content">
        <div class="main-content">
            <div class="container">
                <div class="row shadow p-3 mb-5 bg-body rounded">
                    <div class="form register-visit-client">
                        <h3 class="text-center" style="font-weight: 700">Đăng ký tham quan trung tâm</h3>
                        <div id="registerToVIsit" class="success text-success registerToVisit"></div>
                        <form id="registerToVisitForm" action="{{route('registerVisit.save')}}" class="js-validation-bootstrap form-horizontal" method="POST" >
                            @csrf
                            <div class="form-group">
                                <label>Tên người đại diện: <span class="text-danger">*</span></label>                                
                                <input name="nguoiDaiDienDK" value="{{old('nguoiDaiDienDK')}}" class="form-control" type="text" placeholder="Nhập tên người đại diện">
                                <span class="text text-danger error-text nguoiDaiDienDK_error"></span>
                            </div>
                            <div class="form-group">
                                <label>Số lượng người tham quan: <span class="text-danger">*</span></label>                                
                                <input name="soLuongDK" min="1" max="100" value="{{old('soLuongDK')}}" class="form-control" type="number" placeholder="Nhập số lượng người tham quan">
                                <span class="text text-danger error-text soLuongDK_error"></span>
                            </div>
                            <div class="form-group">
                                <label>Email: <span class="text-danger">*</span></label>                                
                                <input name="emailDK" value="{{old('emailDK')}}" class="form-control" type="email" placeholder="Nhập email">
                                <span class="text text-danger error-text emailDK_error"></span>
                            </div>
                            <div class="form-group">
                                <label>Số điện thoại: <span class="text-danger">*</span></label>                                
                                <input name="soDienThoaiDK" min="0" value="{{old('soDienThoaiDK')}}" class="form-control" type="number" placeholder="Nhập số điện thoại">
                                <span class="text text-danger error-text soDienThoaiDK_error"></span>
                            </div>
                            <div class="form-group">
                                <label>Ghi chú: <span class="text-danger">*</span></label>                                
                                <textarea style="resize: none" rows="3" name="ghiChuDK" class="form-control" placeholder="Nhập ghi chú">{{old('ghiChuDK')}}</textarea>
                                <span class="text text-danger error-text ghiChuDK_error"></span>
                            </div>
                            <div class="form-group">
                                <label>Ngày tham quan: <span class="text-danger">*</span></label>                                
                                <input name="ngayThamQuanDK" id="txtDate1" value="{{old('ngayThamQuanDK')}}" class="form-control" type="date">
                                <span class="text text-danger error-text ngayThamQuanDK_error"></span>
                            </div>
                            <div class="form-group">
                                <label>Thời gian tham quan: <span class="text-danger">*</span></label>                                
                                <input name="thoigianTQ" value="{{old('thoigianTQ')}}" class="form-control" type="time"> 
                                <span class="text text-danger error-text thoigianTQ_error"></span>
                            </div>
                            <div class="form-group text-center my-3">
                                {{-- <a href="{{route('home')}}" class="btn btn-primary" type="button">Quay lại</a> --}}
                                <button class="btn btn-success save-registerToVisit" type="submit">Đăng ký</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@section('ajax_client')
<script>
    $(function(){
        var dtToday = new Date();
        
        var month = dtToday.getMonth() + 1;
        var day = dtToday.getDate();
        var year = dtToday.getFullYear();
        if(month < 10)
            month = '0' + month.toString();
        if(day < 10)
            day = '0' + day.toString();
        var maxDate = year + '-' + month + '-' + day;
        // or instead:
        // var maxDate = dtToday.toISOString().substr(0, 10);
        $('#txtDate1').attr('min', maxDate);
    });

    $(document).ready(function() {
        $('#registerToVisitForm').submit(function(e) {
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

                    if (data.success) {
                        $('.success').addClass('alert alert-success').html(''); 
                        $('#registerToVIsit').text(data.success);
                        toastr.success('Đăng ký thành công');
                        jQuery('#registerToVisitForm').trigger("reset");
                    }
                }  
            });
            
        })
    });
        
</script>
@endsection