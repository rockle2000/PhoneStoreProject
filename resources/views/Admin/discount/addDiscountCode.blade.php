@extends('layouts.admin_layout')
@section('content')
<div class="container-fluid ">
    <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-8">
            <!-- Horizontal Form -->
            <div class="card card-info">
                <div class="card-header bg-dark">
                    <h3 class="card-title">Thêm mã khuyến mãi mới</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form class="form-horizontal" action="{{ url('/insert-discount') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                        <div class="form-group row">
                            <label for="txtMaKM" class="col-sm-2 col-form-label">Mã khuyến mãi</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="txtMaKM" name="txtMaKM" value="{{ old('txtMaKM') }}" placeholder="Mã khuyến mãi">
                                @error('txtMaKM')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="txtTenKM" class="col-sm-2 col-form-label">Tên khuyến mãi</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="txtTenKM" name="txtTenKM" value="{{ old('txtTenKM') }}" placeholder="Tên khuyến mãi">
                                @error('txtTenKM')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="txtNoiDung" class="col-sm-2 col-form-label">Nội dung</label>
                            <div class="col-sm-10">
                                <textarea class="form-control"  name="txtNoiDung" >
                                {{ old('txtNoiDung') }}
                                </textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="ddlGiamGia" class="col-sm-2 col-form-label">Giảm giá</label>
                            <div class="col-sm-10">
                                <select class="form-control" name="ddlGiamGia" id="">
                                    <option value="5">5%</option>
                                    <option value="10">10%</option>
                                    <option value="15">15%</option>
                                    <option value="20">20%</option>
                                    <option value="25">25%</option>
                                    <option value="30">30%</option>
                                </select>
                                @error('ddlGiamGia')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="txtNgayBatDau" class="col-sm-2 col-form-label">Ngày bắt đầu</label>
                            <div class="col-sm-10">
                                <input type="datetime-local" class="form-control" id="txtNgayBatDau" name="txtNgayBatDau" value="{{ old('txtNgayBatDau') }}" placeholder="Ngày bắt đầu">
                                @error('txtNgayBatDau')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="txtNgayKetThuc" class="col-sm-2 col-form-label">Ngày kết thúc</label>
                            <div class="col-sm-10">
                                <input type="datetime-local" class="form-control" id="txtNgayKetThuc" name="txtNgayKetThuc" value="{{ old('txtNgayKetThuc') }}" placeholder="Ngày kết thúc">
                                @error('txtNgayKetThuc')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="txtSoLuong" class="col-sm-2 col-form-label">Số lượng</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="txtSoLuong" name="txtSoLuong" value="{{ old('txtSoLuong') }}" placeholder="Số lượng">
                                @error('txtSoLuong')
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

    $('.summernote').summernote({
        disableGrammar: true
    });

</script>
@endsection
