@extends('layouts.home_layout')
@section('content')
<div class="contact-main-page mt-60 mb-40 mb-md-40 mb-sm-40 mb-xs-40">
    <div class="container mb-60">
        <div>
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3723.939013556679!2d105.81047311488346!3d21.035126085994857!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3135ab13464e8961%3A0x840d78ce1df107c6!2zTmcuIDM1IFAuIEtpbSBNw6MgVGjGsOG7o25nLCBD4buRbmcgVuG7iywgQmEgxJDDrG5oLCBIw6AgTuG7mWksIFZp4buHdCBOYW0!5e0!3m2!1svi!2s!4v1645627516255!5m2!1svi!2s" width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
        </div>
        <div class="row mt-40">
            <div class="col-lg-5 offset-lg-1 col-md-12 order-1 order-lg-2">
                <div class="contact-page-side-content">
                    <h3 class="contact-page-title">Liên hệ</h3>
                    <p class="contact-page-message">PhoneStore luôn nỗ lực mang đến sản phẩm, dịch vụ và trải nghiệm tốt nhất cho khách hàng. Dưới đây là thông tin liên hệ nếu khách hàng có thắc mắc hay khiếu nại với cửa hàng.</p>
                    <div class="single-contact-block">
                        <h4><i class="fa fa-fax"></i> Địa chỉ</h4>
                        <p>123 Ngõ 35 Kim Mã Thượng Ba Đình – Hà Nội</p>
                    </div>
                    <div class="single-contact-block">
                        <h4><i class="fa fa-phone"></i> Điện thoại</h4>
                        <p>Di động: (+84) 964 027 677</p>
                        <p>Hotline: 1900 302 311</p>
                    </div>
                    <div class="single-contact-block last-child">
                        <h4><i class="fa fa-envelope-o"></i> Email</h4>
                        <p>quanghhuuyy000@gmail.com</p>
                        <p>support@phonestore.company</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-6 offset-lg-1">
                <div class="team-member mb-60 mb-sm-30 mb-xs-30">
                    <div class="team-thumb">
                        {{-- <img src="{{ asset('public/frontend/images/team/1.png') }}" alt="Our Team Member"> --}}
                        <img src="{{ asset('public/frontend/images/team/cv.jpg') }}" alt="Our Team Member">
                    </div>
                    <div class="team-content text-center">
                        <h3>Hoàng Quang Huy - 181210015</h3>
                        <p>CNTT4 - K59</p>
                        <a href="#">quanghhuuyy000@gmail.com</a>
                        <div class="team-social">
                            <a href="https://www.facebook.com/quang.hhuy2311/" target="_blank"><i class="fa fa-facebook"></i></a>
                            <a href="#" target="_blank"><i class="fa fa-twitter"></i></a>
                            <a href="#" target="_blank"><i class="fa fa-linkedin"></i></a>
                            <a href="#" target="_blank"><i class="fa fa-google-plus"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
