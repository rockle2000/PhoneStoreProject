@extends('layouts.admin_layout')
@section('content')
<div class="container-fluid ">
    <div class="row">
        {{-- <div class="col-md-2"></div> --}}
        <div class="col-md-12">
            <!-- Horizontal Form -->
            <div class="card card-info">
                <div class="card-header bg-dark">
                    <h3 class="card-title">Sửa thông tin mã khuyến mãi</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form class="form-horizontal" action="{{ url('update-discount/'.$discount->MaKM) }}" method="POST">
                    @method('PUT')
                    @csrf
                    <div class="card-body">
                        <div class="form-group row">
                            <label for="txtTenKM" class="col-sm-2 col-form-label">Tên khuyến mãi</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="txtTenKM" name="txtTenKM" value="{{ $discount->TenKM }}" placeholder="Tên khuyến mãi">
                                @error('txtTenKM')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="txtNoiDung" class="col-sm-2 col-form-label">Nội dung</label>
                            <div class="col-sm-10">
                                <textarea class="form-control"  name="txtNoiDung" >{{ $discount->NoiDung }}</textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="ddlGiamGia" class="col-sm-2 col-form-label">Giảm giá</label>
                            <div class="col-sm-10">
                                <select class="form-control" name="ddlGiamGia" id="">
                                    <option value="5"  {{ $discount->GiamGia == 5  ?"selected":"" }}>5%</option>
                                    <option value="10" {{ $discount->GiamGia == 10 ?"selected":"" }}>10%</option>
                                    <option value="15" {{ $discount->GiamGia == 15 ?"selected":"" }}>15%</option>
                                    <option value="20" {{ $discount->GiamGia == 20 ?"selected":"" }}>20%</option>
                                    <option value="25" {{ $discount->GiamGia == 25 ?"selected":"" }}>25%</option>
                                    <option value="30" {{ $discount->GiamGia == 30 ?"selected":"" }}>30%</option>
                                </select>
                                @error('ddlGiamGia')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="txtNgayBatDau" class="col-sm-2 col-form-label">Ngày bắt đầu</label>
                            <div class="col-sm-10">
                                <input type="datetime-local"  class="form-control" id="txtNgayBatDau" name="txtNgayBatDau" value="{{ date('Y-m-d\TH:i', strtotime($discount->NgayBatDau));  }}" placeholder="Ngày bắt đầu">
                                @error('txtNgayBatDau')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="txtNgayKetThuc" class="col-sm-2 col-form-label">Ngày kết thúc</label>
                            <div class="col-sm-10">
                                <input type="datetime-local" class="form-control" id="txtNgayKetThuc" name="txtNgayKetThuc" value="{{ date('Y-m-d\TH:i', strtotime($discount->NgayKetThuc)); }}" placeholder="Ngày kết thúc">
                                @error('txtNgayKetThuc')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="txtSoLuong" class="col-sm-2 col-form-label">Số lượng</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="txtSoLuong" name="txtSoLuong" value="{{ $discount->SoLuong }}" placeholder="Số lượng">
                                @error('txtSoLuong')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="ddlTrangThai" class="col-sm-2 col-form-label">Trạng thái</label>
                            <div class="col-sm-10">
                                <select class="form-control" name="ddlTrangThai" id="">
                                    <option value="1" {{ $discount->TrangThai ?"selected":"" }}>Available</option>
                                    <option value="0" {{ $discount->TrangThai ?"":"selected" }}>Disabled</option>
                                </select>
                                @error('ddlTrangThai')
                                <span class="text-danger">{{ $message }}</span>
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
