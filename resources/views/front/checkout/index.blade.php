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
            <h1 class="text-center">{{ __(is_company() ? 'checkout.get_quote_price' : 'checkout.checkout') }}</h1>
        </div>
        @if(!Auth::guard('web')->check())
            <!-- Accordion -->
            <div id="shopCartAccordion" class="accordion rounded mb-5">
                <!-- Card -->
                <div class="card border-0">
                    <div id="shopCartHeadingOne" class="alert alert-primary mb-0 text-white" role="alert">
                        {{ __('Returning customer?') }} <a href="#" class="alert-link collapsed text-white" data-toggle="collapse" data-target="#shopCartOne" aria-expanded="false" aria-controls="shopCartOne">Click here to login</a>
                    </div>
                    <div id="shopCartOne" class="border border-top-0 collapse" aria-labelledby="shopCartHeadingOne" data-parent="#shopCartAccordion" style="">
                        <!-- Form -->
                        <form method="POST" action="{{ route('login') }}">
                            @csrf

                            <div class="row">
                                <div class="mb-4">
                                    <h1 class="text-center col-md-12">{{ __('auth.login') }}</h1>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="js-form-message form-group mb-5">
                                        <label class="form-label" for="email">{{ __('auth.email') }}</label>
                                        <input type="email" id="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                                        @error('email')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="js-form-message form-group mb-5">
                                        <label class="form-label" for="password">{{ __('auth.password_input') }}</label>
                                        <input type="password" id="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                                        @error('password')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                        <label class="form-check-label" for="remember">
                                            {{ __('auth.remember_me') }}
                                        </label>
                                    </div>
                                </div>


                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <button type="submit" class="btn btn-primary-dark-w px-5 text-white">{{ __('auth.login') }}</button>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    @if (Route::has('password.request'))
                                        <a class="btn btn-link" href="{{ route('password.request') }}">
                                            {{ __('auth.forget_password') }}
                                        </a>
                                    @endif
                                    <a class="btn btn-link" href="{{route('register')}}">
                                        {{ __('auth.register') }}
                                    </a>
                                </div>

                            </div>
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
                <div id="shopCartHeadingTwo" class="alert alert-primary mb-0 text-white" role="alert">
                    Have a coupon? <a href="#" class="alert-link text-white" data-toggle="collapse" data-target="#shopCartTwo" aria-expanded="false" aria-controls="shopCartTwo">Click here to enter your code</a>
                </div>
                <div id="shopCartTwo" class="collapse border border-top-0" aria-labelledby="shopCartHeadingTwo" data-parent="#shopCartAccordion1" style="">
                    <!-- Apply coupon Form -->
                    <form class="js-focus-state" action="{{ route('apply.coupon') }}" method="POST">
                        @csrf
                        <label class="sr-only">{{ __('Coupon code') }}</label>
                        <div class="input-group">
                            <input type="text" class="form-control" @if($coupon) disabled @endif name="code" value="@if($coupon) {{ $coupon->name }} @else {{ old('code') }} @endif" placeholder="Coupon code" id="couponCode" aria-label="Coupon code" aria-describedby="subscribeButtonExample2" required>
                            <div class="input-group-append">
                                <input type="submit" class="btn btn-block btn-dark px-4" @if($coupon) disabled @endif value="Apply coupon" />
                            </div>
                        </div>
                    </form>
                    <!-- End Apply coupon Form -->
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
                                    <h3 class="section-title mb-0 pb-2 font-size-25">Your {{ is_company() ? 'quote' : 'order' }}</h3>
                                </div>
                                <!-- End Title -->

                                <!-- Product Content -->
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th class="product-name">Product</th>
                                        <th class="product-name">Quantity</th>
                                        @if(!is_company())
                                            <th class="product-total">Total</th>
                                        @endif
                                    </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($cartItems as $item)
                                            <tr class="cart_item">
                                                <td>{{ $item->name }}</td>
                                                <td>{{ $item->qty }}</td>
                                                @if(!is_company())
                                                    <td>{{ getCurrency('symbol') . ' ' . $item->price }}</td>
                                                @endif
                                            </tr>
                                        @endforeach
                                    </tbody>
                                    @if(!is_company())
                                        <tfoot>
                                        <tr>
                                            <th>Subtotal</th>
                                            <td>{{ getCurrency('symbol') . ' ' . Cart::subtotal() }}</td>
                                        </tr>
                                        <tr>
                                            <th>Tax</th>
                                            <td>{{ getCurrency('symbol') . ' ' . Cart::tax() }}</td>
                                        </tr>
                                        <tr>
                                            <th>Total</th>
                                            <td><strong>{{ getCurrency('symbol') . ' ' . Cart::total() }}</strong></td>
                                        </tr>
                                        </tfoot>
                                    @endif
                                </table>
                                @if(!is_company())
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
                                @endif
                                <div class="form-group d-flex align-items-center justify-content-between px-3 mb-5">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="terms" value="true" id="defaultCheck10" data-msg="Please agree terms and conditions." data-error-class="u-has-error" data-success-class="u-has-success">
                                        <label class="form-check-label form-label" for="defaultCheck10">
                                            I have read and agree to the website <a href="#" class="text-blue">terms and conditions </a>
                                            <span class="text-danger">*</span>
                                        </label>
                                        @error('terms')
                                        <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary-dark-w btn-block btn-pill font-size-20 mb-3 py-3">
                                    @if(is_company())
                                        Get Quote
                                    @else
                                        Place order
                                    @endif
                                </button>
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
                                    <input type="text" class="form-control" value="{{ Auth::guard('web')->user()->name ?? old('name') }}" name="name" required="" data-msg="Please enter your frist name." data-error-class="u-has-error" data-success-class="u-has-success" autocomplete="off">
                                    @error('name')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <!-- End Input -->
                            </div>
                            <div class="col-md-6">
                                    <!-- Input -->
                                    <div class="js-form-message mb-6">
                                        <label class="form-label">
                                            Phone
                                        </label>
                                        <input type="tel" class="form-control phoneNumber" value="{{ Auth::guard('web')->user()->phone ?? old('phone') }}" name="phone" aria-label="Phone Number" data-msg="Please enter a phone number." data-error-class="u-has-error" data-success-class="u-has-success">
                                        @error('phone')
                                        <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <!-- End Input -->
                                </div>
                            <div class="col-md-6">
                                <!-- Input -->
                                <div class="js-form-message mb-6">
                                    <label class="form-label">
                                        {{ is_company() ? 'Delivery Location' : 'Address' }}
                                        <span class="text-danger">*</span>
                                    </label>
                                    <input type="text" class="form-control" value="{{ Auth::guard('web')->user()->address ?? old('address') }}" name="address" aria-label="470 Lucy Forks" required="" data-msg="Please enter a valid address." data-error-class="u-has-error" data-success-class="u-has-success">
                                    @error('address')
                                    <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                    @enderror
                                </div>
                                <!-- End Input -->
                            </div>
                            @if(!is_company())
                                <div class="col-md-6">
                                    <!-- Input -->
                                    <div class="js-form-message mb-6">
                                        <label class="form-label">
                                            Building No.
                                            <span class="text-danger">*</span>
                                        </label>
                                        <input type="number" class="form-control" value="{{ old('building_number') }}" name="building_number" aria-label="470 Lucy Forks" required="" data-msg="Please enter a valid address." data-error-class="u-has-error" data-success-class="u-has-success">
                                        @error('building_number')
                                        <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                        @enderror
                                    </div>
                                    <!-- End Input -->
                                </div>
                                <div class="col-md-6">
                                    <!-- Input -->
                                    <div class="js-form-message mb-6">
                                        <label class="form-label">
                                            Street
                                        </label>
                                        <input type="text" class="form-control" value="{{ old('street') }}" name="street" aria-label="470 Lucy Forks" data-msg="Please enter a valid address." data-error-class="u-has-error" data-success-class="u-has-success">
                                        @error('street')
                                        <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                        @enderror
                                    </div>
                                    <!-- End Input -->
                                </div>
                                <div class="col-md-6">
                                    <!-- Input -->
                                    <div class="js-form-message mb-6">
                                        <label class="form-label">
                                            District
                                        </label>
                                        <input type="text" class="form-control" value="{{ old('district') }}" name="district" aria-label="470 Lucy Forks" data-msg="Please enter a valid address." data-error-class="u-has-error" data-success-class="u-has-success">
                                        @error('district')
                                        <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                        @enderror
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
                                                    <option value="{{ $city->name }}" @if($city->name == old('city')) selected @endif>{{ $city->name }}</option>
                                                @endforeach
                                            </select>
                                            @error('city')
                                            <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <!-- End Input -->
                                </div>
                            @endif
                            <div class="col-md-6">
                                <!-- Input -->
                                <div class="js-form-message mb-6">
                                    <label class="form-label">
                                        Email address
                                        <span class="text-danger">*</span>
                                    </label>
                                    <input type="email" class="form-control" value="{{ Auth::guard('web')->user()->email ?? old('email') }}" name="email" aria-label="jackwayley@gmail.com" required="" data-msg="Please enter a valid email address." data-error-class="u-has-error" data-success-class="u-has-success">
                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                    @enderror
                                </div>
                                <!-- End Input -->
                            </div>
                            @if(is_company())
                                <div class="col-md-6">
                                    <!-- Input -->
                                    <div class="js-form-message mb-6">
                                        <label class="form-label">
                                            Delivery Time
                                            <span class="text-danger">*</span>
                                        </label>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <input type="number" class="form-control" value="{{ old('delivery_time') }}" name="delivery_time" min="1" max="10" step="1" aria-label="{{ date('d-m-Y') }}" required data-msg="Please enter a delivery time." data-error-class="u-has-error" data-success-class="u-has-success">
                                            </div>
                                            <div class="col-md-6">
                                                <select class="form-control" name="delivery_time_unit">
                                                    <option value="day" @if(old('delivery_time_unit') == 'day') selected @endif>Day</option>
                                                    <option value="week" @if(old('delivery_time_unit') == 'week') selected @endif>Week</option>
                                                    <option value="month" @if(old('delivery_time_unit') == 'month') selected @endif>Month</option>
                                                </select>
                                            </div>
                                        </div>
                                        @error('delivery_time')
                                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                        @enderror
                                        @error('delivery_time_unit')
                                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>
                                    <!-- End Input -->
                                </div>
                                <div class="col-md-12 mb-3">
                                    <hr>
                                    <div class="js-form-message form-group mb-5">
                                        <label class="form-label">{{ __('general.location') }}</label>
                                        {!! generate_map() !!}
                                        <input type="hidden" class="lat" value="{{old('latitude')}}" readonly name="latitude" required>
                                        <input type="hidden" class="lng" value="{{old('longitude')}}" readonly name="longitude" required>
                                    </div>
                                </div>
                            @endif
                            <div class="w-100"></div>
                        </div>
                        <!-- End Billing Form -->

                        <!-- Accordion -->
                        @if(!Auth::guard('web')->check())
                        <div id="shopCartAccordion2" class="accordion rounded mb-6">
                            <!-- Card -->
                            <div class="card border-0">
                                <div aria-labelledby="shopCartHeadingThree" style="">
                                    <!-- Form Group -->
                                    <div class="js-form-message form-group py-5">
                                        <label class="form-label" for="signinSrPasswordExample1">
                                            Create account password
                                            <span class="text-danger">*</span>
                                        </label>
                                        <input type="password" class="form-control" name="password" id="signinSrPasswordExample1" placeholder="********" aria-label="********" required="" data-msg="Enter password." data-error-class="u-has-error" data-success-class="u-has-success">
                                        @error('password')
                                        <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <!-- End Form Group -->
                                    <!-- Form Group -->
                                    <div class="js-form-message form-group py-5">
                                        <label class="form-label" for="signinSrPasswordExample1">
                                            Confirm account password
                                            <span class="text-danger">*</span>
                                        </label>
                                        <input type="password" class="form-control" name="password_confirmation" id="signinSrPasswordExample2" placeholder="********" aria-label="********" required="" data-msg="Enter password." data-error-class="u-has-error" data-success-class="u-has-success">
                                        @error('password_confirmation')
                                        <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <!-- End Form Group -->
                                    <div class="js-form-message form-group mb-5">
                                        <label for="type" class="form-label">Type <span class="text-danger">*</span></label>
                                        <select class="form-control @error('name') is-invalid @enderror" id="type" name="type" required>
                                            <option value="individual" @if(!is_company()) selected @endif>Individual</option>
                                            <option value="company" @if(is_company()) selected @endif>Company</option>
                                        </select>
                                        @error('type')
                                        <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <!-- End Card -->
                        </div>
                        <!-- End Accordion -->
                        @endif
                        <!-- Input -->
                        <div class="js-form-message mb-6">
                            <label class="form-label">
                                {{ is_company() ? 'quote' : 'order' }} notes (optional)
                            </label>

                            <div class="input-group">
                                <textarea class="form-control p-5" rows="4" name="notes" placeholder="Notes about your {{ is_company() ? 'quote' : 'order' }}, e.g. special notes for delivery.">{{old('notes')}}</textarea>
                            </div>
                        </div>
                        <!-- End Input -->
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
@section('extraScripts')
    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC0jFnIKr5fjHZlmeY3QoiyelAGLrd-Fnc&libraries=places&sensor=false"></script>
    <script src="{{front_url()}}/assets/js/map.js"></script>
@endsection
