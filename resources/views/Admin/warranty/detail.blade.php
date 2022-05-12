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
                        <h3 class="card-title">Chi tiết bảo hành hóa đơn <span class="text-warning">#{{$order->SoHDB}}</span></h3>
                    </div>
                    <div style="padding: 1.25rem">
                        <h5>Ngày đặt hàng: {{ date('d-m-Y H:i:s', strtotime($order->NgayDatHang)) }}</h5>
                        <h5>Khách hàng: {{$order->customer->name  }}</h5>
                        <h5>Số điện thoại: {{$order->SoDienThoai  }}</h5>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Mã SP</th>
                                    <th>Tên SP</th>
                                    <th>Màu </th>
                                    <th>Số lượng</th>
                                    <th>Đơn giá</th>
                                    <th>Bảo hành</th>
                                    <th>Tình trạng bảo hành</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($order_detail as $item)
                                <tr>
                                    {{-- <td>{{ $item->SoHDB}}</td> --}}
                                    {{-- <td>{{ $item->customer->name}}</td> --}}
                                    {{-- <td>{{ date('d-m-Y H:i:s', strtotime($item->NgayDatHang));}}</td> --}}
                                    <td>{{ $item->MaDT}}</td>
                                    <td>{{ $item->TenDT}}</td>
                                    <td>{{ $item->Mau }}</td>
                                    <td>{{ $item->SoLuong}}</td>
                                    <td>{{ number_format($item->DonGiaBan)}}₫</td>
                                    <td>{{ $item->ThoiGianBaoHanh}}</td>
                                    @if($item->BaoHanh ==0)
                                    <td>Chưa kích hoạt</td>    
                                    @endif
                                    
                                    <td>
                                        {{-- <a href="{{ url('edit-quantity/'.$item->MaDT) }}" class="btn btn-primary"><i class="fas fa-edit"></i> Edit</a> --}}
                                        <a onclick="return EditQuantity('{{$item->MaDT }}','{{ $item->Mau }}','{{ $order->SoHDB }}',this)" class="btn btn-primary">Edit</a>
                                    </td>
                                    {{-- <td>
                                        <a href="" onclick="return OrderDetail('{{ $item->SoHDB }}',this)" role="button" data-toggle="modal" data-target="#modal-xl" class="btn btn-primary"><i class="fas fa-info"></i></a>
                                    </td> --}}
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
            "order": [],
            "columnDefs": [{
                    "width": "10%"
                    , "targets": [0,1,2]
                }
                ,  {
                    "width": "15%"
                    , "targets": 4
                }
                ,  {
                    "width": "10%"
                    , "targets": 3
                }, {
                    "width": "10%"
                    , "targets": [5,7]
                }, {
                    "width": "35%"
                    , "targets": 6
                }
            , ]
            , "responsive": true
            ,searching: false
            , paging: false
            , info: false
        })
    });

    function EditQuantity(id, color,orderid, ctl) {
        if ($(ctl).text() == 'Edit') {
            $(ctl).text('Save');
                var val = $(ctl).parent().parent().children('td:nth-child(7)').text().trim();
                // console.log(i + ":" + val);
                // $(ctl).parent().parent().children('td:nth-child(7)').html('<input type="text" style="width:450px" value="' + val + '" />');
                $(ctl).parent().parent().children('td:nth-child(7)').html('<textarea style="width:350px; height:100px">' + val + '</textarea>');
        } else {
            var elem = $(ctl).parent().parent();
            // data = {
            //     MaDT: id
            //     , Mau: color
            //     , SoLuong: $(elem).children('td:nth-child(2)').children().val()
            //     , DonGiaNhap: $(elem).children('td:nth-child(3)').children().val()
            //     , DonGiaBan: $(elem).children('td:nth-child(4)').children().val()
            // }
            $(ctl).text('Edit');
            $(elem).children('td:nth-child(7)').text($(ctl).parent().parent().children('td:nth-child(7)').children('textarea').val());
            // console.log(data);
            // $.ajax({
            //     type: 'PUT'
            //     , headers: {
            //         'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('value')
            //     }
            //     , url: '/PhoneStore/update-quantity'
            //     , data: JSON.stringify(data)
            //     , contentType: 'application/json'
            //     , success: function(result) {
            //         console.log(result);
            //         if (result.status === 'success') {
            //             toastr.options = {
            //                 "timeOut": 3000 // 3s
            //                 , "progressBar": true
            //             }
            //             toastr.success(result.message);
            //             for (var i = 0; i < 3; i++) {
            //                 $(elem).children('td:nth-child(' + (2 + i) + ')').text($(ctl).parent().parent().children('td:nth-child(' + (2 + i) + ')').children('input').val());
            //             }
            //             $(ctl).text('Edit');
            //         }
            //     }
            //     , error: function(xhr, ajaxOptions, thrownError) {
            //         toastr.options = {
            //             "timeOut": 3000
            //             , "progressBar": true
            //         }
            //         toastr.error(JSON.parse(xhr.responseText).message);
            //     }
            // });
        }
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
