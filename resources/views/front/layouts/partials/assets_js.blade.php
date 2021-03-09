<!-- JS Global Compulsory -->
<script src="{{front_url()}}/assets/vendor/jquery/dist/jquery.min.js"></script>
<script src="{{front_url()}}/assets/vendor/jquery-migrate/dist/jquery-migrate.min.js"></script>
<script src="{{front_url()}}/assets/vendor/popper.js/dist/umd/popper.min.js"></script>
<script src="{{front_url()}}/assets/vendor/bootstrap/bootstrap.min.js"></script>

<!-- JS Implementing Plugins -->
<script src="{{front_url()}}/assets/vendor/appear.js"></script>
<script src="{{front_url()}}/assets/vendor/jquery.countdown.min.js"></script>
<script src="{{front_url()}}/assets/vendor/hs-megamenu/src/hs.megamenu.js"></script>
<script src="{{front_url()}}/assets/vendor/svg-injector/dist/svg-injector.min.js"></script>
<script src="{{front_url()}}/assets/vendor/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.concat.min.js"></script>
<script src="{{front_url()}}/assets/vendor/jquery-validation/dist/jquery.validate.min.js"></script>
<script src="{{front_url()}}/assets/vendor/fancybox/jquery.fancybox.min.js"></script>
<script src="{{front_url()}}/assets/vendor/ion-rangeslider/js/ion.rangeSlider.min.js"></script>
<script src="{{front_url()}}/assets/vendor/typed.js/lib/typed.min.js"></script>
<script src="{{front_url()}}/assets/vendor/slick-carousel/slick/slick.js"></script>
<script src="{{front_url()}}/assets/vendor/appear.js"></script>
<script src="{{front_url()}}/assets/vendor/bootstrap-select/dist/js/bootstrap-select.min.js"></script>

<!-- JS Electro -->
<script src="{{front_url()}}/assets/js/hs.core.js"></script>
<script src="{{front_url()}}/assets/js/components/hs.countdown.js"></script>
<script src="{{front_url()}}/assets/js/components/hs.header.js"></script>
<script src="{{front_url()}}/assets/js/components/hs.hamburgers.js"></script>
<script src="{{front_url()}}/assets/js/components/hs.unfold.js"></script>
<script src="{{front_url()}}/assets/js/components/hs.focus-state.js"></script>
<script src="{{front_url()}}/assets/js/components/hs.malihu-scrollbar.js"></script>
<script src="{{front_url()}}/assets/js/components/hs.validation.js"></script>
<script src="{{front_url()}}/assets/js/components/hs.fancybox.js"></script>
<script src="{{front_url()}}/assets/js/components/hs.onscroll-animation.js"></script>
<script src="{{front_url()}}/assets/js/components/hs.slick-carousel.js"></script>
<script src="{{front_url()}}/assets/js/components/hs.quantity-counter.js"></script>
<script src="{{front_url()}}/assets/js/components/hs.range-slider.js"></script>
<script src="{{front_url()}}/assets/js/components/hs.show-animation.js"></script>
<script src="{{front_url()}}/assets/js/components/hs.svg-injector.js"></script>
<script src="{{front_url()}}/assets/js/components/hs.scroll-nav.js"></script>
<script src="{{front_url()}}/assets/js/components/hs.go-to.js"></script>
<script src="{{front_url()}}/assets/js/components/hs.selectpicker.js"></script>

<!-- Toastr JS -->
<script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>

@include('front.layouts.partials.alerts')

