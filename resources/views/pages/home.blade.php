@extends('../layout')
@section('slide')
    @include('pages.slide')
@endsection
@section('content')

<h3>SÁCH MỚI CẬP NHẬT</h3>
<div class="album py-2 bg-light">
    <div class="container">
        <div class="row">
			@foreach ($sach as $key =>$value)
            <div class="col-md-3">
                <div class="card mb-3 box-shadow">
                    <img class="card-img-top" src="{{asset('uploads/sach/'.$value->hinhanh)}}" data-holder-rendered="true">
                    <div class="card-body">
                        <h5>{{$value->tensach}}</h5>
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="btn-group">
                                <a href="{{url('xem-sach/'.$value->slug_sach)}}" class="btn btn-sm btn-outline-secondary">Đọc ngay</a>
                                <a class="btn btn-sm btn-outline-secondary" class=""><i class="fas fa-eye"></i> {{$value->view}}</a>
                            </div>
                        <small class="text-muted">{{$value->created_at->diffForHumans()}}</small>
                        </div>
                    </div>
                </div>
            </div>
			@endforeach   
        </div>
        {{$sach->links()}}
    </div>
</div>
@endsection