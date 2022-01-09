@extends('layouts.home_layout')
@section('content')
<!-- Begin Li's Breadcrumb Area -->
<div class="breadcrumb-area">
    <div class="container">
        <div class="breadcrumb-content">
            <ul>
                <li><a href="{{ url('main-page') }}">Home</a></li>
                <li class="active">Thanh toán</li>
            </ul>
        </div>
    </div>
</div>
<!-- Li's Breadcrumb Area End Here -->
<!--Checkout Area Strat-->
<div class="checkout-area pb-30">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="coupon-accordion">
                    <!--Accordion Start-->
                    <h3>Có mã khuyến mãi? <span id="showcoupon">Ấn vào đây để sử dụng mã</span></h3>
                    <div id="checkout_coupon" class="coupon-checkout-content">
                        <div class="coupon-info">
                            <form action="#">
                                <p class="checkout-coupon">
                                    <input placeholder="Coupon code" type="text">
                                    <input value="Apply Coupon" type="submit">
                                </p>
                            </form>
                        </div>
                    </div>
                    <!--Accordion End-->
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6 col-12">
                <form action="{{route('user.orderadd')}}" method="POST" id="formorder">
                    @csrf
                    <div class="checkbox-form">
                        <h3>Chi tiết hoá đơn</h3>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="checkout-form-list">
                                    <label>Họ tên</label>
                                    <input class="mb-0" type="text" class="form-control" name="fullname" placeholder="Họ tên" value="{{ Auth::guard('customer')->user()->name }}">
                                    <span class="text-danger">@error('fullname'){{ $message }} @enderror</span>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="checkout-form-list">
                                    <label>Địa chỉ<span class="required">*</span></label>
                                    <input class="mb-0" type="text" class="form-control" name="address" placeholder="Nhập địa chỉ giao hàng" value="{{ old('address') }}">
                                    <span class="text-danger">@error('address'){{ $message }} @enderror</span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="checkout-form-list">
                                    <label>Địa chỉ Email <span class="required">*</span></label>
                                    <input type="text" readonly class="form-control" name="email" placeholder="Enter email address" value="{{ Auth::guard('customer')->user()->email }}">
                                    <span class="text-danger">@error('email'){{ $message }} @enderror</span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="checkout-form-list">
                                    <label>Số điện thoại <span class="required">*</span></label>
                                    <input class="mb-0" type="text" class="form-control" name="phone_number" placeholder="Enter phone number" value="{{ Auth::guard('customer')->user()->phone }}">
                                    <span class="text-danger">@error('phone_number'){{ $message }} @enderror</span>
                                </div>
                            </div>
                        </div>
                        <div class="order-notes">
                            <div class="checkout-form-list">
                                <label>Ghi chú</label>
                                <textarea id="checkout-mess" cols="30" rows="10" name="order_note" placeholder="Ghi chú cho cửa hàng hoặc cho shipper"></textarea>
                            </div>
                        </div>

                        <div class="payment-method">
                            <h3>Phương thức thanh toán</h3>
                            <input type="radio" id="offline" name="tab" value="tructiep" onclick="show1();" required style="width:20px;height:15px" oninvalid="this.setCustomValidity('Vui lòng chọn phương thức thanh toán')"
                            oninput="this.setCustomValidity('')" {{(old('tab') == 'tructiep') ? 'checked' : ''}}>
                            <label for="offline">Thanh toán trực tiếp</label><br>
                            <p id="demo"></p>
                            <input type="radio" id="paypal" name="tab" value="stripe" onclick="show2();" style="width:20px;height:15px" {{(old('tab') == 'stripe') ? 'checked' : ''}}>
                              <label for="paypal">Thanh toán bằng thẻ</label>
                            <div id="card-element" style="display: none;">
                                <!-- A Stripe Element will be inserted here. -->
                            </div>
                            <!-- Used to display form errors. -->
                            <div id="card-errors" role="alert"></div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-lg-6 col-12">
                <div class="your-order">
                    <h3>Hóa đơn của bạn</h3>
                    <div class="your-order-table table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th class="cart-product-name">Tên sản phẩm</th>
                                    <th class="cart-product-total">Thành tiền</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach (Cart::content() as $row)
                                <tr class="cart_item">
                                    <td class="cart-product-name"> {{$row->name}} - {{ $row->options->color }}<strong class="product-quantity">
                                        × {{$row->qty}}</strong></td>
                                    <td class="cart-product-total"><span class="amount">{{number_format($row->priceTotal)}}₫</span>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr class="order-total">
                                    <th>Tổng tiền</th>
                                    <td><strong><span class="amount">{{Cart::priceTotal(0)}}₫</span></strong></td>
                                </tr>

                            </tfoot>
                        </table>
                    </div>
                    <div class="payment-method">
                        <div class="order-button-payment">
                            <input value="Hoàn tất hóa đơn" type="submit" form="formorder">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--Checkout Area End-->
<script>
    function show1() {
        document.getElementById('card-element').style.display = 'none';
    }

    function show2() {
        document.getElementById('card-element').style.display = 'block';
    }

</script>
@endsection

@section('js')
<script>
    var publishable_key = '{{ env('STRIPE_PUBLISHABLE_KEY') }}';
</script>
<script src="{{ asset('/public/frontend/js/card.js') }}"></script>
@endsection
