<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @yield('title')
    @include('vendorAdmin.layouts.partials.assets')
</head>
<body class="hold-transition sidebar-mini layout-fixed new--style--custom">
<div class="wrapper">
    <div class="preloader flex-column justify-content-center align-items-center">
        <img class="animation__shake" src="{{ Storage::url(nova_get_setting('logo')) }}"
             alt="{{env('APP_NAME')}}" width="200">
    </div>
    @include('vendorAdmin.layouts.partials.navbar')
    @include('vendorAdmin.layouts.partials.sidebar')
    <div class="content-wrapper">
        @yield('content')
    </div>
    <footer class="main-footer">
        <strong>{{__('vendorAdmin.copyright')}} &copy; {{date('Y')}}</strong>
        {{__('vendorAdmin.all_rights_reserved')}}.
        <div class="float-right d-none d-sm-inline-block">
            <img width="100" src="{{ Storage::url(nova_get_setting('logo')) }}" />
        </div>
    </footer>
</div>
@include('vendorAdmin.layouts.partials.assets-js')
@include('vendorAdmin.layouts.partials.alerts')
</body>
</html>
