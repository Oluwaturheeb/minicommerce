@if ($paginator->hasPages())
<div class="row">
    <div class="col-lg-12">
        <div class="uren-paginatoin-area">
            <div class="row">
                <div class="col-lg-12">
                    <ul class="uren-pagination-box primary-color">
                        @if ($paginator->onFirstPage())
                        <li class="active"><a href="javascript:void(0)" @disabled(true)>Previous</a></li>
                        @else
                        <li class="active"><a href="{{ $paginator->previousPageUrl() }}">Previous</a></li>
                        @endif

                        @foreach ($elements as $element)
                            {{-- "Three Dots" Separator --}}
                            @if (is_string($element))
                            <li><a href="javascript:void(0)">{{ $element }}</a></li>
                                {{-- <li class="page-item disabled" aria-disabled="true"><span class="page-link">{{ $element }}</span></li> --}}
                            @endif

                            {{-- Array Of Links --}}
                            @if (is_array($element))
                                @foreach ($element as $page => $url)
                                    @if ($page == $paginator->currentPage())
                                    <li><a href="javascript:void(0)">{{ $page }}</a></li>
                                        {{-- <li class="page-item active" aria-current="page"><span class="page-link">{{ $page }}</span></li> --}}
                                    @else
                                        <li><a href="{{ $url }}">{{ $page }}</a></li>
                                        {{-- <li class="page-item"><a class="page-link" href="{{ $url }}">{{ $page }}</a></li> --}}
                                    @endif
                                @endforeach
                            @endif
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endif
