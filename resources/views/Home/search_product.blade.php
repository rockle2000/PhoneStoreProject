@extends('layouts.home_layout')
@section('content')
{{-- <a href="{{ url('/') }}" class="btn btn-primary mt-2">Trở lại</a>
<p>Tìm thấy {{ count($product) }} kết quả với từ khóa {{ $keyWord }}</p>
<div class="row">
    @foreach ($product as $s)
    <div class="col-md-3 mb-2">
        <div class="border shadow rounded h-100">
            <img width="100%" style="object-fit:cover " src="{{ asset('public/backend/uploads/product-images/'.$s->Anh) }}">
            <div class="px-2 pb-2">
                <a class="text-dark  text-decoration-none" href="{{ url('product-detail/' . $s->MaDT) }}">
                    {{ $s->TenDT }}
                    <b class="text-danger d-block">{{ number_format($s->DonGiaBan) }}₫</b>
                </a>
                <a href="{{ route('user.addToCart' ,['id' => $s->MaDT]) }}" class="btn d-block btn-warning ">Thêm vào
                    giỏ hàng</a>
            </div>
        </div>
    </div>
    @endforeach
</div> --}}


<div class="breadcrumb-area">
    <div class="container">
        <div class="breadcrumb-content">
            <ul>
                <li><a href="index.html">Trang chủ</a></li>
                <li class="active">Tìm kiếm</li>
            </ul>
        </div>
    </div>
</div>
<!-- Li's Breadcrumb Area End Here -->
<!-- Begin Li's Content Wraper Area -->
<div class="content-wraper pb-60">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <!-- shop-top-bar start -->
                <div class="shop-top-bar mt-30">
                    <div class="shop-bar-inner">
                        <div class="product-view-mode">
                            <!-- shop-item-filter-list start -->
                            <ul class="nav shop-item-filter-list" role="tablist">
                                <li class="active" role="presentation"><a aria-selected="true" class="active show" data-toggle="tab" role="tab" aria-controls="list-view" href="#list-view"><i class="fa fa-th"></i></a></li>
                            </ul>
                            <!-- shop-item-filter-list end -->
                        </div>
                        <div class="toolbar-amount">
                            <span class="h6">Tìm thấy {{ $result_found }} kết quả với từ khóa <span class="text-danger">{{ $keyWord }}</span></span>
                        </div>
                    </div>
                    <!-- product-select-box start -->
                    {{-- <div class="product-select-box">
                        <div class="product-short">
                            <p>Sort By:</p>
                            <select class="nice-select">
                                <option value="trending">Relevance</option>
                                <option value="sales">Name (A - Z)</option>
                                <option value="sales">Name (Z - A)</option>
                                <option value="rating">Price (Low &gt; High)</option>
                                <option value="date">Rating (Lowest)</option>
                                <option value="price-asc">Model (A - Z)</option>
                                <option value="price-asc">Model (Z - A)</option>
                            </select>
                        </div>
                    </div> --}}
                    <!-- product-select-box end -->
                </div>
                <!-- shop-top-bar end -->
                <!-- shop-products-wrapper start -->
                <div class="shop-products-wrapper">
                    <div class="tab-content">
                        <div id="list-view" class="tab-pane product-list-view fade active show" role="tabpanel">
                            <div class="row">
                                <div class="col">
                                    @foreach ($product as $s)
                                    <div class="row product-layout-list">
                                        <div class="col-lg-3 col-md-5 ">
                                            <div class="product-image">
                                                <a href="{{ url('product-detail/'.$s->MaDT) }}" class="pb-20">
                                                    {{-- <img src="images/product/large-size/12.jpg" alt="Li's Product Image"> --}}
                                                    <img src="{{ asset('public/backend/uploads/product-images/'.$s->image[0]->Anh)}}" alt="Product's Image">
                                                </a>
                                                {{-- <span class="sticker">New</span> --}}
                                            </div>
                                        </div>
                                        <div class="col-lg-8 col-md-7">
                                            <div class="product_desc">
                                                <div class="product_desc_info">
                                                    <div class="product-review">
                                                        <h3 class="manufacturer">
                                                            <a style="font-size: 20px" href="{{ url('productBySupplier/'.$s->supplier->MaNSX) }}">{{ $s->supplier->TenNSX }}</a>
                                                        </h3>
                                                        <div class="rating-box ">
                                                            <ul class="rating">
                                                                @for($i = 0; $i < 5; $i++) @if($i <floor($s->DanhGia))
                                                                    <li><i class="fa fa-star-o"></i></li>
                                                                    @else
                                                                    <li class="no-star"><i class="fa fa-star-o"></i></li>
                                                                    @endif
                                                                    @endfor

                                                            </ul>
                                                        </div>
                                                    </div>
                                                    <h4><a style="font-size: 20px" class="product_name" href="{{ url('product-detail/'.$s->MaDT) }}">{{ $s->TenDT}}</a></h4>
                                                    <div class="price-box">
                                                        <span style="font-size: 20px" class="new-price text-danger">{{ number_format($s->quantity[0]->DonGiaBan) }}₫</span>
                                                    </div>
                                                    
                                                    {{-- <p>Beach Camera Exclusive Bundle - Includes Two Samsung Radiant 360
                                                        R3 Wi-Fi Bluetooth Speakers. Fill The Entire Room With Exquisite
                                                        Sound via Ring Radiator Technology. Stream And Control R3
                                                        Speakers Wirelessly With Your Smartphone. Sophisticated, Modern
                                                        Desig</p> --}}
                                                    {{-- <p>{!! Str::limit('Beach Camera Exclusive Bundle - Includes Two Samsung Radiant 360
                                                        R3 Wi-Fi Bluetooth Speakers. Fill The Entire Room With Exquisite
                                                        Sound via Ring Radiator Technology. Stream And Control R3
                                                        Speakers Wirelessly With Your Smartphone. Sophisticated, Modern
                                                        Desig', 200, ' ...') !!}</p> --}}
                                                </div>
                                            </div>
                                        </div>
                                        {{-- <div class="col-lg-4">
                                            <div class="shop-add-action mb-xs-30">
                                                <ul class="add-actions-link">
                                                    <li class="add-cart"><a href="{{ url('product-detail/'.$s->MaDT) }}">Chi tiết</a></li>
                                                    <li class="wishlist"><a href="wishlist.html"><i class="fa fa-heart-o"></i>Add to wishlist</a></li>
                                                    <li><a class="quick-view" data-toggle="modal" data-target="#exampleModalCenter" href="#"><i class="fa fa-eye"></i>Quick view</a></li>
                                                </ul>
                                            </div>
                                        </div> --}}
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <div class="paginatoin-area">
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
                                {{ $product->appends(request()->except(['page','_token']))->links('vendor.pagination.custom') }}
                            </div>
                        </div>
                    </div>
                </div>
                <!-- shop-products-wrapper end -->
            </div>
        </div>
    </div>
</div>
@endsection
