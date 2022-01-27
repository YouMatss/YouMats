<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        @yield('metaTags')

        <link rel="shortcut icon" href="favicon.ico">

        @include('front.layouts.partials.assets')
    </head>
    <body>
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
        @include('front.layouts.partials.assets_js')
{{--        @include('front.layouts.partials.welcome-popup')--}}
        @include('front.layouts.partials.search')
        @stack('chat')
    </body>
</html>
