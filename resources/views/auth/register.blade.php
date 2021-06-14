@extends('front.layouts.master')
@section('metaTags')
    <title>YouMats | Register</title>
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
                        <li class="breadcrumb-item flex-shrink-0 flex-xl-shrink-1 active" aria-current="page">{{ __('Register') }}</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-md-10 offset-md-1">
                <div class="mb-8">
                    <div class="position-relative position-md-static px-md-6">
                        <ul class="nav nav-classic nav-tab nav-tab-lg justify-content-xl-center flex-nowrap flex-xl-wrap overflow-auto overflow-xl-visble border-0 pb-1 pb-xl-0 mb-n1 mb-xl-0" id="pills-tab-8" role="tablist">
                            <li class="nav-item flex-shrink-0 flex-xl-shrink-1 z-index-2">
                                <a class="nav-link active show" id="register-tab" data-toggle="pill" href="#Jpills-one-example1" role="tab" aria-controls="Jpills-one-example1" aria-selected="true">{{ __('auth.user_registration') }}</a>
                            </li>
                            <li class="nav-item flex-shrink-0 flex-xl-shrink-1 z-index-2" role="presentation">
                                <a class="nav-link" id="vendor-registration-tab" data-toggle="pill" href="#vendor-registration" role="tab" aria-controls="vendor-registration">{{ __('auth.vendor_registration') }}</a>
                            </li>
                        </ul>
                    </div>
                    <div class="borders-radius-17 border p-4 mt-4 mt-md-0 px-lg-10 py-lg-9">
                        <div class="tab-content" id="registerTab">
                            <div class="tab-pane fade active show" id="Jpills-one-example1" role="tabpanel" aria-labelledby="register-tab">
                                @error('files')
                                    <div class="alert alert-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </div>
                                @enderror
                                <div class="row">
                                    <div class="col-md-12">
                                        <p class="text-gray-90 mb-4">{{ __('auth.register_text') }}</p>
                                    </div>
                                </div>
                                <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="js-form-message form-group mb-5">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <label class="select_reg" for="registerAsIndividual">
                                                            <input type="radio" name="type" value="individual" id="registerAsIndividual">
                                                            {{ __('auth.register_as_individual') }}
                                                        </label>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label class="select_reg" for="registerAsCompany">
                                                            <input type="radio" name="type" value="company" id="registerAsCompany">
                                                            {{ __('auth.register_as_company') }}
                                                        </label>
                                                    </div>
                                                </div>
                                                @error('type')
                                                <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="js-form-message form-group mb-5">
                                                <label for="name" class="form-label">{{ __('auth.name') }} <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                                                @error('name')
                                                <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="js-form-message form-group mb-5">
                                                <label for="email" class="form-label">{{ __('auth.email') }} <span class="text-danger">*</span></label>
                                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
                                                @error('email')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="js-form-message form-group mb-5">
                                                <label for="phone" class="form-label">{{ __('auth.phone') }}</label>
                                                <input type="tel" class="form-control phoneNumber @error('phone') is-invalid @enderror" value="{{ old('phone') }}" required>
                                                @error('phone')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="js-form-message form-group mb-5">
                                                <label for="address" class="form-label">{{ __('auth.address') }}</label>
                                                <input id="address" type="text" class="form-control @error('address') is-invalid @enderror" name="address" value="{{ old('address') }}" autocomplete="address">
                                                @error('address')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="js-form-message form-group mb-5">
                                                <label for="password" class="form-label">{{ __('auth.password_input') }} <span class="text-danger">*</span></label>
                                                <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                                                @error('password')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6" id="passwordConfirm">
                                            <div class="js-form-message form-group mb-5">
                                                <label for="password-confirm" class="form-label">{{ __('auth.confirm_password') }} <span class="text-danger">*</span></label>
                                                <input type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <button type="submit" class="btn btn-primary-dark-w px-5 text-white">{{ __('auth.register') }}</button>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <h3 class="font-size-18 mb-3">{{__('auth.signup_headline')}} :</h3>
                                            <ul class="list-group list-group-borderless">
                                                <li class="list-group-item px-0"><i class="fas fa-check mr-2 text-green font-size-16"></i> {{ __('auth.speed_checkout') }}</li>
                                                <li class="list-group-item px-0"><i class="fas fa-check mr-2 text-green font-size-16"></i> {{ __('auth.track_orders') }}</li>
                                                <li class="list-group-item px-0"><i class="fas fa-check mr-2 text-green font-size-16"></i> {{ __('auth.keep_records') }}</li>
                                            </ul>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="tab-pane fade" id="vendor-registration" role="tabpanel" aria-labelledby="vendor-registration-tab">
                                <div class="row">
                                    <div class="col-md-12">
                                        <p class="text-gray-90 mb-4">{{ __('auth.vendor_register_text') }}</p>
                                    </div>
                                </div>
                                <form method="POST" action="{{ route('vendor.register') }}">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="js-form-message form-group mb-5">
                                                <label for="name" class="form-label">{{ __('auth.name') }} <span class="text-danger">(English)*</span></label>
                                                <input type="text" class="form-control @error('name_en') is-invalid @enderror" id="name" name="name_en" value="{{ old('name_en') }}" required autocomplete="name_en" autofocus>
                                                @error('name_en')
                                                <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="js-form-message form-group mb-5">
                                                <label for="name" class="form-label">{{ __('auth.name') }} <span class="text-danger">(Arabic)*</span></label>
                                                <input type="text" class="form-control @error('name_ar') is-invalid @enderror" id="name" name="name_ar" value="{{ old('name_ar') }}" required autocomplete="name_ar" autofocus>
                                                @error('name_ar')
                                                <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="js-form-message form-group mb-5">
                                                <label for="email" class="form-label">{{ __('auth.email') }} <span class="text-danger">*</span></label>
                                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
                                                @error('email')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="js-form-message form-group mb-5">
                                                <label for="phone" class="form-label">{{ __('auth.phone') }} <span class="text-danger">*</span></label>
                                                <div class="input-group mb-3">
                                                    <input type="tel" class="form-control phoneNumber @error('phone') is-invalid @enderror" value="{{ old('phone') }}" required>
                                                </div>
                                                @error('phone')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="js-form-message form-group mb-5">
                                                <label for="type" class="form-label">{{ __('auth.country') }} <span class="text-danger">*</span></label>
                                                <select class="form-control @error('country_id') is-invalid @enderror" id="type" name="country_id" required>
                                                    @foreach($countries as $country)
                                                        <option value="{{ $country->id }}">{{ $country->name }}</option>
                                                    @endforeach
                                                </select>
                                                @error('country_id')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="js-form-message form-group mb-5">
                                                <label for="address" class="form-label">{{ __('auth.address') }} <span class="text-danger">*</span></label>
                                                <input id="address" type="text" class="form-control @error('address') is-invalid @enderror" name="address" value="{{ old('address') }}" autocomplete="address" required>
                                                @error('address')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="js-form-message form-group mb-5">
                                                <label for="password" class="form-label">{{ __('auth.password_input') }} <span class="text-danger">*</span></label>
                                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                                                @error('password')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="js-form-message form-group mb-5">
                                                <label for="password-confirm" class="form-label">{{ __('auth.confirm_password') }} <span class="text-danger">*</span></label>
                                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <button type="submit" class="btn btn-primary-dark-w px-5 text-white">{{ __('auth.register') }}</button>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <h3 class="font-size-18 mb-3">{{__('auth.signup_headline')}} :</h3>
                                            <ul class="list-group list-group-borderless">
                                                <li class="list-group-item px-0"><i class="fas fa-check mr-2 text-green font-size-16"></i> {{ __('auth.speed_checkout') }}</li>
                                                <li class="list-group-item px-0"><i class="fas fa-check mr-2 text-green font-size-16"></i> {{ __('auth.track_orders') }}</li>
                                                <li class="list-group-item px-0"><i class="fas fa-check mr-2 text-green font-size-16"></i> {{ __('auth.keep_records') }}</li>
                                            </ul>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('extraScripts')
    <script>
        $('.select_reg').on('click', function () {
            $('.select_reg').removeClass('active');
            $(this).addClass('active');
        });

        $(document).ready(function() {
            $("ul.nav-tab > li > a").on('shown.bs.tab', function(e) {
                window.location.hash = $(e.target).attr('id');
            })

            $("#registerAsCompany").click(function(e){
                $("#documents").html('');
                $("#passwordConfirm").after(`
                    <div class="col-md-12" id="documents">
                        <div class="js-form-message form-group mb-5">
                            <label class="form-label" >{{ __('auth.documents') }} <span class="text-danger">*</span></label>
                            <input type="file" class="form-control" name="files[]" required multiple/>
                        </div>
                    </div>
                `);
            });

            $("#registerAsIndividual").click(function(e){
                let documents = $("#documents");
                documents.remove();
            });

            let hash = window.location.hash;
            $('ul.nav-tab a[id="'+ hash + '"]').tab('show');
        });
    </script>
@endsection
