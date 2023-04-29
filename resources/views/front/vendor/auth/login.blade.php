@extends('front.layouts.master')
@section('metaTags')
    <title>YouMats | Login</title>
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
                        <li class="breadcrumb-item flex-shrink-0 flex-xl-shrink-1"><a href="{{route('home')}}">{{__('general.home')}}</a></li>
                        <li class="breadcrumb-item flex-shrink-0 flex-xl-shrink-1 active" aria-current="page">{{ __('auth.vendor_login') }}</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-md-6 mx-auto">
                <div class="mb-8">
                    <div class="borders-radius-17 border p-4 mt-4 mt-md-0 px-lg-10 py-lg-9">
                        <div class="tab-pane fade active show" id="Jpills-one-example1" role="tabpanel" aria-labelledby="login-tab">
                            <div class="row">
                                <div class="col-md-12">
                                    <p class="text-gray-90 mb-4">{{ __('auth.vendor_text') }}</p>
                                </div>
                            </div>
                            <form method="POST" action="{{ route('vendor.login') }}">
                                @csrf
                                <div class="row mb-3">
                                    <h1 class="text-center col-md-12">{{ __('auth.vendor_login') }}</h1>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-12">
                                        <div class="js-form-message form-group">
                                            <label class="form-label" for="email">{{ __('auth.email') }}</label>
                                            <input type="email" id="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                                            @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-12">
                                        <div class="js-form-message form-group">
                                            <label class="form-label" for="password">{{ __('auth.password_input') }}</label>
                                            <input type="password" id="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                                            @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col d-flex justify-content-center my-auto">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                            <label class="form-check-label" for="remember">
                                                {{ __('auth.remember_me') }}
                                            </label>
                                        </div>
                                    </div>
                                    @if (Route::has('vendor.password.request'))
                                    <div class="col">
                                        <a class="btn btn-link" href="{{ route('vendor.password.request') }}">
                                            {{ __('auth.forget_password') }}
                                        </a>
                                    </div>
                                    @endif
                                </div>

                                <div class="row mb-3">
                                    <div class="col-md-12 text-center">
                                        <button type="submit" class="btn btn-primary-dark-w px-5 text-white">{{ __('auth.login') }}</button>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12 text-center">
                                        <p>
                                            {{ __('auth.not_member') }}
                                            <a class="btn btn-link" href="{{route('register')}}">
                                                {{ __('auth.register') }}
                                            </a>
                                        </p>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
