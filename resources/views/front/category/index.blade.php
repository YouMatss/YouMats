@extends('front.layouts.master')
@section('metaTags')
    <title>{{$category->meta_title}}</title>
    <meta name="description" content="{{$category->meta_desc}}">
    <meta name="keywords" content="{{$category->meta_keywords}}">
    <meta property="og:url" content="{{url()->current()}}" />
    <meta property="og:title" content="{{$category->meta_title}}" />
    <meta property="og:description" content="{{$category->meta_desc}}" />
    <meta property="og:image" content="{{$category->getFirstMediaUrlOrDefault(CATEGORY_PATH)['url']}}" />
    <meta name="twitter:card" content="summary">
    <meta name="twitter:site" content="@YouMats">
    <meta name="twitter:title" content="{{$category->meta_title}}">
    <meta name="twitter:description" content="{{$category->meta_desc}}">
    <meta name="twitter:image" content="{{$category->getFirstMediaUrlOrDefault(CATEGORY_PATH)['url']}}">
@endsection
@section('content')
    <div class="bg-gray-13 bg-md-transparent">
        <div class="container">
            <!-- breadcrumb -->
            <div class="my-md-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-3 flex-nowrap flex-xl-wrap overflow-auto overflow-xl-visble">
                        <li class="breadcrumb-item flex-shrink-0 flex-xl-shrink-1"><a href="{{route('home')}}">Home</a></li>
                        <li class="breadcrumb-item flex-shrink-0 flex-xl-shrink-1 active" aria-current="page">{{$category->name}}</li>
                    </ol>
                </nav>
            </div>
            <!-- End breadcrumb -->
        </div>
    </div>
    <div class="mb-6 bg-gray-7 py-6">
        <div class="container">
            <div class="row flex-nowrap flex-md-wrap overflow-auto overflow-md-visble">
                @foreach($category->subCategories as $subCategory)
                <div class="col-md-4 col-lg-3 col-xl-4 col-xl-2gdot4 mb-3 flex-shrink-0 flex-md-shrink-1">
                    <div class="bg-white overflow-hidden shadow-on-hover h-100 d-flex align-items-center">
                        <a href="{{route('front.subCategory', [$category->slug, $subCategory->slug])}}" class="d-block pr-2 pr-wd-6">
                            <div class="media align-items-center">
                                <div class="pt-2">
                                    <img class="img-fluid img_category_page" src="{{$subCategory->getFirstMediaUrlOrDefault(SUB_CATEGORY_PATH)['url']}}" alt="{{$subCategory->getFirstMediaUrlOrDefault(SUB_CATEGORY_PATH)['alt']}}" title="{{$subCategory->getFirstMediaUrlOrDefault(SUB_CATEGORY_PATH)['title']}}">
                                </div>
                                <div class="ml-3 media-body">
                                    <h6 class="mb-0 text-gray-90">{{$subCategory->name}}</h6>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
    <div class="mb-6 bg-md-transparent py-0">
        <div class="container">
            <div class="row mb-8">
                <div class="d-none col-xl-3 col-wd-2gdot5">
                    <div class="mb-8">
                        <div class="border-bottom border-color-1 mb-5">
                            <h3 class="section-title section-title__sm mb-0 pb-2 font-size-18">All Categories</h3>
                        </div>
                        <ul class="list-unstyled li_side_bar">
                            @foreach($category->subCategories as $subCategory)
                            <li class="mb-3">
                                <div class="row">
                                    <div class="col-auto">
                                        <a href="{{route('front.subCategory', [$category->slug, $subCategory->slug])}}" class="d-block width-75">
                                            <img class="img-fluid" src="{{$subCategory->getFirstMediaUrlOrDefault(SUB_CATEGORY_PATH)['url']}}" alt="{{$subCategory->getFirstMediaUrlOrDefault(SUB_CATEGORY_PATH)['alt']}}" title="{{$subCategory->getFirstMediaUrlOrDefault(SUB_CATEGORY_PATH)['title']}}">
                                        </a>
                                    </div>
                                    <div class="col p-0 mt-3">
                                        <h3 class="text-lh-1dot2 font-size-14 mb-0">
                                            <a href="{{route('front.subCategory', [$category->slug, $subCategory->slug])}}">{{$subCategory->name}}</a>
                                        </h3>
                                    </div>
                                </div>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <div class="col-xl-12">

                    <div class="d-block d-md-flex flex-center-between mb-3">
                        <h3 class="font-size-25 mb-2 mb-md-0">{{$category->name}}</h3>
                        <p class="font-size-14 text-gray-90 mb-0">Showing {{$products->firstItem()}}–{{$products->firstItem() + count($products->items()) -1}} of {{$products->total()}} results</p>
                    </div>

                    <!-- Shop-control-bar -->
                    <div class="bg-gray-1 flex-center-between borders-radius-9 py-1">
                        <div class="d-xl-none">
                            <!-- Account Sidebar Toggle Button -->
                            <a id="sidebarNavToggler1" class="btn btn-sm py-1 font-weight-normal" href="javascript:;" role="button" aria-controls="sidebarContent1" aria-haspopup="true" aria-expanded="false" data-unfold-event="click" data-unfold-hide-on-scroll="false" data-unfold-target="#sidebarContent1" data-unfold-type="css-animation" data-unfold-animation-in="fadeInLeft" data-unfold-animation-out="fadeOutLeft" data-unfold-duration="500">
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
