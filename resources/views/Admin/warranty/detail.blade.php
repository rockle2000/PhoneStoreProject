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
                        <h5><strong>Ngày đặt hàng:</strong> {{ date('d-m-Y H:i:s', strtotime($order->NgayDatHang)) }}</h5>
                        <h5><strong>Khách hàng: </strong>{{$order->customer->name  }}</h5>
                        <h5><strong>Số điện thoại:</strong> {{$order->SoDienThoai  }}</h5>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="example1" class="table table-bordered table-striped" >
                            <thead>
                                <tr>
                                    <th>Mã SP</th>
                                    <th>Tên SP</th>
                                    <th>Màu </th>
                                    <th>Số lượng</th>
                                    <th>Đơn giá</th>
                                    <th>Bảo hành</th>
                                    <th>Hạn bảo hành</th>
                                    <th>Tình trạng bảo hành</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($order_detail as $item)
                                <tr>
                                    <td>{{ $item->MaDT}}</td>
                                    <td>{{ $item->TenDT}}</td>
                                    <td>{{ $item->Mau }}</td>
                                    <td>{{ $item->SoLuong}}</td>
                                    <td>{{ number_format($item->DonGiaBan)}}₫</td>
                                    <td>{{ $item->ThoiGianBaoHanh}}</td>
                                    {{-- Hạn bảo hành --}}
                                    <td>{{ date('d-m-Y', strtotime("+".explode(" ", $item->ThoiGianBaoHanh)[0] ." months", strtotime($order->NgayDatHang))); }}</td>
                                    @if($item->BaoHanh ==0)
                                    <td>Chưa kích hoạt</td>   
                                    @else
                                    <td>{{ $item->BaoHanh }}</td> 
                                    @endif
                                    @php
                                    $currentDate = strtotime(date('Y-m-d'));
                                    $expire = strtotime("+".explode(" ", $item->ThoiGianBaoHanh)[0] ." months", strtotime($order->NgayDatHang));
                                    @endphp
                                    <td>
                                            @if($expire < $currentDate)
                                            <span class="text-danger"> Quá hạn</span>
                                            @else
                                            <a onclick="return EditWarranty('{{$item->MaDT }}','{{ $item->Mau }}','{{ $order->SoHDB }}',this)" class="btn btn-primary">Edit</a>
                                            @endif
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
    
    $(document).ready(function () {
        $('#example1').DataTable({
            paging: false,
            searching: false,
        });
    });

    function EditWarranty(pid, color,orderid, ctl) {
        if ($(ctl).text() == 'Edit') {
            $(ctl).text('Save');
                var val = $(ctl).parent().parent().children('td:nth-child(8)').text().trim();
                // console.log(i + ":" + val);
                // $(ctl).parent().parent().children('td:nth-child(7)').html('<input type="text" style="width:450px" value="' + val + '" />');
                $(ctl).parent().parent().children('td:nth-child(8)').html('<textarea style="width:200px; height:100px">' + val + '</textarea>');
        } else {
            var elem = $(ctl).parent().parent();
            data = {
                MaDT: pid
                , Mau: color
                , SoHDB:orderid
                , BaoHanh: $(elem).children('td:nth-child(8)').children().val()
            }
            // console.log(data)
            // $(ctl).text('Edit');
            // $(elem).children('td:nth-child(8)').text($(ctl).parent().parent().children('td:nth-child(8)').children('textarea').val());
            // console.log(data);
            $.ajax({
                type: 'PUT'
                , headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('value')
                }
                , url: '/PhoneStore/update-warranty'
                , data: JSON.stringify(data)
                , contentType: 'application/json'
                , success: function(result) {
                    console.log(result);
                    if (result.status === 'success') {
                        toastr.options = {
                            "timeOut": 3000 // 3s
                            , "progressBar": true
                        }
                        toastr.success(result.message);
                        $(elem).children('td:nth-child(8)').text($(ctl).parent().parent().children('td:nth-child(8)').children('textarea').val());
                        $(ctl).text('Edit');
                    }
                }
                , error: function(xhr, ajaxOptions, thrownError) {
                    toastr.options = {
                        "timeOut": 3000
                        , "progressBar": true
                    }
                    toastr.error(JSON.parse(xhr.responseText).message);
                }
            });
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