<!-- JS Plugins Init. -->
<script>
    $(window).on('load', function () {
        // initialization of HSMegaMenu component
        $('.js-mega-menu').HSMegaMenu({
            event: 'hover',
            direction: 'horizontal',
            pageContainer: $('.container'),
            breakpoint: 767.98,
            hideTimeOut: 0
        });
    });

    function doTheMagic(url) {
        let searchRegionGrid = $("#searchRegionGrid"),
            searchRegionList = $("#searchRegionList"),
            searchFilterSpan = $("#searchFilterSpan"),
            searchButtonSpan = $("#searchButtonSpan"),
            attributesRegion = $("#attributeRegion");

        searchFilterSpan.addClass('spinner-border text-success');
        searchFilterSpan.html('');
        searchButtonSpan.removeClass('ec ec-search font-size-24');
        searchButtonSpan.addClass('spinner-border text-success');

        $.ajax({
            url: url,
            type: 'GET'
        })
        .done(function(response) {
            if(response['products'].length > 0) {
                let tags = [];

                //Clear the previous search results
                searchRegionGrid.html('');
                searchRegionList.html('');

                $.each(response['products'], function (key, value) {
                    if(value.tags.length > 0)
                        tags.push(value.tags);

                    $("#searchRegionGrid").append(`
                    <li class="col-6 col-md-3 col-wd-2gdot4 product-item">
                    <div class="product-item__outer h-100">
                        <div class="product-item__inner px-xl-4 p-3">
                            <div class="product-item__body pb-xl-2">
                                <div class="mb-2"><a href="{{ env('APP_URL') }}/en/category/${value.sub_category.category.slug}/${value.sub_category.slug}" class="font-size-12 text-gray-5">${value.sub_category.name.{{ \Mcamara\LaravelLocalization\Facades\LaravelLocalization::getCurrentLocale() }}}</a></div>
                                <h5 class="mb-1 product-item__title"><a href="{{ env('APP_URL') }}/en/product/${value.slug}" class="text-blue font-weight-bold">${value.name.{{ \Mcamara\LaravelLocalization\Facades\LaravelLocalization::getCurrentLocale() }}}</a></h5>
                                <div class="mb-2">
                                    <a href="{{ env('APP_URL') }}/en/product/${value.slug}" class="d-block text-center">
                                        <img class="img-fluid" src="${value.image_url.url}" alt="${value.image_url.alt}" title="${value.image_url.title}">
                                    </a>
                                </div>
                                <div class="flex-center-between mb-1">
                                    <div class="prodcut-price">
                                        <div class="text-gray-100">{{ getCurrency('code') }} ${value.price}</div>
                                    </div>
                                    <div class="d-none d-xl-block prodcut-add-cart">
                                        <button data-url="{{ env('APP_URL') }}/en/cart/add/${value.id}" class="btn-add-cart btn-primary transition-3d-hover"><i class="ec ec-add-to-cart"></i></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </li>
                `);
                $("#searchRegionList").append(`
                    <li class="product-item remove-divider">
                        <div class="product-item__outer w-100">
                            <div class="product-item__inner remove-prodcut-hover py-4 row">
                                <div class="product-item__header col-6 col-md-2">
                                    <div class="mb-2">
                                        <a href="{{ env('APP_URL') }}/en/product/${value.slug}" class="d-block text-center">
                                            <img class="img-fluid" src="${value.image_url.url}" alt="${value.image_url.alt}" title="${value.image_url.title}">
                                        </a>
                                    </div>
                                </div>
                                <div class="product-item__body col-6 col-md-10">
                                    <div class="pr-lg-10">
                                        <div class="mb-2"><a href="{{ env('APP_URL') }}/en/category/${value.sub_category.category.slug}/${value.sub_category.slug}" class="font-size-12 text-gray-5">${value.sub_category.name.{{ \Mcamara\LaravelLocalization\Facades\LaravelLocalization::getCurrentLocale() }}}</a></div>
                                        <h5 class="mb-2 product-item__title"><a href="{{ env('APP_URL') }}/en/product/${value.slug}" class="text-blue font-weight-bold">${value.name.{{ \Mcamara\LaravelLocalization\Facades\LaravelLocalization::getCurrentLocale() }}}</a></h5>

                                        <div class="mb-2 flex-center-between">
                                            <div class="prodcut-price">
                                                <div class="text-gray-100">{{ getCurrency('code') }} ${value.price}</div>
                                            </div>
                                            <div class="prodcut-add-cart">
                                                <button data-url="{{ env('APP_URL') }}/en/cart/add/${value.id}" class="btn-add-cart btn-primary transition-3d-hover"><i class="ec ec-add-to-cart"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </li>
                `);
                })
                if(tags.length > 0 && tags[0].length > 0) {
                    attributesRegion.html(`<div class="border-bottom pb-4 mb-4">
                                    <h4 class="font-size-14 mb-3 font-weight-bold">Tags</h4>`);

                    $.each(tags[0], function(key, value) {
                        attributesRegion.append(`<div class="form-group d-flex align-items-center justify-content-between mb-2 pb-1">
                                                        <div class="custom-control custom-checkbox">
                                                            <input type="checkbox" class="custom-control-input tag" value="${ value.id }" id="tag-${value.id}">
                                                            <label class="custom-control-label" for="tag-${value.id}">${value.name.{{ \Mcamara\LaravelLocalization\Facades\LaravelLocalization::getCurrentLocale() }}} <span class="text-gray-25 font-size-12 font-weight-normal"> (${tags.length})</span></label>
                                                        </div>
                                                    </div>`);
                    });
                    attributesRegion.append(`</div>`);
                }
                $("#priceRegion").html(`
                    <!-- Range Slider -->
                    <input class="js-range-slider" type="text"
                           data-extra-classes="u-range-slider u-range-slider-indicator u-range-slider-grid"
                           data-type="double"
                           data-grid="false"
                           data-hide-from-to="true"
                           data-prefix="{{ getCurrency('code') }}"
                           data-min="0"
                           data-max="${response.maxPrice}"
                           data-from="0"
                           data-to="${response.maxPrice}"
                           data-result-min="#rangeSliderExample3MinResult"
                           data-result-max="#rangeSliderExample3MaxResult">
                    <!-- End Range Slider -->
                    <div class="mt-1 text-gray-111 d-flex mb-4">
                        <span class="mr-0dot5">{{ __('Price: ') }} </span>
                        <span> {{ getCurrency('code') }}</span>
                        <span id="rangeSliderExample3MinResult" class=""></span>
                        <span class="mx-0dot5"> — </span>
                        <span> {{ getCurrency('code') }}</span>
                        <span id="rangeSliderExample3MaxResult" class="">${response.maxPrice}</span>
                    </div>
                `);
                $.HSCore.components.HSRangeSlider.init('.js-range-slider');
                //Show the div
                $("#searchDiv").removeClass('d-none');
                searchFilterSpan.removeClass('spinner-border text-success');
                searchFilterSpan.html('{{ __('Filter') }}');
                searchButtonSpan.removeClass('spinner-border text-success');
                searchButtonSpan.addClass('ec ec-search font-size-24');
            }
            else {
                searchFilterSpan.removeClass('spinner-border text-success');
                searchFilterSpan.html('{{ __('Filter') }}');
                searchButtonSpan.removeClass('spinner-border text-success');
                searchButtonSpan.addClass('ec ec-search font-size-24');
                toastr.error('{{ __('Could not find records that match your criteria') }}');
            }
        });
    }

    $(document).on('ready', function () {
        // initialization of header
        $.HSCore.components.HSHeader.init($('#header'));

        // initialization of animation
        $.HSCore.components.HSOnScrollAnimation.init('[data-animation]');

        // initialization of unfold component
        $.HSCore.components.HSUnfold.init($('[data-unfold-target]'), {
            afterOpen: function () {
                $(this).find('input[type="search"]').focus();
            }
        });

        // initialization of popups
        $.HSCore.components.HSFancyBox.init('.js-fancybox');

        // initialization of countdowns
        var countdowns = $.HSCore.components.HSCountdown.init('.js-countdown', {
            yearsElSelector: '.js-cd-years',
            monthsElSelector: '.js-cd-months',
            daysElSelector: '.js-cd-days',
            hoursElSelector: '.js-cd-hours',
            minutesElSelector: '.js-cd-minutes',
            secondsElSelector: '.js-cd-seconds'
        });

        // initialization of malihu scrollbar
        $.HSCore.components.HSMalihuScrollBar.init($('.js-scrollbar'));

        // initialization of forms
        $.HSCore.components.HSFocusState.init();

        // initialization of form validation
        $.HSCore.components.HSValidation.init('.js-validate', {
            rules: {
                confirmPassword: {
                    equalTo: '#signupPassword'
                }
            }
        });

        // initialization of forms
        $.HSCore.components.HSRangeSlider.init('.js-range-slider');


        // initialization of show animations
        $.HSCore.components.HSShowAnimation.init('.js-animation-link');

        // initialization of fancybox
        $.HSCore.components.HSFancyBox.init('.js-fancybox');

        // initialization of slick carousel
        $.HSCore.components.HSSlickCarousel.init('.js-slick-carousel');

        // initialization of go to
        $.HSCore.components.HSGoTo.init('.js-go-to');

        // initialization of hamburgers
        $.HSCore.components.HSHamburgers.init('#hamburgerTrigger');

        // initialization of unfold component
        $.HSCore.components.HSUnfold.init($('[data-unfold-target]'), {
            beforeClose: function () {
                $('#hamburgerTrigger').removeClass('is-active');
            },
            afterClose: function() {
                $('#headerSidebarList .collapse.show').collapse('hide');
            }
        });

        $('#headerSidebarList [data-toggle="collapse"]').on('click', function (e) {
            e.preventDefault();

            var target = $(this).data('target');

            if($(this).attr('aria-expanded') === "true") {
                $(target).collapse('hide');
            } else {
                $(target).collapse('show');
            }
        });

        // initialization of unfold component
        $.HSCore.components.HSUnfold.init($('[data-unfold-target]'));

        // initialization of select picker
        $.HSCore.components.HSSelectPicker.init('.js-select');

        //HANDLE SEARCH HERE
        $(document).on('click', '#searchProductBtn', function(e) {
            e.preventDefault();
            let searchText = $("#searchProductInput").val();

            doTheMagic("{{ route('products.search') }}?filter[name]=" + searchText);
        });

        $(document).on('click', '#searchFilterBtn', function() {
            let priceFrom = $("#rangeSliderExample3MinResult").html(),
                priceTo = $("#rangeSliderExample3MaxResult").html(),
                searchText = $("#searchProductInput").val(),
                tagsCheckboxes = $(".tag:checkbox"),
                checkedTags = '';

            tagsCheckboxes.each(function() {
                let checkBoxItem = (this.checked ? $(this).val() : "");

                if(checkBoxItem.length > 0)
                    checkedTags += checkBoxItem + ',';
            })

            checkedTags.replace(/, \s*$/, "");

            doTheMagic(`{{ route('products.search') }}?filter[name]=${searchText}&filter[price_from]=${priceFrom}&filter[price_to]=${priceTo}&filter[has_tags]=${checkedTags}`);
        });

        $(document).on('search', '#searchProductInput', function() {
            let searchText = $("#searchProductInput").val();

            if(searchText.length > 2)
                doTheMagic("{{ route('products.search') }}?filter[name]=" + searchText);
        });

        //HANDLE CART
        $(document).on('click', '.btn-add-cart', function(){
            let url = $(this).data('url');

            $.ajax({
                type: 'POST',
                url: url,
                data: { _token: '{{ csrf_token() }}' }
            })
                .done(function(response) {
                    $('.cartCount').html(response.count);
                    $('.cartTotal').html(response.total);
                    toastr.success(response.message);
                })
                .fail(function(response) {
                    toastr.error(response);
                })
        });

        //WISHLIST
        $(".btn-add-wishlist").on('click', function(){
            let url = $(this).data('url');

            $.ajax({
                type: 'POST',
                url: url,
                data: { _token: '{{ csrf_token() }}' }
            })
                .done(function(response) {
                    if(response.status)
                        toastr.success(response.message);
                    else
                        toastr.warning(response.message)
                })
                .fail(function(response) {
                    toastr.error(response.responseJSON.message ?? {{ __('Error') }});
                })
        });
    });

    // initialization of quantity counter
    $.HSCore.components.HSQantityCounter.init('.js-quantity');

    var nav = $('.nav_fixed');
    $(window).scroll(function () {
        if ($(this).scrollTop() > 100) {
            nav.addClass("fixed-header");
        } else {
            nav.removeClass("fixed-header");
        }
    });

    const actualBtn = document.getElementById('actual-btn');

    const fileChosen = document.getElementById('file-chosen');

    actualBtn.addEventListener('change', function(){
        fileChosen.textContent = this.files[0].name
    })

    ( function ( document, window, index ) {
        var inputs = document.querySelectorAll( '.inputfile' );
        Array.prototype.forEach.call( inputs, function( input )
        {
            var label	 = input.nextElementSibling,
                labelVal = label.innerHTML;

            input.addEventListener( 'change', function( e )
            {
                var fileName = '';
                if( this.files && this.files.length > 1 )
                    fileName = ( this.getAttribute( 'data-multiple-caption' ) || '' ).replace( '{count}', this.files.length );
                else
                    fileName = e.target.value.split( '\\' ).pop();

                if( fileName )
                    label.querySelector( 'span' ).innerHTML = fileName;
                else
                    label.innerHTML = labelVal;
            });

            // Firefox bug fix
            input.addEventListener( 'focus', function(){ input.classList.add( 'has-focus' ); });
            input.addEventListener( 'blur', function(){ input.classList.remove( 'has-focus' ); });
        });
    }( document, window, 0 ));
</script>

@include('front.layouts.partials.ajax')
@yield('extraScripts')
