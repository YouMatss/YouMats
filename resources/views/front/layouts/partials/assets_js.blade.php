{{--<!-- JS Global Compulsory -->--}}
{{--<script defer src="{{front_url()}}/assets/vendor/jquery/dist/jquery.min.js"></script>--}}
{{--<script defer src="{{front_url()}}/assets/vendor/jquery-migrate/dist/jquery-migrate.min.js"></script>--}}
{{--<script defer src="{{front_url()}}/assets/vendor/popper.js/dist/umd/popper.min.js"></script>--}}
{{--<script defer src="{{front_url()}}/assets/vendor/bootstrap/bootstrap.min.js"></script>--}}

{{--<!-- JS Implementing Plugins -->--}}
{{--<script defer src="{{front_url()}}/assets/vendor/appear.js"></script>--}}
{{--<script defer src="{{front_url()}}/assets/vendor/jquery.countdown.min.js"></script>--}}
{{--<script defer src="{{front_url()}}/assets/vendor/hs-megamenu/src/hs.megamenu.js"></script>--}}
{{--<script defer src="{{front_url()}}/assets/vendor/svg-injector/dist/svg-injector.min.js"></script>--}}
{{--<script defer src="{{front_url()}}/assets/vendor/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.concat.min.js"></script>--}}
{{--<script defer src="{{front_url()}}/assets/vendor/jquery-validation/dist/jquery.validate.min.js"></script>--}}
{{--<script defer src="{{front_url()}}/assets/vendor/fancybox/jquery.fancybox.min.js"></script>--}}
{{--<script defer src="{{front_url()}}/assets/vendor/ion-rangeslider/js/ion.rangeSlider.min.js"></script>--}}
{{--<script defer src="{{front_url()}}/assets/vendor/typed.js/lib/typed.min.js"></script>--}}
{{--<script defer src="{{front_url()}}/assets/vendor/slick-carousel/slick/slick.js"></script>--}}
{{--<script defer src="{{front_url()}}/assets/vendor/appear.js"></script>--}}
{{--<script defer src="{{front_url()}}/assets/vendor/bootstrap-select/dist/js/bootstrap-select.min.js"></script>--}}
{{--<script defer src="{{front_url()}}/assets/js/intlTelInput.min.js"></script>--}}

{{--<!-- JS Electro -->--}}
{{--<script defer src="{{front_url()}}/assets/js/hs.core.js"></script>--}}
{{--<script defer src="{{front_url()}}/assets/js/components/hs.countdown.js"></script>--}}
{{--<script defer src="{{front_url()}}/assets/js/components/hs.header.js"></script>--}}
{{--<script defer src="{{front_url()}}/assets/js/components/hs.hamburgers.js"></script>--}}
{{--<script defer src="{{front_url()}}/assets/js/components/hs.unfold.js"></script>--}}
{{--<script defer src="{{front_url()}}/assets/js/components/hs.focus-state.js"></script>--}}
{{--<script defer src="{{front_url()}}/assets/js/components/hs.malihu-scrollbar.js"></script>--}}
{{--<script defer src="{{front_url()}}/assets/js/components/hs.validation.js"></script>--}}
{{--<script defer src="{{front_url()}}/assets/js/components/hs.fancybox.js"></script>--}}
{{--<script defer src="{{front_url()}}/assets/js/components/hs.onscroll-animation.js"></script>--}}
{{--<script defer src="{{front_url()}}/assets/js/components/hs.slick-carousel.js"></script>--}}
{{--<script defer src="{{front_url()}}/assets/js/components/hs.quantity-counter.js"></script>--}}
{{--<script defer src="{{front_url()}}/assets/js/components/hs.range-slider.js"></script>--}}
{{--<script defer src="{{front_url()}}/assets/js/components/hs.show-animation.js"></script>--}}
{{--<script defer src="{{front_url()}}/assets/js/components/hs.svg-injector.js"></script>--}}
{{--<script defer src="{{front_url()}}/assets/js/components/hs.scroll-nav.js"></script>--}}
{{--<script defer src="{{front_url()}}/assets/js/components/hs.go-to.js"></script>--}}
{{--<script defer src="{{front_url()}}/assets/js/components/hs.selectpicker.js"></script>--}}

<script defer src="{{mix('/assets/js/app.min.js')}}"></script>

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
<!-- Socket.io -->
<script defer src="https://cdn.socket.io/4.0.0/socket.io.min.js" integrity="sha384-DkkWv9oJFWLIydBXXjkBWnG1/fuVhw8YPBq37uvvD6WSYRFRqr21eY5Dg9ZhmWdy" crossorigin="anonymous"></script>

@if(is_company())
<script defer>
    document.addEventListener('DOMContentLoaded', function() {
        (function (w, d, u) {
            var s = d.createElement('script');
            s.async = true;
            s.src = u + '?' + (Date.now() / 60000 | 0);
            var h = d.getElementsByTagName('script')[0];
            h.parentNode.insertBefore(s, h);
        })(window, document, 'https://cdn.bitrix24.com/b12855593/crm/site_button/loader_1_sdm5a9.js');
    });
</script>
@endif

@include('front.layouts.partials.alerts')

<script defer src="{{front_url()}}/assets/js/custom.js"></script>

@include('front.layouts.partials.ajax')
@yield('extraScripts')
