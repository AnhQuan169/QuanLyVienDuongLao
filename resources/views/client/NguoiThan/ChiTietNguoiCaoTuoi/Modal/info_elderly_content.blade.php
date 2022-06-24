<div class="collapse collapse-ttcn" id="info-elderly-content">
    <div class="card card-body">
        <div class="info-header">
            <p>Thông tin cá nhân</p>
        </div>
        <div class="info-content d-flex flex-column">
            <div class="info-content-img shadow-sm">
                <img class="shadow-sm" src="{{asset('public/storage/'.$ncc->anhDaiDienNCC)}}" width="150px" />
            </div>
            <div class="info-content-main d-flex flex-column">
                <div class="info-content-detail d-flex flex-row">
                    <span class="info-content-title"><strong>Họ và tên </strong></span>
                    <span class="info-content-name">: {{$ncc->hoTenNCC}}</span>
                </div>
                <div class="info-content-detail d-flex flex-row">
                    <span class="info-content-title"><strong>Giới tính </strong></span>
                    <span>: {{$ncc->gioiTinhNCC == 1? 'Nam' :'Nữ'}}</span>
                </div>
                <div class="info-content-detail d-flex flex-row">
                    <span class="info-content-title"><strong>Ngày sinh </strong></span>
                    <span>: {{date('d-m-Y', strtotime($ncc->ngaySinhNCC))}}</span>
                </div>
                <div class="info-content-detail d-flex flex-row">
                    <span class="info-content-title"><strong>Số căn cước công dân </strong></span>
                    <span>: {{$ncc->CCCD_NCC}}</span>
                </div>
                <div class="info-content-detail d-flex flex-row">
                    <span class="info-content-title"><strong>Số điện thoại </strong></span>
                    <span>: {{$ncc->soDienThoaiNCC}}</span>
                </div>
                <div class="info-content-detail d-flex flex-row">
                    <span class="info-content-title"><strong>Địa chỉ </strong></span>
                    <span>: {{$ncc->diaChiNCC}}</span>
                </div>
                <div class="info-content-detail d-flex flex-row">
                    <span class="info-content-title"><strong>Ngày đăng ký </strong></span>
                    <span>: {{date('d-m-Y', strtotime($ncc->ngayDangKyNCC))}}</span>
                </div>
                @if ($ncc->ngayDuyetNCC == '01-01-1970')
                    <div class="info-content-detail d-flex flex-row">
                        <span class="info-content-title"><strong>Ngày duyệt </strong></span>
                        <span>: {{date('d-m-Y', strtotime($ncc->ngayDuyetNCC))}}</span>
                    </div>
                @endif
                
                <div class="info-content-detail d-flex flex-row">
                    <span class="info-content-title"><strong>Phòng </strong></span>
                    <span>: {{$ncc->phong}}</span>
                </div>
                <div class="info-content-detail d-flex flex-row">
                    <span class="info-content-title"><strong>Giường </strong></span>
                    <span>: {{$ncc->giuong}}</span>
                </div>
                @if ($ncc->ngayVao == '01-01-1970')
                    <div class="info-content-detail d-flex flex-row">
                        <span class="info-content-title"><strong>Ngày vào </strong></span>
                        <span>: {{date('d-m-Y', strtotime($ncc->ngayVao))}}</span>
                    </div>
                @endif
                <div class="info-content-detail d-flex flex-row">
                    <span class="info-content-title"><strong>Tình trạng </strong></span>
                    @if($ncc->tinhTrangNCC == 1)
                        : <span class="fw-bold text-success"> Đang hoạt động</span>
                    @elseif ($ncc->tinhTrangNCC == 0)
                        : <span class="fw-bold text-warning"> Đang chờ duyệt</span>
                    @else
                        : <span class="fw-bold text-danger"> Bị khoá</span>
                    @endif
                </div>
                <div class="info-content-detail d-flex flex-column">
                    <span class="info-content-title-img"><strong>Ảnh hồ sơ : </strong></span>
                    <div class="info-content-anhDon d-flex flex-row">
                        <a data-bs-toggle="modal" data-bs-target="#info-content-anhDon">
                            <img src="{{asset('public/storage/'.$ncc->anhDon)}}" width="150px" />
                        </a>
                        <a data-bs-toggle="modal" data-bs-target="#info-content-anhtokhai">
                            <img src="{{asset('public/storage/'.$ncc->anhToKhaiDeNghiTroGiup)}}" width="150px" />
                        </a>
                        <a data-bs-toggle="modal" data-bs-target="#info-content-anhsoyeu">
                            <img src="{{asset('public/storage/'.$ncc->anhSoYeuLyLich)}}" width="150px" />
                        </a>
                        @if ($ncc->anhGiayChungNhanHIV)
                            <a data-bs-toggle="modal" data-bs-target="#info-content-anhHIV">
                                <img src="{{asset('public/storage/'.$ncc->anhGiayChungNhanHIV)}}" width="150px" />
                            </a>
                        @endif
                        
                    </div>

                    <div id="info-content-anhDon" class="modal fade" role="dialog">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header text-center">
                                    <img class="info-img-anhDon" src="{{asset('public/storage/'.$ncc->anhDon)}}" width="100%" />
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="info-content-anhtokhai" class="modal fade" role="dialog">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header text-center">
                                    <img class="info-img-anhDon" src="{{asset('public/storage/'.$ncc->anhToKhaiDeNghiTroGiup)}}" width="100%" />
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="info-content-anhsoyeu" class="modal fade" role="dialog">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header text-center">
                                    <img class="info-img-anhDon" src="{{asset('public/storage/'.$ncc->anhSoYeuLyLich)}}" width="100%" />
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="info-content-anhHIV" class="modal fade" role="dialog">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header text-center">
                                    <img class="info-img-anhDon" src="{{asset('public/storage/'.$ncc->anhGiayChungNhanHIV)}}" width="100%" />
                                </div>
                            </div>
                        </div>
                    </div>
                    
                </div>

            </div>

        </div>
    </div>
</div>
