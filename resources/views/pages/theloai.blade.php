@extends('../layout')
{{-- @section('slide')
    @include('pages.slide')
@endsection --}}
@section('content')
<style>

    .breadcrumb-container {
        background-color: rgb(220, 220, 220);
        padding: 10px; /* Điều chỉnh padding nếu cần */
        border-radius: 5px; /* Bo tròn viền container */
        margin-bottom: 15px; 
    }
    
    .breadcrumb-container nav ol.breadcrumb {
        margin: 0; /* Loại bỏ margin mặc định của breadcrumb */
        border-bottom: none; /* Loại bỏ line dưới breadcrumb */
    }
    
    .breadcrumb-container nav ol.breadcrumb li.breadcrumb-item {
        display: inline; /* Hiển thị các breadcrumb cùng một dòng */
        margin-right: 5px; /* Khoảng cách giữa các breadcrumb */
    }
    
    </style>
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{url('/')}}">Trang chủ</a></li>
        <li class="breadcrumb-item active" aria-current="page">{{$tentheloai}}</li>
    </ol>
</nav>
<h3>{{$tentheloai}}</h3>
<div class="album py-5 bg-light">
    <div class="container">
        <div class="row">
            @php
                $count=count($sach);
            @endphp
            @if ($count==0)
                <div class="col-md-12">
                    <div class="card mb-12 box-shadow">
                        <div class="card-body">
                            <p>Sách đang cập nhật ...</p>
                        </div>
                    </div>
                </div>
            @else
                @foreach ($sach as $key =>$value)
                    <div class="col-md-3">
                        <div class="card mb-3 box-shadow">
                            <img class="card-img-top" src="{{asset('uploads/sach/'.$value->hinhanh)}}" data-holder-rendered="true">
                            <div class="card-body">
                                <h5>{{$value->tensach}}</h5>
                                <p class="card-text">
                                    @php
                                        $tomtat = substr($value->tomtat, 0,150);
                                    @endphp
                                    {{$tomtat.'....'}}
                                </p>
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="btn-group">
                                        <a href="{{url('xem-sach/'.$value->slug_sach)}}" class="btn btn-sm btn-outline-secondary">Đọc ngay</a>
                                        <a class="btn btn-sm btn-outline-secondary" class=""><i class="fas fa-eye"></i></a>
                                    </div>
                                <small class="text-muted">{{$value->created_at->diffForHumans()}}</small>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach 
            @endif  
        </div>
    </div>
    {{$sach->links()}}
</div>
@endsection