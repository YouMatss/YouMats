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
<script src="{{front_url()}}/assets/js/intlTelInput.min.js"></script>

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
<!-- moment -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.27.0/moment.min.js" integrity="sha512-rmZcZsyhe0/MAjquhTgiUcb4d9knaFc7b5xAfju483gbEXTkeJRUMIPk6s3ySZMYUHEcjKbjLjyddGWMrNEvZg==" crossorigin="anonymous"></script>
<script src="{{front_url()}}/assets/js/date.js"></script>

<!-- Toastr JS -->
<script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
<!-- Socket.io -->
<script src="https://cdn.socket.io/4.0.0/socket.io.min.js" integrity="sha384-DkkWv9oJFWLIydBXXjkBWnG1/fuVhw8YPBq37uvvD6WSYRFRqr21eY5Dg9ZhmWdy" crossorigin="anonymous"></script>

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
