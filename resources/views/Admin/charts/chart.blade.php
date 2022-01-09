@extends('layouts.admin_layout')
@section('css')
<link rel="stylesheet" href="{{asset('public/backend/Admin/YearPicker/yearpicker.css')}}">
@endsection
<!-- Content Header (Page header) -->
@section('content')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Thống kê</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Thống kê</li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6">
                <!-- AREA CHART -->
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Doanh thu năm </h3>
                        <input type="text" style="height:20px; border:none; margin-left:15px;" class="yearpicker" id="yp_doanhthu" value="">
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                            <button type="button" class="btn btn-tool" data-card-widget="remove">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="chart" id="chart_doanh_thu" style="width: 100%; height: 400px">
                            <canvas id="chart_dt"></canvas>
                        </div>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->

                <!-- PIE CHART -->
                {{-- <div class="card card-danger">
                    <div class="card-header">
                        <h3 class="card-title">Pie Chart</h3>

                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                            <button type="button" class="btn btn-tool" data-card-widget="remove">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <canvas id="pieChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                    </div>
                    <!-- /.card-body -->
                </div> --}}
                <!-- /.card -->
            </div>


            <!-- /.col (LEFT) -->
            <div class="col-md-6">
                <!-- LINE CHART -->
                <div class="card card-danger">
                    <div class="card-header">
                        <h3 class="card-title">Thống kê sản phẩm bán được trong năm </h3>
                        <input type="text" style="height:20px; border:none; margin-left:15px;" class="yearpicker" id="yp_thongke" value="">
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                            <button type="button" class="btn btn-tool" data-card-widget="remove">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="chart" id="chart_supplier" style="width: 100%; height: 400px">
                            <canvas id="chart_tkth"></canvas>
                        </div>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->

                <!-- STACKED BAR CHART -->
                {{-- <div class="card card-success">
                    <div class="card-header">
                        <h3 class="card-title">Stacked Bar Chart</h3>

                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                            <button type="button" class="btn btn-tool" data-card-widget="remove">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="chart">
                            <canvas id="stackedBarChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                        </div>
                    </div>
                    <!-- /.card-body -->
                </div> --}}
                <!-- /.card -->

            </div>
            <!-- /.col (RIGHT) -->
        </div>
        <!-- /.row -->
    </div><!-- /.container-fluid -->
</section>
<!-- /.content -->
@endsection

