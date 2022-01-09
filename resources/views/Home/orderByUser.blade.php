 <!-- Begin Li's Breadcrumb Area -->
 @extends('layouts.home_layout')
 @section('content')
 <div class="breadcrumb-area">
    <div class="container">
        <div class="breadcrumb-content">
            <ul>
                <li><a href="index.html">Trang chủ</a></li>
                <li class="active">Đơn hàng của bạn</li>
            </ul>
        </div>
    </div>
</div>
<!-- Li's Breadcrumb Area End Here -->
<!-- Begin Li's Main Blog Page Area -->
<div class="li-main-blog-page pt-60 pb-55">
    <div class="container">
        <div class="row">
            <!-- Begin Li's Main Content Area -->
            <div class="col-lg-12 order-lg-1 order-1">
                <div class="row li-main-content">
                    @if($list_order->count() > 0)
                    @foreach ($list_order as $order)
                    <div class="col-lg-6">
                        <div class="li-blog-single-item mb-30">
                            <div class="row">
                                {{-- <div class="col-lg-6">
                                    <div class="li-blog-banner">
                                        <a href="blog-details-left-sidebar.html"><img class="img-full" src="images/blog-banner/2.jpg" alt=""></a>
                                    </div>
                                </div> --}}
                                <div class="col-lg-12">
                                    <div class="li-blog-content">
                                        <div class="li-blog-details">
                                            <h4 class="text-primary pt-xs-25 pt-sm-25"><a href="#">Đơn hàng #{{ $order->SoHDB }}</a></h4>
                                            <div class="li-blog-meta">
                                                {{-- <a class="author" href="#"><i class="fa fa-user"></i>Admin</a> --}}
                                                @if($order->TrangThai == 1)
                                                <span class="text-success"><i class="fa fa-check-circle"></i> Hoàn tất</span>
                                                @elseif($order->TrangThai == 0)
                                                <span class="text-warning"><i class="fa fa-question-circle"></i> Đang chờ xử lý</span>
                                                @elseif($order->TrangThai == -1)
                                                <span class="text-danger"><i class="fa fa-times"></i> Đã hủy</span>
                                                @endif
                                                <a class="comment" style="color:black" href="#"><i class="fa fa-mobile"></i>{{ $order->orderdetail->sum('SoLuong') }} sản phẩm</a>
                                                <a class="post-time" style="color:black" href="#"><i class="fa fa-calendar"></i>{{ date('d-m-Y H:i:s', strtotime($order->NgayDatHang)); }}</a>
                                            </div>
                                            <p>
                                                @foreach ($order->orderdetail as $detail)
                                                    <span  style="color:black">+ {{ $detail->product->TenDT }} - {{ $detail->Mau }} x {{ $detail->SoLuong }} - {{ number_format($detail->DonGiaBan) }}₫<span><br>
                                                @endforeach
                                            </p>
                                            <span class="font-weight-bold">Tổng tiền: {{ number_format($order->TongTien) }}₫</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                    @else
                    <h1>Bạn chưa có đơn hàng nào</h1>
                    @endif
                    <!-- Begin Li's Pagination Area -->
                    <div class="col-lg-12">
                        {{-- <div class="li-paginatoin-area text-center pt-25"> --}}
                        <div class="paginatoin-area">
                            <div class="row">
                                {{ $list_order->appends(request()->except('page'))->links('vendor.pagination.custom_pagination_order') }}
                            </div>
                        </div>
                    </div>
                    <!-- Li's Pagination End Here Area -->
                    
                </div>
            </div>
            <!-- Li's Main Content Area End Here -->
            {{-- <!-- Begin Li's Blog Sidebar Area -->
            <div class="col-lg-3 order-lg-2 order-2">
                <div class="li-blog-sidebar-wrapper">
                    <div class="li-blog-sidebar">
                        <div class="li-sidebar-search-form pt-xs-30 pt-sm-30">
                            <form action="#">
                                <input type="text" class="li-search-field" placeholder="search here">
                                <button type="submit" class="li-search-btn"><i class="fa fa-search"></i></button>
                            </form>
                        </div>
                    </div>
                    <div class="li-blog-sidebar pt-25">
                        <h4 class="li-blog-sidebar-title">Categories</h4>
                        <ul class="li-blog-archive">
                            <li><a href="#">Laptops (10)</a></li>
                            <li><a href="#">TV & Audio (08)</a></li>
                            <li><a href="#">reach (07)</a></li>
                            <li><a href="#">Smartphone (14)</a></li>
                            <li><a href="#">Cameras (10)</a></li>
                            <li><a href="#">Headphone (06)</a></li>
                        </ul>
                    </div>
                    <div class="li-blog-sidebar">
                        <h4 class="li-blog-sidebar-title">Blog Archives</h4>
                        <ul class="li-blog-archive">
                            <li><a href="#">January (10)</a></li>
                            <li><a href="#">February (08)</a></li>
                            <li><a href="#">March (07)</a></li>
                            <li><a href="#">April (14)</a></li>
                            <li><a href="#">May (10)</a></li>
                            <li><a href="#">June (06)</a></li>
                        </ul>
                    </div>
                    <div class="li-blog-sidebar">
                        <h4 class="li-blog-sidebar-title">Recent Post</h4>
                        <div class="li-recent-post pb-30">
                            <div class="li-recent-post-thumb">
                                <a href="blog-details-left-sidebar.html">
                                    <img class="img-full" src="images/product/small-size/3.jpg" alt="Li's Product Image">
                                </a>
                            </div>
                            <div class="li-recent-post-des">
                                <span><a href="blog-details-left-sidebar.html">First Blog Post</a></span>
                                <span class="li-post-date">25.11.2018</span>
                            </div>
                        </div>
                        <div class="li-recent-post pb-30">
                            <div class="li-recent-post-thumb">
                                <a href="blog-details-left-sidebar.html">
                                    <img class="img-full" src="images/product/small-size/2.jpg" alt="Li's Product Image">
                                </a>
                            </div>
                            <div class="li-recent-post-des">
                                <span><a href="blog-details-left-sidebar.html">First Blog Post</a></span>
                                <span class="li-post-date">25.11.2018</span>
                            </div>
                        </div>
                        <div class="li-recent-post pb-30">
                            <div class="li-recent-post-thumb">
                                <a href="blog-details-left-sidebar.html">
                                    <img class="img-full" src="images/product/small-size/5.jpg" alt="Li's Product Image">
                                </a>
                            </div>
                            <div class="li-recent-post-des">
                                <span><a href="blog-details-left-sidebar.html">First Blog Post</a></span>
                                <span class="li-post-date">25.11.2018</span>
                            </div>
                        </div>
                    </div>
                    <div class="li-blog-sidebar">
                        <h4 class="li-blog-sidebar-title">Tags</h4>
                        <ul class="li-blog-tags pb-xs-15 pb-sm-15">
                            <li><a href="#">Gaming</a></li>
                            <li><a href="#">Chromebook</a></li>
                            <li><a href="#">Refurbished</a></li>
                            <li><a href="#">Touchscreen</a></li>
                            <li><a href="#">Ultrabooks</a></li>
                            <li><a href="#">Sound Cards</a></li>  
                        </ul>
                    </div>
                </div>
            </div>
            <!-- Li's Blog Sidebar Area End Here --> --}}
        </div>
    </div>
</div>
<!-- Li's Main Blog Page Area End Here -->
@endsection