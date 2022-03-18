@section('css')
<link rel="stylesheet" href="{{asset('public/backend/Admin/Layout/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
<link rel="stylesheet" href="{{asset('public/backend/Admin/Layout/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
<link rel="stylesheet" href="{{asset('public/backend/Admin/Layout/plugins/datatables-buttons/css/buttons.bootstrap4.min.css')}}">
@endsection

<!-- Main content -->
@extends('layouts.admin_layout')
@section('content')
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header bg-primary">
                        <h3 class="card-title">Danh sách mã khuyến mãi</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Mã KM</th>
                                    <th>Tên KM</th>
                                    <th>Nội dung</th>
                                    <th>Giảm giá</th>
                                    <th>Ngày bắt đầu</th>
                                    <th>Ngày kết thúc</th>
                                    <th>Số lượng</th>
                                    <th>Trạng thái</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($discount as $item)
                                <tr>
                                    <td>{{ $item->MaKM}}</td>
                                    <td>{{ $item->TenKM}}</td>
                                    <td>{{ $item->NoiDung}}</td>
                                    <td>{{ $item->GiamGia }}%</td>
                                    <td>{{ date('d-m-Y H:i:s', strtotime($item->NgayBatDau));}}</td>
                                    <td>{{ date('d-m-Y H:i:s', strtotime($item->NgayKetThuc));}}</td>
                                    <td>{{ $item->SoLuong }}</td>
                                    <td>
                                        @if ($item->TrangThai)
                                        <button class="btn btn-success disabled">
                                            <i class="fas fa-check-circle"></i>
                                            Available
                                        </button>
                                        @elseif (!$item->TrangThai)
                                        <button class="btn btn-danger disabled">
                                            <i class="far fa-times-circle"></i>
                                            Disabled
                                        </button>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ url('edit-discount/'.$item->MaKM) }}" class="btn btn-primary"><i class="fas fa-edit"></i> Edit</a>
                                        <span>
                                            @if ($item->TrangThai)
                                            <a href="" onclick="return ConfirmDelete('{{ $item->MaKM }}',this)" class="btn btn-danger"><i class="fas fa-trash-alt"></i> Delete</a>
                                            @elseif(!$item->TrangThai)
                                            <a href="#" onclick="return ConfirmActive('{{ $item->MaKM }}',this)" class="btn btn-success"><i class="fas fa-plus"></i> Active</a>
                                            @endif
                                        </span>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                            </tfoot>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</section>

<!-- /.content -->
@endsection