@section('js')
<script src=" {{asset('public/backend/Admin/YearPicker/yearpicker.js')}}"></script>
<script>
    $(document).ready(function() {
        $('#yp_doanhthu').yearpicker({
            // Initial Year
            year: new Date().getFullYear(),
            // Start Year
            startYear: 2000,
            // End Year
            endYear: new Date().getFullYear(),
            // Element tag
            itemTag: 'li',
            // Default CSS classes
            selectedClass: 'selected'
            , disabledClass: 'disabled'
            , hideClass: 'hide',

            // Custom template
            template: `<div class="yearpicker-container">
                          <div class="yearpicker-header">
                              <div class="yearpicker-prev" data-view="yearpicker-prev">&lsaquo;</div>
                              <div class="yearpicker-current" data-view="yearpicker-current">SelectedYear</div>
                              <div class="yearpicker-next" data-view="yearpicker-next">&rsaquo;</div>
                          </div>
                          <div class="yearpicker-body">
                              <ul class="yearpicker-year" data-view="years">
                              </ul>
                          </div>
                      </div>`
            , onShow: null
            , onHide: null
            , onChange: function(value) {
                DoanhThuTheoNam(value);
            }
        });

        $('#yp_thongke').yearpicker({
            // Initial Year
            year: new Date().getFullYear(),
            // Start Year
            startYear: 2000,
            // End Year
            endYear: new Date().getFullYear(),
            // Element tag
            itemTag: 'li',
            // Default CSS classes
            selectedClass: 'selected'
            , disabledClass: 'disabled'
            , hideClass: 'hide',

            // Custom template
            template: `<div class="yearpicker-container">
                          <div class="yearpicker-header">
                              <div class="yearpicker-prev" data-view="yearpicker-prev">&lsaquo;</div>
                              <div class="yearpicker-current" data-view="yearpicker-current">SelectedYear</div>
                              <div class="yearpicker-next" data-view="yearpicker-next">&rsaquo;</div>
                          </div>
                          <div class="yearpicker-body">
                              <ul class="yearpicker-year" data-view="years">
                              </ul>
                          </div>
                      </div>`
            , onShow: null
            , onHide: null
            , onChange: function(value) {
                ThongKeTheoHang(value);
            }
        });

        function DoanhThuTheoNam(nam) {
            $.get('/Group8_PhoneStore/chart/revenue/' + nam, function(data) {
                var thang = [];
                var dulieu = [];
                var isEmpty = true;
                var result = Object.entries(data[0]);
                // console.log("res: " + result);
                for (const [key, value] of Object.entries(data[0])) {
                    // console.log(key, value);
                    thang.push(key);
                    dulieu.push(value);
                }
                for (i = 0; i < dulieu.length; i++) {
                    if (dulieu[i] !== 0) {
                        isEmpty = false;
                        break;
                    }
                }
                // console.log(isEmpty);
                if (!isEmpty)
                    Ve('chart_doanhthu', 'chart_dt', 'bar', dulieu, thang);
                else {
                    // <canvas id="chart_dt"></canvas>
                    $('#chart_doanh_thu').html('');
                    $('#chart_doanh_thu').html('<canvas id="chart_dt"></canvas>');
                    alert("Không có dữ liệu");
                }
            });
        }

        function ThongKeTheoHang(nam) {
            $.get('/Group8_PhoneStore/chart/productBySupplier/' + nam, function(data) {
                var tennsx = [];
                var soluong = [];
                // console.log(data);
                if (data.length !== 0) {
                    for (var i in data) {
                        tennsx.push(data[i].TenNSX);
                        soluong.push(data[i].SoLuong);
                    }
                    // console.log('TenNSX: ' + tennsx);
                    // console.log('So luong: ' + soluong);
                    Ve('chart_thongketheohang', 'chart_tkth', 'doughnut', soluong, tennsx);
                } else {
                    $('#chart_supplier').html('');
                    $('#chart_supplier').html('<canvas id="chart_tkth"></canvas>');
                }
            });
        }

        function Ve(div, canvas, type, data, label) {
            $('#' + div).html('');
            $('#' + div).html('<canvas id="' + canvas + '"></canvas>');
            var ctx = document.getElementById(canvas).getContext("2d");
            var myChart = new Chart(ctx, {
                type: type
                , data: {
                    labels: label
                    , datasets: [{
                        label: "Doanh thu nhập(VNĐ)"
                        , data: data
                        , backgroundColor: [
                            "rgba(224, 86, 253,0.5)"
                            , "rgba(54, 162, 235, 0.5)"
                            , "rgba(255, 206, 86, 0.5)"
                            , "rgba(75, 192, 192, 0.5)"
                            , "rgba(153, 102, 255, 0.5)"
                            , "rgba(255, 159, 64, 0.5)"
                            , "rgba(246, 229, 141,0.5)"
                            , "rgba(240, 147, 43, 0.5)"
                            , "rgba(255, 121, 121,0.5)"
                            , "rgba(186, 220, 88,0.5)"
                            , "rgba(104, 109, 224,0.5)"
                            , "rgba(72, 52, 212,0.5)"
                        , ]
                        , borderColor: [
                            "rgba(224, 86, 253,1)"
                            , "rgba(54, 162, 235, 1)"
                            , "rgba(255, 206, 86, 1)"
                            , "rgba(75, 192, 192, 1)"
                            , "rgba(153, 102, 255, 1)"
                            , "rgba(255, 159, 64, 1)"
                            , "rgba(246, 229, 141,1)"
                            , "rgba(240, 147, 43, 1)"
                            , "rgba(255, 121, 121,1)"
                            , "rgba(186, 220, 88,1)"
                            , "rgba(104, 109, 224,1)"
                            , "rgba(72, 52, 212,1)"
                        , ]
                        , borderWidth: 1
                    , }]
                , }
                , options: {
                    responsive: true,
                    //padding layout canvas
                    layout: {
                        padding: {
                            left: 20
                            , right: 0
                            , top: 0
                            , bottom: 0
                        , }
                    , }
                    , legend: {
                        labels: {
                            fontColor: "black"
                            , fontSize: 18
                        , }
                    , }
                    , maintainAspectRatio: false
                    , scales: {
                        yAxes: (type === 'bar') ? [{
                            ticks: {
                                stepSize: 50000000
                                , callback: function(value) {
                                    var ranges = [{
                                            divider: 1e6
                                            , suffix: 'M'
                                        }
                                        , {
                                            divider: 1e3
                                            , suffix: 'k'
                                        }
                                    ];

                                    function formatNumber(n) {
                                        for (var i = 0; i < ranges.length; i++) {
                                            if (n >= ranges[i].divider) {
                                                return (n / ranges[i].divider).toString() + ranges[i].suffix;
                                            }
                                        }
                                        return n;
                                    }
                                    return formatNumber(value);
                                }
                            }
                        }] : ""
                    }
                , }
            , });

        }
    });

</script>
@endsection
