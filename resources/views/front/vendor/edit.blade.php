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
                        <li class="breadcrumb-item flex-shrink-0 flex-xl-shrink-1"><a href="{{ route('home') }}">{{ __('Home') }}</a></li>
                        <li class="breadcrumb-item flex-shrink-0 flex-xl-shrink-1 active" aria-current="page">{{ __('Vendor Profile') }}</li>
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
                    <img src="{{ $vendor->getFirstMediaUrlOrDefault(VENDOR_COVER)['url'] }}" class="photo_cover_vendor">
                </div>
                <img src="{{ $vendor->getFirstMediaUrlOrDefault(VENDOR_LOGO)['url'] }}" class="photo_profile_vendor">
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
                        @if(!$vendor->active)
                            <div class="alert alert-warning">{{ __('Your account is not active yet. Please contact the administrators of this site.') }}</div>
                        @endif
                        <div class="tab-pane fade active show" id="Jpills-one-example1" role="tabpanel" aria-labelledby="Jpills-one-example1-tab">
                            <div class="block_info_vendor">
                                @if(Session::has('message'))<div class="alert alert-success">{{ Session::get('message') }}</div>@endif
                                <form method="POST" action="{{ route('vendor.update', ['vendor' => $vendor->id]) }}" enctype="multipart/form-data">
                                    @csrf
                                    @method('PATCH')
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="box_img_v">
                                                <img src="{{ $vendor->getFirstMediaUrlOrDefault(VENDOR_COVER)['url'] }}" class="photo_cover_vendor">
                                            </div>
                                        </div>
                                        <div class="col-md-3 ml-auto">
                                            <div class="box_img_profile">
                                                <img src="{{ $vendor->getFirstMediaUrlOrDefault(VENDOR_LOGO)['url'] }}" class="photo_cover_vendor">
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="js-form-message form-group mb-5">
                                                <label class="form-label"> Image Cover <span class="text-danger">*</span></label>
                                                <div class="box">
                                                    <input type="file" name="cover" id="file-7" class="inputfile inputfile-6" data-multiple-caption="{count} files selected" />
                                                    <label for="file-7">
                                                        <span></span>
                                                        <strong>Choose a file&hellip;</strong>
                                                    </label>
                                                </div>
                                                @error('cover')
                                                <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="js-form-message form-group mb-5">
                                                <label class="form-label"> Image Profile <span class="text-danger">*</span></label>
                                                <div class="box">
                                                    <input type="file" name="logo" id="file-8" class="inputfile inputfile-6" data-multiple-caption="{count} files selected" />
                                                    <label for="file-8">
                                                        <span></span>
                                                        <strong>Choose a file&hellip;</strong>
                                                    </label>
                                                </div>
                                                @error('logo')
                                                <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="js-form-message form-group mb-5">
                                                <label class="form-label">Full Name<span class="text-danger"> (English)*</span></label>
                                                <input type="text" class="form-control" name="name_en" value="{{ $vendor->getTranslation('name','en') }}" placeholder="Enter your name in english" required="">
                                                @error('name_en')
                                                <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="js-form-message form-group mb-5">
                                                <label class="form-label">Full Name<span class="text-danger">(Arabic)*</span></label>
                                                <input type="text" class="form-control" name="name_ar" value="{{ $vendor->getTranslation('name','ar') }}" placeholder="Enter your name in arabic" required="">
                                                @error('name_ar')
                                                <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="js-form-message form-group mb-5">
                                                <label class="form-label">E-Mail<span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" name="email" value="{{ $vendor->email }}" placeholder="Enter your email" required="">
                                                @error('email')
                                                <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="js-form-message form-group mb-5">
                                                <label class="form-label">Phone Number </label>
                                                <input type="text" class="form-control" name="phone" value="{{ $vendor->phone }}" placeholder="Enter your phone">
                                                @error('phone')
                                                <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="js-form-message form-group mb-5">
                                                <label class="form-label">Phone Number 2 </label>
                                                <input type="text" class="form-control" name="phone2" value="{{ $vendor->phone2 }}" placeholder="Enter your second phone">
                                                @error('phone2')
                                                <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="js-form-message form-group mb-5">
                                                <label class="form-label">WhatsApp</label>
                                                <input type="text" class="form-control" name="whatsapp_phone" value="{{ $vendor->whatsapp_phone }}" placeholder="Enter WhatsApp phone">
                                                @error('whatsapp_phone')
                                                <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="js-form-message form-group mb-5">
                                                <label class="form-label">Address</label>
                                                <input type="text" class="form-control" name="address" value="{{ $vendor->address }}" placeholder="Enter your address">
                                                @error('address')
                                                <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="js-form-message form-group mb-5">
                                                <label class="form-label">Address 2</label>
                                                <input type="text" class="form-control" name="address2" value="{{ $vendor->address2 }}" placeholder="Enter your second address">
                                                @error('address2')
                                                <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="js-form-message form-group mb-5">
                                                <label class="form-label">Facebook</label>
                                                <input type="text" class="form-control" name="facebook_url" value="{{ $vendor->facebook_url }}" placeholder="Enter your facebook">
                                                @error('facebook_url')
                                                <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="js-form-message form-group mb-5">
                                                <label class="form-label">Twitter</label>
                                                <input type="text" class="form-control" name="twitter_url" value="{{ $vendor->twitter_url }}" placeholder="Enter your twitter">
                                                @error('twitter_url')
                                                <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="js-form-message form-group mb-5">
                                                <label class="form-label">Youtube</label>
                                                <input type="text" class="form-control" name="youtube_url" value="{{ $vendor->youtube_url }}" placeholder="Enter your youtube">
                                                @error('youtube_url')
                                                <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="js-form-message form-group mb-5">
                                                <label class="form-label">Instagram</label>
                                                <input type="text" class="form-control" name="instagram_url" value="{{ $vendor->instagram_url }}" placeholder="Enter your instagram">
                                                @error('instagram_url')
                                                <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="js-form-message form-group mb-5">
                                                <label class="form-label">Pinterest</label>
                                                <input type="text" class="form-control" name="pinterest_url" value="{{ $vendor->pinterest_url }}" placeholder="Enter your pinterest">
                                                @error('pinterest_url')
                                                <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="js-form-message form-group mb-5">
                                                <label class="form-label">Website</label>
                                                <input type="text" class="form-control" name="website_url" value="{{ $vendor->website_url }}" placeholder="Enter your website">
                                                @error('website_url')
                                                <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="js-form-message form-group mb-5">
                                                <label class="form-label">Password<span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" name="password" placeholder="Change the password">
                                                @error('password')
                                                <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="js-form-message form-group mb-5">
                                                <label class="form-label">Password Confirmation<span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" name="password_confirmation" placeholder="Confirm your password">
                                                @error('password_confirmation')
                                                <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
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
                            @if($vendor->active)
                                <a href="{{ route('vendor.addProduct', ['vendor' => $vendor]) }}" class="btn btn-primary-dark-w px-5 text-white mr-2">
                                    {{ __('Add Product') }}
                                </a>
                            @endif
                            @if(count($products) > 0)
                                <ul class="row list-unstyled products-group no-gutters">
                                    @foreach($products as $product)
                                    <li class="col-6 col-md-3 col-wd-2gdot4 product-item">
                                        <div class="product-item__outer h-100">
                                            <div class="product-item__inner px-xl-2 p-3">
                                                <div class="product-item__body pb-xl-2">
                                                    <div class="mb-2"><a href="{{ route('front.category', ['category_slug' => $product->subCategory->category->slug]) }}" class="font-size-12 text-gray-5">{{ $product->subCategory->category->name }}</a></div>
                                                    <h5 class="mb-1 product-item__title"><a href="{{ route('front.product', ['slug' => $product->slug]) }}" class="text-blue font-weight-bold">{{ $product->name }}</a></h5>
                                                    <div class="mb-2">
                                                        <a href="{{ route('front.product', ['slug' => $product->slug]) }}" class="d-block text-center"><img class="img-fluid" src="{{ $product->getFirstMediaUrlOrDefault(PRODUCT_PATH)['url'] }}" alt="{{ $product->getFirstMediaUrlOrDefault(PRODUCT_PATH)['alt'] }}"></a>
                                                    </div>
                                                    <div class="mb-3">
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
                                                    </div>
                                                    <div class="font-size-12 p-0 text-gray-110 mb-4">
                                                        {!! Str::limit($product->short_desc, 100, '...') !!}
                                                    </div>
                                                    <div class="text-gray-20 mb-2 font-size-12">{{ __('SKU:') . ' ' .$product->SKU }}</div>
                                                    @if($product->type === 'product')
                                                        <div class="flex-center-between mb-1">
                                                            <div class="prodcut-price">
                                                                <div class="text-gray-100">{{ getCurrency('code') .' '. $product->price }}</div>
                                                            </div>
                                                        </div>
                                                    @endif
                                                    @if($vendor->active)
                                                        <a href="{{ route('vendor.editProduct', ['vendor' => $vendor, 'product' => $product]) }}" class="btn btn-primary-dark-w px-5 text-white mr-2">
                                                            {{ __('Edit Product') }}
                                                        </a>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    @endforeach
                                </ul>
                            {{ $products->links() }}
                            @else
                                <h4>{{ __('You do not have products') }}</h4>
                            @endif
                        </div>
                        <div class="tab-pane fade" id="Jpills-three-example1" role="tabpanel" aria-labelledby="Jpills-three-example1-tab">
                            <div class="container">
                                @if($vendor->active)
                                <!-- Button trigger modal -->
                                <button type="button" class="btn btn-primary-dark-w px-5 text-white mr-2" data-toggle="modal" data-target="#branchModal">
                                    {{ __('Add Branch') }}
                                </button>
                                <!-- Modal -->
                                <div class="modal fade" id="branchModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">{{ __('Add Branch') }}</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{ route('vendor.addBranch', ['vendor' => $vendor->id]) }}" method="POST" id="addBranchForm">
                                                @csrf
                                                <div class="row">

                                                <div class="col-md-6">
                                                    <div class="js-form-message form-group mb-5">
                                                        <label for="name" class="form-label">{{ __('Name') }} <span class="text-danger">*</span></label>
                                                        <input type="text" class="form-control" id="name" name="name" required autocomplete="name" autofocus>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="js-form-message form-group mb-5">
                                                        <label for="phone_number" class="form-label">{{ __('Phone') }} <span class="text-danger">*</span></label>
                                                        <input type="text" class="form-control" id="phone_number" name="phone_number" required autocomplete="phone_number" autofocus>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="js-form-message form-group mb-5">
                                                        <label for="fax" class="form-label">{{ __('Fax') }}</label>
                                                        <input type="text" class="form-control" id="fax" name="fax" autocomplete="fax" autofocus>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="js-form-message form-group mb-5">
                                                        <label for="website" class="form-label">{{ __('Website') }}</label>
                                                        <input type="text" class="form-control" id="website" name="website" autocomplete="website" autofocus>
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="js-form-message form-group mb-5">
                                                        <label for="address" class="form-label">{{ __('Address') }} <span class="text-danger">*</span></label>
                                                        <input type="text" class="form-control" id="address" name="address" required autocomplete="address" autofocus>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="js-form-message form-group mb-5">
                                                        <label for="latitude" class="form-label">{{ __('Latitude') }} <span class="text-danger">*</span></label>
                                                        <input type="text" class="form-control" id="latitude" name="latitude" required autocomplete="latitude" autofocus>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="js-form-message form-group mb-5">
                                                        <label for="longitude" class="form-label">{{ __('Longitude') }} <span class="text-danger">*</span></label>
                                                        <input type="text" class="form-control" id="longitude" name="longitude" required autocomplete="longitude" autofocus>
                                                    </div>
                                                </div>
                                                </div>
                                                <button id="addBranchBtn" class="btn btn-primary-dark-w px-5 text-white">{{ __('Save') }}</button>
                                            </form>
                                        </div>
                                        </div>
                                    </div>
                                </div>
                                @endif
                                @if(count($branches) > 0)
                                    @foreach($branches as $branch)
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="border-bottom border-color-1 mb-5">
                                                <h3 class="section-title mb-0 pb-2 font-size-25"> {{ $branch->name }} </h3>
                                            </div>
                                        </div>
                                        <div class="col-md-8 col-xl-8">
                                            <div class="map_branches">
                                                <iframe src="https://maps.google.com/maps?q={{ $branch->latitude }},{{ $branch->longitude }}&hl=es&z=14&amp;output=embed" width="100%" height="250" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-xl-4">
                                            <h5 class="font-size-14 font-weight-bold mb-3">{{ __('Main Information') }}</h5>
                                            <div class="">
                                                <ul class="list-unstyled-branches mb-6">
                                                    <li class="row">
                                                        <div class="col-md-2">
                                                            <i class="fas fa-phone"></i>
                                                        </div>
                                                        <div class="col-md-10 mt-2">
                                                            <b>{{ __('Phone') }}:</b>
                                                            <span class=""> {{ $branch->phone_number }} </span>
                                                        </div>
                                                    </li>
                                                    @if($branch->fax)
                                                        <li class="row">
                                                            <div class="col-md-2">
                                                                <i class="fas fa-fax"></i>
                                                            </div>
                                                            <div class="col-md-10 mt-2">
                                                                <b>{{ __('Fax') }}:</b>
                                                                <span class=""> {{ $branch->fax }} </span>
                                                            </div>
                                                        </li>
                                                    @endif
                                                    @if($branch->website)
                                                    <li class="row">
                                                        <div class="col-md-2">
                                                            <i class="fas fa-globe-americas"></i>
                                                        </div>
                                                        <div class="col-md-10 mt-2">
                                                            <b>{{ __('Website') }}:</b>
                                                            <span class=""> {{ $branch->website }} </span>
                                                        </div>
                                                    </li>
                                                    @endif
                                                    <li class="row">
                                                        <div class="col-md-2">
                                                            <i class="fas fa-map-marker-alt"></i>
                                                        </div>
                                                        <div class="col-md-10 mt-2">
                                                            <b>{{ __('Address') }}:</b>
                                                            <span class=""> {{ $branch->address }} </span>
                                                        </div>
                                                    </li>
                                                    <li class="row">
                                                        <a class="btn btn-primary btn-block" href="{{ route('vendor.deleteBranch', ['branch' => $branch]) }}"
                                                           onclick="event.preventDefault();
                                                            document.getElementById('delete-branch-{{ $branch->id }}').submit();">
                                                            {{ __('Delete') }}
                                                        </a>

                                                        <form id="delete-branch-{{ $branch->id }}" action="{{ route('vendor.deleteBranch', ['branch' => $branch]) }}" method="POST" style="display: none;">
                                                            @csrf
                                                            @method('DELETE')
                                                        </form>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                    {{ $branches->links() }}
                                @else
                                    <h4>{{ __('You do not have any branches') }}</h4>
                                @endif
                            </div>
                        </div>
                        <div class="tab-pane fade" id="Jpills-four-example1" role="tabpanel" aria-labelledby="Jpills-four-example1-tab">
                            <div class="container">
                                @if(count($items) > 0)
                                <div class="row">
                                    <table class="table table-bordered">
                                        <thead>
                                        <tr>
                                            <th scope="col">{{ __('ID') }}</th>
                                            <th scope="col">{{ __('Name') }}</th>
                                            <th scope="col">{{ __('Price') }}</th>
                                            <th scope="col">{{ __('Order Status') }}</th>
                                            <th scope="col">{{ __('Payment Status') }}</th>
                                            <th scope="col">{{ __('Date') }}</th>
                                            <th scope="col" class="text-center">{{ __('Order Details') }}</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($items as $item)
                                            <tr>
                                                <th scope="row">{{ $item->order->order_id }}</th>
                                                <td>{{ $item->order->name }}</td>
                                                <td>{{ $item->price }}</td>
                                                <td>{{ $item->status }}</td>
                                                <td>{{ $item->payment_status }}</td>
                                                <td>{{ $item->order->created_at }}</td>
                                                <td class="text-center"><a class="toggleModal" data-url="{{ route('order.get', ['order' => $item->id]) }}" href="#" data-toggle="modal" data-target="#exampleModal"> View <i class="far fa-eye"></i></a></td>
                                            </tr>
                                        @endforeach


                                        </tbody>
                                    </table>
                                </div>
                                <!-- Modal -->
                                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Order Details</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="alert alert-danger d-none">{{ __('Could not find the order') }}</div>
                                                <div class="row">
                                                    <div class="col-md-12 col-xl-12">
                                                        <form method="POST" action="{{ route('vendor.order.update', ['vendor' => $vendor->id]) }}">
                                                            @csrf
                                                            @method('PATCH')
                                                            <input type="hidden" name="id" id="formOrder" value="" />
                                                            <div class="">
                                                                <ul class="list-unstyled-branches list_order_vendor mb-6">
                                                                    <li class="row">
                                                                        <div class="col-md-4">
                                                                            <b>ID:</b>
                                                                        </div>
                                                                        <div class="col-md-8">
                                                                            <span class="" id="id"></span>
                                                                        </div>
                                                                    </li>
                                                                    <li class="row">
                                                                        <div class="col-md-4">
                                                                            <b>order_id:</b>
                                                                        </div>
                                                                        <div class="col-md-8">
                                                                            <span class="" id="order_id"></span>
                                                                        </div>
                                                                    </li>
                                                                    <li class="row">
                                                                        <div class="col-md-4">
                                                                            <b>Date:</b>
                                                                        </div>
                                                                        <div class="col-md-8">
                                                                            <span class="" id="date"></span>
                                                                        </div>
                                                                    </li>
                                                                    <li class="row">
                                                                        <div class="col-md-4">
                                                                            <b>User:</b>
                                                                        </div>
                                                                        <div class="col-md-8">
                                                                            <span class="" id="user"></span>
                                                                        </div>
                                                                    </li>
                                                                    <li class="row">
                                                                        <div class="col-md-4">
                                                                            <b>Name:</b>
                                                                        </div>
                                                                        <div class="col-md-8">
                                                                            <span class="" id="name"></span>
                                                                        </div>
                                                                    </li>
                                                                    <li class="row">
                                                                        <div class="col-md-4">
                                                                            <b>Email:</b>
                                                                        </div>
                                                                        <div class="col-md-8">
                                                                            <span class="" id="email"></span>
                                                                        </div>
                                                                    </li>
                                                                    <li class="row">
                                                                        <div class="col-md-4">
                                                                            <b>Phone:</b>
                                                                        </div>
                                                                        <div class="col-md-8">
                                                                            <span class="" id="phone"></span>
                                                                        </div>
                                                                    </li>
                                                                    <li class="row">
                                                                        <div class="col-md-4">
                                                                            <b>Address:</b>
                                                                        </div>
                                                                        <div class="col-md-8">
                                                                            <span class="" id="address"></span>
                                                                        </div>
                                                                    </li>
                                                                    <li class="row">
                                                                        <div class="col-md-4">
                                                                            <b>Building Number:</b>
                                                                        </div>
                                                                        <div class="col-md-8">
                                                                            <span class="" id="buildingNo"></span>
                                                                        </div>
                                                                    </li>
                                                                    <li class="row">
                                                                        <div class="col-md-4">
                                                                            <b>Street:</b>
                                                                        </div>
                                                                        <div class="col-md-8">
                                                                            <span class="" id="street"></span>
                                                                        </div>
                                                                    </li>
                                                                    <li class="row">
                                                                        <div class="col-md-4">
                                                                            <b>District:</b>
                                                                        </div>
                                                                        <div class="col-md-8">
                                                                            <span class="" id="district"></span>
                                                                        </div>
                                                                    </li>
                                                                    <li class="row">
                                                                        <div class="col-md-4">
                                                                            <b>City:</b>
                                                                        </div>
                                                                        <div class="col-md-8">
                                                                            <span class="" id="city"></span>
                                                                        </div>
                                                                    </li>
                                                                    <li class="row">
                                                                        <div class="col-md-4">
                                                                            <b>Payment Status:</b>
                                                                        </div>
                                                                        <div class="col-md-8">
                                                                            <select class="form-control" name="payment_status" id="paymentStatus">
                                                                                <option value="pending" selected>Pending</option>
                                                                                <option value="refunded">Refunded</option>
                                                                                <option value="completed">Completed</option>
                                                                            </select>
                                                                            @error('payment_status')
                                                                                <span class="invalid-feedback" role="alert">
                                                                                    <strong>{{ $message }}</strong>
                                                                                </span>
                                                                            @enderror
                                                                        </div>
                                                                    </li>
                                                                    <li class="row">
                                                                        <div class="col-md-4">
                                                                            <b>Order Status:</b>
                                                                        </div>
                                                                        <div class="col-md-8">
                                                                            <select class="form-control" name="status" id="orderStatus">
                                                                                <option value="pending" selected>Pending</option>
                                                                                <option value="shipping">Shipping</option>
                                                                                <option value="completed">Completed</option>
                                                                                <option value="refused">Refused</option>
                                                                            </select>
                                                                            @error('status')
                                                                            <span class="invalid-feedback" role="alert">
                                                                                    <strong>{{ $message }}</strong>
                                                                                </span>
                                                                            @enderror
                                                                        </div>
                                                                    </li>
                                                                    <li class="row">
                                                                        <div class="col-md-4">
                                                                            <b>Notes:</b>
                                                                        </div>
                                                                        <div class="col-md-8">
                                                                            <span class="" id="notes"></span>
                                                                        </div>
                                                                    </li>
                                                                    <li class="row">
                                                                        <div class="col-md-4">
                                                                            <b>Refused Notes:</b>
                                                                        </div>
                                                                        <div class="col-md-8">
                                                                            <textarea class="form-control" name="refused_note" id="refusedNotes" rows="3"></textarea>
                                                                            @error('refused_notes')
                                                                            <span class="invalid-feedback" role="alert">
                                                                                    <strong>{{ $message }}</strong>
                                                                                </span>
                                                                            @enderror
                                                                        </div>
                                                                    </li>
                                                                    <li class="row">
                                                                        <div class="col-md-4">
                                                                            <b>Total Price:</b>
                                                                        </div>
                                                                        <div class="col-md-8">
                                                                            <span class="" id="total"></span>
                                                                        </div>
                                                                    </li>
                                                                    <li class="row mt-5">
                                                                        <div class="col-md-4">
                                                                            <b>Payment Method:</b>
                                                                        </div>
                                                                        <div class="col-md-8">
                                                                            <span id="paymentMethod"></span>
                                                                        </div>
                                                                    </li>
                                                                    <div class="col-md-12">
                                                                        <button type="submit" class="btn btn-primary-dark-w px-5 text-white mr-2"> <i class="fas fa-paper-plane"></i>
                                                                            {{ __('Submit') }} </button>
                                                                    </div>
                                                                </ul>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @else
                                    <h4>{{ __('You do not have any orders') }}</h4>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('extraScripts')
    <script type="text/javascript">
        $('#addBranchBtn').on('click', function(e) {
            e.preventDefault();

            $.ajax({
                url: "{{ route('vendor.addBranch', ['vendor' => $vendor->id]) }}",
                type: 'POST',
                data: $("#addBranchForm").serialize()
            })
            .done(function(response) {
                if(response.status) {
                    toastr.success(response.message);
                    window.location.reload();
                } else
                    toastr.warning(response.message);
            })
            .fail(function(response) {
                toastr.error(response.responseJSON.message);
                let errors = response.responseJSON.errors;

                $.each(errors, function(key, value) {
                    toastr.error(value, key);
                })
            })
        });

        $(".toggleModal").on('click', function() {
            //Reset the fields
            $("#id").html('');
            $("#formOrder").val();
            $("#order_id").html('');
            $("#date").html('');
            $("#user").html('');
            $("#name").html('');
            $("#email").html('');
            $("#phone").html('');
            $("#address").html('');
            $("#buildingNo").html('');
            $("#street").html('');
            $("#district").html('');
            $("#city").html('');
            $("#notes").html('');
            $("#total").html('');
            $("#refusedNotes").html('');
            $("#paymentMethod").html('');

            //Get the URL
            let url = $(this).data('url');

            //Create the request
            $.ajax({
                url: url,
                type: 'GET'
            })
            .done(function(response) {
                console.log(response.order);
                $('.alert-danger').addClass('d-none');
                $("#id").html(response.order.id);
                $("#formOrder").val(response.item.id);
                $("#order_id").html(response.order.order_id);
                $("#date").html(response.item.created_at);
                $("#user").html(response.order.name);
                $("#name").html(response.order.name);
                $("#email").html(response.order.email);
                $("#phone").html(response.order.phone);
                $("#address").html(response.order.address);
                $("#buildingNo").html(response.order.building_number);
                $("#street").html(response.order.street);
                $("#district").html(response.order.distract);
                $("#notes").html(response.order.notes);
                $("#city").html(response.order.city);
                $("#refusedNotes").html(response.item.refused_note);
                $("#total").html(response.item.price);
                $("#paymentMethod").html(response.order.payment_method);
                $("#orderStatus").val(response.item.status);
                $("#paymentStatus").val(response.item.payment_status);
            })
            .fail(function() {
                $('.alert-danger').removeClass('d-none');
            });
        });
    </script>
@endsection
