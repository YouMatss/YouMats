<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="shortcut icon" href="favicon.ico">
        @include('front.layouts.partials.assets')
        @yield('metaTags')
    </head>
    <body>
        @include('front.layouts.partials.header')
        <main id="content" role="main">
            @yield('content')
        </main>
        @include('front.layouts.partials.footer')
        @include('front.layouts.partials.assets_js')
        @yield('js_section')
    </body>
</html>
