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
                                <a class="nav-link active" id="Jpills-one-example1-tab" data-toggle="pill" href="#Jpills-one-example1" role="tab" aria-controls="Jpills-one-example1" aria-selected="true">{{ __('auth.register') }}</a>
                            </li>
                        </ul>
                    </div>
                    <div class="borders-radius-17 border p-4 mt-4 mt-md-0 px-lg-10 py-lg-9">
                        <div class="tab-content" id="Jpills-tabContent">
                            <div class="tab-pane fade active show" id="Jpills-one-example1" role="tabpanel" aria-labelledby="Jpills-one-example1-tab">
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
                                                        <label class="select_reg active" for="registerAsIndividual">
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
                                        <div class="col-md-12">
                                            {!! generate_map() !!}
                                            <input type="hidden" class="lat" value="{{old('latitude')}}" readonly name="latitude" required>
                                            <input type="hidden" class="lng" value="{{old('longitude')}}" readonly name="longitude" required>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="js-form-message form-group mb-5">
                                                <label for="password" class="form-label">{{ __('auth.password_input') }} <span class="text-danger">*</span></label>
                                                <div class="eye_show">
                                                    <input type="password" class="form-control @error('password') is-invalid @enderror" id="passwordInput" name="password" required autocomplete="new-password">
                                                    <span href="#" class="showPassword fa fa-eye" data-toggle="#passwordInput"></span>
                                                </div>

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
                                                <div class="eye_show">
                                                    <input type="password" class="form-control" name="password_confirmation" id="passwordConfirmInput" required autocomplete="new-password">
                                                    <span href="#" class="showPassword fa fa-eye" data-toggle="#passwordConfirmInput"></span>
                                                </div>
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
    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC0jFnIKr5fjHZlmeY3QoiyelAGLrd-Fnc&libraries=places&sensor=false"></script>
    <script src="{{front_url()}}/assets/js/map.js"></script>
    <script>
        $(function(){
            $('#registerAsIndividual').attr('checked', 'checked');
        });
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
