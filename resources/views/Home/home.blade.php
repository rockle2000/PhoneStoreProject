@extends('layouts.home_layout')
@section('css')

@endsection
@section('content')
<!-- Begin Slider With Banner Area -->
<div class="slider-with-banner">
    <div class="container">
        <div class="row">
            <!-- Begin Slider Area -->
            <div class="col-lg-8 col-md-8">
                <div class="slider-area">
                    <div class="slider-active owl-carousel">
                        @if($slide->count() == 2)
                        @foreach ($slide as $slide)
                        <div class="single-slide align-center-left  animation-style-01 bg-1" style="background-image: url('{{ asset('public/backend/uploads/banners/'.$slide->Anh)}}');">
                            <div class="slider-progress"></div>
                            <div class="slider-content">
                                <h5>{!! $slide->NoiDung !!}</h5>
                                <div class="default-btn slide-btn">
                                    <a class="links" href="#">Mua ngay</a>
                                </div>
                            </div>
                        </div>
                        @endforeach
                        @else
                        <div class="single-slide align-center-left animation-style-01 bg-1" style="background-size: 100% 100%; background-image: url('{{ asset('public/frontend/images/banner/slide_default.png')}}');">
                            <div class="slider-progress"></div>
                        </div>
                        <div class="single-slide align-center-left animation-style-01 bg-1"  style="background-size: 100% 100%; background-image: url('{{ asset('public/frontend/images/banner/slide_default_2.png')}}');">
                            <div class=" slider-progress"></div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
            <!-- Slider Area End Here -->
            <!-- Begin Li Banner Area -->
            <div class="col-lg-4 col-md-4 text-center pt-xs-30">
                @if($top_banner->count() >=2)
                    @foreach ($top_banner as $top)
                    @if($loop->first)
                        <div class="li-banner">
                            <a href="#">
                                <img src="{{ asset('public/backend/uploads/banners/'.$top->Anh)}}" alt="">
                            </a>
                        </div>
                    @endif
                    @if($loop->last)
                        <div class="li-banner mt-15 mt-sm-30 mt-xs-30">
                            <a href="#">
                                <img src="{{asset('public/backend/uploads/banners/'.$top->Anh)}}" alt="">
                            </a>
                        </div>
                    @endif
                    @endforeach
                @else
                    <div class="li-banner">
                        <a href="#">
                            <img src="{{  asset('public/frontend/images/banner/top_banner_1.png')}}" alt="">
                        </a>
                    </div>
                    <div class="li-banner mt-15 mt-sm-30 mt-xs-30">
                        <a href="#">
                            <img src="{{ asset('public/frontend/images/banner/top_banner_2.png')}}" alt="">
                        </a>
                    </div>
                @endif
            </div>
            <!-- Li Banner Area End Here -->
        </div>
    </div>
