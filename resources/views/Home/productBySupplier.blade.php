@extends('layouts.home_layout')
@section('content')
<!-- Header Area End Here -->
<!-- Begin Li's Breadcrumb Area -->
<div class="breadcrumb-area">
    <div class="container">
        <div class="breadcrumb-content">
            <ul>
                <li><a href="{{ url('/main-page') }}">Trang chủ</a></li>
                <li class="active">{{ $supplier_name }}</li>
            </ul>
        </div>
    </div>
</div>
<!-- Li's Breadcrumb Area End Here -->
<!-- Begin Li's Content Wraper Area -->
<div class="content-wraper pt-60 pb-60">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <!-- Begin Li's Banner Area -->
                <div class="single-banner shop-page-banner">
                    <a href="#">
                        <img src="{{asset('public/frontend/images/bg-banner/2.jpg')}}" alt="Li's Static Banner">
                    </a>
                </div>
                <!-- Li's Banner Area End Here -->
                <!-- shop-top-bar start -->
                <div class="shop-top-bar mt-30">
                    <div class="shop-bar-inner">
                        <div class="product-view-mode">
                            <!-- shop-item-filter-list start -->
                            <ul class="nav shop-item-filter-list" role="tablist">
                                <li class="active" role="presentation"><a aria-selected="true" class="active show" data-toggle="tab" role="tab" aria-controls="grid-view" href="#grid-view"><i class="fa fa-th"></i></a></li>
                                {{-- <li role="presentation"><a data-toggle="tab" role="tab" aria-controls="list-view" href="#list-view"><i class="fa fa-th-list"></i></a></li> --}}
                            </ul>
                            <!-- shop-item-filter-list end -->
                        </div>
                        <div class="toolbar-amount">
                            {{-- <span>Showing 1 to 9 of 15</span> --}}
                        </div>
                    </div>
                    <!-- product-select-box start -->
                    <div class="product-select-box">
                        <div class="product-short">
                            <p>Sắp xếp theo:</p>
                            <select class="nice-select" onchange="location = this.value;">
                                <option value="?sortBy=name_asc" {{ (request('sortBy') == 'name_asc' ? 'selected' : '') }}>Tên (A - Z)</option>
                                <option value="?sortBy=name_desc" {{ (request('sortBy') == 'name_desc' ? 'selected' : '') }}>Tên (Z - A)</option>
                                <option value="?sortBy=price_asc" {{ (request('sortBy') == 'price_asc' ? 'selected' : '') }}>Giá bán (Thấp &gt; Cao)</option>
                                <option value="?sortBy=price_desc" {{ (request('sortBy') == 'price_desc' ? 'selected' : '') }}>Giá bán (Cao &gt; Thấp)</option>
                                <option value="?sortBy=rating" {{ (request('sortBy') == 'rating' ? 'selected' : '') }}>Đánh giá (Cao &gt; Thấp)</option>
                            </select>
                        </div>
                    </div>
                    <!-- product-select-box end -->
                </div>
                <!-- shop-top-bar end -->
                <!-- shop-products-wrapper start -->
                <div class="shop-products-wrapper">
                    <div class="tab-content">
                        <div id="grid-view" class="tab-pane fade active show" role="tabpanel">
                            <div class="product-area shop-product-area">
                                <div class="row">
                                    @if($product->count()==0)
                                    <div class="col-md-6 offset-md-3 mt-40">
                                        <h4 class="text-danger">Nhà cung cấp này hiện chưa có sản phẩm nào</h4>
                                    </div>
                                    @else
                                    @foreach ($product as $item)
                                    <div class="col-lg-3 col-md-4 col-sm-6 mt-40">
                                        <!-- single-product-wrap start -->
                                        <div class="single-product-wrap">
                                            <div class="product-image">
                                                <a href="{{ url('product-detail/'.$item->MaDT) }}">
                                                    <img src="{{asset('public/backend/uploads/product-images/'.$item->image[0]->Anh)}}">
                                                </a>
                                            </div>
                                            <div class="product_desc">
                                                <div class="product_desc_info">
                                                    <div class="product-review">
                                                        <h5 class="manufacturer">
                                                            <a href="product-details.html">{{ $item->supplier->TenNSX }}</a>
                                                        </h5>
                                                        <div class="rating-box">
                                                            <ul class="rating">
                                                                @for($i = 0; $i < 5; $i++) @if($i <floor($item->DanhGia))
                                                                    <li><i class="fa fa-star-o"></i></li>
                                                                    @else
                                                                    <li class="no-star"><i class="fa fa-star-o"></i></li>
                                                                    @endif
                                                                    @endfor
                                                            </ul>
                                                        </div>
                                                    </div>
                                                    <h4><a class="product_name" href="single-product.html">{{ $item->TenDT }}</a></h4>
                                                    <div class="price-box">
                                                        @if($item->quantity->count() >0 )
                                                        <span class="new-price">{{ number_format($item->quantity[0]->DonGiaBan) }}₫</span>
                                                        @else
                                                        <span class="new-price text-danger">Liên hệ</span>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="add-actions">
                                                    <ul class="add-actions-link">
                                                        {{-- <li class="add-cart active"><a href="{{ url('product-detail/'.$item->MaDT) }}">Xem chi tiết</a></li> --}}
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- single-product-wrap end -->
                                    </div>
                                    @endforeach
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="paginatoin-area mt-100">
                            <div class="row">
                                {{-- <div class="col-lg-6 col-md-6">
                                    <p>Showing 1-12 of 13 item(s)</p>
                                </div>
                                <div class="col-lg-6 col-md-6">
                                    <ul class="pagination-box">
                                        <li><a href="#" class="Previous"><i class="fa fa-chevron-left"></i> Previous</a>
                                        </li>
                                        <li class="active"><a href="#">1</a></li>
                                        <li><a href="#">2</a></li>
                                        <li><a href="#">3</a></li>
                                        <li>
                                            <a href="#" class="Next"> Next <i class="fa fa-chevron-right"></i></a>
                                        </li>
                                    </ul>
                                </div> --}}
                                {{ $product->appends(request()->except('page'))->links('vendor.pagination.custom') }}
                            </div>
                        </div>
                    </div>
                </div>
                <!-- shop-products-wrapper end -->
            </div>
        </div>
    </div>
</div>
<!-- Content Wraper Area End Here -->
@endsection
