{{-- @extends('client.Layout.main')
@section('client_detail') --}}

<div class="main-center">
    <div class="card">
        <div class="card-header text-center rounded">
            Các bài viết
        </div>
    </div>
    <div class="row">
        @foreach ($baiviet as $key => $val )
            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-4">
                <div class="card shadow p-3 mb-3 bg-body rounded">
                    <a href="{{route('detail.posts',$val->id_baiViet)}}">
                        <img src="{{asset('public/storage/'.$val->hinhAnh)}}" class="card-img-top" alt="...">
                        <div class="card-body">
                            <p class="card-text">{{$val->tenBaiViet}}</p>
                            <div class="card-date">
                                <p><i class="fa fa-calendar" aria-hidden="true"></i> {{date('d-m-Y', strtotime($val->ngayDang))}}</p>
                            </div>
                        </div>

                        @if ($date < $val->ngayDang )
                            <div class="new-post">
                                <span class="new-post-a"></span>
                                <span class="new-post-b">Mới</span>
                            </div>
                        @endif
                    </a>
                    
                </div>
            </div>
        @endforeach
        
    </div>
    <div class="col-sm-12 text-right text-center-xs mt-2">
        <div class="pagination d-flex justify-content-center">
            {!!$baiviet->links('paginationlinks')!!}
        </div>
    </div>
</div>
                    
{{-- @endsection --}}