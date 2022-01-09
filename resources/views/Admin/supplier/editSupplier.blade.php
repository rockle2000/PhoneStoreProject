@extends('layouts.admin_layout')
@section('content')
<div class="container-fluid ">
    <div class="row mt-2">
        <div class="col-md-2"></div>
        <div class="col-md-8">
            <!-- Horizontal Form -->
            <div class="card card-info">
                <div class="card-header">
                    <h3 class="card-title">Sửa thông tin nhà sản xuất</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form class="form-horizontal" action="{{ url('update-supplier/'.$supplier->MaNSX) }}" method="POST">
                    {{ method_field('PUT') }}
                    @csrf
                    <div class="card-body">
                        <div class="form-group row">
                            <label for="txtMaNSX" class="col-sm-2 col-form-label">Mã nhà sản xuất</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="txtMaNSX" name="txtMaNSX" value="{{ $supplier->MaNSX }}" disabled placeholder="Mã nhà sản xuất">
                                @error('txtMaNSX')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="txtTenNSX" class="col-sm-2 col-form-label">Tên nhà sản xuất</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="txtTenNSX" name="txtTenNSX" value="{{ $supplier->TenNSX }}" placeholder="Tên nhà sản xuất">
                                @error('txtTenNSX')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="txtDiaChi" class="col-sm-2 col-form-label">Địa chỉ</label>
                            <div class="col-sm-10">
                                <textarea class="form-control" name="txtDiaChi" cols="40" rows="5">{{ $supplier->DiaChi }}</textarea>
                                @error('txtDiaChi')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="txtSDT" class="col-sm-2 col-form-label">Số điện thoại</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="txtSDT" name="txtSDT" value="{{ $supplier->SoDienThoai }}" placeholder="Số điện thoại">
                                @error('txtSDT')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="txtEmail" class="col-sm-2 col-form-label">Email</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="txtEmail" name="txtEmail" value="{{ $supplier->Email }}" placeholder="Email">
                                @error('txtEmail')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="ddlTrangThai" class="col-sm-2 col-form-label">Trạng thái</label>
                            <div class="col-sm-10">
                                <select class="form-control" name="ddlTrangThai" id="">
                                    <option value="1" {{ $supplier->TrangThai ?"selected":"" }}>Available</option>
                                    <option value="0" {{ $supplier->TrangThai ?"":"selected" }}>Disabled</option>
                                </select>
                                @error('ddlTrangThai')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer">
                        <button type="submit" class="btn btn-success">Sửa</button>
                        <a class="btn btn-danger float-right" href="{{ url('/supplier-list') }}">Quay lại</a>
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