@section('js')
<!-- Page specific script -->
<script src=" {{asset('public/backend/Admin/Layout/plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('public/backend/Admin/Layout/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{asset('public/backend/Admin/Layout/plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
<script src="{{asset('public/backend/Admin/Layout/plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>
<script src="{{asset('public/backend/Admin/Layout/plugins/datatables-buttons/js/dataTables.buttons.min.js')}}"></script>
<script src="{{asset('public/backend/Admin/Layout/plugins/datatables-buttons/js/buttons.bootstrap4.min.js')}}"></script>
<script src="{{asset('public/backend/Admin/Layout/plugins/jszip/jszip.min.js')}}"></script>
<script src="{{asset('public/backend/Admin/Layout/plugins/pdfmake/pdfmake.min.js')}}"></script>
<script src="{{asset('public/backend/Admin/Layout/plugins/pdfmake/vfs_fonts.js')}}"></script>
<script src="{{asset('public/backend/Admin/Layout/plugins/datatables-buttons/js/buttons.html5.min.js')}}"></script>
<script src="{{asset('public/backend/Admin/Layout/plugins/datatables-buttons/js/buttons.print.min.js')}}"></script>
<script src="{{asset('public/backend/Admin/Layout/plugins/datatables-buttons/js/buttons.colVis.min.js')}}"></script>
<script type="text/javascript">
    $(function() {
        $("#example1").DataTable({
            "columnDefs": [{
                "width": "5%"
                , "targets": [3,6]
            }, {
                "width": "10%"
                , "targets": [0,4,5,7]
            }, {
                "width": "15%"
                , "targets": [1,8]
            },{
                "width": "20%"
                , "targets": 2
            }]
            , "responsive": true
            // , "lengthChange": false
            , "pageLength": 6
        });
    });
    @if(session('status'))
    // toastr.options.timeOut = 3000;
    toastr.options = {
        "timeOut": 3000 // 3s
        , "progressBar": true
    }
    toastr.success("{{ session('status') }}");
    @endif

    @if(session('error'))
    // toastr.options.timeOut = 3000;
    toastr.options = {
        "timeOut": 3000 // 3s
        , "progressBar": true
    }
    toastr.error("{{ session('error') }}");
    @endif

    function ConfirmActive(id, ctl) {
        Swal.fire({
            title: 'Bạn chắc chắn muốn kích hoạt lại mã giảm giá này?'
            , text: "Mã giảm giá này sẽ xuất hiện lại trên trang chủ"
            , icon: 'info'
            , showCancelButton: true
            , confirmButtonColor: '#3085d6'
            , cancelButtonColor: '#d33'
            , cancelButtonText: 'Đóng'
            , confirmButtonText: 'Xác nhận'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: 'PUT'
                    , headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('value')
                    }
                    , url: '/PhoneStore/active-discount/' + id
                    , success: function(result) {
                        if (result.status == 'success') {
                            var disabled = '<button class="btn btn-success disabled"><i class="fas fa-check-circle"></i> Available</button>';
                            $(ctl).parent().parent().parent().children('td:nth-child(8)').html(disabled);
                            var button = ' <a href="#" onclick="return ConfirmDelete(\'' + id + '\',this)" class="btn btn-danger"><i class="fas fa-trash-alt"></i> Delete</a>';
                            $(ctl).parent().parent().parent().children('td:nth-child(9)').children('span').html(button);
                            ShowAlert('Active!', result.message, 'success');
                        } else if (result.status == 'disabled') {

                            ShowAlert('Already Active', result.message, 'info');
                        } else {
                            ShowAlert('Error...', result.message, 'error');
                        }
                    }
                }).fail(function(data) {
                    ShowAlert('Oops...', 'Something went wrong!', 'error');
                });
            }
        })
        return false;
    }

    function ConfirmDelete(id, ctl) {
        //Disable sản phẩm
        Swal.fire({
            title: 'Bạn chắc chắn muốn vô hiệu mã giảm giá này?'
            , text: "Mã giảm giá này sẽ bị ẩn khỏi trang chủ"
            , icon: 'warning'
            , showCancelButton: true
            , confirmButtonColor: '#3085d6'
            , cancelButtonColor: '#d33'
            , cancelButtonText: 'Đóng'
            , confirmButtonText: 'Xác nhận'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: 'PUT'
                    , headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('value')
                    }
                    , url: '/PhoneStore/delete-discount/' + id
                    , success: function(result) {
                        if (result.status == 'success') {
                            var disabled = '<button class="btn btn-danger disabled"><i class="far fa-times-circle"></i> Disabled</button>';
                            $(ctl).parent().parent().parent().children('td:nth-child(8)').html(disabled);
                            var button = ' <a href="#" onclick="return ConfirmActive(\'' + id + '\',this)" class="btn btn-success"><i class="fas fa-plus"></i> Active</a>';
                            $(ctl).parent().parent().parent().children('td:nth-child(9)').children('span').html(button);
                            ShowAlert('Deleted!', result.message, 'success');
                        } else if (result.status == 'disabled') {

                            ShowAlert('Already Disabled', result.message, 'info');
                        } else {
                            ShowAlert('Error...', result.message, 'error');
                        }
                    }
                }).fail(function(data) {
                    ShowAlert('Oops...', 'Something went wrong!', 'error');
                });
            }
        })
        return false;
    }

    function ShowAlert(title, text, icon) {
        Swal.fire({
            title: title
            , text: text
            , icon: icon
        });
    }

</script>

@endsection
