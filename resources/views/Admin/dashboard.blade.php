@extends('layouts.admin_layout')
@section('css')
<link rel="stylesheet" href="{{asset('public/backend/Admin/Layout/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
<link rel="stylesheet" href="{{asset('public/backend/Admin/Layout/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
<link rel="stylesheet" href="{{asset('public/backend/Admin/Layout/plugins/datatables-buttons/css/buttons.bootstrap4.min.css')}}">
@endsection
<!-- Content Header (Page header) -->
@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            {{-- <div class="col-sm-6">
                <h1 class="m-0">Dashboard</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="">Home</a></li>
                    <li class="breadcrumb-item active">Dashboard v1</li>
                </ol>
            </div> --}}
            <!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->
<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-primary">
                    <div class="inner">
                        <h3>{{ $order_count }}</h3>
                        <p>Hóa đơn mới</p>
                    </div>
                    <div class="icon">
                        {{-- <i class="ion ion-bag"></i> --}}
                        <i class="fas fa-receipt"></i>
                    </div>
                    <a href="#" class="small-box-footer">Chi tiết <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-success">
                    <div class="inner">
                        <h3>2<sup style="font-size: 20px"></sup></h3>
                        <p>Thống kê</p>
                    </div>
                    <div class="icon">
                        {{-- <i class="ion ion-stats-bars"></i> --}}
                        <i class="fas fa-chart-pie"></i>
                    </div>
                    <a href="{{ url('chart') }}" class="small-box-footer">Chi tiết <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-info">
                    <div class="inner">
                        <h3>{{ $customer_count }}</h3>
                        <p>Người dùng</p>
                    </div>
                    <div class="icon">
                        {{-- <i class="ion ion-person-add"></i> --}}
                        <i class="fas fa-user"></i>
                    </div>
                    <a href="{{ url('customers') }}" class="small-box-footer">Chi tiết <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-danger">
                    <div class="inner">
                        <h3>{{ $product_count }}</h3>
                        <p>Sản phẩm</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-box-open"></i>
                    </div>
                    <a href="{{ url('product-list') }}" class="small-box-footer">Chi tiết <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
        </div>
        <!-- /.row -->
        <!-- Main row -->
        <div class="row">
            <!-- Left col -->

            <!-- /.Left col -->
            <!-- right col (We are only adding the ID to make the widgets sortable)-->

            <!-- right col -->
            <div class="col-12">
                <div class="card">
                    <div class="card-header bg-dark">
                        <h3 class="card-title">Danh sách hóa đơn</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Họ tên</th>
                                    <th>Ngày đặt</th>
                                    <th>Địa chỉ</th>
                                    <th>Số điện thoại</th>
                                    <th>Ghi chú</th>
                                    <th>Trạng thái</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($order as $item)
                                <tr>
                                    <td>{{ $item->SoHDB}}</td>
                                    <td>{{ $item->customer->name}}</td>
                                    <td>{{ date('d-m-Y H:i:s', strtotime($item->NgayDatHang));}}</td>
                                    <td>{{ $item->DiaChi}}</td>
                                    <td>{{ $item->SoDienThoai}}</td>
                                    <td>{{ $item->GhiChu}}</td>
                                    <td>
                                        @if ($item->TrangThai == 1)
                                        <button class="btn btn-success  disabled">
                                            <i class="fas fa-check-circle"></i>
                                            Finished
                                        </button>
                                        @elseif ($item->TrangThai==-1)
                                        <button class="btn btn-danger disabled">
                                            <i class="far fa-times-circle"></i>
                                            Canceled
                                        </button>
                                        @elseif ($item->TrangThai==0)
                                        <button class="btn btn-warning disabled">
                                            <i class="far fa-times-circle text-dark"></i>
                                            <span class="text-dark">Pending</span>
                                        </button>
                                        @endif
                                    </td>
                                    <td>
                                        {{-- Finished --}}
                                        @if ($item->TrangThai == 0)
                                        <a href="" onclick="return ConfirmFinish('{{ $item->SoHDB }}',this)" class="btn btn-success"><i class="fas fa-check"></i> </a>
                                        <a href="" onclick="return OrderDetail('{{ $item->SoHDB }}',this)" role="button" data-toggle="modal" data-target="#modal-xl" class="btn btn-primary"><i class="fas fa-info"></i></a>
                                        <a href="" onclick="return ConfirmCancel(' {{ $item->SoHDB }}',this)" class="btn btn-danger"><i class="fas fa-trash-alt"></i> </a>
                                        @else
                                        <a href="" onclick="return OrderDetail('{{ $item->SoHDB }}',this)" role="button" data-toggle="modal" data-target="#modal-xl" class="btn btn-primary"><i class="fas fa-info"></i></a>
                                        @endif
                                        {{-- <a href="" onclick="return ConfirmFinish('{{ $item->SoHDB }}',this)" class="btn btn-success"><i class="fas fa-check"></i> </a>
                                        <a href="" onclick="return OrderDetail('{{ $item->SoHDB }}',this)" role="button" data-toggle="modal" data-target="#modal-xl" class="btn btn-primary"><i class="fas fa-info"></i></a>
                                        <a href="" onclick="return ConfirmCancel(' {{ $item->SoHDB }}',this)" class="btn btn-danger"><i class="fas fa-trash-alt"></i> </a> --}}
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
        </div>
        <!-- /.row (main row) -->
    </div><!-- /.container-fluid -->
</section>
<!-- /.content -->

