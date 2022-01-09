@extends('layouts.home_layout')
@section('content')
<div class="Shopping-cart-area pt-60 pb-60">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <form action="#">
                    <div class="table-content table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th class="li-product-remove">Xóa</th>
                                    <th class="li-product-thumbnail">Ảnh</th>
                                    <th class="cart-product-name">Tên sản phẩm</th>
                                    <th class="cart-product-color">Màu</th>
                                    <th class="li-product-price">Đơn giá</th>
                                    <th class="li-product-quantity">Số lượng</th>
                                    <th class="li-product-subtotal">Thành tiền</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach (Cart::content() as $row)
                                <tr>
                                    <td class="li-product-remove"><a onclick="return confirm('Bạn có chắc muốn xóa sản phầm này khỏi giỏ hàng?')" href="{{ route('user.cartRemove' ,['id'=> $row->rowId]) }}"><i class="fa fa-times"></i></a></td>
                                    <td><img src="{{ asset('public/backend/uploads/product-images/'.$row->options->photo) }}" height="50" width="auto"></td>
                                    <td class="li-product-name"><a href="{{ url('product-detail/'.$row->id) }}">{{$row->name}}</a></td>
                                    <td class="li-product-name"><a href="#">{{$row->options->color}}</a></td>
                                    <td class="li-product-price">{{number_format($row->price)}}₫</td>
                                    <td class="quantity">
                                        {{-- <div class="cart-plus-minus">
                                            <input class="cart-plus-minus-box" value="{{$row->qty}}" type="text">
                                            <div class="dec">
                                                <a class="" href=" {{ route('user.increaseCart' ,['rowid' => $row->rowId]) }}">
                                                    <i class="fa fa-angle-down"></i>
                                                </a>
                                                </a>
                                            </div>
                                            <div class="inc qtybutton">
                                                <a class="" href=" {{ route('user.decreaseCart' ,['rowid' => $row->rowId]) }}">
                                                    <i class="fa fa-angle-up"></i>
                                                </a>
                                            </div>
                                        </div> --}}
                                        <a class="" href=" {{ route('user.increaseCart' ,['rowid' => $row->rowId]) }}"><i class="fa fa-plus"></i></a>
                                        <span class="qty">{{$row->qty}}</span>
                                        <a class="" href=" {{ route('user.decreaseCart' ,['rowid' => $row->rowId]) }}"><i class="fa fa-minus"></i></a>
                                    </td>
                                    <td class="li-product-price"><span class="amount">{{number_format($row->priceTotal) }}₫</span></td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    {{-- <div class="row">
            <div class="col-12">
                <div class="coupon-all">
                    <div class="coupon">
                        <input id="coupon_code" class="input-text" name="coupon_code" value="" placeholder="Coupon code" type="text">
                        <input class="button" name="apply_coupon" value="Apply coupon" type="submit">
                    </div>
                    <div class="coupon2">
                        <input class="button" name="update_cart" value="Update cart" type="submit">
                    </div>
                </div>
            </div>
        </div> --}}
                    <div class="row">
                        <div class="col-md-5 ml-auto">
                            <div class="cart-page-total">
                                <h2>Tổng hóa đơn</h2>
                                <ul>
                                    <li>Tổng tiền <span>{{ Cart::priceTotal(0) }}₫</span></li>
                                </ul>
                                <a href="{{ route('user.checkout') }}">Thanh toán</a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!--Shopping Cart Area End-->
@endsection
