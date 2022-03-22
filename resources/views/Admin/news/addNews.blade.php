@extends('layouts.admin_layout')
@section('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/css/bootstrap-select.css" />
@endsection

@section('content')
<div class="container-fluid ">
    <div class="row">
        {{-- <div class="col-md-2"></div> --}}
        <div class="col-md-12">
            <!-- Horizontal Form -->
            <div class="card card-info">
                <div class="card-header">
                    <h3 class="card-title">Thêm mới tin tức</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form class="form-horizontal" action="{{ url('/insert-news') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                        <div class="form-group row">
                            <label for="txtTieuDe" class="col-sm-2 col-form-label">Tiêu đề</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="txtTieuDe" name="txtTieuDe" value="{{ old('txtTieuDe') }}" placeholder="Tiêu đề">
                                @error('txtTieuDe')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="image" class="col-sm-2 col-form-label">Thumbnail</label>
                            <div class="col-sm-10">
                                <input type="file" multiple class="form-control" name="image">
                                @error('image')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="txtTacGia" class="col-sm-2 col-form-label">Tác giả</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="txtTacGia" name="txtTacGia" value="{{ old('txtTacGia') }}" placeholder=" Tên tác giả">
                                @error('txtTacGia')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="txtNoiDung" class="col-sm-2 col-form-label">Nội dung</label>
                            <div class="col-sm-10">
                                <textarea class="summernote" name="txtNoiDung" id="summernote">
                                {{ old('txtNoiDung') }}
                                </textarea>
                                @error('txtNoiDung')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="txtNoiDung" class="col-sm-2 col-form-label">Danh mục</label>
                            <div class="col-sm-10">
                            <select name="ddlDanhMuc[]" class="selectpicker form-control dropdown-primary " multiple data-live-search="true" title="Chọn danh mục cho bài viết">
                                @foreach ($newscategories as $cate)
                                    <option value="{{ $cate->MaTheLoai }}">{{ $cate->TheLoai }}</option>
                                @endforeach
                            </select>
                            </div>
                            {{-- <label class="mdb-main-label">Label example</label> --}}
                            {{-- <button class="btn-save btn btn-primary btn-sm">Save</button> --}}
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
                        <a href="#" id="test">Test</a>
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/js/bootstrap-select.min.js"></script>

<script type="text/javascript">
    $('.summernote').summernote({
        disableGrammar: true
    });

    $(document).ready(function() {

        $('#test').click(function(){
            console.log($('.selectpicker').val());
        })
    });

</script>
@endsection
