@extends('front.layouts.master')
@section('metaTags')
    <title>YouMats | {{$subCategory->name}}</title>
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
                                   data-type="double"
                                   data-grid="false"
                                   data-hide-from-to="true"
                                   data-prefix="$"
                                   data-min="0"
                                   data-max="3456"
                                   data-from="0"
                                   data-to="3456"
                                   data-result-min="#rangeSliderExample3MinResult_2"
                                   data-result-max="#rangeSliderExample3MaxResult_2">
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
                    <div class="mb-6">
                        <div class="border-bottom border-color-1 mb-5">
                            <h3 class="section-title section-title__sm mb-0 pb-2 font-size-18">Categories</h3>
                        </div>
                        <div class="border-bottom pb-4 mb-4">
                            <!-- Checkboxes -->
                            <div class="form-group d-flex align-items-center justify-content-between mb-2 pb-1">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="brandAdidas">
                                    <label class="custom-control-label" for="brandAdidas">Building Material
                                        <span class="text-gray-25 font-size-12 font-weight-normal"> (56)</span>
                                    </label>
                                </div>
                            </div>
                            <div class="form-group d-flex align-items-center justify-content-between mb-2 pb-1">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="brandNewBalance">
                                    <label class="custom-control-label" for="brandNewBalance">Plumbing
                                        <span class="text-gray-25 font-size-12 font-weight-normal"> (56)</span>
                                    </label>
                                </div>
                            </div>
                            <div class="form-group d-flex align-items-center justify-content-between mb-2 pb-1">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="brandNike">
                                    <label class="custom-control-label" for="brandNike">Bathroom
                                        <span class="text-gray-25 font-size-12 font-weight-normal"> (56)</span>
                                    </label>
                                </div>
                            </div>
                            <div class="form-group d-flex align-items-center justify-content-between mb-2 pb-1">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="brandFredPerry">
                                    <label class="custom-control-label" for="brandFredPerry">Electrical
                                        <span class="text-gray-25 font-size-12 font-weight-normal"> (56)</span>
                                    </label>
                                </div>
                            </div>
                            <div class="form-group d-flex align-items-center justify-content-between mb-2 pb-1">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="brandTnf">
                                    <label class="custom-control-label" for="brandTnf">Precast Concrete
                                        <span class="text-gray-25 font-size-12 font-weight-normal"> (56)</span>
                                    </label>
                                </div>
                            </div>
                            <div class="form-group d-flex align-items-center justify-content-between mb-2 pb-1">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="brandTnf-1">
                                    <label class="custom-control-label" for="brandTnf-1">Paints
                                        <span class="text-gray-25 font-size-12 font-weight-normal"> (56)</span>
                                    </label>
                                </div>
                            </div>
                            <div class="form-group d-flex align-items-center justify-content-between mb-2 pb-1">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="brandTnf-2">
                                    <label class="custom-control-label" for="brandTnf-2">New Balance
                                        <span class="text-gray-25 font-size-12 font-weight-normal"> (56)</span>
                                    </label>
                                </div>
                            </div>
                            <div class="form-group d-flex align-items-center justify-content-between mb-2 pb-1">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="brandTnf-3">
                                    <label class="custom-control-label" for="brandTnf-3">Paints
                                        <span class="text-gray-25 font-size-12 font-weight-norma3"> (56)</span>
                                    </label>
                                </div>
                            </div>
                            <div class="form-group d-flex align-items-center justify-content-between mb-2 pb-1">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="brandTnf-4">
                                    <label class="custom-control-label" for="brandTnf-4">Safety Products
                                        <span class="text-gray-25 font-size-12 font-weight-normal"> (56)</span>
                                    </label>
                                </div>
                            </div>
                            <div class="form-group d-flex align-items-center justify-content-between mb-2 pb-1">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="brandTnf-5">
                                    <label class="custom-control-label" for="brandTnf-5">Precast Concrete
                                        <span class="text-gray-25 font-size-12 font-weight-normal"> (56)</span>
                                    </label>
                                </div>
                            </div>
                            <div class="form-group d-flex align-items-center justify-content-between mb-2 pb-1">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="brandTnf-6">
                                    <label class="custom-control-label" for="brandTnf-6">Safety Products
                                        <span class="text-gray-25 font-size-12 font-weight-normal"> (56)</span>
                                    </label>
                                </div>
                            </div>
                            <div class="form-group d-flex align-items-center justify-content-between mb-2 pb-1">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="brandTnf-7">
                                    <label class="custom-control-label" for="brandTnf-7">Safety Products
                                        <span class="text-gray-25 font-size-12 font-weight-normal"> (56)</span>
                                    </label>
                                </div>
                            </div>
                            <div class="form-group d-flex align-items-center justify-content-between mb-2 pb-1">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="brandTnf-8">
                                    <label class="custom-control-label" for="brandTnf-8">Safety Products
                                        <span class="text-gray-25 font-size-12 font-weight-normal"> (56)</span>
                                    </label>
                                </div>
                            </div>
                            <div class="form-group d-flex align-items-center justify-content-between mb-2 pb-1">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="brandTnf-9">
                                    <label class="custom-control-label" for="brandTnf-9">Safety Products
                                        <span class="text-gray-25 font-size-12 font-weight-normal"> (56)</span>
                                    </label>
                                </div>
                            </div>
                            <!-- End Checkboxes -->


                        </div>


                    </div>
                </div>
                <div class="col-xl-9 col-wd-9gdot5">

                    <div class="d-block d-md-flex flex-center-between mb-3">
                        <h3 class="font-size-25 mb-2 mb-md-0">Building Material</h3>
                        <p class="font-size-14 text-gray-90 mb-0">Showing 1–25 of 56 results</p>
                    </div>



                    <!-- Tab Content -->
                    <div class="tab-content" id="pills-tabContent">

                        <div class="tab-pane fade pt-2 show active" id="pills-two-example1" role="tabpanel" aria-labelledby="pills-two-example1-tab" data-target-group="groups">
                            <ul class="row list-unstyled products-group no-gutters">
                                <li class="col-6 col-md-3 col-wd-2gdot4 product-item">
                                    <div class="product-item__outer h-100">
                                        <div class="product-item__inner px-xl-2 p-3">
                                            <div class="product-item__body pb-xl-2">
                                                <div class="mb-2"><a href="#" class="font-size-12 text-gray-5">Category Name</a></div>
                                                <h5 class="mb-1 product-item__title"><a href="#" class="text-blue font-weight-bold">Next Step Industrial Degreaser Cleaner</a></h5>
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
                                                <h5 class="mb-1 product-item__title"><a href="#" class="text-blue font-weight-bold">Next Step Industrial Degreaser Cleaner</a></h5>
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
                                                <h5 class="mb-1 product-item__title"><a href="#" class="text-blue font-weight-bold">Next Step Industrial Degreaser Cleaner</a></h5>
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
                                                <h5 class="mb-1 product-item__title"><a href="#" class="text-blue font-weight-bold">Next Step Industrial Degreaser Cleaner</a></h5>
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
                                                <h5 class="mb-1 product-item__title"><a href="#" class="text-blue font-weight-bold">Next Step Industrial Degreaser Cleaner</a></h5>
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
                                                <h5 class="mb-1 product-item__title"><a href="#" class="text-blue font-weight-bold">Next Step Industrial Degreaser Cleaner</a></h5>
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
                                                <h5 class="mb-1 product-item__title"><a href="#" class="text-blue font-weight-bold">WNext Step Industrial Degreaser Cleaner</a></h5>
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
                                                <h5 class="mb-1 product-item__title"><a href="#" class="text-blue font-weight-bold">Next Step Industrial Degreaser Cleaner</a></h5>
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
                                                <h5 class="mb-1 product-item__title"><a href="#" class="text-blue font-weight-bold">Next Step Industrial Degreaser Cleaner</a></h5>
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
                                                <h5 class="mb-1 product-item__title"><a href="#" class="text-blue font-weight-bold">Next Step Industrial Degreaser Cleaner</a></h5>
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
                                                    <h5 class="mb-2 product-item__title"><a href="#" class="text-blue font-weight-bold">Next Step Industrial Degreaser Cleaner</a></h5>
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
                                                    <h5 class="mb-2 product-item__title"><a href="#" class="text-blue font-weight-bold">Next Step Industrial Degreaser Cleaner</a></h5>
                                                    <div class="prodcut-price d-md-none">
                                                        <div class="text-gray-100">$685,00</div>
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
                                                    <h5 class="mb-2 product-item__title"><a href="#" class="text-blue font-weight-bold">Next Step Industrial Degreaser Cleaner</a></h5>
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
                                                    <h5 class="mb-2 product-item__title"><a href="#" class="text-blue font-weight-bold">Next Step Industrial Degreaser Cleaner</a></h5>
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
                                                    <h5 class="mb-2 product-item__title"><a href="#" class="text-blue font-weight-bold">Next Step Industrial Degreaser Cleaner</a></h5>
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
                                                    <h5 class="mb-2 product-item__title"><a href="#" class="text-blue font-weight-bold">Next Step Industrial Degreaser Cleaner</a></h5>
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
