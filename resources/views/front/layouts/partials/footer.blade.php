<footer>
    <div class="bg-primary py-3 text-white">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-7 mb-md-3 mb-lg-0">
                    <div class="row align-items-center">
                        <div class="col-auto flex-horizontal-center">
                            <i class="ec ec-newsletter font-size-40"></i>
                            <h2 class="font-size-20 mb-0 ml-3">Sign up to Newsletter</h2>
                        </div>
                    </div>
                </div>
                <div class="col-lg-5">
                    <!-- Subscribe Form -->
                    <form class="js-form-message" id="subscribeForm">
                        @csrf
                        <label class="sr-only">Email address</label>
                        <div class="input-group input-group-pill">
                            <input type="email" class="form-control border-0 height-40" name="email" placeholder="Email address" aria-label="Email address" required>
                            <div class="input-group-append">
                                <button type="submit" class="btn btn-dark btn-sm-wide height-40 py-2">Subscribe</button>
                            </div>
                        </div>
                    </form>
                    <!-- End Subscribe Form -->
                </div>
            </div>
        </div>
    </div>

    <div class="pt-8 pb-4 bg-gray-13">
        <div class="container mt-1">
            <div class="row">
                <div class="col-lg-5">
                    <div class="mb-6">
                        <a href="{{route('home')}}" class="d-inline-block">
                            <img src="{{front_url()}}/assets/img/logo.png" height="50">
                        </a>
                    </div>
                    <div class="mb-4">
                        <div class="row no-gutters">
                            <div class="col-auto">
                                <i class="ec ec-support text-primary font-size-56"></i>
                            </div>
                            <div class="col pl-3">
                                <div class="font-size-13 font-weight-light">Got questions? Call us 24/7!</div>
                                <a href="tel:+966112111877" class="font-size-20 text-gray-90">(00966) 502111754, </a><a href="tel:+00966112111877" class="font-size-20 text-gray-90">(00966) 112111877</a>
                            </div>
                        </div>
                    </div>
                    <div class="mb-4">
                        <h6 class="mb-1 font-weight-bold">Contact info</h6>
                        <address class="">
                            Building No 6249- Hamzah Ibn Abdul Muttalib, Dhahrat Al Badi'ah , Riyadh
                        </address>
                    </div>
                    <div class="my-4 my-md-4">
                        <ul class="list-inline mb-0 opacity-7">
                            <li class="list-inline-item mr-0">
                                <a class="btn font-size-20 btn-icon btn-soft-dark btn-bg-transparent rounded-circle" href="#">
                                    <span class="fab fa-facebook-f btn-icon__inner"></span>
                                </a>
                            </li>
                            <li class="list-inline-item mr-0">
                                <a class="btn font-size-20 btn-icon btn-soft-dark btn-bg-transparent rounded-circle" href="#">
                                    <span class="fab fa-google btn-icon__inner"></span>
                                </a>
                            </li>
                            <li class="list-inline-item mr-0">
                                <a class="btn font-size-20 btn-icon btn-soft-dark btn-bg-transparent rounded-circle" href="#">
                                    <span class="fab fa-twitter btn-icon__inner"></span>
                                </a>
                            </li>
                            <li class="list-inline-item mr-0">
                                <a class="btn font-size-20 btn-icon btn-soft-dark btn-bg-transparent rounded-circle" href="#">
                                    <span class="fab fa-github btn-icon__inner"></span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-7">
                    <div class="row">
                        <div class="col-12 col-md mb-4 mb-md-0">
                            <h6 class="mb-3 font-weight-bold">Find it Fast</h6>
                            <!-- List Group -->
                            <ul class="list-group list-group-flush list-group-borderless mb-0 list-group-transparent">
                                <li><a class="list-group-item list-group-item-action" href="#">Landscaping</a></li>
                                <li><a class="list-group-item list-group-item-action" href="#">Office & School Supplies</a></li>
                                <li><a class="list-group-item list-group-item-action" href="#">Shade and Screen</a></li>
                                <li><a class="list-group-item list-group-item-action" href="#">Tools and Spares</a></li>
                                <li><a class="list-group-item list-group-item-action" href="#">Safety Products</a></li>
                                <li><a class="list-group-item list-group-item-action" href="#">Construction Equipment</a></li>
                                <li><a class="list-group-item list-group-item-action" href="#">Precast Concrete</a></li>
                            </ul>
                            <!-- End List Group -->
                        </div>

                        <div class="col-12 col-md mb-4 mb-md-0">
                            <!-- List Group -->
                            <ul class="list-group list-group-flush list-group-borderless mb-0 list-group-transparent mt-md-6">
                                <li><a class="list-group-item list-group-item-action" href="#">Door Windows Hardware</a></li>
                                <li><a class="list-group-item list-group-item-action" href="#">Hardware Supplies</a></li>
                                <li><a class="list-group-item list-group-item-action" href="#">Planting Basins</a></li>
                                <li><a class="list-group-item list-group-item-action" href="#">Glass and Mirrors</a></li>
                                <li><a class="list-group-item list-group-item-action" href="#">Bathroom Glass Show</a></li>
                            </ul>
                            <!-- End List Group -->
                        </div>

                        <div class="col-12 col-md mb-4 mb-md-0">
                            <h6 class="mb-3 font-weight-bold">Customer Care</h6>
                            <!-- List Group -->
                            <ul class="list-group list-group-flush list-group-borderless mb-0 list-group-transparent">
                                <li><a class="list-group-item list-group-item-action" href="#">My Account</a></li>
                                <li><a class="list-group-item list-group-item-action" href="#">Wish List</a></li>
                                <li><a class="list-group-item list-group-item-action" href="{{route('front.team.index')}}">Our Team</a></li>
                                @foreach($pages as $page)
                                <li><a class="list-group-item list-group-item-action" href="{{route('front.page.index', [$page->slug])}}">{{$page->title}}</a></li>
                                @endforeach
                                <li><a class="list-group-item list-group-item-action" href="{{route('front.faqs.page')}}">FAQs</a></li>
                            </ul>
                            <!-- End List Group -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="bg-gray-14 py-2">
        <div class="container">
            <div class="flex-center-between d-block d-md-flex">
                <div class="mb-3 mb-md-0">© <a href="#" class="font-weight-bold text-gray-90">SeoEra</a> - All rights Reserved</div>
                <div class="text-md-right">
                            <span class="d-inline-block bg-white border rounded p-1">
                                <img class="max-width-5" src="assets/img/patment-icon_1.png" alt="Image Description">
                            </span>
                    <span class="d-inline-block bg-white border rounded p-1">
                                <img class="max-width-5" src="assets/img/patment-icon_2.png" alt="Image Description">
                            </span>
                </div>
            </div>
        </div>
    </div>

