@extends('front.layouts.master')
@section('metaTags')
    <title>YouMats | Search</title>
    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta property="og:url" content="{{url()->current()}}" />
    <meta property="og:title" content="" />
    <meta property="og:description" content="" />
    <meta property="og:image" content="" />
    <meta name="twitter:card" content="summary">
    <meta name="twitter:site" content="@YouMats">
    <meta name="twitter:title" content="">
    <meta name="twitter:description" content="">
    <meta name="twitter:image" content="">
@endsection
@section('content')
    <div class="bg-gray-13 bg-md-transparent">
        <div class="container">
            <div class="my-md-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-3 flex-nowrap flex-xl-wrap overflow-auto overflow-xl-visble" itemscope itemtype="https://schema.org/BreadcrumbList">
                        <li class="breadcrumb-item flex-shrink-0 flex-xl-shrink-1"  itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
                            <a itemprop="item" href="{{route('home')}}"><span itemprop="name">{{__('general.home')}}</span></a>
                            <meta itemprop="position" content="1" />
                        </li>
                        <li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem" class="breadcrumb-item flex-shrink-0 flex-xl-shrink-1 active" aria-current="page"><span itemprop="name">{{ __('product.all_products') }}</span>
                            <meta itemprop="position" content="2" />
                        </li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <div class="mb-6 bg-md-transparent py-6">
        <div class="container">
            <div class="row mb-8">
                <div class="d-none d-xl-block col-xl-3 col-wd-2gdot5 ">
                    <div class="card p-5 border-width-2 border-color-1 borders-radius-17">
                        <div id="attributeRegion">
                            @if(isset($search_categories))
                            <div class="border-bottom mb-4">
                                <h4 class="font-size-14 mb-3 font-weight-bold text-left">{{__('search.categories_title')}}</h4>
                                @foreach(array_slice($search_categories, 0, 5) as $search_category)
                                <div class="form-group d-flex align-items-center justify-content-between mb-2 pb-1">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input category" value="{{$search_category->id}}" @if(in_array($search_category->id, $selected_categories)) checked @endif id="cat-{{$search_category->id}}">
                                        <label class="custom-control-label" for="cat-{{$search_category->id}}">{{$search_category->name}}</label>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                            @endif
                            @if(isset($search_tags))
                            <div class="border-bottom mb-4">
                                <h4 class="font-size-14 mb-3 font-weight-bold text-left">{{__('search.tags_title')}}</h4>
                                @foreach($search_tags as $search_tag)
                                <div class="form-group d-flex align-items-center justify-content-between mb-2 pb-1">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input tag" value="{{$search_tag->id}}" @if(in_array($search_tag->id, $selected_tags)) checked @endif id="tag-{{$search_tag->id}}">
                                        <label class="custom-control-label" for="tag-{{$search_tag->id}}">{{$search_tag->name}}</label>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                            @endif
                        </div>
                        <div class="range-slider">
                            <h4 class="font-size-14 mb-3 font-weight-bold text-left">{{__('search.price_title')}}</h4>
                            <div id="priceRegion">
                                <!-- Range Slider -->
                                <input class="js-range-slider" type="text"
                                       data-extra-classes="u-range-slider u-range-slider-indicator u-range-slider-grid"
                                       data-type="double"
                                       data-grid="false"
                                       data-hide-from-to="true"
                                       data-prefix="{{ getCurrency('symbol') }}"
                                       data-min="0"
                                       data-max="{{($max_price) ?? 0}}"
                                       data-from="0"
                                       data-to="{{($max_price) ?? 0}}"
                                       data-result-min="#rangeSliderExample3MinResult"
                                       data-result-max="#rangeSliderExample3MaxResult">
                                <!-- End Range Slider -->
                                <div class="mt-1 text-gray-111 d-flex mb-4">
                                    <span class="mr-0dot5">{{__('search.price_slider')}} </span>
                                    <span> {{ getCurrency('symbol') }} </span>
                                    <span id="rangeSliderExample3MinResult"></span>
                                    <span class="mx-0dot5"> — </span>
                                    <span> {{ getCurrency('symbol') }} </span>
                                    <span id="rangeSliderExample3MaxResult">{{($max_price) ?? 0}}</span>
                                </div>
                            </div>
                            <button type="submit" class="btn px-4 btn-primary-dark-w py-2 rounded-lg text-white" id="searchFilterBtn"><span> {{ __('search.button') }}</span></button>
                        </div>
                    </div>
                </div>
                <div class="col-xl-9">

                    <div class="d-block d-md-flex flex-center-between mb-3 rtl">
                        <h3 class="font-size-25 mb-2 mb-md-0">{{ __('product.all_products') }}</h3>
                        <p class="font-size-14 text-gray-90 mb-0">{{__('general.showing')}} {{ $search_products->firstItem()  }}–{{ $search_products->lastItem() }} {{__('general.of')}} {{ $search_products->total() }} {{__('general.results')}}</p>
                    </div>

                    <!-- Shop-control-bar -->
                    <div class="bg-gray-1 flex-center-between borders-radius-9 py-1 rtl">
                        <div class="px-3 d-none d-xl-block">
                            <ul class="nav nav-tab-shop" id="pills-tab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="grid-view-tab" data-toggle="pill" href="#grid-view" role="tab" aria-controls="grid-view" aria-selected="false">
                                        <div class="d-md-flex justify-content-md-center align-items-md-center">
                                            <i class="fa fa-th"></i>
                                        </div>
                                    </a>
                                </li>
{{--                                <li class="nav-item">--}}
{{--                                    <a class="nav-link" id="list-view-tab" data-toggle="pill" href="#list-view" role="tab" aria-controls="list-view" aria-selected="true">--}}
{{--                                        <div class="d-md-flex justify-content-md-center align-items-md-center">--}}
{{--                                            <i class="fa fa-th-list"></i>--}}
{{--                                        </div>--}}
{{--                                    </a>--}}
{{--                                </li>--}}
                            </ul>
                        </div>
                        <nav class="px-3 flex-horizontal-center text-gray-20 d-none d-xl-flex">
                            <a class="text-gray-30 font-size-20 mr-2" href="{{$search_products->previousPageUrl()}}">
                                @if(app()->getLocale() == 'ar')
                                    &nbsp;→&nbsp;
                                @else
                                    &nbsp;←&nbsp;
                                @endif
                            </a>
                            <b>{{$search_products->currentPage()}} </b> &nbsp; {{__('general.of')}} {{$search_products->lastPage()}}
                            <a class="text-gray-30 font-size-20 ml-2" href="{{$search_products->nextPageUrl()}}">
                                @if(app()->getLocale() == 'ar')
                                    &nbsp;←&nbsp;
                                @else
                                    &nbsp;→&nbsp;
                                @endif
                            </a>
                        </nav>
                    </div>
                    <!-- End Shop-control-bar -->

                    <!-- Tab Content -->
                    <div class="tab-content" id="pills-tabContent">
                        <div class="tab-pane fade pt-2 show active" id="grid-view" role="tabpanel" aria-labelledby="grid-view-tab" data-target-group="groups">
                            <ul class="row list-unstyled products-group no-gutters">
                                @foreach($search_products as $product)
                                    @if(isset($product->category))
                                    <li class="col-6 col-md-3 col-wd-2gdot4 product-item st_new">
                                        @include('front.layouts.partials.product_box', ['product' => $product, 'view' => 'grid'])
                                    </li>
                                    @endif
                                @endforeach
                            </ul>
                        </div>
{{--                        <div class="tab-pane fade pt-2" id="list-view" role="tabpanel" aria-labelledby="list-view-tab" data-target-group="groups">--}}
{{--                            <ul class="d-block list-unstyled products-group prodcut-list-view-small">--}}
{{--                                @foreach($search_products as $product)--}}
{{--                                    @if(isset($product->category))--}}
{{--                                    @include('front.layouts.partials.product_box', ['product' => $product, 'view' => 'list'])--}}
{{--                                    @endif--}}
{{--                                @endforeach--}}
{{--                            </ul>--}}
{{--                        </div>--}}
                    </div>
                    <!-- End Tab Content -->
                    <nav class="d-md-flex justify-content-between align-items-center border-top pt-3" aria-label="Page navigation example">
                        <ul class="pagination mb-0 pagination-shop justify-content-center justify-content-md-start">
                            {{$search_products->onEachSide(0)->links()}}
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('extraScripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            $(document).on('ready', function () {

                $('.show--filter').on('click', function () {
                    $('.hidden--search--filter').toggleClass('d-none');
                });

                function getAttributesIds(checkboxName) {
                    let checkBoxes = document.getElementsByName(checkboxName);
                    let ids = Array.prototype.slice.call(checkBoxes)
                        .filter(ch => ch.checked == true)
                        .map(ch => ch.value);
                    return ids;
                }

                function filterResults() {
                    let attributesIds = getAttributesIds("attributes");
                    let href = '?';
                    if (attributesIds.length) {
                        href += 'filter[attributes]=' + attributesIds;
                    }
                    if ($('#is_price').is(':checked')) {
                        href += '&filter[is_price]=' + $('#is_price').val();
                    }
                    if ($('#is_delivery').is(':checked')) {
                        href += '&filter[is_delivery]=' + $('#is_delivery').val();
                    }
                    if ($('#price_range').val()) {
                        href += '&filter[price]=' + $('#price_range').val();
                    }
                    if ($('#city_select').val()) {
                        href += '&filter[city]=' + $('#city_select').val();
                    }
                    if ($('#sort_select').val()) {
                        href += '&sort=' + $('#sort_select').val();
                    }

                    document.location.href = href;
                }

                $(document).on('change', '.filter-checkboxes', function () {
                    filterResults();
                });
                $(document).on('click', '#priceFilterBtn', function () {
                    filterResults();
                });
                $(document).on('click', '#city_submit', function () {
                    filterResults();
                });
                $(document).on('change', '#sort_select', function () {
                    filterResults();
                });
                $(document).on('change', '#is_price', function () {
                    filterResults();
                });
                $(document).on('change', '#is_delivery', function () {
                    filterResults();
                });
            });
        });
    </script>
@endsection
