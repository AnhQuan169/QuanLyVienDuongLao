<div class="main-right">
    <div class="card shadow-sm p-3 mb-5 bg-body rounded">
        <div class="card-header mb-2 rounded text-center">
            Liên kết
        </div>
        <ul class="list-group list-group-flush">
            @foreach ($lienket as $key => $val )
                <li class="">
                    <a href="{{$val->link_lienket}}" target="_blank">
                        <img class="shadow-sm mb-2 bg-body rounded" src="{{asset('public/storage/'.$val->hinhAnh_lienket)}}" width="100%" alt="">
                    </a>
                </li>
            @endforeach
        </ul>
    </div>
</div>