@if($view == 'grid')
<div class="product-item__outer h-100">
    <div class="product-item__inner">
        <div class="product-item__body">
            <div class="mb-2 px-2">
                <a href="{{route('front.product', [generatedNestedSlug($product->category->ancestors()->pluck('slug')->toArray(), $product->category->slug), $product->slug])}}" class="d-block text-center">
                    <img loading="lazy" class="img-fluid" src="{{$product->getFirstMediaUrlOrDefault(PRODUCT_PATH, 'size_150_150')['url']}}" alt="{{$product->getFirstMediaUrlOrDefault(PRODUCT_PATH)['alt']}}" title="{{ $product->getFirstMediaUrlOrDefault(PRODUCT_PATH)['title'] }}">
                </a>
            </div>
            {{--  
            <div class="mb-2 px-2"><a href="{{route('front.category', [generatedNestedSlug($product->category->ancestors()->pluck('slug')->toArray(), $product->category->slug)])}}" class="font-size-12 text-gray-5">{{$product->category->name}}</a></div>
           --}}
            <h5 class="mb-1 product-item__title px-2">
                <a href="{{route('front.product', [generatedNestedSlug($product->category->ancestors()->pluck('slug')->toArray(), $product->category->slug), $product->slug])}}" class="text-blue font-weight-bold">
                    {{ Str::limit($product->name, 72) }}
                </a>
            </h5>
            <div class="mb-3">
                <a class="d-inline-flex align-items-center small font-size-14">
                    <div class="text-warning mr-2">
                        @for($i=1;$i<=$product->rate;$i++)
                            <small class="fas fa-star"></small>
                        @endfor
                        @for($i=5;$i>$product->rate;$i--)
                            <small class="fas fa-star" style="color: #bfbfbf;"></small>
                        @endfor
                    </div>
                    <span class="text-secondary">(40)</span>
                </a>
            </div>
{{--            
            <div class="font-size-12 productDesc px-2 pb-2 mb-2">{{ Str::limit(strip_tags($product->short_desc), 107) }}</div>    
            <div class="text-gray-20 mb-2 font-size-12">{{__('general.sku')}}: {{$product->SKU}}</div>
--}}
            <div class="custom-price-border px-2 pb-2 mb-2">
{{--
                @if(auth()->guard('admin')->check() && isset($product->vendor))
                    <div class="text-gray-20 font-size-12" title="{{$product->vendor->name}}">{{__('general.vendor')}}: {{\Str::limit($product->vendor->name, 20)}}</div>
                @endif
                @if(!$product->category->hide_availability)
                    <div class="font-size-14">
                        @if(is_company())
                            <span class="text-green font-weight-bold">{{__('product.in_stock')}}</span>
                        @else
                            @if($product->stock && $product->stock >= $product->min_quantity)
                                <span class="text-green font-weight-bold">{{__('product.in_stock')}}</span>
                            @else
                                <span class="text-red font-weight-bold">{{__('product.out_of_stock')}}</span>
                            @endif
                        @endif
                    </div>
                @endif
                @if(!$product->category->hide_delivery_status)
                    @if(!is_company())
                        @if(isset($product->delivery))
                            <div>{{__('product.delivery_to_your_city_in_category')}}: <b>{{getCurrentCityName()}}</b></div>
                        @else
                            <div style="color:#ff0000;">{{__('product.no_delivery_in_category')}}: {{getCurrentCityName()}}</div>
                        @endif
                    @endif
                @endif
 --}}              
                @if($product->type == 'product' && $product->price)
                <div style="/*min-height: 100px*/" class="product-price">
                    <div>{{ $product->formatted_price}} {{getCurrency('symbol')}} </div>
                </div>
                @endif
            </div>
{{--
            <div class="px-2">
                {!! cartOrChat($product, false) !!}
            </div>
--}}
        </div>
        @if(!Auth::guard('vendor')->check())
            <div class="product-item__footer px-2">
                <div class="border-top py-2 flex-center-between flex-wrap">
                    <a data-url="{{ route('wishlist.add', ['product' => $product]) }}" class="text-gray-6 font-size-13 btn-add-wishlist pointer"><i class="ec ec-favorites mr-1 font-size-15"></i> {{__('product.wishlist')}}</a>
                </div>
            </div>
        @endif
    </div>
</div>
@endif