</div>
<!-- Slider With Banner Area End Here -->
<!-- Begin Product Area -->
<div class="product-area pt-60 pb-50">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="li-product-tab">
                    <ul class="nav ">
                        <div class="li-section-title">
                            <h2>
                                <span>BestSeller</span>
                            </h2>
                        </div>
                        {{-- <li><a class="active" data-toggle="tab" href="#li-new-product"><span>New Arrival</span></a></li> --}}
                        {{-- <li><a class="active" data-toggle="tab" href="#li-bestseller-product"><h6>BestSeller</h6></a></li> --}}
                        {{-- <li><a data-toggle="tab" href="#li-featured-product"><span>Featured Products</span></a></li> --}}
                    </ul>
                </div>
                <!-- Begin Li's Tab Menu Content Area -->
            </div>
        </div>
        <div class="tab-content">
            <div id="li-bestseller-product" class="tab-pane active show" role="tabpanel">
                <div class="row">
                    <div class="product-active owl-carousel">
                        @foreach ($bestSeller as $best)
                        <div class="col-lg-12">
                            <!-- single-product-wrap start -->
                            <div class="single-product-wrap">
                                <div class="product-image">
                                    <a href="{{ url('product-detail/'.$best->MaDT) }}">
                                        <img src="{{ asset('public/backend/uploads/product-images/'.$best->image[0]->Anh)}}" alt="Product's Image">
                                    </a>
                                    <span class="sticker" style="background-color: red">Hot</span>
                                </div>
                                <div class="product_desc">
                                    <div class="product_desc_info">
                                        <div class="product-review">
                                            <h5 class="manufacturer">
                                                <a href="{{ url('productBySupplier/'. $best->supplier->MaNSX) }}">{{ $best->supplier->TenNSX }}</a>
                                            </h5>
                                            <div class="rating-box">
                                                <ul class="rating">
                                                    @for($i = 0; $i < 5; $i++) @if($i <floor($best->DanhGia))
                                                        <li><i class="fa fa-star-o"></i></li>
                                                        @else
                                                        <li class="no-star"><i class="fa fa-star-o"></i></li>
                                                        @endif
                                                        @endfor
                                                </ul>
                                            </div>
                                        </div>
                                        <h4><a class="product_name" href="{{  url('product-detail/'.$best->MaDT) }}">{{$best->TenDT}}</a></h4>
                                        <div class="price-box">
                                            @if($best->quantity->count() >0)
                                            <span class="new-price">{{ number_format($best->quantity[0]->DonGiaBan) }}₫</span>
                                            @else
                                            <span class="new-price">Đang cập nhật</span>
                                            @endif
                                            <a href="#" class="float-right" onclick="return Detail('{{ $best->MaDT }}',this)" title="Xem nhanh" class="quick-view-btn" data-toggle="modal" data-target="#exampleModalCenter"><i class="fa fa-eye"></i></a>
                                        </div>
                                        
                                    </div>
                                    {{-- <div class="add-actions">
                                        <ul class="add-actions-link">
                                            
                                            @if($best->quantity->count() >0 && $best->quantity[0]->SoLuong >0)
                                            <li class="add-cart active" style="width:150px"><a href={{ url('product-detail/'.$best->MaDT) }}>Xem chi tiết</a></li>
                                            @endif
                                            <li><a class="links-details" title="Xem chi tiết" href="{{url('product-detail/'.$best->MaDT)}}"><i class="fa fa-info"></i></a></li>
                                            <li><a href="#" onclick="return Detail('{{ $best->MaDT }}',this)" title="Xem nhanh" class="quick-view-btn" data-toggle="modal" data-target="#exampleModalCenter"><i class="fa fa-eye"></i></a></li>
                                        </ul>
                                    </div> --}}
                                </div>
                            </div>
                            <!-- single-product-wrap end -->
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
<!-- Product Area End Here -->
<!-- Begin Li's Static Banner Area -->
<div class="li-static-banner ">
    <div class="container">
        <div class="row">
            <!-- Begin Single Banner Area -->
            @if($mid_banner->count() >= 3)
            @foreach ($mid_banner as $mid)
            <div class="col-lg-4 col-md-4 text-center">
                <div class="single-banner">
                    <a href="#">
                        <img src="{{asset('public/backend/uploads/banners/'.$mid->Anh)}}" alt="Li's Static Banner">
                    </a>
                </div>
            </div>
            @endforeach
            @else
            <div class="col-lg-4 col-md-4 text-center">
                <div class="single-banner">
                    <a href="#">
                        <img src="{{asset('public/frontend/images/banner/2_1.jpg')}}" alt="Li's Static Banner">
                    </a>
                </div>
            </div>
            <div class="col-lg-4 col-md-4 text-center">
                <div class="single-banner">
                    <a href="#">
                        <img src="{{asset('public/frontend/images/banner/2_2.jpg')}}" alt="Li's Static Banner">
                    </a>
                </div>
            </div>
            <div class="col-lg-4 col-md-4 text-center">
                <div class="single-banner">
                    <a href="#">
                        <img src="{{asset('public/frontend/images/banner/2_4.jpg')}}" alt="Li's Static Banner">
                    </a>
                </div>
            </div>
            @endif
        </div>
    </div>