</footer>
<aside id="sidebarContent" class="u-sidebar u-sidebar__lg" aria-labelledby="sidebarNavToggler">
    <div class="u-sidebar__scroller">
        <div class="u-sidebar__container">
            <div class="js-scrollbar u-header-sidebar__footer-offset pb-3">
                <!-- Toggle Button -->
                <div class="d-flex align-items-center pt-4 px-7">
                    <button type="button" class="close ml-auto"
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
                        <i class="ec ec-close-remove"></i>
                    </button>
                </div>
                <!-- End Toggle Button -->

                <!-- Content -->
                <div class="js-scrollbar u-sidebar__body">
                    <div class="u-sidebar__content u-header-sidebar__content">
                        <form id="inquireForm" enctype="multipart/form-data">
                            @csrf
                            <!-- Login -->
                            <div id="login" data-target-group="idForm">
                                <!-- Title -->
                                <header class="text-center mb-7">
                                    <h2 class="h4 mb-0">Register Quotation!</h2>
                                    <p>Login to manage your account.</p>
                                </header>
                                <!-- End Title -->

                                <!-- Form Group -->
                                <div class="form-group">
                                    <div class="js-form-message js-focus-state">
                                        <label class="sr-only">Company Name</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">
                                                    <span class="fas fa-building"></span>
                                                </span>
                                            </div>
                                            <input type="text" class="form-control" name="company_name" placeholder="Company Name">
                                        </div>
                                    </div>
                                </div>
                                <!-- End Form Group -->

                                <!-- Form Group -->
                                <div class="form-group">
                                    <div class="js-form-message js-focus-state">
                                        <label class="sr-only">Contact Person</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">
                                                    <span class="fas fa-user"></span>
                                                </span>
                                            </div>
                                            <input type="text" class="form-control" name="name" placeholder="Contact Person">
                                        </div>
                                    </div>
                                </div>
                                <!-- End Form Group -->

                                <!-- Form Group -->
                                <div class="form-group">
                                    <div class="js-form-message js-focus-state">
                                        <label class="sr-only">Email</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" >
                                                    <span class="fas fa-envelope"></span>
                                                </span>
                                            </div>
                                            <input type="text" class="form-control" name="email"  placeholder="Email">
                                        </div>
                                    </div>
                                </div>
                                <!-- End Form Group -->

                                <!-- Form Group -->
                                <div class="form-group">
                                    <div class="js-form-message js-focus-state">
                                        <label class="sr-only">Phone</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">
                                                    <span class="fas fa-phone"></span>
                                                </span>
                                            </div>
                                            <input type="text" class="form-control" name="phone" placeholder="Phone">
                                        </div>
                                    </div>
                                </div>
                                <!-- End Form Group -->

                                <!-- Form Group -->
                                <div class="form-group">
                                    <div class="js-form-message js-focus-state">
                                        <label class="sr-only">Message</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">
                                                    <span class="fas fa-sticky-note"></span>
                                                </span>
                                            </div>
                                            <textarea class="form-control" name="message" placeholder="Message"></textarea>
                                        </div>
                                    </div>
                                </div>
                                <!-- End Form Group -->

                                <!-- Form Group -->
                                <div class="form-group">
                                    <!-- actual upload which is hidden -->
                                    <input type="file" name="file" id="actual-btn" hidden/>

                                    <!-- our custom upload button -->
                                    <label class="ub_file" for="actual-btn">Choose File</label>

                                    <!-- name of file chosen -->
                                    <span id="file-chosen">No file chosen</span>
                                </div>
                                <!-- End Form Group -->




                                <div class="mb-2">
                                    <button type="submit" class="btn btn-block btn-sm btn-primary transition-3d-hover">Send Now</button>
                                </div>

                            </div>
                        </form>
                    </div>
                </div>
                <!-- End Content -->
            </div>
        </div>
    </div>
</aside>
<a class="js-go-to u-go-to" href="#" data-position='{"bottom": 15, "right": 15 }' data-type="fixed" data-offset-top="400" data-compensation="#header" data-show-effect="slideInUp" data-hide-effect="slideOutDown">
    <span class="fas fa-arrow-up u-go-to__inner"></span>
</a>
