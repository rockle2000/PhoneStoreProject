@extends('layouts.home_layout')
@section('content')
<!-- Begin Li's Breadcrumb Area -->
<div class="breadcrumb-area">
    <div class="container">
        <div class="breadcrumb-content">
            <ul>
                <li><a href="index.html">Home</a></li>
                <li class="active">Đăng ký</li>
            </ul>
        </div>
    </div>
</div>
<!-- Li's Breadcrumb Area End Here -->
<div class="page-section mb-60">
    <div class="container">
        <div class="row">
            <div class="col-sm-12 col-md-12 col-xs-12 col-lg-3 mb-30"></div>
            <div class="col-sm-12 col-md-12 col-xs-12 col-lg-6 mb-30">
                <form action="{{ route('user.create') }}" method="post" autocomplete="off">
                    @if (Session::get('success'))
                    <div class="alert alert-success">
                        {{ Session::get('success') }}
                    </div>
                    @endif
                    @if (Session::get('fail'))
                    <div class="alert alert-danger">
                        {{ Session::get('fail') }}
                    </div>
                    @endif

                    @csrf
                    <div class="login-form">
                        <h4 class="login-title">Đăng ký</h4>
                        <div class="row">
                            <div class="col-md-12 col-12 mb-20">
                                <label>Fullname <span class="text-danger">*</span></label>
                                <input class="mb-0" type="text" class="form-control" name="name" placeholder="Nhập họ tên..." value="{{ old('name') }}">
                                <span class="text-danger">@error('name'){{ $message }} @enderror</span>
                            </div>
                            <div class="col-md-12 col-12 mb-20">

                                <label>Phone Number <span class="text-danger">*</span></label>
                                <input class="mb-0" type="text" class="form-control" name="phone_number" placeholder="Nhập số điện thoại..." value="{{ old('phone_number') }}">

                                <span class="text-danger">@error('phone_number'){{ $message }} @enderror</span>
                            </div>
                            <div class="col-md-12 mb-20">
                                <label>Email Address <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="email" placeholder="Địa chỉ email..." value="{{ old('email') }}">
                                <span class="text-danger">@error('email'){{ $message }} @enderror</span>
                            </div>
                            <div class="col-md-6 mb-20">
                                <label>Password <span class="text-danger">*</span></label>
                                <input class="mb-0" type="password" class="form-control" name="password" placeholder="Nhập mật khẩu..." value="">
                                <span class="text-danger">@error('password'){{ $message }} @enderror</span>
                            </div>
                            <div class="col-md-6 mb-20">
                                <label>Confirm Password <span class="text-danger">*</span></label>
                                <input class="mb-0" type="password" class="form-control" name="cpassword" placeholder="Xác nhận mật khẩu..." value="">
                                <span class="text-danger">@error('cpassword'){{ $message }} @enderror</span>
                            </div>
                            <div class="col-12">
                                <button class="register-button mt-0">Đăng ký</button>
                            </div>
                            <div class="col-md-12 mt-20">
                                <a href="{{ route('user.login') }}">Đã có tài khoản? Đăng nhập ngay</a>
                            </div>

                        </div>
                    </div>
                </form>
            </div>
            <div class="col-sm-12 col-md-12 col-xs-12 col-lg-3 mb-30"></div>
        </div>
    </div>
</div>
@endsection
