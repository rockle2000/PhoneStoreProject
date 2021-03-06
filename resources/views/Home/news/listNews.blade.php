@extends('layouts.home_layout')
@section('css')
@endsection
@section("content")
<div class="breadcrumb-area">
    <div class="container">
        <div class="breadcrumb-content">
            <ul>
                <li><a href="{{ route('main-page') }}">Trang chủ</a></li>
                <li class="active">Tin tức</li>
            </ul>
        </div>
    </div>
</div>
<!-- Li's Breadcrumb Area End Here -->
<!-- Begin Li's Main Blog Page Area -->
<div class="li-main-blog-page pt-60 pb-55">
    <div class="container">
        <div class="row">
            <!-- Begin Li's Blog Sidebar Area -->
            <div class="col-lg-3 order-lg-1 order-2">
                <div class="li-blog-sidebar-wrapper">
                    <div class="li-blog-sidebar">
                        <div class="li-sidebar-search-form">
                            {{-- <form action="#">
                                <input type="text" class="li-search-field" placeholder="search here">
                                <button type="submit" class="li-search-btn"><i class="fa fa-search"></i></button>
                            </form> --}}
                        </div>
                    </div>
                    <div class="li-blog-sidebar pt-25">
                        <h4 class="li-blog-sidebar-title" style="font-family: Roboto,Helvetica,Arial,sans-serif">Danh mục</h4>
                        <ul class="li-blog-archive">
                            <li><a href="{{ route('news') }}">Tất cả</a></li>
                            @foreach ($newscategories as $category)
                            <li><a href="?category={{ $category->MaTheLoai }}">{{ $category->TheLoai }}</a></li>
                            @endforeach
                        </ul>
                    </div>
                    {{-- <div class="li-blog-sidebar">
                        <h4 class="li-blog-sidebar-title">Blog Archives</h4>
                        <ul class="li-blog-archive">
                            <li><a href="#">January (10)</a></li>
                            <li><a href="#">February (08)</a></li>
                            <li><a href="#">March (07)</a></li>
                            <li><a href="#">April (14)</a></li>
                            <li><a href="#">May (10)</a></li>
                            <li><a href="#">June (06)</a></li>
                        </ul>
                    </div> --}}
                    <div class="li-blog-sidebar">
                        <h4 class="li-blog-sidebar-title" style="font-family: Roboto,Helvetica,Arial,sans-serif">Tin tức gần đây</h4>
                        @foreach ($recent_news as $recent)
                        <div class="li-recent-post pb-30">
                            <div class="li-recent-post-thumb" style="height: 100%">
                                <a href="{{ url('/news/detail/'.$recent->MaTinTuc) }}">
                                    <img class="img-full" src="{{ asset('public/backend/uploads/news-images/'.$recent->Anh) }}" alt="Recent news image">
                                </a>
                            </div>
                            <div class="li-recent-post-des">
                                <span><a href="{{ url('/news/detail/'.$recent->MaTinTuc) }}">{{ Str::of($recent->TieuDe)->limit(20) }}</a></span>
                                <span class="li-post-date">{{ date('d-m-Y', strtotime($recent->NgayTao)) }}</span>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    {{-- <div class="li-blog-sidebar">
                        <h4 class="li-blog-sidebar-title">Tags</h4>
                        <ul class="li-blog-tags">
                            <li><a href="#" style="font-family: 'Rubik', sans-serif">Gaming</a></li>
                            <li><a href="#" style="font-family: 'Rubik', sans-serif">Chromebook</a></li>
                            <li><a href="#" style="font-family: 'Rubik', sans-serif">Refurbished</a></li>
                            <li><a href="#" style="font-family: 'Rubik', sans-serif">Touchscreen</a></li>
                            <li><a href="#" style="font-family: 'Rubik', sans-serif">Ultrabooks</a></li>
                            <li><a href="#" style="font-family: 'Rubik', sans-serif">Sound Cards</a></li>
                        </ul>
                    </div> --}}
                </div>
            </div>
            <!-- Li's Blog Sidebar Area End Here -->
            <!-- Begin Li's Main Content Area -->
            <div class="col-lg-9 order-lg-2 order-1" > 
                <div class="row li-main-content">
                    @if($news->count()==0)
                    <div class="col">
                        <h4 class="text-center text-danger">Danh mục này chưa có tin tức nào vui lòng quay lại sau.</h4>
                    </div>
                    @else
                    @foreach ($news as $item)
                    <div class="col-lg-6 col-md-6">
                        <div class="li-blog-single-item pb-25">
                            <div class="li-blog-banner">
                                <a href="{{ url('/news/detail/'.$item->MaTinTuc) }}"><img class="img-full" src="{{ asset('public/backend/uploads/news-images/'.$item->Anh) }}" alt=""></a>
                            </div>
                            <div class="li-blog-content">
                                <div class="li-blog-details">
                                    <h3 class="li-blog-heading pt-25"><a href="{{ url('/news/detail/'.$item->MaTinTuc) }}" style="font-family: Roboto,Helvetica,Arial,sans-serif">{{ $item->TieuDe }}</a></h3>
                                    <div class="li-blog-meta">
                                        <a class="author" href="#"><i class="fa fa-user"></i>{{ $item->TacGia }}</a>
                                        <a class="comment" href="#"><i class="fa fa-comment-o"></i> 3 comment</a>
                                        <a class="post-time" href="#"><i class="fa fa-calendar"></i> {{date('d-m-Y H:i:s', strtotime($item->NgayTao)) }}</a>
                                    </div>
                                    {{-- <p>{!! Str::limit($item->NoiDung, 100, ' ...') !!}</p> --}}
                                    {{-- <p>{!! $item->NoiDung !!}</p> --}}
                                    @foreach ($item->news_newscategory as $category)
                                    <span class="badge badge-primary" style="padding: 5px">{{ $category->newscategory->TheLoai }}</span>
                                    @endforeach
                                    {{-- <br><br><a class="read-more" href="#">Đọc thêm...</a> --}}
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                    <!-- Begin Li's Pagination Area -->
                    <div class="col-lg-12">
                        <div class="paginatoin-area mt-100">
                            <div class="row">
                                {{ $news->appends(request()->except('page'))->links('vendor.pagination.custom',["type"=>"bài viêt"]) }}
                            </div>
                        </div>
                    </div>
                    <!-- Li's Pagination End Here Area -->
                    @endif
                </div>
            </div>
            <!-- Li's Main Content Area End Here -->
        </div>
    </div>
</div>
<!-- Li's Main Blog Page Area End Here -->

@endsection

@section('js')

@endsection
