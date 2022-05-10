@extends('layouts.home_layout')
@section('css')
<style>
    .coupon {
        border: 5px dotted #bbb;
        /* Dotted border */
        width: 80%;
        border-radius: 15px;
        /* Rounded border */
        margin: 0 auto;
        /* Center the coupon */
        max-width: 600px;
    }

    .container_custom {
        padding: 2px 16px;
        background-color: #f1f1f1;
    }

    .promo {
        background: #ccc;
        padding: 3px;
    }
</style>
@endsection
@section('content')
<div class="breadcrumb-area">
    <div class="container">
        <div class="breadcrumb-content">
            <ul>
                <li><a href="{{url('/main-page')}}">Trang chủ</a></li>
                <li class="active">Mã giảm giá</li>
            </ul>
        </div>
    </div>
</div>
<!-- Li's Breadcrumb Area End Here -->
<div class="contact-main-page mt-60 mb-40 mb-md-40 mb-sm-40 mb-xs-40">
    <div class="container mb-60">
        <div class="row">
            @foreach ($discount as $item)
            <div class="col-md-4 col-sm-6 rounded">
                <div class="coupon">
                    <img src="{{asset('public/frontend/images/discount_code.jpg')}}" alt="Avatar" style="width:100%;">
                    <div class="container_custom" style="background-color:white">
                        <h4 class="text-center text-danger">Sale {{ $item->GiamGia }}%</h4>
                        <p class="text-dark">{{ $item->NoiDung }}</p>
                    </div>
                    <div class="container_custom">
                        <p class="text-dark">Sử dụng mã: <span class="promo font-weight-bold">{{ $item->MaKM }}</span></p>
                        <div class="countersection mb-2">
                            @php
                            $end_date = new DateTime($item->NgayKetThuc);
                            $start_date = new DateTime($item->NgayBatDau);
                            $now = new DateTime();
                            $isPastEndDate = false;
                            $isPastStartDate = false;
                            if($end_date < $now) { 
                                $isPastEndDate=true; 
                            }if($start_date < $now){ 
                                $isPastStartDate=true; 
                            }
                            @endphp
                            @if($isPastStartDate) 
                                @if(!$isPastEndDate)
                                    @if($item->SoLuong > 0)
                                        <span class="font-weight-bold">Số lượng còn lại: {{ $item->SoLuong }}</span><br>
                                        <div class="countersection">
                                            <span> Thời gian còn lại</span>
                                            <div class="d-flex justify-content-center li-countdown wrap-countdown mercado-countdown" data-expire="{{ date('Y/m/d H:i:s', strtotime($item->NgayKetThuc)); }}"></div>
                                        </div>
                                        @else
                                        <span class="font-weight-bold">Mã giảm giá này đã hết</span><br>
                                    @endif
                                @else
                                    <span class="h5 text-danger">Đã kết thúc</span>
                                @endif
                            @else
                                <span class="font-weight-bold">Có hiệu lực vào {{ date('d/m/Y H:i:s', strtotime($item->NgayBatDau)); }}</span>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        <div class="col-lg-12">
            {{-- <div class="li-paginatoin-area text-center pt-25"> --}}
            <div class="paginatoin-area">
                <div class="row">
                    {{ $discount->appends(request()->except('page'))->links('vendor.pagination.custom',["type"=>"mã giảm giá"]) }}
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
