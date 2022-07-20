@extends('front.layouts.master')
@section('metaTags')
    <title>YouMats | {{$page->meta_title}}</title>
    <meta name="description" content="{{$page->meta_desc}}">
    <meta name="keywords" content="{{$page->meta_keywords}}">
    <meta property="og:url" content="{{url()->current()}}" />
    <meta property="og:title" content="{{$page->meta_title}}" />
    <meta property="og:description" content="{{$page->meta_desc}}" />
    <meta property="og:image" content="{{$page->getFirstMediaUrlOrDefault(PAGE_PATH)['url']}}" />
    <meta name="twitter:card" content="summary">
    <meta name="twitter:site" content="@YouMats">
    <meta name="twitter:title" content="{{$page->meta_title}}">
    <meta name="twitter:description" content="{{$page->meta_desc}}">
    <meta name="twitter:image" content="{{$page->getFirstMediaUrlOrDefault(PAGE_PATH)['url']}}">
    {!! $page->schema !!}
@endsection
@section('content')
    <div class="bg-gray-13 bg-md-transparent">
        <div class="container">
            <!-- breadcrumb -->
            <div class="my-md-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-3 flex-nowrap flex-xl-wrap overflow-auto overflow-xl-visble">
                        <li class="breadcrumb-item flex-shrink-0 flex-xl-shrink-1"><a href="{{route('home')}}">{{__('general.home')}}</a></li>
                        <li class="breadcrumb-item flex-shrink-0 flex-xl-shrink-1 active" aria-current="page">{{$page->title}}</li>
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
                    <img loading="lazy" src="{{$page->getFirstMediaUrlOrDefault(PAGE_PATH)['url']}}" alt="{{$page->getFirstMediaUrlOrDefault(PAGE_PATH)['alt']}}" title="{{$page->getFirstMediaUrlOrDefault(PAGE_PATH)['title']}}">
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <h2 class="font-size-18 font-weight-semi-bold text-center text-gray-39 mb-4">{{$page->title}}</h2>
                <div class="text-gray-90 text-left">{!! $page->desc !!}</div>
            </div>
        </div>

        @if($page->slug == 'about-us')
        <div class="row my-5">
            <div class="col-md-12">
                <a class="select_reg" style="display: block" href="{{route('vendor.register')}}">{{__('general.sign_up_as_vendor_from_about_button')}}</a>
            </div>
        </div>
        @endif

{{--        <div class="row">--}}
{{--            <div class="col-md-4 mb-4 mb-md-0">--}}
{{--                <div class="card mb-3 border-0 text-center rounded-0">--}}
{{--                    <img loading="lazy" class="img-fluid mb-3" src="{{ Storage::url(nova_get_setting('logo')) }}" alt="Card image cap">--}}
{{--                    <div class="card-body">--}}
{{--                        <h5 class="font-size-18 font-weight-semi-bold mb-3">What we really do?</h5>--}}
{{--                        <p class="text-gray-90 max-width-334 mx-auto">Donec libero dolor, tincidunt id laoreet vitae, ullamcorper eu tortor. Maecenas pellentesque, dui vitae iaculis mattis, tortor nisi faucibus magna,vitae ultrices lacus purus vitae metus.</p>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--            <div class="col-md-4 mb-4 mb-md-0">--}}
{{--                <div class="card mb-3 border-0 text-center rounded-0">--}}
{{--                    <img loading="lazy" class="img-fluid mb-3" src="{{ Storage::url(nova_get_setting('logo')) }}" alt="Card image cap">--}}
{{--                    <div class="card-body">--}}
{{--                        <h5 class="font-size-18 font-weight-semi-bold mb-3">Our Vision</h5>--}}
{{--                        <p class="text-gray-90 max-width-334 mx-auto">Donec libero dolor, tincidunt id laoreet vitae, ullamcorper eu tortor. Maecenas pellentesque, dui vitae iaculis mattis, tortor nisi faucibus magna,vitae ultrices lacus purus vitae metus.</p>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--            <div class="col-md-4">--}}
{{--                <div class="card mb-3 border-0 text-center rounded-0">--}}
{{--                    <img loading="lazy" class="img-fluid mb-3" src="{{ Storage::url(nova_get_setting('logo')) }}" alt="Card image cap">--}}
{{--                    <div class="card-body">--}}
{{--                        <h5 class="font-size-18 font-weight-semi-bold mb-3">History of the Company</h5>--}}
{{--                        <p class="text-gray-90 max-width-334 mx-auto">Donec libero dolor, tincidunt id laoreet vitae, ullamcorper eu tortor. Maecenas pellentesque, dui vitae iaculis mattis, tortor nisi faucibus magna,vitae ultrices lacus purus vitae metus.</p>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
    </div>
@endsection
