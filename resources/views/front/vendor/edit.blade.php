@extends('front.layouts.master')
@section('metaTags')
    <title>YouMats | {{ $vendor->name . ' ' . _('Profile') }}</title>
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
                        <li class="breadcrumb-item flex-shrink-0 flex-xl-shrink-1"><a href="#">Home</a></li>
                        <li class="breadcrumb-item flex-shrink-0 flex-xl-shrink-1 active" aria-current="page">Vendor Profile</li>
                    </ol>
                </nav>
            </div>
            <!-- End breadcrumb -->
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="img_vendor">
                    <img src="{{ $vendor->getFirstMediaUrl(VENDOR_COVER) }}" class="photo_cover_vendor">
                </div>
                <img src="{{ $vendor->getFirstMediaUrl(VENDOR_LOGO) }}" class="photo_profile_vendor">
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="info_main_vendor">
                    <h3>{{ $vendor->name }}</h3>
                    <p>{{ __('Started') . ' ' . $vendor->created_at->format('d/m/Y') }}</p>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="position-relative position-md-static px-md-6">
                    <ul class="nav nav-classic nav-tab nav-tab-lg justify-content-xl-center flex-nowrap flex-xl-wrap overflow-auto overflow-xl-visble border-0 pb-1 pb-xl-0 mb-n1 mb-xl-0" id="pills-tab-8" role="tablist">
                        <li class="nav-item flex-shrink-0 flex-xl-shrink-1 z-index-2">
                            <a class="nav-link active" id="Jpills-one-example1-tab" data-toggle="pill" href="#Jpills-one-example1" role="tab" aria-controls="Jpills-one-example1" aria-selected="true">Main Info</a>
                        </li>
                        <li class="nav-item flex-shrink-0 flex-xl-shrink-1 z-index-2">
                            <a class="nav-link" id="Jpills-two-example1-tab" data-toggle="pill" href="#Jpills-two-example1" role="tab" aria-controls="Jpills-two-example1" aria-selected="false">My Products</a>
                        </li>
                        <li class="nav-item flex-shrink-0 flex-xl-shrink-1 z-index-2">
                            <a class="nav-link" id="Jpills-three-example1-tab" data-toggle="pill" href="#Jpills-three-example1" role="tab" aria-controls="Jpills-three-example1" aria-selected="false">My Branches</a>
                        </li>
                        <li class="nav-item flex-shrink-0 flex-xl-shrink-1 z-index-2">
                            <a class="nav-link" id="Jpills-four-example1-tab" data-toggle="pill" href="#Jpills-four-example1" role="tab" aria-controls="Jpills-four-example1" aria-selected="false"> My Order </a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-md-12">
                <div class="borders-radius-17 border p-4 mt-4 mt-md-0 px-lg-10 py-lg-9 mb-5">
                    <div class="tab-content" id="Jpills-tabContent">
                        <div class="tab-pane fade active show" id="Jpills-one-example1" role="tabpanel" aria-labelledby="Jpills-one-example1-tab">
                            <div class="block_info_vendor">
                                <form>
                                    <div class="row">

                                        <div class="col-md-6">
                                            <div class="box_img_v">
                                                <img src="{{ $vendor->getFirstMediaUrl(VENDOR_COVER) }}" class="photo_cover_vendor">
                                            </div>
                                        </div>
                                        <div class="col-md-3 ml-auto">
                                            <div class="box_img_profile">
                                                <img src="{{ $vendor->getFirstMediaUrl(VENDOR_LOGO) }}" class="photo_cover_vendor">
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="js-form-message form-group mb-5">
                                                <label class="form-label"> Image Cover <span class="text-danger">*</span></label>
                                                <div class="box">
                                                    <input type="file" name="file-7[]" id="file-7" class="inputfile inputfile-6" data-multiple-caption="{count} files selected" multiple />
                                                    <label for="file-7">
                                                        <span></span>
                                                        <strong>Choose a file&hellip;</strong>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="js-form-message form-group mb-5">
                                                <label class="form-label"> Image Profile <span class="text-danger">*</span></label>
                                                <div class="box">
                                                    <input type="file" name="file-8[]" id="file-8" class="inputfile inputfile-6" data-multiple-caption="{count} files selected" multiple />
                                                    <label for="file-8">
                                                        <span></span>
                                                        <strong>Choose a file&hellip;</strong>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="js-form-message form-group mb-5">
                                                <label class="form-label">Full Name<span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" name="name" value="{{ $vendor->name }}" placeholder="Enter your name" required="">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="js-form-message form-group mb-5">
                                                <label class="form-label">E-Mail<span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" name="email" value="{{ $vendor->email }}" placeholder="Enter your email" required="">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="js-form-message form-group mb-5">
                                                <label class="form-label">Phone Number 1 </label>
                                                <input type="text" class="form-control" name="phone1" value="{{ $vendor->phone1 }}" placeholder="Enter your phone">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="js-form-message form-group mb-5">
                                                <label class="form-label">Phone Number 2 </label>
                                                <input type="text" class="form-control" name="phone2" value="{{ $vendor->phone2 }}" placeholder="Enter your second phone">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="js-form-message form-group mb-5">
                                                <label class="form-label">WhatsApp</label>
                                                <input type="text" class="form-control" name="whatsapp_phone" {{ $vendor->whatsapp_phone }} placeholder="Enter WhatsApp phone">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="js-form-message form-group mb-5">
                                                <label class="form-label">Address</label>
                                                <input type="text" class="form-control" name="address" value="{{ $vendor->address }}" placeholder="Enter your address">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="js-form-message form-group mb-5">
                                                <label class="form-label">Address 2</label>
                                                <input type="text" class="form-control" name="address2" value="{{ $vendor->address2 }}" placeholder="Enter your second address">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="js-form-message form-group mb-5">
                                                <label class="form-label">Facebook</label>
                                                <input type="text" class="form-control" name="facebook_url" value="{{ $vendor->facebook_url }}" placeholder="Enter your facebook">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="js-form-message form-group mb-5">
                                                <label class="form-label">Twitter</label>
                                                <input type="text" class="form-control" name="twitter_url" value="{{ $vendor->twitter_url }}" placeholder="Enter your twitter">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="js-form-message form-group mb-5">
                                                <label class="form-label">Youtube</label>
                                                <input type="text" class="form-control" name="youtube_url" value="{{ $vendor->youtube_url }}" placeholder="Enter your youtube">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="js-form-message form-group mb-5">
                                                <label class="form-label">Instagram</label>
                                                <input type="text" class="form-control" name="instagram_url" value="{{ $vendor->instagram_url }}" placeholder="Enter your instagram">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="js-form-message form-group mb-5">
                                                <label class="form-label">Pinterest</label>
                                                <input type="text" class="form-control" name="pinterest_url" value="{{ $vendor->pinterest_url }}" placeholder="Enter your pinterest">
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="js-form-message form-group mb-5">
                                                <label class="form-label">Website</label>
                                                <input type="text" class="form-control" name="website_url" value="{{ $vendor->website_url }}" placeholder="Enter your website">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="js-form-message form-group mb-5">
                                                <label class="form-label">Password<span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" name="password" placeholder="Change the password">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="js-form-message form-group mb-5">
                                                <label class="form-label">Password Confirmation<span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" name="password_confirmation" placeholder="Confirm your password">
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="mb-6">
                                                <button type="submit" class="btn btn-primary-dark-w px-5 text-white mr-2"> <i class="fas fa-save"></i> Save Change</button>
                                            </div>
                                        </div>

                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="Jpills-two-example1" role="tabpanel" aria-labelledby="Jpills-two-example1-tab">
                            <ul class="row list-unstyled products-group no-gutters">
                                @foreach($vendorProducts as $product)
                                <li class="col-6 col-md-3 col-wd-2gdot4 product-item">
                                    <div class="product-item__outer h-100">
                                        <div class="product-item__inner px-xl-2 p-3">
                                            <div class="product-item__body pb-xl-2">
                                                <div class="mb-2"><a href="#" class="font-size-12 text-gray-5">{{ $product->subCategory->category->name }}</a></div>
                                                <h5 class="mb-1 product-item__title"><a href="#" class="text-blue font-weight-bold">{{ $product->name }}</a></h5>
                                                <div class="mb-2">
                                                    <a href="#" class="d-block text-center"><img class="img-fluid" src="{{ $product->getFirstMediaUrl(PRODUCT_PATH) }}" alt="{{ $product->getFirstMediaUrl(PRODUCT_PATH)->image_alt ?? '' }}"></a>
                                                </div>
                                                <div class="mb-3">
                                                    <a class="d-inline-flex align-items-center small font-size-14" href="#">
                                                        <div class="text-warning mr-2">
                                                            @for($i = 1; $i <= 5; $i++)
                                                                @if($i <= $product->rate)
                                                                    <small class="fas fa-star"></small>
                                                                @else
                                                                    <small class="far fa-star text-muted"></small>
                                                                @endif
                                                            @endfor
                                                        </div>
                                                        @if($product->views > 0)
                                                            <span class="text-secondary">({{ $product->views }})</span>
                                                        @endif
                                                    </a>
                                                </div>
                                                <div class="font-size-12 p-0 text-gray-110 mb-4">
                                                    <p class="mb-1">{{ Str::limit($product->short_desc, 100, '...') }}</p>
                                                </div>
                                                <div class="text-gray-20 mb-2 font-size-12">{{ __('SKU:') . ' ' .$product->SKU }}</div>
                                                <div class="flex-center-between mb-1">
                                                    <div class="prodcut-price">
                                                        <div class="text-gray-100">{{ getCurrency('code') .' '. $product->price }}</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                @endforeach
                            </ul>
                            {{ $vendorProducts->links() }}
                        </div>
                        <div class="tab-pane fade" id="Jpills-three-example1" role="tabpanel" aria-labelledby="Jpills-three-example1-tab">
                            <div class="container">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="border-bottom border-color-1 mb-5">
                                            <h3 class="section-title mb-0 pb-2 font-size-25"> Riyadh Branch </h3>
                                        </div>
                                    </div>
                                    <div class="col-md-8 col-xl-8">
                                        <div class="map_branches">
                                            <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d27645.74309987584!2d31.273779199999996!3d29.987536599999995!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e0!3m2!1sen!2seg!4v1612086102122!5m2!1sen!2seg" width="100%" height="250" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-xl-4">
                                        <h5 class="font-size-14 font-weight-bold mb-3">Main Information</h5>
                                        <div class="">
                                            <ul class="list-unstyled-branches mb-6">
                                                <li class="row">
                                                    <div class="col-md-2">
                                                        <i class="fas fa-phone"></i>
                                                    </div>
                                                    <div class="col-md-10 mt-2">
                                                        <b>Phone:</b>
                                                        <span class=""> 009665245241 </span>
                                                    </div>
                                                </li>
                                                <li class="row">
                                                    <div class="col-md-2">
                                                        <i class="fas fa-fax"></i>
                                                    </div>
                                                    <div class="col-md-10 mt-2">
                                                        <b>Fax:</b>
                                                        <span class=""> 00965621542 </span>
                                                    </div>
                                                </li>
                                                <li class="row">
                                                    <div class="col-md-2">
                                                        <i class="fas fa-globe-americas"></i>
                                                    </div>
                                                    <div class="col-md-10 mt-2">
                                                        <b>WebSite:</b>
                                                        <span class=""> www.seoera.net </span>
                                                    </div>
                                                </li>
                                                <li class="row">
                                                    <div class="col-md-2">
                                                        <i class="fas fa-map-marker-alt"></i>
                                                    </div>
                                                    <div class="col-md-10 mt-2">
                                                        <b>Adress:</b>
                                                        <span class=""> 121 King Street, Melbourne VIC 3000, Australia </span>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="border-bottom border-color-1 mb-5">
                                            <h3 class="section-title mb-0 pb-2 font-size-25"> Riyadh Jeddah </h3>
                                        </div>
                                    </div>
                                    <div class="col-md-8 col-xl-8">
                                        <div class="map_branches">
                                            <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d27645.74309987584!2d31.273779199999996!3d29.987536599999995!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e0!3m2!1sen!2seg!4v1612086102122!5m2!1sen!2seg" width="100%" height="250" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-xl-4">
                                        <h5 class="font-size-14 font-weight-bold mb-3">Main Information</h5>
                                        <div class="">
                                            <ul class="list-unstyled-branches mb-6">
                                                <li class="row">
                                                    <div class="col-md-2">
                                                        <i class="fas fa-phone"></i>
                                                    </div>
                                                    <div class="col-md-10 mt-2">
                                                        <b>Phone:</b>
                                                        <span class=""> 009665245241 </span>
                                                    </div>
                                                </li>
                                                <li class="row">
                                                    <div class="col-md-2">
                                                        <i class="fas fa-fax"></i>
                                                    </div>
                                                    <div class="col-md-10 mt-2">
                                                        <b>Fax:</b>
                                                        <span class=""> 00965621542 </span>
                                                    </div>
                                                </li>
                                                <li class="row">
                                                    <div class="col-md-2">
                                                        <i class="fas fa-globe-americas"></i>
                                                    </div>
                                                    <div class="col-md-10 mt-2">
                                                        <b>WebSite:</b>
                                                        <span class=""> www.seoera.net </span>
                                                    </div>
                                                </li>
                                                <li class="row">
                                                    <div class="col-md-2">
                                                        <i class="fas fa-map-marker-alt"></i>
                                                    </div>
                                                    <div class="col-md-10 mt-2">
                                                        <b>Adress:</b>
                                                        <span class=""> 121 King Street, Melbourne VIC 3000, Australia </span>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="Jpills-four-example1" role="tabpanel" aria-labelledby="Jpills-four-example1-tab">
                            <div class="container">
                                <div class="row">
                                    <table class="table table-bordered">
                                        <thead>
                                        <tr>
                                            <th scope="col">order_id</th>
                                            <th scope="col">User</th>
                                            <th scope="col">Date</th>
                                            <th scope="col">Name</th>
                                            <th scope="col">Total Price</th>
                                            <th scope="col" class="text-center">Order Details</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <th scope="row">ORD-5FFF610CC554C</th>
                                            <td>Nour</td>
                                            <td>Thursday, January 14, 2021 2:03 AM</td>
                                            <td>Nour Tarek</td>
                                            <td>SAR 20.65</td>
                                            <td class="text-center"><a href="#" data-toggle="modal" data-target="#exampleModal"> View <i class="far fa-eye"></i></a></td>
                                        </tr>


                                        </tbody>
                                    </table>
                                </div>
                                <!-- Modal -->
                                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Order Details: ORD-5FFF610CC554C</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="row">
                                                    <div class="col-md-12 col-xl-12">
                                                        <div class="">
                                                            <ul class="list-unstyled-branches list_order_vendor mb-6">
                                                                <li class="row">
                                                                    <div class="col-md-4">
                                                                        <b>ID:</b>
                                                                    </div>
                                                                    <div class="col-md-8">
                                                                        <span class=""> 2541 </span>
                                                                    </div>
                                                                </li>
                                                                <li class="row">
                                                                    <div class="col-md-4">
                                                                        <b>order_id:</b>
                                                                    </div>
                                                                    <div class="col-md-8">
                                                                        <span class=""> ORD-5FFF610CC554C </span>
                                                                    </div>
                                                                </li>
                                                                <li class="row">
                                                                    <div class="col-md-4">
                                                                        <b>Date:</b>
                                                                    </div>
                                                                    <div class="col-md-8">
                                                                        <span class="">  Thursday, January 14, 2021 2:03 AM </span>
                                                                    </div>
                                                                </li>
                                                                <li class="row">
                                                                    <div class="col-md-4">
                                                                        <b>User:</b>
                                                                    </div>
                                                                    <div class="col-md-8">
                                                                        <span class=""> Nour </span>
                                                                    </div>
                                                                </li>
                                                                <li class="row">
                                                                    <div class="col-md-4">
                                                                        <b>Name:</b>
                                                                    </div>
                                                                    <div class="col-md-8">
                                                                        <span class=""> Nour Tarek </span>
                                                                    </div>
                                                                </li>
                                                                <li class="row">
                                                                    <div class="col-md-4">
                                                                        <b>Email:</b>
                                                                    </div>
                                                                    <div class="col-md-8">
                                                                        <span class=""> nour@gmail.com </span>
                                                                    </div>
                                                                </li>
                                                                <li class="row">
                                                                    <div class="col-md-4">
                                                                        <b>Phone:</b>
                                                                    </div>
                                                                    <div class="col-md-8">
                                                                        <span class=""> 01064323735 </span>
                                                                    </div>
                                                                </li>
                                                                <li class="row">
                                                                    <div class="col-md-4">
                                                                        <b>Address:</b>
                                                                    </div>
                                                                    <div class="col-md-8">
                                                                        <span class=""> 121 King Street, Melbourne VIC 3000, Australia </span>
                                                                    </div>
                                                                </li>
                                                                <li class="row">
                                                                    <div class="col-md-4">
                                                                        <b>Building Number:</b>
                                                                    </div>
                                                                    <div class="col-md-8">
                                                                        <span class=""> 2544651321 </span>
                                                                    </div>
                                                                </li>
                                                                <li class="row">
                                                                    <div class="col-md-4">
                                                                        <b>Street:</b>
                                                                    </div>
                                                                    <div class="col-md-8">
                                                                        <span class=""> King Street </span>
                                                                    </div>
                                                                </li>
                                                                <li class="row">
                                                                    <div class="col-md-4">
                                                                        <b>District:</b>
                                                                    </div>
                                                                    <div class="col-md-8">
                                                                        <span class=""> — </span>
                                                                    </div>
                                                                </li>
                                                                <li class="row">
                                                                    <div class="col-md-4">
                                                                        <b>City:</b>
                                                                    </div>
                                                                    <div class="col-md-8">
                                                                        <span class=""> Cairo </span>
                                                                    </div>
                                                                </li>
                                                                <li class="row">
                                                                    <div class="col-md-4">
                                                                        <b>Payment Status:</b>
                                                                    </div>
                                                                    <div class="col-md-8">
                                                                        <select class="form-control">
                                                                            <option value="one" selected>Pending</option>
                                                                            <option value="two">Pending</option>
                                                                            <option value="three">Pending</option>
                                                                        </select>
                                                                    </div>
                                                                </li>
                                                                <li class="row">
                                                                    <div class="col-md-4">
                                                                        <b>Order Status:</b>
                                                                    </div>
                                                                    <div class="col-md-8">
                                                                        <select class="form-control">
                                                                            <option value="one" selected>Pending</option>
                                                                            <option value="two">Pending</option>
                                                                            <option value="three">Pending</option>
                                                                        </select>
                                                                    </div>
                                                                </li>
                                                                <li class="row">
                                                                    <div class="col-md-4">
                                                                        <b>Notes:</b>
                                                                    </div>
                                                                    <div class="col-md-8">
                                                                        <span class=""> Building No 6249- Hamzah Ibn Abdul Muttalib, Dhahrat Al Badi'ah , Riyadh </span>
                                                                    </div>
                                                                </li>
                                                                <li class="row">
                                                                    <div class="col-md-4">
                                                                        <b>Refused Notes:</b>
                                                                    </div>
                                                                    <div class="col-md-8">
                                                                        <textarea class="form-control" id="" rows="3" placeholder="Building No 6249- Hamzah Ibn Abdul Muttalib, Dhahrat Al Badi'ah , Riyadh "></textarea>
                                                                    </div>
                                                                </li>
                                                                <li class="row">
                                                                    <div class="col-md-4">
                                                                        <b>Total Price:</b>
                                                                    </div>
                                                                    <div class="col-md-8">
                                                                        <span class=""> SAR 20.65 </span>
                                                                    </div>
                                                                </li>
                                                                <li class="row mt-5">
                                                                    <div class="col-md-4">
                                                                        <b>Payment Method:</b>
                                                                    </div>
                                                                    <div class="col-md-8">
                                                                        <select class="form-control">
                                                                            <option value="one" selected>CASH</option>
                                                                            <option value="two">VISA</option>
                                                                            <option value="three">FAWRY</option>
                                                                        </select>
                                                                    </div>
                                                                </li>
                                                                <div class="col-md-12">
                                                                    <button type="submit" class="btn btn-primary-dark-w px-5 text-white mr-2"> <i class="fas fa-paper-plane"></i> Submit </button>
                                                                </div>
                                                            </ul>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
