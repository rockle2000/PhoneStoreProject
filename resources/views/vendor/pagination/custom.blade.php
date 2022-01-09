@if ($paginator->hasPages())
<div class="col-lg-6 col-md-6">
    {{-- <p>Showing {{ $paginator->count() }} of {{ $paginator->total()}}</p> --}}
    <p>Hiện thị {{ $paginator->firstItem() }} - {{ $paginator->lastItem() }}
        trong tổng {{$paginator->total()}} sản phẩm</p>
</div>
<div class="col-lg-6 col-md-6">
    <ul class="pagination-box">
        @if ($paginator->onFirstPage())
        <li class="disabled">
            <a class="btn disabled" href="" tabindex="-1"><i class="fa fa-chevron-left"></i> Trang trước</a>
        </li>
        @else
        <li><a href="{{ $paginator->previousPageUrl() }}"><i class="fa fa-chevron-left"></i> Trang trước</a></li>
        @endif

        @foreach ($elements as $element)
        @if (is_string($element))
        <li class="disabled">{{ $element }}</li>
        @endif

        @if (is_array($element))
        @foreach ($element as $page => $url)
        @if ($page == $paginator->currentPage())
        <li class="active">
            <a>{{ $page }}</a>
        </li>
        @else
        <li>
            <a href=" {{ $url }}">{{ $page }}</a>
        </li>
        @endif
        @endforeach
        @endif
        @endforeach

        @if ($paginator->hasMorePages())
        <li>
            <a href="{{ $paginator->nextPageUrl() }}" class="Next"> Trang sau <i class="fa fa-chevron-right"></i></a>
        </li>
        @else
        <li class="disabled">
            <a href="#" class="Next btn disabled"> Trang sau <i class="fa fa-chevron-right"></i></a>
        </li>
        @endif
    </ul>
</div>
@endif
