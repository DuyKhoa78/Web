@extends('layouts.app')
@section('content')
@include('layouts.nav')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Cập nhật sách</div>
                @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <form method="POST" action="{{route('sach.update',[$sach->id])}}" enctype="multipart/form-data"> 
                        @method('PUT')
                        @csrf
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Tên sách</label>
                            <input type="text" class="form-control" value="{{$sach->tensach}}" name="tensach" onkeyup="ChangeToSlug();" id="slug" aria-describedby="emailHelp" placeholder="Tên sách...">
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Từ khóa</label>
                            <input type="text" class="form-control" value="{{$sach->tukhoa}}" name="tukhoa" aria-describedby="emailHelp" placeholder="Từ khóa...">
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Lượt xem</label>
                            <input type="text" class="form-control" value="{{$sach->view}}" name="view" aria-describedby="emailHelp" placeholder="View...">
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Slug sách</label>
                            <input type="text" class="form-control" value="{{$sach->slug_sach}}" name="slug_sach" id="convert_slug" aria-describedby="emailHelp" placeholder="Slug sách...">
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Tên tác giả</label>
                            <input type="text" class="form-control" value="{{$sach->tacgia}}" name="tacgia" id="tacgia" aria-describedby="emailHelp" placeholder="Tác giả...">
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Tên dịch giả</label>
                            <input type="text" class="form-control" value="{{$sach->dichgia}}" name="dichgia" id="dichgia" aria-describedby="emailHelp" placeholder="Dịch giả...">
                        </div>
                        <label for="exampleInputEmail1">Danh mục sách</label>
                            @foreach($danhmuc as $key => $muc)
                                <div class="form-check">
                                    <input class="form-check-input"  @if( $thuocdanhmuc->contains($muc->id) ) checked @endif name="danhmuc[]" type="checkbox" id="danhmuc_{{$muc->id}}" value="{{$muc->id}}">
                                        <label class="form-check-label" for="danhmuc_{{$muc->id}}">{{$muc->tendanhmuc}}</label>
                                </div>
                            @endforeach
                        <label for="exampleInputEmail1">Thể loại</label>
                            @foreach($theloai as $key => $the)
                                <div class="form-check">
                                    <input class="form-check-input" @if( $thuoctheloai->contains($the->id) ) checked @endif name="theloai[]" type="checkbox" id="theloai_{{$the->id}}" value="{{$the->id}}">
                                    <label class="form-check-label" for="theloai_{{$the->id}}">{{$the->tentheloai}}</label>
                                </div>
                            @endforeach
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Tóm tắt sách</label>
                            <textarea name="tomtat" class="form-controll" style="width: 100%;" rows="5">{{$sach->tomtat}}</textarea>
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">File PDF</label>
                            <textarea name="file_pdf" class="form-controll" style="width: 100%;" rows="5">{{$sach->file_pdf}}</textarea>
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Số trang</label>
                            <input type="text" class="form-control" value="{{$sach->sotrang}}" name="sotrang" id="sotrang" aria-describedby="emailHelp" placeholder="Số trang...">
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Nhà xuất bản</label>
                            <input type="text" class="form-control" value="{{$sach->nxb}}" name="nxb" id="nxb" aria-describedby="emailHelp" placeholder="Nhà xuất bản...">
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Năm xuất bản</label>
                            <input type="text" class="form-control" value="{{$sach->namxb}}" name="namxb" id="namxb" aria-describedby="emailHelp" placeholder="Năm xuất bản...">
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Hình ảnh sách</label>
                            <input type="file" class="form-control-file" name="hinhanh">
                            <img src="{{asset('uploads/sach/'.$sach->hinhanh)}}" height="125" width="100">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Sách nổi bật/hot</label>
                          <select name="sach_hot" class="custom-select">
                            @if($sach->sach_hot==0)
                                <option selected value="0">Sách mới</option>
                                <option value="1">Sách nổi bật</option>
                                <option value="2">Sách hay</option>
                            @elseif($sach->sach_hot==1)
                                <option  value="0">Sách mới</option>
                                <option selected value="1">Sách nổi bật</option>
                                <option value="2">Sách hay</option>
                            @else 
                                <option  value="0">Sách mới</option>
                                <option  value="1">Sách nổi bật</option>
                                <option selected value="2">Sách hay</option>
                            @endif
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Kích hoạt</label>
                            <select name="kichhoat" class="form-select" aria-label="Default select example">
                                @if($sach->kichhoat==0)
                                <option selected value="0">Kích hoạt</option>
                                <option value="1">Không kích hoạt</option>
                                @else
                                <option value="0">Kích hoạt</option>
                                <option selected value="1">Không kích hoạt</option>
                                @endif
                            </select>
                        </div>
                        <button type="submit" name="Thêm sách" class="btn btn-primary">Cập nhật</button>
                      </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
