<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf_token" value="{{ csrf_token() }}">
    <link rel="icon" href="https://img.icons8.com/nolan/64/store-setting.png">
    <title>Admin</title>
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{asset('public/backend/Admin/Layout/plugins/fontawesome-free/css/all.min.css')}}">
    {{-- <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css'"> --}}
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet" href="{{asset('public/backend/Admin/Layout/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css')}}">
    <!-- iCheck -->
    <link rel="stylesheet" href="{{asset('public/backend/Admin/Layout/plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
    <!-- JQVMap -->
    {{-- <link rel="stylesheet" href="{{asset('public/backend/Admin/Layout/plugins/jqvmap/jqvmap.min.css')}}"> --}}
    <!-- Theme style -->
    <link rel="stylesheet" href="{{asset('public/backend/Admin/Layout/dist/css/adminlte.min.css')}}">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="{{asset('public/backend/Admin/Layout/plugins/overlayScrollbars/css/OverlayScrollbars.min.css')}}">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="{{asset('public/backend/Admin/Layout/plugins/daterangepicker/daterangepicker.css')}}">
    
    <!-- summernote -->
    <link rel="stylesheet" href="{{asset('public/backend/Admin/Layout/plugins/summernote/summernote-bs4.min.css')}}">
    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="{{asset('public/backend/Admin/Layout/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css')}}">
    <!-- Toastr -->
    <link rel="stylesheet" href="{{asset('public/backend/Admin/Layout/plugins/toastr/toastr.min.css')}}">
    @yield('css')
</head>
<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">

        <!-- Preloader -->
        <div class="preloader flex-column justify-content-center align-items-center">
            <img class="animation__shake" src="{{asset('public/backend/Admin/Layout/dist/img/AdminLTELogo.png')}}" alt="AdminLTELogo" height="60" width="60">
        </div>

        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="{{ url('dashboard') }}" class="nav-link">Dashboard</a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="#" class="nav-link">Liên hệ</a>
                </li>
            </ul>

            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
                <!-- Navbar Search -->
                <li class="nav-item">
                    <a class="nav-link" data-widget="navbar-search" href="#" role="button">
                        <i class="fas fa-search"></i>
                    </a>
                    <div class="navbar-search-block">
                        <form class="form-inline">
                            <div class="input-group input-group-sm">
                                <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
                                <div class="input-group-append">
                                    <button class="btn btn-navbar" type="submit">
                                        <i class="fas fa-search"></i>
                                    </button>
                                    <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </li>

                <!-- Messages Dropdown Menu -->

                <!-- Notifications Dropdown Menu -->

                <li class="nav-item">
                    <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                        <i class="fas fa-expand-arrows-alt"></i>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
                        <i class="fas fa-th-large"></i>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <a href="index3.html" class="brand-link">
                <img src="{{asset('public/backend/Admin/Layout/dist/img/AdminLTELogo.png')}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
                <span class="brand-text font-weight-light">Phone Store</span>
            </a>

            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar user panel (optional) -->
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="image">
                        <img src="{{asset('public/backend/Admin/Layout/dist/img/user2-160x160.jpg')}}" class="img-circle elevation-2" alt="User Image">
                    </div>
                    <div class="info">
                        <a href="#" class="d-block"> {{ Auth::user()->name }}</a>
                    </div>
                </div>
                <!-- SidebarSearch Form -->
                <div class="form-inline">
                    <div class="input-group" data-widget="sidebar-search">
                        <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
                        <div class="input-group-append">
                            <button class="btn btn-sidebar">
                                <i class="fas fa-search fa-fw"></i>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                        <!-- Add icons to the links using the .nav-icon class with font-awesome or any other icon font library -->
                        <li class="nav-item ">
                            <a href="{{ url('/dashboard') }}" class="nav-link {{ Request::path()=='dashboard' ? 'active' : '' }}">
                                <i class="nav-icon fa fa-th"></i>
                                <p>
                                    Trang chủ
                                    {{-- <i class="right fas fa-angle-left"></i> --}}
                                    {{-- <span class="right badge badge-danger">New</span> --}}
                                </p>
                            </a>
                        </li>
                        <li class="nav-item {{ (Request::path()=='supplier-list'||Request::path()=='add-supplier') ? 'menu-open' : '' }}">
                            <a href="#" class="nav-link {{ (Request::path()=='supplier-list'||Request::path()=='add-supplier') ? 'active' : '' }}">
                                <i class="nav-icon fa fa-copy"></i>
                                <p>
                                    Quản lý nhà sản xuất
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ url('/supplier-list') }}" class="nav-link {{ Request::path()=='supplier-list' ? 'active' : '' }}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Danh sách nhà sản xuất</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ url('/add-supplier') }}" class="nav-link {{ Request::path()=='add-supplier' ? 'active' : '' }}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Thêm mới nhà sản xuất</p>
                                    </a>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('customers.index') }}" class="nav-link {{ Request::path()=='customers' ? 'active' : '' }}">
                                <i class="nav-icon fas fa-user-circle"></i>
                                <p>
                                    Quản lý người dùng
                                </p>
                            </a>
                        </li>
                        <li class="nav-item {{ (Request::path()=='product-list'||Request::path()=='add-product') ? 'menu-open' : '' }}">
                            <a href="#" class="nav-link {{ (Request::path()=='product-list'||Request::path()=='add-product') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-boxes"></i>
                                <p>
                                    Quản lý sản phẩm
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ url('/product-list') }}" class="nav-link {{ Request::path()=='product-list' ? 'active' : '' }}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Danh sách sản phẩm</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ url('/add-product') }}" class="nav-link {{ Request::path()=='add-product' ? 'active' : '' }}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Thêm mới sản phẩm</p>
                                    </a>
                            </ul>
                        </li>
                        <li class="nav-item {{ (Request::path()=='banner-list'||Request::path()=='add-banner') ? 'menu-open' : '' }}">
                            <a href="#" class="nav-link {{ (Request::path()=='banner-list'||Request::path()=='add-banner') ? 'active' : '' }}">

                                <i class="nav-icon fas fa-images"></i>
                                <p>
                                    Quản lý Banners Slide
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ url('/banner-list') }}" class="nav-link {{ Request::path()=='banner-list' ? 'active' : '' }}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Danh sách Banner/Slide</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ url('/add-banner') }}" class="nav-link {{ Request::path()=='add-banner' ? 'active' : '' }}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Thêm mới Banner/Slide</p>
                                    </a>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('/chart') }}" class="nav-link {{ Request::path()=='chart' ? 'active' : '' }}">
                                <i class="nav-icon fa fa-chart-pie"></i>
                                <p>Thống kê</p>
                            </a>
                        </li>
                        {{-- <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-lock"></i>
                                <p>Đổi mật khẩu</p>
                            </a>
                        </li> --}}

                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                {{-- {{ __('Logout') }} --}}
                                <i class="nav-icon fas fa-sign-out-alt"></i>
                                <p>Đăng xuất</p>
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </li>
                    </ul>
                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            @yield("content")
        </div>
        <!-- /.content-wrapper -->
        {{-- <footer class="main-footer">
        <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong>
        All rights reserved.
        <div class="float-right d-none d-sm-inline-block">
            <b>Version</b> 3.1.0
        </div>
    </footer> --}}

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->
    {{-- <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script> --}}

    {{-- <script src="{{ asset('js/app.js') }}" defer></script> --}}
    <!-- jQuery -->
    <script src="{{asset('public/backend/Admin/Layout/plugins/jquery/jquery.min.js')}}"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="{{asset('public/backend/Admin/Layout/plugins/jquery-ui/jquery-ui.min.js')}}"></script> --}}
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    {{-- <script>
        $.widget.bridge('uibutton', $.ui.button)
    </script>--}}
    <!-- Bootstrap 4 -->
    <script src="{{asset('public/backend/Admin/Layout/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <!-- ChartJS -->
    <script src="{{asset('public/backend/Admin/Layout/plugins/chart.js/Chart.min.js')}}"></script>
    <!-- Sparkline -->
    {{-- <script src="{{asset('public/backend/Admin/Layout/plugins/sparklines/sparkline.js')}}"></script> --}}
    <!-- jQuery Knob Chart -->
    <script src="{{asset('public/backend/Admin/Layout/plugins/jquery-knob/jquery.knob.min.js')}}"></script>
    <!-- daterangepicker -->
    <script src="{{asset('public/backend/Admin/Layout/plugins/moment/moment.min.js')}}"></script>
    <script src="{{asset('public/backend/Admin/Layout/plugins/daterangepicker/daterangepicker.js')}}"></script>
    <!-- Tempusdominus Bootstrap 4 -->
    <script src="{{asset('public/backend/Admin/Layout/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js')}}"></script>
    <!-- Summernote -->
    <script src="{{asset('public/backend/Admin/Layout/plugins/summernote/summernote-bs4.min.js')}}"></script>
    <!-- overlayScrollbars -->
    <script src="{{asset('public/backend/Admin/Layout/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js')}}"></script>
    <!-- AdminLTE App -->
    <script src="{{asset('public/backend/Admin/Layout/dist/js/adminlte.js')}}"></script>
    <!-- AdminLTE for demo purposes -->
    {{-- <script src="{{asset('public/backend/Admin/Layout/dist/js/demo.js')}}"></script> --}}
    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <script src="{{asset('public/backend/Admin/Layout/dist/js/pages/dashboard.js')}}"></script>
    {{-- DataTables --}}
    {{-- <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script> --}}
    <!-- SweetAlert2 -->
    <script src="{{asset('public/backend/Admin/Layout/plugins/sweetalert2/sweetalert2.min.js')}}"></script>
    <!-- Toastr -->
    <script src="{{asset('public/backend/Admin/Layout/plugins/toastr/toastr.min.js')}}"></script>
    @yield('js')

</body>
</html>
