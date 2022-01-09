@extends('layouts.home_layout')
@section('content')
<div class="team-area pt-60 pt-sm-44">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="li-section-title capitalize mb-25">
                    <h2><span>Thành viên</span></h2>
                </div>
            </div>
        </div> <!-- section title end -->
        <div class="row">
            <div class="col-lg-4 col-md-6 col-sm-6">
                <div class="team-member mb-60 mb-sm-30 mb-xs-30">
                    <div class="team-thumb">
                        <img src="{{ asset('public/frontend/images/team/1.png') }}" alt="Our Team Member">
                    </div>
                    <div class="team-content text-center">
                        <h3>Hoàng Quang Huy - 181210015</h3>
                        <p>Web Developer</p>
                        <a href="#">huy@gmail.com</a>
                        <div class="team-social">
                            <a href="#"><i class="fa fa-facebook"></i></a>
                            <a href="#"><i class="fa fa-twitter"></i></a>
                            <a href="#"><i class="fa fa-linkedin"></i></a>
                            <a href="#"><i class="fa fa-google-plus"></i></a>
                        </div>
                    </div>
                </div>
            </div> <!-- end single team member -->
            <div class="col-lg-4 col-md-6 col-sm-6">
                <div class="team-member mb-60 mb-sm-30 mb-xs-30">
                    <div class="team-thumb">
                        <img src="{{ asset('public/frontend/images/team/3.png') }}" alt="Our Team Member">
                    </div>
                    <div class="team-content text-center">
                        <h3>Hoàng Văn Mạnh - 181203415</h3>
                        <p>Tester</p>
                        <a href="#">manh@gmail.com</a>
                        <div class="team-social">
                            <a href="#"><i class="fa fa-facebook"></i></a>
                            <a href="#"><i class="fa fa-twitter"></i></a>
                            <a href="#"><i class="fa fa-linkedin"></i></a>
                            <a href="#"><i class="fa fa-google-plus"></i></a>
                        </div>
                    </div>
                </div>
            </div> <!-- end single team member -->
            <div class="col-lg-4 col-md-6 col-sm-6">
                <div class="team-member mb-30 mb-sm-60">
                    <div class="team-thumb">
                        <img src="{{ asset('public/frontend/images/team/2.png') }}" alt="Our Team Member">
                    </div>
                    <div class="team-content text-center">
                        <h3>Đỗ Quang Vinh - 181202679</h3>
                        <p>Web Developer</p>
                        <a href="#">vinh@gmail.com</a>
                        <div class="team-social">
                            <a href="#"><i class="fa fa-facebook"></i></a>
                            <a href="#"><i class="fa fa-twitter"></i></a>
                            <a href="#"><i class="fa fa-linkedin"></i></a>
                            <a href="#"><i class="fa fa-google-plus"></i></a>
                        </div>
                    </div>
                </div>
            </div> <!-- end single team member -->
            
        </div>
    </div>
</div>
@endsection