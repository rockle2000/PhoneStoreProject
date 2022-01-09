@extends('layouts.home_layout')
@section('content')
<style>
    /* body {
    background: #BA68C8
} */

    .form-control:focus {
        box-shadow: none;
        border-color: #BA68C8
    }

    .profile-button {
        background: #BA68C8;
        box-shadow: none;
        border: none
    }

    .profile-button:hover {
        background: #682773
    }

    .profile-button:focus {
        background: #682773;
        box-shadow: none
    }

    .profile-button:active {
        background: #682773;
        box-shadow: none
    }

    .back:hover {
        color: #682773;
        cursor: pointer
    }
</style>
<div class="container rounded bg-white mt-5">
    <div class="row mb-5">
        <div class="col-md-2"></div>
        <div class="col-md-4 border">
            <div class="d-flex flex-column align-items-center text-center p-3 py-5"><img class="rounded-circle mt-5"
                    src="https://picsum.photos/200/200" width="90"><span class="font-weight-bold">{{$customer ->
                    name}}</span><span class="text-black-50">{{$customer -> email}}</span><span>{{$customer->
                    phone}}</span></div>
        </div>
        <div class="col-md-4 border">
            <div class="p-3 py-5">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <div class="d-flex flex-row align-items-center back"><i class="fa fa-long-arrow-left mr-1 mb-1"></i>
                        <h6> <a href="{{route('main-page')}}">Quay lại</a></h6>
                    </div>
                    <h6 class="text-right">Đổi mật khẩu</h6>
                </div>
                <form method="POST" action="{{route('user.updatepass',['id' => $customer->id])}}">
                    @csrf
                    @method('PUT')
                    <div class="row mt-2">
                        <div class="col-md-12 d-flex justify-content-between align-items-center">
                            <label for="oldpass" class="w-50">Mật khẩu cũ:</label>
                            <input type="password"
                                class="form-control form-control-user @error('oldpass') is-invalid @enderror"
                                id="examplePassword" placeholder="Nhập mật khẩu cũ" name="oldpass"
                                value="{{ old('oldpass')}}">
                        </div>
                        @error('oldpass')
                            <div class="text-danger text-right col-md-12">{{$message}}</div>
                        @enderror
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-12 d-flex justify-content-between align-items-center">
                            <label for="password" class="w-50">Mật khẩu mới:</label>
                            <input type="password"
                                class="form-control form-control-user @error('password') is-invalid @enderror"
                                id="examplePassword" placeholder="Mật khẩu mới" name="password"
                                value="{{ old('password') }}">
                        </div>
                        @error('password')
                        <div class="text-danger text-right col-md-12">{{$message}}</div>
                        @enderror
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-12 d-flex justify-content-between align-items-center">
                            <label for="cpassword" class="w-50">Nhập lại mật khẩu:</label>
                            <input type="password" class="form-control" name="cpassword"
                                placeholder="Nhập lại mật khẩu mới" value="{{ old('cpassword') }}">
                        </div>
                        @error('cpassword')
                        <div class="text-danger text-right col-md-12">{{$message}}</div>
                        @enderror
                    </div>
                    <div class="mt-5 text-right"><button class="btn btn-primary profile-button" type="submit">Thay
                            đổi</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
