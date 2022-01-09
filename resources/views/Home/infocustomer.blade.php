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
            <div class="d-flex flex-column align-items-center text-center p-3 py-5"><img class="rounded-circle mt-5" src="https://picsum.photos/200/200" width="90"><span class="font-weight-bold">{{$customer ->
                    name}}</span><span class="text-black-50">{{$customer -> email}}</span><span>{{$customer->
                    phone}}</span></div>
        </div>

        <div class="col-md-4 border">
            <div class="p-3 py-5">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <div class="d-flex flex-row align-items-center back"><i class="fa fa-long-arrow-left mr-1 mb-1"></i>
                        <h6> <a href="{{route('main-page')}}">Quay lại</a></h6>
                    </div>
                    <h6 class="text-right">Thông tin tài khoản</h6>
                </div>
                <form method="POST" action="{{route('customers.update',['customer' => $customer->id])}}">
                    @csrf
                    @method('PUT')
                    <div class="row mt-2">
                        <div class="col-md-12"> <input type="text" class="form-control form-control-user @error('name') is-invalid @enderror" id="exampleName" placeholder="Họ tên" name="name" value="{{ old('name') ? old('name') : $customer-> name}}">

                            @error('name')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-12"> <input type="text" class="form-control form-control-user @error('phone') is-invalid @enderror" id="examplePhone" placeholder="Số điện thoại" name="phone" value="{{ old('phone') ? old('phone') : $customer-> phone}}"></div>
                        @error('phone')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                    {{-- <div class="row mt-3">
                        <div class="col-md-12"><input type="text"
                                class="form-control form-control-user @error('email') is-invalid @enderror"
                                id="exampleEmail" placeholder="Email" name="email"
                                value="{{ old('email') ? old('email') : $customer-> email}}">
                    @error('email')
                    <span class="text-danger">{{$message}}</span>
                    @enderror
            </div>
        </div> --}}
        <div class="row mt-3">
            <input type="hidden" name="hiddeninput" value="checkreturn">
            <div class="col-md-3">
                <div class="mt-5 text-right"><button class="btn btn-primary profile-button" type="submit">Lưu thông tin</button></div>
            </div>
            <div class="col-md-2"></div>
            <div class="col-md-3">
                <div class="mt-5"><a class="btn btn-secondary text-white" href="{{route('user.changepass',['id' => $customer -> id])}}">Đổi mật khẩu</a>
                </div>
            </div>
        </div>
        </form>
    </div>
</div>
</div>
</div>
@endsection
