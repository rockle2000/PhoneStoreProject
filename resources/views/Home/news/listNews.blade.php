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
                            <form action="#">
                                <input type="text" class="li-search-field" placeholder="search here">
                                <button type="submit" class="li-search-btn"><i class="fa fa-search"></i></button>
                            </form>
                        </div>
                    </div>
                    <div class="li-blog-sidebar pt-25">
                        <h4 class="li-blog-sidebar-title" style="font-family: Roboto,Helvetica,Arial,sans-serif">Danh mục</h4>
                        <ul class="li-blog-archive">
                            @foreach ($newscategories as $category)
                            <li><a href="#">{{ $category->TheLoai }}</a></li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="li-blog-sidebar">
                        <h4 class="li-blog-sidebar-title">Blog Archives</h4>
                        <ul class="li-blog-archive">
                            <li><a href="#">January (10)</a></li>
                            <li><a href="#">February (08)</a></li>
                            <li><a href="#">March (07)</a></li>
                            <li><a href="#">April (14)</a></li>
                            <li><a href="#">May (10)</a></li>
                            <li><a href="#">June (06)</a></li>
                        </ul>
                    </div>
                    <div class="li-blog-sidebar">
                        <h4 class="li-blog-sidebar-title">Recent Post</h4>
                        <div class="li-recent-post pb-30">
                            <div class="li-recent-post-thumb">
                                <a href="blog-details-left-sidebar.html">
                                    <img class="img-full" src="images/product/small-size/3.jpg" alt="Li's Product Image">
                                </a>
                            </div>
                            <div class="li-recent-post-des">
                                <span><a href="blog-details-left-sidebar.html">First Blog Post</a></span>
                                <span class="li-post-date">25.11.2018</span>
                            </div>
                        </div>
                        <div class="li-recent-post pb-30">
                            <div class="li-recent-post-thumb">
                                <a href="blog-details-left-sidebar.html">
                                    <img class="img-full" src="images/product/small-size/2.jpg" alt="Li's Product Image">
                                </a>
                            </div>
                            <div class="li-recent-post-des">
                                <span><a href="blog-details-left-sidebar.html">First Blog Post</a></span>
                                <span class="li-post-date">25.11.2018</span>
                            </div>
                        </div>
                        <div class="li-recent-post pb-30">
                            <div class="li-recent-post-thumb">
                                <a href="blog-details-left-sidebar.html">
                                    <img class="img-full" src="images/product/small-size/5.jpg" alt="Li's Product Image">
                                </a>
                            </div>
                            <div class="li-recent-post-des">
                                <span><a href="blog-details-left-sidebar.html">First Blog Post</a></span>
                                <span class="li-post-date">25.11.2018</span>
                            </div>
                        </div>
                    </div>
                    <div class="li-blog-sidebar">
                        <h4 class="li-blog-sidebar-title">Tags</h4>
                        <ul class="li-blog-tags">
                            <li><a href="#" style="font-family: 'Rubik', sans-serif">Gaming</a></li>
                            <li><a href="#" style="font-family: 'Rubik', sans-serif">Chromebook</a></li>
                            <li><a href="#" style="font-family: 'Rubik', sans-serif">Refurbished</a></li>
                            <li><a href="#" style="font-family: 'Rubik', sans-serif">Touchscreen</a></li>
                            <li><a href="#" style="font-family: 'Rubik', sans-serif">Ultrabooks</a></li>
                            <li><a href="#" style="font-family: 'Rubik', sans-serif">Sound Cards</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- Li's Blog Sidebar Area End Here -->
            <!-- Begin Li's Main Content Area -->
            <div class="col-lg-9 order-lg-2 order-1" > 
                <div class="row li-main-content">
                    @foreach ($news as $item)
                    <div class="col-lg-6 col-md-6">
                        <div class="li-blog-single-item pb-25">
                            <div class="li-blog-banner">
                                <a href="{{ url('/news/detail/'.$item->MaTinTuc) }}"><img class="img-full" src="{{ asset('public/backend/uploads/news-images/'.$item->Anh) }}" alt=""></a>
                            </div>
                            <div class="li-blog-content">
                                <div class="li-blog-details">
                                    <h3 class="li-blog-heading pt-25"><a href="#" style="font-family: Roboto,Helvetica,Arial,sans-serif">{{ $item->TieuDe }}</a></h3>
                                    <div class="li-blog-meta">
                                        <a class="author" href="#"><i class="fa fa-user"></i>{{ $item->TacGia }}</a>
                                        <a class="comment" href="#"><i class="fa fa-comment-o"></i> 3 comment</a>
                                        <a class="post-time" href="#"><i class="fa fa-calendar"></i> {{ $item->created_at }}</a>
                                    </div>
                                    {{-- <p>{!! Str::limit($item->NoiDung, 100, ' ...') !!}</p> --}}
                                    {{-- <p>{!! $item->NoiDung !!}</p> --}}
                                    @foreach ($item->news_newscategory as $category)
                                    <span class="badge badge-primary" style="padding: 5px">{{ $category->newscategory->TheLoai }}</span>
                                    @endforeach
                                    <br><br><a class="read-more" href="blog-details-left-sidebar.html">Đọc thêm...</a>
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
