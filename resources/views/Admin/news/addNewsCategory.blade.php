@extends('layouts.admin_layout')
@section('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/css/bootstrap-select.css" />
@endsection

@section('content')
<div class="container-fluid ">
    <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-8">
            <!-- Horizontal Form -->
            <div class="card card-info">
                <div class="card-header bg-dark">
                    <h3 class="card-title">Thêm mới thể loại</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form class="form-horizontal" action="{{ url('/insert-newscategory') }}" method="POST">
                    @csrf
                    <div class="card-body">
                        <div class="form-group row">
                            <label for="txtTheLoai" class="col-sm-2 col-form-label">Thể loại</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="txtTheLoai" name="txtTheLoai" value="{{ old('txtTheLoai') }}" placeholder="Tên thể loại">
                                @error('txtTheLoai')
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/js/bootstrap-select.min.js"></script>

<script type="text/javascript">
    $('.summernote').summernote({
        disableGrammar: true
    });
</script>
@endsection
