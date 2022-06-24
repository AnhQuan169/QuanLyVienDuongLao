<div class="main-center">
    <div class="detail-post-list-choose">
        <div class="detail-post-wrap shadow p-3 mb-5 bg-body rounded">
            <div class="detail-post">
                <h2>{{$post->tenBaiViet}}</h2>
                <img src="{{asset('public/storage/'.$post->hinhAnh)}}" class="d-block w-100" >
                <div class="post-content">
                    {!!$post->noiDung!!}
                </div>
                <div class="other-post d-flex bd-highlight mb-3">
                    <div class="p-2 bd-highlight post-actor">{{$post->tacGia}}</div>
                    <div class="ms-auto p-2 bd-highlight post-date"><i class="fa fa-calendar" aria-hidden="true"></i> {{date('d-m-Y', strtotime($post->ngayDang))}}</div>
                </div>
            </div> 
        </div>
    
        <div class="list-post-related shadow p-3 mb-5 bg-body rounded">
            <p>Các bài viết khác</p>
            @foreach ($list_post as $key => $val )
                <a href="{{route('detail.posts',$val->id_baiViet)}}">
                    <div class="list-posts">
                        <span>{{$key + 1}}. </span>
                        <span style="margin-left: 10px">{{$val->tenBaiViet}}</span>
                    </div>
                </a>
            @endforeach
            <div class="pagination d-flex justify-content-center mt-4">
                {!!$list_post->links('paginationlinks')!!}
            </div>
        </div>
    </div>
</div>