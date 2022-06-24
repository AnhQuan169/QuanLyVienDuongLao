<div class="collapse collapse-benhan" id="medicine-records-content">
    <div class="card card-body">
        <div class="medicine-header">
            <p>Danh sách bệnh án</p>
        </div>
        <div class="medicine-content">
            @foreach ($benhan as $key => $val )
                <a data-bs-toggle="modal" data-bs-target="#medicine-records-content-{{$key}}">
                    <div class="card">
                        <div class="card-body">
                            <span><strong>Tên bệnh viện :</strong> {{$val->tenBenhVien}}</span>
                            <span style="padding: 0 10px"> - </span>
                            <span><strong>Ngày khám :</strong> {{date('d/m/Y', strtotime($val->ngayKham))}}</span>
                            @php
                                Session::put('id_benhan',$val->id_benhan);
                            @endphp
                        </div>
                    </div>
                </a>

                <div id="medicine-records-content-{{$key}}" class="modal fade" role="dialog">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header text-center">
                                <h4 class="modal-title">Chi tiết bệnh án ngày {{date('d/m/Y', strtotime($val->ngayKham))}}</h4>
                            </div>
                            <div class="modal-body">
                                <div class="card medicine-hospital">
                                    <p>Thông tin bệnh viện</p>
                                    <div class="medicine-hospital-content">
                                        <div class="d-flex flex-row content-border">
                                            <span class="medicine-hospital-title"><strong>Tên bệnh viện </strong></span>
                                            <span class="medicine-hospital-name">: {{$val->tenBenhVien}}</span>
                                        </div>
                                        <div class="d-flex flex-row content-border">
                                            <span class="medicine-hospital-title"><strong>Địa chỉ </strong></span>
                                            <span>: {{$val->diaChi}}</span>
                                        </div>
                                        <div class="d-flex flex-row content-border">
                                            <span class="medicine-hospital-title"><strong>Số điện thoại </strong></span>
                                            <span>: {{$val->soDienThoai}}</span>
                                        </div>
                                        <div class="d-flex flex-row content-border">
                                            <span class="medicine-hospital-title"><strong>Khoa </strong></span>
                                            <span>: {{$val->khoa}}</span>
                                        </div>
                                        <div class="d-flex flex-row content-border" style="border:none">
                                            <span class="medicine-hospital-title"><strong>Bác sĩ </strong></span>
                                            <span>: {{$val->bacSi}}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="card medicine-hospital mt-3">
                                    <p>Thông tin khám bệnh</p>
                                    <div class="medicine-hospital-content">
                                        <div class="d-flex flex-row content-border">
                                            <span class="medicine-hospital-title"><strong>Ngày khám </strong></span>
                                            <span>: {{date('d/m/Y', strtotime($val->ngayKham))}}</span>
                                        </div>
                                        <div class="d-flex flex-row content-border">
                                            <span class="medicine-hospital-title"><strong>Ngày vào viện </strong></span>
                                            <span>: {{date('d/m/Y', strtotime($val->ngayVaoVien))}}</span>
                                        </div>
                                        <div class="d-flex flex-row content-border">
                                            <span class="medicine-hospital-title"><strong>Ngày ra viện </strong></span>
                                            <span>: {{date('d/m/Y', strtotime($val->ngayRaVien))}}</span>
                                        </div>
                                        <div class="d-flex flex-row content-border">
                                            <span class="medicine-hospital-title"><strong>Tiền sử bệnh </strong></span>
                                            <span>: {{$val->tienSuBenh}}</span>
                                        </div>
                                        <div class="d-flex flex-row content-border">
                                            <span class="medicine-hospital-title"><strong>Kết quả xét nghiệm </strong></span>
                                            <span>: {{$val->ketQuaXetNghiem}}</span>
                                        </div>
                                        <div class="d-flex flex-row content-border">
                                            <span class="medicine-hospital-title"><strong>Chẩn đoán </strong></span>
                                            <span>: {{$val->chanDoan}}</span>
                                        </div>
                                        <div class="d-flex flex-row content-border">
                                            <span class="medicine-hospital-title"><strong>Ngày hẹn khám </strong></span>
                                            <span>: {{date('d/m/Y', strtotime($val->ngayHenKham))}}</span>
                                        </div>
                                        <div class="d-flex flex-row content-border">
                                            <span class="medicine-hospital-title"><strong>Ghi chú </strong></span>
                                            <span>: {{$val->ghiChu}}</span>
                                        </div>
                                        <div class="d-flex flex-row content-border" style="border:none">
                                            <span class="medicine-hospital-title"><strong>Chi phí </strong></span>
                                            <span>: {{number_format($val->chiPhi,0,',','.')}} (VND)</span>
                                        </div>
                                    </div>
                                </div>
                                {{-- <a class="btn btn-warning round mt-2" style="float: left;" data-bs-toggle="modal" data-bs-target="#prescription-content-{{$val->id_benhAn}}">
                                    Đơn thuốc
                                </a> --}}
                                <a href="{{route('prescription.pdf',$val->id_benhAn)}}" target="_blank" class="btn btn-warning mt-2">In đơn thuốc</a>
                            </div>
                            <div class="modal-footer">
                                <button class="btn btn-danger round" data-bs-dismiss="modal" style="float: left;">Đóng</button>
                            </div>
                        </div>
                    </div>
                </div>

            @endforeach
        </div>
    </div>
</div>

{{-- <div id="#prescription-content-{{$val->id_benhAn}}" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header text-center">
                <h4 class="modal-title">Đơn thuốc</h4>
            </div>
            <div class="modal-body">
                @foreach ($donthuoc as  $key => $val)
                    {{$val->soLuong}}
                @endforeach
            </div>
            <div class="modal-footer">
                <button class="btn btn-danger round" data-bs-dismiss="modal" style="float: left;">Đóng</button>
            </div>
        </div>
    </div>
</div> --}}