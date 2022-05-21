@extends('layouts.home_layout')
@section('css')
@endsection
@section("content")
<!-- Begin Li's Breadcrumb Area -->
<div class="breadcrumb-area">
    <div class="container">
        <div class="breadcrumb-content">
            <ul>
                <li><a href="index.html">Trang chủ</a></li>
                <li class="active">Tin tức</li>
            </ul>
        </div>
    </div>
</div>
<!-- Li's Breadcrumb Area End Here -->
<!-- Begin Li's Main Blog Page Area -->
<div class="li-main-blog-page li-main-blog-details-page pt-60 pb-60 pb-sm-45 pb-xs-45">
    <div class="container">
        <div class="row">
            <!-- Begin Li's Blog Sidebar Area -->
            <div class="col-lg-3 order-lg-1 order-2">
                <div class="li-blog-sidebar-wrapper">
                    <div class="li-blog-sidebar">
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
                </div>
            </div>
            <!-- Li's Blog Sidebar Area End Here -->
            <!-- Begin Li's Main Content Area -->
            <div class="col-lg-9 order-lg-2 order-1">
                <div class="row li-main-content">
                    <div class="col-lg-12">
                        <div class="li-blog-single-item pb-30">
                            <div class="li-blog-banner">
                                <a href="blog-details.html"><img class="img-full" src="images/blog-banner/bg-banner.jpg" alt=""></a>
                            </div>
                            <div class="li-blog-content">
                                <div class="li-blog-details">
                                    <h3 class="li-blog-heading pt-25" style="font-family: Roboto,Helvetica,Arial,sans-serif"><a href="#">{{ $news->TieuDe }}</a></h3>
                                    <div class="li-blog-meta">
                                        <a class="author" href="#"><i class="fa fa-user"></i>{{ $news->TacGia }}</a>
                                        <a class="comment" href="#"><i class="fa fa-comment-o"></i> 3 comment</a>
                                        <a class="post-time" href="#"><i class="fa fa-calendar"></i> {{ date('d-m-Y', strtotime($recent->NgayTao)) }}</a>
                                    </div>
                                    {{-- <p>Donec vitae hendrerit arcu, sit amet faucibus nisl. Cras pretium arcu ex. Aenean posuere libero eu augue condimentum rhoncus. Cras pretium arcu ex.</p> --}}
                                    <!-- Begin Blog Blockquote Area -->
                                    {{-- <div class="li-blog-blockquote">
                                        <blockquote>
                                            <p>Quisque semper nunc vitae erat pellentesque, ac placerat arcu consectetur. In venenatis elit ac ultrices convallis. Duis est nisi, tincidunt ac urna sed, cursus blandit lectus. In ullamcorper sit amet ligula ut eleifend. Proin dictum tempor ligula, ac feugiat metus. Sed finibus tortor eu scelerisque scelerisque.</p>
                                        </blockquote>
                                    </div> --}}
                                    <!-- Blog Blockquote Area End Here -->
                                    <div class="row">{!! $news->NoiDung !!}</div>
                                    <div class="li-tag-line">
                                        <h4>tag:</h4>
                                        @foreach ($news->news_newscategory as $category)
                                        @if($loop->last)
                                        <a href="#">{{ $category->newscategory->TheLoai }}</a>
                                        @else
                                        <a href="#">{{ $category->newscategory->TheLoai }}</a>,
                                        @endif
                                        @endforeach
                                        {{-- <a href="#">Headphones</a>,
                                        <a href="#">Video Games</a>,
                                        <a href="#">Wireless Speakers</a> --}}
                                    </div>
                                    <div class="li-blog-sharing text-center pt-30">
                                        <h4>Chia sẻ bài viết này:</h4>
                                        <a href="#"><i class="fa fa-facebook"></i></a>
                                        <a href="#"><i class="fa fa-twitter"></i></a>
                                        <a href="#"><i class="fa fa-pinterest"></i></a>
                                        <a href="#"><i class="fa fa-google-plus"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Begin Li's Blog Comment Section -->
                        <div class="li-comment-section">
                            <h3>03 comment</h3>
                            <ul>
                                <li>
                                    <div class="author-avatar pt-15">
                                        <img src="{{ asset('public/frontend/images/product-details/user.png') }}" alt="User">
                                    </div>
                                    <div class="comment-body pl-15">
                                        <span class="reply-btn pt-15 pt-xs-5"><a href="#">reply</a></span>
                                        <h5 class="comment-author pt-15">admin</h5>
                                        <div class="comment-post-date">
                                            20 nov, 2018 at 9:30pm
                                        </div>
                                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Enim maiores adipisci optio ex, laboriosam facilis non pariatur itaque illo sunt?</p>
                                    </div>
                                </li>
                                <li class="comment-children">
                                    <div class="author-avatar pt-15">
                                        <img src="{{ asset('public/frontend/images/product-details/admin.png') }}" alt="Admin">
                                    </div>
                                    <div class="comment-body pl-15">
                                        <span class="reply-btn pt-15 pt-xs-5"><a href="#">reply</a></span>
                                        <h5 class="comment-author pt-15">admin</h5>
                                        <div class="comment-post-date">
                                            20 nov, 2018 at 9:30pm
                                        </div>
                                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Enim maiores adipisci optio ex, laboriosam facilis non pariatur itaque illo sunt?</p>
                                    </div>
                                </li>
                                <li>
                                    <div class="author-avatar pt-15">
                                        <img src="{{ asset('public/frontend/images/product-details/admin.png') }}" alt="Admin">
                                    </div>
                                    <div class="comment-body pl-15">
                                        <span class="reply-btn pt-15 pt-xs-5"><a href="#">reply</a></span>
                                        <h5 class="comment-author pt-15">admin</h5>
                                        <div class="comment-post-date">
                                            20 nov, 2018 at 9:30pm
                                        </div>
                                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Enim maiores adipisci optio ex, laboriosam facilis non pariatur itaque illo sunt?</p>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <!-- Li's Blog Comment Section End Here -->
                        <!-- Begin Blog comment Box Area -->
                        <div class="li-blog-comment-wrapper">
                            <h3>leave a reply</h3>
                            <p>Your email address will not be published. Required fields are marked *</p>
                            <form action="#">
                                <div class="comment-post-box">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <label>comment</label>
                                            <textarea name="commnet" placeholder="Write a comment"></textarea>
                                        </div>
                                        <div class="col-lg-4 col-md-4 col-sm-4 mt-5 mb-sm-20 mb-xs-20">
                                            <label>Name</label>
                                            <input type="text" class="coment-field" placeholder="Name">
                                        </div>
                                        <div class="col-lg-4 col-md-4 col-sm-4 mt-5 mb-sm-20 mb-xs-20">
                                            <label>Email</label>
                                            <input type="text" class="coment-field" placeholder="Email">
                                        </div>
                                        <div class="col-lg-4 col-md-4 col-sm-4 mt-5 mb-sm-20">
                                            <label>Website</label>
                                            <input type="text" class="coment-field" placeholder="Website">
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="coment-btn pt-30 pb-sm-30 pb-xs-30 f-left">
                                                <input class="li-btn-2" type="submit" name="submit" value="post comment">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <!-- Blog comment Box Area End Here -->
                    </div>
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
