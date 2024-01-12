@extends('layouts.app')
@section('content')
@include('layouts.nav')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Thêm sách</div>
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
                    <form method="POST" action="{{route('sach.store')}}" enctype="multipart/form-data"> 
                        @csrf
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Tên sách</label>
                            <input type="text" class="form-control" value="{{old('tensach')}}" name="tensach" onkeyup="ChangeToSlug();" id="slug" aria-describedby="emailHelp" placeholder="Tên sách...">
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Từ khóa</label>
                            <input type="text" class="form-control" value="{{old('tukhoa')}}" name="tukhoa"  aria-describedby="emailHelp" placeholder="Từ khóa...">
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Slug sách</label>
                            <input type="text" class="form-control" value="{{old('slug_sach')}}" name="slug_sach" id="convert_slug" aria-describedby="emailHelp" placeholder="Slug sách...">
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Tên tác giả</label>
                            <input type="text" class="form-control" value="{{old('tacgia')}}" name="tacgia" aria-describedby="emailHelp" placeholder="Tác giả...">
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Tên dịch giả</label>
                            <input type="text" class="form-control" value="{{old('dichgia')}}" name="dichgia" aria-describedby="emailHelp" placeholder="Dịch giả...">
                        </div>
                        <div class="form-group">
                        <label for="theloai">Danh mục sách</label>
                            @foreach($danhmuc as $key => $muc)
                            <div>
                                <input class="form-check-input" name="danhmuc[]" type="checkbox" id="danhmuc_{{$muc->id}}" value="{{$muc->id}}">
                                <label class="form-check-label" for="theloai_{{$muc->id}}">{{$muc->tendanhmuc}}</label>
                            </div>
                            @endforeach
                        </div>
                        <div class="form-group">
                        <label for="theloai">Thể loại </label>
                            @foreach($theloai as $key => $the)
                            <div>
                                <input class="form-check-input" name="theloai[]" type="checkbox" id="theloai_{{$the->id}}" value="{{$the->id}}">
                                <label class="form-check-label" for="theloai_{{$the->id}}">{{$the->tentheloai}}</label>
                            </div>
                            @endforeach
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Số trang</label>
                            <input type="text" class="form-control" value="{{old('sotrang')}}" name="sotrang" aria-describedby="emailHelp" placeholder="Số trang...">
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Nhà xuất bản</label>
                            <input type="text" class="form-control" value="{{old('nxb')}}" name="nxb" aria-describedby="emailHelp" placeholder="Nhà xuất bản...">
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Năm xuất bản</label>
                            <input type="text" class="form-control" value="{{old('namxb')}}" name="namxb" aria-describedby="emailHelp" placeholder="Năm xuất bản...">
                        </div>
                        {{-- <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Danh mục sách</label>
                            <select name="danhmuc" class="form-select" aria-label="Default select example">
                               @foreach($danhmuc as $key => $muc)
                                <option value="{{$muc->id}}">{{$muc->tendanhmuc}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Thể loại</label>
                            <select name="theloai" class="form-select" aria-label="Default select example">
                               @foreach($theloai as $key => $loai)
                                <option value="{{$loai->id}}">{{$loai->tentheloai}}</option>
                                @endforeach
                            </select>
                        </div> --}}
                        <div class="form-group">

                            <label for="exampleInputEmail1">Sách nổi bật/hot</label>
    
                            <select name="sach_hot" class="custom-select">
    
                              <option value="0">Sách mới</option>
    
                              <option value="1">Sách nổi bật</option>
    
                              <option value="2">Sách hay</option>
    
                            </select>
    
                          </div>
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Mô tả sách</label>
                            <textarea name="tomtat" class="form-controll" style="width: 100%;" rows="5"></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">File PDF</label>
                            <textarea name="file_pdf" class="form-controll" style="width: 100%;" rows="5"></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Hình ảnh sách</label>
                            <input type="file" class="form-control-file" name="hinhanh">
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Kích hoạt</label>
                            <select name="kichhoat" class="form-select" aria-label="Default select example">
                                <option value="0">Kích hoạt</option>
                                <option value="1">Không kích hoạt</option>
                            </select>
                        </div>
                        <button type="submit" name="Thêm sách" class="btn btn-primary">Thêm</button>
                      </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
