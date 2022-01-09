@extends('layouts.admin_layout')
@section('content')
<div class="container-fluid ">
    <div class="row">
        {{-- <div class="col-md-2"></div> --}}
        <div class="col-md-12">
            <!-- Horizontal Form -->
            <div class="card card-info">
                <div class="card-header">
                    <h3 class="card-title">Thêm mới sản phẩm</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form class="form-horizontal" action="{{ url('/insert-product') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                        <div class="form-group row">
                            <label for="txtMaDT" class="col-sm-2 col-form-label">Mã điện thoại</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="txtMaDT" name="txtMaDT" value="{{ old('txtMaDT') }}" placeholder=" Mã sản phẩm">
                                @error('txtMaDT')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="txtTenDT" class="col-sm-2 col-form-label">Tên điện thoại</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="txtTenDT" name="txtTenDT" value="{{ old('txtTenDT') }}" placeholder=" Tên điện thoại">
                                @error('txtTenDT')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="txtGioiThieu" class="col-sm-2 col-form-label">Giới thiệu</label>
                            <div class="col-sm-10">
                                <textarea class="summernote" name="txtGioiThieu" id="summernote">
                                {{ old('txtGioiThieu') }}
                                </textarea>
                                @error('txtGioiThieu')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="txtThongSo" class="col-sm-2 col-form-label">Thông số</label>
                            <div class="col-sm-10">
                                <textarea class="summernote" name="txtThongSo" id="summernote">
                                {{ old('txtThongSo') }}
                                </textarea>
                                @error('txtThongSo')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="ddlTrangThai" class="col-sm-2 col-form-label">Nhà sản xuất</label>
                            <div class="col-sm-10">
                                <select class="form-control" name="ddlNhaSanXuat" id="">
                                    @foreach ($supplier as $item)
                                    <option value="{{ $item->MaNSX }}">{{ $item->TenNSX}}</option>
                                    @endforeach
                                </select>
                                @error('ddlNhaSanXuat')
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
                        <div class="form-group row">
                            <label for="image" class="col-sm-2 col-form-label">Ảnh</label>
                            <div class="col-sm-10">
                                <input type="file" multiple class="form-control" name="image[]">
                                @error('image')
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
            {{-- <div class="col-md-2"></div> --}}
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
