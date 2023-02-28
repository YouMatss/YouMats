<div class="container rtl" id="SearchInnerDiv" style="position: relative">
    <div class="h_scroll" style="margin: -50px -100px 0 0;padding: 0;">
        <div class="container p-0">
            <div class="row">
                <div class="col-xl-12 col-wd-12gdot5">
                    <div class="block_search_check">
                        <div class="tab-content" id="pills-tabContent">
                            <div class="tab-pane fade pt-1 show active" id="pills-one-example1" role="tabpanel" aria-labelledby="pills-one-example1-tab" data-target-group="groups">
                                <ul class="row list-unstyled products-group no-gutters" id="searchRegionGrid">

                                    @if(isset($suggested_products))
                                        @forelse($suggested_products as $search_product)
                                            <div class="col-12 col-md-12 col-wd-12gdot4 product-item">
                                                @include('front.layouts.partials.suggestion_box', ['product' => $search_product, 'view' => 'Suggestion'])
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
