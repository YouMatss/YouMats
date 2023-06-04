<script src="{{mix('/assets/js/app.min.js')}}"></script>

<!-- moment -->
<script defer src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.27.0/moment.min.js" integrity="sha512-rmZcZsyhe0/MAjquhTgiUcb4d9knaFc7b5xAfju483gbEXTkeJRUMIPk6s3ySZMYUHEcjKbjLjyddGWMrNEvZg==" crossorigin="anonymous"></script>
<script defer src="{{front_url()}}/assets/js/date.js"></script>

<!-- Toastr JS -->
<script defer src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
<script defer>
    document.addEventListener('DOMContentLoaded', function() {
        toastr.options = {
            "positionClass": "toast-top-center",
        }
    });
</script>

<script defer>
    document.addEventListener('DOMContentLoaded', function() {
        @if(Session::has('custom_error'))
            toastr.error("{{ Session::get('custom_error') }}", "Error!");
        @endif
        @if(Session::has('custom_success'))
            toastr.success("{{ Session::get('custom_success') }}", "Success!");
        @endif
        @if(Session::has('custom_info'))
            toastr.info("{{ Session::get('custom_info') }}", "Info!");
        @endif
        @if(Session::has('custom_warning'))
            toastr.warning("{{ Session::get('custom_warning') }}", "Warning!");
        @endif
    });
</script>