</div>
<!-- Li's Static Banner Area End Here -->
<!-- Begin Li's Laptop Product Area -->
@if(count($first_list)>0)
<section class="product-area li-laptop-product pt-60 pb-45">
    <div class="container">
        <div class="row">
            <!-- Begin Li's Section Area -->
            <div class="col-lg-12">
                <div class="li-section-title">
                    <h2>
                        <span>{{ $first_list[0]->supplier->TenNSX }}</span>
                    </h2>
                    <ul class="li-sub-category-list">
                    </ul>
                </div>
                <div class="row">
                    <div class="product-active owl-carousel">
                        @foreach($first_list as $item)
                        <div class="col-lg-12">
                            <!-- single-product-wrap start -->
                            <div class="single-product-wrap">
                                <div class="product-image">
                                    <a href="{{  url('product-detail/'.$item->MaDT) }}">
                                        <img src="{{ asset('public/backend/uploads/product-images/'.$item->image[0]->Anh)}}" alt="">
                                    </a>
                                    <span class="sticker">New</span>
                                </div>
                                <div class="product_desc">
                                    <div class="product_desc_info">
                                        <div class="product-review">
                                            <h5 class="manufacturer">
                                                <a href="{{ url('productBySupplier/'. $item->supplier->MaNSX) }}">{{$item->supplier->TenNSX}}</a>
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
                                        <h4><a class="product_name" href="{{  url('product-detail/'.$item->MaDT) }}">{{$item->TenDT}}</a></h4>
                                        <div class="price-box">
                                            @if($item->quantity->count() >0)
                                            <span class="new-price">{{ number_format($item->quantity[0]->DonGiaBan) }}₫</span>
                                            @else
                                            <span class="new-price text-danger">Đang cập nhật</span>
                                            @endif
                                            <a href="#" class="float-right" onclick="return Detail('{{ $item->MaDT }}',this)" title="Xem nhanh" class="quick-view-btn" data-toggle="modal" data-target="#exampleModalCenter"><i class="fa fa-eye"></i></a>
                                        </div>
                                    </div>
                                    {{-- <div class="add-actions">
                                        <ul class="add-actions-link">
                                             @if($item->quantity->count() >0 && $item->quantity[0]->SoLuong >0) 
                                             <li class="add-cart active"><a href="{{route('user.addToCart',['id' => $item->MaDT])}}">Mua ngay</a></li> 
                                             @endif 
                                            <li class="add-cart active" style="width:150px"><a href={{ url('product-detail/'.$best->MaDT) }}>Xem chi tiết</a></li>
                                            <li><a class="links-details" title="Xem chi tiết" href="{{url('product-detail/'.$item->MaDT)}}"><i class="fa fa-info"></i></a></li>
                                            <li><a href="#" onclick="return Detail('{{ $item->MaDT }}',this)" title="Xem nhanh" class="quick-view-btn" data-toggle="modal" data-target="#exampleModalCenter"><i class="fa fa-eye"></i></a></li>
                                        </ul>
                                    </div> --}}
                                </div>
                            </div>
                            <!-- single-product-wrap end -->
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <!-- Li's Section Area End Here -->
        </div>
    </div>
