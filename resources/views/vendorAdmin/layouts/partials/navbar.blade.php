<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <a href="{{route('home')}}" class="nav-link">{{__('vendorAdmin.website')}}</a>
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
        <li class="nav-item">
            <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                <i class="fas fa-expand-arrows-alt"></i>
            </a>
        </li>
    </ul>
</nav>
