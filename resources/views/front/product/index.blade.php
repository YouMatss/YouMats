@extends('front.layouts.master')
@section('metaTags')
    <title>{{getMetaTag($product, 'meta_title', nova_get_setting_translate('products_additional_word') . ' ' . $product->name)}}</title>
    <meta name="description" content="{{getMetaTag($product, 'meta_desc', strip_tags($product->short_desc), strip_tags($product->desc))}}">
    <meta name="keywords" content="{{getMetaTag($product, 'meta_keywords', '')}}">

    <meta property="og:url" content="{{url()->current()}}" />
    <meta property="og:site_name" content="Youmats Building Materials">
    <meta property="og:title" content="{{getMetaTag($product, 'meta_title', nova_get_setting_translate('products_additional_word') . ' ' . $product->name)}}" />
    <meta property="og:description" content="{{getMetaTag($product, 'meta_desc', strip_tags($product->short_desc), strip_tags($product->desc))}}" />
    <meta property="og:type" content="website" />
    <meta property="og:image" itemprop="image" content="{{ $product->getFirstMediaUrlOrDefault(PRODUCT_PATH, 'size_300_300')['url'] }}" />
    <meta property="og:image:type" content="image/jpeg">
    <meta property="og:image:width" content="300">
    <meta property="og:image:height" content="300">

    <meta name="twitter:card" content="summary">
    <meta name="twitter:site" content="@youmats">
    <meta name="twitter:creator" content="@youmats">
    <meta name="twitter:title" content="{{getMetaTag($product, 'meta_title', nova_get_setting_translate('products_additional_word') . ' ' . $product->name)}}">
    <meta name="twitter:description" content="{{getMetaTag($product, 'meta_desc', strip_tags($product->short_desc), strip_tags($product->desc))}}">
    <meta name="twitter:image" content="{{$product->getFirstMediaUrlOrDefault(PRODUCT_PATH, 'size_300_300')['url']}}">
    <meta name="twitter:image:width" content="800">
    <meta name="twitter:image:height" content="418">

    <style> video { display: none; } </style>

    {!! $product->getTranslation('canonical', LaravelLocalization::getCurrentLocale(), false) !!}

    {!! $product->schema !!}

{{--    <script>--}}
{{--        ga('require', 'ec');--}}
{{--        ga('ec:addImpression', {--}}
{{--            'id': '{{$product->SKU}}',--}}
{{--            'name': '{{$product->name}}',--}}
{{--            'category': '{{$product->category->name}}',--}}
{{--            --}}{{--'brand': '{{$product->vendor->name}}',--}}
{{--        });--}}
{{--        ga('ec:addProduct', {--}}
{{--            'id': '{{$product->SKU}}',--}}
{{--            'name': '{{$product->name}}',--}}
{{--            'category': '{{$product->category->name}}',--}}
{{--            'brand': '{{$product->vendor->name}}',--}}
{{--        });--}}
{{--        ga('ec:setAction', 'detail');--}}
{{--    </script>--}}
@endsection
@section('extraStyles')
    <style>
        .carousel-indicators {
            position: relative;
        }
        .carousel-indicators li {
            text-indent: unset;
            height: auto;
            width: 50px;
        }
        .list-inline-item:not(:last-child) {
            margin-right: 1rem;
        }
        .carousel-item img {
            width: 100%;
        }
        .carousel-control-prev i, .carousel-control-next i {
            opacity: 1;
            background-color: #003f91;
            color: #fff;
            width: 30px;
            height: 30px;
            text-align: center;
            line-height: 30px;
            border-radius: 50%;
        }
    </style>
