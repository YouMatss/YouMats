@extends('front.layouts.master')
@section('metaTags')
    <title>YouMats | Checkout</title>
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
    <div class="container">
        <div class="mb-5">
            <h1 class="text-center">{{ __('Checkout') }}</h1>
        </div>
        @if(!Auth::guard('web')->check())
            <!-- Accordion -->
            <div id="shopCartAccordion" class="accordion rounded mb-5">
                <!-- Card -->
                <div class="card border-0">
                    <div id="shopCartHeadingOne" class="alert alert-primary mb-0" role="alert">
                        {{ __('Returning customer?') }} <a href="#" class="alert-link collapsed" data-toggle="collapse" data-target="#shopCartOne" aria-expanded="false" aria-controls="shopCartOne">Click here to login</a>
                    </div>
                    <div id="shopCartOne" class="border border-top-0 collapse" aria-labelledby="shopCartHeadingOne" data-parent="#shopCartAccordion" style="">
                        <!-- Form -->
                        <form class="js-validate p-5" novalidate="novalidate">
                            <!-- Title -->
                            <div class="mb-5">
                                <p class="text-gray-90 mb-2">Welcome back! Sign in to your account.</p>
                                <p class="text-gray-90">If you have shopped with us before, please enter your details below. If you are a new customer, please proceed to the Billing &amp; Shipping section.</p>
                            </div>
                            <!-- End Title -->

                            <div class="row">
                                <div class="col-lg-6">
                                    <!-- Form Group -->
                                    <div class="js-form-message form-group">
                                        <label class="form-label" for="signinSrEmailExample3">Email address</label>
                                        <input type="email" class="form-control" name="email" id="signinSrEmailExample3" placeholder="Email address" aria-label="Email address" required="" data-msg="Please enter a valid email address." data-error-class="u-has-error" data-success-class="u-has-success">
                                    </div>
                                    <!-- End Form Group -->
                                </div>
                                <div class="col-lg-6">
                                    <!-- Form Group -->
                                    <div class="js-form-message form-group">
                                        <label class="form-label" for="signinSrPasswordExample2">Password</label>
                                        <input type="password" class="form-control" name="password" id="signinSrPasswordExample2" placeholder="********" aria-label="********" required="" data-msg="Your password is invalid. Please try again." data-error-class="u-has-error" data-success-class="u-has-success">
                                    </div>
                                    <!-- End Form Group -->
                                </div>
                            </div>

                            <!-- Checkbox -->
                            <div class="js-form-message mb-3">
                                <div class="custom-control custom-checkbox d-flex align-items-center">
                                    <input type="checkbox" class="custom-control-input" id="rememberCheckbox" name="rememberCheckbox" required="" data-error-class="u-has-error" data-success-class="u-has-success">
                                    <label class="custom-control-label form-label" for="rememberCheckbox">
                                        Remember me
                                    </label>
                                </div>
                            </div>
                            <!-- End Checkbox -->

                            <!-- Button -->
                            <div class="mb-1">
                                <div class="mb-3">
                                    <button type="submit" class="btn btn-primary-dark-w px-5">Login</button>
                                </div>
                                <div class="mb-2">
                                    <a class="text-blue" href="#">Lost your password?</a>
                                </div>
                            </div>
                            <!-- End Button -->
                        </form>
                        <!-- End Form -->
                    </div>
                </div>
                <!-- End Card -->
            </div>
            <!-- End Accordion -->
        @endif

        <!-- Accordion -->
        <div id="shopCartAccordion1" class="accordion rounded mb-6">
            <!-- Card -->
            <div class="card border-0">
                <div id="shopCartHeadingTwo" class="alert alert-primary mb-0" role="alert">
                    Have a coupon? <a href="#" class="alert-link" data-toggle="collapse" data-target="#shopCartTwo" aria-expanded="false" aria-controls="shopCartTwo">Click here to enter your code</a>
                </div>
                <div id="shopCartTwo" class="collapse border border-top-0" aria-labelledby="shopCartHeadingTwo" data-parent="#shopCartAccordion1" style="">
                    <form class="js-validate p-5" novalidate="novalidate">
                        <p class="w-100 text-gray-90">If you have a coupon code, please apply it below.</p>
                        <div class="input-group input-group-pill max-width-660-xl">
                            <input type="text" class="form-control" name="name" placeholder="Coupon code" aria-label="Promo code">
                            <div class="input-group-append">
                                <button type="submit" class="btn btn-block btn-dark font-weight-normal btn-pill px-4">
                                    <i class="fas fa-tags d-md-none"></i>
                                    <span class="d-none d-md-inline">Apply coupon</span>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <!-- End Card -->
        </div>
        <!-- End Accordion -->
        <form class="js-validate" novalidate="novalidate" action="{{ route('checkout') }}" method="POST">
            @csrf
            <div class="row">
                <div class="col-lg-5 order-lg-2 mb-7 mb-lg-0">
                    <div class="pl-lg-3 ">
                        <div class="bg-gray-1 rounded-lg">
                            <!-- Order Summary -->
                            <div class="p-4 mb-4 checkout-table">
                                <!-- Title -->
                                <div class="border-bottom border-color-1 mb-5">
                                    <h3 class="section-title mb-0 pb-2 font-size-25">Your order</h3>
                                </div>
                                <!-- End Title -->

                                <!-- Product Content -->
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th class="product-name">Product</th>
                                        <th class="product-total">Total</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($cartItems as $item)
                                            <tr class="cart_item">
                                                <td>{{ $item->name }}</td>
                                                <td>{{ $item->price }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                    <tfoot>
                                    <tr>
                                        <th>Subtotal</th>
                                        <td>{{ getCurrency('code') . ' ' . Cart::subtotal() }}</td>
                                    </tr>
                                    <tr>
                                        <th>Tax</th>
                                        <td>{{ getCurrency('code') . ' ' . Cart::tax() }}</td>
                                    </tr>
                                    <tr>
                                        <th>Total</th>
                                        <td><strong>{{ getCurrency('code') . ' ' . Cart::total() }}</strong></td>
                                    </tr>
                                    </tfoot>
                                </table>
                                <!-- End Product Content -->
                                <div class="border-top border-width-3 border-color-1 pt-3 mb-3">
                                    <!-- Basics Accordion -->
                                    <div id="basicsAccordion1">

                                        @foreach($paymentGateways as $gateway)
                                            <!-- Card -->
                                            <div class="border-bottom border-color-1 border-dotted-bottom">
                                                <div class="p-3" id="basicsHeadingOne">
                                                    <div class="custom-control custom-radio">
                                                        <input type="radio" class="custom-control-input" name="payment_method" value="{{ $gateway->name }}" checked="">
                                                        <label class="custom-control-label form-label collapsed" for="stylishRadio1" data-toggle="collapse" data-target="#basicsCollapseOnee" aria-expanded="false" aria-controls="basicsCollapseOnee">
                                                            {{ $gateway->name }}
                                                        </label>
                                                    </div>
                                                </div>
                                                <div id="basicsCollapseOnee" class="border-top border-color-1 border-dotted-top bg-dark-lighter collapse" aria-labelledby="basicsHeadingOne" data-parent="#basicsAccordion1" style="">
                                                    <div class="p-4">
                                                        {!! $gateway->description !!}
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- End Card -->
                                        @endforeach

                                    </div>
                                    <!-- End Basics Accordion -->
                                </div>
                                <div class="form-group d-flex align-items-center justify-content-between px-3 mb-5">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="agree" value="true" id="defaultCheck10" required="" data-msg="Please agree terms and conditions." data-error-class="u-has-error" data-success-class="u-has-success">
                                        <label class="form-check-label form-label" for="defaultCheck10">
                                            I have read and agree to the website <a href="#" class="text-blue">terms and conditions </a>
                                            <span class="text-danger">*</span>
                                        </label>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary-dark-w btn-block btn-pill font-size-20 mb-3 py-3">Place order</button>
                            </div>
                            <!-- End Order Summary -->
                        </div>
                    </div>
                </div>

                <div class="col-lg-7 order-lg-1">
                    <div class="pb-7 mb-7">
                        <!-- Title -->
                        <div class="border-bottom border-color-1 mb-5">
                            <h3 class="section-title mb-0 pb-2 font-size-25">Billing details</h3>
                        </div>
                        <!-- End Title -->

                        <!-- Billing Form -->
                        <div class="row">
                                <div class="col-md-6">
                                    <!-- Input -->
                                    <div class="js-form-message mb-6">
                                        <label class="form-label">
                                            Name
                                            <span class="text-danger">*</span>
                                        </label>
                                        <input type="text" class="form-control" value="{{ Auth::guard('web')->user()->name ?? old('name') }}" name="name" placeholder="Jack" aria-label="Jack" required="" data-msg="Please enter your frist name." data-error-class="u-has-error" data-success-class="u-has-success" autocomplete="off">
                                    </div>
                                    <!-- End Input -->
                                </div>

                                <div class="col-md-6">
                                    <!-- Input -->
                                    <div class="js-form-message mb-6">
                                        <label class="form-label">
                                            Phone
                                        </label>
                                        <input type="text" class="form-control" value="{{ Auth::guard('web')->user()->phone ?? old('phone') }}" name="phone" placeholder="Company Name" aria-label="Company Name" data-msg="Please enter a company name." data-error-class="u-has-error" data-success-class="u-has-success">
                                    </div>
                                    <!-- End Input -->
                                </div>
                            <div class="col-md-6">
                                <!-- Input -->
                                <div class="js-form-message mb-6">
                                    <label class="form-label">
                                        Address
                                        <span class="text-danger">*</span>
                                    </label>
                                    <input type="text" class="form-control" value="{{ Auth::guard('web')->user()->address ?? old('address') }}" name="address" placeholder="470 Lucy Forks" aria-label="470 Lucy Forks" required="" data-msg="Please enter a valid address." data-error-class="u-has-error" data-success-class="u-has-success">
                                </div>
                                <!-- End Input -->
                            </div>

                            <div class="col-md-6">
                                <!-- Input -->
                                <div class="js-form-message mb-6">
                                    <label class="form-label">
                                        Building No.
                                        <span class="text-danger">*</span>
                                    </label>
                                    <input type="text" class="form-control" value="{{ old('building_number') }}" name="building_number" placeholder="470 Lucy Forks" aria-label="470 Lucy Forks" required="" data-msg="Please enter a valid address." data-error-class="u-has-error" data-success-class="u-has-success">
                                </div>
                                <!-- End Input -->
                            </div>

                            <div class="col-md-6">
                                <!-- Input -->
                                <div class="js-form-message mb-6">
                                    <label class="form-label">
                                        Street
                                    </label>
                                    <input type="text" class="form-control" value="{{ old('street') }}" name="street" placeholder="470 Lucy Forks" aria-label="470 Lucy Forks" data-msg="Please enter a valid address." data-error-class="u-has-error" data-success-class="u-has-success">
                                </div>
                                <!-- End Input -->
                            </div>

                            <div class="col-md-6">
                                <!-- Input -->
                                <div class="js-form-message mb-6">
                                    <label class="form-label">
                                        District
                                    </label>
                                    <input type="text" class="form-control" value="{{ old('district') }}" name="district" placeholder="470 Lucy Forks" aria-label="470 Lucy Forks" data-msg="Please enter a valid address." data-error-class="u-has-error" data-success-class="u-has-success">
                                </div>
                                <!-- End Input -->
                            </div>

                            <div class="col-md-6">
                                <!-- Input -->
                                <div class="js-form-message mb-6">
                                    <label class="form-label">
                                        City
                                        <span class="text-danger">*</span>
                                    </label>
                                    <div class="dropdown bootstrap-select form-control js-select dropdown-select">
                                        <select class="form-control js-select selectpicker dropdown-select" name="city" required="" data-msg="Please select state." data-error-class="u-has-error" data-success-class="u-has-success" data-live-search="true" data-style="form-control border-color-1 font-weight-normal" tabindex="-98">
                                            <option value="">Select city</option>
                                            @foreach($cities as $city)
                                                <option value="{{ $city->name }}">{{ $city->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <!-- End Input -->
                            </div>

                            <div class="col-md-6">
                                <!-- Input -->
                                <div class="js-form-message mb-6">
                                    <label class="form-label">
                                        Email address
                                        <span class="text-danger">*</span>
                                    </label>
                                    <input type="email" class="form-control" value="{{ Auth::guard('web')->user()->email ?? old('email') }}" name="email" placeholder="jackwayley@gmail.com" aria-label="jackwayley@gmail.com" required="" data-msg="Please enter a valid email address." data-error-class="u-has-error" data-success-class="u-has-success">
                                </div>
                                <!-- End Input -->
                            </div>

                            <div class="w-100"></div>
                        </div>
                        <!-- End Billing Form -->

                        <!-- Accordion -->
                        @if(!Auth::guard('web')->check())
                        <div id="shopCartAccordion2" class="accordion rounded mb-6">
                            <!-- Card -->
                            <div class="card border-0">
                                <div id="shopCartHeadingThree" class="custom-control custom-checkbox d-flex align-items-center">
                                    <input type="checkbox" class="custom-control-input" id="createAnaccount" name="createAnaccount">
                                    <label class="custom-control-label form-label" for="createAnaccount" data-toggle="collapse" data-target="#shopCartThree" aria-expanded="false" aria-controls="shopCartThree">
                                        Create an account?
                                    </label>
                                </div>
                                <div id="shopCartThree" class="collapse" aria-labelledby="shopCartHeadingThree" data-parent="#shopCartAccordion2" style="">
                                    <!-- Form Group -->
                                    <div class="js-form-message form-group py-5">
                                        <label class="form-label" for="signinSrPasswordExample1">
                                            Create account password
                                            <span class="text-danger">*</span>
                                        </label>
                                        <input type="password" class="form-control" name="password" id="signinSrPasswordExample1" placeholder="********" aria-label="********" required="" data-msg="Enter password." data-error-class="u-has-error" data-success-class="u-has-success">
                                    </div>
                                    <!-- End Form Group -->
                                </div>
                            </div>
                            <!-- End Card -->
                        </div>
                        <!-- End Accordion -->
                        @endif
                        <!-- Input -->
                        <div class="js-form-message mb-6">
                            <label class="form-label">
                                Order notes (optional)
                            </label>

                            <div class="input-group">
                                <textarea class="form-control p-5" rows="4" name=products"notes" placeholder="Notes about your order, e.g. special notes for delivery."></textarea>
                            </div>
                        </div>
                        <!-- End Input -->
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
