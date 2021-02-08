<header id="header" class="u-header u-header-left-aligned-nav">
    <div class="u-header__section shadow-none">

        <!-------- Top header -------->
        <div class="u-header-topbar bg-gray-2 border-0 py-2 d-none d-xl-block">
            <div class="container">
                <div class="d-flex align-items-center">
                    <div class="topbar-left">
                        <a href="tel:0096665432120" class="text-gray-110 font-size-13 hover-on-dark mr-3"><i class="fa fa-phone"></i> 0096665432165 </a>
                        <a href="mailto:info@youmats.com" class="text-gray-110 font-size-13 hover-on-dark"><i class="fa fa-envelope"></i> info@youmats.com </a>
                    </div>
                    <div class="topbar-right ml-auto">
                        <ul class="list-inline mb-0">

                            <li class="list-inline-item mr-0 u-header-topbar__nav-item u-header-topbar__nav-item-border">
                                <a href="#" class="u-header-topbar__nav-link"><i class="ec ec-favorites mr-1"></i> My Wishlist </a>
                            </li>

                            @if(count(\Config::get('currencies')) > 1)
                                <li class="list-inline-item mr-0 u-header-topbar__nav-item u-header-topbar__nav-item-border u-header-topbar__nav-item-no-border u-header-topbar__nav-item-border-single">
                                    <div class="d-flex align-items-center">
                                        <!-- Language -->
                                        <div class="position-relative">
                                            <a id="languageDropdownInvoker" class="dropdown-nav-link dropdown-toggle d-flex align-items-center u-header-topbar__nav-link font-weight-normal" href="javascript:;" aria-haspopup="true" aria-expanded="false" data-unfold-event="hover" data-unfold-target="#languageDropdown" data-unfold-type="css-animation" data-unfold-duration="300" data-unfold-delay="300" data-unfold-hide-on-scroll="true" data-unfold-animation-in="slideInUp" data-unfold-animation-out="fadeOut">
                                                <span class="d-inline-block d-sm-none">{{getCurrency('code')}}</span>
                                                <span class="d-none d-sm-inline-flex align-items-center"><i class="ec ec-dollar mr-1"></i> {{getCurrency('code')}} ({{getCurrency('symbol')}})</span>
                                            </a>
                                            <div id="languageDropdown" class="dropdown-menu dropdown-unfold" aria-labelledby="languageDropdownInvoker">
                                                @foreach(\Config::get('currencies') as $currency)
                                                <a class="dropdown-item active currency_button" data-code="{{$currency->code}}" href="#">
                                                    <img width="20px" src="{{$currency->media[0]->getUrl()}}" />&nbsp;
                                                    {{$currency->code}} ({{$currency->symbol}})
                                                </a>
                                                @endforeach
                                            </div>
                                        </div>
                                        <!-- End Language -->
                                    </div>
                                </li>
                            @endif

                            <li class="list-inline-item mr-0 u-header-topbar__nav-item u-header-topbar__nav-item-border u-header-topbar__nav-item-no-border u-header-topbar__nav-item-border-single">
                                <div class="d-flex align-items-center">
                                    <!-- Language -->
                                    <div class="position-relative">
                                        <a id="languageDropdownInvoker2" class="dropdown-nav-link dropdown-toggle d-flex align-items-center u-header-topbar__nav-link font-weight-normal" href="javascript:;" aria-haspopup="true" aria-expanded="false" data-unfold-event="hover" data-unfold-target="#languageDropdown1" data-unfold-type="css-animation" data-unfold-duration="300" data-unfold-delay="300" data-unfold-hide-on-scroll="true" data-unfold-animation-in="slideInUp" data-unfold-animation-out="fadeOut">
                                            <span class="d-none d-sm-inline-flex align-items-center">
                                                <i class="fas fa-globe-americas mr-1 font-size-14"></i>
                                                {{ LaravelLocalization::getCurrentLocaleNative() }}
                                            </span>
                                        </a>
                                        <div id="languageDropdown1" class="dropdown-menu dropdown-unfold" aria-labelledby="languageDropdownInvoker2">
                                            @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                                            <a class="dropdown-item {{$localeCode}}" hreflang="{{ $localeCode }}" href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">{{ $properties['native'] }}</a>
                                            @endforeach
                                        </div>
                                    </div>
                                    <!-- End Language -->
                                </div>
                            </li>

                            @if(Auth::guard('web')->check() && !Auth::guard('vendor')->check())
                            <li class="list-inline-item mr-0 u-header-topbar__nav-item u-header-topbar__nav-item-border u-header-topbar__nav-item-no-border u-header-topbar__nav-item-border-single">
                                <div class="d-flex align-items-center">
                                    <!-- Language -->
                                    <div class="position-relative">
                                        <a id="profileDropdownInvoker2" class="dropdown-nav-link dropdown-toggle d-flex align-items-center u-header-topbar__nav-link font-weight-normal" href="javascript:;" aria-haspopup="true" aria-expanded="false" data-unfold-event="hover" data-unfold-target="#profileDropdown1" data-unfold-type="css-animation" data-unfold-duration="300" data-unfold-delay="300" data-unfold-hide-on-scroll="true" data-unfold-animation-in="slideInUp" data-unfold-animation-out="fadeOut">
                                            <span class="d-none d-sm-inline-flex align-items-center">
                                                <i class="ec ec-user mr-1"></i> {{auth('web')->user()->name}}
                                            </span>
                                        </a>
                                        <div id="profileDropdown1" class="dropdown-menu dropdown-unfold" aria-labelledby="profileDropdownInvoker2">
                                            <a class="dropdown-item" href="{{route('front.user.profile')}}">Profile</a>
                                            <form class="dropdown-item" style="cursor: pointer" action="{{route('logout')}}" method="POST">
                                                @csrf
                                                <button type="submit" class="dropdown-item">Logout</button>
                                            </form>
                                        </div>
                                    </div>
                                    <!-- End Language -->
                                </div>
                            </li>
                            @elseif(!Auth::guard('vendor')->check())
                            <li class="list-inline-item mr-0 u-header-topbar__nav-item u-header-topbar__nav-item-border">
                                <a href="{{route('login')}}" role="button" class="u-header-topbar__nav-link">
                                    <i class="ec ec-user mr-1"></i> Register <span class="text-gray-50">or</span> Sign in
                                </a>
                            </li>
                            @endif

                            @if(Auth::guard('vendor')->check() && !Auth::guard('web')->check())
                                <li class="list-inline-item mr-0 u-header-topbar__nav-item u-header-topbar__nav-item-border u-header-topbar__nav-item-no-border u-header-topbar__nav-item-border-single">
                                    <div class="d-flex align-items-center">
                                        <!-- Language -->
                                        <div class="position-relative">
                                            <a id="profileDropdownInvoker2" class="dropdown-nav-link dropdown-toggle d-flex align-items-center u-header-topbar__nav-link font-weight-normal" href="javascript:;" aria-haspopup="true" aria-expanded="false" data-unfold-event="hover" data-unfold-target="#profileDropdown1" data-unfold-type="css-animation" data-unfold-duration="300" data-unfold-delay="300" data-unfold-hide-on-scroll="true" data-unfold-animation-in="slideInUp" data-unfold-animation-out="fadeOut">
                                            <span class="d-none d-sm-inline-flex align-items-center">
                                                <i class="ec ec-user mr-1"></i> {{auth('vendor')->user()->name}}
                                            </span>
                                            </a>
                                            <div id="profileDropdown1" class="dropdown-menu dropdown-unfold" aria-labelledby="profileDropdownInvoker2">
{{--                                                <a class="dropdown-item" href="{{route('front.user.profile')}}">Profile</a>--}}
                                                <form class="dropdown-item" style="cursor: pointer" action="{{route('vendor.logout')}}" method="POST">
                                                    @csrf
                                                    <button type="submit" class="dropdown-item">Logout</button>
                                                </form>
                                            </div>
                                        </div>
                                        <!-- End Language -->
                                    </div>
                                </li>
                            @elseif(!Auth::guard('web')->check())
                                <li class="list-inline-item mr-0 u-header-topbar__nav-item u-header-topbar__nav-item-border">
                                    <a href="{{route('vendor.login')}}" role="button" class="u-header-topbar__nav-link">
                                        <i class="ec ec-user mr-1"></i> Register <span class="text-gray-50">or</span> Sign in as Vendor
                                    </a>
                                </li>
                            @endif


                            <li class="list-inline-item mr-0 u-header-topbar__nav-item u-header-topbar__nav-item-border">
                                <a id="sidebarNavToggler" href="javascript:;" role="button" class="u-header-topbar__nav-link"
                                   aria-controls="sidebarContent"
                                   aria-haspopup="true"
                                   aria-expanded="false"
                                   data-unfold-event="click"
                                   data-unfold-hide-on-scroll="false"
                                   data-unfold-target="#sidebarContent"
                                   data-unfold-type="css-animation"
                                   data-unfold-animation-in="fadeInRight"
                                   data-unfold-animation-out="fadeOutRight"
                                   data-unfold-duration="500">
                                    Get Quote
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <!-------- logo & menu -------->
        <div class="py-2 py-xl-4 bg-primary-down-lg nav_fixed">
            <div class="container my-0dot5 my-xl-0">
                <div class="row align-items-center">
                    <div class="col-auto">
                        <nav class="navbar navbar-expand u-header__navbar py-0 justify-content-xl-between">
                            <a class="order-1 order-xl-0 navbar-brand u-header__navbar-brand u-header__navbar-brand-center" href="#" aria-label="">
                                <img src="{{front_url()}}/assets/img/logo.png">
                            </a>
                            <button id="sidebarHeaderInvokerMenu" type="button" class="d-block d-md-none d-lg-none navbar-toggler d-block btn u-hamburger mr-3 mr-xl-0"
                                    aria-controls="sidebarHeader"
                                    aria-haspopup="true"
                                    aria-expanded="false"
                                    data-unfold-event="click"
                                    data-unfold-hide-on-scroll="false"
                                    data-unfold-target="#sidebarHeader1"
                                    data-unfold-type="css-animation"
                                    data-unfold-animation-in="fadeInLeft"
                                    data-unfold-animation-out="fadeOutLeft"
                                    data-unfold-duration="500">
                                        <span id="hamburgerTriggerMenu" class="u-hamburger__box">
                                            <span class="u-hamburger__inner"></span>
                                        </span>
                            </button>
                        </nav>
                        <aside id="sidebarHeader1" class="u-sidebar u-sidebar--left" aria-labelledby="sidebarHeaderInvokerMenu">
                            <div class="u-sidebar__scroller">
                                <div class="u-sidebar__container">
                                    <div class="u-header-sidebar__footer-offset pb-0">

                                        <div class="position-absolute top-0 right-0 z-index-2 pt-4 pr-7">
                                            <button type="button" class="close ml-auto"
                                                    aria-controls="sidebarHeader"
                                                    aria-haspopup="true"
                                                    aria-expanded="false"
                                                    data-unfold-event="click"
                                                    data-unfold-hide-on-scroll="false"
                                                    data-unfold-target="#sidebarHeader1"
                                                    data-unfold-type="css-animation"
                                                    data-unfold-animation-in="fadeInLeft"
                                                    data-unfold-animation-out="fadeOutLeft"
                                                    data-unfold-duration="500">
                                                <span aria-hidden="true"><i class="ec ec-close-remove text-gray-90 font-size-20"></i></span>
                                            </button>
                                        </div>

                                        <div class="js-scrollbar u-sidebar__body">
                                            <div id="headerSidebarContent" class="u-sidebar__content u-header-sidebar__content">

                                                <a class="d-flex ml-0 navbar-brand u-header__navbar-brand u-header__navbar-brand-vertical" href="#" aria-label="">
                                                    <img src="{{front_url()}}/assets/img/logo.png">
                                                </a>

                                                <ul id="headerSidebarList" class="u-header-collapse__nav">

                                                    <li class="u-has-submenu u-header-collapse__submenu">
                                                        <a class="u-header-collapse__nav-link u-header-collapse__nav-pointer" href="javascript:;" role="button" data-toggle="collapse" aria-expanded="false" aria-controls="headerSidebarHomeCollapse" data-target="#headerSidebarHomeCollapse">
                                                            Building Material
                                                        </a>

                                                        <div id="headerSidebarHomeCollapse" class="collapse" data-parent="#headerSidebarContent">
                                                            <ul id="headerSidebarHomeMenu" class="u-header-collapse__nav-list">
                                                                <li><a class="u-header-collapse__submenu-nav-link" href="#">The Blocks</a></li>
                                                                <li><a class="u-header-collapse__submenu-nav-link" href="#">Steel Structure</a></li>
                                                                <li><a class="u-header-collapse__submenu-nav-link" href="#">Steel Structure</a></li>
                                                                <li><a class="u-header-collapse__submenu-nav-link" href="#">Boundary Walls</a></li>
                                                            </ul>
                                                        </div>
                                                    </li>

                                                    <li class="u-has-submenu u-header-collapse__submenu">
                                                        <a class="u-header-collapse__nav-link u-header-collapse__nav-pointer" href="javascript:;" data-target="#headerSidebarPagesCollapse" role="button" data-toggle="collapse" aria-expanded="false" aria-controls="headerSidebarPagesCollapse">
                                                            Plumbing
                                                        </a>

                                                        <div id="headerSidebarPagesCollapse" class="collapse" data-parent="#headerSidebarContent">
                                                            <ul id="headerSidebarPagesMenu" class="u-header-collapse__nav-list">
                                                                <li><a class="u-header-collapse__submenu-nav-link" href="#">Heat pipes</a></li>
                                                                <li><a class="u-header-collapse__submenu-nav-link" href="#">Water Tanks</a></li>
                                                                <li><a class="u-header-collapse__submenu-nav-link" href="#">Manhole and Grating</a></li>
                                                                <li><a class="u-header-collapse__submenu-nav-link" href="#">Solvents</a></li>
                                                            </ul>
                                                        </div>
                                                    </li>

                                                    <li class="u-has-submenu u-header-collapse__submenu">
                                                        <a class="u-header-collapse__nav-link u-header-collapse__nav-pointer" href="javascript:;" data-target="#headerSidebarBlogCollapse" role="button" data-toggle="collapse" aria-expanded="false" aria-controls="headerSidebarBlogCollapse">
                                                            Kitchen
                                                        </a>

                                                        <div id="headerSidebarBlogCollapse" class="collapse" data-parent="#headerSidebarContent">
                                                            <ul id="headerSidebarBlogMenu" class="u-header-collapse__nav-list">
                                                                <li><a class="u-header-collapse__submenu-nav-link" href="#">Chimneys and Hobs</a></li>
                                                                <li><a class="u-header-collapse__submenu-nav-link" href="#">Chimneys and Hobs</a></li>
                                                                <li><a class="u-header-collapse__submenu-nav-link" href="#">Chimneys and Hobs</a></li>
                                                                <li><a class="u-header-collapse__submenu-nav-link" href="#">Chimneys and Hobs</a></li>
                                                            </ul>
                                                        </div>
                                                    </li>

                                                    <li class="u-has-submenu u-header-collapse__submenu">
                                                        <a class="u-header-collapse__nav-link u-header-collapse__nav-pointer" href="javascript:;" data-target="#headerSidebarShopCollapse" role="button" data-toggle="collapse" aria-expanded="false" aria-controls="headerSidebarShopCollapse">
                                                            Hardware's
                                                        </a>

                                                        <div id="headerSidebarShopCollapse" class="collapse" data-parent="#headerSidebarContent">
                                                            <ul id="headerSidebarShopMenu" class="u-header-collapse__nav-list">
                                                                <li><a class="u-header-collapse__submenu-nav-link" href="#">Hardware's</a></li>
                                                                <li><a class="u-header-collapse__submenu-nav-link" href="#">Hardware's</a></li>
                                                                <li><a class="u-header-collapse__submenu-nav-link" href="#">Hardware's</a></li>
                                                                <li><a class="u-header-collapse__submenu-nav-link" href="#">Hardware's</a></li>
                                                            </ul>
                                                        </div>
                                                    </li>

                                                    <li class="u-has-submenu u-header-collapse__submenu">
                                                        <a class="u-header-collapse__nav-link u-header-collapse__nav-pointer" href="javascript:;" data-target="#headerSidebarDemosCollapse" role="button" data-toggle="collapse" aria-expanded="false" aria-controls="headerSidebarDemosCollapse">
                                                            Glass and Facade
                                                        </a>

                                                        <div id="headerSidebarDemosCollapse" class="collapse" data-parent="#headerSidebarContent">
                                                            <ul id="headerSidebarDemosMenu" class="u-header-collapse__nav-list">
                                                                <li><a class="u-header-collapse__submenu-nav-link" href="#">Glass and Facade</a></li>
                                                                <li><a class="u-header-collapse__submenu-nav-link" href="#">Glass and Facade</a></li>
                                                                <li><a class="u-header-collapse__submenu-nav-link" href="#">Glass and Facade</a></li>
                                                                <li><a class="u-header-collapse__submenu-nav-link" href="#">Glass and Facade</a></li>
                                                            </ul>
                                                        </div>
                                                    </li>

                                                    <li class="u-has-submenu u-header-collapse__submenu">
                                                        <a class="u-header-collapse__nav-link u-header-collapse__nav-pointer" href="javascript:;" data-target="#headerSidebardocsCollapse" role="button" data-toggle="collapse" aria-expanded="false" aria-controls="headerSidebardocsCollapse">
                                                            Living Room
                                                        </a>

                                                        <div id="headerSidebardocsCollapse" class="collapse" data-parent="#headerSidebarContent">
                                                            <ul id="headerSidebardocsMenu" class="u-header-collapse__nav-list">
                                                                <li><a class="u-header-collapse__submenu-nav-link" href="#">Living Room</a></li>
                                                                <li><a class="u-header-collapse__submenu-nav-link" href="#">Living Room</a></li>
                                                                <li><a class="u-header-collapse__submenu-nav-link" href="#">Living Room</a></li>
                                                                <li><a class="u-header-collapse__submenu-nav-link" href="#">Living Room</a></li>
                                                            </ul>
                                                        </div>
                                                    </li>

                                                    <li class="u-has-submenu u-header-collapse__submenu">
                                                        <a class="u-header-collapse__nav-link u-header-collapse__nav-pointer" href="javascript:;" data-target="#headerSidebarblogsCollapse" role="button" data-toggle="collapse" aria-expanded="false" aria-controls="headerSidebarblogsCollapse">
                                                            Safety Products
                                                        </a>

                                                        <div id="headerSidebarblogsCollapse" class="collapse" data-parent="#headerSidebarContent">
                                                            <ul id="headerSidebarblogsMenu" class="u-header-collapse__nav-list">
                                                                <li><a class="u-header-collapse__submenu-nav-link" href="#">Safety Products</a></li>
                                                                <li><a class="u-header-collapse__submenu-nav-link" href="#">Safety Products</a></li>
                                                                <li><a class="u-header-collapse__submenu-nav-link" href="#">Safety Products</a></li>
                                                                <li><a class="u-header-collapse__submenu-nav-link" href="#">Safety Products</a></li>
                                                            </ul>
                                                        </div>
                                                    </li>

                                                </ul>
                                                <!-- End List -->
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </aside>
                    </div>
                    <div class="col d-none d-xl-block">
                        <!-- Nav -->
                        <nav class="js-mega-menu navbar navbar-expand-md u-header__navbar u-header__navbar--no-space">
                            <!-- Navigation -->
                            <div id="navBar" class="collapse navbar-collapse u-header__navbar-collapse">
                                <ul class="navbar-nav u-header__navbar-nav">

                                    <li class="nav-item u-header__nav-item">
                                        <a class="nav-link u-header__nav-link" href="{{route('home')}}">Home</a>
                                    </li>
                                    <li class="nav-item u-header__nav-item">
                                        <a class="nav-link u-header__nav-link" href="#">All Products</a>
                                    </li>
                                    <li class="nav-item u-header__nav-item">
                                        <a class="nav-link u-header__nav-link" href="#">Our Partners</a>
                                    </li>
                                    <li class="nav-item u-header__nav-item">
                                        <a class="nav-link u-header__nav-link" href="#">FAQs</a>
                                    </li>
                                    <li class="nav-item u-header__nav-item">
                                        <a class="nav-link u-header__nav-link" href="#">About us</a>
                                    </li>
                                    <li class="nav-item u-header__nav-item">
                                        <a class="nav-link u-header__nav-link" href="#">Contact Us</a>
                                    </li>

                                </ul>
                            </div>
                            <!-- End Navigation -->
                        </nav>
                        <!-- End Nav -->
                    </div>
                    <div class="d-none d-xl-block col-md-auto">
                        <div class="d-flex">
                            <i class="ec ec-support font-size-50 text-primary"></i>
                            <div class="ml-2">
                                <div class="phone">
                                    <strong>Support</strong> <a href="tel:00966502111754" class="text-gray-90">(+966) 502111754</a>
                                </div>
                                <div class="email">
                                    E-mail: <a href="mailto:info@youmats.com" class="text-gray-90">info@youmats.com</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="d-xl-none col col-xl-auto text-right text-xl-left pl-0 pl-xl-3 position-static">
                        <div class="d-inline-flex">
                            <ul class="d-flex list-unstyled mb-0 align-items-center">
                                <!-- Search -->
                                <li class="col d-xl-none px-2 px-sm-3 position-static">
                                    <a id="searchClassicInvoker" class="font-size-22 text-gray-90 text-lh-1 btn-text-secondary" href="javascript:;" role="button"
                                       data-toggle="tooltip"
                                       data-placement="top"
                                       title="Search"
                                       aria-controls="searchClassic"
                                       aria-haspopup="true"
                                       aria-expanded="false"
                                       data-unfold-target="#searchClassic"
                                       data-unfold-type="css-animation"
                                       data-unfold-duration="300"
                                       data-unfold-delay="300"
                                       data-unfold-hide-on-scroll="true"
                                       data-unfold-animation-in="slideInUp"
                                       data-unfold-animation-out="fadeOut">
                                        <span class="ec ec-search"></span>
                                    </a>

                                    <!-- Input -->
                                    <div id="searchClassic" class="dropdown-menu dropdown-unfold dropdown-menu-right left-0 mx-2" aria-labelledby="searchClassicInvoker">
                                        <form class="js-focus-state input-group px-3">
                                            <input class="form-control" type="search" placeholder="Search Product">
                                            <div class="input-group-append">
                                                <button class="btn btn-primary px-3" type="button"><i class="font-size-18 ec ec-search"></i></button>
                                            </div>
                                        </form>
                                    </div>
                                    <!-- End Input -->
                                </li>
                                <!-- End Search -->
                                <li class="col d-none d-xl-block"><a href="#" class="text-gray-90" data-toggle="tooltip" data-placement="top" title="Favorites"><i class="font-size-22 ec ec-favorites"></i></a></li>
                                <li class="col d-xl-none px-2 px-sm-3"><a href="#" class="text-gray-90" data-toggle="tooltip" data-placement="top" title="My Account"><i class="font-size-22 ec ec-user"></i></a></li>
                                <li class="col pr-xl-0 px-2 px-sm-3">
                                    <a href="#" class="text-gray-90 position-relative d-flex " data-toggle="tooltip" data-placement="top" title="Cart">
                                        <i class="font-size-22 ec ec-shopping-bag"></i>
                                        <span class="width-22 height-22 bg-dark position-absolute d-flex align-items-center justify-content-center rounded-circle left-12 top-8 font-weight-bold font-size-12 text-white">2</span>
                                        <span class="d-none d-xl-block font-weight-bold font-size-16 text-gray-90 ml-3">SAR 1785.00</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-------- search & cart -------->
        <div class="d-none d-xl-block bg-primary">
            <div class="container">
                <div class="row align-items-stretch min-height-50">
                    <div class="col-md-auto d-none d-xl-flex align-items-end">
                        <div class="max-width-270 min-width-270">
                            <div id="basicsAccordion">
                                <div class="card border-0 rounded-0">
                                    <div class="card-header bg-primary rounded-0 card-collapse border-0" id="basicsHeadingOne">
                                        <button type="button" class="btn-link btn-remove-focus btn-block d-flex card-btn py-3 text-lh-1 px-4 shadow-none btn-primary rounded-top-lg border-0 font-weight-bold text-gray-90"
                                                data-toggle="collapse"
                                                data-target="#basicsCollapseOne"
                                                aria-expanded="true"
                                                aria-controls="basicsCollapseOne">
                                            <span class="pl-1 text-gray-110">All Categories</span>
                                            <span class="text-gray-110 ml-3">
                                                <span class="ec ec-arrow-down-search"></span>
                                            </span>
                                        </button>
                                    </div>
                                    <div id="basicsCollapseOne" class="collapse show vertical-menu v1"
                                         aria-labelledby="basicsHeadingOne"
                                         data-parent="#basicsAccordion">
                                        <div class="card-body p-0">
                                            <nav class="js-mega-menu navbar navbar-expand-xl u-header__navbar u-header__navbar--no-space hs-menu-initialized">
                                                <div id="navBar" class="collapse navbar-collapse u-header__navbar-collapse">
                                                    <ul class="navbar-nav u-header__navbar-nav border-primary border-top-0">
                                                        @foreach($categories as $category)
                                                        <li class="nav-item hs-has-mega-menu u-header__nav-item"
                                                            data-event="hover"
                                                            data-position="left">
                                                            <a id="{{$category->slug}}" class="nav-link u-header__nav-link u-header__nav-link-toggle"
                                                               href="{{route('front.category', ['category_slug' => $category->slug])}}" aria-haspopup="true" aria-expanded="false">{{$category->name}}</a>

                                                            <div class="hs-mega-menu vmm-tfw u-header__sub-menu" aria-labelledby="{{$category->slug}}">
                                                                <div class="vmm-bg">
                                                                    <img class="img-fluid" src="{{$category->getFirstMediaUrl(CATEGORY_PATH)}}" alt="{{$category->getFirstMedia(CATEGORY_PATH)->img_alt}}" title="{{$category->getFirstMedia(CATEGORY_PATH)->img_title}}">
                                                                </div>
                                                                <div class="row u-header__mega-menu-wrapper">
                                                                    <div class="col mb-3 mb-sm-0">
                                                                        <span class="u-header__sub-menu-title">{{$category->name}}</span>
                                                                        <ul class="u-header__sub-menu-nav-group mb-3">
                                                                            @foreach($category->subCategories as $subCategory)
                                                                            <li><a class="nav-link u-header__sub-menu-nav-link" href="{{route('front.subCategory', ['category_slug' => $category->slug, 'subCategory_slug' => $subCategory->slug])}}">{{$subCategory->name}}</a></li>
                                                                            @endforeach
                                                                            <li>
                                                                                <a class="nav-link u-header__sub-menu-nav-link u-nav-divider border-top pt-2 flex-column align-items-start"
                                                                                   href="{{route('front.category', ['category_slug' => $category->slug])}}">
                                                                                    <div class="">ALL CATEGORIES</div>
                                                                                    <div class="u-nav-subtext font-size-11 text-gray-30">Discover more products</div>
                                                                                </a>
                                                                            </li>
                                                                        </ul>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </li>
                                                        @endforeach
                                                    </ul>
                                                </div>
                                            </nav>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col align-self-center">
                        <!-- Search-Form -->
                        <form class="js-focus-state">
                            <label class="sr-only" for="searchProduct">Search</label>
                            <div class="input-group">
                                <input type="email" class="form-control py-2 pl-5 font-size-15 border-0 height-40 rounded-left-pill" name="email" id="searchProduct" placeholder="Search for Products" aria-label="Search for Products" aria-describedby="searchProduct1" required>
                                <div class="input-group-append">
                                    <!-- Select -->
                                    <select class="js-select selectpicker dropdown-select custom-search-categories-select"
                                            data-style="btn height-40 text-gray-60 font-weight-normal border-0 rounded-0 bg-white px-5 py-2">
                                        <option value="one" selected>All Categories</option>
                                        <option value="two">Two</option>
                                        <option value="three">Three</option>
                                        <option value="four">Four</option>
                                    </select>
                                    <!-- End Select -->
                                    <button class="btn btn-dark height-40 py-2 px-3 rounded-right-pill" type="button" id="searchProduct1">
                                        <span class="ec ec-search font-size-24"></span>
                                    </button>
                                </div>
                            </div>
                        </form>
                        <!-- End Search-Form -->
                    </div>
                    <div class="col-md-auto align-self-center">
                        <div class="d-flex">
                            <ul class="d-flex list-unstyled mb-0">
                                <li class="col pr-0">
                                    <a href="#" class="text-gray-110 position-relative d-flex " data-toggle="tooltip" data-placement="top" title="Cart">
                                        <i class="font-size-22 ec ec-shopping-bag"></i>
                                        <span class="width-22 height-22 bg-dark position-absolute flex-content-center text-white rounded-circle left-12 top-8 font-weight-bold font-size-12">2</span>
                                        <span class="font-weight-bold font-size-16 text-gray-110 ml-3">SAR 1785.00</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="container d-none" style="position: relative">
            <div class="h_scroll">
                <div class="container p-0">
                    <div class="row">
                        <div class="d-none d-xl-block col-xl-3 col-wd-2gdot5">
                            <div class="block_search_check">
                                <div class="border-bottom pb-4 mb-4">
                                    <h4 class="font-size-14 mb-3 font-weight-bold">Brands</h4>

                                    <!-- Checkboxes -->
                                    <div class="form-group d-flex align-items-center justify-content-between mb-2 pb-1">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="brandAdidas">
                                            <label class="custom-control-label" for="brandAdidas">Building Material
                                                <span class="text-gray-25 font-size-12 font-weight-normal"> (56)</span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="form-group d-flex align-items-center justify-content-between mb-2 pb-1">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="brandNewBalance">
                                            <label class="custom-control-label" for="brandNewBalance">Plumbing
                                                <span class="text-gray-25 font-size-12 font-weight-normal"> (56)</span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="form-group d-flex align-items-center justify-content-between mb-2 pb-1">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="brandNike">
                                            <label class="custom-control-label" for="brandNike">Kitchen
                                                <span class="text-gray-25 font-size-12 font-weight-normal"> (56)</span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="form-group d-flex align-items-center justify-content-between mb-2 pb-1">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="brandFredPerry">
                                            <label class="custom-control-label" for="brandFredPerry">Paints
                                                <span class="text-gray-25 font-size-12 font-weight-normal"> (56)</span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="form-group d-flex align-items-center justify-content-between mb-2 pb-1">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="brandTnf">
                                            <label class="custom-control-label" for="brandTnf">Precast Concrete
                                                <span class="text-gray-25 font-size-12 font-weight-normal"> (56)</span>
                                            </label>
                                        </div>
                                    </div>
                                    <!-- End Checkboxes -->

                                </div>
                                <div class="border-bottom pb-4 mb-4">
                                    <h4 class="font-size-14 mb-3 font-weight-bold">Tags</h4>

                                    <!-- Checkboxes -->
                                    <div class="form-group d-flex align-items-center justify-content-between mb-2 pb-1">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="categoryTshirt">
                                            <label class="custom-control-label" for="categoryTshirt">Living Room <span class="text-gray-25 font-size-12 font-weight-normal"> (56)</span></label>
                                        </div>
                                    </div>
                                    <div class="form-group d-flex align-items-center justify-content-between mb-2 pb-1">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="categoryShoes">
                                            <label class="custom-control-label" for="categoryShoes">Adhesives<span class="text-gray-25 font-size-12 font-weight-normal"> (56)</span></label>
                                        </div>
                                    </div>
                                    <div class="form-group d-flex align-items-center justify-content-between mb-2 pb-1">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="categoryAccessories">
                                            <label class="custom-control-label" for="categoryAccessories">Electrical<span class="text-gray-25 font-size-12 font-weight-normal"> (56)</span></label>
                                        </div>
                                    </div>
                                    <div class="form-group d-flex align-items-center justify-content-between mb-2 pb-1">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="categoryTops">
                                            <label class="custom-control-label" for="categoryTops">Hardware's <span class="text-gray-25 font-size-12 font-weight-normal"> (56)</span></label>
                                        </div>
                                    </div>
                                    <div class="form-group d-flex align-items-center justify-content-between mb-2 pb-1">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="categoryBottom">
                                            <label class="custom-control-label" for="categoryBottom">Bathroom <span class="text-gray-25 font-size-12 font-weight-normal"> (56)</span></label>
                                        </div>
                                    </div>
                                    <!-- End Checkboxes -->

                                </div>
                                <div class="range-slider">
                                    <h4 class="font-size-14 mb-3 font-weight-bold">Price</h4>
                                    <!-- Range Slider -->
                                    <input class="js-range-slider" type="text"
                                           data-extra-classes="u-range-slider u-range-slider-indicator u-range-slider-grid"
                                           data-type="double"
                                           data-grid="false"
                                           data-hide-from-to="true"
                                           data-prefix="$"
                                           data-min="0"
                                           data-max="3456"
                                           data-from="0"
                                           data-to="3456"
                                           data-result-min="#rangeSliderExample3MinResult"
                                           data-result-max="#rangeSliderExample3MaxResult">
                                    <!-- End Range Slider -->
                                    <div class="mt-1 text-gray-111 d-flex mb-4">
                                        <span class="mr-0dot5">Price: </span>
                                        <span>$</span>
                                        <span id="rangeSliderExample3MinResult" class=""></span>
                                        <span class="mx-0dot5"> — </span>
                                        <span>$</span>
                                        <span id="rangeSliderExample3MaxResult" class=""></span>
                                    </div>
                                    <button type="submit" class="btn px-4 btn-primary-dark-w py-2 rounded-lg text-white">Filter</button>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-9 col-wd-9gdot5">
                            <div class="view_type_header">
                                <div class="px-3 d-none d-xl-block">
                                    <ul class="nav nav-tab-shop" id="pills-tab" role="tablist">
                                        <li class="nav-item">
                                            <a class="nav-link active" id="pills-one-example1-tab" data-toggle="pill" href="#pills-one-example1" role="tab" aria-controls="pills-one-example1" aria-selected="false">
                                                <div class="d-md-flex justify-content-md-center align-items-md-center">
                                                    <i class="fa fa-th"></i>
                                                </div>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="pills-four-example1-tab" data-toggle="pill" href="#pills-four-example1" role="tab" aria-controls="pills-four-example1" aria-selected="true">
                                                <div class="d-md-flex justify-content-md-center align-items-md-center">
                                                    <i class="fa fa-th-list"></i>
                                                </div>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="block_search_check">
                                <div class="tab-content" id="pills-tabContent">
                                    <div class="tab-pane fade pt-2 show active" id="pills-one-example1" role="tabpanel" aria-labelledby="pills-one-example1-tab" data-target-group="groups">
                                        <ul class="row list-unstyled products-group no-gutters">
                                            <li class="col-6 col-md-3 col-wd-2gdot4 product-item">
                                                <div class="product-item__outer h-100">
                                                    <div class="product-item__inner px-xl-4 p-3">
                                                        <div class="product-item__body pb-xl-2">
                                                            <div class="mb-2"><a href="#" class="font-size-12 text-gray-5">Speakers</a></div>
                                                            <h5 class="mb-1 product-item__title"><a href="#" class="text-blue font-weight-bold">Wireless Audio System Multiroom 360 degree Full base audio</a></h5>
                                                            <div class="mb-2">
                                                                <a href="#" class="d-block text-center">
                                                                    <img class="img-fluid" src="assets/img/cat_2.png" alt="Image Description">
                                                                </a>
                                                            </div>
                                                            <div class="flex-center-between mb-1">
                                                                <div class="prodcut-price">
                                                                    <div class="text-gray-100">$685,00</div>
                                                                </div>
                                                                <div class="d-none d-xl-block prodcut-add-cart">
                                                                    <a href="#" class="btn-add-cart btn-primary transition-3d-hover"><i class="ec ec-add-to-cart"></i></a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="col-6 col-md-3 col-wd-2gdot4 product-item">
                                                <div class="product-item__outer h-100">
                                                    <div class="product-item__inner px-xl-4 p-3">
                                                        <div class="product-item__body pb-xl-2">
                                                            <div class="mb-2"><a href="#" class="font-size-12 text-gray-5">Speakers</a></div>
                                                            <h5 class="mb-1 product-item__title"><a href="#" class="text-blue font-weight-bold">Wireless Audio System Multiroom 360 degree Full base audio</a></h5>
                                                            <div class="mb-2">
                                                                <a href="#" class="d-block text-center">
                                                                    <img class="img-fluid" src="assets/img/cat_1.png" alt="Image Description">
                                                                </a>
                                                            </div>
                                                            <div class="flex-center-between mb-1">
                                                                <div class="prodcut-price">
                                                                    <div class="text-gray-100">$685,00</div>
                                                                </div>
                                                                <div class="d-none d-xl-block prodcut-add-cart">
                                                                    <a href="#" class="btn-add-cart btn-primary transition-3d-hover"><i class="ec ec-add-to-cart"></i></a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="col-6 col-md-3 col-wd-2gdot4 product-item">
                                                <div class="product-item__outer h-100">
                                                    <div class="product-item__inner px-xl-4 p-3">
                                                        <div class="product-item__body pb-xl-2">
                                                            <div class="mb-2"><a href="#" class="font-size-12 text-gray-5">Speakers</a></div>
                                                            <h5 class="mb-1 product-item__title"><a href="#" class="text-blue font-weight-bold">Wireless Audio System Multiroom 360 degree Full base audio</a></h5>
                                                            <div class="mb-2">
                                                                <a href="#" class="d-block text-center">
                                                                    <img class="img-fluid" src="assets/img/cat_3.png" alt="Image Description">
                                                                </a>
                                                            </div>
                                                            <div class="flex-center-between mb-1">
                                                                <div class="prodcut-price">
                                                                    <div class="text-gray-100">$685,00</div>
                                                                </div>
                                                                <div class="d-none d-xl-block prodcut-add-cart">
                                                                    <a href="#" class="btn-add-cart btn-primary transition-3d-hover"><i class="ec ec-add-to-cart"></i></a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="col-6 col-md-3 col-wd-2gdot4 product-item">
                                                <div class="product-item__outer h-100">
                                                    <div class="product-item__inner px-xl-4 p-3">
                                                        <div class="product-item__body pb-xl-2">
                                                            <div class="mb-2"><a href="#" class="font-size-12 text-gray-5">Speakers</a></div>
                                                            <h5 class="mb-1 product-item__title"><a href="#" class="text-blue font-weight-bold">Wireless Audio System Multiroom 360 degree Full base audio</a></h5>
                                                            <div class="mb-2">
                                                                <a href="#" class="d-block text-center">
                                                                    <img class="img-fluid" src="assets/img/cat_home_4.png" alt="Image Description">
                                                                </a>
                                                            </div>
                                                            <div class="flex-center-between mb-1">
                                                                <div class="prodcut-price">
                                                                    <div class="text-gray-100">$685,00</div>
                                                                </div>
                                                                <div class="d-none d-xl-block prodcut-add-cart">
                                                                    <a href="#" class="btn-add-cart btn-primary transition-3d-hover"><i class="ec ec-add-to-cart"></i></a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="col-6 col-md-3 col-wd-2gdot4 product-item">
                                                <div class="product-item__outer h-100">
                                                    <div class="product-item__inner px-xl-4 p-3">
                                                        <div class="product-item__body pb-xl-2">
                                                            <div class="mb-2"><a href="#" class="font-size-12 text-gray-5">Speakers</a></div>
                                                            <h5 class="mb-1 product-item__title"><a href="#" class="text-blue font-weight-bold">Wireless Audio System Multiroom 360 degree Full base audio</a></h5>
                                                            <div class="mb-2">
                                                                <a href="#" class="d-block text-center">
                                                                    <img class="img-fluid" src="assets/img/cat_home_5.png" alt="Image Description">
                                                                </a>
                                                            </div>
                                                            <div class="flex-center-between mb-1">
                                                                <div class="prodcut-price">
                                                                    <div class="text-gray-100">$685,00</div>
                                                                </div>
                                                                <div class="d-none d-xl-block prodcut-add-cart">
                                                                    <a href="#" class="btn-add-cart btn-primary transition-3d-hover"><i class="ec ec-add-to-cart"></i></a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="col-6 col-md-3 col-wd-2gdot4 product-item">
                                                <div class="product-item__outer h-100">
                                                    <div class="product-item__inner px-xl-4 p-3">
                                                        <div class="product-item__body pb-xl-2">
                                                            <div class="mb-2"><a href="#" class="font-size-12 text-gray-5">Speakers</a></div>
                                                            <h5 class="mb-1 product-item__title"><a href="#" class="text-blue font-weight-bold">Wireless Audio System Multiroom 360 degree Full base audio</a></h5>
                                                            <div class="mb-2">
                                                                <a href="#" class="d-block text-center">
                                                                    <img class="img-fluid" src="assets/img/cat_2.png" alt="Image Description">
                                                                </a>
                                                            </div>
                                                            <div class="flex-center-between mb-1">
                                                                <div class="prodcut-price">
                                                                    <div class="text-gray-100">$685,00</div>
                                                                </div>
                                                                <div class="d-none d-xl-block prodcut-add-cart">
                                                                    <a href="#" class="btn-add-cart btn-primary transition-3d-hover"><i class="ec ec-add-to-cart"></i></a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="col-6 col-md-3 col-wd-2gdot4 product-item">
                                                <div class="product-item__outer h-100">
                                                    <div class="product-item__inner px-xl-4 p-3">
                                                        <div class="product-item__body pb-xl-2">
                                                            <div class="mb-2"><a href="#" class="font-size-12 text-gray-5">Speakers</a></div>
                                                            <h5 class="mb-1 product-item__title"><a href="#" class="text-blue font-weight-bold">Wireless Audio System Multiroom 360 degree Full base audio</a></h5>
                                                            <div class="mb-2">
                                                                <a href="#" class="d-block text-center">
                                                                    <img class="img-fluid" src="assets/img/cat_1.png" alt="Image Description">
                                                                </a>
                                                            </div>
                                                            <div class="flex-center-between mb-1">
                                                                <div class="prodcut-price">
                                                                    <div class="text-gray-100">$685,00</div>
                                                                </div>
                                                                <div class="d-none d-xl-block prodcut-add-cart">
                                                                    <a href="#" class="btn-add-cart btn-primary transition-3d-hover"><i class="ec ec-add-to-cart"></i></a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="col-6 col-md-3 col-wd-2gdot4 product-item">
                                                <div class="product-item__outer h-100">
                                                    <div class="product-item__inner px-xl-4 p-3">
                                                        <div class="product-item__body pb-xl-2">
                                                            <div class="mb-2"><a href="#" class="font-size-12 text-gray-5">Speakers</a></div>
                                                            <h5 class="mb-1 product-item__title"><a href="#" class="text-blue font-weight-bold">Wireless Audio System Multiroom 360 degree Full base audio</a></h5>
                                                            <div class="mb-2">
                                                                <a href="#" class="d-block text-center">
                                                                    <img class="img-fluid" src="assets/img/cat_3.png" alt="Image Description">
                                                                </a>
                                                            </div>
                                                            <div class="flex-center-between mb-1">
                                                                <div class="prodcut-price">
                                                                    <div class="text-gray-100">$685,00</div>
                                                                </div>
                                                                <div class="d-none d-xl-block prodcut-add-cart">
                                                                    <a href="#" class="btn-add-cart btn-primary transition-3d-hover"><i class="ec ec-add-to-cart"></i></a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="col-6 col-md-3 col-wd-2gdot4 product-item">
                                                <div class="product-item__outer h-100">
                                                    <div class="product-item__inner px-xl-4 p-3">
                                                        <div class="product-item__body pb-xl-2">
                                                            <div class="mb-2"><a href="#" class="font-size-12 text-gray-5">Speakers</a></div>
                                                            <h5 class="mb-1 product-item__title"><a href="#" class="text-blue font-weight-bold">Wireless Audio System Multiroom 360 degree Full base audio</a></h5>
                                                            <div class="mb-2">
                                                                <a href="#" class="d-block text-center">
                                                                    <img class="img-fluid" src="assets/img/cat_home_4.png" alt="Image Description">
                                                                </a>
                                                            </div>
                                                            <div class="flex-center-between mb-1">
                                                                <div class="prodcut-price">
                                                                    <div class="text-gray-100">$685,00</div>
                                                                </div>
                                                                <div class="d-none d-xl-block prodcut-add-cart">
                                                                    <a href="#" class="btn-add-cart btn-primary transition-3d-hover"><i class="ec ec-add-to-cart"></i></a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="col-6 col-md-3 col-wd-2gdot4 product-item">
                                                <div class="product-item__outer h-100">
                                                    <div class="product-item__inner px-xl-4 p-3">
                                                        <div class="product-item__body pb-xl-2">
                                                            <div class="mb-2"><a href="#" class="font-size-12 text-gray-5">Speakers</a></div>
                                                            <h5 class="mb-1 product-item__title"><a href="#" class="text-blue font-weight-bold">Wireless Audio System Multiroom 360 degree Full base audio</a></h5>
                                                            <div class="mb-2">
                                                                <a href="#" class="d-block text-center">
                                                                    <img class="img-fluid" src="assets/img/cat_home_5.png" alt="Image Description">
                                                                </a>
                                                            </div>
                                                            <div class="flex-center-between mb-1">
                                                                <div class="prodcut-price">
                                                                    <div class="text-gray-100">$685,00</div>
                                                                </div>
                                                                <div class="d-none d-xl-block prodcut-add-cart">
                                                                    <a href="#" class="btn-add-cart btn-primary transition-3d-hover"><i class="ec ec-add-to-cart"></i></a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="tab-pane fade pt-2" id="pills-four-example1" role="tabpanel" aria-labelledby="pills-four-example1-tab" data-target-group="groups">
                                        <ul class="d-block list-unstyled products-group prodcut-list-view-small">
                                            <li class="product-item remove-divider">
                                                <div class="product-item__outer w-100">
                                                    <div class="product-item__inner remove-prodcut-hover py-4 row">
                                                        <div class="product-item__header col-6 col-md-2">
                                                            <div class="mb-2">
                                                                <a href="#" class="d-block text-center">
                                                                    <img class="img-fluid" src="assets/img/cat_2.png" alt="Image Description">
                                                                </a>
                                                            </div>
                                                        </div>
                                                        <div class="product-item__body col-6 col-md-10">
                                                            <div class="pr-lg-10">
                                                                <div class="mb-2"><a href="#" class="font-size-12 text-gray-5">Speakers</a></div>
                                                                <h5 class="mb-2 product-item__title"><a href="#" class="text-blue font-weight-bold">Wireless Audio System Multiroom 360 degree Full base audio</a></h5>

                                                                <div class="mb-2 flex-center-between">
                                                                    <div class="prodcut-price">
                                                                        <div class="text-gray-100">$685,00</div>
                                                                    </div>
                                                                    <div class="prodcut-add-cart">
                                                                        <a href="#" class="btn-add-cart btn-primary transition-3d-hover"><i class="ec ec-add-to-cart"></i></a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                            </li>
                                            <li class="product-item remove-divider">
                                                <div class="product-item__outer w-100">
                                                    <div class="product-item__inner remove-prodcut-hover py-4 row">
                                                        <div class="product-item__header col-6 col-md-2">
                                                            <div class="mb-2">
                                                                <a href="#" class="d-block text-center">
                                                                    <img class="img-fluid" src="assets/img/cat_1.png" alt="Image Description">
                                                                </a>
                                                            </div>
                                                        </div>
                                                        <div class="product-item__body col-6 col-md-10">
                                                            <div class="pr-lg-10">
                                                                <div class="mb-2"><a href="#" class="font-size-12 text-gray-5">Speakers</a></div>
                                                                <h5 class="mb-2 product-item__title"><a href="#" class="text-blue font-weight-bold">Wireless Audio System Multiroom 360 degree Full base audio</a></h5>

                                                                <div class="mb-2 flex-center-between">
                                                                    <div class="prodcut-price">
                                                                        <div class="text-gray-100">$685,00</div>
                                                                    </div>
                                                                    <div class="prodcut-add-cart">
                                                                        <a href="#" class="btn-add-cart btn-primary transition-3d-hover"><i class="ec ec-add-to-cart"></i></a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                            </li>
                                            <li class="product-item remove-divider">
                                                <div class="product-item__outer w-100">
                                                    <div class="product-item__inner remove-prodcut-hover py-4 row">
                                                        <div class="product-item__header col-6 col-md-2">
                                                            <div class="mb-2">
                                                                <a href="#" class="d-block text-center">
                                                                    <img class="img-fluid" src="assets/img/cat_3.png" alt="Image Description">
                                                                </a>
                                                            </div>
                                                        </div>
                                                        <div class="product-item__body col-6 col-md-10">
                                                            <div class="pr-lg-10">
                                                                <div class="mb-2"><a href="#" class="font-size-12 text-gray-5">Speakers</a></div>
                                                                <h5 class="mb-2 product-item__title"><a href="#" class="text-blue font-weight-bold">Wireless Audio System Multiroom 360 degree Full base audio</a></h5>

                                                                <div class="mb-2 flex-center-between">
                                                                    <div class="prodcut-price">
                                                                        <div class="text-gray-100">$685,00</div>
                                                                    </div>
                                                                    <div class="prodcut-add-cart">
                                                                        <a href="#" class="btn-add-cart btn-primary transition-3d-hover"><i class="ec ec-add-to-cart"></i></a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                            </li>
                                            <li class="product-item remove-divider">
                                                <div class="product-item__outer w-100">
                                                    <div class="product-item__inner remove-prodcut-hover py-4 row">
                                                        <div class="product-item__header col-6 col-md-2">
                                                            <div class="mb-2">
                                                                <a href="#" class="d-block text-center">
                                                                    <img class="img-fluid" src="assets/img/cat_home_4.png" alt="Image Description">
                                                                </a>
                                                            </div>
                                                        </div>
                                                        <div class="product-item__body col-6 col-md-10">
                                                            <div class="pr-lg-10">
                                                                <div class="mb-2"><a href="#" class="font-size-12 text-gray-5">Speakers</a></div>
                                                                <h5 class="mb-2 product-item__title"><a href="#" class="text-blue font-weight-bold">Wireless Audio System Multiroom 360 degree Full base audio</a></h5>

                                                                <div class="mb-2 flex-center-between">
                                                                    <div class="prodcut-price">
                                                                        <div class="text-gray-100">$685,00</div>
                                                                    </div>
                                                                    <div class="prodcut-add-cart">
                                                                        <a href="#" class="btn-add-cart btn-primary transition-3d-hover"><i class="ec ec-add-to-cart"></i></a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                </div>

                            </div>
                            <!-- End Shop Pagination -->
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</header>