@endsection
@section('content')
    <div class="bg-gray-13 bg-md-transparent">
        <div class="container">
            <!-- breadcrumb -->
            <div class="my-md-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-3 flex-nowrap flex-xl-wrap overflow-auto overflow-xl-visble" itemscope itemtype="https://schema.org/BreadcrumbList">
                        <li class="breadcrumb-item flex-shrink-0 flex-xl-shrink-1"  itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
                            <a itemprop="item" href="{{route('home')}}"><span itemprop="name">{{__('general.home')}}</span></a>
                            <meta itemprop="position" content="1" />
                        </li>
                        @foreach($product->category->ancestors as $ancestor)
                        <li class="breadcrumb-item flex-shrink-0 flex-xl-shrink-1" itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
                            <a itemprop="item" href="{{route('front.category', [generatedNestedSlug($ancestor->ancestors()->pluck('slug')->toArray(), $ancestor->slug)])}}"><span itemprop="name">{{$ancestor->name}}</span></a>
                            <meta itemprop="position" content="{{$loop->iteration + 1}}" />
                        </li>
                        @endforeach
                        <li class="breadcrumb-item flex-shrink-0 flex-xl-shrink-1" itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
                            <a itemprop="item" href="{{route('front.category', [generatedNestedSlug($product->category->ancestors()->pluck('slug')->toArray(), $product->category->slug)])}}"><span itemprop="name">{{$product->category->name}}</span></a>
                            <meta itemprop="position" content="{{count($product->category->ancestors) + 2}}" />
                        </li>
                        <li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem" class="breadcrumb-item flex-shrink-0 flex-xl-shrink-1 active" aria-current="page"><span itemprop="name">{{$product->name}}</span>
                            <meta itemprop="position" content="{{count($product->category->ancestors) + 3}}" />
                        </li>
                    </ol>
                </nav>
            </div>
            <!-- End breadcrumb -->
        </div>
    </div>
    <div class="container">
        <div class="row rtl">
            <div class="col-md-6 col-lg-4 col-xl-5 mb-4 mb-md-0 ltr">
                <div id="gallery-carousel" class="carousel slide" data-ride="carousel" align="center">
                    <!-- slides -->
                    <div class="carousel-inner">
                        @if(count($product->getMedia(PRODUCT_PATH)) > 0)
                            @foreach($product->getMedia(PRODUCT_PATH) as $image)
                                <div class="carousel-item @if($loop->first) active @endif">
                                    <img loading="lazy"
                                         src="{{$image->getFullUrl('size_500_500')}}"
                                         alt="{{$image->img_alt ?? ''}}"
                                         title="{{$image->img_title ?? ''}}">
                                </div>
                            @endforeach
                        @else
                            <div class="carousel-item active">
                                <img loading="lazy"
                                     src="{{$product->getFirstMediaUrlOrDefault(PRODUCT_PATH, 'size_500_500')['url']}}"
                                     alt="{{$product->getFirstMediaUrlOrDefault(PRODUCT_PATH)['alt']}}"
                                     title="{{$product->getFirstMediaUrlOrDefault(PRODUCT_PATH)['title']}}">
                            </div>
                        @endif
                    </div>

                    <!-- Left right -->
                    <a class="carousel-control-prev" href="#gallery-carousel" data-slide="prev">
                        <i class="fa fa-arrow-left"></i>
                    </a>
                    <a class="carousel-control-next" href="#gallery-carousel" data-slide="next">
                        <i class="fa fa-arrow-right"></i>
                    </a>

                    @if(count($product->getMedia(PRODUCT_PATH)) > 1)
                    <!-- Thumbnails -->
                    <ol class="carousel-indicators list-inline">
                        @foreach($product->getMedia(PRODUCT_PATH) as $thumb)
                            <li class="list-inline-item @if($loop->first) active @endif">
                                <a id="carousel-selector-{{$loop->index}}"
                                    data-slide-to="{{$loop->index}}" data-target="#gallery-carousel">
                                    <img loading="lazy" class="img-fluid"
                                         src="{{$thumb->getFullUrl('size_50_50')}}"
                                         alt="{{$thumb->img_alt ?? ''}}"
                                         title="{{$thumb->img_title ?? ''}}">
                                </a>
                            </li>
                        @endforeach
                    </ol>
                    @endif
                </div>
            </div>
            <div class="col-md-6 col-lg-4 col-xl-4 mb-md-6 mb-lg-0">
                <div class="mb-2">
                    <a href="{{route('front.category', [generatedNestedSlug($product->category->ancestors()->pluck('slug')->toArray(), $product->category->slug)])}}" class="font-size-12 text-gray-5 mb-2 d-inline-block">{{$product->category->name}}</a>
                    <h1 class="font-size-25" style="line-height: 1.6">{{$product->name}}</h1>
                    <div class="mb-2">
                        <a class="d-inline-flex align-items-center small font-size-15 text-lh-1">
{{--                                <div class="text-warning mr-2">--}}
{{--                                    @for($i=1;$i<=$product->rate;$i++)--}}
{{--                                        <small class="fas fa-star"></small>--}}
{{--                                    @endfor--}}
{{--                                    @for($i=5;$i>$product->rate;$i--)--}}
{{--                                        <small class="far fa-star text-muted"></small>--}}
{{--                                    @endfor--}}
{{--                                    {{$product->rate}}--}}
{{--                                </div>--}}
                            &nbsp;
                            <span class="text-secondary font-size-13">({{$product->views}} {{__('product.views')}})</span>
                        </a>
                    </div>
                    <a href="{{ route('home') }}" class="d-inline-block max-width-150 ml-n2 mb-2">
                        <img loading="lazy" class="img-fluid" src="{{ $staticImages->getFirstMediaUrlOrDefault(LOGO_PATH, 'size_height_45')['url'] }}">
                    </a>
                    {{--<div class="mb-2">--}}
                        {{--<ul class="font-size-14 pl-3 ml-1 text-gray-9">--}}
                            {{--@foreach($product->tags as $tag)--}}
                            {{--<li><a href="{{route('front.tag', [$tag->slug])}}">{{$tag->name}}</a></li>--}}
                            {{--@endforeach--}}
                        {{--</ul>--}}
                    {{--</div>--}}

                    <p>{!! $product->short_desc !!}</p>
{{--                        <div><strong>{{__('general.sku')}}</strong>: {{$product->SKU}}</div>--}}
                    @if(isset($product->vendor) && $product->subscribe)
                        <a href="{{ route('vendor.show', [$product->vendor->slug]) }}" class="badge badge-primary text-white" style="
                                border-radius: 1px;
                                font-weight: bold;
                                padding: 1em 0.4em;
                                background-color: #333;
                                font-size: 75%;
                            ">{{\Str::limit($product->vendor->name, 20)}}</a>
                    @endif
                </div>
            </div>
            <div class="mx-md-auto mx-lg-0 col-md-6 col-lg-4 col-xl-3">
                <div class="mb-2">
                    <div class="card p-5 border-width-2 border-color-1 borders-radius-17">
                        @if(!$product->category->hide_availability)
                        <div class="text-gray-9 font-size-14 pb-2 border-color-1 border-bottom mb-3">
                            @if(is_company())
                                <span class="text-green font-weight-bold">{{__('product.in_stock')}}</span>
                            @else
                                @if($product->stock && $product->stock >= $product->min_quantity)
                                    <span class="text-green font-weight-bold">{{__('product.in_stock')}}</span>
                                @else
                                    <span class="text-red font-weight-bold">{{__('product.out_of_stock')}}</span>
                                @endif
                            @endif
                        </div>
                        @endif
                        @if(!is_company())
                            @if(!$product->category->hide_delivery_status)
                                @if(isset($delivery))
                                    <div>
                                        <span>{{__('product.delivery_to_your_city')}}: <b>{{getCurrentCityName()}}</b></span>
                                        <br/>
                                        <span>{{__('product.delivery_price')}} {{$product->min_quantity}} {{__('product.piece')}}:
                                            @if($delivery['price'] > 0)
                                            <b>{{getCurrency('symbol')}} {{round($delivery['price'] * getCurrency('rate'), 2)}}</b>
                                            @else
                                            <b>{{__('product.delivery_free')}}</b>
                                            @endif
                                        </span>
                                        <br/>
                                        <span>{{__('product.delivery_time')}}: <b>{{$delivery['time']}} {{($delivery['format'] == 'hour') ? __('product.delivery_hours') : __('product.delivery_days') }}</b></span>
                                        <button type="button" class="btn btn-block btn-xs btn-primary mt-2 choose_city" data-toggle="modal" data-target=".change_city_modal">{{__('product.delivery_change_city_button')}}</button>
                                    </div>
                                @else
                                    <div>
                                        <span style="color:#ff0000;margin-bottom: 10px;display: inline-block;">{{__('product.no_delivery')}}: {{getCurrentCityName()}}</span>
                                        @if(!is_null($delivery_cities))
                                        <button type="button" class="choose_city btn btn-primary btn-xs" data-toggle="modal" data-target=".change_city_modal">{{__('product.delivery_change_city_button')}}</button>
                                        @endif
                                    </div>
                                @endif
                            @endif
                            @if($product->price)
                            <div class="mb-3">
                                <div class="font-size-36">{{getCurrency('symbol')}} {{$product->formatted_price}}</div>
                            </div>
                            @endif
                        @endif

                        <div class="mb-3">
                            <div class="left-page-single">
                                @if(is_company() && $product->subscribe && isset($contact))
                                    <a href="#"> <i class="fa fa-user"></i>&nbsp;&nbsp;{{ $contact['person_name'] }} </a>
                                    <a href="mailto:{{ $contact['email'] }}" class="log" data-log="email"> <i class="fa fa-envelope"></i>&nbsp;&nbsp;{{ $contact['email'] }} </a>
                                @endif
                                @if($product->price && $product->price > 0 && $product->delivery && $product->stock && $product->stock >= $product->min_quantity) {
                                    <h3> {{__('product.how_to_pay')}} </h3>
                                    <p> {{__('product.how_to_pay_desc')}} </p>
                                @endif
                            </div>
                        </div>

                        @if(!Auth::guard('vendor')->check())
                            {!! cartOrChat($product) !!}
{{--                            <div class="flex-content-center flex-wrap">--}}
{{--                                <a data-url="{{ route('wishlist.add', ['product' => $product]) }}" class="text-gray-6 font-size-13 btn-add-wishlist pointer"><i class="ec ec-favorites mr-1 font-size-15"></i>{{__('product.wishlist')}}</a>--}}
{{--                            </div>--}}
                        @endif
                    </div>
                </div>
                <div class="mb-2">
                    <ul class="font-size-14 pl-3 ml-1 text-gray-9 style_tags">
                        @foreach($product->tags as $tag)
                            <li><a href="{{route('front.tag', [$tag->slug])}}">{{$tag->name}}  </a></li>
                        @endforeach
                    </ul>
                </div>

            </div>
        </div>
    </div>
    <div class="bg-gray-7 pt-6 pb-3 mb-6">
        <div class="container">
            <div class="js-scroll-nav">
                <div class="bg-white pt-4 px-xl-11 px-md-5 px-4 mb-6 overflow-hidden">
                    <div id="Description" class="mx-md-2">
                        <div class="position-relative mb-6">
                            <ul class="nav nav-classic nav-tab nav-tab-lg justify-content-center mb-6 flex-nowrap flex-xl-wrap overflow-auto overflow-xl-visble border-lg-down-bottom-0 pb-1 pb-xl-0 mb-n1 mb-xl-0">
                                <li class="nav-item flex-shrink-0 flex-xl-shrink-1 z-index-2">
                                    <a class="nav-link active" href="#Description">
                                        <div class="d-md-flex justify-content-md-center align-items-md-center">
                                            {{ __('product.about') }}
                                        </div>
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <div class="mx-md-4 pt-1 ti_rtl rtl">
                            <div class="row">
                                <div class="col-md-6">
                                    <h2 class="font-size-24 mb-3">{{ __('product.description') }}</h2>
                                    {!! $product->desc !!}
                                </div>
                                <div class="col-md-6 text-right">
                                    <img loading="lazy" class="img-fluid" src="{{$product->getFirstMediaUrlOrDefault(PRODUCT_PATH, 'size_500_500')['url']}}" alt="{{$product->getFirstMediaUrlOrDefault(PRODUCT_PATH)['alt']}}" title="{{$product->getFirstMediaUrlOrDefault(PRODUCT_PATH)['title']}}">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @if(isset($same_vendor_products))
    <div class="mb-5">
        <div class="bg-img-hero">
            <div class="container p-0">
                <div class="d-flex justify-content-between border-bottom border-color-1 flex-lg-nowrap flex-wrap border-md-down-top-0 border-md-down-bottom-0 mb-3 rtl">
                    <h2 class="section-title section-title__full mb-0 pb-2 font-size-22"><a href="{{ route('vendor.show', [$product->vendor->slug]) }}">{{ __('product.products') . ' ' . $product->vendor->name }}</a></h2>
                </div>

                <div class="mb-4 position-relative">
                    <div
                        class="js-slick-carousel u-slick u-slick--gutters-0 position-static overflow-hidden u-slick-overflow-visble pb-5 pt-2 px-1"
                        data-arrows-classes="u-slick__arrow u-slick__arrow--flat u-slick__arrow-centered--y rounded-circle"
                        data-pagi-classes="text-center right-0 bottom-1 left-0 u-slick__pagination u-slick__pagination--long mb-0 z-index-n1 mt-3 pt-1"
                        data-arrow-left-classes="fas fa-arrow-left u-slick__arrow-inner u-slick__arrow-inner--left ml-lg-2 ml-xl-n3"
                        data-arrow-right-classes="fas fa-arrow-right u-slick__arrow-inner u-slick__arrow-inner--right mr-lg-2 mr-xl-n3"
                        data-slick='{"autoplay": true, "infinite": true, "slidesToShow": 7, "dots": false
                            @if(LaravelLocalization::getCurrentLocaleDirection() == 'rtl')
                            ,"rtl": true
                            @endif
                         }'
                        data-responsive='[{"breakpoint": 1400,"settings": {"slidesToShow": 5}}, {"breakpoint": 1200,"settings": {"slidesToShow": 3}}, {"breakpoint": 992,"settings": {"slidesToShow": 2}}, {"breakpoint": 768,"settings": {"slidesToShow": 2}}, {"breakpoint": 554, "settings": {"slidesToShow": 2}}]'>
                        @foreach($same_vendor_products as $same_vendor_product)
                        <div class="js-slide products-group">
                            <div class="product-item mx-1 remove-divider">
                                @include('front.layouts.partials.product_box', ['product' => $same_vendor_product, 'view' => 'grid'])
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif

    @foreach($subscribed_vendors as $subscribed_vendor)
        <div class="mb-5">
            <div class="bg-img-hero">
                <div class="container p-0">
                    <div class="d-flex justify-content-between border-bottom border-color-1 flex-lg-nowrap flex-wrap border-md-down-top-0 border-md-down-bottom-0 mb-3 rtl">
                        <h2 class="section-title section-title__full mb-0 pb-2 font-size-22"><a href="{{ route('vendor.show', [$subscribed_vendor->slug]) }}">{{  __('product.products') . ' ' . $subscribed_vendor->name }}</a></h2>
                    </div>

                    <div class="mb-4 position-relative">
                        <div
                            class="js-slick-carousel u-slick u-slick--gutters-0 position-static overflow-hidden u-slick-overflow-visble pb-5 pt-2 px-1"
                            data-arrows-classes="u-slick__arrow u-slick__arrow--flat u-slick__arrow-centered--y rounded-circle"
                            data-pagi-classes="text-center right-0 bottom-1 left-0 u-slick__pagination u-slick__pagination--long mb-0 z-index-n1 mt-3 pt-1"
                            data-arrow-left-classes="fas fa-arrow-left u-slick__arrow-inner u-slick__arrow-inner--left ml-lg-2 ml-xl-n3"
                            data-arrow-right-classes="fas fa-arrow-right u-slick__arrow-inner u-slick__arrow-inner--right mr-lg-2 mr-xl-n3"
                            data-slick='{"autoplay": true, "infinite": true, "slidesToShow": 7, "dots": false
                            @if(LaravelLocalization::getCurrentLocaleDirection() == 'rtl')
                            ,"rtl": true
                            @endif
                         }'
                            data-responsive='[{"breakpoint": 1400,"settings": {"slidesToShow": 5}}, {"breakpoint": 1200,"settings": {"slidesToShow": 3}}, {"breakpoint": 992,"settings": {"slidesToShow": 2}}, {"breakpoint": 768,"settings": {"slidesToShow": 2}}, {"breakpoint": 554, "settings": {"slidesToShow": 2}}]'>
                            @foreach($subscribed_vendor->products->take(10) as $subscribed_vendor_product)
                                <div class="js-slide products-group">
                                    <div class="product-item mx-1 remove-divider">
                                        @include('front.layouts.partials.product_box', ['product' => $subscribed_vendor_product, 'view' => 'grid'])
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach

    <div class="mb-5">
        <div class="bg-img-hero">
            <div class="container p-0">
                <div class="d-flex justify-content-between border-bottom border-color-1 flex-lg-nowrap flex-wrap border-md-down-top-0 border-md-down-bottom-0 mb-3 rtl">
                    <h2 class="section-title section-title__full mb-0 pb-2 font-size-22"><a href="{{route('front.category', [generatedNestedSlug($product->category->ancestors()->pluck('slug')->toArray(), $product->category->slug)])}}">{{ __('product.same_category_title') . ' ' . $product->category->name }}</a></h2>
                </div>

                <div class="mb-4 position-relative">
                    <div
                        class="js-slick-carousel u-slick u-slick--gutters-0 position-static overflow-hidden u-slick-overflow-visble pb-5 pt-2 px-1"
                        data-arrows-classes="u-slick__arrow u-slick__arrow--flat u-slick__arrow-centered--y rounded-circle"
                        data-pagi-classes="text-center right-0 bottom-1 left-0 u-slick__pagination u-slick__pagination--long mb-0 z-index-n1 mt-3 pt-1"
                        data-arrow-left-classes="fas fa-arrow-left u-slick__arrow-inner u-slick__arrow-inner--left ml-lg-2 ml-xl-n3"
                        data-arrow-right-classes="fas fa-arrow-right u-slick__arrow-inner u-slick__arrow-inner--right mr-lg-2 mr-xl-n3"
                        data-slick='{"autoplay": true, "infinite": true, "slidesToShow": 7, "dots": false
                            @if(LaravelLocalization::getCurrentLocaleDirection() == 'rtl')
                            ,"rtl": true
                            @endif
                         }'
                        data-responsive='[{"breakpoint": 1400,"settings": {"slidesToShow": 5}}, {"breakpoint": 1200,"settings": {"slidesToShow": 3}}, {"breakpoint": 992,"settings": {"slidesToShow": 2}}, {"breakpoint": 768,"settings": {"slidesToShow": 2}}, {"breakpoint": 554, "settings": {"slidesToShow": 2}}]'>
                        @foreach($same_category_products as $same_category_product)
                            <div class="js-slide products-group">
                                <div class="product-item mx-1 remove-divider">
                                    @include('front.layouts.partials.product_box', ['product' => $same_category_product, 'view' => 'grid'])
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('front.layouts.partials.change_city', ['delivery_cities' => $delivery_cities, 'ajax' => true])
    @include('front.layouts.partials.clickToCall')
@endsection
