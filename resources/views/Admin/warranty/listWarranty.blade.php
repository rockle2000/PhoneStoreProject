@extends('layouts.admin_layout')
@section('css')
<link rel="stylesheet" href="{{asset('public/backend/Admin/Layout/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
<link rel="stylesheet" href="{{asset('public/backend/Admin/Layout/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
<link rel="stylesheet" href="{{asset('public/backend/Admin/Layout/plugins/datatables-buttons/css/buttons.bootstrap4.min.css')}}">
@endsection
<!-- Content Header (Page header) -->
@section('content')
<!-- Main content -->
<section class="content">
    <div class="container-fluid">
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
                                        <button class="btn btn-success  disabled">
                                            <i class="fas fa-check-circle"></i>
                                            Finished
                                        </button>
                                    </td>
                                    <td>
                                        <a href="{{ url('warranty-detail/'.$item->SoHDB) }}" class="btn btn-primary">Edit</a>
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
<script src="{{asset('public/backend/Admin/Layout/plugins/datatables-buttons/js/buttons.html5.min.js')}}"></script>
<script src="{{asset('public/backend/Admin/Layout/plugins/datatables-buttons/js/buttons.print.min.js')}}"></script>
<script src="{{asset('public/backend/Admin/Layout/plugins/datatables-buttons/js/buttons.colVis.min.js')}}"></script>

<script type="text/javascript">
    $(function() {
        
        $("#example1").DataTable({
            "order": []
                // , "lengthChange": false
            , "pageLength": 6
        })
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
            , url: '/PhoneStore/orderdetail/' + id
            , success: function(result) {
                var res = '';
                var total = 0;
                result.detail.forEach(item => {
                    // console.log(item.SoHDB);
                    res += '<tr><td>' + item.TenDT + '</td><td>' + item.Mau + '</td><td>'+ item.SoLuong + '</td><td>' + item.DonGiaBan.toLocaleString('en') + '₫</td><td>' + (item.DonGiaBan * item.SoLuong).toLocaleString('en') + '₫</td></tr>';
                    total += item.DonGiaBan * item.SoLuong;
                });
                $('.modal-body tbody').html(res);
                $('.modal-body tfoot #total').html(total.toLocaleString('en') + '₫');
                var paid = result.order.ThanhTien;
                var discount = result.order.GiamGia;
                if(discount == 0){
                    $('.modal-body tfoot #discount').html('Không có');    
                }else{
                    $('.modal-body tfoot #discount').html(discount + '%');
                }
                $('.modal-body tfoot #thanhtien').html(paid.toLocaleString('en') + '₫');
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
                    , url: '/PhoneStore/cancel-order/' + id
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
                    , url: '/PhoneStore/confirm-order/' + id
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
