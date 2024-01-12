@extends('layouts.app')
@section('content')
@include('layouts.nav')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Liệt kê User</div>
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <table class="table table-striped table-responsive">
                        <thead>
                          <tr>
                            <th scope="col">STT</th>
                            <th scope="col">Tên User</th>
                            <th scope="col">Email</th>
                            <th scope="col">Vai trò</th>
                            <th scope="col">Quản lý</th>
                          </tr>
                        </thead>
                        <tbody>
                            @foreach ($user as $key => $u) 
                           
                            <tr>
                                <th scope="row">{{$key+1}}</th>
                                <th scope="row">{{$u->name}}</th>
                                <th scope="row">{{$u->email}}</th>
                                <th scope="row">
                                    @foreach($u->roles as $key => $role)
                                        {{$role->name}}
                                    @endforeach
                                </th>
                                <th scope="row">
                                    <a href="{{url('phan-vaitro/'.$u->id)}}" class="btn btn-success">Phân vai trò</a>
                                </th>
                            </tr>
                            @endforeach
                        </tbody>
                      </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
