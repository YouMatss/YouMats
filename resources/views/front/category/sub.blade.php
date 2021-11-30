@extends('front.layouts.master')
@section('metaTags')
    <title>{{$category->meta_title}}</title>
    <meta name="description" content="{{$category->meta_desc}}">
    <meta name="keywords" content="{{$category->meta_keywords}}">
    <meta property="og:url" content="{{url()->current()}}" />
    <meta property="og:title" content="{{$category->meta_title}}" />
    <meta property="og:description" content="{{$category->meta_desc}}" />
    <meta property="og:image" content="{{$category->getFirstMediaUrlOrDefault(CATEGORY_PATH)['url']}}" />
    <meta name="twitter:card" content="summary">
    <meta name="twitter:site" content="@YouMats">
    <meta name="twitter:title" content="{{$category->meta_title}}">
    <meta name="twitter:description" content="{{$category->meta_desc}}">
    <meta name="twitter:image" content="{{$category->getFirstMediaUrlOrDefault(CATEGORY_PATH)['url']}}">
    <link rel="canonical" href="{{url()->current()}}" />
@endsection
@section('content')
    <div class="bg-gray-13 bg-md-transparent">
        <div class="container">
            <div class="my-md-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-3 flex-nowrap flex-xl-wrap overflow-auto overflow-xl-visble">
                        <li class="breadcrumb-item flex-shrink-0 flex-xl-shrink-1"><a href="{{route('home')}}">{{__('general.home')}}</a></li>
                        @foreach($category->ancestors as $ancestor)
                            <li class="breadcrumb-item flex-shrink-0 flex-xl-shrink-1"><a href="{{route('front.category', [generatedNestedSlug($ancestor->ancestors()->pluck('slug')->toArray(), $ancestor->slug)])}}">{{$ancestor->name}}</a></li>
                        @endforeach
                        <li class="breadcrumb-item flex-shrink-0 flex-xl-shrink-1 active" aria-current="page">{{$category->name}}</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <div class="mb-6 bg-md-transparent">
        <div class="container mb-8">
            <div class="d-flex justify-content-between border-bottom border-color-1 flex-lg-nowrap flex-wrap border-md-down-top-0 border-md-down-bottom-0 mb-3 rtl">
                <h1 class="section-title section-title__full mb-0 pb-2 font-size-22">{{(!empty($category->title)) ? $category->title : $category->name}}</h1>
            </div>
        </div>
        <div class="container">
            <div class="row mb-8 rtl">

                <div class="d-block d-xl-none col-xl-3 col-wd-2gdot5">

                    <div class="accordion" id="accordionExample">
                        <div class="card-filter">
                            <div class="card-header-filter" id="headingOne">
                                    <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                        <b> بحث متقدم<i class="fa fa-filter" aria-hidden="true"></i>  </b>
                                    </button>
                            </div>
                            <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample">
                                @if(!is_company())
                                    <div class="mb-6">
                                        <div class="range-slider bg-gray-3 p-3">
                                            <h4 class="font-size-14 mb-3 font-weight-bold">{{__('general.price')}}</h4>
                                            <!-- Range Slider -->
                                            <input class="js-range-slider" type="text"
                                                   data-extra-classes="u-range-slider u-range-slider-indicator u-range-slider-grid"
                                                   data-type="double" data-grid="false" data-hide-from-to="true" data-prefix="{{ getCurrency('symbol') }}"
                                                   data-min="{{$minPrice}}" data-max="{{$maxPrice}}" data-from="{{$minPrice}}" data-to="{{$maxPrice}}"
                                                   data-result-min="#rangeSliderExample3MinResultCategory" data-result-max="#rangeSliderExample3MaxResultCategory">
                                            <!-- End Range Slider -->
                                            <div class="mt-1 text-gray-111 d-flex mb-4">
                                                <span class="mr-0dot5">{{__('general.price')}}: </span>
                                                <span>{{ getCurrency('symbol') }} </span>
                                                <span id="rangeSliderExample3MinResultCategory">{{$minPrice}}</span>
                                                <span class="mx-0dot5"> — </span>
                                                <span>{{ getCurrency('symbol') }} </span>
                                                <span id="rangeSliderExample3MaxResultCategory">{{$maxPrice}}</span>
                                            </div>
                                            <button class="btn px-4 btn-primary-dark-w py-2 rounded-lg text-white" id="priceFilterBtn">{{__('general.search_button')}}</button>
                                        </div>
                                    </div>
                                @endif
                                @foreach($category->attributes as $attribute)
                                    <div class="mb-6">
                                        <div class="border-bottom border-color-1 mb-5">
                                            <h3 class="section-title section-title__sm mb-0 pb-2 font-size-18">{{$attribute->key}}</h3>
                                        </div>
                                        <div class="border-bottom pb-4 mb-4 attr-container">
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
                                @if(count($category->getSiblings()))
                                <div class="mb-6">
                                    <div class="border-bottom border-color-1 mb-5">
                                        <h3 class="section-title section-title__sm mb-0 pb-2 font-size-18">{{__('general.categories')}}</h3>
                                    </div>
                                    <div class="border-bottom pb-4 mb-4 attr-container">
                                        @foreach($category->getSiblings() as $sibling)
                                            <div class="form-group d-flex align-items-center justify-content-between mb-2 pb-1">
                                                <div class="custom-control custom-checkbox">
                                                    <a @if($sibling->id == $category->id) style="font-weight: bold" @endif href="{{route('front.category', [generatedNestedSlug($sibling->ancestors()->pluck('slug')->toArray(), $sibling->slug)])}}" class="custom-control-label">{{$sibling->name}}
{{--                                                        <span class="text-gray-25 font-size-12 font-weight-norma3"> ({{count($sibling->products)}})</span>--}}
                                                    </a>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                                @endif
                                @if(count($tags))
                                    <div class="mb-6 d-none">
                                        <div class="border-bottom border-color-1 mb-5">
                                            <h3 class="section-title section-title__sm mb-0 pb-2 font-size-18">{{__('general.search_tags')}}</h3>
                                        </div>
                                        <div class="border-bottom pb-4 mb-4 attr-container">
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
                        </div>
                    </div>
                </div>

                <div class="d-none d-xl-block col-xl-3 col-wd-2gdot5">
                    @if(!is_company())
                    <div class="mb-6">
                        <div class="range-slider bg-gray-3 p-3">
                            <h4 class="font-size-14 mb-3 font-weight-bold">{{__('general.price')}}</h4>
                            <!-- Range Slider -->
                            <input class="js-range-slider" type="text"
                                   data-extra-classes="u-range-slider u-range-slider-indicator u-range-slider-grid"
                                   data-type="double" data-grid="false" data-hide-from-to="true" data-prefix="{{ getCurrency('symbol') }}"
                                   data-min="{{$minPrice}}" data-max="{{$maxPrice}}" data-from="{{$minPrice}}" data-to="{{$maxPrice}}"
                                   data-result-min="#rangeSliderExample3MinResultCategory"
                                   data-result-max="#rangeSliderExample3MaxResultCategory">
                            <!-- End Range Slider -->
                            <div class="mt-1 text-gray-111 d-flex mb-4">
                                <span class="mr-0dot5">{{__('general.price')}}: </span>
                                <span>{{ getCurrency('symbol') }} </span>
                                <span id="rangeSliderExample3MinResultCategory">{{$minPrice}}</span>
                                <span class="mx-0dot5"> — </span>
                                <span>{{ getCurrency('symbol') }} </span>
                                <span id="rangeSliderExample3MaxResultCategory">{{$maxPrice}}</span>
                            </div>
                            <button class="btn px-4 btn-primary-dark-w py-2 rounded-lg text-white" id="priceFilterBtn">{{__('general.search_button')}}</button>
                        </div>
                    </div>
                    @endif
                    @foreach($category->attributes as $attribute)
                    <div class="mb-6">
                        <div class="border-bottom border-color-1 mb-5">
                            <h3 class="section-title section-title__sm mb-0 pb-2 font-size-18">{{$attribute->key}}</h3>
                        </div>
                        <div class="border-bottom pb-4 mb-4 attr-container">
                            @foreach($attribute->values as $value)
                            <div class="form-group d-flex align-items-center justify-content-between mb-2 pb-1">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input filter-checkboxes" value="{{$value->id}}" id="{{$attribute->id . '_' . $value->id}}">
                                    <label class="custom-control-label" for="{{$attribute->id . '_' . $value->id}}">{{$value->value}}</label>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    @endforeach
                    @if(count($category->getSiblings()))
                    <div class="mb-6">
                        <div class="border-bottom border-color-1 mb-5">
                            <h3 class="section-title section-title__sm mb-0 pb-2 font-size-18">{{__('general.categories')}}</h3>
                        </div>
                        <div class="border-bottom pb-4 mb-4 attr-container">
                            @foreach($category->getSiblings() as $sibling)
                            <div class="form-group d-flex align-items-center justify-content-between mb-2 pb-1">
                                <div class="custom-control custom-checkbox">
                                    <a @if($sibling->id == $category->id) style="font-weight: bold" @endif href="{{route('front.category', [generatedNestedSlug($sibling->ancestors()->pluck('slug')->toArray(), $sibling->slug)])}}" class="custom-control-label">{{$sibling->name}}
{{--                                        <span class="text-gray-25 font-size-12 font-weight-norma3"> ({{count($sibling->products)}})</span>--}}
                                    </a>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    @endif
                    @if(count($tags))
                    <div class="mb-6 d-none">
                        <div class="border-bottom border-color-1 mb-5">
                            <h3 class="section-title section-title__sm mb-0 pb-2 font-size-18">{{__('general.search_tags')}}</h3>
                        </div>
                        <div class="border-bottom pb-4 mb-4 attr-container">
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

                <div class="col-xl-9 col-wd-9gdot5">
                    @if(count($category->children))
                    <div class="mb-6 bg-gray-7">
                        <div class="container">
                            <div class="row flex-nowrap flex-md-wrap overflow-auto overflow-md-visble rtl" style="padding-top: 15px">
                                @foreach($category->children as $child)
                                    <div class="col-md-4 col-lg-3 col-xl-4 col-xl-2gdot4 mb-3 flex-shrink-0 flex-md-shrink-1">
                                        <div class="bg-white overflow-hidden shadow-on-hover h-100 d-flex align-items-center">
                                            <a href="{{route('front.category', [generatedNestedSlug($child->ancestors()->pluck('slug')->toArray(), $child->slug)])}}" class="d-block pr-2">
                                                <div class="media align-items-center">
                                                    <div class="pt-2">
                                                        <img class="img-fluid img_category_page" src="{{$child->getFirstMediaUrlOrDefault(CATEGORY_PATH)['url']}}"
                                                             alt="{{$child->getFirstMediaUrlOrDefault(CATEGORY_PATH)['alt']}}" title="{{$child->getFirstMediaUrlOrDefault(CATEGORY_PATH)['title']}}">
                                                    </div>
                                                    <div class="ml-3 media-body">
                                                        <h2 class="mb-0 text-gray-90" style="font-size: 1rem;">{{$child->name}}</h2>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    @endif
                    <div id="productsContainer">
                        @include('front.category.productsContainer', ['category' => $category, 'products' => $products])
                    </div>
                </div>
            </div>
        </div>
    </div>
    @if(is_individual())
        @include('front.layouts.partials.change_city')
    @endif
@endsection
@section('extraScripts')
    @include('front.layouts.partials.filter')
@endsection
