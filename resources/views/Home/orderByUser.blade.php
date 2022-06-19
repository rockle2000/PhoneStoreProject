 <!-- Begin Li's Breadcrumb Area -->
 @extends('layouts.home_layout')
 @section('content')
 <style>
#custom-order:hover{
    /* box-shadow: -3px 5px 4px 0px rgb(0 0 0 / 20%); */
    box-shadow: 0 0 11px rgba(33,33,33,.5); 
}

#custom-order{
    transition: box-shadow .6s ease-out;
    border-radius:10px;
}
 </style>
 <div class="breadcrumb-area">
    <div class="container">
        <div class="breadcrumb-content">
            <ul>
                <li><a href="{{url('/main-page')}}">Trang chủ</a></li>
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
                    <div id="custom-order" class="col-lg-6 mb-5" style="border: 20px solid transparent;">
                        <div class="li-blog-single-item mb-30">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="li-blog-content">
                                        <div class="li-blog-details">
                                            <h4 class="text-primary pt-xs-25 pt-sm-25"><a href="#">Đơn hàng #{{ $order->SoHDB }}</a></h4>
                                            <div class="li-blog-meta">
                                                {{-- <a class="author" href="#"><i class="fa fa-user"></i>Admin</a> --}}
                                                @if($order->TrangThai == -1)
                                                <span class="text-danger"><i class="fa fa-times"></i> Đã hủy</span>
                                                @elseif($order->TrangThai == 0)
                                                <span class="text-warning"><i class="fa fa-question-circle"></i> Đang chờ xử lý</span>
                                                @elseif($order->TrangThai == 1)
                                                <span class="text-primary"><i class="fa fa-credit-card"></i> Đã thanh toán</span>
                                                @elseif($order->TrangThai == 2)
                                                <span class="text-info"><i class="fa fa-truck"></i> Đang giao</span>
                                                @elseif($order->TrangThai == 3)
                                                <span class="text-success"><i class="fa fa-check-circle"></i> Hoàn tất </span>
                                                @endif
                                                <a class="comment ml-2" style="color:black" href="#"><i class="fa fa-mobile"></i>{{$order->orderdetail->sum('SoLuong') }} sản phẩm</a>
                                                <a class="post-time" style="color:black" href="#"><i class="fa fa-calendar"></i>{{ date('d-m-Y H:i:s', strtotime($order->NgayDatHang)); }}</a>
                                            </div>
                                            <p>
                                                @foreach ($order->orderdetail as $detail)
                                                    <span  style="color:black">+ {{ $detail->product->TenDT }} - {{ $detail->Mau }} x {{ $detail->SoLuong }} - {{ number_format($detail->DonGiaBan) }}₫<span><br>
                                                @endforeach
                                            </p>
                                            @if( $order->discount)
                                            <span class="font-weight-bold">Tổng tiền: </span><span style="margin-right: 50px">{{ number_format($order->TongTien/(1-($order->discount->GiamGia/100 )))}}₫</span>
                                            <span class="font-weight-bold">Giảm giá: </span> <span>{{$order->discount->GiamGia }}%</span>
                                            @else
                                            <span class="font-weight-bold">Tổng tiền: </span><span style="margin-right: 50px">{{  number_format($order->TongTien)}}₫</span>
                                            <span class="font-weight-bold">Giảm giá: </span> <span>Không có</span>
                                            @endif
                                            <br><br><span class="font-weight-bold text-danger" style="margin-right: 50px">Thành tiền: {{ number_format($order->TongTien) }}₫</span>
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
                                {{ $list_order->appends(request()->except('page'))->links('vendor.pagination.custom',["type"=>"đơn hàng"]) }}
                            </div>
                        </div>
                    </div>
                    <!-- Li's Pagination End Here Area -->
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Li's Main Blog Page Area End Here -->
@endsection