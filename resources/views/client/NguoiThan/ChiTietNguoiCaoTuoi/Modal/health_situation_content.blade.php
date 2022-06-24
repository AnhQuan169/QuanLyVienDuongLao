<div class="collapse collapse-thsk" id="health-situation-content">
    <div class="card card-body">
        <div class="search">
            <form action="{{route('search.health_situation',$ncc->id_nguoicaotuoi)}}">
                <div class="search-group">
                    <div class="d-flex">
                        <div class="search-name">Ngày khám:</div>
                        <div class="search-date-choose">
                            <input name="search_date" id="search_date" type="date" value="{{$date}}">
                        </div>
                        <div class="search-submit">
                            <input type="submit" class="btn btn-primary" value="Tìm kiếm">
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <div class="search-result">
            @if (count($thsk) > 0)
                @foreach ($thsk as $key => $val )
                    <div class="card shadow-sm">
                        <div class=" d-flex flex-row">
                            <div class="search-time">
                                <p>
                                    
                                    <strong><i class="fa fa-clock"></i></strong> {{date('H:i A', strtotime($val->thoiGian))}}
                                </p>
                            </div>
                            <div class="search-main d-flex flex-column">
                                <span><strong>Huyết áp : </strong> {{$val->huyetAp}} (mmHg)</span>
                                <span><strong> Nhịp tim : </strong> {{$val->nhipTim}} (Nhịp/phút)</span>
                                <span><strong> Cân nặng : </strong> {{$val->canNang}} (Kg)</span>
                                <span><strong>Triệu chứng : </strong> {!!$val->trieuChung!!}</span>
                                <span><strong>Ghi chú : </strong> {!!$val->ghiChu!!}</span>
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                <div class="card">
                    <div class="card-body">
                        Chưa có thông tin nào
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>