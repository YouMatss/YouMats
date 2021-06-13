@extends('front.layouts.master')
@section('metaTags')
    <title>YouMats | Building Construction Material Suppliers in Saudi Arabia</title>
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
    <div class="mb-4">
        <div class="bg-img-hero" style="background-image: url({{front_url()}}/assets/img/bg-2.png);">
            <div class="container min-height-438 overflow-hidden">
                <div class="js-slick-carousel u-slick" data-pagi-classes="text-center position-absolute right-0 bottom-0 left-0 u-slick__pagination u-slick__pagination--long justify-content-start mb-3 mb-md-4 offset-xl-2 pl-xl-16 pl-wd-13">
                    @foreach($sliders as $slider)
                    <div class="js-slide">
                        <div class="row min-height-438 pt-7 py-md-0">
                            <div class="d-none d-xl-block col-auto">
                                <div class="max-width-270 min-width-270"></div>
                            </div>
                            <div class="col-xl col col-md-6 mt-md-8 mt-lg-10">
                                <div class="ml-xl-4">
                                    <h6 class="font-size-15 font-weight-bold mb-2 text-cyan"
                                        data-scs-animation-in="fadeInUp">
                                        {{$slider->quote}}
                                    </h6>
                                    <h1 class="font-size-46 text-lh-50 font-weight-light mb-6"
                                        data-scs-animation-in="fadeInUp"
                                        data-scs-animation-delay="200">
                                        <stong class="font-weight-bold">{{$slider->title}}</stong>
                                    </h1>
                                    <a href="{{$slider->button_link}}" class="btn btn-primary transition-3d-hover rounded-lg font-weight-normal py-2 px-md-7 px-3 font-size-16"
                                       data-scs-animation-in="fadeInUp"
                                       data-scs-animation-delay="300">
                                        {{$slider->button_title}}
                                    </a>
                                </div>
                            </div>
                            <div class="col-xl-5 col-6 d-flex align-items-end ml-auto ml-md-0"
                                 data-scs-animation-in="fadeInUp"
                                 data-scs-animation-delay="500">
                                <img class="img-fluid ml-auto mr-5" src="{{ $slider->getFirstMediaUrlOrDefault(SLIDER_PATH)['url'] }}" alt="{{$slider->getFirstMediaUrlOrDefault(SLIDER_PATH)['alt']}}" title="{{$slider->getFirstMediaUrlOrDefault(SLIDER_PATH)['title']}}">
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-xl-9 ml-auto col-wd-auto max-width-1045">
                <div class="row mb-6">
                    <div class="col-md-6 mb-4 mb-xl-0 col-wd-4">
                        <a href="#" class="d-black text-gray-90">
                            <div class="min-height-166 py-1 py-xl-2 py-wd-4 d-flex bg-gray-1 align-items-center">
                                <div class="col-6 col-xl-7 col-wd-6 pr-0">
                                    <img class="img-fluid" src="assets/img/cat_1.png" alt="Image Description">
                                </div>
                                <div class="col-6 col-xl-5 col-wd-6 pr-xl-4 pr-wd-3">
                                    <div class="mb-2 pb-1 font-size-18 font-weight-light text-ls-n1 text-lh-23">
                                        <strong>{{__('home.first_section')}}</strong>
                                    </div>
                                    <div class="link text-gray-90 font-weight-bold font-size-15" href="{{__('home.first_section_url')}}">
                                        {{__('general.read_more')}}
                                        <span class="link__icon ml-1">
                                                    <span class="link__icon-inner"><i class="ec ec-arrow-right-categproes"></i></span>
                                                </span>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-6 mb-4 mb-xl-0 col-wd-4">
                        <a href="#" class="d-black text-gray-90">
                            <div class="min-height-166 py-1 py-xl-2 py-wd-4 d-flex bg-gray-1 align-items-center">
                                <div class="col-6 col-xl-7 col-wd-6 pr-0">
                                    <img class="img-fluid" src="assets/img/cat_2.png" alt="Image Description">
                                </div>
                                <div class="col-6 col-xl-5 col-wd-6 pr-xl-4 pr-wd-3">
                                    <div class="mb-2 pb-1 font-size-18 font-weight-light text-ls-n1 text-lh-23">
                                        <STRONG>{{__('home.second_section')}}</STRONG>
                                    </div>
                                    <div class="link text-gray-90 font-weight-bold font-size-15" href="{{__('home.second_section_url')}}">
                                        {{__('general.read_more')}}
                                        <span class="link__icon ml-1">
                                                    <span class="link__icon-inner"><i class="ec ec-arrow-right-categproes"></i></span>
                                                </span>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-6 mb-4 mb-xl-0 col-wd-4 d-md-none d-wd-block">
                        <a href="#" class="d-black text-gray-90">
                            <div class="min-height-166 py-1 py-xl-2 py-wd-4 d-flex bg-gray-1 align-items-center">

                                <div class="col-6 col-xl-7 col-wd-6 pr-0">
                                    <img class="img-fluid" src="assets/img/cat_3.png" alt="Image Description">
                                </div>

                                <div class="col-6 col-xl-5 col-wd-6 pr-xl-4 pr-wd-3">
                                    <div class="mb-2 pb-1 font-size-18 font-weight-light text-ls-n1 text-lh-23">
                                        <STRONG>{{__('home.third_section')}}</STRONG>
                                    </div>
                                    <div class="link text-gray-90 font-weight-bold font-size-15" href="{{__('home.third_section_url')}}">
                                        {{__('general.read_more')}}
                                        <span class="link__icon ml-1">
                                                    <span class="link__icon-inner"><i class="ec ec-arrow-right-categproes"></i></span>
                                                </span>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container mb-8">
        <div class="d-flex justify-content-between border-bottom border-color-1 flex-lg-nowrap flex-wrap border-md-down-top-0 border-md-down-bottom-0 mb-3 rtl">
            <h3 class="section-title section-title__full mb-0 pb-2 font-size-22">{{__('home.categories_title')}}</h3>
        </div>

        <div class="js-slick-carousel u-slick my-1" data-slides-show="5" data-slides-scroll="1" data-arrows-classes="d-none d-lg-inline-block u-slick__arrow-normal u-slick__arrow-centered--y" data-arrow-left-classes="fa fa-angle-left u-slick__arrow-classic-inner--left z-index-9" data-arrow-right-classes="fa fa-angle-right u-slick__arrow-classic-inner--right"
             data-responsive='[{
                            "breakpoint": 992,
                            "settings": {
                                "slidesToShow": 2
                            }
                        }, {
                            "breakpoint": 768,
                            "settings": {
                                "slidesToShow": 1
                            }
                        }, {
                            "breakpoint": 554,
                            "settings": {
                                "slidesToShow": 1
                            }
                        }]'>
            @foreach($featuredVendors as $f_vendor)
            <div class="js-slide img_vend">
                <a href="{{ route('vendor.show', [$f_vendor->slug]) }}" class="link-hover__brand">
                    <img class="img-fluid m-auto max-height-50" src="{{ $f_vendor->getFirstMediaUrlOrDefault(VENDOR_LOGO)['url'] }}" alt="{{$f_vendor->getFirstMediaUrlOrDefault(VENDOR_LOGO)['alt']}}" title="{{$f_vendor->getFirstMediaUrlOrDefault(VENDOR_LOGO)['title']}}">
                </a>
            </div>
            @endforeach
        </div>
    </div>
    <!-- Featured Categories -->
    <div class="cat">
        <div class="container">
            <div class="row">
                <div class="box p-1 pr-2">
                    <h2 class="text-uppercase">{{__('home.categories_subtitle')}}</h2>
                    <p>{{__('home.catgeories_desc')}}</p>
                </div>
                @foreach($featured_categories as $f_category)
                <div class="box">
                    <a href="{{route('front.category', [$f_category->slug])}}" class="st_block">
                        <img src="{{$f_category->getFirstMediaUrlOrDefault(CATEGORY_COVER)['url']}}"
                             alt="{{$f_category->getFirstMediaUrlOrDefault(CATEGORY_COVER)['alt']}}"
                             title="{{$f_category->getFirstMediaUrlOrDefault(CATEGORY_COVER)['title']}}" />
                        <div class="content d-flex">
                            <h3 class="title">{{$f_category->name}}</h3>
                            <span class="text-blue">
                                <i class="fas fa-plus"></i>
                            </span>
                        </div>
                    </a>
                </div>
                @endforeach
            </div>
        </div>
    </div>
    <!-- Latest products -->
    <div class="mb-5">

        <div class="bg-img-hero bg_cat_new pt-5">

            <div class="container p-0">

                <div class="d-flex justify-content-between border-bottom border-color-1 flex-lg-nowrap flex-wrap border-md-down-top-0 border-md-down-bottom-0 mb-3 rtl">
                    <h3 class="section-title section-title__full mb-0 pb-2 font-size-22">{{__('home.featured_products')}}</h3>
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

                        @foreach($best_seller_products as $bs_product)
                        <div class="js-slide products-group">
                            <div class="product-item mx-1 remove-divider">
                                <div class="product-item__outer h-100">
                                    <div class="product-item__inner px-xl-3 p-3">
                                        <div class="product-item__body pb-xl-2">
                                            <div class="mb-2">
                                                <a href="{{route('front.subCategory', [$bs_product->subCategory->category->slug, $bs_product->subCategory->slug])}}" class="font-size-12 text-gray-5">{{$bs_product->subCategory->name}}</a>
                                            </div>
                                            <h5 class="mb-1 product-item__title">
                                                <a href="{{route('front.product', [$bs_product->slug])}}" class="text-blue font-weight-bold">{{$bs_product->name}}</a>
                                            </h5>
                                            <div class="mb-2">
                                                <a href="{{route('front.product', [$bs_product->slug])}}" class="d-block text-center">
                                                    <img class="img-fluid" src="{{$bs_product->getFirstMediaUrlOrDefault(PRODUCT_PATH, '')['url']}}" alt="{{$bs_product->getFirstMediaUrlOrDefault(PRODUCT_PATH)['alt']}}" title="{{$bs_product->getFirstMediaUrlOrDefault(PRODUCT_PATH)['title']}}" />
                                                </a>
                                            </div>
                                            <div class="flex-center-between mb-1">
                                                <div class="prodcut-price">
                                                    <div class="text-gray-100">{{getCurrency('symbol')}} {{$bs_product->price}}</div>
                                                </div>
                                                {!! cartOrChat($bs_product) !!}
                                            </div>
                                        </div>
                                        @if(!Auth::guard('vendor')->check())
                                            <div class="product-item__footer">
                                                <div class="border-top pt-2 flex-center-between flex-wrap">
                                                    <a data-url="{{ route('wishlist.add', ['product' => $bs_product]) }}" class="text-gray-6 font-size-13 btn-add-wishlist pointer"><i class="ec ec-favorites mr-1 font-size-15"></i> Wishlist</a>
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

    @if(isset($section_i_category))
    <!-- Section I Category -->
    <div class="container">
        <div class="mb-6">
            <!-- Nav nav-pills -->
            <div class="position-relative text-center z-index-2">
                <div class=" d-flex justify-content-between border-bottom border-color-1 flex-lg-nowrap flex-wrap border-md-down-top-0 border-md-down-bottom-0 rtl">
                    <h3 class="section-title mb-0 pb-2 font-size-22">{{$section_i_category->name}}</h3>
                </div>
            </div>
            <!-- End Nav Pills -->
            <div class="row rtl">
                <div class="col-md-3">
                    <div class="block_img_cat">
                        <a href="{{route('front.category', [$section_i_category->slug])}}" class="d-block">
                            <img class="img-fluid" src="{{$section_i_category->getFirstMediaUrlOrDefault(CATEGORY_PATH)['url']}}" alt="{{$section_i_category->getFirstMediaUrlOrDefault(CATEGORY_PATH)['alt']}}" title="{{$section_i_category->getFirstMediaUrlOrDefault(CATEGORY_PATH)['title']}}" />
                        </a>
                        <div class="des_block_cat_new">
                            <h3>{{$section_i_category->name}}</h3>
                            <a href="{{route('front.category', [$section_i_category->slug])}}" class="btn btn-primary transition-3d-hover rounded-lg font-weight-normal py-2 px-md-7 px-3 font-size-16 animated fadeInUp">{{__('general.view_all')}}</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-9">
                    <ul class="row list-unstyled products-group no-gutters mb-0">
                        @foreach($section_i_category->products->take(8) as $i_product)
                        <li class="col-6 col-md-4 col-wd-3 product-item">
                            <div class="product-item__outer h-100">
                                <div class="product-item__inner bg-white p-3">
                                    <div class="product-item__body pb-xl-2">
                                        <div class="mb-2">
                                            <a href="{{route('front.subCategory', [$section_i_category->slug, $i_product->subCategory->slug])}}" class="font-size-12 text-gray-5">{{$i_product->subCategory->name}}</a>
                                        </div>
                                        <h5 class="mb-1 product-item__title">
                                            <a href="{{route('front.product', [$i_product->slug])}}" class="text-blue font-weight-bold">{{$i_product->name}}</a>
                                        </h5>
                                        <div class="mb-2">
                                            <a href="{{route('front.product', [$i_product->slug])}}" class="d-block text-center">
                                                <img class="img-fluid" src="{{$i_product->getFirstMediaUrlOrDefault(PRODUCT_PATH)['url']}}" alt="{{$i_product->getFirstMediaUrlOrDefault(PRODUCT_PATH)['alt']}}" title="{{$i_product->getFirstMediaUrlOrDefault(PRODUCT_PATH)['title']}}" />
                                            </a>
                                        </div>
                                        <div class="flex-center-between mb-1">
                                            <div class="prodcut-price">
                                                <div class="text-gray-100">{{getCurrency('symbol')}} {{$i_product->price}}</div>
                                            </div>
                                            {!! cartOrChat($i_product) !!}
                                        </div>
                                    </div>
                                    <div class="product-item__footer">
                                        @if(!Auth::guard('vendor')->check())
                                            <div class="border-top pt-2 flex-center-between flex-wrap">
                                                <a data-url="{{ route('wishlist.add', ['product' => $i_product]) }}" class="text-gray-6 font-size-13 btn-add-wishlist pointer"><i class="ec ec-favorites mr-1 font-size-15"></i> Wishlist</a>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
    @endif
    <!-- Top Categories -->
    <div class="container">
        <div class="d-flex justify-content-between border-bottom border-color-1 flex-lg-nowrap flex-wrap border-md-down-top-0 border-md-down-bottom-0 mb-3 rtl">
            <h3 class="section-title section-title__full mb-0 pb-2 font-size-22">TOP CATEGORIES</h3>
        </div>
        <div class="mb-6">
            <div class="row rtl flex-nowrap flex-md-wrap overflow-auto overflow-md-visble">
                @foreach($top_subCategories as $t_category)
                <div class="col-md-6 col-xl-4 mb-5 flex-shrink-0 flex-md-shrink-1">
                    <div class="bg-gray-1 overflow-hidden shadow-on-hover h-100 d-flex align-items-center">
                        <a href="{{route('front.subCategory', [$t_category->category->slug, $t_category->slug])}}" class="d-block">
                            <div class="media align-items-center">
                                <div class="max-width-148 img_cat_home">
                                    <img class="img-fluid" src="{{$t_category->getFirstMediaUrlOrDefault(SUB_CATEGORY_PATH, '')['url']}}" alt="{{$t_category->getFirstMediaUrlOrDefault(SUB_CATEGORY_PATH)['alt']}}" title="{{$t_category->getFirstMediaUrlOrDefault(SUB_CATEGORY_PATH)['title']}}" />
                                </div>
                                <div class="ml-4 media-body">
                                    <h4 class="mb-0 text-gray-90">{{$t_category->name}}</h4>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>

    @if(isset($section_ii_subCategory))
    <!-- Section II Category -->
    <div class="container mb-8">
        <div class="d-flex justify-content-between border-bottom border-color-1 flex-lg-nowrap flex-wrap border-md-down-top-0 border-md-down-bottom-0 mb-3 rtl">
            <h3 class="section-title section-title__full mb-0 pb-2 font-size-22">{{$section_ii_subCategory->name}}</h3>
            <a class="d-block text-gray-16" href="{{route('front.subCategory', [$section_ii_subCategory->category->slug, $section_ii_subCategory->slug])}}">
                {{__('general.go_to_all_products')}}
                <i class="ec ec-arrow-right-categproes"></i>
            </a>
        </div>

        <div class="row rtl">
            <div class="col-12 col-md-2">
                <a href="{{route('front.subCategory', [$section_ii_subCategory->category->slug, $section_ii_subCategory->slug])}}" class="d-block">
                    <img class="img-fluid img_main_block" width="200" src="{{$section_ii_subCategory->getFirstMediaUrlOrDefault(SUB_CATEGORY_PATH)['url']}}" alt="{{$section_ii_subCategory->getFirstMediaUrlOrDefault(SUB_CATEGORY_PATH)['alt']}}" title="{{$section_ii_subCategory->getFirstMediaUrlOrDefault(SUB_CATEGORY_PATH)['title']}}" />
                </a>
            </div>
            <div class="col-12 col-md-10 pl-md-0">
                <!-- Tab Content -->
                <ul class="row list-unstyled products-group no-gutters">
                    @foreach($section_ii_subCategory->products->take(6) as $ii_product)
                    <li class="col-6 col-md-2 col-xl-2 product-item">
                        <div class="product-item__outer h-100">
                            <div class="product-item__inner px-xl-3 p-3">
                                <div class="product-item__body pb-xl-2">
                                    <div class="mb-2">
                                        <a href="{{route('front.subCategory', [$section_ii_subCategory->category->slug, $section_ii_subCategory->slug])}}" class="font-size-12 text-gray-5">{{$section_ii_subCategory->name}}</a>
                                    </div>
                                    <h5 class="mb-1 product-item__title">
                                        <a href="{{route('front.product', [$ii_product->slug])}}" class="text-blue font-weight-bold">{{$ii_product->name}}</a>
                                    </h5>
                                    <div class="mb-2">
                                        <a href="{{route('front.product', [$ii_product->slug])}}" class="d-block text-center">
                                            <img class="img-fluid" src="{{$ii_product->getFirstMediaUrlOrDefault(PRODUCT_PATH)['url']}}" alt="{{$ii_product->getFirstMediaUrlOrDefault(PRODUCT_PATH)['alt']}}" title="{{$ii_product->getFirstMediaUrlOrDefault(PRODUCT_PATH)['title']}}" />
                                        </a>
                                    </div>
                                    <div class="flex-center-between mb-1">
                                        <div class="prodcut-price">
                                            <div class="text-gray-100">{{getCurrency('symbol')}} {{$ii_product->price}}</div>
                                        </div>
                                        {!! cartOrChat($ii_product) !!}
                                    </div>
                                </div>
                                @if(!Auth::guard('vendor')->check())
                                    <div class="product-item__footer">
                                        <div class="border-top pt-2 flex-center-between flex-wrap">
                                            <a data-url="{{ route('wishlist.add', ['product' => $ii_product]) }}" class="text-gray-6 font-size-13 btn-add-wishlist pointer"><i class="ec ec-favorites mr-1 font-size-15"></i> Wishlist</a>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
    @endif

    @if(isset($section_iii_subCategory))
    <!-- Section III Category -->
    <div class="container mb-8">
        <div class="d-flex justify-content-between border-bottom border-color-1 flex-lg-nowrap flex-wrap border-md-down-top-0 border-md-down-bottom-0 mb-3 rtl">
            <h3 class="section-title section-title__full mb-0 pb-2 font-size-22">{{$section_iii_subCategory->name}}</h3>
            <a class="d-block text-gray-16" href="{{route('front.subCategory', [$section_iii_subCategory->category->slug, $section_iii_subCategory->slug])}}">
                {{__('general.go_to_all_products')}}
                <i class="ec ec-arrow-right-categproes"></i>
            </a>
        </div>

        <div class="row rtl">
            <div class="col-12 col-md-2">
                <a href="{{route('front.subCategory', [$section_iii_subCategory->category->slug, $section_iii_subCategory->slug])}}" class="d-block">
                    <img class="img-fluid img_main_block" width="200" src="{{$section_iii_subCategory->getFirstMediaUrlOrDefault(SUB_CATEGORY_PATH)['url']}}" alt="{{$section_iii_subCategory->getFirstMediaUrlOrDefault(SUB_CATEGORY_PATH)['alt']}}" title="{{$section_iii_subCategory->getFirstMediaUrlOrDefault(SUB_CATEGORY_PATH)['title']}}" />
                </a>
            </div>
            <div class="col-12 col-md-10 pl-md-0">
                <!-- Tab Content -->
                <ul class="row list-unstyled products-group no-gutters">
                    @foreach($section_iii_subCategory->products->take(6) as $iii_product)
                        <li class="col-6 col-md-2 col-xl-2 product-item">
                            <div class="product-item__outer h-100">
                                <div class="product-item__inner px-xl-3 p-3">
                                    <div class="product-item__body pb-xl-2">
                                        <div class="mb-2">
                                            <a href="{{route('front.subCategory', [$section_iii_subCategory->category->slug, $section_iii_subCategory->slug])}}" class="font-size-12 text-gray-5">{{$section_iii_subCategory->name}}</a>
                                        </div>
                                        <h5 class="mb-1 product-item__title">
                                            <a href="{{route('front.product', [$iii_product->slug])}}" class="text-blue font-weight-bold">{{$iii_product->name}}</a>
                                        </h5>
                                        <div class="mb-2">
                                            <a href="{{route('front.product', [$iii_product->slug])}}" class="d-block text-center">
                                                <img class="img-fluid" src="{{$iii_product->getFirstMediaUrlOrDefault(PRODUCT_PATH)['url']}}" alt="{{$iii_product->getFirstMediaUrlOrDefault(PRODUCT_PATH)['alt']}}" title="{{$iii_product->getFirstMediaUrlOrDefault(PRODUCT_PATH)['title']}}" />
                                            </a>
                                        </div>
                                        <div class="flex-center-between mb-1">
                                            <div class="prodcut-price">
                                                <div class="text-gray-100">{{getCurrency('symbol')}} {{$iii_product->price}}</div>
                                            </div>
                                            {!! cartOrChat($iii_product) !!}
                                        </div>
                                    </div>
                                    @if(!Auth::guard('vendor')->check())
                                        <div class="product-item__footer">
                                            <div class="border-top pt-2 flex-center-between flex-wrap">
                                                <a data-url="{{ route('wishlist.add', ['product' => $iii_product]) }}" class="text-gray-6 font-size-13 btn-add-wishlist pointer"><i class="ec ec-favorites mr-1 font-size-15"></i> Wishlist</a>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
    @endif

    @if(isset($section_iv_subCategory))
    <!-- Section IV Category -->
    <div class="container mb-8">
        <div class="d-flex justify-content-between border-bottom border-color-1 flex-lg-nowrap flex-wrap border-md-down-top-0 border-md-down-bottom-0 mb-3 rtl">
            <h3 class="section-title section-title__full mb-0 pb-2 font-size-22">{{$section_iv_subCategory->name}}</h3>
            <a class="d-block text-gray-16" href="{{route('front.subCategory', [$section_iv_subCategory->category->slug, $section_iv_subCategory->slug])}}">
                {{__('general.go_to_all_products')}}
                <i class="ec ec-arrow-right-categproes"></i>
            </a>
        </div>

        <div class="row rtl">
            <div class="col-12 col-md-2">
                <a href="{{route('front.subCategory', [$section_iv_subCategory->category->slug, $section_iv_subCategory->slug])}}" class="d-block">
                    <img class="img-fluid img_main_block" width="200" src="{{$section_iv_subCategory->getFirstMediaUrlOrDefault(SUB_CATEGORY_PATH)['url']}}" alt="{{$section_iv_subCategory->getFirstMediaUrlOrDefault(SUB_CATEGORY_PATH)['alt']}}" title="{{$section_iv_subCategory->getFirstMediaUrlOrDefault(SUB_CATEGORY_PATH)['title']}}" />
                </a>
            </div>
            <div class="col-12 col-md-10 pl-md-0">
                <!-- Tab Content -->
                <ul class="row list-unstyled products-group no-gutters">
                    @foreach($section_iv_subCategory->products->take(6) as $iv_product)
                        <li class="col-6 col-md-2 col-xl-2 product-item">
                            <div class="product-item__outer h-100">
                                <div class="product-item__inner px-xl-3 p-3">
                                    <div class="product-item__body pb-xl-2">
                                        <div class="mb-2">
                                            <a href="{{route('front.subCategory', [$section_iv_subCategory->category->slug, $section_iv_subCategory->slug])}}" class="font-size-12 text-gray-5">{{$section_iv_subCategory->name}}</a>
                                        </div>
                                        <h5 class="mb-1 product-item__title">
                                            <a href="{{route('front.product', [$iv_product->slug])}}" class="text-blue font-weight-bold">{{$iv_product->name}}</a>
                                        </h5>
                                        <div class="mb-2">
                                            <a href="{{route('front.product', [$iv_product->slug])}}" class="d-block text-center">
                                                <img class="img-fluid" src="{{$iv_product->getFirstMediaUrlOrDefault(PRODUCT_PATH)['url']}}" alt="{{$iv_product->getFirstMediaUrlOrDefault(PRODUCT_PATH)['alt']}}" title="{{$iv_product->getFirstMediaUrlOrDefault(PRODUCT_PATH)['title']}}" />
                                            </a>
                                        </div>
                                        <div class="flex-center-between mb-1">
                                            <div class="prodcut-price">
                                                <div class="text-gray-100">{{getCurrency('symbol')}} {{$iv_product->price}}</div>
                                            </div>
                                            {!! cartOrChat($iv_product) !!}
                                        </div>
                                    </div>
                                    @if(!Auth::guard('vendor')->check())
                                        <div class="product-item__footer">
                                            <div class="border-top pt-2 flex-center-between flex-wrap">
                                                <a data-url="{{ route('wishlist.add', ['product' => $iv_product]) }}" class="text-gray-6 font-size-13 btn-add-wishlist pointer"><i class="ec ec-favorites mr-1 font-size-15"></i> Wishlist</a>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
    @endif

    @include('front.layouts.partials.team')
@endsection
