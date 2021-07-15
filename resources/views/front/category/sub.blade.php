@extends('front.layouts.master')
@section('metaTags')
    <title>{{$subCategory->meta_title}}</title>
    <meta name="description" content="{{$subCategory->meta_desc}}">
    <meta name="keywords" content="{{$subCategory->meta_keywords}}">
    <meta property="og:url" content="{{url()->current()}}" />
    <meta property="og:title" content="{{$subCategory->meta_title}}" />
    <meta property="og:description" content="{{$subCategory->meta_desc}}" />
    <meta property="og:image" content="{{$subCategory->getFirstMediaUrlOrDefault(SUB_CATEGORY_PATH)['url']}}" />
    <meta name="twitter:card" content="summary">
    <meta name="twitter:site" content="@YouMats">
    <meta name="twitter:title" content="{{$subCategory->meta_title}}">
    <meta name="twitter:description" content="{{$subCategory->meta_desc}}">
    <meta name="twitter:image" content="{{$subCategory->getFirstMediaUrlOrDefault(SUB_CATEGORY_PATH)['url']}}">
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
            <div class="row mb-8 rtl">
                <div class="d-none d-xl-block col-xl-3 col-wd-2gdot5">
                    @if(!is_company())
                        <div class="mb-6">
                            <div class="range-slider bg-gray-3 p-3">
                                <h4 class="font-size-14 mb-3 font-weight-bold">Price</h4>
                                <!-- Range Slider -->
                                <input class="js-range-slider" type="text"
                                       data-extra-classes="u-range-slider u-range-slider-indicator u-range-slider-grid"
                                       data-type="double" data-grid="false" data-hide-from-to="true" data-prefix="{{ getCurrency('symbol') }}"
                                       data-min="{{$minPrice}}" data-max="{{$maxPrice}}" data-from="{{$minPrice}}" data-to="{{$maxPrice}}"
                                       data-result-min="#rangeSliderExample3MinResultSubCategory" data-result-max="#rangeSliderExample3MaxResultSubCategory">
                                <!-- End Range Slider -->
                                <div class="mt-1 text-gray-111 d-flex mb-4">
                                    <span class="mr-0dot5">Price: </span>
                                    <span>{{ getCurrency('symbol') }} </span>
                                    <span id="rangeSliderExample3MinResultSubCategory">{{$minPrice}}</span>
                                    <span class="mx-0dot5"> — </span>
                                    <span>{{ getCurrency('symbol') }} </span>
                                    <span id="rangeSliderExample3MaxResultSubCategory">{{$maxPrice}}</span>
                                </div>
                                <button class="btn px-4 btn-primary-dark-w py-2 rounded-lg text-white" id="priceFilterBtn">Filter</button>
                            </div>
                        </div>
                    @endif
                    @foreach($subCategory->attributes as $attribute)
                    <div class="mb-6">
                        <div class="border-bottom border-color-1 mb-5">
                            <h3 class="section-title section-title__sm mb-0 pb-2 font-size-18">{{$attribute->key}}</h3>
                        </div>
                        <div class="border-bottom pb-4 mb-4">
                            @foreach($attribute->values as $value)
                            <div class="form-group d-flex align-items-center justify-content-between mb-2 pb-1">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input filter-checkboxes" value="{{$value->id}}" id="{{$attribute->key . '_' . $value->value}}">
                                    <label class="custom-control-label" for="{{$attribute->key . '_' . $value->value}}">{{$value->value}}</label>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    @endforeach
                    <div class="mb-6">
                        <div class="border-bottom border-color-1 mb-5">
                            <h3 class="section-title section-title__sm mb-0 pb-2 font-size-18">Categories</h3>
                        </div>
                        <div class="border-bottom pb-4 mb-4">
                            @foreach($category->subCategories as $sub)
                            <div class="form-group d-flex align-items-center justify-content-between mb-2 pb-1">
                                <div class="custom-control custom-checkbox">
                                    <a @if($sub->id == $subCategory->id) style="font-weight: bold" @endif href="{{route('front.subCategory', [$category->slug, $sub->slug])}}" class="custom-control-label">{{$sub->name}}
                                        <span class="text-gray-25 font-size-12 font-weight-norma3"> ({{count($sub->products)}})</span>
                                    </a>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    @if(count($tags))
                    <div class="mb-6 d-none">
                        <div class="border-bottom border-color-1 mb-5">
                            <h3 class="section-title section-title__sm mb-0 pb-2 font-size-18">Tags</h3>
                        </div>
                        <div class="border-bottom pb-4 mb-4">
                            @foreach($tags as $tag)
                            <div class="form-group d-flex align-items-center justify-content-between mb-2 pb-1">
                                <div class="custom-control custom-checkbox">
                                    <a href="{{route('front.tag', [$tag->slug])}}" class="custom-control-label">{{$tag->name}}
                                        <span class="text-gray-25 font-size-12 font-weight-norma3"> ({{count($tag->products)}})</span>
                                    </a>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    @endif
                </div>
                <div id="productsContainer" class="col-xl-9 col-wd-9gdot5">
                @include('front.category.productsContainer', ['subCategory' => $subCategory, 'products' => $products])
                </div>
            </div>
        </div>
    </div>
@endsection
@section('extraScripts')
    @include('front.layouts.partials.filter')
@endsection
