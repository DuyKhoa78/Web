@extends('layouts.app')
@section('content')
@include('layouts.nav')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Thêm chương sách</div>
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
                    <form method="POST" action="{{route('chapter.store')}}">
                        @csrf
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Tên chương</label>
                            <input type="text" class="form-control" value="{{old('tieude')}}" name="tieude" onkeyup="ChangeToSlug();" id="slug" aria-describedby="emailHelp" placeholder="Tên chương...">
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Slug chương</label>
                            <input type="text" class="form-control" value="{{old('slug_chapter')}}" name="slug_chapter" id="convert_slug" aria-describedby="emailHelp" placeholder="Slug chương...">
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Thuộc sách</label>
                            <select name="sach_id" class="form-select" aria-label="Default select example">
                                @foreach($sach as $key =>$value)
                                <option value="{{$value->id}}">{{$value->tensach}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputEmail">Nội dung</label>
                            <textarea name="noidung" class ="form-control" rows="5" style="width: 100%;"></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Kích hoạt</label>
                            <select name="kichhoat" class="form-select" aria-label="Default select example">
                                <option value="0">Kích hoạt</option>
                                <option value="1">Không kích hoạt</option>
                            </select>
                        </div>
                        <button type="submit" name="Themdanhmuc" class="btn btn-primary">Thêm</button>
                      </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
