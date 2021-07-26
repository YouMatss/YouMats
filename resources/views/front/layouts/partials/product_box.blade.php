@if($view == 'grid')
<div class="product-item__outer h-100">
    <div class="product-item__inner px-xl-2 p-3">
        <div class="product-item__body pb-xl-2">
            <div class="mb-2"><a href="{{route('front.category', [$product->category->slug])}}" class="font-size-12 text-gray-5">{{$product->category->name}}</a></div>
            <h5 class="mb-1 product-item__title">
                <a href="{{route('front.product', [$product->category->slug, $product->slug])}}" class="text-blue font-weight-bold">{{$product->name}}</a>
            </h5>
            <div class="mb-2">
                <a href="{{route('front.product', [$product->category->slug, $product->slug])}}" class="d-block text-center">
                    <img class="img-fluid" src="{{$product->getFirstMediaUrlOrDefault(PRODUCT_PATH)['url']}}" alt="{{$product->getFirstMediaUrlOrDefault(PRODUCT_PATH)['alt']}}" title="{{ $product->getFirstMediaUrlOrDefault(PRODUCT_PATH)['title'] }}">
                </a>
            </div>
            <div class="mb-3">
                <a class="d-inline-flex align-items-center small font-size-14">
                    <div class="text-warning mr-2">
                        @for($i=1;$i<=$product->rate;$i++)
                            <small class="fas fa-star"></small>
                        @endfor
                        @for($i=5;$i>$product->rate;$i--)
                            <small class="far fa-star text-muted"></small>
                        @endfor
                    </div>
                    {{--<span class="text-secondary">(40)</span>--}}
                </a>
            </div>
            <div class="font-size-12 p-0 text-gray-110 mb-4">
                <p class="mb-1">{!! $product->short_desc !!}</p>
            </div>
            <div class="text-gray-20 mb-2 font-size-12">SKU: {{$product->SKU}}</div>
            @if(auth()->guard('admin')->check())
                <div class="text-gray-20 mb-2 font-size-12">Vendor: {{$product->vendor->name}}</div>
            @endif
            <div class="flex-center-between mb-1">
                @if($product->type == 'product' && !is_company())
                    <div class="prodcut-price">
                        <div class="text-gray-100">{{getCurrency('symbol')}} {{$product->price}}</div>
                    </div>
                @endif
                {!! cartOrChat($product) !!}
            </div>
        </div>
        @if(!Auth::guard('vendor')->check())
            <div class="product-item__footer">
                <div class="border-top pt-2 flex-center-between flex-wrap">
                    <a data-url="{{ route('wishlist.add', ['product' => $product]) }}" class="text-gray-6 font-size-13 btn-add-wishlist pointer"><i class="ec ec-favorites mr-1 font-size-15"></i> Wishlist</a>
                </div>
            </div>
        @endif
    </div>
</div>
@elseif($view == 'list')
<li class="product-item remove-divider">
    <div class="product-item__outer w-100">
        <div class="product-item__inner remove-prodcut-hover py-4 row">
            <div class="product-item__header col-6 col-md-2">
                <div class="mb-2">
                    <a href="{{route('front.product', [$product->category->slug, $product->slug])}}" class="d-block text-center">
                        <img class="img-fluid" src="{{$product->getFirstMediaUrlOrDefault(PRODUCT_PATH)['url']}}" alt="{{$product->getFirstMediaUrlOrDefault(PRODUCT_PATH)['alt']}}" title="{{ $product->getFirstMediaUrlOrDefault(PRODUCT_PATH)['title'] }}">
                    </a>
                </div>
            </div>
            <div class="product-item__body col-6 col-md-7">
                <div class="pr-lg-10">
                    <div class="mb-2"><a href="{{route('front.category', [$product->category->slug])}}" class="font-size-12 text-gray-5">{{$product->category->name}}</a></div>
                    <h5 class="mb-2 product-item__title"><a href="{{route('front.product', [$product->category->slug, $product->slug])}}" class="text-blue font-weight-bold">{{$product->name}}</a></h5>
                    @if($product->type == 'product' && !is_company())
                        <div class="prodcut-price d-md-none">
                            <div class="text-gray-100">{{getCurrency('symbol')}} {{$product->price}}</div>
                        </div>
                    @endif
                    <div class="font-size-12 p-0 mb-4 d-none d-md-block">
                        {!! $product->short_desc !!}
                    </div>
                    <div class="text-gray-20 mb-2 font-size-12">SKU: {{$product->SKU}}</div>
                    @if(auth()->guard('admin')->check())
                        <div class="text-gray-20 mb-2 font-size-12">Vendor: {{$product->vendor->name}}</div>
                    @endif
                    <div class="mb-3 d-none d-md-block">
                        <a class="d-inline-flex align-items-center small font-size-14" href="#">
                            <div class="text-warning mr-2">
                                @for($i=1;$i<=$product->rate;$i++)
                                    <small class="fas fa-star"></small>
                                @endfor
                                @for($i=5;$i>$product->rate;$i--)
                                    <small class="far fa-star text-muted"></small>
                                @endfor
                            </div>
{{--                            <span class="text-secondary">(40)</span>--}}
                        </a>
                    </div>
                </div>
            </div>
            <div class="product-item__footer col-md-3 d-md-block">
                <div class="mb-2 flex-center-between">
                    @if($product->type == 'product' && !is_company())
                    <div class="prodcut-price">
                        <div class="text-gray-100">{{getCurrency('symbol')}} {{$product->price}}</div>
                    </div>
                    @endif
                    @if(!Auth::guard('vendor')->check())
                        <div class="flex-horizontal-center justify-content-between justify-content-wd-center flex-wrap border-top pt-3">
                            {!! cartOrChat($product) !!}
                            @if(Request::route()->getName() != 'wishlist.index')
                                <a data-url="{{ route('wishlist.add', ['product' => $product]) }}" class="text-gray-6 font-size-13 btn-add-wishlist pointer"><i class="ec ec-favorites mr-1 font-size-15"></i> Wishlist</a>
                            @else
                                <div class="prodcut-add-cart">
                                    <button data-url="{{ route('wishlist.remove', ['rowId' => $rowId]) }}" class="btn-remove-wishlist btn-danger transition-3d-hover"><i class="ec ec-close-remove"></i></button>
                                </div>
                            @endif
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</li>
@endif
