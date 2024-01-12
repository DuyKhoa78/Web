@extends('layouts.app')
@section('content')
@include('layouts.nav')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Liệt kê chương</div>
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <table class="table table-striped">
                        <thead>
                          <tr>
                            <th scope="col">STT</th>
                            <th scope="col">Tên chương</th>
                            <th scope="col">Slug chương</th>
                            <th scope="col">Thuộc sách</th>
                            <th scope="col">Nội dung</th>
                            <th scope="col">Kích hoạt</th>
                            <th scope="col">Quản lí</th>
                          </tr>
                        </thead>
                        <tbody>
                        @foreach($chapter as $key => $chap)
                            <tr>
                                <th scope="row">{{$key+1}}</th>
                                <td>{{$chap->tieude}}</td>
                                <td>{{$chap->slug_chapter}}</td>
                                <td>{{$chap->sach->tensach}}</td>
                                <td>{{$chap->noidung}}</td>
                                <td>
                                    @if ($chap->kichhoat==0)
                                        <span class="text text-success">Kích hoạt </span>
                                    @else
                                        <span class="text text-danger">Không kích hoạt</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{route('chapter.edit', ['chapter'=>$chap->id])}}" class="btn btn-primary">Edit</a>
                                    <form action="{{route("chapter.destroy",['chapter'=>$chap->id])}}" method="POST">
                                        @method('DELETE')
                                        @csrf
                                        <button onclick="return confirm('Bạn muốn xóa chương này không?')" class="btn btn-danger">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        </tbody>
                        @endforeach
                      </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
