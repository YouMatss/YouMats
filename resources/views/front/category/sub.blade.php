@extends('front.layouts.master')
@section('metaTags')

    <title>{{getMetaTag($category, 'meta_title', $category->title . ' | ' . nova_get_setting_translate('site_name'))}}</title>
    <meta name="description" content="{{getMetaTag($category, 'meta_desc', nova_get_setting_translate('categories_additional_word') . ' ' . strip_tags($category->short_desc))}}">
    <meta name="keywords" content="{{getMetaTag($category, 'meta_keywords', '')}}">

    <meta property="og:url" content="{{url()->current()}}" />
    <meta property="og:title" content="{{getMetaTag($category, 'meta_title', $category->title . ' | ' . nova_get_setting_translate('site_name'))}}" />
    <meta property="og:description" content="{{getMetaTag($category, 'meta_desc', nova_get_setting_translate('categories_additional_word') . ' ' . strip_tags($category->short_desc))}}" />
    <meta property="og:image" content="{{$category->getFirstMediaUrlOrDefault(CATEGORY_PATH, 'size_350_350')['url']}}" />

    <meta name="twitter:card" content="summary">
    <meta name="twitter:site" content="@YouMats">
    <meta name="twitter:title" content="{{getMetaTag($category, 'meta_title', $category->title . ' | ' . nova_get_setting_translate('site_name'))}}">
    <meta name="twitter:description" content="{{getMetaTag($category, 'meta_desc', nova_get_setting_translate('categories_additional_word') . ' ' . strip_tags($category->short_desc))}}">
    <meta name="twitter:image" content="{{$category->getFirstMediaUrlOrDefault(CATEGORY_PATH, 'size_350_350')['url']}}">

    <link rel="canonical" href="{{url()->current()}}" />

    {!! $category->schema !!}
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
                        @foreach($category->ancestors as $ancestor)
                            <li class="breadcrumb-item flex-shrink-0 flex-xl-shrink-1" itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
                                <a itemprop="item" href="{{route('front.category', [generatedNestedSlug($ancestor->ancestors()->pluck('slug')->toArray(), $ancestor->slug)])}}"><span itemprop="name">{{$ancestor->name}}</span></a>
                                <meta itemprop="position" content="{{$loop->iteration + 1}}" />
                            </li>
                        @endforeach
                        <li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem" class="breadcrumb-item flex-shrink-0 flex-xl-shrink-1 active" aria-current="page"><span itemprop="name">{{$category->name}}</span>
                            <meta itemprop="position" content="{{count($category->ancestors) + 2}}" />
                        </li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>

    @if(count($subscribeVendors))
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="position-relative" style="direction: ltr">
                    <div class="js-slick-carousel u-slick u-slick--gutters-0 position-static overflow-hidden u-slick-overflow-visble pb-5 pt-2 px-1" data-pagi-classes="text-center right-0 bottom-1 left-0 u-slick__pagination u-slick__pagination--long mb-0 z-index-n1 mt-3 pt-1"
                         data-slides-show="6" data-slides-scroll="1"
                         data-responsive='[{"breakpoint": 1400,"settings": {"slidesToShow": 5}}, {"breakpoint": 1200,"settings": {"slidesToShow": 3}}, {"breakpoint": 992,"settings": {"slidesToShow": 2}}, {"breakpoint": 768,"settings": {"slidesToShow": 2}}, {"breakpoint": 554,"settings": {"slidesToShow": 2}}]'>
                        @foreach($subscribeVendors as $subscribeVendor)
                            <div class="js-slide products-group img-logos-new">
                                <div>
                                    <a href="{{ route('vendor.show', [$subscribeVendor->slug]) }}" class="d-block text-center">
                                        <img class="img-fluid img-logos-new" style="display: inline-block !important;height: 50px !important;"
                                             src="{{ $subscribeVendor->getFirstMediaUrlOrDefault(VENDOR_LOGO, 'size_height_50')['url'] }}"
                                             alt="{{ $subscribeVendor->getFirstMediaUrlOrDefault(VENDOR_LOGO)['alt'] }}"
                                             title="{{ $subscribeVendor->getFirstMediaUrlOrDefault(VENDOR_LOGO)['title'] }}">
                                    </a>
                                    <p class="text-gray-100">{{$subscribeVendor->name}}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif

    <div class="mb-6 bg-md-transparent">
        @if($category->getTranslation('title', app()->getLocale(), false))
        <div class="container mb-8">
            <div class="d-flex justify-content-between border-bottom border-color-1 flex-lg-nowrap flex-wrap border-md-down-top-0 border-md-down-bottom-0 mb-3 rtl">
                <h1 class="section-title section-title__full mb-0 pb-2 font-size-22">{{$category->getTranslation('title', app()->getLocale(), false)}}</h1>
            </div>
        </div>
        @endif
        <form method="get" action="{{url()->current()}}">
        <div class="container">
            <div class="row mb-8 rtl">
                <div class="show--filter d-block d-lg-none d-xl-none"> Show Filter <i class="fa fa-search"></i> </div>
                <div class="col-xl-3 col-wd-2gdot5 d-none d-lg-block d-xl-block hidden--search--filter">
                    @if(!is_company())
                    <div class="mb-6">
                        <div class="range-slider bg-gray-3 p-3">
                            <h4 class="font-size-14 mb-3 font-weight-bold">{{__('general.price')}}</h4>
                            <!-- Range Slider -->
                            <input class="js-range-slider" type="text" id="price_range"
                                   data-extra-classes="u-range-slider u-range-slider-indicator u-range-slider-grid"
                                   data-type="double" data-grid="false" data-hide-from-to="true" data-prefix="{{ getCurrency('symbol') }}"
                                   data-min="{{$minPrice}}" data-max="{{$maxPrice}}"
                                   data-from="{{(explode(';', request()->input('filter.price'))[0]) ?? $minPrice}}"
                                   data-to="{{(explode(';', request()->input('filter.price'))[1]) ?? $maxPrice}}" name="price"
                                   data-result-min="#rangeSliderExample3MinResultCategory"
                                   data-result-max="#rangeSliderExample3MaxResultCategory">
                            <!-- End Range Slider -->
                            <div class="mt-1 text-gray-111 d-flex mb-4">
                                <span class="mr-0dot5">{{__('general.price')}}: </span>
                                <span>{{ getCurrency('symbol') }} </span>
                                <span id="rangeSliderExample3MinResultCategory">{{$minPrice}}</span>
                                <span class="mx-0dot5"> — </span>
                                <span>{{ getCurrency('symbol') }} </span>
                                <span id="rangeSliderExample3MaxResultCategory">{{$maxPrice}}</span>
                            </div>
                            <button class="btn px-4 btn-primary-dark-w py-2 rounded-lg text-white" type="button" id="priceFilterBtn">{{__('general.search_button')}}</button>
                        </div>
                    </div>
                    @endif
                    @foreach($category->attributes as $attribute)
                    <div class="mb-6">
                        <div class="border-bottom border-color-1 mb-5">
                            <h3 class="section-title section-title__sm mb-0 pb-2 font-size-18">{{$attribute->key}}</h3>
                        </div>
                        <div class="border-bottom pb-4 mb-4 attr-container">
                            @foreach($attribute->values as $value)
                            <div class="form-group d-flex align-items-center justify-content-between mb-2 pb-1">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input filter-checkboxes" name="attributes"
                                           @if (in_array($value->id, explode(',', request()->input('filter.attributes')))) checked @endif
                                           value="{{$value->id}}" id="{{$attribute->id . '_' . $value->id}}">
                                    <label class="custom-control-label" for="{{$attribute->id . '_' . $value->id}}">{{$value->value}}</label>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    @endforeach
                    @if(count($category->getSiblings()))
                    <div class="mb-6">
                        <div class="border-bottom border-color-1 mb-5">
                            <h3 class="section-title section-title__sm mb-0 pb-2 font-size-18">{{__('general.categories')}}</h3>
                        </div>
                        <div class="border-bottom pb-4 mb-4 attr-container">
                            @foreach($category->getSiblings() as $sibling)
                            <div class="form-group d-flex align-items-center justify-content-between mb-2 pb-1">
                                <div class="custom-control custom-checkbox">
                                    <a @if($sibling->id == $category->id) style="font-weight: bold" @endif href="{{route('front.category', [generatedNestedSlug($sibling->ancestors()->pluck('slug')->toArray(), $sibling->slug)])}}">{{$sibling->name}}
{{--                                        <span class="text-gray-25 font-size-12 font-weight-norma3"> ({{count($sibling->products)}})</span>--}}
                                    </a>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    @endif
                    @if(count($tags))
                    <div class="mb-6 d-none">
                        <div class="border-bottom border-color-1 mb-5">
                            <h3 class="section-title section-title__sm mb-0 pb-2 font-size-18">{{__('general.search_tags')}}</h3>
                        </div>
                        <div class="border-bottom pb-4 mb-4 attr-container">
                            @foreach($tags as $tag)
                            <div class="form-group d-flex align-items-center justify-content-between mb-2 pb-1">
                                <div class="custom-control custom-checkbox">
                                    <a href="{{route('front.tag', [$tag->slug])}}" class="custom-control-label">{{$tag->name}}
                                        <span class="text-gray-25 font-size-12 font-weight-norma3"> ({{count($tag->products)}})</span>
                                    </a>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    @endif
                </div>
                <div class="col-xl-9 col-wd-9gdot5">
                    @if(count($category->children))
                    <div class="mb-6 bg-gray-7">
                        <div class="container">
                            <div class="row flex-nowrap flex-md-wrap overflow-auto overflow-md-visble rtl" style="padding-top: 15px">
                                @foreach($category->children as $child)
                                    <div class="col-md-4 col-lg-3 col-xl-4 col-xl-2gdot4 mb-3 flex-shrink-0 flex-md-shrink-1">
                                        <div class="bg-white overflow-hidden shadow-on-hover d-flex align-items-center" style="height: 100px !important;">
                                            <a href="{{route('front.category', [generatedNestedSlug($child->ancestors()->pluck('slug')->toArray(), $child->slug)])}}" class="d-block pr-2">
                                                <div class="media align-items-center">
                                                    <div class="pt-2">
                                                        <img loading="lazy" class="img-fluid img_category_page" src="{{$child->getFirstMediaUrlOrDefault(CATEGORY_PATH, 'size_85_85')['url']}}"
                                                             alt="{{$child->getFirstMediaUrlOrDefault(CATEGORY_PATH)['alt']}}" title="{{$child->getFirstMediaUrlOrDefault(CATEGORY_PATH)['title']}}">
                                                    </div>
                                                    <div class="ml-3 media-body">
                                                        <h2 class="mb-0 text-gray-90" style="font-size: 1rem;">{{$child->name}}</h2>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    @endif
                    <div id="productsContainer">
                        @include('front.category.productsContainer', ['category' => $category, 'products' => $products])
                    </div>
                </div>
            </div>
        </div>
        </form>
    </div>
    @if(is_individual())
        @include('front.layouts.partials.change_city')
    @endif
@endsection
@section('extraScripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            $(document).on('ready', function () {
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
