@extends('layout.app')
@section('content')
    <div class="container-fluid">
        <div class="d-flex justify-content-center align-items-center vh-100 mt-n5">
            <form action="{{route('login')}}" method="POST">
                @csrf


                <div class="form-group">
                    <label for="title">نام کاربری</label>
                    <input type="text" class="form-control @error('username') is-invalid @enderror" name="username"
                        value="{{old('username')}}">
                    @error('username')
                    <div class="alert alert-danger">{{$message}}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="title">رمز ورود</label>
                    <input type="password" class="form-control @error('password') is-invalid @enderror" name="password">
                    @error('password')
                    <div class="alert alert-danger">{{$message}}</div>
                    @enderror
                </div>

            

                <div class="form-group">
                    <label for="title"></label>
                    <button type="submit" class="btn btn-dark btn-block ">ورود</button>
                </div>

            </form>
        
    </div>

@endsection