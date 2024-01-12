@extends('layouts.app')
@section('content')
@include('layouts.nav')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">Liệt kê sách: {{$count}}</div>

                <div class="card-body">
                    <div id="thongbao"></div>
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <table class="table table-striped table-responsive">
                        <thead>
                          <tr>
                            <th scope="col">STT</th>
                            <th scope="col">Tên sách</th>
                            <th scope="col">Từ khóa</th>
                            <th scope="col">Slug sách</th>
                            <th scope="col">Tác giả</th>
                            <th scope="col">Dịch giả</th>
                            <th scope="col">Danh mục</th>
                            <th scope="col">Thể loại</th>
                            <th scope="col">Tóm tắt</th>
                            <th scope="col">File PDF</th>
                            <th scope="col">Số trang</th>
                            <th scope="col">Nhà xuất bản</th>
                            <th scope="col">Năm xuất bản</th>
                            <th scope="col">Hình ảnh</th>
                            <th scope="col">View</th>
                            <th scope="col">Nổi bật</th>
                            <th scope="col">Kích hoạt</th>
                            <th scope="col">Ngày tạo</th>
                            <th scope="col">Ngày cập nhật</th>
                            <th scope="col">Quản lí</th>
                          </tr>
                        </thead>
                        <tbody>
                        @foreach($list_sach as $key => $sach)
                            <tr>
                                <th scope="row">{{++$i}}</th>
                                <td>{{$sach->tensach}}</td>
                                <td>{{$sach->tukhoa}}</td>
                                <td>{{$sach->slug_sach}}</td>
                                <td>{{$sach->tacgia}}</td>
                                <td>{{$sach->dichgia}}</td>
                                <td>
                                    @foreach($sach->thuocnhieudanhmucsach as $thuocdanh)
                                        <span class="badge bg-dark">{{$thuocdanh->tendanhmuc}}</span>
                                    @endforeach
                                </td>
                                <td>
                                    @foreach($sach->thuocnhieutheloaisach as $thuocloai)
                                        <span class="badge bg-success">{{$thuocloai->tentheloai}}</span>
                                    @endforeach
                                </td>
                                @php
                                    $tomtat = substr($sach->tomtat, 0,100);
                                @endphp
                                <td>{{$tomtat.'...'}}</td>
                                
                                <td>{{$sach->file_pdf}}</td>
                                <td>{{$sach->sotrang}}</td>
                                <td>{{$sach->nxb}}</td>
                                <td>{{$sach->namxb}}</td>
                                <td><img src="{{asset('uploads/sach/'.$sach->hinhanh)}}" height="250" width="180"></td>
                                <td>{{$sach->view}}</td>
                                <td width="10%">
                                    @if($sach->sach_hot==0)
                                    <form>
                                    @csrf
                                        <select name="sach_hot" data-sach_id="{{$sach->id}}" class="custom-select sachnoibat">
                                            <option selected value="0">Sách mới</option>
                                            <option value="1">Sách nổi bật</option>
                                            <option value="2">Sách hay</option>
                                        </select>
                                    </form>
                                    @elseif($sach->sach_hot==1)
                                        <form>
                                        @csrf
                                       <select name="sach_hot" data-sach_id="{{$sach->id}}" class="custom-select sachnoibat">
                                        <option  value="0">Sách mới</option>
                                        <option selected value="1">Sách nổi bật</option>
                                        <option value="2">Sách hay</option>
                                      </select>
                                    </form>
                                    @else
                                        <form>
                                        @csrf
                                       <select name="sach_hot" data-sach_id="{{$sach->id}}" class="custom-select sachnoibat">
                                        <option  value="0">Sách mới</option>
                                        <option value="1">Sách nổi bật</option>
                                        <option selected value="2">Sách hay</option>
                                      </select>
                                    </form>
                                    @endif
                                </td>
                                <td>
                                    @if ($sach->kichhoat==0)
                                        <span class="text text-success">Kích hoạt </span>
                                    @else
                                        <span class="text text-danger">Không kích hoạt</span>
                                    @endif
                                </td>
                                <td>{{$sach->created_at}} <br><p>{{$sach->created_at->diffForHumans()}}</p></td>
                                @if ($sach->updated_at!='')
                                    <td>{{$sach->updated_at}} <br><p>{{$sach->updated_at->diffForHumans()}}</p></td>
                                @endif
                                <td>
                                    <a href="{{route('sach.edit', ['sach'=>$sach->id])}}" class="btn btn-primary">Edit</a>
                                    <form action="{{route("sach.destroy",['sach'=>$sach->id])}}" method="POST">
                                        @method('DELETE')
                                        @csrf
                                        <button onclick="return confirm('Bạn muốn xóa sách này không?')" class="btn btn-danger">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        </tbody>
                        @endforeach
                      </table>
                      {{$list_sach->links()}}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
