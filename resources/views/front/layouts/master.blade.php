<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <link rel="shortcut icon" href="favicon.ico">

        @include('front.layouts.partials.assets_js')

        @include('front.layouts.partials.assets')
        @yield('metaTags')
    </head>
    <body>
        @include('front.layouts.partials.header')
        <main id="content" role="main">
            @yield('content')

            <!-- Featured Vendors -->
            @if(count($featuredVendors) > 1)
            <div class="container mb-8">
                <div class="py-2 border-top border-bottom">
                    <div class="js-slick-carousel u-slick my-1"
                         data-slides-show="5"
                         data-slides-scroll="1"
                         data-arrows-classes="d-none d-lg-inline-block u-slick__arrow-normal u-slick__arrow-centered--y"
                         data-arrow-left-classes="fa fa-angle-left u-slick__arrow-classic-inner--left z-index-9"
                         data-arrow-right-classes="fa fa-angle-right u-slick__arrow-classic-inner--right"
                         data-responsive='[{
                            "breakpoint": 992,
                            "settings": {
                                "slidesToShow": 2
                            }
                        }, {
                            "breakpoint": 768,
                            "settings": {
                                "slidesToShow": 1
                            }
                        }, {
                            "breakpoint": 554,
                            "settings": {
                                "slidesToShow": 1
                            }
                        }]'>
                        @foreach($featuredVendors as $vendor)
                            <div class="js-slide img_vend">
                                <a href="#" class="link-hover__brand">
                                    <img class="img-fluid m-auto max-height-50" style="width: 50px" src="{{ $vendor->getFirstMediaUrl(VENDOR_LOGO) }}" alt="{{ $vendor->name }}">
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
            @endif
        </main>
        @include('front.layouts.partials.footer')
        @yield('extraScripts')
    </body>
</html>
