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
                <div class="card-header bg-dark">
                    <h3 class="card-title">Chỉnh sửa tin tức</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form class="form-horizontal" action="{{ url('update-news/'.$news->MaTinTuc) }}" method="POST" >
                    @method('PUT')
                    @csrf
                    <div class="card-body">
                        <div class="form-group row">
                            <label for="txtTieuDe" class="col-sm-2 col-form-label">Tiêu đề</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="txtTieuDe" name="txtTieuDe" value="{{ $news->TieuDe }}" placeholder="Tiêu đề">
                                @error('txtTieuDe')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        {{-- <div class="form-group row">
                            <label for="image" class="col-sm-2 col-form-label">Thumbnail</label>
                            <div class="col-sm-10">
                                <input type="file" multiple class="form-control" name="image">
                                @error('image')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div> --}}
                        <div class="form-group row">
                            <label for="txtTacGia" class="col-sm-2 col-form-label">Tác giả</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="txtTacGia" name="txtTacGia" value="{{ $news->TacGia }}" placeholder=" Tên tác giả">
                                @error('txtTacGia')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="txtNoiDung" class="col-sm-2 col-form-label">Nội dung</label>
                            <div class="col-sm-10">
                                <textarea class="summernote" name="txtNoiDung" id="summernote">
                                {!! $news->NoiDung !!}
                                </textarea>
                                @error('txtNoiDung')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="txtNoiDung" class="col-sm-2 col-form-label">Danh mục</label>
                            <div class="col-sm-10">
                            <select class="selectpicker form-control dropdown-primary " multiple data-live-search="true" title="Chọn danh mục cho bài viết">
                                @foreach ($news->news_newscategory as $item)
                                    <option value="{{ $item->newscategory->MaTheLoai }}" selected>{{ $item->newscategory->TheLoai}}</option>
                                @endforeach
                            </select>   
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="ddlTrangThai" class="col-sm-2 col-form-label">Trạng thái</label>
                            <div class="col-sm-10">
                                <select class="form-control" name="ddlTrangThai" id="">
                                    <option value="1" {{ $news->TrangThai ?"selected":"" }}>Available</option>
                                    <option value="0" {{ $news->TrangThai ?"":"selected" }}>Disabled</option>
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
