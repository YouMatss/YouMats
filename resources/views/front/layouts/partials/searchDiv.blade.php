<div class="container rtl" style="position: relative">
    <div class="close_search"><i class="fa fa-times"></i></div>
    <div class="h_scroll">
        <div class="container p-0">
            <div class="row">
                <div class="d-none d-xl-block col-xl-3 col-wd-2gdot5">
                    <div class="block_search_check">
                        <div id="attributeRegion">
                            @if(isset($search_categories))
                            <div class="border-bottom mb-4">
                                <h4 class="font-size-14 mb-3 font-weight-bold text-left">{{__('search.categories_title')}}</h4>
                                @foreach(array_slice($search_categories, 0, 5) as $search_category)
                                <div class="form-group d-flex align-items-center justify-content-between mb-2 pb-1">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input category" value="{{$search_category->id}}" @if(in_array($search_category->id, $selected_categories)) checked @endif id="cat-{{$search_category->id}}">
                                        <label class="custom-control-label" for="cat-{{$search_category->id}}">{{$search_category->name}}</label>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                            @endif
                            @if(isset($search_tags))
                            <div class="border-bottom mb-4">
                                <h4 class="font-size-14 mb-3 font-weight-bold text-left">{{__('search.tags_title')}}</h4>
                                @foreach($search_tags as $search_tag)
                                <div class="form-group d-flex align-items-center justify-content-between mb-2 pb-1">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input tag" value="{{$search_tag->id}}" @if(in_array($search_tag->id, $selected_tags)) checked @endif id="tag-{{$search_tag->id}}">
                                        <label class="custom-control-label" for="tag-{{$search_tag->id}}">{{$search_tag->name}}</label>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                            @endif
                        </div>
                        <div class="range-slider">
                            <h4 class="font-size-14 mb-3 font-weight-bold text-left">{{__('search.price_title')}}</h4>
                            <div id="priceRegion">
                                <!-- Range Slider -->
                                <input class="js-range-slider" type="text"
                                       data-extra-classes="u-range-slider u-range-slider-indicator u-range-slider-grid"
                                       data-type="double"
                                       data-grid="false"
                                       data-hide-from-to="true"
                                       data-prefix="{{ getCurrency('symbol') }}"
                                       data-min="0"
                                       data-max="{{($max_price) ?? 0}}"
                                       data-from="0"
                                       data-to="{{($max_price) ?? 0}}"
                                       data-result-min="#rangeSliderExample3MinResult"
                                       data-result-max="#rangeSliderExample3MaxResult">
                                <!-- End Range Slider -->
                                <div class="mt-1 text-gray-111 d-flex mb-4">
                                    <span class="mr-0dot5">{{__('search.price_slider')}} </span>
                                    <span> {{ getCurrency('symbol') }} </span>
                                    <span id="rangeSliderExample3MinResult"></span>
                                    <span class="mx-0dot5"> — </span>
                                    <span> {{ getCurrency('symbol') }} </span>
                                    <span id="rangeSliderExample3MaxResult">{{($max_price) ?? 0}}</span>
                                </div>
                            </div>
                            <button type="submit" class="btn px-4 btn-primary-dark-w py-2 rounded-lg text-white" id="searchFilterBtn"><span> {{ __('search.button') }}</span></button>
                        </div>
                    </div>
                </div>
                <div class="col-xl-9 col-wd-9gdot5">
                    <div class="view_type_header">
                        <div class="px-3 d-none d-xl-block">
                            <ul class="nav nav-tab-shop" id="pills-tab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="pills-one-example1-tab" data-toggle="pill" href="#pills-one-example1" role="tab" aria-controls="pills-one-example1" aria-selected="false">
                                        <div class="d-md-flex justify-content-md-center align-items-md-center">
                                            <i class="fa fa-th"></i>
                                        </div>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="block_search_check">
                        <div class="tab-content" id="pills-tabContent">
                            <div class="tab-pane fade pt-2 show active" id="pills-one-example1" role="tabpanel" aria-labelledby="pills-one-example1-tab" data-target-group="groups">
                                <ul class="row list-unstyled products-group no-gutters" id="searchRegionGrid">
                                    @if(isset($search_products))
                                        @forelse($search_products as $search_product)
                                            <div class="col-6 col-md-3 col-wd-2gdot4 product-item">
                                                @include('front.layouts.partials.product_box', ['product' => $search_product, 'view' => 'grid'])
                                            </div>
                                        @empty
                                            <div class="alert alert-warning col-12 pl-2 text-left">{{ __('search.no_records') }}</div>
                                        @endforelse
                                    @endif
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
