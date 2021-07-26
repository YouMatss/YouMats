<!-- Team -->
@if(count($vendors) > 0)
    <section id="team" class="pb-5">
        <div class="container">
            <div class="d-flex justify-content-between border-bottom border-color-1 flex-lg-nowrap flex-wrap border-md-down-top-0 border-md-down-bottom-0 mb-3 rtl">
                <h3 class="section-title section-title__full mb-0 pb-2 font-size-22">{{__('home.suppliers_title')}}</h3>
            </div>
            <div class="row rtl">
                @foreach($vendors as $vendor)
                    <div class="col-xs-12 col-sm-6 col-md-3">
                        <div class="image-flip" >
                            <div class="mainflip flip-0">
                                <div class="frontside">
                                    <div class="card">
                                        <div class="card-body text-center">
                                            <p><img class="img-fluid" src="{{$vendor->getFirstMediaUrlOrDefault(TEAM_PATH)['url']}}" alt="{{$vendor->getFirstMediaUrlOrDefault(TEAM_PATH)['alt']}}" title="{{$vendor->getFirstMediaUrlOrDefault(TEAM_PATH)['title']}}"></p>
                                            <h4 class="card-title">{{$vendor->name}}</h4>
                                            <a href="{{ route('vendor.show', [$vendor->slug]) }}" class="btn btn-primary btn-sm icon-plus_team">{{ __('home.show_vendor') }}</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="backside">
                                    <div class="card">
                                        <div class="card-body text-center mt-4">
                                            <h4 class="card-title">{{$vendor->name}}</h4>
                                            <h4 class="card-title">{{$vendor->phone}}</h4>
                                            <ul class="list-inline">
                                                @if(isset($vendor->facebook_url))
                                                    <li class="list-inline-item">
                                                        <a class="social-icon text-xs-center" target="_blank" href="{{$vendor->facebook_url}}">
                                                            <i class="fab fa-facebook-f"></i>
                                                        </a>
                                                    </li>
                                                @endif
                                                @if(isset($vendor->twitter_url))
                                                    <li class="list-inline-item">
                                                        <a class="social-icon text-xs-center" target="_blank" href="{{$vendor->twitter_url}}">
                                                            <i class="fab fa-twitter"></i>
                                                        </a>
                                                    </li>
                                                @endif
                                                @if(isset($vendor->youtube_url))
                                                    <li class="list-inline-item">
                                                        <a class="social-icon text-xs-center" target="_blank" href="{{$vendor->youtube_url}}">
                                                            <i class="fab fa-youtube"></i>
                                                        </a>
                                                    </li>
                                                @endif
                                            </ul>
                                            <a style="color: #fff !important; font-size: 0.875rem !important;" href="{{ route('vendor.show', [$vendor->slug]) }}" class="btn btn-primary btn-sm icon-plus_team">{{ __('home.show_vendor') }}</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endif
