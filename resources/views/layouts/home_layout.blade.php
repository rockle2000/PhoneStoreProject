<!doctype html>
<html class="no-js" lang="zxx">

<!-- index28:48-->
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Phone Store</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf_token" value="{{ csrf_token() }}">
    <!-- Favicon -->
    {{-- <link rel="shortcut icon" type="image/x-icon" href="images/favicon.png"> --}}
    <link rel="icon" href="https://img.icons8.com/nolan/50/mobile-shopping-bag.png">
    <!-- Material Design Iconic Font-V2.2.0 -->
    <link rel="stylesheet" href="{{asset('public/frontend/css/material-design-iconic-font.min.css') }}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{asset('public/frontend/css/font-awesome.min.css') }}">
    <!-- Font Awesome Stars-->
    <link rel="stylesheet" href="{{asset('public/frontend/css/fontawesome-stars.css')}}">
    <!-- Meanmenu CSS -->
    <link rel="stylesheet" href="{{asset('public/frontend/css/meanmenu.css')}}">
    <!-- owl carousel CSS -->
    <link rel="stylesheet" href="{{asset('public/frontend/css/owl.carousel.min.css')}}">
    <!-- Slick Carousel CSS -->
    <link rel="stylesheet" href="{{asset('public/frontend/css/slick.css')}}">
    <!-- Animate CSS -->
    <link rel="stylesheet" href="{{asset('public/frontend/css/animate.css')}}">
    <!-- Jquery-ui CSS -->
    <link rel="stylesheet" href="{{asset('public/frontend/css/jquery-ui.min.css')}}">
    <!-- Venobox CSS -->
    <link rel="stylesheet" href="{{asset('public/frontend/css/venobox.css')}}">
    <!-- Nice Select CSS -->
    <link rel="stylesheet" href="{{asset('public/frontend/css/nice-select.css')}}">
    <!-- Magnific Popup CSS -->
    <link rel="stylesheet" href="{{asset('public/frontend/css/magnific-popup.css')}}">
    <!-- Bootstrap V4.1.3 Fremwork CSS -->
    <link rel="stylesheet" href="{{asset('public/frontend/css/bootstrap.min.css')}}">
    <!-- Helper CSS -->
    <link rel="stylesheet" href="{{asset('public/frontend/css/helper.css')}}">
    <!-- Main Style CSS -->
    <link rel="stylesheet" href="{{asset('public/frontend/css/style.css')}}">
    <!-- Responsive CSS -->
    <link rel="stylesheet" href="{{asset('public/frontend/css/responsive.css')}}">
    <!-- Modernizr js -->
    <script src="{{asset('public/frontend/js/vendor/modernizr-2.8.3.min.js')}}"></script>
    <!-- Toastr -->
    <link rel="stylesheet" href="{{asset('public/backend/Admin/Layout/plugins/toastr/toastr.min.css')}}">
    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="{{asset('public/backend/Admin/Layout/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css')}}">
    @yield('css')
