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
                        <h3 class="card-title">Danh sách sản phẩm</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Mã ĐT</th>
                                    <th>Tên ĐT</th>
                                    <th>Nhà sản xuất</th>
                                    <th>Ảnh</th>
                                    <th>Trạng thái</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($product as $item)
                                <tr>
                                    <td>{{ $item-> MaDT}}</td>
                                    <td>{{ $item-> TenDT}}</td>
                                    <td>{{ $item->supplier->TenNSX}}</td>
                                    <td>
                                        @foreach ($item->image->take(2) as $image)
                                        <img src="{{ asset('public/backend/uploads/product-images/'.$image->Anh)}}" style="width: 50px; height: 50px" alt="">
                                        @endforeach
                                    </td>
                                    <td>
                                        @if ($item-> TrangThai)
                                        <button class="btn btn-success disabled">
                                            <i class="fas fa-check-circle"></i>
                                            Available
                                        </button>
                                        @elseif (!$item->TrangThai)
                                        <button class="btn btn-danger btn-block disabled">
                                            <i class="far fa-times-circle"></i>
                                            Disabled
                                        </button>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ url('edit-product/'.$item->MaDT) }}" class="btn btn-primary"><i class="fas fa-edit"></i> Edit</a>
                                        <span>
                                            @if ($item-> TrangThai)
                                            <a href="#" onclick="return ConfirmDelete('{{ $item->MaDT }}',this)" class="btn btn-danger"><i class="fas fa-trash-alt"></i> Delete</a>
                                            @elseif(!$item-> TrangThai)
                                            <a href="#" onclick="return ConfirmActive('{{ $item->MaDT }}',this)" class="btn btn-success"><i class="fas fa-plus"></i> Active</a>
                                            @endif
                                        </span>
                                        <a href="{{ url('product-quantity/'.$item->MaDT)}}" class="btn btn-secondary"><i class="fas fa-warehouse"></i></i> Storage</a>
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
                "width": "10%"
                , "targets": [0, 2, 4]
            }, {
                "width": "20%"
                , "targets": 1
            }, {
                "width": "25%"
                , "targets": 3
            }, {
                "width": "25%"
                , "targets": 5
                , "className": "text-center"
            }]
            , "responsive": true
            // , "lengthChange": false
            , "pageLength": 6
            , "buttons": ["copy", "csv", "excel", "pdf", "print"]
        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    });
    // alert('ok');
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
            title: 'Bạn chắc chắn muốn active sản phẩm này?'
            , text: "Sản phẩm này sẽ xuất hiện lại trên trang chủ"
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
                    , url: '/Group8_PhoneStore/active-product/' + id
                    , success: function(result) {
                        if (result.status == 'success') {
                            var disabled = '<button class="btn btn-success disabled"><i class="fas fa-check-circle"></i> Available</button>';
                            $(ctl).parent().parent().parent().children('td:nth-child(5)').html(disabled);
                            var button = ' <a href="#" onclick="return ConfirmDelete(\'' + id + '\',this)" class="btn btn-danger"><i class="fas fa-trash-alt"></i> Delete</a>';
                            $(ctl).parent().parent().parent().children('td:nth-child(6)').children('span').html(button);
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
            title: 'Bạn chắc chắn muốn ẩn sản phẩm này?'
            , text: "Sản phẩm này sẽ bị ẩn khỏi trang chủ"
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
                    , url: '/Group8_PhoneStore/delete-product/' + id
                    , success: function(result) {
                        if (result.status == 'success') {
                            var disabled = '<button class="btn btn-danger disabled"><i class="far fa-times-circle"></i> Disabled</button>';
                            $(ctl).parent().parent().parent().children('td:nth-child(5)').html(disabled);
                            var button = ' <a href="#" onclick="return ConfirmActive(\'' + id + '\',this)" class="btn btn-success"><i class="fas fa-plus"></i> Active</a>';
                            $(ctl).parent().parent().parent().children('td:nth-child(6)').children('span').html(button);
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
