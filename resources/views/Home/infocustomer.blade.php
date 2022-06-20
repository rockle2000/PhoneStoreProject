@extends('layouts.home_layout')
@section('content')
<div class="container rounded bg-white mt-50 mb-50">
    <div class="row mb-5">
        <div class="col-md-2"></div>
        <div class="col-md-4 border">
            <div class="d-flex flex-column align-items-center text-center p-3 py-5">
                <img class="" src="{{asset('public/frontend/images/about-us/user.png')}}" width="90">
                <span class="font-weight-bold">{{$customer->name}}</span>
                <span class="text-black-50">{{$customer->email}}</span>
                {{-- <span>{{$customer->phone}}</span> --}}
            </div>
        </div>

        <div class="col-md-4 border">
            <div class="p-3">
                <div class="mb-3">
                    <div class="align-items-center back">
                        <h5 class="text-center">Thông tin cá nhân</h5>
                    </div>
                </div>
                <form method="POST" action="{{route('user.updateinfo',['id' => $customer->id])}}">
                    @csrf
                    @method('PUT')
                    <div class="row mt-2">
                        <div class="col-md-12"> 
                            <h6>Họ tên</h6>
                            <input type="text" class="form-control form-control-user @error('name') is-invalid @enderror" id="exampleName" placeholder="Họ tên" name="name" value="{{ old('name') ? old('name') : $customer-> name}}">
                            @error('name')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-12"> 
                            <h6>Số điện thoại</h6>
                            <input type="text" class="form-control form-control-user @error('phone') is-invalid @enderror" id="examplePhone" placeholder="Số điện thoại" name="phone" value="{{ old('phone') ? old('phone') : $customer-> phone}}"></div>
                            @error('phone')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="row">
                        <input type="hidden" name="hiddeninput" value="checkreturn">
                        <div class="col-md-1"></div>
                        <div class="col-md-5 mb-15">
                            <button class="btn btn-success profile-button" type="submit">Lưu thông tin</button>
                        </div>
                        
                        <div class="col-md-5 mb-15">
                            <a class="btn btn-secondary text-white" href="{{route('user.changepass',['id' => $customer -> id])}}">Đổi mật khẩu</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
