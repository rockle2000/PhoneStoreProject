@extends('layouts.home_layout')
@section('content')
<div class="container rounded bg-white mt-50 mb-50">
    <div class="row mb-5">
        <div class="col-md-2"></div>
        <div class="col-md-3 border">
            <div class="d-flex flex-column align-items-center text-center p-3 py-5">
                <img class="" src="{{asset('public/frontend/images/about-us/user.png')}}" width="90">
                <span class="font-weight-bold">{{$customer->name}}</span>
                <span class="text-black-50">{{$customer->email}}</span>
                <span>{{$customer->phone}}</span>
            </div>
        </div>
        <div class="col-md-5 border">
            <div class="p-3 py-5">
                <div class=" mb-3">
                    <div class="align-items-center back">
                        <h5 class="text-center">Đổi mật khẩu</h5>
                    </div>
                </div>
                <form method="POST" action="{{route('user.updatepass',['id' => $customer->id])}}">
                    @csrf
                    @method('PUT')
                    <div class="row mt-2">
                        <div class="col-md-12 d-flex justify-content-between align-items-center">
                            <label for="oldpass" class="w-50">Mật khẩu hiện tại</label>
                            <input type="password" class="form-control form-control-user @error('oldpass') is-invalid @enderror" id="examplePassword" placeholder="Nhập mật khẩu hiện tại" name="oldpass" value="{{ old('oldpass')}}">
                        </div>
                        @error('oldpass')
                        <div class="text-danger text-right col-md-12">{{$message}}</div>
                        @enderror
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-12 d-flex justify-content-between align-items-center">
                            <label for="password" class="w-50">Mật khẩu mới</label>
                            <input type="password" class="form-control form-control-user @error('password') is-invalid @enderror" id="examplePassword" placeholder="Mật khẩu mới" name="password" value="{{ old('password') }}">
                        </div>
                        @error('password')
                        <div class="text-danger text-right col-md-12">{{$message}}</div>
                        @enderror
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-12 d-flex justify-content-between align-items-center">
                            <label for="cpassword" class="w-50">Nhập lại mật khẩu</label>
                            <input type="password" class="form-control" name="cpassword" placeholder="Nhập lại mật khẩu mới" value="{{ old('cpassword') }}">
                        </div>
                        @error('cpassword')
                        <div class="text-danger text-right col-md-12">{{$message}}</div>
                        @enderror
                    </div>
                    <div class="mt-15 text-right">
                        <button class="btn btn-success profile-button" type="submit">Xác nhận</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
