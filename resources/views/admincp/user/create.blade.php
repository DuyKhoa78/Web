@extends('layouts.app')
@section('content')
@include('layouts.nav')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Thêm user</div>
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
                    <form method="POST" action="{{route('user.store')}}">
                        @csrf
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Tên user</label>
                            <input type="text" class="form-control" value="{{old('name')}}" name="name" aria-describedby="emailHelp" placeholder="Tên user...">
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Email</label>
                            <input type="text" class="form-control" value="{{old('email')}}" name="email" aria-describedby="emailHelp" placeholder="Email...">
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Password</label>
                            <input type="text" class="form-control" value="{{old('password')}}" name="password" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Password...">
                        </div>
                        <button type="submit" name="themuser" class="btn btn-primary">Thêm user</button>
                      </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
