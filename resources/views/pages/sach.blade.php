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

<div class="breadcrumb-container nav1-container">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item "><a href="{{url('/')}}">Trang chủ</a></li>
            <li class="breadcrumb-item "><a href="{{url('danh-muc/'.$sach->danhmucsach->slug_danhmuc)}}">{{$sach->danhmucsach->tendanhmuc}}</a></li>
            <li class="breadcrumb-item  active" aria-current="page">{{$sach->tensach}}</li>
        </ol>
    </nav>
</div>

<div class="row">
    <div class="col-md-9">
        <div class="row">
            @php
                $mucluc=count($chapter);
            @endphp
            <div class="col-md-4">
                <img class="card-img-top" width="100%" height="95%" src="{{asset('uploads/sach/'.$sach->hinhanh)}}" data-holder-rendered="true">
            </div>
            <div class="col-md-8">
                <style type="text/css">
                    .inforsach{
                        list-style: none;
                    }
                    .isDisabled{
                        color: currentColor;
                        pointer-events: none;
                        opacity: 0.5;
                        text-decoration: none;
                    }
                    .tomtat-sach{
                        padding: 0;
                        margin:20px 0;
                        line-height: 17px;
                        box-shadow: 2px 2px 3px #ddd;
                    }
                </style>
                <ul class="inforsach">
                    <div class="fb-share-button" data-href="{{\URL::current()}}" data-layout="button_count" data-size="small">
                        <a target="_blank" href="{{\URL::current()}}&amp;src=sdkpreparse" class="fb-xfbml-parse-ignore">Chia sẻ</a>
                    </div>
                    <input type="hidden" value="{{$sach->tensach}}" class="wishlist_title">
                    <input type="hidden" value="{{\URL::current()}}" class="wishlist_url">
                    <input type="hidden" value="{{$sach->id}}" class="wishlist_id">
                    <li>Tên sách: {{$sach->tensach}}</li>
                    <li>Ngày đăng : <span class="text text-primary">{{ $sach->created_at->diffForHumans()}}</span></li>
                    <li>Tác giả: {{$sach->tacgia}}</li>
                    <li>Dịch giả: {{$sach->dichgia}}</li>
                    <li> Danh mục sách :
                        @foreach($sach->thuocnhieudanhmucsach as $thuocdanh)
                                
                           <a href="{{url('danh-muc/'.$thuocdanh->slug_danhmuc)}}"><span class="badge bg-dark">{{$thuocdanh->tendanhmuc}}</span></a>
                           @endforeach
                        </li>
                       <li> Thể loại truyện : 
                           @foreach($sach->thuocnhieutheloaisach as $thuocloai)
                           <a href="{{url('the-loai/'.$thuocloai->slug_theloai)}}"><span class="badge bg-info text-dark">{{$thuocloai->tentheloai}}</span></a>
                           @endforeach
                        </li>
                    <li> Số chương hiện có: {{$mucluc}}</li>
                    <li>Số trang: {{$sach->sotrang}}</li>
                    <li>Nhà xuất bản: {{$sach->nxb}}</li>
                    <li>Năm xuất bản: {{$sach->namxb}}</li>
                    <li>Số lượt xem: {{$sach->view}}</li>
                    <li><a class="xemmucluc" style="cursor: pointer;">Xem mục lục</a></li>
                    @if($chapter_dau)
                    <li>
                        <a class="btn btn-primary" href="{{url('xem-chapter/'.$chapter_dau->sach->slug_sach.'/'.$chapter_dau->slug_chapter)}}">Đọc ngay</a>
                        <button class="btn btn-danger btn-thich_sach"><i class="fa fa-heart" aria-hidden="true"></i> Thích sách</button>
                    </li>
                    @else
                    <li><a class="btn btn-primary isDisabled">Đọc ngay</a>
                        <button class="btn btn-danger btn-thich_sach"><i class="fa fa-heart" aria-hidden="true"></i> Thích sách</button>
                    </li>
                    @endif
                    <li>
                        
                        @if ($sach->file_pdf!="")
                        <form>
                            @csrf
                            <button type="button" id="{{$sach->id}}" class="btn btn-success xempdf mt-1" data-bs-toggle="modal" data-bs-target="#exampleModal">
                            Xem PDF
                            </button>         
                            <!-- Modal -->
                            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-scrollable modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">
                                        <div id="tieude_sach">

                                        </div>
                                    </h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div id="noidung_sach"></div>
                                    </div>
                                    <div class="modal-footer">
                                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Đóng</button>
                                    </div>
                                </div>
                                </div>
                            </div>
                            </form>
                        @endif

                    </li>
                </ul>
            </div>
        </div>
        <div class="col-md-12 tomtat-sach">
            <p>{!!$sach->tomtat!!}</p>
        </div>
        <hr>
        <style type="text/css">
            .tagcloud05 ul {
            margin: 0;
            padding: 0;
            list-style: none;
        }
        .tagcloud05 ul li {
            display: inline-block;
            margin: 0 0 .3em 1em;
            padding: 0;
        }
        .tagcloud05 ul li a {
            position: relative;
            display: inline-block;
            height: 30px;
            line-height: 30px;
            padding: 0 1em;
            background-color: #3498db;
            border-radius: 0 3px 3px 0;
            color: #fff;
            font-size: 13px;
            text-decoration: none;
            -webkit-transition: .2s;
            transition: .2s;
        }
        .tagcloud05 ul li a::before {
            position: absolute;
            top: 0;
            left: -15px;
            content: '';
            width: 0;
            height: 0;
            border-color: transparent #3498db transparent transparent;
            border-style: solid;
            border-width: 15px 15px 15px 0;
            -webkit-transition: .2s;
            transition: .2s;
        }
        .tagcloud05 ul li a::after {
            position: absolute;
            top: 50%;
            left: 0;
            z-index: 2;
            display: block;
            content: '';
            width: 6px;
            height: 6px;
            margin-top: -3px;
            background-color: #fff;
            border-radius: 100%;
        }
        .tagcloud05 ul li span {
            display: block;
            max-width: 100px;
            white-space: nowrap;
            text-overflow: ellipsis;
            overflow: hidden;
        }
        .tagcloud05 ul li a:hover {
            background-color: #555;
            color: #fff;
        }
        .tagcloud05 ul li a:hover::before {
            border-right-color: #555;
        }
        </style>
        <p> Từ khóa tìm kiếm:
            @php
            $tukhoa = explode(",",$sach->tukhoa);
            @endphp
            <div class="tagcloud05">
                <ul>
                    @foreach($tukhoa as $key =>$tu)
                    <li><a href="{{url('tag/'.\Str::slug($tu))}}"><span>{{$tu}}</span></a></li>
                    @endforeach
                </ul>
            </div>
        </p>
        <style type="text/css">
			ul.muclucsach {
			    -moz-column-count: 3;
			    -moz-column-gap: 20px;
			    -webkit-column-count: 3;
			    -webkit-column-gap: 20px;
			    column-count: 3;
			    column-gap: 20px;
			}
		</style>
        <h4>Danh sách chương</h4>
        <ul class="muclucsach">
            @php
            $mucluc = count($chapter);
            @endphp
            @if ($mucluc!=0)
                @foreach($chapter as $key => $chap)
                    <li><a href="{{url('xem-chapter/'.$chap->sach->slug_sach.'/'.$chap->slug_chapter)}}">{{$chap->tieude}}</a></li>
                @endforeach
            @else
                <li>Đang cập nhật...</li>
            @endif
            
        </ul>
        <div class="fb-comments" data-href="{{\URL::current();}}" data-width="100%" data-numposts="10"></div>
        <h4>Sách liên quan</h4>
        <div class="row">
            @foreach($cungdanhmuc as $key => $cungdanh)
                @foreach($cungdanh->nhieusach as $value)
                    @if($value->id != $sach->id)
                        <div class="col-md-3">
                            <div class="card mb-3 box-shadow">
                                <a href="{{ url('xem-sach/'.$value->slug_sach) }}"><img class="card-img-top" src="{{ asset('uploads/sach/'.$value->hinhanh) }}"></a>
                                <div class="card-body">
                                    <h5>{{ $value->tensach }}</h5>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="btn-group">
                                            <a href="{{ url('xem-sach/'.$value->slug_sach) }}" class="btn btn-sm btn-outline-secondary">Xem sách</a>
                                            <div class="btn btn-sm btn-outline-secondary"><i class="fas fa-eye"></i> {{ $value->view }}</div>
                                        </div>
                                        <small class="text-muted"></small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                @endforeach
            @endforeach
        </div>        
    </div>
    <div class="col-md-3">
        <style type = "text/css">
            .col-md-7.sidebar a{
                font-size: 15px;
                text-decoration: none;
                color: #000;
            }
            .col-md-7.sidebar{
                padding: 0;
            }
            .card-header{
                background: #3498db !important;
            }
            .title_sach{
                margin: 10px 0px;
            }
        </style>
        <h3 class="card-header">Sách nổi bật</h3>
        @foreach($sachnoibat as $key => $_sach)
        <div class="row mt-3">
            <div class="col-md-5"><a href="{{url('xem-sach/'.$_sach->slug_sach)}}"><img class="img img-responsive" width="100%" height="100px" class="card-img-top" src="{{asset('uploads/sach/'.$_sach->hinhanh)}}" alt="{{$_sach->tensach}}"></a></div>
            <div class="col-md-7 sidebar">
                <a href="{{url('xem-sach/'.$_sach->slug_sach)}}">
                <p>{{$_sach->tensach}}</p></a>
                <p><i class="fas fa-eye"></i> {{$_sach->view}}</p>
            </div>
        </div>
        @endforeach
        <h3 class="title_sach card-header">Sách yêu thích</h3>
            <div id="yeuthich"></div>
    </div>
</div>
@endsection