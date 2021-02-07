@extends('front.layouts.master')
@section('metaTags')
    <title>YouMats | {{$category->name}}</title>
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

                <div class="col-md-4 col-lg-3 col-xl-4 col-xl-2gdot4 mb-3 flex-shrink-0 flex-md-shrink-1">
                    <div class="bg-white overflow-hidden shadow-on-hover h-100 d-flex align-items-center">
                        <a href="#" class="d-block pr-2 pr-wd-6">
                            <div class="media align-items-center">
                                <div class="pt-2">
                                    <img class="img-fluid img_category_page" src="assets/img/pro_6.jpg" alt="Image Description">
                                </div>
                                <div class="ml-3 media-body">
                                    <h6 class="mb-0 text-gray-90">The Blocks</h6>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-md-4 col-lg-3 col-xl-4 col-xl-2gdot4 mb-3 flex-shrink-0 flex-md-shrink-1">
                    <div class="bg-white overflow-hidden shadow-on-hover h-100 d-flex align-items-center">
                        <a href="#" class="d-block pr-2 pr-wd-6">
                            <div class="media align-items-center">
                                <div class="pt-2">
                                    <img class="img-fluid img_category_page" src="assets/img/pro_13.png" alt="Image Description">
                                </div>
                                <div class="ml-3 media-body">
                                    <h6 class="mb-0 text-gray-90">Cement</h6>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-md-4 col-lg-3 col-xl-4 col-xl-2gdot4 mb-3 flex-shrink-0 flex-md-shrink-1">
                    <div class="bg-white overflow-hidden shadow-on-hover h-100 d-flex align-items-center">
                        <a href="#" class="d-block pr-2 pr-wd-6">
                            <div class="media align-items-center">
                                <div class="pt-2">
                                    <img class="img-fluid img_category_page" src="assets/img/cat_3.png" alt="Image Description">
                                </div>
                                <div class="ml-3 media-body">
                                    <h6 class="mb-0 text-gray-90">Coarse Aggregate and Ston</h6>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-md-4 col-lg-3 col-xl-4 col-xl-2gdot4 mb-3 flex-shrink-0 flex-md-shrink-1">
                    <div class="bg-white overflow-hidden shadow-on-hover h-100 d-flex align-items-center">
                        <a href="#" class="d-block pr-2 pr-wd-6">
                            <div class="media align-items-center">
                                <div class="pt-2">
                                    <img class="img-fluid img_category_page" src="assets/img/Hurdles_1.png" alt="Image Description">
                                </div>
                                <div class="ml-3 media-body">
                                    <h6 class="mb-0 text-gray-90">Stainless Steel</h6>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-md-4 col-lg-3 col-xl-4 col-xl-2gdot4 mb-3 flex-shrink-0 flex-md-shrink-1">
                    <div class="bg-white overflow-hidden shadow-on-hover h-100 d-flex align-items-center">
                        <a href="#" class="d-block pr-2 pr-wd-6">
                            <div class="media align-items-center">
                                <div class="pt-2">
                                    <img class="img-fluid img_category_page" src="assets/img/cat_2.png" alt="Image Description">
                                </div>
                                <div class="ml-3 media-body">
                                    <h6 class="mb-0 text-gray-90">Aluminium</h6>
                                </div>
                            </div>
                        </a>
                    </div>
                </div> <div class="col-md-4 col-lg-3 col-xl-4 col-xl-2gdot4 mb-3 flex-shrink-0 flex-md-shrink-1">
                    <div class="bg-white overflow-hidden shadow-on-hover h-100 d-flex align-items-center">
                        <a href="#" class="d-block pr-2 pr-wd-6">
                            <div class="media align-items-center">
                                <div class="pt-2">
                                    <img class="img-fluid img_category_page" src="assets/img/cat_1.png" alt="Image Description">
                                </div>
                                <div class="ml-3 media-body">
                                    <h6 class="mb-0 text-gray-90">Construction Timber</h6>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-md-4 col-lg-3 col-xl-4 col-xl-2gdot4 mb-3 flex-shrink-0 flex-md-shrink-1">
                    <div class="bg-white overflow-hidden shadow-on-hover h-100 d-flex align-items-center">
                        <a href="#" class="d-block pr-2 pr-wd-6">
                            <div class="media align-items-center">
                                <div class="pt-2">
                                    <img class="img-fluid img_category_page" src="assets/img/slider_2.png" alt="Image Description">
                                </div>
                                <div class="ml-3 media-body">
                                    <h6 class="mb-0 text-gray-90">Sand</h6>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-md-4 col-lg-3 col-xl-4 col-xl-2gdot4 mb-3 flex-shrink-0 flex-md-shrink-1">
                    <div class="bg-white overflow-hidden shadow-on-hover h-100 d-flex align-items-center">
                        <a href="#" class="d-block pr-2 pr-wd-6">
                            <div class="media align-items-center">
                                <div class="pt-2">
                                    <img class="img-fluid img_category_page" src="assets/img/menu_10.png" alt="Image Description">
                                </div>
                                <div class="ml-3 media-body">
                                    <h6 class="mb-0 text-gray-90">Wires</h6>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-md-4 col-lg-3 col-xl-4 col-xl-2gdot4 mb-3 flex-shrink-0 flex-md-shrink-1">
                    <div class="bg-white overflow-hidden shadow-on-hover h-100 d-flex align-items-center">
                        <a href="#" class="d-block pr-2 pr-wd-6">
                            <div class="media align-items-center">
                                <div class="pt-2">
                                    <img class="img-fluid img_category_page" src="assets/img/frdf.png" alt="Image Description">
                                </div>
                                <div class="ml-3 media-body">
                                    <h6 class="mb-0 text-gray-90">Fence products</h6>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-md-4 col-lg-3 col-xl-4 col-xl-2gdot4 mb-3 flex-shrink-0 flex-md-shrink-1">
                    <div class="bg-white overflow-hidden shadow-on-hover h-100 d-flex align-items-center">
                        <a href="#" class="d-block pr-2 pr-wd-6">
                            <div class="media align-items-center">
                                <div class="pt-2">
                                    <img class="img-fluid img_category_page" src="assets/img/cat_3.png" alt="Image Description">
                                </div>
                                <div class="ml-3 media-body">
                                    <h6 class="mb-0 text-gray-90">Gravel</h6>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <div class="mb-6 bg-md-transparent py-6">
        <div class="container">
            <div class="row mb-8">
                <div class="d-none d-xl-block col-xl-3 col-wd-2gdot5">
                    <div class="mb-8">
                        <div class="border-bottom border-color-1 mb-5">
                            <h3 class="section-title section-title__sm mb-0 pb-2 font-size-18">All Categories</h3>
                        </div>
                        <ul class="list-unstyled li_side_bar">
                            <li class="mb-3">
                                <div class="row">
                                    <div class="col-auto">
                                        <a href="#" class="d-block width-75">
                                            <img class="img-fluid" src="assets/img/cat_home_1.png" alt="Image Description">
                                        </a>
                                    </div>
                                    <div class="col p-0 mt-3">
                                        <h3 class="text-lh-1dot2 font-size-14 mb-0"><a href="#">Sand</a></h3>
                                    </div>
                                </div>
                            </li>
                            <li class="mb-3">
                                <div class="row">
                                    <div class="col-auto">
                                        <a href="#" class="d-block width-75">
                                            <img class="img-fluid" src="assets/img/cat_home_2.png" alt="Image Description">
                                        </a>
                                    </div>
                                    <div class="col p-0 mt-3">
                                        <h3 class="text-lh-1dot2 font-size-14 mb-0"><a href="#">Cement Bricks</a></h3>
                                    </div>
                                </div>
                            </li>
                            <li class="mb-3">
                                <div class="row">
                                    <div class="col-auto">
                                        <a href="#" class="d-block width-75">
                                            <img class="img-fluid" src="assets/img/cat_home_3.png" alt="Image Description">
                                        </a>
                                    </div>
                                    <div class="col p-0 mt-3">
                                        <h3 class="text-lh-1dot2 font-size-14 mb-0"><a href="#">Electric Water Heaters</a></h3>
                                    </div>
                                </div>
                            </li>
                            <li class="mb-3">
                                <div class="row">
                                    <div class="col-auto">
                                        <a href="#" class="d-block width-75">
                                            <img class="img-fluid" src="assets/img/cat_home_6.png" alt="Image Description">
                                        </a>
                                    </div>
                                    <div class="col p-0 mt-3">
                                        <h3 class="text-lh-1dot2 font-size-14 mb-0"><a href="#">skylight</a></h3>
                                    </div>
                                </div>
                            </li>
                            <li class="mb-3">
                                <div class="row">
                                    <div class="col-auto">
                                        <a href="#" class="d-block width-75">
                                            <img class="img-fluid" src="assets/img/cat_home_5.png" alt="Image Description">
                                        </a>
                                    </div>
                                    <div class="col p-0 mt-3">
                                        <h3 class="text-lh-1dot2 font-size-14 mb-0"><a href="#">Kitchen Sinks and Faucets</a></h3>
                                    </div>
                                </div>
                            </li>
                            <li class="mb-4">
                                <div class="row">
                                    <div class="col-auto">
                                        <a href="#" class="d-block width-75">
                                            <img class="img-fluid" src="assets/img/cat_home_4.png" alt="Image Description">
                                        </a>
                                    </div>
                                    <div class="col p-0 mt-3">
                                        <h3 class="text-lh-1dot2 font-size-14 mb-0"><a href="#">Modern Kitchen</a></h3>
                                    </div>
                                </div>
                            </li>
                            <li class="mb-3">
                                <div class="row">
                                    <div class="col-auto">
                                        <a href="#" class="d-block width-75">
                                            <img class="img-fluid" src="assets/img/img5.jpg" alt="Image Description">
                                        </a>
                                    </div>
                                    <div class="col p-0 mt-3">
                                        <h3 class="text-lh-1dot2 font-size-14 mb-0"><a href="#">Precast Concrete</a></h3>
                                    </div>
                                </div>
                            </li>
                            <li class="mb-3">
                                <div class="row">
                                    <div class="col-auto">
                                        <a href="#" class="d-block width-75">
                                            <img class="img-fluid" src="assets/img/pro_4.jpg" alt="Image Description">
                                        </a>
                                    </div>
                                    <div class="col p-0 mt-3">
                                        <h3 class="text-lh-1dot2 font-size-14 mb-0"><a href="#">Smooth Black Brick</a></h3>
                                    </div>
                                </div>
                            </li>
                            <li class="mb-3">
                                <div class="row">
                                    <div class="col-auto">
                                        <a href="#" class="d-block width-75">
                                            <img class="img-fluid" src="assets/img/product_4988_1.png" alt="Image Description">
                                        </a>
                                    </div>
                                    <div class="col p-0 mt-3">
                                        <h3 class="text-lh-1dot2 font-size-14 mb-0"><a href="#">Red Corner Bricks</a></h3>
                                    </div>
                                </div>
                            </li>
                            <li class="mb-3">
                                <div class="row">
                                    <div class="col-auto">
                                        <a href="#" class="d-block width-75">
                                            <img class="img-fluid" src="assets/img/pro_0101.png" alt="Image Description">
                                        </a>
                                    </div>
                                    <div class="col p-0 mt-3">
                                        <h3 class="text-lh-1dot2 font-size-14 mb-0"><a href="#">Home & Audio Enternteinment</a></h3>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-xl-9 col-wd-9gdot5">

                    <div class="d-block d-md-flex flex-center-between mb-3">
                        <h3 class="font-size-25 mb-2 mb-md-0">Building Construction Material</h3>
                        <p class="font-size-14 text-gray-90 mb-0">Showing 1–25 of 56 results</p>
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
                                    <a class="nav-link active" id="pills-two-example1-tab" data-toggle="pill" href="#pills-two-example1" role="tab" aria-controls="pills-two-example1" aria-selected="false">
                                        <div class="d-md-flex justify-content-md-center align-items-md-center">
                                            <i class="fa fa-align-justify"></i>
                                        </div>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="pills-four-example1-tab" data-toggle="pill" href="#pills-four-example1" role="tab" aria-controls="pills-four-example1" aria-selected="true">
                                        <div class="d-md-flex justify-content-md-center align-items-md-center">
                                            <i class="fa fa-th-list"></i>
                                        </div>
                                    </a>
                                </li>
                            </ul>
                        </div>

                        <nav class="px-3 flex-horizontal-center text-gray-20 d-none d-xl-flex">
                            <form method="post" class="min-width-50 mr-1">
                                <input size="2" min="1" max="3" step="1" type="number" class="form-control text-center px-2 height-35" value="1">
                            </form> of 3
                            <a class="text-gray-30 font-size-20 ml-2" href="#">→</a>
                        </nav>
                    </div>
                    <!-- End Shop-control-bar -->


                    <!-- Tab Content -->
                    <div class="tab-content" id="pills-tabContent">

                        <div class="tab-pane fade pt-2 show active" id="pills-two-example1" role="tabpanel" aria-labelledby="pills-two-example1-tab" data-target-group="groups">
                            <ul class="row list-unstyled products-group no-gutters">

                                <li class="col-6 col-md-3 col-wd-2gdot4 product-item">
                                    <div class="product-item__outer h-100">
                                        <div class="product-item__inner px-xl-2 p-3">
                                            <div class="product-item__body pb-xl-2">
                                                <div class="mb-2"><a href="#" class="font-size-12 text-gray-5">Category Name</a></div>
                                                <h5 class="mb-1 product-item__title"><a href="#" class="text-blue font-weight-bold">Interlocking paver and tile Holand-Chamfer height 60 mm.</a></h5>
                                                <div class="mb-2">
                                                    <a href="#" class="d-block text-center"><img class="img-fluid" src="assets/img/cat_2.png" alt="Image Description"></a>
                                                </div>
                                                <div class="mb-3">
                                                    <a class="d-inline-flex align-items-center small font-size-14" href="#">
                                                        <div class="text-warning mr-2">
                                                            <small class="fas fa-star"></small>
                                                            <small class="fas fa-star"></small>
                                                            <small class="fas fa-star"></small>
                                                            <small class="fas fa-star"></small>
                                                            <small class="far fa-star text-muted"></small>
                                                        </div>
                                                        <span class="text-secondary">(40)</span>
                                                    </a>
                                                </div>
                                                <div class="font-size-12 p-0 text-gray-110 mb-4">
                                                    <p class="mb-1">Brand new and high quality Brand new and high quality Brand new and high quality</p>
                                                </div>
                                                <div class="text-gray-20 mb-2 font-size-12">SKU: FW511948218</div>
                                                <div class="flex-center-between mb-1">
                                                    <div class="prodcut-price">
                                                        <div class="text-gray-100">SAR 100,00</div>
                                                    </div>
                                                    <div class="d-none d-xl-block prodcut-add-cart">
                                                        <a href="#" class="btn-add-cart btn-primary transition-3d-hover"><i class="ec ec-add-to-cart"></i></a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="product-item__footer">
                                                <div class="border-top pt-2 flex-center-between flex-wrap">
                                                    <a href="#" class="text-gray-6 font-size-13"><i class="ec ec-favorites mr-1 font-size-15"></i> Wishlist</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li class="col-6 col-md-3 col-wd-2gdot4 product-item">
                                    <div class="product-item__outer h-100">
                                        <div class="product-item__inner px-xl-2 p-3">
                                            <div class="product-item__body pb-xl-2">
                                                <div class="mb-2"><a href="#" class="font-size-12 text-gray-5">Category Name</a></div>
                                                <h5 class="mb-1 product-item__title"><a href="#" class="text-blue font-weight-bold">Interlocking paver and tile Holand-Chamfer height 60 mm.</a></h5>
                                                <div class="mb-2">
                                                    <a href="#" class="d-block text-center"><img class="img-fluid" src="assets/img/pro_2.jpg" alt="Image Description"></a>
                                                </div>
                                                <div class="mb-3">
                                                    <a class="d-inline-flex align-items-center small font-size-14" href="#">
                                                        <div class="text-warning mr-2">
                                                            <small class="fas fa-star"></small>
                                                            <small class="fas fa-star"></small>
                                                            <small class="fas fa-star"></small>
                                                            <small class="fas fa-star"></small>
                                                            <small class="far fa-star text-muted"></small>
                                                        </div>
                                                        <span class="text-secondary">(40)</span>
                                                    </a>
                                                </div>
                                                <div class="font-size-12 p-0 text-gray-110 mb-4">
                                                    <p class="mb-1">Brand new and high quality Brand new and high quality Brand new and high quality</p>
                                                </div>
                                                <div class="text-gray-20 mb-2 font-size-12">SKU: FW511948218</div>
                                                <div class="flex-center-between mb-1">
                                                    <div class="prodcut-price">
                                                        <div class="text-gray-100">SAR 100,00</div>
                                                    </div>
                                                    <div class="d-none d-xl-block prodcut-add-cart">
                                                        <a href="#" class="btn-add-cart btn-primary transition-3d-hover"><i class="ec ec-add-to-cart"></i></a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="product-item__footer">
                                                <div class="border-top pt-2 flex-center-between flex-wrap">
                                                    <a href="#" class="text-gray-6 font-size-13"><i class="ec ec-favorites mr-1 font-size-15"></i> Wishlist</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li class="col-6 col-md-3 col-wd-2gdot4 product-item">
                                    <div class="product-item__outer h-100">
                                        <div class="product-item__inner px-xl-2 p-3">
                                            <div class="product-item__body pb-xl-2">
                                                <div class="mb-2"><a href="#" class="font-size-12 text-gray-5">Category Name</a></div>
                                                <h5 class="mb-1 product-item__title"><a href="#" class="text-blue font-weight-bold">Interlocking paver and tile Holand-Chamfer height 60 mm.</a></h5>
                                                <div class="mb-2">
                                                    <a href="#" class="d-block text-center"><img class="img-fluid" src="assets/img/pro_3.png" alt="Image Description"></a>
                                                </div>
                                                <div class="mb-3">
                                                    <a class="d-inline-flex align-items-center small font-size-14" href="#">
                                                        <div class="text-warning mr-2">
                                                            <small class="fas fa-star"></small>
                                                            <small class="fas fa-star"></small>
                                                            <small class="fas fa-star"></small>
                                                            <small class="fas fa-star"></small>
                                                            <small class="far fa-star text-muted"></small>
                                                        </div>
                                                        <span class="text-secondary">(40)</span>
                                                    </a>
                                                </div>
                                                <div class="font-size-12 p-0 text-gray-110 mb-4">
                                                    <p class="mb-1">Brand new and high quality Brand new and high quality Brand new and high quality</p>
                                                </div>
                                                <div class="text-gray-20 mb-2 font-size-12">SKU: FW511948218</div>
                                                <div class="flex-center-between mb-1">
                                                    <div class="prodcut-price">
                                                        <div class="text-gray-100">SAR 100,00</div>
                                                    </div>
                                                    <div class="d-none d-xl-block prodcut-add-cart">
                                                        <a href="#" class="btn-add-cart btn-primary transition-3d-hover"><i class="ec ec-add-to-cart"></i></a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="product-item__footer">
                                                <div class="border-top pt-2 flex-center-between flex-wrap">
                                                    <a href="#" class="text-gray-6 font-size-13"><i class="ec ec-favorites mr-1 font-size-15"></i> Wishlist</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li class="col-6 col-md-3 col-wd-2gdot4 product-item">
                                    <div class="product-item__outer h-100">
                                        <div class="product-item__inner px-xl-2 p-3">
                                            <div class="product-item__body pb-xl-2">
                                                <div class="mb-2"><a href="#" class="font-size-12 text-gray-5">Category Name</a></div>
                                                <h5 class="mb-1 product-item__title"><a href="#" class="text-blue font-weight-bold">Interlocking paver and tile Holand-Chamfer height 60 mm.</a></h5>
                                                <div class="mb-2">
                                                    <a href="#" class="d-block text-center"><img class="img-fluid" src="assets/img/pro_4.jpg" alt="Image Description"></a>
                                                </div>
                                                <div class="mb-3">
                                                    <a class="d-inline-flex align-items-center small font-size-14" href="#">
                                                        <div class="text-warning mr-2">
                                                            <small class="fas fa-star"></small>
                                                            <small class="fas fa-star"></small>
                                                            <small class="fas fa-star"></small>
                                                            <small class="fas fa-star"></small>
                                                            <small class="far fa-star text-muted"></small>
                                                        </div>
                                                        <span class="text-secondary">(40)</span>
                                                    </a>
                                                </div>
                                                <div class="font-size-12 p-0 text-gray-110 mb-4">
                                                    <p class="mb-1">Brand new and high quality Brand new and high quality Brand new and high quality</p>
                                                </div>
                                                <div class="text-gray-20 mb-2 font-size-12">SKU: FW511948218</div>
                                                <div class="flex-center-between mb-1">
                                                    <div class="prodcut-price">
                                                        <div class="text-gray-100">SAR 100,00</div>
                                                    </div>
                                                    <div class="d-none d-xl-block prodcut-add-cart">
                                                        <a href="#" class="btn-add-cart btn-primary transition-3d-hover"><i class="ec ec-add-to-cart"></i></a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="product-item__footer">
                                                <div class="border-top pt-2 flex-center-between flex-wrap">
                                                    <a href="#" class="text-gray-6 font-size-13"><i class="ec ec-favorites mr-1 font-size-15"></i> Wishlist</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li class="col-6 col-md-3 col-wd-2gdot4 product-item">
                                    <div class="product-item__outer h-100">
                                        <div class="product-item__inner px-xl-2 p-3">
                                            <div class="product-item__body pb-xl-2">
                                                <div class="mb-2"><a href="#" class="font-size-12 text-gray-5">Category Name</a></div>
                                                <h5 class="mb-1 product-item__title"><a href="#" class="text-blue font-weight-bold">Interlocking paver and tile Holand-Chamfer height 60 mm.</a></h5>
                                                <div class="mb-2">
                                                    <a href="#" class="d-block text-center"><img class="img-fluid" src="assets/img/pro_5.png" alt="Image Description"></a>
                                                </div>
                                                <div class="mb-3">
                                                    <a class="d-inline-flex align-items-center small font-size-14" href="#">
                                                        <div class="text-warning mr-2">
                                                            <small class="fas fa-star"></small>
                                                            <small class="fas fa-star"></small>
                                                            <small class="fas fa-star"></small>
                                                            <small class="fas fa-star"></small>
                                                            <small class="far fa-star text-muted"></small>
                                                        </div>
                                                        <span class="text-secondary">(40)</span>
                                                    </a>
                                                </div>
                                                <div class="font-size-12 p-0 text-gray-110 mb-4">
                                                    <p class="mb-1">Brand new and high quality Brand new and high quality Brand new and high quality</p>
                                                </div>
                                                <div class="text-gray-20 mb-2 font-size-12">SKU: FW511948218</div>
                                                <div class="flex-center-between mb-1">
                                                    <div class="prodcut-price">
                                                        <div class="text-gray-100">SAR 100,00</div>
                                                    </div>
                                                    <div class="d-none d-xl-block prodcut-add-cart">
                                                        <a href="#" class="btn-add-cart btn-primary transition-3d-hover"><i class="ec ec-add-to-cart"></i></a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="product-item__footer">
                                                <div class="border-top pt-2 flex-center-between flex-wrap">
                                                    <a href="#" class="text-gray-6 font-size-13"><i class="ec ec-favorites mr-1 font-size-15"></i> Wishlist</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li class="col-6 col-md-3 col-wd-2gdot4 product-item">
                                    <div class="product-item__outer h-100">
                                        <div class="product-item__inner px-xl-2 p-3">
                                            <div class="product-item__body pb-xl-2">
                                                <div class="mb-2"><a href="#" class="font-size-12 text-gray-5">Category Name</a></div>
                                                <h5 class="mb-1 product-item__title"><a href="#" class="text-blue font-weight-bold">Interlocking paver and tile Holand-Chamfer height 60 mm.</a></h5>
                                                <div class="mb-2">
                                                    <a href="#" class="d-block text-center"><img class="img-fluid" src="assets/img/pro_6.jpg" alt="Image Description"></a>
                                                </div>
                                                <div class="mb-3">
                                                    <a class="d-inline-flex align-items-center small font-size-14" href="#">
                                                        <div class="text-warning mr-2">
                                                            <small class="fas fa-star"></small>
                                                            <small class="fas fa-star"></small>
                                                            <small class="fas fa-star"></small>
                                                            <small class="fas fa-star"></small>
                                                            <small class="far fa-star text-muted"></small>
                                                        </div>
                                                        <span class="text-secondary">(40)</span>
                                                    </a>
                                                </div>
                                                <div class="font-size-12 p-0 text-gray-110 mb-4">
                                                    <p class="mb-1">Brand new and high quality Brand new and high quality Brand new and high quality</p>
                                                </div>
                                                <div class="text-gray-20 mb-2 font-size-12">SKU: FW511948218</div>
                                                <div class="flex-center-between mb-1">
                                                    <div class="prodcut-price">
                                                        <div class="text-gray-100">SAR 100,00</div>
                                                    </div>
                                                    <div class="d-none d-xl-block prodcut-add-cart">
                                                        <a href="#" class="btn-add-cart btn-primary transition-3d-hover"><i class="ec ec-add-to-cart"></i></a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="product-item__footer">
                                                <div class="border-top pt-2 flex-center-between flex-wrap">
                                                    <a href="#" class="text-gray-6 font-size-13"><i class="ec ec-favorites mr-1 font-size-15"></i> Wishlist</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li class="col-6 col-md-3 col-wd-2gdot4 product-item">
                                    <div class="product-item__outer h-100">
                                        <div class="product-item__inner px-xl-2 p-3">
                                            <div class="product-item__body pb-xl-2">
                                                <div class="mb-2"><a href="#" class="font-size-12 text-gray-5">Category Name</a></div>
                                                <h5 class="mb-1 product-item__title"><a href="#" class="text-blue font-weight-bold">Interlocking paver and tile Holand-Chamfer height 60 mm.</a></h5>
                                                <div class="mb-2">
                                                    <a href="#" class="d-block text-center"><img class="img-fluid" src="assets/img/pro_7.jpg" alt="Image Description"></a>
                                                </div>
                                                <div class="mb-3">
                                                    <a class="d-inline-flex align-items-center small font-size-14" href="#">
                                                        <div class="text-warning mr-2">
                                                            <small class="fas fa-star"></small>
                                                            <small class="fas fa-star"></small>
                                                            <small class="fas fa-star"></small>
                                                            <small class="fas fa-star"></small>
                                                            <small class="far fa-star text-muted"></small>
                                                        </div>
                                                        <span class="text-secondary">(40)</span>
                                                    </a>
                                                </div>
                                                <div class="font-size-12 p-0 text-gray-110 mb-4">
                                                    <p class="mb-1">Brand new and high quality Brand new and high quality Brand new and high quality</p>
                                                </div>
                                                <div class="text-gray-20 mb-2 font-size-12">SKU: FW511948218</div>
                                                <div class="flex-center-between mb-1">
                                                    <div class="prodcut-price">
                                                        <div class="text-gray-100">SAR 100,00</div>
                                                    </div>
                                                    <div class="d-none d-xl-block prodcut-add-cart">
                                                        <a href="#" class="btn-add-cart btn-primary transition-3d-hover"><i class="ec ec-add-to-cart"></i></a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="product-item__footer">
                                                <div class="border-top pt-2 flex-center-between flex-wrap">
                                                    <a href="#" class="text-gray-6 font-size-13"><i class="ec ec-favorites mr-1 font-size-15"></i> Wishlist</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li class="col-6 col-md-3 col-wd-2gdot4 product-item">
                                    <div class="product-item__outer h-100">
                                        <div class="product-item__inner px-xl-2 p-3">
                                            <div class="product-item__body pb-xl-2">
                                                <div class="mb-2"><a href="#" class="font-size-12 text-gray-5">Category Name</a></div>
                                                <h5 class="mb-1 product-item__title"><a href="#" class="text-blue font-weight-bold">Interlocking paver and tile Holand-Chamfer height 60 mm.</a></h5>
                                                <div class="mb-2">
                                                    <a href="#" class="d-block text-center"><img class="img-fluid" src="assets/img/pro_13.png" alt="Image Description"></a>
                                                </div>
                                                <div class="mb-3">
                                                    <a class="d-inline-flex align-items-center small font-size-14" href="#">
                                                        <div class="text-warning mr-2">
                                                            <small class="fas fa-star"></small>
                                                            <small class="fas fa-star"></small>
                                                            <small class="fas fa-star"></small>
                                                            <small class="fas fa-star"></small>
                                                            <small class="far fa-star text-muted"></small>
                                                        </div>
                                                        <span class="text-secondary">(40)</span>
                                                    </a>
                                                </div>
                                                <div class="font-size-12 p-0 text-gray-110 mb-4">
                                                    <p class="mb-1">Brand new and high quality Brand new and high quality Brand new and high quality</p>
                                                </div>
                                                <div class="text-gray-20 mb-2 font-size-12">SKU: FW511948218</div>
                                                <div class="flex-center-between mb-1">
                                                    <div class="prodcut-price">
                                                        <div class="text-gray-100">SAR 100,00</div>
                                                    </div>
                                                    <div class="d-none d-xl-block prodcut-add-cart">
                                                        <a href="#" class="btn-add-cart btn-primary transition-3d-hover"><i class="ec ec-add-to-cart"></i></a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="product-item__footer">
                                                <div class="border-top pt-2 flex-center-between flex-wrap">
                                                    <a href="#" class="text-gray-6 font-size-13"><i class="ec ec-favorites mr-1 font-size-15"></i> Wishlist</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li class="col-6 col-md-3 col-wd-2gdot4 product-item">
                                    <div class="product-item__outer h-100">
                                        <div class="product-item__inner px-xl-2 p-3">
                                            <div class="product-item__body pb-xl-2">
                                                <div class="mb-2"><a href="#" class="font-size-12 text-gray-5">Category Name</a></div>
                                                <h5 class="mb-1 product-item__title"><a href="#" class="text-blue font-weight-bold">Interlocking paver and tile Holand-Chamfer height 60 mm.</a></h5>
                                                <div class="mb-2">
                                                    <a href="#" class="d-block text-center"><img class="img-fluid" src="assets/img/pro_12.jpg" alt="Image Description"></a>
                                                </div>
                                                <div class="mb-3">
                                                    <a class="d-inline-flex align-items-center small font-size-14" href="#">
                                                        <div class="text-warning mr-2">
                                                            <small class="fas fa-star"></small>
                                                            <small class="fas fa-star"></small>
                                                            <small class="fas fa-star"></small>
                                                            <small class="fas fa-star"></small>
                                                            <small class="far fa-star text-muted"></small>
                                                        </div>
                                                        <span class="text-secondary">(40)</span>
                                                    </a>
                                                </div>
                                                <div class="font-size-12 p-0 text-gray-110 mb-4">
                                                    <p class="mb-1">Brand new and high quality Brand new and high quality Brand new and high quality</p>
                                                </div>
                                                <div class="text-gray-20 mb-2 font-size-12">SKU: FW511948218</div>
                                                <div class="flex-center-between mb-1">
                                                    <div class="prodcut-price">
                                                        <div class="text-gray-100">SAR 100,00</div>
                                                    </div>
                                                    <div class="d-none d-xl-block prodcut-add-cart">
                                                        <a href="#" class="btn-add-cart btn-primary transition-3d-hover"><i class="ec ec-add-to-cart"></i></a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="product-item__footer">
                                                <div class="border-top pt-2 flex-center-between flex-wrap">
                                                    <a href="#" class="text-gray-6 font-size-13"><i class="ec ec-favorites mr-1 font-size-15"></i> Wishlist</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li class="col-6 col-md-3 col-wd-2gdot4 product-item">
                                    <div class="product-item__outer h-100">
                                        <div class="product-item__inner px-xl-2 p-3">
                                            <div class="product-item__body pb-xl-2">
                                                <div class="mb-2"><a href="#" class="font-size-12 text-gray-5">Category Name</a></div>
                                                <h5 class="mb-1 product-item__title"><a href="#" class="text-blue font-weight-bold">Interlocking paver and tile Holand-Chamfer height 60 mm.</a></h5>
                                                <div class="mb-2">
                                                    <a href="#" class="d-block text-center"><img class="img-fluid" src="assets/img/pro_11.jpg" alt="Image Description"></a>
                                                </div>
                                                <div class="mb-3">
                                                    <a class="d-inline-flex align-items-center small font-size-14" href="#">
                                                        <div class="text-warning mr-2">
                                                            <small class="fas fa-star"></small>
                                                            <small class="fas fa-star"></small>
                                                            <small class="fas fa-star"></small>
                                                            <small class="fas fa-star"></small>
                                                            <small class="far fa-star text-muted"></small>
                                                        </div>
                                                        <span class="text-secondary">(40)</span>
                                                    </a>
                                                </div>
                                                <div class="font-size-12 p-0 text-gray-110 mb-4">
                                                    <p class="mb-1">Brand new and high quality Brand new and high quality Brand new and high quality</p>
                                                </div>
                                                <div class="text-gray-20 mb-2 font-size-12">SKU: FW511948218</div>
                                                <div class="flex-center-between mb-1">
                                                    <div class="prodcut-price">
                                                        <div class="text-gray-100">SAR 100,00</div>
                                                    </div>
                                                    <div class="d-none d-xl-block prodcut-add-cart">
                                                        <a href="#" class="btn-add-cart btn-primary transition-3d-hover"><i class="ec ec-add-to-cart"></i></a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="product-item__footer">
                                                <div class="border-top pt-2 flex-center-between flex-wrap">
                                                    <a href="#" class="text-gray-6 font-size-13"><i class="ec ec-favorites mr-1 font-size-15"></i> Wishlist</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>

                            </ul>
                        </div>
                        <div class="tab-pane fade pt-2" id="pills-four-example1" role="tabpanel" aria-labelledby="pills-four-example1-tab" data-target-group="groups">
                            <ul class="d-block list-unstyled products-group prodcut-list-view-small">

                                <li class="product-item remove-divider">
                                    <div class="product-item__outer w-100">
                                        <div class="product-item__inner remove-prodcut-hover py-4 row">
                                            <div class="product-item__header col-6 col-md-2">
                                                <div class="mb-2">
                                                    <a href="#" class="d-block text-center">
                                                        <img class="img-fluid" src="assets/img/pro_2.jpg" alt="Image Description">
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="product-item__body col-6 col-md-7">
                                                <div class="pr-lg-10">
                                                    <div class="mb-2"><a href="#" class="font-size-12 text-gray-5">Category Name</a></div>
                                                    <h5 class="mb-2 product-item__title"><a href="#" class="text-blue font-weight-bold">Interlocking paver and tile Holand-Chamfer height 60 mm.</a></h5>
                                                    <div class="prodcut-price d-md-none">
                                                        <div class="text-gray-100">SAR 100,00</div>
                                                    </div>
                                                    <div class="font-size-12 p-0 text-gray-110 mb-4 d-none d-md-block">
                                                        <p class="mb-1">Brand new and high quality Brand new and high quality Brand new and high quality Brand new and high quality Brand new and high quality Brand new and high quality</p>
                                                    </div>
                                                    <div class="mb-3 d-none d-md-block">
                                                        <a class="d-inline-flex align-items-center small font-size-14" href="#">
                                                            <div class="text-warning mr-2">
                                                                <small class="fas fa-star"></small>
                                                                <small class="fas fa-star"></small>
                                                                <small class="fas fa-star"></small>
                                                                <small class="fas fa-star"></small>
                                                                <small class="far fa-star text-muted"></small>
                                                            </div>
                                                            <span class="text-secondary">(40)</span>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="product-item__footer col-md-3 d-md-block">
                                                <div class="mb-2 flex-center-between">
                                                    <div class="prodcut-price">
                                                        <div class="text-gray-100">$685,00</div>
                                                    </div>
                                                    <div class="prodcut-add-cart">
                                                        <a href="#" class="btn-add-cart btn-primary transition-3d-hover"><i class="ec ec-add-to-cart"></i></a>
                                                    </div>
                                                </div>
                                                <div class="flex-horizontal-center justify-content-between justify-content-wd-center flex-wrap border-top pt-3">
                                                    <a href="#" class="text-gray-6 font-size-13 mx-wd-3"><i class="ec ec-favorites mr-1 font-size-15"></i> Wishlist</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li class="product-item remove-divider">
                                    <div class="product-item__outer w-100">
                                        <div class="product-item__inner remove-prodcut-hover py-4 row">
                                            <div class="product-item__header col-6 col-md-2">
                                                <div class="mb-2">
                                                    <a href="#" class="d-block text-center">
                                                        <img class="img-fluid" src="assets/img/pro_2.jpg" alt="Image Description">
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="product-item__body col-6 col-md-7">
                                                <div class="pr-lg-10">
                                                    <div class="mb-2"><a href="#" class="font-size-12 text-gray-5">Category Name</a></div>
                                                    <h5 class="mb-2 product-item__title"><a href="#" class="text-blue font-weight-bold">Interlocking paver and tile Holand-Chamfer height 60 mm.</a></h5>
                                                    <div class="prodcut-price d-md-none">
                                                        <div class="text-gray-100">SAR 100,00</div>
                                                    </div>
                                                    <div class="font-size-12 p-0 text-gray-110 mb-4 d-none d-md-block">
                                                        <p class="mb-1">Brand new and high quality Brand new and high quality Brand new and high quality Brand new and high quality Brand new and high quality Brand new and high quality</p>
                                                    </div>
                                                    <div class="mb-3 d-none d-md-block">
                                                        <a class="d-inline-flex align-items-center small font-size-14" href="#">
                                                            <div class="text-warning mr-2">
                                                                <small class="fas fa-star"></small>
                                                                <small class="fas fa-star"></small>
                                                                <small class="fas fa-star"></small>
                                                                <small class="fas fa-star"></small>
                                                                <small class="far fa-star text-muted"></small>
                                                            </div>
                                                            <span class="text-secondary">(40)</span>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="product-item__footer col-md-3 d-md-block">
                                                <div class="mb-2 flex-center-between">
                                                    <div class="prodcut-price">
                                                        <div class="text-gray-100">SAR 100,00</div>
                                                    </div>
                                                    <div class="prodcut-add-cart">
                                                        <a href="#" class="btn-add-cart btn-primary transition-3d-hover"><i class="ec ec-add-to-cart"></i></a>
                                                    </div>
                                                </div>
                                                <div class="flex-horizontal-center justify-content-between justify-content-wd-center flex-wrap border-top pt-3">
                                                    <a href="#" class="text-gray-6 font-size-13 mx-wd-3"><i class="ec ec-favorites mr-1 font-size-15"></i> Wishlist</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li class="product-item remove-divider">
                                    <div class="product-item__outer w-100">
                                        <div class="product-item__inner remove-prodcut-hover py-4 row">
                                            <div class="product-item__header col-6 col-md-2">
                                                <div class="mb-2">
                                                    <a href="#" class="d-block text-center">
                                                        <img class="img-fluid" src="assets/img/pro_2.jpg" alt="Image Description">
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="product-item__body col-6 col-md-7">
                                                <div class="pr-lg-10">
                                                    <div class="mb-2"><a href="#" class="font-size-12 text-gray-5">Category Name</a></div>
                                                    <h5 class="mb-2 product-item__title"><a href="#" class="text-blue font-weight-bold">Interlocking paver and tile Holand-Chamfer height 60 mm.</a></h5>
                                                    <div class="prodcut-price d-md-none">
                                                        <div class="text-gray-100">SAR 100,00</div>
                                                    </div>
                                                    <div class="font-size-12 p-0 text-gray-110 mb-4 d-none d-md-block">
                                                        <p class="mb-1">Brand new and high quality Brand new and high quality Brand new and high quality Brand new and high quality Brand new and high quality Brand new and high quality</p>
                                                    </div>
                                                    <div class="mb-3 d-none d-md-block">
                                                        <a class="d-inline-flex align-items-center small font-size-14" href="#">
                                                            <div class="text-warning mr-2">
                                                                <small class="fas fa-star"></small>
                                                                <small class="fas fa-star"></small>
                                                                <small class="fas fa-star"></small>
                                                                <small class="fas fa-star"></small>
                                                                <small class="far fa-star text-muted"></small>
                                                            </div>
                                                            <span class="text-secondary">(40)</span>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="product-item__footer col-md-3 d-md-block">
                                                <div class="mb-2 flex-center-between">
                                                    <div class="prodcut-price">
                                                        <div class="text-gray-100">$685,00</div>
                                                    </div>
                                                    <div class="prodcut-add-cart">
                                                        <a href="#" class="btn-add-cart btn-primary transition-3d-hover"><i class="ec ec-add-to-cart"></i></a>
                                                    </div>
                                                </div>
                                                <div class="flex-horizontal-center justify-content-between justify-content-wd-center flex-wrap border-top pt-3">
                                                    <a href="#" class="text-gray-6 font-size-13 mx-wd-3"><i class="ec ec-favorites mr-1 font-size-15"></i> Wishlist</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li class="product-item remove-divider">
                                    <div class="product-item__outer w-100">
                                        <div class="product-item__inner remove-prodcut-hover py-4 row">
                                            <div class="product-item__header col-6 col-md-2">
                                                <div class="mb-2">
                                                    <a href="#" class="d-block text-center">
                                                        <img class="img-fluid" src="assets/img/pro_2.jpg" alt="Image Description">
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="product-item__body col-6 col-md-7">
                                                <div class="pr-lg-10">
                                                    <div class="mb-2"><a href="#" class="font-size-12 text-gray-5">Category Name</a></div>
                                                    <h5 class="mb-2 product-item__title"><a href="#" class="text-blue font-weight-bold">Interlocking paver and tile Holand-Chamfer height 60 mm.</a></h5>
                                                    <div class="prodcut-price d-md-none">
                                                        <div class="text-gray-100">SAR 100,00</div>
                                                    </div>
                                                    <div class="font-size-12 p-0 text-gray-110 mb-4 d-none d-md-block">
                                                        <p class="mb-1">Brand new and high quality Brand new and high quality Brand new and high quality Brand new and high quality Brand new and high quality Brand new and high quality</p>
                                                    </div>
                                                    <div class="mb-3 d-none d-md-block">
                                                        <a class="d-inline-flex align-items-center small font-size-14" href="#">
                                                            <div class="text-warning mr-2">
                                                                <small class="fas fa-star"></small>
                                                                <small class="fas fa-star"></small>
                                                                <small class="fas fa-star"></small>
                                                                <small class="fas fa-star"></small>
                                                                <small class="far fa-star text-muted"></small>
                                                            </div>
                                                            <span class="text-secondary">(40)</span>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="product-item__footer col-md-3 d-md-block">
                                                <div class="mb-2 flex-center-between">
                                                    <div class="prodcut-price">
                                                        <div class="text-gray-100">SAR 100,00</div>
                                                    </div>
                                                    <div class="prodcut-add-cart">
                                                        <a href="#" class="btn-add-cart btn-primary transition-3d-hover"><i class="ec ec-add-to-cart"></i></a>
                                                    </div>
                                                </div>
                                                <div class="flex-horizontal-center justify-content-between justify-content-wd-center flex-wrap border-top pt-3">
                                                    <a href="#" class="text-gray-6 font-size-13 mx-wd-3"><i class="ec ec-favorites mr-1 font-size-15"></i> Wishlist</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li class="product-item remove-divider">
                                    <div class="product-item__outer w-100">
                                        <div class="product-item__inner remove-prodcut-hover py-4 row">
                                            <div class="product-item__header col-6 col-md-2">
                                                <div class="mb-2">
                                                    <a href="#" class="d-block text-center">
                                                        <img class="img-fluid" src="assets/img/pro_2.jpg" alt="Image Description">
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="product-item__body col-6 col-md-7">
                                                <div class="pr-lg-10">
                                                    <div class="mb-2"><a href="#" class="font-size-12 text-gray-5">Category Name</a></div>
                                                    <h5 class="mb-2 product-item__title"><a href="#" class="text-blue font-weight-bold">Interlocking paver and tile Holand-Chamfer height 60 mm.</a></h5>
                                                    <div class="prodcut-price d-md-none">
                                                        <div class="text-gray-100">SAR 100,00</div>
                                                    </div>
                                                    <div class="font-size-12 p-0 text-gray-110 mb-4 d-none d-md-block">
                                                        <p class="mb-1">Brand new and high quality Brand new and high quality Brand new and high quality Brand new and high quality Brand new and high quality Brand new and high quality</p>
                                                    </div>
                                                    <div class="mb-3 d-none d-md-block">
                                                        <a class="d-inline-flex align-items-center small font-size-14" href="#">
                                                            <div class="text-warning mr-2">
                                                                <small class="fas fa-star"></small>
                                                                <small class="fas fa-star"></small>
                                                                <small class="fas fa-star"></small>
                                                                <small class="fas fa-star"></small>
                                                                <small class="far fa-star text-muted"></small>
                                                            </div>
                                                            <span class="text-secondary">(40)</span>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="product-item__footer col-md-3 d-md-block">
                                                <div class="mb-2 flex-center-between">
                                                    <div class="prodcut-price">
                                                        <div class="text-gray-100">SAR 100,00</div>
                                                    </div>
                                                    <div class="prodcut-add-cart">
                                                        <a href="#" class="btn-add-cart btn-primary transition-3d-hover"><i class="ec ec-add-to-cart"></i></a>
                                                    </div>
                                                </div>
                                                <div class="flex-horizontal-center justify-content-between justify-content-wd-center flex-wrap border-top pt-3">
                                                    <a href="#" class="text-gray-6 font-size-13 mx-wd-3"><i class="ec ec-favorites mr-1 font-size-15"></i> Wishlist</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li class="product-item remove-divider">
                                    <div class="product-item__outer w-100">
                                        <div class="product-item__inner remove-prodcut-hover py-4 row">
                                            <div class="product-item__header col-6 col-md-2">
                                                <div class="mb-2">
                                                    <a href="#" class="d-block text-center">
                                                        <img class="img-fluid" src="assets/img/pro_2.jpg" alt="Image Description">
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="product-item__body col-6 col-md-7">
                                                <div class="pr-lg-10">
                                                    <div class="mb-2"><a href="#" class="font-size-12 text-gray-5">Category Name</a></div>
                                                    <h5 class="mb-2 product-item__title"><a href="#" class="text-blue font-weight-bold">Interlocking paver and tile Holand-Chamfer height 60 mm.</a></h5>
                                                    <div class="prodcut-price d-md-none">
                                                        <div class="text-gray-100">SAR 100,00</div>
                                                    </div>
                                                    <div class="font-size-12 p-0 text-gray-110 mb-4 d-none d-md-block">
                                                        <p class="mb-1">Brand new and high quality Brand new and high quality Brand new and high quality Brand new and high quality Brand new and high quality Brand new and high quality</p>
                                                    </div>
                                                    <div class="mb-3 d-none d-md-block">
                                                        <a class="d-inline-flex align-items-center small font-size-14" href="#">
                                                            <div class="text-warning mr-2">
                                                                <small class="fas fa-star"></small>
                                                                <small class="fas fa-star"></small>
                                                                <small class="fas fa-star"></small>
                                                                <small class="fas fa-star"></small>
                                                                <small class="far fa-star text-muted"></small>
                                                            </div>
                                                            <span class="text-secondary">(40)</span>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="product-item__footer col-md-3 d-md-block">
                                                <div class="mb-2 flex-center-between">
                                                    <div class="prodcut-price">
                                                        <div class="text-gray-100">SAR 100,00</div>
                                                    </div>
                                                    <div class="prodcut-add-cart">
                                                        <a href="#" class="btn-add-cart btn-primary transition-3d-hover"><i class="ec ec-add-to-cart"></i></a>
                                                    </div>
                                                </div>
                                                <div class="flex-horizontal-center justify-content-between justify-content-wd-center flex-wrap border-top pt-3">
                                                    <a href="#" class="text-gray-6 font-size-13 mx-wd-3"><i class="ec ec-favorites mr-1 font-size-15"></i> Wishlist</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>

                            </ul>
                        </div>
                    </div>
                    <!-- End Tab Content -->

                    <nav class="d-md-flex justify-content-between align-items-center border-top pt-3" aria-label="Page navigation example">
                        <div class="text-center text-md-left mb-3 mb-md-0">Showing 1–25 of 56 results</div>
                        <ul class="pagination mb-0 pagination-shop justify-content-center justify-content-md-start">
                            <li class="page-item"><a class="page-link current" href="#">1</a></li>
                            <li class="page-item"><a class="page-link" href="#">2</a></li>
                            <li class="page-item"><a class="page-link" href="#">3</a></li>
                        </ul>
                    </nav>


                </div>
            </div>
        </div>
    </div>
    <div class="container mb-8">
        <div class="py-2 border-top border-bottom">
            <div class="js-slick-carousel u-slick my-1"
                 data-slides-show="5"
                 data-slides-scroll="1"
                 data-arrows-classes="d-none d-lg-inline-block u-slick__arrow-normal u-slick__arrow-centered--y"
                 data-arrow-left-classes="fa fa-angle-left u-slick__arrow-classic-inner--left z-index-9"
                 data-arrow-right-classes="fa fa-angle-right u-slick__arrow-classic-inner--right"
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
                <div class="js-slide img_vend">
                    <a href="#" class="link-hover__brand">
                        <img class="img-fluid m-auto max-height-50" src="assets/img/vendor_1.png" alt="Image Description">
                    </a>
                </div>
                <div class="js-slide img_vend">
                    <a href="#" class="link-hover__brand">
                        <img class="img-fluid m-auto max-height-50" src="assets/img/vendor_2.png" alt="Image Description">
                    </a>
                </div>
                <div class="js-slide img_vend">
                    <a href="#" class="link-hover__brand">
                        <img class="img-fluid m-auto max-height-50" src="assets/img/vendor_3.png" alt="Image Description">
                    </a>
                </div>
                <div class="js-slide img_vend">
                    <a href="#" class="link-hover__brand">
                        <img class="img-fluid m-auto max-height-50" src="assets/img/vendor_4.png" alt="Image Description">
                    </a>
                </div>
                <div class="js-slide img_vend">
                    <a href="#" class="link-hover__brand">
                        <img class="img-fluid m-auto max-height-50" src="assets/img/vendor_5.png" alt="Image Description">
                    </a>
                </div>
                <div class="js-slide img_vend">
                    <a href="#" class="link-hover__brand">
                        <img class="img-fluid m-auto max-height-50" src="assets/img/vendor_6.png" alt="Image Description">
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection
