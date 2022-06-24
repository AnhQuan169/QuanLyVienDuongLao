@extends('client.client_layout')
@section('client_layout')
<section>
    <div id="content">
        <div class="main-content">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-9">
                        @include('client.ThongTinChung.ThongBao.detail_tbao')
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-3">
                        @include('client.Layout.left')
                        @include('client.Layout.right')
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection