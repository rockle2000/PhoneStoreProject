@extends('layouts.home_layout')
@section('css')
<!-- Toastr -->
<link rel="stylesheet" href="{{asset('public/backend/Admin/Layout/plugins/toastr/toastr.min.css')}}">
<!-- SweetAlert2 -->
<link rel="stylesheet" href="{{asset('public/backend/Admin/Layout/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css')}}">
@endsection

@section('content')
<!-- Begin Li's Breadcrumb Area -->
<div class="breadcrumb-area">
    <div class="container">
        <div class="breadcrumb-content">
            <ul>
                <li><a href="{{ url('main-page') }}">Trang chủ</a></li>
                <li class="active"><a href="{{ url('productBySupplier/'. $product->supplier->MaNSX) }}">{{ $product->supplier->TenNSX }}</a></li>
                <li class="active">{{ $product->TenDT }}</li>
            </ul>
        </div>
    </div>
</div>
<!-- Li's Breadcrumb Area End Here -->
<!-- content-wraper start -->
<div class="content-wraper">
    <div class="container">
        <div class="row single-product-area">
            <div class="col-lg-5 col-md-6">
                <!-- Product Details Left -->
                <div class="product-details-left">
                    <div class="product-details-images slider-navigation-1">
                        @foreach ($product->image as $image)
                        <div class="lg-image">
                            <a class="popup-img venobox vbox-item" href="{{ asset('public/backend/uploads/product-images/'.$image->Anh) }}" data-gall="myGallery">
                                <img src="{{asset('public/backend/uploads/product-images/'.$image->Anh)}}" alt="product image">
                            </a>
                        </div>
                        @endforeach


                    </div>
                    <div class="product-details-thumbs slider-thumbs-1">
                        @foreach ($product->image as $image)
                        <div class="sm-image"><img src="{{asset('public/backend/uploads/product-images/'.$image->Anh)}}" alt="product image thumb"></div>
                        @endforeach
                    </div>
                </div>
                <!--// Product Details Left -->
            </div>

            <div class="col-lg-7 col-md-6">
                <div class="product-details-view-content pt-60">
                    <div class="product-info">
                        <h2>Tên sản phẩm: {{ $product->TenDT}}</h2>
                        <span class="product-details-ref" style="font-size: 16px; color:black">Nhà sản xuất: {{ $product->supplier->TenNSX }}</span>
                        <div class="rating-box pt-20">
                            <ul class="rating rating-with-review-item ">
                                <span class="h5"> Đánh giá:</span>
                                @for($i = 0; $i < 5; $i++) @if($i <floor($product->DanhGia))
                                    <li class="star-large"><i class="fa fa-star-o"></i></li>
                                    @else
                                    <li class="no-star star-large"><i class="fa fa-star-o"></i></li>
                                    @endif
                                    @endfor
                            </ul>
                        </div>
                        <div class="price-box pt-20">
                            <span class="new-price new-price-2">Giá bán:</span>
                            @if($product->quantity->count() >0)
                            <span class="new-price new-price-2" id="product_price">{{ number_format($product->quantity[0]->DonGiaBan) }}₫</span>
                            @else
                            <span class="new-price new-price-2" id="product_price">Đang cập nhật</span>
                            @endif
                        </div>
                        <div class="product-desc">
                            {{-- <p>
                                <span>100% cotton double printed dress. Black and white striped top and orange high waisted skater
                                    skirt bottom. Lorem ipsum dolor sit amet, consectetur adipisicing elit. quibusdam corporis, earum
                                    facilis et nostrum dolorum accusamus similique eveniet quia pariatur.
                                </span>
                            </p> --}}
                        </div>
                        @if($product->quantity->count() >0 )
                        Số lượng trong kho: 
                        @if($product->quantity[0]->SoLuong > 0)
                        <span id="product_instock">{{ $product->quantity[0]->SoLuong }}</span>
                        @elseif($product->quantity[0]->SoLuong == 0)
                        <span id="product_instock"><span class="text-danger">Đã hết hàng</span></span>
                        @endif
                        {{-- <form action="{{route('user.addToCart',['id' => $product->MaDT])}}" class="cart-quantity" method="get"> --}}
                            @else
                            Số lượng trong kho: <span id="product_instock">Đang cập nhật</span>
                            @endif
                            <form action="{{route('user.addToCart',['id' => $product->MaDT])}}" class="cart-quantity" method="get">
                                @csrf
                                <div class="product-variants mt-1">
                                    <div class="produt-variants-size">
                                        @if($product->quantity->count() >0)
                                        <label><strong>Màu sắc</strong></label>
                                        <select class="nice-select" id="ddlColor" name="color">
                                            @foreach ($product->quantity as $item)
                                            {{-- @if($item->SoLuong >0) --}}
                                            <option value="{{ $item->Mau }}">{{ $item->Mau }}</option>
                                            {{-- @endif --}}
                                            @endforeach
                                        </select>
                                        @endif
                                    </div>
                                </div>
                                @if($product->quantity->count() >0)
                                <div class="single-add-to-cart">
                                    <div class="quantity">
                                        <label>Số lượng</label>
                                        <div class="cart-plus-minus">
                                            <input class="cart-plus-minus-box" value="{{ !old('qtyproduct') ? 1 : old('qtyproduct') }}" type="text" name="qtyproduct">
                                            <div class="dec qtybutton"><i class="fa fa-angle-down"></i></div>
                                            <div class="inc qtybutton"><i class="fa fa-angle-up"></i></div>
                                        </div>
                                    </div>
                                    <button class="add-to-cart" type="submit">Thêm vào giỏ hàng</button>
                                </div>
                                @endif
                            </form>
                            <div class="product-additional-info pt-25">
                                {{-- <a class="wishlist-btn" href="wishlist.html"><i class="fa fa-heart-o"></i>Add to wishlist</a> --}}
                                <div class="product-social-sharing pt-25">
                                    <ul>
                                        <li class="facebook"><a href="#"><i class="fa fa-facebook"></i>Facebook</a></li>
                                        <li class="twitter"><a href="#"><i class="fa fa-twitter"></i>Twitter</a></li>
                                        <li class="google-plus"><a href="#"><i class="fa fa-google-plus"></i>Google +</a></li>
                                        <li class="instagram"><a href="#"><i class="fa fa-instagram"></i>Instagram</a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="block-reassurance">
                                <ul>
                                    <li>
                                        <div class="reassurance-item">
                                            <div class="reassurance-icon">
                                                <i class="fa fa-check-square-o"></i>
                                            </div>
                                            {{-- <p>Security policy (edit with Customer reassurance module)</p> --}}
                                            <p>Chính sách bảo mật (chỉnh sửa với mô-đun bảo hiểm cho khách hàng)</p>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="reassurance-item">
                                            <div class="reassurance-icon">
                                                <i class="fa fa-truck"></i>
                                            </div>
                                            {{-- <p>Delivery policy (edit with Customer reassurance module)</p> --}}
                                            <p>Chính sách giao hàng (chỉnh sửa với mô-đun bảo hiểm cho khách hàng)</p>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="reassurance-item">
                                            <div class="reassurance-icon">
                                                <i class="fa fa-exchange"></i>
                                            </div>
                                            {{-- <p> Return policy (edit with Customer reassurance module)</p> --}}
                                            <p>Chính sách đổi trả (chỉnh sửa với mô-đun bảo hiểm cho khách hàng)</p>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- content-wraper end -->
