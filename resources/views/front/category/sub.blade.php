@extends('front.layouts.master')
@section('metaTags')
    <title>{{$subCategory->meta_title}}</title>
    <meta name="description" content="{{$subCategory->meta_desc}}">
    <meta name="keywords" content="{{$subCategory->meta_keywords}}">
    <meta property="og:url" content="{{url()->current()}}" />
    <meta property="og:title" content="{{$subCategory->meta_title}}" />
    <meta property="og:description" content="{{$subCategory->meta_desc}}" />
    <meta property="og:image" content="{{$subCategory->getFirstMediaUrlOrDefault(SUB_CATEGORY_PATH)['url']}}" />
    <meta name="twitter:card" content="summary">
    <meta name="twitter:site" content="@YouMats">
    <meta name="twitter:title" content="{{$subCategory->meta_title}}">
    <meta name="twitter:description" content="{{$subCategory->meta_desc}}">
    <meta name="twitter:image" content="{{$subCategory->getFirstMediaUrlOrDefault(SUB_CATEGORY_PATH)['url']}}">
@endsection
@section('content')
    <div class="bg-gray-13 bg-md-transparent">
        <div class="container">
            <div class="my-md-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-3 flex-nowrap flex-xl-wrap overflow-auto overflow-xl-visble">
                        <li class="breadcrumb-item flex-shrink-0 flex-xl-shrink-1"><a href="{{route('home')}}">Home</a></li>
                        <li class="breadcrumb-item flex-shrink-0 flex-xl-shrink-1"><a href="{{route('front.category', ['category_slug' => $subCategory->category->slug])}}">{{$subCategory->category->name}}</a></li>
                        <li class="breadcrumb-item flex-shrink-0 flex-xl-shrink-1 active" aria-current="page">{{$subCategory->name}}</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <div class="mb-6 bg-md-transparent py-6">
        <div class="container">
            <div class="row mb-8">
                <div class="d-none d-xl-block col-xl-3 col-wd-2gdot5">
                    <div class="mb-6">
                        <div class="range-slider bg-gray-3 p-3">
                            <h4 class="font-size-14 mb-3 font-weight-bold">Price</h4>
                            <!-- Range Slider -->
                            <input class="js-range-slider" type="text"
                                   data-extra-classes="u-range-slider u-range-slider-indicator u-range-slider-grid"
                                   data-type="double" data-grid="false" data-hide-from-to="true" data-prefix="$"
                                   data-min="0" data-max="3456" data-from="0" data-to="3456"
                                   data-result-min="#rangeSliderExample3MinResult_2" data-result-max="#rangeSliderExample3MaxResult_2">
                            <!-- End Range Slider -->
                            <div class="mt-1 text-gray-111 d-flex mb-4">
                                <span class="mr-0dot5">Price: </span>
                                <span>$</span>
                                <span id="rangeSliderExample3MinResult_2" class=""></span>
                                <span class="mx-0dot5"> — </span>
                                <span>$</span>
                                <span id="rangeSliderExample3MaxResult_2" class=""></span>
                            </div>
                            <button type="submit" class="btn px-4 btn-primary-dark-w py-2 rounded-lg text-white">Filter</button>
                        </div>
                    </div>
                    @foreach($subCategory->attributes as $attribute)
                    <div class="mb-6">
                        <div class="border-bottom border-color-1 mb-5">
                            <h3 class="section-title section-title__sm mb-0 pb-2 font-size-18">{{$attribute->key}}</h3>
                        </div>
                        <div class="border-bottom pb-4 mb-4">
                            @foreach($attribute->values as $value)
                            <div class="form-group d-flex align-items-center justify-content-between mb-2 pb-1">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input filter-checkboxes" value="{{$value->id}}" id="{{$attribute->key . '_' . $value->value}}">
                                    <label class="custom-control-label" for="{{$attribute->key . '_' . $value->value}}">{{$value->value}}</label>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    @endforeach
                    <div class="mb-6">
                        <div class="border-bottom border-color-1 mb-5">
                            <h3 class="section-title section-title__sm mb-0 pb-2 font-size-18">Categories</h3>
                        </div>
                        <div class="border-bottom pb-4 mb-4">
                            @foreach($category->subCategories as $sub)
                            <div class="form-group d-flex align-items-center justify-content-between mb-2 pb-1">
                                <div class="custom-control custom-checkbox">
                                    <a @if($sub->id == $subCategory->id) style="font-weight: bold" @endif href="{{route('front.subCategory', [$category->slug, $sub->slug])}}" class="custom-control-label">{{$sub->name}}
                                        <span class="text-gray-25 font-size-12 font-weight-norma3"> ({{count($sub->products)}})</span>
                                    </a>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    @if(count($tags))
                    <div class="mb-6">
                        <div class="border-bottom border-color-1 mb-5">
                            <h3 class="section-title section-title__sm mb-0 pb-2 font-size-18">Tags</h3>
                        </div>
                        <div class="border-bottom pb-4 mb-4">
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

                    <div class="d-block d-md-flex flex-center-between mb-3">
                        <h3 class="font-size-25 mb-2 mb-md-0">{{$subCategory->name}}</h3>
                        <p class="font-size-14 text-gray-90 mb-0">Showing {{$products->firstItem()}}–{{$products->firstItem() + count($products->items()) -1}} of {{$products->total()}} results</p>
                    </div>

                    <!-- Shop-control-bar -->
                    <div class="bg-gray-1 flex-center-between borders-radius-9 py-1">
                        <div class="d-xl-none">
                            <!-- Account Sidebar Toggle Button -->
                            <a id="sidebarNavToggler1" class="btn btn-sm py-1 font-weight-normal" href="javascript:;" role="button"
                               aria-controls="sidebarContent1"
                               aria-haspopup="true"
                               aria-expanded="false"
                               data-unfold-event="click"
                               data-unfold-hide-on-scroll="false"
                               data-unfold-target="#sidebarContent1"
                               data-unfold-type="css-animation"
                               data-unfold-animation-in="fadeInLeft"
                               data-unfold-animation-out="fadeOutLeft"
                               data-unfold-duration="500">
                                <i class="fas fa-sliders-h"></i> <span class="ml-1">Filters</span>
                            </a>
                            <!-- End Account Sidebar Toggle Button -->
                        </div>
                        <div class="px-3 d-none d-xl-block">
                            <ul class="nav nav-tab-shop" id="pills-tab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="grid-view-tab" data-toggle="pill" href="#grid-view" role="tab" aria-controls="grid-view" aria-selected="false">
                                        <div class="d-md-flex justify-content-md-center align-items-md-center">
                                            <i class="fa fa-align-justify"></i>
                                        </div>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="list-view-tab" data-toggle="pill" href="#list-view" role="tab" aria-controls="list-view" aria-selected="true">
                                        <div class="d-md-flex justify-content-md-center align-items-md-center">
                                            <i class="fa fa-th-list"></i>
                                        </div>
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <nav class="px-3 flex-horizontal-center text-gray-20 d-none d-xl-flex">
                            <a class="text-gray-30 font-size-20 mr-2" href="{{$products->previousPageUrl()}}">←</a>
                            <b>{{$products->currentPage()}} </b> &nbsp; of {{$products->lastPage()}}
                            <a class="text-gray-30 font-size-20 ml-2" href="{{$products->nextPageUrl()}}">→</a>
                        </nav>
                    </div>
                    <!-- End Shop-control-bar -->

                    <!-- Tab Content -->
                    <div class="tab-content" id="pills-tabContent">
                        <div class="tab-pane fade pt-2 show active" id="grid-view" role="tabpanel" aria-labelledby="grid-view-tab" data-target-group="groups">
                            <ul class="row list-unstyled products-group no-gutters">
                                @foreach($products as $product)
                                <li class="col-6 col-md-3 col-wd-2gdot4 product-item">
                                    @include('front.layouts.partials.product_box', ['product' => $product, 'view' => 'grid'])
                                </li>
                                @endforeach
                            </ul>
                        </div>
                        <div class="tab-pane fade pt-2" id="list-view" role="tabpanel" aria-labelledby="list-view-tab" data-target-group="groups">
                            <ul class="d-block list-unstyled products-group prodcut-list-view-small">
                                @foreach($products as $product)
                                    @include('front.layouts.partials.product_box', ['product' => $product, 'view' => 'list'])
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    <!-- End Tab Content -->
                    <nav class="d-md-flex justify-content-between align-items-center border-top pt-3" aria-label="Page navigation example">
                        <ul class="pagination mb-0 pagination-shop justify-content-center justify-content-md-start">
                            {{$products->links()}}
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('extraScripts')
    @include('front.layouts.partials.filter')
@endsection
