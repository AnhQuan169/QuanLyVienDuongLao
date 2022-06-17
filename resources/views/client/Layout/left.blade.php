<div class="main-left">
    <div class="card shadow-sm mb-2 bg-body rounded">
        <div class="card-header m-3 mb-2 rounded text-center">
            Thông báo
        </div>
        <ul class="list-group list-group-flush">
            @foreach ($tbao as $key => $val )
                <li class="list-group-item text-truncate shadow-sm mb-2 bg-body rounded">
                    <a href="{{route('detail.notification',$val->id_thongbao)}}">{{$key + 1}}. {{$val->chuDe}}</a>
                </li>
            @endforeach
        </ul>
    </div>
</div>