<!-- Begin Product Area -->
<div class="product-area pt-35">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="li-product-tab">
                    <ul class="nav li-product-menu">
                        <li><a class="active" data-toggle="tab" href="#description"><span>Giới thiệu</span></a></li>
                        <li><a data-toggle="tab" href="#product-details"><span>Thông số</span></a></li>
                        <li><a data-toggle="tab" href="#reviews"><span>Đánh giá</span></a></li>
                    </ul>
                </div>
                <!-- Begin Li's Tab Menu Content Area -->
            </div>
        </div>
        <div class="tab-content">
            <div id="description" class="tab-pane active show" role="tabpanel">
                <div class="product-description">
                    {!! $product->GioiThieu !!}
                </div>
            </div>
            <div id="product-details" class="tab-pane" role="tabpanel">
                <div class="product-details-manufacturer">
                    <div>
                        {!! $product->ThongSo !!}
                    </div>
                </div>
            </div>
            <div id="reviews" class="tab-pane" role="tabpanel">
                <div class="product-reviews">
                    <div class="product-details-comment-block">
                        <div class="row" id="feedbackSection">
                            @if($feedback->count() >0)
                            @foreach ($feedback as $fb)
                            <div class="col-md-4">
                                <div class="comment-review">
                                    <span>Đánh giá</span>
                                    <ul class="rating">

                                        @for($i = 0; $i < 5; $i++) @if($i <floor($fb->DanhGia))
                                            <li><i class="fa fa-star-o"></i></li>
                                            @else
                                            <li class="no-star"><i class="fa fa-star-o"></i></li>
                                            @endif
                                            @endfor
                                    </ul>
                                </div>
                                <div class="comment-author-infos pt-25">
                                    <h5>Đánh giá bởi: {{ $fb->customer->name }}</h3>
                                        <h6><em>Ngày tạo: {{ date('d-m-Y H:i:s', strtotime($fb->NgayTao)); }}</em></h6>
                                </div>
                                <div class="comment-details">
                                    <h4 class="title-block">Nội dung: {{ $fb->BinhLuan }}</h4>
                                </div>
                            </div>
                            @endforeach
                            @else
                            <div class="col-md-4" id="nocomment">
                                <h5>Sản phẩm này chưa có đánh giá</h5>
                            </div>
                            @endif
                        </div>
                        <div class="review-btn">
                            @if(Auth::guard('customer')->check())
                            <a class="review-links" href="#" data-toggle="modal" data-target="#mymodal">Viết đánh giá!</a>
                            @else
                            {{ Session::put('url.intended', URL::full())}}
                            <a class="review-links" href="{{ route('user.login')}}">Đăng nhập để đánh giá!</a>
                            @endif
                        </div>
                        <!-- Begin Quick View | Modal Area -->
                        <div class="modal fade modal-wrapper" id="mymodal">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-body">
                                        <h3 class="review-page-title">Đánh giá</h3>
                                        <div class="modal-inner-area row">
                                            <div class="col-lg-6">
                                                <div class="li-review-product">
                                                    <img style="width:400px; height:400px;" src="{{asset('public/backend/uploads/product-images/'.$product->image[0]->Anh)}}" alt="Li's Product">
                                                    <div class="li-review-product-desc">
                                                        <p class="li-product-name font-weight-bold">Tên sản phẩm: {{ $product->TenDT }}</p>
                                                        <p class=" font-weight-bold">Nhà sản xuất: {{ $product->supplier->TenNSX }}</p>
                                                        <p>
                                                            {{-- <span>Beach Camera Exclusive Bundle - Includes Two Samsung Radiant 360 R3 Wi-Fi
                                                                Bluetooth Speakers. Fill The Entire Room With Exquisite Sound via Ring Radiator
                                                                Technology. Stream And Control R3 Speakers Wirelessly With Your Smartphone.
                                                                Sophisticated, Modern Design </span> --}}
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="li-review-content">
                                                    <!-- Begin Feedback Area -->
                                                    <div class="feedback-area">
                                                        <div class="feedback">
                                                            {{-- <h3 class="feedback-title">Your Feedback</h3> --}}
                                                            {{-- <form action="#" >
                                                                @csrf --}}
                                                                <p class="your-opinion">
                                                                    <label>Đánh giá</label>
                                                                    <span>
                                                                        <select class="star-rating" name="txtDanhGia" id="txtDanhGia">
                                                                            <option value="1">1</option>
                                                                            <option value="2">2</option>
                                                                            <option value="3">3</option>
                                                                            <option value="4">4</option>
                                                                            <option value="5" selected>5</option>
                                                                        </select>
                                                                    </span>
                                                                </p>
                                                                <p class="feedback-form">
                                                                    <label for="feedback">Nội dung</label><span class="required">*</span>
                                                                    <textarea id="txtBinhLuan" name="txtBinhLuan" cols="45" rows="8" aria-required="true" required></textarea>
                                                                </p>
                                                                <div class="feedback-input">
                                                                    {{-- <p class="feedback-form-author">
                                                                        <label for="author">Name<span class="required">*</span>
                                                                        </label>
                                                                        <input id="txtName" name="txtName" value="" size="30" aria-required="true" type="text" required>
                                                                    </p> --}}
                                                                    {{-- <p class="feedback-form-author feedback-form-email">
                                                                        <label for="email">Email<span class="required">*</span><span id="validate_email"></span>
                                                                        </label> --}}
                                                                    @if(Auth::guard('customer')->check())
                                                                    {{-- <input id="txtEmail" name="txtEmail" value="{{  Auth::guard('customer')->user()->email }}" size="30" aria-required="true" type="hidden" required readonly> --}}
                                                                    {{-- @else
                                                                        <input id="txtEmail" name="txtEmail" value="" size="30" aria-required="true" type="email"> --}}
                                                                    @endif
                                                                    <span class="required"><sub>*</sub>Nội dung bắt buộc</span>
                                                                    {{-- </p> --}}
                                                                    <div class="feedback-btn pb-15 mt-15">
                                                                        <a href="#" class="close" data-dismiss="modal" aria-label="Close">Đóng</a>
                                                                        {{-- <button type="submit" class="btn btn-success">Submit</button> --}}
                                                                        {{-- <a href="#" onclick="event.preventDefault(); return addFeedback('{{ $product->MaDT }}',this)">Gửi</a> --}}
                                                                        <a href="#" id="SubmitFeedback">Gửi</a>
                                                                    </div>
                                                                </div>
                                                            {{-- </form> --}}
                                                        </div>
                                                    </div>
                                                    <!-- Feedback Area End Here -->
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Quick View | Modal Area End Here -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Product Area End Here -->
<!-- Begin Li's Laptop Product Area -->
<section class="product-area li-laptop-product pt-30 pb-50">
    <div class="container">
        <div class="row">
            <!-- Begin Li's Section Area -->
            <div class="col-lg-12">
                @if(count($other_product)>0)
                <div class="li-section-title">
                    <h2>
                        <span>Sản phẩm tương tự</span>
                    </h2>
                </div>
                <div class="row">
                    <div class="product-active owl-carousel">
                        @foreach ($other_product as $other)
                        <div class="col-lg-12">
                            <!-- single-product-wrap start -->
                            <div class="single-product-wrap">
                                <div class="product-image">
                                    <a href="{{  url('product-detail/'.$other->MaDT) }}">
                                        <img src="{{ asset('public/backend/uploads/product-images/'.$other->image[0]->Anh)}}" alt="">
                                    </a>
                                    <span class="sticker" style="background-color: green">Offer</span>
                                </div>
                                <div class="product_desc">
                                    <div class="product_desc_info">
                                        <div class="product-review">
                                            <h5 class="manufacturer">
                                                <a href="product-details.html">{{ $other->supplier->TenNSX }}</a>
                                            </h5>
                                            <div class="rating-box">
                                                <ul class="rating">
                                                    @for($i = 0; $i < 5; $i++) @if($i <floor($other->DanhGia))
                                                        <li><i class="fa fa-star-o"></i></li>
                                                        @else
                                                        <li class="no-star"><i class="fa fa-star-o"></i></li>
                                                        @endif
                                                        @endfor
                                                </ul>
                                            </div>
                                        </div>
                                        <h4><a class="product_name" href="single-product.html">{{ $other->TenDT }}</a></h4>
                                        <div class="price-box">
                                            @if($other->quantity->count() >0)
                                            <span class="new-price">{{ number_format($other->quantity[0]->DonGiaBan) }}₫</span>
                                            @else
                                            <span class="new-price text-danger">Đang cập nhật</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="add-actions">
                                        <ul class="add-actions-link">
                                            {{-- @if($other->quantity->count() >0)
                                            <li class="add-cart active"><a href="{{url('product-detail/'.$other->MaDT)}}">Xem chi tiêt</a></li>
                                            @endif --}}
                                            {{-- <li><a href="#" title="xem nhanh" class="quick-view-btn" data-toggle="modal" data-target="#exampleModalCenter"><i class="fa fa-eye"></i></a></li> --}}
                                            {{-- <li><a class="links-details" href="wishlist.html"><i class="fa fa-heart-o"></i></a></li> --}}
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <!-- single-product-wrap end -->
                        </div>
                        @endforeach
                    </div>
                </div>
                @endif
            </div>
            <!-- Li's Section Area End Here -->
        </div>
    </div>
