@extends('layouts.app')
@section('content')
@include('layouts.nav')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">Liệt kê thể loại</div>
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
                            <th scope="col">Tên thể loại</th>
                            <th scope="col">Slug thể loại</th>
                            <th scope="col">Mô tả</th>
                            <th scope="col">Kích hoạt</th>
                            <th scope="col">Quản lí</th>
                          </tr>
                        </thead>
                        <tbody>
                        @foreach($theloai as $key => $loai)
                            <tr>
                                <th scope="row">{{$key+1}}</th>
                                <td>{{$loai->tentheloai}}</td>
                                <td>{{$loai->slug_theloai}}</td>
                                <td>{{$loai->mota}}</td>
                                <td>
                                    @if ($loai->kichhoat==0)
                                        <span class="text text-success">Kích hoạt</span>
                                    @else
                                        <span class="text text-danger">Không kích hoạt</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{route('theloai.edit', ['theloai'=>$loai->id])}}" class="btn btn-primary">Edit</a>
                                    <form action="{{route("theloai.destroy",['theloai'=>$loai->id])}}" method="POST">
                                        @method('DELETE')
                                        @csrf
                                        <button onclick="return confirm('Bạn muốn xóa thể loại này không?')" class="btn btn-danger">Delete</button>

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
