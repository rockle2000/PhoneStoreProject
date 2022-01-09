@extends('layouts.admin_layout')
@section('content')
<div class="d-sm-flex align-items-center justify-content-end mb-4">
    <a href="{{route('customers.index')}}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
            class="fas fa-arrow-left fa-sm text-white-50"></i> Back</a>
</div>
<div class="container-fluid ">
    <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-8">
            <!-- general form elements -->
            @if (count($errors) > 0)
            <ul id="error_message" style="display:none">
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
            @endif
            <div class="card card-info">
                <div class="card-header">
                    <h3 class="card-title">Sửa thông tin người dùng</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form class="form-horizontal" action="{{route('customers.update',['customer' => $customer->id])}}"
                    method="POST">
                    @csrf
                    @method('PUT')
                    <div class="card-body">
                        <div class=" form-group row">
                            <label for="txtTenNSX" class="col-sm-2 col-form-label">Email</label>
                            <div class="col-sm-10">
                                <input type="text" disabled readonly
                                    class="form-control form-control-user"
                                    id="exampleEmail" placeholder="Email" name="email"
                                    value="{{ old('email') ? old('email') : $customer->email}}">

                                @error('email')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="txtMaNSX" class="col-sm-2 col-form-label">Tên người dùng</label>
                            <div class="col-sm-10">
                                <input type="text"
                                    class="form-control form-control-user @error('name') is-invalid @enderror"
                                    id="exampleName" placeholder="Full Name" name="name"
                                    value="{{ old('name') ? old('name') : $customer->name}}">

                                @error('name')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="txtSDT" class="col-sm-2 col-form-label">Số điện thoại</label>
                            <div class="col-sm-10">
                                <input type="text"
                                    class="form-control form-control-user @error('phone') is-invalid @enderror"
                                    id="examplePhone" placeholder="Phone" name="phone"
                                    value="{{ old('phone') ? old('phone') : $customer->phone}}">
                                @error('phone')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer">
                        <button type="submit" class="btn btn-success">Lưu</button>
                    </div>
                    <!-- /.card-footer -->
                </form>
            </div>
            <!-- /.card -->
            <div class="col-md-2"></div>
        </div>
        <!--/.col (left) -->
    </div>
</div>
@endsection
@section('js')
<script type="text/javascript">
    @if(count($errors) > 0)
    toastr.options = {
        "timeOut": 3000
        , "preventDuplicates": true
        , "closeButton": true
    , }
    toastr.error($('#error_message').html());
    @endif

    $('.summernote').summernote({
        disableGrammar: true
    });

</script>
@endsection