</section>
@endif
<!-- Li's Laptop Product Area End Here -->
<!-- Begin Li's TV & Audio Product Area -->
@if(count($second_list)>0)
<section class="product-area li-laptop-product li-tv-audio-product pb-45">
    <div class="container">
        <div class="row">
            <!-- Begin Li's Section Area -->
            <div class="col-lg-12">
                <div class="li-section-title">
                    <h2>
                        <span>{{ $second_list[0]->supplier->TenNSX }}</span>
                    </h2>
                    <ul class="li-sub-category-list">
                    </ul>
                </div>
                <div class="row">
                    <div class="product-active owl-carousel">
                        @foreach($second_list as $item)
                        <div class="col-lg-12">
                            <!-- single-product-wrap start -->
                            <div class="single-product-wrap">
                                <div class="product-image">
                                    <a href="{{  url('product-detail/'.$item->MaDT) }}">
                                        <img src="{{ asset('public/backend/uploads/product-images/'.$item->image[0]->Anh)}}" alt="">
                                    </a>
                                    <span class="sticker">New</span>
                                </div>
                                <div class="product_desc">
                                    <div class="product_desc_info">
                                        <div class="product-review">
                                            <h5 class="manufacturer">
                                                <a href="{{ url('productBySupplier/'. $item->supplier->MaNSX) }}">{{$item->supplier->TenNSX}}</a>
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
                                        <h4><a class="product_name" href="{{  url('product-detail/'.$item->MaDT) }}">{{$item->TenDT}}</a></h4>
                                        <div class="price-box">
                                            @if($item->quantity->count() >0)
                                            <span class="new-price">{{ number_format($item->quantity[0]->DonGiaBan) }}₫</span>
                                            @else
                                            <span class="new-price text-danger">Đang cập nhật</span>
                                            @endif
                                            <a href="#" class="float-right" onclick="return Detail('{{ $item->MaDT }}',this)" title="Xem nhanh" class="quick-view-btn" data-toggle="modal" data-target="#exampleModalCenter"><i class="fa fa-eye"></i></a>
                                        </div>
                                    </div>
                                    {{-- <div class="add-actions">
                                        <ul class="add-actions-link">
                                            @if($item->quantity->count() >0 && $item->quantity[0]->SoLuong >0)
                                            <li class="add-cart active"><a href="{{route('user.addToCart',['id' => $item->MaDT])}}">Mua ngay</a></li>
                                            @endif
                                            <li><a class="links-details" title="Xem chi tiết" href="{{url('product-detail/'.$item->MaDT)}}"><i class="fa fa-info"></i></a></li>
                                            <li><a href="#" onclick="return Detail('{{ $item->MaDT }}',this)" title="Xem nhanh" class="quick-view-btn" data-toggle="modal" data-target="#exampleModalCenter"><i class="fa fa-eye"></i></a></li>
                                        </ul>
                                    </div> --}}
                                </div>
                            </div>
                            <!-- single-product-wrap end -->
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <!-- Li's Section Area End Here -->
        </div>
    </div>
</section>
@endif
<!-- Li's TV & Audio Product Area End Here -->
<!-- Begin Li's Static Home Area -->
<div class="li-static-home mb-50">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <!-- Begin Li's Static Home Image Area -->
                @if($bottom_banner)
                <div class="li-static-home-image" style="background-image: url('{{ asset('public/backend/uploads/banners/'.$bottom_banner->Anh)}}');"></div>
                @else
                <div class="li-static-home-image" style="background-image: url('{{ asset('public/frontend/images/banner/bottom_banner.png')}}');"></div>
                @endif
                <!-- Li's Static Home Image Area End Here -->
            </div>
        </div>
    </div>
</div>
<!-- Li's Static Home Area End Here -->

<!-- Begin Quick View | Modal Area -->
<div class="modal fade modal-wrapper" id="exampleModalCenter">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <div class="modal-inner-area row">
                    <div class="col-lg-5 col-md-6 col-sm-6">
                        <!-- Product Details Left -->
                        <div class="product-details-left">
                            <div class="product-details-images slider-navigation-1">
                            </div>
                            <div class="product-details-thumbs slider-thumbs-1">

                            </div>
                        </div>
                        <!--// Product Details Left -->
                    </div>

                    <div class="col-lg-7 col-md-6 col-sm-6">
                        <div class="product-details-view-content pt-60">
                            <div class="product-info">
                                <span class="h6">Tên sản phẩm: </span>
                                <h2 style="display:inline" id="product_name"></h2><br /><br />
                                <span class="h6">Hãng: </span><span class="" id="product_brand"></span>
                                <div class="rating-box pt-20">
                                    Đánh giá:
                                    <ul style="display:inline" class="rating rating-with-review-item">

                                    </ul>
                                </div>
                                <div class="price-box pt-20">
                                    <span class="new-price new-price-2 product_price">Giá bán: </span><span class="new-price new-price-2 product_price" id="product_price"></span>
                                </div>
                                <div class="product-desc">
                                  
                                </div>
                                <div class="single-add-to-cart">
                                    <div class="cart-quantity" id="frm_detail">
                                        <a class="add-to-cart" href="#">Xem chi tiết</a>
                                    </div>
                                </div>
                                <div class="product-additional-info pt-25">
                                    <div class="product-social-sharing pt-25">
                                        <ul>
                                            <li class="facebook"><a href="#"><i class="fa fa-facebook"></i>Facebook</a></li>
                                            <li class="twitter"><a href="#"><i class="fa fa-twitter"></i>Twitter</a></li>
                                            <li class="google-plus"><a href="#"><i class="fa fa-google-plus"></i>Google +</a></li>
                                            <li class="instagram"><a href="#"><i class="fa fa-instagram"></i>Instagram</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Quick View | Modal Area End Here -->