</section>
@endsection

@section('js')
<!-- Toastr -->
<script src="{{asset('public/backend/Admin/Layout/plugins/toastr/toastr.min.js')}}"></script>
<!-- SweetAlert2 -->
<script src="{{asset('public/backend/Admin/Layout/plugins/sweetalert2/sweetalert2.min.js')}}"></script>
<script type="text/javascript">

    var id = '{{ $product -> MaDT }}';
    $('#ddlColor').on('change', function() {
        // alert(this.value);
        $.getJSON("/Group8_PhoneStore/product-instock/" + id + "/" + this.value, function(data) {
            // console.log(data[0].DonGiaBan);
            console.log(data);
            $('#product_price').html(data[0].DonGiaBan.toLocaleString('en') + '₫');
            if(data[0].SoLuong>0)
                $('#product_instock').html(data[0].SoLuong);
            else if(data[0].SoLuong === 0)
                $('#product_instock').html('<span class="text-danger">Đã hết hàng</span>');
        }).fail(function(){
             alert("Lỗi khi tải dữ liệu"); 
        });

    });

    var current_user = '';
    @if(Auth::guard('customer')->check())
    current_user = "{{ Auth::guard('customer')->user()->name }}";
    @endif
    // console.log('Current:' + current_user);
    function addNewFeedbackLayout(danhgia,binhluan){
        var ratingsection = '';
            for(var i=0;i<5;i++){
                if(i<danhgia){
                    ratingsection += '<li><i class="fa fa-star-o"></i></li>';
                }else{
                    ratingsection += '<li class="no-star"><i class="fa fa-star-o"></i></li>';
                }
            }
            // console.log(moment().format('D-MM-YYYY, HH:mm:ss'));
            var comment = '<div class="col-md-4">'+
                                '<div class="comment-review">'+
                                    '<span>Đánh giá</span>'+
                                    '<ul class="rating">'+
                                       ratingsection + 
                                    '</ul>'+
                                '</div>'+
                               '<div class="comment-author-infos pt-25">'+
                                    '<h5>Đánh giá bởi: '+ current_user +' </h3>'+
                                        '<h6><em>Ngày tạo: '+moment().format('D-MM-YYYY, HH:mm:ss') +'</em></h6>'+
                                '</div>'+
                                '<div class="comment-details">'+
                                    '<h4 class="title-block">Nội dung: '+binhluan+'</h4>'+
                                '</div>'+
                            '</div>';
            // console.log($('#feedbackSection').children().length);
            if($('#feedbackSection').has('#nocomment').length){
                // $('#feedbackSection').html('');
                $('#nocomment').remove();
            }
            // console.log($('#feedbackSection').has('#nocomment').length);
            if($('#feedbackSection').children().length == 3){
                $('#feedbackSection').prepend(comment);
                $('#feedbackSection').children().last().remove();
            }else{
                $('#feedbackSection').prepend(comment);
            }
    }

    $('#SubmitFeedback').click(function(e){
        e.preventDefault();
        var danhgia = $('#txtDanhGia').val();
        var binhluan = $('#txtBinhLuan').val();
        if(binhluan.length > 255)
            ShowAlert('Lỗi khi gửi yêu cầu', 'Nội dung bình luận quá dài', 'error');
        if(danhgia >5 || danhgia<1){
            ShowAlert('Lỗi khi gửi yêu cầu', 'Nội dung đánh giá không hợp lệ', 'error');
        }
        // addNewFeedbackLayout(danhgia,binhluan);
        if (id != null  && binhluan != null && id.trim() !== '' && binhluan.trim() !== '') {
            data = {
                MaDT: id
                , DanhGia: danhgia
                , BinhLuan: binhluan
            }
            // console.log(data);
            $.ajax({
                type: 'POST'
                , headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('value')
                }
                , url: '/Group8_PhoneStore/user/add-feedback'
                , data: JSON.stringify(data)
                , contentType: 'application/json'
                , success: function(result) {
                    $('#mymodal').modal('hide');
                    addNewFeedbackLayout(danhgia,binhluan);
                    console.log(result);
                    toastr.options = {
                        "timeOut": 3000 // 3s
                        , "progressBar": true
                    }
                    toastr.success(result.message);

                }
                , error: function(xhr, ajaxOptions, thrownError) {
                    console.log(JSON.parse(xhr.responseText));
                    ShowAlert('Lỗi khi thao tác', JSON.parse(xhr.responseText).message, 'error');
                }
            });
        } else {
            ShowAlert('Lỗi khi gửi yêu cầu', 'Bạn chưa nhập đủ thông tin', 'error');
        }
    })

    function addFeedback(pid, ctl) {
        // var email = $('#txtEmail').val();
        var danhgia = $('#txtDanhGia').val();
        var binhluan = $('#txtBinhLuan').val();
        var id = "XXX";
        if(danhgia >5 || danhgia<1){
            ShowAlert('Lỗi khi gửi yêu cầu', 'Nội dung đánh giá không hợp lệ', 'error');
        }
        if (pid != null  && binhluan != null && pid.trim() !== '' && binhluan.trim() !== '') {
            // $(ctl).attr("data-dismiss", "modal");
            // $("#add-user-btn").unbind('click').bind('click', function () { });  
            // $('#mymodal').modal('hide');
            data = {
                MaDT: pid
                , DanhGia: danhgia
                , BinhLuan: binhluan
            }
            console.log(data);
            // $.ajax({
            //     type: 'POST'
            //     , headers: {
            //         'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('value')
            //     }
            //     , url: '/Group8_PhoneStore/user/add-feedback'
            //     , data: JSON.stringify(data)
            //     , contentType: 'application/json'
            //     , success: function(result) {
            //         console.log(result);
            //         toastr.options = {
            //             "timeOut": 3000 // 3s
            //             , "progressBar": true
            //         }
            //         toastr.success(result.message);

            //     }
            //     , error: function(xhr, ajaxOptions, thrownError) {
            //         // toastr.options = {
            //         //     "timeOut": 3000
            //         //     , "progressBar": true
            //         // }
            //         // toastr.error(JSON.parse(xhr.responseText.message));
            //         // console.log(JSON.parse(xhr.responseText).message);
            //         console.log(JSON.parse(xhr.responseText));
            //         ShowAlert('Lỗi khi thao tác', JSON.parse(xhr.responseText).message, 'error');
            //     }
            // });
        } else {
            ShowAlert('Lỗi khi gửi yêu cầu', 'Chưa nhập đủ thông tin', 'error');
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