<div class="modal fade" id="modal-xl">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Chi tiết hóa đơn <strong id="order_id"></strong></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <table class="table">
                    <thead class="thead-dark">
                        <th>Tên</th>
                        <th>Màu</th>
                        <th>Số lượng</th>
                        <th>Đơn giá</th>
                        <th>Thành tiền</th>
                    </thead>
                    <tbody>

                    </tbody>
                    <tfoot>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th>Tổng tiền hóa đơn</th>
                        <th id='total'></th>
                    </tfoot>
                </table>
            </div>
            {{-- justify-content-between --}}
            <div class="modal-footer ">
                {{-- <button type="button"  class="btn btn-primary">Save changes</button> --}}
                <button type="button" class="btn btn-danger" data-dismiss="modal">Đóng</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
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
            "order": [],
            "columnDefs": [{
                    "width": "5%"
                    , "targets": 0
                }
                , {
                    "width": "10%"
                    , "targets": 1
                }, {
                    "width": "10%"
                    , "targets": 2
                    
                }, {
                    "width": "20%"
                    , "targets": 3
                }, {
                    "width": "10%"
                    , "targets": 4
                }, {
                    "width": "15%"
                    , "targets": 5
                }, {
                    "width": "10%"
                    , "targets": 6
                }
                , {
                    "width": "20%"
                    , "targets": 7
                }
            , ]
            , "responsive": true
                // , "lengthChange": false
            , "pageLength": 6
            , "buttons": ["copy", "csv", "excel", "pdf", "print"]
        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    });

    function OrderDetail(id, ctl) {
        // console.log('id' + id);
        $('#order_id').html("#" + id);
        $('.modal-body tbody').html();
        $.ajax({
            type: 'GET'
            , headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('value')
            }
            , url: '/Group8_PhoneStore/orderdetail/' + id
            , success: function(result) {
                var res = '';
                var total = 0;
                result.forEach(item => {
                    // console.log(item.SoHDB);
                    res += '<tr><td>' + item.TenDT + '</td><td>' + item.Mau + '</td><td>'+ item.SoLuong + '</td><td>' + item.DonGiaBan.toLocaleString('en') + '₫</td><td>' + (item.DonGiaBan * item.SoLuong).toLocaleString('en') + '₫</td></tr>';
                    total += item.DonGiaBan * item.SoLuong;
                });
                $('.modal-body tbody').html(res);
                $('.modal-body tfoot #total').html(total.toLocaleString('en') + '₫');
                // console.log(result);
            }
        }).fail(function(data) {
            ShowAlert('Oops...', 'Something went wrong!', 'error');
        });
        return false;
    }

    function ConfirmCancel(id, ctl) {
        // console.log('cancel id' + id);
        //Disable sản phẩm
        Swal.fire({
            title: 'Xác nhận hủy đơn hàng?'
            , text: "Đơn hàng này sẽ bị hủy"
            , icon: 'warning'
            , showCancelButton: true
            , confirmButtonColor: '#3085d6'
            , cancelButtonColor: '#d33'
            , cancelButtonText:'Đóng'
            , confirmButtonText: 'Xác nhận'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: 'PUT'
                    , headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('value')
                    }
                    , url: '/Group8_PhoneStore/cancel-order/' + id
                    , success: function(result) {
                        if (result.status == 'success') {
                            var disabled = '<button class="btn btn-danger disabled"><i class="far fa-times-circle"></i> Canceled</button>';
                            $(ctl).parent().parent().children('td:nth-child(7)').html(disabled);
                            var info = '<a href="" onclick="return OrderDetail('+id+',this)" role="button" data-toggle="modal" data-target="#modal-xl" class="btn btn-primary"><i class="fas fa-info"></i></a>';
                            $(ctl).parent().html(info);
                            ShowAlert('Hủy!', result.message, 'success');
                        } else if (result.status == 'disabled') {
                            ShowAlert('Đã hủy', result.message, 'info');
                        } else {
                            ShowAlert('Lỗi...', result.message, 'error');
                        }
                    }
                }).fail(function(data) {
                    ShowAlert('Oops...', 'Đã có lỗi xảy ra. Vui lòng thử lại sau!', 'error');
                });
            }
        })
        return false;
    }

    function ConfirmFinish(id, ctl) {
        Swal.fire({
            title: 'Xác nhận đơn hàng này?'
            , text: "Đơn hàng sẽ được đánh dấu là hoàn thành"
            , icon: 'info'
            , showCancelButton: true
            , confirmButtonColor: '#3085d6'
            , cancelButtonColor: '#d33'
            , cancelButtonText:'Đóng'
            , confirmButtonText: 'Xác nhận'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: 'PUT'
                    , headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('value')
                    }
                    , url: '/Group8_PhoneStore/confirm-order/' + id
                    , success: function(result) {
                        if (result.status == 'success') {
                            var disabled = '<button class="btn btn-success disabled"><i class="fas fa-check-circle"></i> Finished</button>';
                            $(ctl).parent().parent().children('td:nth-child(7)').html(disabled);
                            var info = '<a href="" onclick="return OrderDetail('+id+',this)" role="button" data-toggle="modal" data-target="#modal-xl" class="btn btn-primary"><i class="fas fa-info"></i></a>';
                            $(ctl).parent().html(info);
                            ShowAlert('Hoàn thành!', result.message, 'success');
                        } else if (result.status == 'disabled') {
                            ShowAlert('Đã được xác nhận', result.message, 'info');
                        } else {
                            ShowAlert('Lỗi...', result.message, 'error');
                        }
                    }
                }).fail(function(data) {
                    ShowAlert('Oops...', 'Đã có lỗi xảy ra!. Vui lòng thử lại sau', 'error');
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
