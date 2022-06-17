<div class="main-center">
    <div class="detail-post-list-choose">
        <div class="detail-post-wrap">
            <div class="detail-post">
                <h2>{{$tbao_a->chuDe}}</h2>
                <div class="post-content">
                    {!!$tbao_a->noiDung!!}
                </div>
                <div class="other-post d-flex bd-highlight mb-3">
                    <div class="p-2 bd-highlight post-actor">{{$tbao_a->hoTen}}</div>
                    <div class="ms-auto p-2 bd-highlight post-date"><i class="fa fa-calendar" aria-hidden="true"></i> {{date('d-m-Y', strtotime($tbao_a->thoiGianDang))}}</div>
                </div>
            </div> 
        </div>
    
        <div class="list-post-related">
            <p>Các thông báo khác</p>
            @foreach ($list_tbao as $key => $val )
                <a href="{{route('detail.notification',$val->id_thongbao)}}">
                    <div class="list-posts">
                        <span>{{$key + 1}}. </span>
                        <span style="margin-left: 10px">{{$val->chuDe}}</span>
                    </div>
                </a>
            @endforeach
            <div class="pagination d-flex justify-content-center mt-4">
                {!!$list_tbao->links('paginationlinks')!!}
            </div>
        </div>
    </div>
</div>