<script>
    document.addEventListener('DOMContentLoaded', function() {

        $(document).on('click', '.typeIntroduceButton', function () {
            let url = $(this).data('url');
            $.ajax({
                type: 'GET',
                url: url
            })
                .done(function(response) {
                    if(response.status) {
                        location.reload();
                    }
                })
        });

        <!-- JS Plugins Init. -->
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
        $(document).on('click', '.btn-add-cart', function() {
            let url  = $(this).data('url'),
                delivery_url  = $(this).data('delivery-url'),
                btn = $(this);

            $.ajax({
                type: 'POST',
                url: delivery_url,
                data: {
                    _token: '{{ csrf_token() }}',
                    quantity: btn.parent().siblings().find('.cart-quantity').val()
                }
            }).done(function(response) {
                if(!response.status) {
                    if(confirm(response.message)) {
                        $.ajax({
                            type: 'POST',
                            url: url,
                            data: {
                                _token: '{{ csrf_token() }}',
                                quantity: btn.parent().siblings().find('.cart-quantity').val()
                            }
                        }).done(function(response) {
                            $('.cartCount').html(response.count);
                            $('.cartTotal').html(response.total);
                            if(response.success) {
                                toastr.success(response.message);
                            } else {
                                toastr.error(response.message);
                            }
                        }).fail(function(response) {
                            toastr.error(response);
                        })
                    }
                } else {
                    $.ajax({
                        type: 'POST',
                        url: url,
                        data: {
                            _token: '{{ csrf_token() }}',
                            quantity: btn.parent().siblings().find('.cart-quantity').val()
                        }
                    }).done(function(response) {
                        $('.cartCount').html(response.count);
                        $('.cartTotal').html(response.total);
                        if(response.success) {
                            toastr.success(response.message);
                        } else {
                            toastr.error(response.message);
                        }
                    }).fail(function(response) {
                        toastr.error(response);
                    })
                }
            }).fail(function(response) {
                toastr.error(response);
            })
        });

        //WISHLIST
        {{--$(".btn-add-wishlist").on('click', function(){--}}
        {{--    let url = $(this).data('url');--}}
        {{--    $.ajax({--}}
        {{--        type: 'POST',--}}
        {{--        url: url,--}}
        {{--        data: { _token: '{{ csrf_token() }}' }--}}
        {{--    })--}}
        {{--        .done(function(response) {--}}
        {{--            if(response.status)--}}
        {{--                toastr.success(response.message);--}}
        {{--            else--}}
        {{--                toastr.warning(response.message)--}}
        {{--        })--}}
        {{--        .fail(function(response) {--}}
        {{--            toastr.error(response.responseJSON.message ?? 'error');--}}
        {{--        })--}}
        {{--});--}}

        let inputs = document.querySelectorAll(".phoneNumber");

        $.each(inputs, function(key, value){
            window.intlTelInput(value, {
                initialCountry: "sa",
                nationalMode: true,
                utilsScript: '{{front_url()}}/assets/js/utils.js',
                preferredCountries: ['sa'],
                separateDialCode: true,
                formatOnDisplay: true,
                hiddenInput: "phone"
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
        });

        (function(document,window, index) {
            var inputs = document.querySelectorAll('.inputfile');
            Array.prototype.forEach.call(inputs,function(input) {
                var label = input.nextElementSibling,
                    labelVal = label.innerHTML;
                input.addEventListener('change', function(e) {
                    var fileName = '';
                    if( this.files && this.files.length > 1 )
                        fileName = (this.getAttribute('data-multiple-caption') || '').replace('{count}', this.files.length);
                    else
                        fileName = e.target.value.split('\\').pop();

                    if(fileName)
                        label.querySelector( 'span' ).innerHTML = fileName;
                    else
                        label.innerHTML = labelVal;
                });

                // Firefox bug fix
                input.addEventListener( 'focus', function(){ input.classList.add('has-focus'); });
                input.addEventListener( 'blur', function(){ input.classList.remove('has-focus'); });
            });
        }(document, window, 0));
    });
</script>


<script defer>
    document.addEventListener('DOMContentLoaded', function() {

        $(".showPassword").click(function(e) {
            e.preventDefault();

            $(this).toggleClass("fa-eye fa-eye-slash");
            let input = $($(this).data("toggle"));

            if (input.attr("type") === "password") {
                input.attr("type", "text");
            } else {
                input.attr("type", "password");
            }
        });

        // Change Currency
        $('.currency_button').click(function () {
            var this_element = $(this),
                code = this_element.data('code');
            if(typeof(code) != "undefined") {
                $.ajax({
                    url: "{{route('front.currencySwitch')}}",
                    data: {"_token": "{{csrf_token()}}", "code": code},
                    type: 'POST',
                    success: function (data) {
                        var return_data = JSON.parse(data);
                        if (typeof (return_data.status) != "undefined" && return_data.status != 0) {
                            window.location.href = "{{ \Request::fullUrl() }}";
                        } else {
                            return false;
                        }
                    }
                });
            }
            return false;
        });

        // subscribeForm Request
        $("#subscribeForm").submit(function (e) {
            e.preventDefault();
            var form = $(this),
                button = $("#subscribeForm button"),
                buttonContent = button.text();
            $.ajax({
                type: 'POST',
                url: "{{route('front.subscribe.request')}}",
                data: $(this).serialize(),
                dataType: 'json',
                beforeSend: function () {
                    button.attr('disabled', true);
                    button.html('<i class="fa fa-spinner fa-spin"></i>');
                },
                success: function (response) {
                    if (response.status) {
                        toastr.success(response.message);
                        form.find("input").val("");
                    } else
                        toastr.warning(response.message);

                    button.attr('disabled', false);
                    button.text(buttonContent);
                    // console.log(response);
                },
                error: function (response) {
                    // toastr.error(response.responseJSON.message);
                    let errors = response.responseJSON.errors;

                    $.each(errors, function (key, value) {
                        toastr.error(value, key);
                    })
                    button.attr('disabled', false);
                    button.text(buttonContent);
                }
            });
        });

        // inquireForm Request
        $("#inquireForm").submit(function (e) {
            e.preventDefault();
            var button = $("#inquireForm button"),
                buttonContent = button.text(),
                inputs = $(this);

            $.ajax({
                type: 'POST',
                url: "{{route('front.inquire.request')}}",
                data: new FormData(this),
                dataType: 'json',
                contentType: false,
                cache: false,
                processData: false,
                beforeSend: function () {
                    button.attr('disabled', true);
                    button.html('<i class="fa fa-spinner fa-spin"></i>');
                },
                success: function (response) {
                    if (response.status) {
                        toastr.success(response.message);
                        inputs.find("input, textarea, file").val("");
                        $("#file-chosen").remove();
                        $("#sidebarContent").addClass('u-unfold--hidden');
                    } else
                        toastr.warning(response.message);

                    button.attr('disabled', false);
                    button.text(buttonContent);
                    // console.log(response);
                },
                error: function (response) {
                    // toastr.error(response.responseJSON.message);
                    let errors = response.responseJSON.errors;

                    $.each(errors, function (key, value) {
                        toastr.error(value, key);
                    })
                    button.attr('disabled', false);
                    button.text(buttonContent);
                }
            });
        });
    });
</script>
@yield('extraScripts')
