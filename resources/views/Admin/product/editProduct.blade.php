@extends('layouts.admin_layout')
@section('content')
<div class="container-fluid ">
    <div class="row">
        {{-- <div class="col-md-2"></div> --}}
        <div class="col-md-12">
            <!-- Horizontal Form -->
            <div class="card card-info">
                <div class="card-header bg-dark">
                    <h3 class="card-title">Sửa thông tin sản phẩm</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form class="form-horizontal" action="{{ url('update-product/'.$product->MaDT) }}" method="POST">
                    @method('PUT')
                    @csrf
                    <div class="card-body">
                        <div class="form-group row">
                            <label for="txtMaDT" class="col-sm-2 col-form-label">Mã điện thoại</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="txtMaDT" name="txtMaDT" value="{{ $product->MaDT }}" disabled placeholder="Mã điện thoại">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="txtTenDT" class="col-sm-2 col-form-label">Tên điện thoại</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="txtTenDT" name="txtTenDT" value="{{ $product->TenDT }}" placeholder="Tên nhà sản xuất">
                                @error('txtTenDT')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="txtGioiThieu" class="col-sm-2 col-form-label">Giới thiệu</label>
                            <div class="col-sm-10">
                                <textarea class="summernote" name="txtGioiThieu" id="summernote">
                                {{ $product->GioiThieu }}
                                </textarea>
                                @error('txtGioiThieu')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="txtThongSo" class="col-sm-2 col-form-label">Thông số kĩ thuật</label>
                            <div class="col-sm-10">
                                <textarea class="summernote" name="txtThongSo" id="summernote">
                                {{ $product->ThongSo }}
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
                                    @if($product->MaNSX == $item->MaNSX)
                                    <option value="{{ $item->MaNSX }}" selected>{{ $item->TenNSX}}</option>
                                    @else
                                    <option value="{{ $item->MaNSX }}">{{ $item->TenNSX}}</option>
                                    @endif
                                    @endforeach
                                </select>
                                @error('ddlNhaSanXuat')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="ddlLoai" class="col-sm-2 col-form-label">Loại sản phẩm</label>
                            <div class="col-sm-10">
                                <select class="form-control" name="ddlLoai" id="">
                                    @foreach ($type as $item)
                                    @if($product->MaLoai == $item->MaLoai)
                                    <option value="{{ $item->MaLoai }}" selected>{{ $item->TenLoai}}</option>
                                    @else
                                    <option value="{{ $item->MaLoai }}">{{ $item->TenLoai}}</option>
                                    @endif
                                    @endforeach
                                </select>
                                @error('ddlLoai')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="ddlBaoHanh" class="col-sm-2 col-form-label">Bảo hành</label>
                            <div class="col-sm-10">
                                <select class="form-control" name="ddlBaoHanh" id="">
                                    <option value="3 tháng">3 tháng</option>
                                    <option value="6 tháng">6 tháng</option>
                                    <option value="9 tháng">9 tháng</option>
                                    <option value="12 tháng">12 tháng</option>
                                    <option value="18 tháng">18 tháng</option>
                                    <option value="24 tháng">24 tháng</option>
                                </select>
                                @error('ddlBaoHanh')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="ddlTrangThai" class="col-sm-2 col-form-label">Trạng thái</label>
                            <div class="col-sm-10">
                                <select class="form-control" name="ddlTrangThai" id="">
                                    <option value="1" {{ $product->TrangThai ?"selected":"" }}>Available</option>
                                    <option value="0" {{ $product->TrangThai ?"":"selected" }}>Disabled</option>
                                </select>

                                @error('ddlTrangThai')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Ảnh</label>
                            <div class="col-sm-10">
                                @foreach ($product->image as $image)
                                <img src="{{ asset('public/backend/uploads/product-images/'.$image->Anh)}}" style="width: 50px; height: 50px" alt="">
                                @endforeach
                            </div>
                        </div>
                        {{-- <div class="form-group row">
                            <label for="image" class="col-sm-2 col-form-label">Ảnh</label>
                            <div class="col-sm-10">
                                <input type="file" class="form-control" name="image">
                            </div>
                        </div> --}}
                    </div>
                    <!-- /.card-body -->
                    <div class=" card-footer">
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
        , styleTags: [{
            tag: "table"
            , title: "customtable"
            , className: "table-dark"
            , value: "table"
        , }, {
            title: "(div.btn.btn-default)"
            , tag: "div"
            , value: "div"
            , className: "btn btn-primary"
        }, {
            tag: "table"
            , title: "Hightlight Cell"
            , className: "table-primary"
            , value: "table>tr"
        }]
    , });

</script>
@endsection
