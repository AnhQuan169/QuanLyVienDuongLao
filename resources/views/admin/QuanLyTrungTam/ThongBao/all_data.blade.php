<div class="table-responsive">
    <table class="display table table-bordered">
        <thead>
            <tr>
                <th>Mã thông báo</th>
                <th>Chủ đề</th>
                <th>Nội dung</th>
                <th>Thời gian đăng</th>
                <th>Quản lý trung tâm</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($thongbao as $key => $tbao )
                <tr>
                    <td>{{$tbao->id_thongbao}}</td>
                    <td>{{$tbao->chuDe}}</td>
                    <td>{{$tbao->noiDung}}</td>
                    <td>{{$tbao->thoiGianDang}}</td>
                    <td>{{$tbao->hoTen}}</td>
                    <td>
                        <a type="button" class="btn btn-success edit-tb" style="border-radius: 7px"><i class="fa fa fa-pencil-square"></i></a>
                        <a type="button" data-id="{{$tbao->id_thongbao}}" class="btn btn-danger delete-tb" style="border-radius: 7px"><i class="fa fa-times"></i></a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>  
    
    <div class="col-sm-12 text-right text-center-xs mt-2">
        <div class="pagination d-flex justify-content-center">
            {!!$thongbao->links('paginationlinks')!!}
        </div>
    </div>
</div>


