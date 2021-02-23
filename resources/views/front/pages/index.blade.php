@extends('front.layouts.master')
@section('metaTags')
    <title>YouMats | {{$page->meta_title}}</title>
    <meta name="description" content="{{$page->meta_desc}}">
    <meta name="keywords" content="{{$page->meta_keywords}}">
    <meta property="og:url" content="{{url()->current()}}" />
    <meta property="og:title" content="{{$page->meta_title}}" />
    <meta property="og:description" content="{{$page->meta_desc}}" />
    <meta property="og:image" content="{{$page->getFirstMediaUrl(PAGE_PATH)}}" />
    <meta name="twitter:card" content="summary">
    <meta name="twitter:site" content="@YouMats">
    <meta name="twitter:title" content="{{$page->meta_title}}">
    <meta name="twitter:description" content="{{$page->meta_desc}}">
    <meta name="twitter:image" content="{{$page->getFirstMediaUrl(PAGE_PATH)}}">
@endsection
@section('content')
    <div class="bg-gray-13 bg-md-transparent">
        <div class="container">
            <!-- breadcrumb -->
            <div class="my-md-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-3 flex-nowrap flex-xl-wrap overflow-auto overflow-xl-visble">
                        <li class="breadcrumb-item flex-shrink-0 flex-xl-shrink-1"><a href="{{route('home')}}">Home</a></li>
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
                    <img src="{{$page->getFirstMediaUrl(PAGE_PATH)}}" alt="{{$page->getFirstMedia(PAGE_PATH)->img_alt}}" title="{{$page->getFirstMedia(PAGE_PATH)->img_title}}">
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <h3 class="font-size-18 font-weight-semi-bold text-gray-39 mb-4">{{$page->title}}</h3>
                <p class="text-gray-90">{!! $page->desc !!}</p>
            </div>
        </div>

        <div class="row">
            <div class="col-md-4 mb-4 mb-md-0">
                <div class="card mb-3 border-0 text-center rounded-0">
                    <img class="img-fluid mb-3" src="{{front_url()}}/assets/img/logo.png" alt="Card image cap">
                    <div class="card-body">
                        <h5 class="font-size-18 font-weight-semi-bold mb-3">What we really do?</h5>
                        <p class="text-gray-90 max-width-334 mx-auto">Donec libero dolor, tincidunt id laoreet vitae, ullamcorper eu tortor. Maecenas pellentesque, dui vitae iaculis mattis, tortor nisi faucibus magna,vitae ultrices lacus purus vitae metus.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-4 mb-md-0">
                <div class="card mb-3 border-0 text-center rounded-0">
                    <img class="img-fluid mb-3" src="{{front_url()}}/assets/img/logo.png" alt="Card image cap">
                    <div class="card-body">
                        <h5 class="font-size-18 font-weight-semi-bold mb-3">Our Vision</h5>
                        <p class="text-gray-90 max-width-334 mx-auto">Donec libero dolor, tincidunt id laoreet vitae, ullamcorper eu tortor. Maecenas pellentesque, dui vitae iaculis mattis, tortor nisi faucibus magna,vitae ultrices lacus purus vitae metus.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card mb-3 border-0 text-center rounded-0">
                    <img class="img-fluid mb-3" src="{{front_url()}}/assets/img/logo.png" alt="Card image cap">
                    <div class="card-body">
                        <h5 class="font-size-18 font-weight-semi-bold mb-3">History of the Company</h5>
                        <p class="text-gray-90 max-width-334 mx-auto">Donec libero dolor, tincidunt id laoreet vitae, ullamcorper eu tortor. Maecenas pellentesque, dui vitae iaculis mattis, tortor nisi faucibus magna,vitae ultrices lacus purus vitae metus.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
