 @extends("layouts.home_layout")
 @section('content')
 <!-- Begin Li's Breadcrumb Area -->
 <div class="breadcrumb-area">
     <div class="container">
         <div class="breadcrumb-content">
             <ul>
                 <li><a href="{{ route('main-page') }}">Trang chủ</a></li>
                 <li class="active">404 Error</li>
             </ul>
         </div>
     </div>
 </div>
 <!-- Li's Breadcrumb Area End Here -->
 <!-- Error 404 Area Start -->
 <div class="error404-area pt-30 pb-60">
     <div class="container">
         <div class="row">
             <div class="col-lg-12">
                 <div class="error-wrapper text-center ptb-50 pt-xs-20">
                     <div class="error-text">
                         <h1 style="color: red">404</h1>
                         <h2>Opps! PAGE NOT BE FOUND</h2>
                         {{-- <p>Sorry but the page you are looking for does not exist, have been removed, <br> name changed or is temporarity unavailable.</p> --}}
                         <p>Trang mà bạn tìm kiếm không tồn tại, đã bị xóa, <br> đổi tên hoặc tạm thời không khả dụng </p>
                     </div>
                     {{-- <div class="search-error">
                         <form id="search-form" action="#">
                             <input type="text" placeholder="Search">
                             <button><i class="zmdi zmdi-search"></i></button>
                         </form>
                     </div> --}}
                     <div class="error-button">
                         <a class="" style="background-color: #293a6c" href="{{ url('/main-page') }}">Quay về trang chủ</a>
                     </div>
                 </div>
             </div>
         </div>
     </div>
 </div>
 <!-- Error 404 Area End -->
 @endsection
