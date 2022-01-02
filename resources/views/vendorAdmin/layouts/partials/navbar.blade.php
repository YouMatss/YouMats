<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <a href="{{route('home')}}" target="_blank" class="nav-link">{{__('vendorAdmin.website')}}</a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <a href="{{route('vendor.show', [$vendor->slug])}}" target="_blank" class="nav-link">{{__('vendorAdmin.vendor_profile')}}</a>
        </li>
        <form action="{{route('vendor.logout')}}" method="POST">
            @csrf
            <li class="nav-item d-none d-sm-inline-block">
                <button type="submit" class="nav-link" style="border: 0;background: 0;">{{__('vendorAdmin.logout')}}</button>
            </li>
        </form>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
        <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="#" aria-expanded="false">
                <i class="fas fa-globe"></i>
            </a>
            <div class="dropdown-menu dropdown-menu-right" style="left: inherit; right: 0px;">
                @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                    <a href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}"
                       class="dropdown-item {{$localeCode}}" hreflang="{{ $localeCode }}">
                        <i class="fas fa-language"></i> {{ $properties['native'] }}
                    </a>
                    @if(!$loop->last)
                    <div class="dropdown-divider"></div>
                    @endif
                @endforeach
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                <i class="fas fa-expand-arrows-alt"></i>
            </a>
        </li>
    </ul>
</nav>
