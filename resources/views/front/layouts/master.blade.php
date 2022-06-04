<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <!-- Google Tag Manager -->
        <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
                    new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
                j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
                'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
            })(window,document,'script','dataLayer','GTM-58Q2BVQ');</script>
        <!-- End Google Tag Manager -->

        <!-- Google Analytics -->
        <!-- Global site tag (gtag.js) - Google Analytics -->
        <script async src="https://www.googletagmanager.com/gtag/js?id=G-J03ZH2LNSG"></script>
        <script>
            window.dataLayer = window.dataLayer || [];
            function gtag(){dataLayer.push(arguments);}
            gtag('js', new Date());

            gtag('config', 'G-J03ZH2LNSG');
        </script>

        <!-- Google web master -->
        <meta name="google-site-verification" content="42jgsTk384G-j5A58b0eoyX-aR9ozjFnnLeymC27O2c" />

        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        @yield('metaTags')

        <link rel="shortcut icon" href="favicon.ico">

        @include('front.layouts.partials.assets')
        @include('front.layouts.partials.assets_js')
    </head>
    <body>
        <!-- Google Tag Manager (noscript) -->
        <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-58Q2BVQ"
                          height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
        <!-- End Google Tag Manager (noscript) -->

        @include('front.layouts.partials.header')
        <main id="content" role="main">
            @yield('content')
            @if(\Request::route()->getName() != 'cart.show' && \Request::route()->getName() != 'home')
                @include('front.layouts.partials.partners')
            @endif
            @if(\Request::route()->getName() != 'cart.show' && \Request::route()->getName() != 'front.faqs.page')
                @include('front.layouts.partials.faqs')
            @endif
        </main>
        @include('front.layouts.partials.footer')
        @include('front.layouts.partials.welcome-popup')
        @include('front.layouts.partials.search')
        @stack('chat')
    </body>
</html>
