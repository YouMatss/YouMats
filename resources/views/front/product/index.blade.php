@extends('front.layouts.master')
@section('metaTags')
    <title>{{(!empty($product->meta_title)) ? $product->meta_title : $product->name}}</title>
    <meta name="description" content="{{(!empty($product->meta_desc)) ? $product->meta_desc : $product->short_desc}}">
    <meta name="keywords" content="{{$product->meta_keywords}}">

    <meta property="og:url" content="{{url()->current()}}" />
    <meta property="og:site_name" content="Youmats Building Materials">
    <meta property="og:title" content="{{(!empty($product->meta_title)) ? $product->meta_title : $product->name}}" />
    <meta property="og:description" content="{{(!empty($product->meta_desc)) ? $product->meta_desc : $product->short_desc}}" />
    <meta property="og:type" content="website" />
    <meta property="og:image" itemprop="image" content="{{ $product->getFirstMediaUrlOrDefault(PRODUCT_PATH)['url'] }}" />
    <meta property="og:image:type" content="image/jpeg">
    <meta property="og:image:width" content="300">
    <meta property="og:image:height" content="300">

    <meta name="twitter:card" content="summary">
    <meta name="twitter:site" content="@youmats">
    <meta name="twitter:creator" content="@youmats">
    <meta name="twitter:title" content="{{(!empty($product->meta_title)) ? $product->meta_title : $product->name}}">
    <meta name="twitter:description" content="{{(!empty($product->meta_desc)) ? $product->meta_desc : $product->short_desc}}">
    <meta name="twitter:image" content="{{$product->getFirstMediaUrlOrDefault(PRODUCT_PATH)['url']}}">
    <meta name="twitter:image:width" content="800">
    <meta name="twitter:image:height" content="418">

    {!! $product->schema !!}
    <script>
        ga('require', 'ec');
        ga('ec:addImpression', {
            'id': '{{$product->SKU}}',
            'name': '{{$product->name}}',
            'category': '{{$product->category->name}}',
            {{--'brand': '{{$product->vendor->name}}',--}}
        });
        ga('ec:addProduct', {
            'id': '{{$product->SKU}}',
            'name': '{{$product->name}}',
            'category': '{{$product->category->name}}',
{{--            'brand': '{{$product->vendor->name}}',--}}
        });
        ga('ec:setAction', 'detail');
    </script>
