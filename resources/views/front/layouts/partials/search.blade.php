<script>
let timer, timeoutVal = 200;

function doTheMagic(url, callback = 'default') {
    let searchRegionGrid = $("#searchRegionGrid"),
        searchRegionList = $("#searchRegionList"),
        searchFilterSpan = $("#searchFilterSpan"),
        searchButtonSpan = $("#searchButtonSpan"),
        attributesRegion = $("#attributeRegion");

    searchFilterSpan.addClass('spinner-border text-success');
    searchFilterSpan.html('');
    searchButtonSpan.removeClass('ec ec-search font-size-24');
    searchButtonSpan.addClass('spinner-border text-success');

    url += '&include=tags,tagsCount,category,categoryCount';

    $.ajax({
        url: url,
        type: 'GET'
    })
    .done(function(response) {
        if(response['products'].length > 0) {
            let tags             = {},
                categories   = {};

            //Clear the previous search results
            searchRegionGrid.html('');
            searchRegionList.html('');

            $.each(response['products'], function (key, value) {
                if(value.tags.length > 0)
                    tags[value.tags[0].id] = value.tags;
                categories[value.category_id] = value.category;

                searchRegionGrid.append(`
                    <li class="col-6 col-md-3 col-wd-2gdot4 product-item">
                    <div class="product-item__outer h-100">
                        <div class="product-item__inner px-xl-4 p-3">
                            <div class="product-item__body pb-xl-2">
                                <div class="mb-2"><a href="{{ env('APP_URL') }}/i/${value.category.slug}" class="font-size-12 text-gray-5">${value.category.name}</a></div>
                                <h5 class="mb-1 product-item__title"><a title="${value.name.{{ \Mcamara\LaravelLocalization\Facades\LaravelLocalization::getCurrentLocale() }}}" href="{{ env('APP_URL') }}/i/${value.category.slug}/${value.slug}" class="text-blue font-weight-bold">${value.name.{{ \Mcamara\LaravelLocalization\Facades\LaravelLocalization::getCurrentLocale() }}}</a></h5>
                                <div class="mb-2">
                                    <a href="{{ env('APP_URL') }}/i/${value.category.slug}/${value.slug}" class="d-block text-center">
                                        <img class="img-fluid" src="${value.image_url.url}" alt="${value.image_url.alt}" title="${value.image_url.title}">
                                    </a>
                                </div>
                                <div class="flex-center-between mb-1">
                                    <div class="product-price searchPrice-${value.id}">
                                        <div class="text-gray-100">{{ getCurrency('symbol') }} ${value.price}</div>
                                    </div>
                                    <div class="d-none d-xl-block product-add-cart searchCartDiv-${value.id}">
                                        <button data-url="{{ env('APP_URL') }}/cart/add/${value.id}" class="btn-add-cart btn-primary transition-3d-hover"><i class="ec ec-add-to-cart"></i></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </li>`);
                searchRegionList.append(`
                <li class="product-item remove-divider">
                    <div class="product-item__outer w-100">
                        <div class="product-item__inner remove-prodcut-hover py-4 row">
                            <div class="product-item__header col-6 col-md-2">
                                <div class="mb-2">
                                    <a href="{{ env('APP_URL') }}/i/${value.category.slug}/${value.slug}" class="d-block text-center">
                                        <img class="img-fluid" src="${value.image_url.url}" alt="${value.image_url.alt}" title="${value.image_url.title}">
                                    </a>
                                </div>
                            </div>
                            <div class="product-item__body col-6 col-md-10">
                                <div class="pr-lg-10">
                                    <div class="mb-2"><a href="{{ env('APP_URL') }}/i/${value.category.slug}" class="font-size-12 text-gray-5">${value.category.name}</a></div>
                                    <h5 class="mb-2 product-item__title"><a href="{{ env('APP_URL') }}/i/${value.category.slug}/${value.slug}" class="text-blue font-weight-bold">${value.name.{{ \Mcamara\LaravelLocalization\Facades\LaravelLocalization::getCurrentLocale() }}}</a></h5>

                                    <div class="mb-2 flex-center-between">
                                        <div class="prodcut-price searchPrice-${value.id}">
                                            <div class="text-gray-100">{{ getCurrency('symbol') }} ${value.price}</div>
                                        </div>
                                        <div class="prodcut-add-cart searchCartDiv-${value.id}">
                                            <button data-url="{{ env('APP_URL') }}/cart/add/${value.id}" class="btn-add-cart btn-primary transition-3d-hover"><i class="ec ec-add-to-cart"></i></button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </li>
            `);

                if(value.price === 0 || value.type === 'service') {
                    $(`.searchCartDiv-${value.id}`).remove();
                    $(`.searchPrice-${value.id}`).remove();
                }
            })

            if(callback !== 'filter') {
                attributesRegion.html(`<div class="border-bottom mb-4">
                            <h4 class="font-size-14 mb-3 font-weight-bold">{{__('general.search_category')}}</h4>`);

                $.each(categories, function(key, value) {
                    attributesRegion.append(`<div class="form-group d-flex align-items-center justify-content-between mb-2 pb-1">
                                                <div class="custom-control custom-checkbox">
                                                    <input type="checkbox" class="custom-control-input category" value="${ value.id }" id="tag-${value.id}">
                                                    <label class="custom-control-label" for="tag-${value.id}">${value.name}</label>
                                                </div>
                                            </div>`);
                });
                attributesRegion.append(`</div>`);

                attributesRegion.append(`<div class="border-bottom mb-4">
                            <h4 class="font-size-14 mb-3 font-weight-bold">{{__('general.search_tags')}}</h4>`);

                $.each(tags, function(key, value) {
                    attributesRegion.append(`<div class="form-group d-flex align-items-center justify-content-between mb-2 pb-1">
                                                <div class="custom-control custom-checkbox">
                                                    <input type="checkbox" class="custom-control-input tag" value="${ value[0].id }" id="tag-${value[0].id}">
                                                    <label class="custom-control-label" for="tag-${value[0].id}">${value[0].name}</label>
                                                </div>
                                            </div>`);
                });
                attributesRegion.append(`</div>`);

                $("#priceRegion").html(`
                    <!-- Range Slider -->
                    <input class="js-range-slider" type="text"
                           data-extra-classes="u-range-slider u-range-slider-indicator u-range-slider-grid"
                           data-type="double"
                           data-grid="false"
                           data-hide-from-to="true"
                           data-prefix="{{ getCurrency('symbol') }}"
                           data-min="0"
                           data-max="${response.maxPrice}"
                           data-from="0"
                           data-to="${response.maxPrice}"
                           data-result-min="#rangeSliderExample3MinResult"
                           data-result-max="#rangeSliderExample3MaxResult">
                    <!-- End Range Slider -->
                    <div class="mt-1 text-gray-111 d-flex mb-4">
                        <span class="mr-0dot5">{{ __('general.search_price') }} </span>
                        <span> {{ getCurrency('symbol') }}</span>
                        <span id="rangeSliderExample3MinResult" class=""></span>
                        <span class="mx-0dot5"> — </span>
                        <span> {{ getCurrency('symbol') }}</span>
                        <span id="rangeSliderExample3MaxResult" class="">${response.maxPrice}</span>
                    </div>
                `);
                $.HSCore.components.HSRangeSlider.init('.js-range-slider');
            }
            //Show the div
            $("#searchDiv").removeClass('d-none');
            searchFilterSpan.removeClass('spinner-border text-success');
            searchFilterSpan.html('{{ __('general.search_button') }}');
            searchButtonSpan.removeClass('spinner-border text-success');
            searchButtonSpan.addClass('ec ec-search font-size-24');
        }
        else {
            //Show the div
            $("#searchDiv").removeClass('d-none');
            searchFilterSpan.removeClass('spinner-border text-success');
            searchFilterSpan.html('{{ __('general.search_button') }}');
            searchButtonSpan.removeClass('spinner-border text-success');
            searchButtonSpan.addClass('ec ec-search font-size-24');
            searchRegionList.html('{{ __('Could not find records that match your criteria') }}');
            searchRegionGrid.html('{{ __('Could not find records that match your criteria') }}');
        }
    });
}

