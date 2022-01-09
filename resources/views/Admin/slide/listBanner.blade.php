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
                        <h3 class="card-title">Danh sách Banner</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Ảnh</th>
                                    <th>Nội dung</th>
                                    <th>Type</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($banner as $item)
                                <tr>
                                    <td>{{ $item->id}}</td>
                                    <td><img src="{{ asset('public/backend/uploads/banners/'.$item->Anh)}}" style="width: 150px; height: 150px background-size:cover" alt=""></td>
                                    <td>{!! $item->NoiDung !!}</td>
                                    <td>{{ $item->Type}}</td>
                                    <td>
                                        <a href="#" onclick="return ConfirmDelete('{{ $item->id }}',this)" class="btn btn-danger"><i class="fas fa-trash-alt"></i> Delete</a>
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
{{-- <script src="{{asset('public/backend/Admin/Layout/plugins/datatables-buttons/js/dataTables.buttons.min.js')}}"></script> --}}
{{-- <script src="{{asset('public/backend/Admin/Layout/plugins/datatables-buttons/js/buttons.bootstrap4.min.js')}}"></script> --}}
{{-- <script src="{{asset('public/backend/Admin/Layout/plugins/jszip/jszip.min.js')}}"></script>
<script src="{{asset('public/backend/Admin/Layout/plugins/pdfmake/pdfmake.min.js')}}"></script>
<script src="{{asset('public/backend/Admin/Layout/plugins/pdfmake/vfs_fonts.js')}}"></script>
<script src="{{asset('public/backend/Admin/Layout/plugins/datatables-buttons/js/buttons.html5.min.js')}}"></script>
<script src="{{asset('public/backend/Admin/Layout/plugins/datatables-buttons/js/buttons.print.min.js')}}"></script>
<script src="{{asset('public/backend/Admin/Layout/plugins/datatables-buttons/js/buttons.colVis.min.js')}}"></script> --}}
<script type="text/javascript">
    $(function() {
        $("#example1").DataTable({
            "responsive": true
            , "pageLength": 4
        });
    });
    // .buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    @if(session('status'))
    toastr.options = {
        "timeOut": 3000 // 3s
        , "progressBar": true
    }
    toastr.success("{{ session('status') }}");
    @endif

    @if(session('error'))
    toastr.options = {
        "timeOut": 3000 // 3s
        , "progressBar": true
    }
    toastr.error("{{ session('error') }}");
    @endif

    function ConfirmDelete(id, ctl) {
        Swal.fire({
            title: 'Bạn chắc chắn muốn xóa banner này?'
            , text: "Banner này sẽ bị xóa vĩnh viễn"
            , icon: 'warning'
            , showCancelButton: true
            , confirmButtonColor: '#3085d6'
            , cancelButtonColor: '#d33'
            , confirmButtonText: 'Delete'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: 'DELETE'
                    , headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('value')
                    }
                    , url: '/Group8_PhoneStore/delete-banner/' + id
                    , success: function(result) {
                        if (result.status == 'success') {
                            $(ctl).parent().parent().remove();
                            ShowAlert('Deleted!', result.message, 'success');
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