</head>
<body>
    <!--[if lt IE 8]>
		<p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
	<![endif]-->
    <!-- Begin Body Wrapper -->
    {{-- @if (session('msg'))
    <div id="alerthome" class="alert alert-success animate__animated animate__bounceInLeft " style="position:fixed;top:9px;right:20%;z-index:9999;transition:all ease 0.5s">
        <i class="fa fa-check" aria-hidden="true"></i> {{ session('msg') }}
    </div>
    @endif

    @if (session('error'))
    <div id="alerthome" class="alert alert-danger animate__animated animate__bounceInLeft " style="position:fixed;top:9px;right:20%;z-index:9999;transition:all ease 0.5s">
        <i class="fa fa-check" aria-hidden="true"></i> {{ session('error') }}
    </div>
    @endif --}}

    <div class="body-wrapper">
        <!-- Begin Header Area -->
        <header>
            <!-- Begin Header Top Area -->
            <div class="header-top">
                <div class="container">
                    <div class="row">
                        <!-- Begin Header Top Left Area -->
                        <div class="col-lg-3 col-md-4">
                            <div class="header-top-left">
                                <ul class="phone-wrap">
                                    <li><span>Số điện thoại:</span><a href="#">(+84) 964 027 677</a></li>
                                </ul>
                            </div>
                        </div>
                        <!-- Header Top Left Area End Here -->
                        <!-- Begin Header Top Right Area -->
                        <div class="col-lg-9 col-md-8">
                            <div class="header-top-right">
                                <ul class="ht-menu">
                                    <!-- Begin Setting Area -->
                                    <li>
                                        <div class="ht-setting-trigger"><span>Cài đặt</span></div>
                                        <div class="setting ht-setting">
                                            <ul class="ht-setting-list">

                                                {{--<li><a href="login-register.html">My Account</a></li>
                                                <li><a href="{{route('user.checkout')}}">Checkout</a>
                                    </li>
                                    <!-- Authentication Links -->
                                    @if (Route::has('user.login'))
                                    @auth('customer')
                                    <li><a href="{{ route('user-logout')  }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">{{ Auth::guard('customer')->user()->name }}</a>
                                        <form action="{{ route('user-logout') }}" method="post" class="d-none" id="logout-form">@csrf</form>
                                        --}}

                                        {{-- <li><a href="checkout.html">Checkout</a></li> --}}
                                        <!-- Authentication Links -->
                                        {{-- @if (Route::has('user.login')) --}}
                                        @if(Auth::guard('customer')->check())
                                        {{-- @auth --}}
                                    <li><a href="{{route('user.infocustomer',['id' => Auth::guard('customer')->user()->id])}}">Tài khoản </a></li>
                                    <li><a href="{{route('user.orderByUser')}}">Đơn hàng</a></li>
                                    <li><a href="{{ route('user.signout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">Đăng xuất</a>
                                        <form action="{{ route('user.signout') }}" method="post" class="d-none" id="logout-form">@csrf</form>
                                    </li>
                                    @else
                                    <li><a href="{{ route('user.login')}}">Đăng nhập</a></li>
                                    @if (Route::has('user.register'))
                                    <li><a href="{{route('user.register')}}">Đăng ký</a></li>
                                    @endif
                                    @endif
                                </ul>
                            </div>
                            </li>
                            <!-- Setting Area End Here -->
                            <!-- Begin Currency Area -->
                            <li>
                                <span class="currency-selector-wrapper">Đơn vị thanh toán :</span>
                                <div class="ht-currency-trigger"><span>VNĐ ₫</span></div>
                                <div class="currency ht-currency">
                                    <ul class="ht-setting-list">
                                        {{-- <li><a href="#">EUR €</a></li> --}}
                                        <li class="active"><a href="#">VNĐ ₫</a></li>
                                    </ul>
                                </div>
                            </li>
                            <!-- Currency Area End Here -->
                            <!-- Begin Language Area -->
                            <li>
                                <span class="language-selector-wrapper">Ngôn ngữ :</span>
                                <div class="ht-language-trigger"><span>Tiếng Việt</span></div>
                                <div class="language ht-language">
                                    <ul class="ht-setting-list">
                                        <li class="active"><a href="#"><img src="{{asset('public/frontend/images/menu/flag-icon/vietnam.png')}}" alt="">Tiếng Việt</a></li>
                                        <li><a href="#"><img src="{{asset('public/frontend/images/menu/flag-icon/1.jpg')}}" alt="">English</a></li>
                                    </ul>
                                </div>
                            </li>
                            <!-- Language Area End Here -->
                            </ul>
                        </div>
                    </div>
                    <!-- Header Top Right Area End Here -->
                </div>
            </div>
    </div>
    <!-- Header Top Area End Here -->
    <!-- Begin Header Middle Area -->
    <div class="header-middle pl-sm-0 pr-sm-0 pl-xs-0 pr-xs-0">
        <div class="container">
            <div class="row">
                <!-- Begin Header Logo Area -->
                <div class="col-lg-3">
                    <div class="logo pb-sm-30 pb-xs-30">
                        <a href="{{url('/main-page')}}">
                            <img src="{{asset('public/frontend/images/menu/logo/1.jpg')}}" alt="">
                        </a>
                    </div>
                </div>
                <!-- Header Logo Area End Here -->
                <!-- Begin Header Middle Right Area -->
                <div class="col-lg-9 pl-0 ml-sm-15 ml-xs-15">
                    <!-- Begin Header Middle Searchbox Area -->
                    <form action="{{route('searchProduct')}}" class="hm-searchbox" method="post">
                        @csrf
                        {{-- <select class="nice-select select-search-category">
                            <option value="0">All</option>
                            <option value="10">Laptops</option>
                        </select> --}}
                        <input type="text" required placeholder="Nhập từ khóa để tìm kiếm ..." name="keyword" value="{{ old('keyword') }}" oninvalid="this.setCustomValidity('Chưa nhập từ khóa để tìm kiếm')" oninput="this.setCustomValidity('')">
                        <button class=" li-btn" type="submit"><i class="fa fa-search"></i></button>
                    </form>
                    <!-- Header Middle Searchbox Area End Here -->
                    <!-- Begin Header Middle Right Area -->
                    <div class="header-middle-right">
                        <ul class="hm-menu">
                            <!-- Begin Header Middle Wishlist Area -->
                            {{-- <li class="hm-wishlist">
                                <a href="wishlist.html">
                                    <span class="cart-item-count wishlist-item-count">0</span>
                                    <i class="fa fa-heart-o"></i>
                                </a>
                            </li> --}}
                            <!-- Header Middle Wishlist Area End Here -->
                            <!-- Begin Header Mini Cart Area -->
                            <li class="hm-minicart">
                                <div class="hm-minicart-trigger">
                                    <span class="item-icon"></span>
                                    {{-- {{ trim(Cart::priceTotal(0)) }}₫ --}}
                                    <span class="item-text font-weight-bold" style="font-family: Roboto,Helvetica,Arial,sans-serif">
                                        Giỏ hàng
                                        <span class="cart-item-count">{{Cart::count()}}</span>
                                    </span>
                                </div>
                                <span></span>
                                <div class="minicart">
                                    <ul class="minicart-product-list">
                                        @foreach (Cart::content() as $row)
                                        @if($loop->index < 2)
                                        <li>
                                            <a href="single-product.html" class="minicart-product-image">
                                                <img src="{{ asset('public/backend/uploads/product-images/'.$row->options->photo) }}" height="50" width="auto">
                                            </a>
                                            <div class="minicart-product-details">
                                                <h6><a href="#">{{$row->name}} - {{ $row->options->color }}</a></h6>
                                                <span>{{number_format($row->price)}}₫ x {{ $row->qty }}</span>
                                            </div>
                                            <a href="{{ route('user.cartRemove' ,['id'=> $row->rowId]) }}">
                                                <i class="fa fa-close"></i>
                                            </a>
                                        </li>
                                        @else
                                            <li style="text-align: center; justify-content:center;"><span class="font-weight-bold">............ Còn nữa ............</span></li>
                                            @break
                                        @endif
                                        @endforeach
                                    </ul>
                                    <p class="minicart-total">Tổng tiền: <span>{{Cart::priceTotal(0)}}₫</span></p>
                                    <div class="minicart-button">
                                        <a href="{{ route('user.fullcart') }}" class="li-button li-button-fullwidth li-button-dark">
                                            <span style="font-family: Roboto,Helvetica,Arial,sans-serif">Xem giỏ hàng</span>
                                        </a>
                                        {{-- <form action="/create-checkout-session" method="POST">
                                                    <button type="submit">Checkout</button>
                                                  </form> --}}
                                        <a href="{{ route('user.checkout') }}" class="li-button li-button-fullwidth">
                                            <span style="font-family: Roboto,Helvetica,Arial,sans-serif">Thanh toán</span>
                                        </a>
                                    </div>
                                </div>
                            </li>
                            <!-- Header Mini Cart Area End Here -->
                        </ul>
                    </div>
                    <!-- Header Middle Right Area End Here -->
                </div>
                <!-- Header Middle Right Area End Here -->
            </div>
        </div>
    </div>
    <!-- Header Middle Area End Here -->
    <!-- Begin Header Bottom Area -->
    <div class="header-bottom header-sticky d-none d-lg-block d-xl-block">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <!-- Begin Header Bottom Menu Area -->
                    <div class="hb-menu">
                        <nav>
                            <ul>
                                <li><a class="font-weight-bold" href="{{ url('main-page') }}">Trang Chủ</a>
                                <li class="dropdown-holder custom-dropdown "><a class="font-weight-bold" href="#">Danh mục</a>
                                    <ul class="hb-dropdown">
                                        @foreach ($supplier as $s)
                                        <li><a href="{{ url('productBySupplier/'.$s->MaNSX) }}">{{ $s->TenNSX }}</a>
                                            @endforeach
                                    </ul>
                                </li>
                                {{-- <li class="dropdown-holder"><a href="blog-left-sidebar.html">Blog</a>
                                            <ul class="hb-dropdown">
                                                <li class="sub-dropdown-holder"><a href="blog-left-sidebar.html">Blog Grid View</a>
                                                    <ul class="hb-dropdown hb-sub-dropdown">
                                                        <li><a href="blog-2-column.html">Blog 2 Column</a></li>
                                                        <li><a href="blog-3-column.html">Blog 3 Column</a></li>
                                                        <li><a href="blog-left-sidebar.html">Grid Left Sidebar</a></li>
                                                        <li><a href="blog-right-sidebar.html">Grid Right Sidebar</a></li>
                                                    </ul>
                                                </li>
                                                <li class="sub-dropdown-holder"><a href="blog-list-left-sidebar.html">Blog List View</a>
                                                    <ul class="hb-dropdown hb-sub-dropdown">
                                                        <li><a href="blog-list.html">Blog List</a></li>
                                                        <li><a href="blog-list-left-sidebar.html">List Left Sidebar</a></li>
                                                        <li><a href="blog-list-right-sidebar.html">List Right Sidebar</a></li>
                                                    </ul>
                                                </li>
                                                <li class="sub-dropdown-holder"><a href="blog-details-left-sidebar.html">Blog Details</a>
                                                    <ul class="hb-dropdown hb-sub-dropdown">
                                                        <li><a href="blog-details-left-sidebar.html">Left Sidebar</a></li>
                                                        <li><a href="blog-details-right-sidebar.html">Right Sidebar</a></li>
                                                    </ul>
                                                </li>
                                                <li class="sub-dropdown-holder"><a href="blog-gallery-format.html">Blog Format</a>
                                                    <ul class="hb-dropdown hb-sub-dropdown">
                                                        <li><a href="blog-audio-format.html">Blog Audio Format</a></li>
                                                        <li><a href="blog-video-format.html">Blog Video Format</a></li>
                                                        <li><a href="blog-gallery-format.html">Blog Gallery Format</a></li>
                                                    </ul>
                                                </li>
                                            </ul>
                                        </li>
                                        <li class="megamenu-static-holder"><a href="index.html">Pages</a>
                                            <ul class="megamenu hb-megamenu">
                                                <li><a href="blog-left-sidebar.html">Blog Layouts</a>
                                                    <ul>
                                                        <li><a href="blog-2-column.html">Blog 2 Column</a></li>
                                                        <li><a href="blog-3-column.html">Blog 3 Column</a></li>
                                                        <li><a href="blog-left-sidebar.html">Grid Left Sidebar</a></li>
                                                        <li><a href="blog-right-sidebar.html">Grid Right Sidebar</a></li>
                                                        <li><a href="blog-list.html">Blog List</a></li>
                                                        <li><a href="blog-list-left-sidebar.html">List Left Sidebar</a></li>
                                                        <li><a href="blog-list-right-sidebar.html">List Right Sidebar</a></li>
                                                    </ul>
                                                </li>
                                                <li><a href="blog-details-left-sidebar.html">Blog Details Pages</a>
                                                    <ul>
                                                        <li><a href="blog-details-left-sidebar.html">Left Sidebar</a></li>
                                                        <li><a href="blog-details-right-sidebar.html">Right Sidebar</a></li>
                                                        <li><a href="blog-audio-format.html">Blog Audio Format</a></li>
                                                        <li><a href="blog-video-format.html">Blog Video Format</a></li>
                                                        <li><a href="blog-gallery-format.html">Blog Gallery Format</a></li>
                                                    </ul>
                                                </li>
                                                <li><a href="index.html">Other Pages</a>
                                                    <ul>
                                                        <li><a href="login-register.html">My Account</a></li>
                                                        <li><a href="checkout.html">Checkout</a></li>
                                                        <li><a href="compare.html">Compare</a></li>
                                                        <li><a href="wishlist.html">Wishlist</a></li>
                                                        <li><a href="shopping-cart.html">Shopping Cart</a></li>
                                                    </ul>
                                                </li>
                                                <li><a href="index.html">Other Pages 2</a>
                                                    <ul>
                                                        <li><a href="contact.html">Contact</a></li>
                                                        <li><a href="about-us.html">About Us</a></li>
                                                        <li><a href="faq.html">FAQ</a></li>
                                                        <li><a href="404.html">404 Error</a></li>
                                                    </ul>
                                                </li>
                                            </ul>
                                        </li> --}}

                                <li><a href="{{ url('about-us') }}" class="font-weight-bold">Giới thiệu</a></li>
                                <li><a href="{{ url('contact') }}" class="font-weight-bold">Liên hệ</a></li>
                            </ul>
                        </nav>
                    </div>
                    <!-- Header Bottom Menu Area End Here -->
                </div>
            </div>
        </div>
    </div>
    <!-- Header Bottom Area End Here -->
    <!-- Begin Mobile Menu Area -->
    <div class="mobile-menu-area d-lg-none d-xl-none col-12">
        <div class="container">
            <div class="row">
                <div class="mobile-menu">
                </div>
            </div>
        </div>
    </div>
    <!-- Mobile Menu Area End Here -->
    </header>
    <!-- Header Area End Here -->

    {{-- Main Content --}}
    @yield('content')
    {{-- End Main Content --}}

    <!-- Begin Footer Area -->
    <div class="footer">
        <!-- Begin Footer Static Top Area -->
        <div class="footer-static-top">
            <div class="container">
                <!-- Begin Footer Shipping Area -->
                <div class="footer-shipping pt-60 pb-55 pb-xs-25">
                    <div class="row">
                        <!-- Begin Li's Shipping Inner Box Area -->
                        <div class="col-lg-3 col-md-6 col-sm-6 pb-sm-55 pb-xs-55">
                            <div class="li-shipping-inner-box">
                                <div class="shipping-icon">
                                    <img src="{{asset('public/frontend/images/shipping-icon/1.png')}}" alt="Shipping Icon">
                                </div>
                                <div class="shipping-text">
                                    <h2>Miễn phí vận chuyển</h2>
                                    <p>Miễn phí trả hàng. Kiểm tra hóa đơn để xem ngày giao hàng</p>
                                </div>
                            </div>
                        </div>
                        <!-- Li's Shipping Inner Box Area End Here -->
                        <!-- Begin Li's Shipping Inner Box Area -->
                        <div class="col-lg-3 col-md-6 col-sm-6 pb-sm-55 pb-xs-55">
                            <div class="li-shipping-inner-box">
                                <div class="shipping-icon">
                                    <img src="{{asset('public/frontend/images/shipping-icon/2.png')}}" alt="Shipping Icon">
                                </div>
                                <div class="shipping-text">
                                    <h2>Thanh toán an toàn</h2>
                                    {{-- <p>Pay with the world's most popular and secure payment methods.</p> --}}
                                    <p>Thanh toán bằng phương thức an toàn và bảo mật nhất</p>
                                </div>
                            </div>
                        </div>
                        <!-- Li's Shipping Inner Box Area End Here -->
                        <!-- Begin Li's Shipping Inner Box Area -->
                        <div class="col-lg-3 col-md-6 col-sm-6 pb-xs-30">
                            <div class="li-shipping-inner-box">
                                <div class="shipping-icon">
                                    <img src="{{asset('public/frontend/images/shipping-icon/3.png')}}" alt="Shipping Icon">
                                </div>
                                <div class="shipping-text">
                                    {{-- <h2>Shop with Confidence</h2>
                                    <p>Our Buyer Protection covers your purchasefrom click to delivery.</p> --}}
                                    <h2>Mua bán đảm bảo</h2>
                                    <p>Hệ thông bảo vệ người mua quản lý thanh toán của bạn từ click đến việc vận chuyển</p>
                                </div>
                            </div>
                        </div>
                        <!-- Li's Shipping Inner Box Area End Here -->
                        <!-- Begin Li's Shipping Inner Box Area -->
                        <div class="col-lg-3 col-md-6 col-sm-6 pb-xs-30">
                            <div class="li-shipping-inner-box">
                                <div class="shipping-icon">
                                    <img src="{{asset('public/frontend/images/shipping-icon/4.png')}}" alt="Shipping Icon">
                                </div>
                                <div class="shipping-text">
                                    {{-- <h2>24/7 Help Center</h2>
                                    <p>Have a question? Call a Specialist or chat online.</p> --}}
                                    <h2>Trung tâm hỗ trợ 24/7</h2>
                                    <p>Nếu có câu hỏi liên hệ đường dây nóng</p>
                                </div>
                            </div>
                        </div>
                        <!-- Li's Shipping Inner Box Area End Here -->
                    </div>
                </div>
                <!-- Footer Shipping Area End Here -->
            </div>
        </div>
        <!-- Footer Static Top Area End Here -->
        <!-- Begin Footer Static Middle Area -->
        <div class="footer-static-middle">
            <div class="container">
                <div class="footer-logo-wrap pt-50 pb-35">
                    <div class="row">
                        <!-- Begin Footer Logo Area -->
                        <div class="col-lg-4 col-md-6">
                            <div class="footer-logo">
                                <img src="{{asset('public/frontend/images/menu/logo/1.jpg')}}" alt="Footer Logo">
                                {{-- <p class="info">
                                    We are a team of designers and developers that create high quality HTML Template & Woocommerce, Shopify Theme.
                                </p> --}}
                            </div>
                            <ul class="des">
                                <li>
                                    <span>Địa chỉ: </span>
                                    Số 123 đường 456, quận 789, Hà Nội
                                </li>
                                <li>
                                    <span>Số điện thoại: </span>
                                    <a href="#">(+84) 964 027 677</a>
                                </li>
                                <li>
                                    <span>Email: </span>
                                    <a>phonestore@gmail.com</a>
                                </li>
                            </ul>
                        </div>
                        <!-- Footer Logo Area End Here -->
                        <!-- Begin Footer Block Area -->
                        <div class="col-lg-2 col-md-3 col-sm-6">
                            <div class="footer-block">
                                <h3 class="footer-block-title">Sản phẩm</h3>
                                <ul>
                                    <li><a href="#">Giảm giá</a></li>
                                    <li><a href="#">Sản phẩm mới</a></li>
                                    <li><a href="#">Bán chạy</a></li>
                                    <li><a href="#">Liên hệ</a></li>
                                </ul>
                            </div>
                        </div>
                        <!-- Footer Block Area End Here -->
                        <!-- Begin Footer Block Area -->
                        <div class="col-lg-2 col-md-3 col-sm-6">
                            <div class="footer-block">
                                <h3 class="footer-block-title">Cửa hàng</h3>
                                <ul>
                                    <li><a href="#">Vận chuyển</a></li>
                                    <li><a href="#">Thông báo pháp lý</a></li>
                                    <li><a href="#">Giới thiệu</a></li>
                                    <li><a href="#">Liên hệ</a></li>
                                </ul>
                            </div>
                        </div>
                        <!-- Footer Block Area End Here -->
                        <!-- Begin Footer Block Area -->
                        <div class="col-lg-4">
                            <div class="footer-block">
                                <h3 class="footer-block-title">Theo dõi</h3>
                                <ul class="social-link">
                                    <li class="twitter">
                                        <a href="https://twitter.com/" data-toggle="tooltip" target="_blank" title="Twitter">
                                            <i class="fa fa-twitter"></i>
                                        </a>
                                    </li>
                                    <li class="rss">
                                        <a href="https://rss.com/" data-toggle="tooltip" target="_blank" title="RSS">
                                            <i class="fa fa-rss"></i>
                                        </a>
                                    </li>
                                    <li class="google-plus">
                                        <a href="https://www.plus.google.com/discover" data-toggle="tooltip" target="_blank" title="Google Plus">
                                            <i class="fa fa-google-plus"></i>
                                        </a>
                                    </li>
                                    <li class="facebook">
                                        <a href="https://www.facebook.com/" data-toggle="tooltip" target="_blank" title="Facebook">
                                            <i class="fa fa-facebook"></i>
                                        </a>
                                    </li>
                                    <li class="youtube">
                                        <a href="https://www.youtube.com/" data-toggle="tooltip" target="_blank" title="Youtube">
                                            <i class="fa fa-youtube"></i>
                                        </a>
                                    </li>
                                    <li class="instagram">
                                        <a href="https://www.instagram.com/" data-toggle="tooltip" target="_blank" title="Instagram">
                                            <i class="fa fa-instagram"></i>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                            <!-- Begin Footer Newsletter Area -->
                            {{-- <div class="footer-newsletter">
                                <h4>Đăng ký để nhận thư</h4>
                                <form action="#" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="footer-subscribe-form validate" target="_blank" novalidate>
                                    <div id="mc_embed_signup_scroll">
                                        <div id="mc-form" class="mc-form subscribe-form form-group">
                                            <input id="mc-email" type="email" autocomplete="off" placeholder="Điền email của bạn..." />
                                            <button class="btn" id="mc-submit">Đăng ký</button>
                                        </div>
                                    </div>
                                </form>
                            </div> --}}
                            <!-- Footer Newsletter Area End Here -->
                        </div>
                        <!-- Footer Block Area End Here -->
                    </div>
                </div>
            </div>
        </div>
        <!-- Footer Static Middle Area End Here -->
        <!-- Begin Footer Static Bottom Area -->
        <div class="footer-static-bottom">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <!-- Begin Footer Links Area -->
                        <div class="footer-links">
                            {{-- <ul>
                                <li><a href="#">Online Shopping</a></li>
                                <li><a href="#">Promotions</a></li>
                                <li><a href="#">My Orders</a></li>
                                <li><a href="#">Help</a></li>
                                <li><a href="#">Customer Service</a></li>
                                <li><a href="#">Support</a></li>
                                <li><a href="#">Most Populars</a></li>
                                <li><a href="#">New Arrivals</a></li>
                                <li><a href="#">Special Products</a></li>
                                <li><a href="#">Manufacturers</a></li>
                                <li><a href="#">Our Stores</a></li>
                                <li><a href="#">Shipping</a></li>
                                <li><a href="#">Payments</a></li>
                                <li><a href="#">Warantee</a></li>
                                <li><a href="#">Refunds</a></li>
                                <li><a href="#">Checkout</a></li>
                                <li><a href="#">Discount</a></li>
                                <li><a href="#">Refunds</a></li>
                                <li><a href="#">Policy Shipping</a></li>
                            </ul> --}}
                        </div>
                        <!-- Footer Links Area End Here -->
                        <!-- Begin Footer Payment Area -->
                        <div class="copyright text-center">
                            <a href="#">
                                <img src="{{asset('public/frontend/images/payment/1.png')}}" alt="">
                            </a>
                        </div>
                        <!-- Footer Payment Area End Here -->
                        <!-- Begin Copyright Area -->
                        <div class="copyright text-center pt-25">
                            <span><a href="https://www.templatespoint.net" target="_blank">Templates Point</a></span>
                        </div>
                        <!-- Copyright Area End Here -->
                    </div>
                </div>
            </div>
        </div>
        <!-- Footer Static Bottom Area End Here -->
    </div>
    <!-- Footer Area End Here -->
    </div>
    <!-- Body Wrapper End Here -->
    <!-- jQuery-V1.12.4 -->
    <script src="https://js.stripe.com/v3/"></script>
    <script src="{{asset('public/frontend/js/vendor/jquery-1.12.4.min.js')}}"></script>
    <!-- Popper js -->
    <script src="{{asset('public/frontend/js/vendor/popper.min.js')}}"></script>
    <!-- Bootstrap V4.1.3 Fremwork js -->
    <script src="{{asset('public/frontend/js/bootstrap.min.js')}}"></script>
    <!-- Ajax Mail js -->
    <script src="{{asset('public/frontend/js/ajax-mail.js')}}"></script>
    <!-- Meanmenu js -->
    <script src="{{asset('public/frontend/js/jquery.meanmenu.min.js')}}"></script>
    <!-- Wow.min js -->
    <script src="{{asset('public/frontend/js/wow.min.js')}}"></script>
    <!-- Slick Carousel js -->
    <script src="{{asset('public/frontend/js/slick.min.js')}}"></script>
    <!-- Owl Carousel-2 js -->
    <script src="{{asset('public/frontend/js/owl.carousel.min.js')}}"></script>
    <!-- Magnific popup js -->
    <script src="{{asset('public/frontend/js/jquery.magnific-popup.min.js')}}"></script>
    <!-- Isotope js -->
    <script src="{{asset('public/frontend/js/isotope.pkgd.min.js')}}"></script>
    <!-- Imagesloaded js -->
    <script src="{{asset('public/frontend/js/imagesloaded.pkgd.min.js')}}"></script>
    <!-- Mixitup js -->
    <script src="{{asset('public/frontend/js/jquery.mixitup.min.js')}}"></script>
    <!-- Countdown -->
    <script src="{{asset('public/frontend/js/jquery.countdown.min.js')}}"></script>
    <!-- Counterup -->
    <script src="{{asset('public/frontend/js/jquery.counterup.min.js')}}"></script>
    <!-- Waypoints -->
    <script src="{{asset('public/frontend/js/waypoints.min.js')}}"></script>
    <!-- Barrating -->
    <script src="{{asset('public/frontend/js/jquery.barrating.min.js')}}"></script>
    <!-- Jquery-ui -->
    <script src="{{asset('public/frontend/js/jquery-ui.min.js')}}"></script>
    <!-- Venobox -->
    <script src="{{asset('public/frontend/js/venobox.min.js')}}"></script>
    <!-- Nice Select js -->
    <script src="{{asset('public/frontend/js/jquery.nice-select.min.js')}}"></script>
    <!-- ScrollUp js -->
    <script src="{{asset('public/frontend/js/scrollUp.min.js')}}"></script>
    <!-- Main/Activator js -->
    <script src="{{asset('public/frontend/js/main.js')}}"></script>
    <!-- Toastr -->
    <script src="{{asset('public/backend/Admin/Layout/plugins/toastr/toastr.min.js')}}"></script>
    {{-- Moment js --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js" integrity="sha512-qTXRIMyZIFb8iQcfjXWCO8+M5Tbc38Qi5WzdPOYZHIlZpzBHG3L3by84BBBOiRGiEb7KKtAOAs5qYdUiZiQNNQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <!-- SweetAlert2 -->
    <script src="{{asset('public/backend/Admin/Layout/plugins/sweetalert2/sweetalert2.min.js')}}"></script>
    <script type="text/javascript">
        @if(session('msg'))
        toastr.options = {
            "timeOut": 2000 // 3s
            // , "progressBar": true
        }
        toastr.success("{{ session('msg') }}");
        @endif

        @if(session('error'))
        toastr.options = {
            "timeOut": 2000 // 3s
            // , "progressBar": true
        }
        toastr.error("{{ session('error') }}");
        @endif

        @if(session('warning'))
        toastr.options = {
            "timeOut": 2000 // 3s
            // , "progressBar": true
        }
        toastr.warning("{{ session('warning') }}");
        @endif

    </script>
    @yield('js')
</body>

<!-- index30:23-->
</html>