$(document).on('ready', function () {
    //HANDLE SEARCH HERE
    $(document).on('click', '#searchProductBtn', function(e) {
        e.preventDefault();
        let searchText = $("#searchProductInput").val();

        doTheMagic("{{ route('products.search') }}?filter[name]=" + searchText);

        window.location.href = "{{ route('front.product.all') }}?search=" + searchText;
    });

    $(document).on('click', '#searchFilterBtn', function() {
        let priceFrom = $("#rangeSliderExample3MinResult").html(),
            priceTo = $("#rangeSliderExample3MaxResult").html(),
            searchText = $("#searchProductInput").val(),
            tagsCheckboxes = $(".tag:checkbox"),
            checkedTags = '',
            categoryCheckBoxes = $(".category:checkbox"),
            checkedCategories = '';

        tagsCheckboxes.each(function() {
            let checkBoxItem = (this.checked ? $(this).val() : "");

            if(checkBoxItem.length > 0)
                checkedTags += checkBoxItem + ',';
        })
        categoryCheckBoxes.each(function() {
            let checkBoxItem = (this.checked ? $(this).val() : "");

            if(checkBoxItem.length > 0)
                checkedCategories += checkBoxItem + ',';
        })

        checkedTags.replace(/, \s*$/, "");
        checkedCategories.replace(/, \s*$/, "");

        doTheMagic(`{{ route('products.search') }}?filter[name]=${searchText}&filter[price_from]=${priceFrom}&filter[price_to]=${priceTo}&filter[has_tags]=${checkedTags}&filter[has_categories]=${checkedCategories}`, 'filter');
    });

    $(document).on('keyup', '#searchProductInput', function(e) {
        window.clearTimeout(timer);
        if(e.which <= 90 && e.which >= 48) {
            timer = window.setTimeout(() => {
                let searchText = $("#searchProductInput").val();
                doTheMagic("{{ route('products.search') }}?filter[name]=" + searchText);
            }, timeoutVal)
        }
    });

    $(document).on('click', '.close_search', function() {
        $("#searchDiv").addClass('d-none');
    })

    $("#searchClassicInvoker").on('click', function() {
        $("#searchAndCartDiv").removeClass('d-none');
    })
});
</script>
