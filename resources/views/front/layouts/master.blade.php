<!doctype html>
<html dir="{{LaravelLocalization::getCurrentLocaleDirection()}}" lang="{{LaravelLocalization::getCurrentLocale()}}-SA">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="robots" content="all" />
        <link rel="shortcut icon" type="image/x-icon" href="{{ $staticImages->getFirstMediaUrlOrDefault(FAVICON_PATH, 'size_16_16')['url'] }}" size="16x16">
        <link rel="shortcut icon" type="image/x-icon" href="{{ $staticImages->getFirstMediaUrlOrDefault(FAVICON_PATH, 'size_32_32')['url'] }}" size="32x32">

        <link rel="alternate" hreflang="{{LaravelLocalization::getCurrentLocale()}}-SA" href="{{url()->current()}}"/>

        @yield('metaTags')
        <!-- Google Tag Manager -->
        <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
        new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
        j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
        'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
        })(window,document,'script','dataLayer','GTM-5BTTJNV');</script>
        <!-- End Google Tag Manager -->

        <!-- Google Analytics -->
        <!-- Google tag (gtag.js) -->
        <script async src="https://www.googletagmanager.com/gtag/js?id=UA-114976621-1"></script>
        <script async src="https://www.googletagmanager.com/gtag/js?id=AW-831078307"></script>
        <script>
          window.dataLayer = window.dataLayer || [];
          function gtag(){dataLayer.push(arguments);}
          gtag('js', new Date());

          gtag('config', 'UA-114976621-1');
          gtag('config', 'AW-831078307');
        </script>

        <!-- Google web master -->
        <meta name="google-site-verification" content="42jgsTk384G-j5A58b0eoyX-aR9ozjFnnLeymC27O2c" />

        @include('front.layouts.partials.assets')
    </head>
    <body>
        <!-- Google Tag Manager (noscript) -->
        <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-5BTTJNV"
        height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
        <!-- End Google Tag Manager (noscript) -->

        @include('front.layouts.partials.header')
        <main id="content" role="main">
            @yield('content')
        </main>
        @include('front.layouts.partials.footer')
        @include('front.layouts.partials.welcome-popup')
        @include('front.layouts.partials.search')
        @include('front.layouts.partials.assets_js')
        @stack('chat')
    </body>
</html>
