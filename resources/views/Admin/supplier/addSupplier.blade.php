@extends('layouts.admin_layout')
@section('content')
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
                    <h3 class="card-title">Thêm mới nhà sản xuất</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form class="form-horizontal" action="{{ url('/insert-supplier') }}" method="POST">
                    @csrf
                    <div class="card-body">
                        <div class="form-group row">
                            {{-- <label for="inputEmail3" class="col-sm-2 col-form-label">Email</label>
                            <div class="col-sm-10">
                                <input type="email" class="form-control" id="inputEmail3" placeholder="Email">
                            </div> --}}
                            <label for="txtMaNSX" class="col-sm-2 col-form-label">Mã nhà sản xuất</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="txtMaNSX" name="txtMaNSX" placeholder="Mã nhà sản xuất" value="{{ old('txtMaNSX') }}">
                                @error('txtMaNSX')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class=" form-group row">
                            <label for="txtTenNSX" class="col-sm-2 col-form-label">Tên nhà sản xuất</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="txtTenNSX" name="txtTenNSX" placeholder="Tên nhà sản xuất" value="{{ old('txtTenNSX') }}">
                                @error('txtTenNSX')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="txtDiaChi" class="col-sm-2 col-form-label">Địa chỉ</label>
                            <div class="col-sm-10">
                                {{-- <input type="text" class="form-control" id="txtDiaChi" placeholder="Địa chỉ"> --}}
                                <textarea class="form-control" name="txtDiaChi" cols="40" rows="5">{{ old('txtDiaChi') }}</textarea>
                                @error('txtDiaChi')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="txtSDT" class="col-sm-2 col-form-label">Số điện thoại</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="txtSDT" name="txtSDT" placeholder="Số điện thoại" value="{{ old('txtSDT') }}">
                                @error('txtSDT')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="txtEmail" class="col-sm-2 col-form-label">Email</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="txtEmail" name="txtEmail" placeholder="Email" value="{{ old('txtEmail') }}">
                                @error('txtEmail')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="ddlTrangThai" class="col-sm-2 col-form-label">Trạng thái</label>
                            <div class="col-sm-10">
                                <select class="form-control" name="ddlTrangThai" id="">
                                    <option value="1">Available</option>
                                    <option value="0">Disabled</option>
                                </select>
                                @error('ddlTrangThai')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer">
                        <button type="submit" class="btn btn-success">Thêm mới</button>
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
    // @if(count($errors) > 0)
    // toastr.options = {
    //     "timeOut": 5000
    //         // , "progressBar": true
    //     , "preventDuplicates": true
    //     , "closeButton": true
    // , }
    // toastr.error($('#error_message').html());
    // @endif

</script>
@endsection
