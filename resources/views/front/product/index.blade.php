@extends('front.layouts.master')
@section('metaTags')
    <title>{{$product->meta_title}}</title>
    <meta name="description" content="{{$product->meta_desc}}">
    <meta name="keywords" content="{{$product->meta_keywords}}">
    <meta property="og:url" content="{{url()->current()}}" />
    <meta property="og:title" content="{{$product->meta_title}}" />
    <meta property="og:description" content="{{$product->meta_desc}}" />
    <meta property="og:image" content="{{ $product->getFirstMediaUrlOrDefault(PRODUCT_PATH)['url'] }}" />
    <meta name="twitter:card" content="summary">
    <meta name="twitter:site" content="@YouMats">
    <meta name="twitter:title" content="{{$product->meta_title}}">
    <meta name="twitter:description" content="{{$product->meta_desc}}">
    <meta name="twitter:image" content="{{$product->getFirstMediaUrlOrDefault(PRODUCT_PATH)['url']}}">
@endsection
@section('content')
    <div class="bg-gray-13 bg-md-transparent">
        <div class="container">
            <!-- breadcrumb -->
            <div class="my-md-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-3 flex-nowrap flex-xl-wrap overflow-auto overflow-xl-visble">
                        <li class="breadcrumb-item flex-shrink-0 flex-xl-shrink-1"><a href="{{route('home')}}">Home</a></li>
                        <li class="breadcrumb-item flex-shrink-0 flex-xl-shrink-1"><a href="{{route('front.category', [$product->subCategory->category->slug])}}">{{$product->subCategory->category->name}}</a></li>
                        <li class="breadcrumb-item flex-shrink-0 flex-xl-shrink-1"><a href="{{route('front.subCategory', [$product->subCategory->category->slug, $product->subCategory->slug])}}">{{$product->subCategory->name}}</a></li>
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
                                <img class="img-fluid" src="{{$image->getFullUrl()}}" alt="{{$image->img_alt ?? ''}}" title="{{$image->img_title ?? ''}}">
                            </div>
                        @endforeach
                        @else
                            <div class="js-slide">
                                <img class="img-fluid" src="{{$product->getFirstMediaUrlOrDefault(PRODUCT_PATH)['url']}}" alt="{{$product->getFirstMediaUrlOrDefault(PRODUCT_PATH)['alt']}}" title="{{$product->getFirstMediaUrlOrDefault(PRODUCT_PATH)['title']}}">
                            </div>
                        @endif
                    </div>

                    <div id="sliderSyncingThumb" class="js-slick-carousel u-slick u-slick--slider-syncing u-slick--slider-syncing-size u-slick--gutters-1 u-slick--transform-off" data-infinite="true" data-slides-show="5" data-is-thumbs="true" data-nav-for="#sliderSyncingNav">
                        @foreach($product->getMedia(PRODUCT_PATH) as $thumb)
                        <div class="js-slide" style="cursor: pointer;">
                            <img class="img-fluid" src="{{$thumb->getFullUrl('thumb')}}" alt="{{$thumb->img_alt ?? ''}}" title="{{$thumb->img_title ?? ''}}">
                        </div>
                        @endforeach
                    </div>
                </div>
                <div class="col-md-6 col-lg-4 col-xl-4 mb-md-6 mb-lg-0">
                    <div class="mb-2">
                        <a href="{{route('front.subCategory', [$product->subCategory->category->slug, $product->subCategory->slug])}}" class="font-size-12 text-gray-5 mb-2 d-inline-block">{{$product->subCategory->name}}</a>
                        <h2 class="font-size-25 text-lh-1dot2">{{$product->name}}</h2>
                        <div class="mb-2">
                            <a class="d-inline-flex align-items-center small font-size-15 text-lh-1">
                                <div class="text-warning mr-2">
                                    @for($i=1;$i<=$product->rate;$i++)
                                        <small class="fas fa-star"></small>
                                    @endfor
                                    @for($i=5;$i>$product->rate;$i--)
                                        <small class="far fa-star text-muted"></small>
                                    @endfor
                                </div>
                                <span class="text-secondary font-size-13">({{$product->views}} customer views)</span>
                            </a>
                        </div>
                        <a href="{{ route('home') }}" class="d-inline-block max-width-150 ml-n2 mb-2">
                            <img class="img-fluid" src="{{front_url()}}/assets/img/logo.png">
                        </a>
                        {{--<div class="mb-2">--}}
                            {{--<ul class="font-size-14 pl-3 ml-1 text-gray-9">--}}
                                {{--@foreach($product->tags as $tag)--}}
                                {{--<li><a href="{{route('front.tag', [$tag->slug])}}">{{$tag->name}}</a></li>--}}
                                {{--@endforeach--}}
                            {{--</ul>--}}
                        {{--</div>--}}



                        <p>{!! $product->short_desc !!}</p>
                        <p><strong>SKU</strong>: {{$product->SKU}}</p>
                    </div>
                </div>
                <div class="mx-md-auto mx-lg-0 col-md-6 col-lg-4 col-xl-3">
                    <div class="mb-2">
                        <div class="card p-5 border-width-2 border-color-1 borders-radius-17">
                            <div class="text-gray-9 font-size-14 pb-2 border-color-1 border-bottom mb-3">Availability:
                                @if($product->stock)
                                <span class="text-green font-weight-bold">{{$product->stock}} in stock</span>
                                @else
                                <span class="text-red font-weight-bold">Out of stock</span>
                                @endif
                            </div>
                            <div class="mb-3">
                                <div class="font-size-36">{{getCurrency('code')}} {{$product->price}}</div>
                            </div>

                            <div class="mb-3">
                                <div class="left-page-single">
                                    @if(is_company())
                                    <a href="{{ route('home') }}"> <i class="fa fa-user"></i> YouMats </a>
                                    <a href="tel:+966502111754" class="phone_link" data-url=""> <i class="fa fa-phone" aria-hidden="true"></i> (+966) 502111754 </a>
                                    <a href="mailto:info@youmats.com"> <i class="fa fa-envelope"></i> info@youmats.com </a>
                                    @endif
                                    <h3> How to Pay</h3>
                                    <p>Youmats Support pay on Delivery for That Product</p>
                                </div>
                            </div>


                            @if(!Auth::guard('vendor')->check())
                                {!! cartOrChat($product) !!}
                                <div class="flex-content-center flex-wrap">
                                    <a data-url="{{ route('wishlist.add', ['product' => $product]) }}" class="text-gray-6 font-size-13 btn-add-wishlist pointer"><i class="ec ec-favorites mr-1 font-size-15"></i> Wishlist</a>
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
                            <ul class="nav nav-classic nav-tab nav-tab-lg justify-content-xl-center mb-6 flex-nowrap flex-xl-wrap overflow-auto overflow-xl-visble border-lg-down-bottom-0 pb-1 pb-xl-0 mb-n1 mb-xl-0">
                                <li class="nav-item flex-shrink-0 flex-xl-shrink-1 z-index-2">
                                    <a class="nav-link active" href="#Description">
                                        <div class="d-md-flex justify-content-md-center align-items-md-center">
                                            About Product
                                        </div>
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <div class="mx-md-4 pt-1">
                            <h3 class="font-size-24 mb-3">Description</h3>
                            {!! $product->desc !!}
                            <div class="row">
                                <div class="col-md-6 text-right">
                                    <img class="img-fluid" src="{{$product->getFirstMediaUrlOrDefault(PRODUCT_PATH)['url']}}" alt="{{$product->getFirstMediaUrlOrDefault(PRODUCT_PATH)['alt']}}" title="{{$product->getFirstMediaUrlOrDefault(PRODUCT_PATH)['title']}}">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div id="basicsAccordion" class="mb-12">
                    @foreach($FAQs as $row)
                    <div class="card mb-3 border-top-0 border-left-0 border-right-0 border-color-1 rounded-0">
                        <div class="card-header card-collapse bg-transparent-on-hover border-0" id="qu{{$row->id}}">
                            <h5 class="mb-0">
                                <button type="button" class="px-0 btn btn-link btn-block d-flex justify-content-between card-btn py-3 font-size-25 border-0" data-toggle="collapse" data-target="#q{{$row->id}}" aria-expanded="true" aria-controls="q{{$row->id}}">
                                    {{$row->question}}

                                    <span class="card-btn-arrow">
                                        <i class="fas fa-chevron-down text-gray-90 font-size-18"></i>
                                    </span>
                                </button>
                            </h5>
                        </div>
                        <div id="q{{$row->id}}" class="collapse" aria-labelledby="qu{{$row->id}}" data-parent="#basicsAccordion">
                            <div class="card-body pl-0 pb-8">
                                <p class="mb-0">{!! $row->answer !!}</p>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    <div class="mb-5">
        <div class="bg-img-hero">

            <div class="container p-0">

                <div class="d-flex justify-content-between border-bottom border-color-1 flex-lg-nowrap flex-wrap border-md-down-top-0 border-md-down-bottom-0 mb-3 rtl">
                    <h3 class="section-title section-title__full mb-0 pb-2 font-size-22">RELATED PRODUCTS</h3>
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
                                            <div class="mb-2"><a href="{{route('front.subCategory', [$r_product->subCategory->category->slug, $r_product->subCategory->slug])}}" class="font-size-12 text-gray-5">{{$r_product->subCategory->name}}</a></div>
                                            <h5 class="mb-1 product-item__title"><a href="{{route('front.product', [$r_product->slug])}}" class="text-blue font-weight-bold">{{$r_product->name}}</a></h5>
                                            <div class="mb-2">
                                                <a href="{{route('front.product', [$r_product->slug])}}" class="a_img_pro d-block text-center">
                                                    <img class="img-fluid" src="{{$r_product->getFirstMediaUrlOrDefault(PRODUCT_PATH)['url']}}" alt="{{$r_product->getFirstMediaUrlOrDefault(PRODUCT_PATH)['alt']}}" title="{{$r_product->getFirstMediaUrlOrDefault(PRODUCT_PATH)['title']}}">
                                                </a>
                                            </div>
                                            <div class="flex-center-between mb-1">
                                                <div class="prodcut-price">
                                                    <div class="text-gray-100">{{getCurrency('code')}} {{$r_product->price}}</div>
                                                </div>
                                                {!! cartOrChat($product) !!}
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
@endsection