@endsection
@section('content')
    <div class="bg-gray-13 bg-md-transparent">
        <div class="container">
            <!-- breadcrumb -->
            <div class="my-md-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-3 flex-nowrap flex-xl-wrap overflow-auto overflow-xl-visble">
                        <li class="breadcrumb-item flex-shrink-0 flex-xl-shrink-1"><a href="{{route('home')}}">{{ __('general.home') }}</a></li>
                        @foreach($product->category->ancestors as $ancestor)
                        <li class="breadcrumb-item flex-shrink-0 flex-xl-shrink-1"><a href="{{route('front.category', [generatedNestedSlug($ancestor->ancestors()->pluck('slug')->toArray(), $ancestor->slug)])}}">{{$ancestor->name}}</a></li>
                        @endforeach
                        <li class="breadcrumb-item flex-shrink-0 flex-xl-shrink-1"><a href="{{route('front.category', [generatedNestedSlug($product->category->ancestors()->pluck('slug')->toArray(), $product->category->slug)])}}">{{$product->category->name}}</a></li>
                        <li class="breadcrumb-item flex-shrink-0 flex-xl-shrink-1 active" aria-current="page">{{$product->name}}</li>
                    </ol>
                </nav>
            </div>
            <!-- End breadcrumb -->
        </div>
    </div>
    <div class="container">
        <div class="mb-14">
            <div class="row rtl">
                <div class="col-md-6 col-lg-4 col-xl-5 mb-4 mb-md-0 ltr">
                    <div id="sliderSyncingNav" class="js-slick-carousel u-slick mb-2" data-infinite="true" data-arrows-classes="d-none d-lg-inline-block u-slick__arrow-classic u-slick__arrow-centered--y rounded-circle" data-arrow-left-classes="fas fa-arrow-left u-slick__arrow-classic-inner u-slick__arrow-classic-inner--left ml-lg-2 ml-xl-4" data-arrow-right-classes="fas fa-arrow-right u-slick__arrow-classic-inner u-slick__arrow-classic-inner--right mr-lg-2 mr-xl-4" data-nav-for="#sliderSyncingThumb">
                        @if(count($product->getMedia(PRODUCT_PATH)))
                        @foreach($product->getMedia(PRODUCT_PATH) as $image)
                            <div class="js-slide">
                                <img loading="lazy" class="img-fluid" src="{{$image->getFullUrl()}}" alt="{{$image->img_alt ?? ''}}" title="{{$image->img_title ?? ''}}">
                            </div>
                        @endforeach
                        @else
                            <div class="js-slide">
                                <img loading="lazy" class="img-fluid" src="{{$product->getFirstMediaUrlOrDefault(PRODUCT_PATH)['url']}}" alt="{{$product->getFirstMediaUrlOrDefault(PRODUCT_PATH)['alt']}}" title="{{$product->getFirstMediaUrlOrDefault(PRODUCT_PATH)['title']}}">
                            </div>
                        @endif
                    </div>
                    @if(count($product->getMedia(PRODUCT_PATH)) > 1)
                    <div id="sliderSyncingThumb" class="js-slick-carousel u-slick u-slick--slider-syncing u-slick--slider-syncing-size u-slick--gutters-1 u-slick--transform-off" data-infinite="true" data-slides-show="5" data-is-thumbs="true" data-nav-for="#sliderSyncingNav">
                        @foreach($product->getMedia(PRODUCT_PATH) as $thumb)
                        <div class="js-slide" style="cursor: pointer;">
                            <img loading="lazy" class="img-fluid" src="{{$thumb->getFullUrl()}}" alt="{{$thumb->img_alt ?? ''}}" title="{{$thumb->img_title ?? ''}}">
                        </div>
                        @endforeach
                    </div>
                    @endif
                </div>
                <div class="col-md-6 col-lg-4 col-xl-4 mb-md-6 mb-lg-0">
                    <div class="mb-2">
                        <a href="{{route('front.category', [generatedNestedSlug($product->category->ancestors()->pluck('slug')->toArray(), $product->category->slug)])}}" class="font-size-12 text-gray-5 mb-2 d-inline-block">{{$product->category->name}}</a>
                        <h2 class="font-size-25" style="line-height: 1.6">{{$product->name}}</h2>
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
                            <img loading="lazy" class="img-fluid" src="{{ Storage::url(nova_get_setting('logo')) }}">
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
                        @if(auth()->guard('admin')->check() && isset($product->vendor->name))
                            <div><strong>{{__('general.vendor')}}</strong>: {{$product->vendor->name}}</div>
                        @endif
                    </div>
                </div>
                <div class="mx-md-auto mx-lg-0 col-md-6 col-lg-4 col-xl-3">
                    <div class="mb-2">
                        <div class="card p-5 border-width-2 border-color-1 borders-radius-17">
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
                            @if(!is_company())
                                @if(isset($delivery))
                                    <div>
                                        <span>{{__('product.delivery_to_your_city')}}: <b>{{getCurrentCityName()}}</b></span>
                                        <br/>
                                        <span>{{__('product.delivery_price')}}:
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
                                @if($product->price)
                                <div class="mb-3">
                                    <div class="font-size-36">{{getCurrency('symbol')}} {{$product->formatted_price}}</div>
                                </div>
                                @endif
                            @endif

                            <div class="mb-3">
                                <div class="left-page-single">
                                    @if(is_company())
                                    <a href="{{ route('home') }}"> <i class="fa fa-user"></i> {{env('APP_NAME')}} </a>
                                    <a href="tel:+966502111754" class="phone_link" data-url=""> <i class="fa fa-phone" aria-hidden="true"></i> {{__('info.phone')}} </a>
                                    <a href="mailto:info@youmats.com"> <i class="fa fa-envelope"></i> {{__('info.email')}} </a>
                                    @endif
                                    <h3> {{__('product.how_to_pay')}} </h3>
                                    <p> {{__('product.how_to_pay_desc')}} </p>
                                </div>
                            </div>


                            @if(!Auth::guard('vendor')->check())
                                @if(is_company())
                                    {!! cartOrChat($product) !!}
                                @elseif($product->vendor->current_subscribe && in_array($product->vendor->current_subscribe->membership_id, [env('INDIVIDUAL_MEMBERSHIP_ID'), env('BOTH_MEMBERSHIP_ID')]))
                                    @if($product->price || $product->delivery)
                                        {!! cartOrChat($product) !!}
                                    @else
                                        <a class="cart-chat-category btn-primary transition-3d-hover" href="{{route('front.category', [generatedNestedSlug($product->category->ancestors()->pluck('slug')->toArray(), $product->category->slug)])}}">{{__('product.category_href')}}</a>
                                    @endif
                                @else
                                    <a class="cart-chat-category btn-primary transition-3d-hover" href="{{route('front.category', [generatedNestedSlug($product->category->ancestors()->pluck('slug')->toArray(), $product->category->slug)])}}">{{__('product.category_href')}}</a>
                                @endif
                                <div class="flex-content-center flex-wrap">
                                    <a data-url="{{ route('wishlist.add', ['product' => $product]) }}" class="text-gray-6 font-size-13 btn-add-wishlist pointer"><i class="ec ec-favorites mr-1 font-size-15"></i>{{__('product.wishlist')}}</a>
                                </div>
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
    </div>
    <div class="bg-gray-7 pt-6 pb-3 mb-6">
        <div class="container">
            <div class="js-scroll-nav">
                <div class="bg-white pt-4 pb-6 px-xl-11 px-md-5 px-4 mb-6 overflow-hidden">
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
                            <h2 class="font-size-24 mb-3">{{ __('product.description') }}</h2>
                            {!! $product->desc !!}
                            <div class="row">
                                <div class="col-md-6 text-right">
                                    <img loading="lazy" class="img-fluid" src="{{$product->getFirstMediaUrlOrDefault(PRODUCT_PATH)['url']}}" alt="{{$product->getFirstMediaUrlOrDefault(PRODUCT_PATH)['alt']}}" title="{{$product->getFirstMediaUrlOrDefault(PRODUCT_PATH)['title']}}">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="mb-5">
        <div class="bg-img-hero">

            <div class="container p-0">

                <div class="d-flex justify-content-between border-bottom border-color-1 flex-lg-nowrap flex-wrap border-md-down-top-0 border-md-down-bottom-0 mb-3 rtl">
                    <h2 class="section-title section-title__full mb-0 pb-2 font-size-22">{{ __('product.related_products') }}</h2>
                </div>

                <div class="mb-4 position-relative">
                    <div class="js-slick-carousel u-slick u-slick--gutters-0 position-static overflow-hidden u-slick-overflow-visble pb-5 pt-2 px-1" data-arrows-classes="u-slick__arrow u-slick__arrow--flat u-slick__arrow-centered--y rounded-circle" data-arrow-left-classes="fas fa-arrow-left u-slick__arrow-inner u-slick__arrow-inner--left ml-lg-2 ml-xl-n3" data-arrow-right-classes="fas fa-arrow-right u-slick__arrow-inner u-slick__arrow-inner--right mr-lg-2 mr-xl-n3" data-pagi-classes="text-center right-0 bottom-1 left-0 u-slick__pagination u-slick__pagination--long mb-0 z-index-n1 mt-3 pt-1" data-slides-show="7" data-slides-scroll="1"
                         data-responsive='[{
                                  "breakpoint": 1400,
                                  "settings": {
                                    "slidesToShow": 5
                                  }
                                }, {
                                    "breakpoint": 1200,
                                    "settings": {
                                      "slidesToShow": 3
                                    }
                                }, {
                                  "breakpoint": 992,
                                  "settings": {
                                    "slidesToShow": 2
                                  }
                                }, {
                                  "breakpoint": 768,
                                  "settings": {
                                    "slidesToShow": 2
                                  }
                                }, {
                                  "breakpoint": 554,
                                  "settings": {
                                    "slidesToShow": 2
                                  }
                                }]'>

                        @foreach($related_products as $r_product)
                        <div class="js-slide products-group">
                            <div class="product-item mx-1 remove-divider">
                                <div class="product-item__outer h-100">
                                    <div class="product-item__inner bg-white px-wd-3 p-2 p-md-3">
                                        <div class="product-item__body pb-xl-2">
                                            <div class="mb-2"><a href="{{route('front.category', [generatedNestedSlug($r_product->category->ancestors()->pluck('slug')->toArray(), $r_product->category->slug)])}}" class="font-size-12 text-gray-5">{{$r_product->category->name}}</a></div>
                                            <h5 class="mb-1 product-item__title"><a href="{{route('front.product', [generatedNestedSlug($r_product->category->ancestors()->pluck('slug')->toArray(), $r_product->category->slug), $r_product->slug])}}" class="text-blue font-weight-bold">{{$r_product->name}}</a></h5>
                                            <div class="mb-2">
                                                <a href="{{route('front.product', [generatedNestedSlug($r_product->category->ancestors()->pluck('slug')->toArray(), $r_product->category->slug), $r_product->slug])}}" class="a_img_pro d-block text-center">
                                                    <img loading="lazy" class="img-fluid" src="{{$r_product->getFirstMediaUrlOrDefault(PRODUCT_PATH)['url']}}" alt="{{$r_product->getFirstMediaUrlOrDefault(PRODUCT_PATH)['alt']}}" title="{{$r_product->getFirstMediaUrlOrDefault(PRODUCT_PATH)['title']}}">
                                                </a>
                                            </div>
                                            <div class="flex-center-between mb-1">
                                                <div class="prodcut-price">
                                                    @if((!is_company()) && $r_product->price)
                                                    <div class="text-gray-100">{{getCurrency('symbol')}} {{$r_product->formatted_price}}</div>
                                                    @endif
                                                </div>
{{--                                                {!! cartOrChat($r_product, false) !!}--}}
                                            </div>
                                        </div>
                                        @if(!Auth::guard('vendor')->check())
                                            <div class="product-item__footer">
                                                <div class="border-top pt-2 flex-center-between flex-wrap">
                                                    <a data-url="{{ route('wishlist.add', ['product' => $product]) }}" class="text-gray-6 font-size-13 btn-add-wishlist pointer"><i class="ec ec-favorites mr-1 font-size-15"></i> Wishlist</a>
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('front.layouts.partials.change_city', ['delivery_cities' => $delivery_cities, 'ajax' => true])
@endsection