@endsection

@section('js')
<script type="text/javascript">

    function ClearModal(){
        $('.modal-body #product_code').html('');
        $('.modal-body #product_name').html('');
        $('.modal-body #product_brand').html('');
        $('.modal-body #product_price').html('');
        $('.modal-body ul.rating-with-review-item').html('');
        $('#exampleModalCenter .product-details-images').html('');
        $('.modal-body .product-details-thumbs').html('');
    }
    function Detail(id, ctl) {
        ClearModal();
        $.ajax({
            type: 'GET'
            , headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('value')
            }
            , url: '/Group8_PhoneStore/json/product-detail/' + id
            , success: function(result) {
                if (result.status == 'success') {
                    $('.modal-body #product_code').html(result.message.MaDT);
                    $('.modal-body #product_name').html(result.message.TenDT);
                    $('.modal-body #product_brand').html(result.message.supplier.TenNSX);
                    if(result.message.quantity != '')
                        $('.modal-body #product_price').html(result.message.quantity[0].DonGiaBan.toLocaleString('en') + '₫');
                    else
                        $('.modal-body #product_price').html('Đang cập nhật');
                    var rating_score = '';
                    for (var i = 0; i < 5; i++) {
                        if (i < Math.floor(result.message.DanhGia)) {
                            rating_score += '<li><i class="fa fa-star-o"></i></li>';
                        } else {
                            rating_score += '<li class="no-star"><i class="fa fa-star-o"></i></li>';
                        }
                    }
                    $('.modal-body ul.rating-with-review-item').html(rating_score);
                    var detail_link = '{{url("product-detail")}}';
                    $('.modal #frm_detail').html('<a class="btn add-to-cart" href="'+detail_link+'/'+id+'">Xem chi tiêt</a>');
                    // console.log("success");
                    // console.log(result.message);
                    // console.log(result.message.image);
                    var lg_image = '';
                    var sm_image = '';
                    var base_url = '{{ asset("public/backend/uploads/product-images") }}';
                    result.message.image.forEach(element => {
                        lg_image += '<div class="lg-image"><img src="' + base_url + '/' + element.Anh + '" alt="product image"></div>'
                        sm_image += '<div class="sm-image"><img src="' + base_url + '/' + element.Anh + '" alt="product image thumb"></div>'
                    });
                    $('.slider-navigation-1').slick('removeSlide', null, null, true);
                    $('.slider-thumbs-1').slick('removeSlide', null, null, true);
                    $('.modal-body .product-details-images').html(lg_image);
                    $('.slider-navigation-1')[0].slick.refresh();
                    $('.modal-body .product-details-thumbs').html(sm_image);
                    $('.slider-thumbs-1')[0].slick.refresh();
                } else {
                    ShowAlert('Lỗi...', result.message, 'error');
                    ClearModal();
                    console.log("error");
                    console.log(result.message);
                }
            }
        }).fail(function(data) {
            ClearModal();
            ShowAlert('Lỗi...', 'Đã xảy ra lỗi', 'error');
            console.log("Failed");
        });
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
