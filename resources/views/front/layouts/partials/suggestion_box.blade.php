@if($view == 'Suggestion') 
<li class="product-item remove-divider" style="width: 100%;">
    <div class="product-item__outer w-100">
        <a href="{{ route('products.search') }}?filter[name]={{ $_GET['filter']['name'] }}&filter[has_categories]={{ $_GET['filter']['has_categories'] }}&filter[include]=tags,tagsCount,category,categoryCount">
            <div class="product-item__inner remove-prodcut-hover p-2 row">
                <div class="product-item__body col-9 col-md-9">
                    <div class="pr-lg-3">
                        <h5 class="product-item__title">
                            <div class="text-blue font-weight-bold" style="min-height: 0;">
                                {{ $product->name }}
                            </div>
                        </h5>
                    </div>
                </div>
                <div class="product-item__footer col-md-3 d-md-block">
                    <div class="flex-center-between">
                            <div class="font-size-12 text-gray-5">
                                {{ $product->category->name }}
                            </div>
                    </div>
                </div>
            </div>
        </a>
    </div>
</li>
@endif
