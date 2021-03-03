@extends('front.layouts.master')
@section('metaTags')
    <title>YouMats | {{ $vendor->name }}</title>
    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta property="og:url" content="{{url()->current()}}" />
    <meta property="og:title" content="" />
    <meta property="og:description" content="" />
    <meta property="og:image" content="" />
    <meta name="twitter:card" content="summary">
    <meta name="twitter:site" content="@YouMats">
    <meta name="twitter:title" content="">
    <meta name="twitter:description" content="">
    <meta name="twitter:image" content="">
@endsection
@section('content')
    <div class="bg-gray-13 bg-md-transparent">
        <div class="container">
            <!-- breadcrumb -->
            <div class="my-md-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-3 flex-nowrap flex-xl-wrap overflow-auto overflow-xl-visble">
                        <li class="breadcrumb-item flex-shrink-0 flex-xl-shrink-1"><a href="{{ route('home') }}">{{ __('Home') }}</a></li>
                        <li class="breadcrumb-item flex-shrink-0 flex-xl-shrink-1 active" aria-current="page">{{ $vendor->name }}</li>
                    </ol>
                </nav>
            </div>
            <!-- End breadcrumb -->
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="img_vendor">
                    <img src="{{ $vendor->getFirstMediaUrlOrDefault(VENDOR_COVER)['url'] }}" class="photo_cover_vendor">
                </div>
                <img src="{{ $vendor->getFirstMediaUrlOrDefault(VENDOR_LOGO)['url'] }}" class="photo_profile_vendor">
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="info_main_vendor">
                    <h3>{{ $vendor->name }}</h3>
                    <p>{{ __('Started') . ' ' . $vendor->created_at->format('d/m/Y') }}</p>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="position-relative position-md-static px-md-6">
                    <ul class="nav nav-classic nav-tab nav-tab-lg justify-content-xl-center flex-nowrap flex-xl-wrap overflow-auto overflow-xl-visble border-0 pb-1 pb-xl-0 mb-n1 mb-xl-0" id="pills-tab-8" role="tablist">
                        <li class="nav-item flex-shrink-0 flex-xl-shrink-1 z-index-2">
                            <a class="nav-link active" id="Jpills-one-example1-tab" data-toggle="pill" href="#Jpills-one-example1" role="tab" aria-controls="Jpills-one-example1" aria-selected="true">{{ __('Information') }}</a>
                        </li>
                        <li class="nav-item flex-shrink-0 flex-xl-shrink-1 z-index-2">
                            <a class="nav-link" id="Jpills-two-example1-tab" data-toggle="pill" href="#Jpills-two-example1" role="tab" aria-controls="Jpills-two-example1" aria-selected="false">{{ __('Products') }}</a>
                        </li>
                        <li class="nav-item flex-shrink-0 flex-xl-shrink-1 z-index-2">
                            <a class="nav-link" id="Jpills-three-example1-tab" data-toggle="pill" href="#Jpills-three-example1" role="tab" aria-controls="Jpills-three-example1" aria-selected="false">{{ __('Branches') }}</a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-md-12">
                <div class="borders-radius-17 border p-4 mt-4 mt-md-0 px-lg-10 py-lg-9 mb-5">
                    <div class="tab-content" id="Jpills-tabContent">
                    <div class="tab-pane fade active show" id="Jpills-one-example1" role="tabpanel" aria-labelledby="Jpills-one-example1-tab">
                        <div class="block_info_vendor">
                            <div class="row">
                                <div class="col-md-12 mb-5">
                                    <table class="table table-bordered">
                                        <tbody>
                                        <tr>
                                            <th class="pt-3 pb-3 pl-3 w-25">{{ __('Full Name') }}</th>
                                            <td class="pt-3 pb-3 pl-3">{{ $vendor->name }}</td>
                                        </tr>
                                        <tr>
                                            <th class="pt-3 pb-3 pl-3 w-25">{{ __('EMail') }}</th>
                                            <td class="pt-3 pb-3 pl-3">{{ $vendor->email }}</td>
                                        </tr>
                                        <tr>
                                            <th class="pt-3 pb-3 pl-3 w-25">{{ __('Phone')  }}</th>
                                            <td class="pt-3 pb-3 pl-3">{{ $vendor->phone }}</td>
                                        </tr>
                                        <tr>
                                            <th class="pt-3 pb-3 pl-3 w-25">{{ __('Phone Number 2') }}</th>
                                            <td class="pt-3 pb-3 pl-3">{{ $vendor->phone2 }}</td>
                                        </tr>
                                        <tr>
                                            <th class="pt-3 pb-3 pl-3 w-25">{{ __('WhatsApp')  }}</th>
                                            <td class="pt-3 pb-3 pl-3">{{ $vendor->whatsapp_phone }}</td>
                                        </tr>
                                        <tr>
                                            <th class="pt-3 pb-3 pl-3 w-25">{{ __('Address') }}</th>
                                            <td class="pt-3 pb-3 pl-3">{{ $vendor->address }}</td>
                                        </tr>
                                        @if($vendor->address2)
                                            <tr>
                                                <th class="pt-3 pb-3 pl-3 w-25">{{ __('Address 2') }}</th>
                                                <td class="pt-3 pb-3 pl-3">{{ $vendor->address2 }}</td>
                                            </tr>
                                        @endif
                                        @if($vendor->facebook_url)
                                            <tr>
                                                <th class="pt-3 pb-3 pl-3 w-25">{{ __('Facebook')  }}</th>
                                                <td class="pt-3 pb-3 pl-3">{{ $vendor->facebook_url }}</td>
                                            </tr>
                                        @endif
                                        @if($vendor->twitter_url)
                                            <tr>
                                                <th class="pt-3 pb-3 pl-3 w-25">{{ __('Twitter')  }}</th>
                                                <td class="pt-3 pb-3 pl-3">{{ $vendor->twitter_url }}</td>
                                            </tr>
                                        @endif
                                        @if($vendor->youtube_url)
                                            <tr>
                                                <th class="pt-3 pb-3 pl-3 w-25">{{ __('Youtube')  }}</th>
                                                <td class="pt-3 pb-3 pl-3">{{ $vendor->youtube_url }}</td>
                                            </tr>
                                        @endif
                                        @if($vendor->instagram_url)
                                            <tr>
                                                <th class="pt-3 pb-3 pl-3 w-25">{{ __('Instagram')  }}</th>
                                                <td class="pt-3 pb-3 pl-3">{{ $vendor->instagram_url }}</td>
                                            </tr>
                                        @endif
                                        @if($vendor->pinterest_url)
                                            <tr>
                                                <th class="pt-3 pb-3 pl-3 w-25">{{ __('Pinterest')  }}</th>
                                                <td class="pt-3 pb-3 pl-3">{{ $vendor->pinterest_url }}</td>
                                            </tr>
                                        @endif
                                        @if($vendor->website_url)
                                            <tr>
                                                <th class="pt-3 pb-3 pl-3 w-25">{{ __('Website')  }}</th>
                                                <td class="pt-3 pb-3 pl-3">{{ $vendor->website_url }}</td>
                                            </tr>
                                        @endif
                                        <tr>
                                            <th class="pt-3 pb-3 pl-3 w-25">{{ __('Verified') }}</th>
                                            <td class="pt-3 pb-3 pl-3">@if($vendor->active) <i class="fas fa-check-circle"></i> @else <i class="fas fa-times-circle"></i> @endif</td>
                                        </tr>
                                        <tr>
                                            <th class="pt-3 pb-3 pl-3 w-25">{{ __('Featured') }}</th>
                                            <td class="pt-3 pb-3 pl-3">@if($vendor->isFeatured) <i class="fas fa-check-circle"></i> @else <i class="fas fa-times-circle"></i> @endif</td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="Jpills-two-example1" role="tabpanel" aria-labelledby="Jpills-one-example1-tab">
                        @if(count($products) > 0)
                            <ul class="row list-unstyled products-group no-gutters">
                                @foreach($products as $product)
                                    <li class="col-6 col-md-3 col-wd-2gdot4 product-item">
                                        @include('front.layouts.partials.product_box', ['product' => $product, 'view' => 'grid'])
                                    </li>
                                @endforeach
                            </ul>
                            {{ $products->links() }}
                        @else
                            <h4>{{ __('You do not have products') }}</h4>
                        @endif
                    </div>
                    <div class="tab-pane fade" id="Jpills-three-example1" role="tabpanel" aria-labelledby="Jpills-one-example1-tab">
                        @if(count($branches) > 0)
                            @foreach($branches as $branch)
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="border-bottom border-color-1 mb-5">
                                            <h3 class="section-title mb-0 pb-2 font-size-25"> {{ $branch->name }} </h3>
                                        </div>
                                    </div>
                                    <div class="col-md-8 col-xl-8">
                                        <div class="map_branches">
                                            <iframe src="https://maps.google.com/maps?q={{ $branch->latitude }},{{ $branch->longitude }}&hl=es&z=14&amp;output=embed" width="100%" height="250" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-xl-4">
                                        <h5 class="font-size-14 font-weight-bold mb-3">{{ __('Main Information') }}</h5>
                                        <div class="">
                                            <ul class="list-unstyled-branches mb-6">
                                                <li class="row">
                                                    <div class="col-md-2">
                                                        <i class="fas fa-phone"></i>
                                                    </div>
                                                    <div class="col-md-10 mt-2">
                                                        <b>{{ __('Phone') }}:</b>
                                                        <span class=""> {{ $branch->phone_number }} </span>
                                                    </div>
                                                </li>
                                                @if($branch->fax)
                                                    <li class="row">
                                                        <div class="col-md-2">
                                                            <i class="fas fa-fax"></i>
                                                        </div>
                                                        <div class="col-md-10 mt-2">
                                                            <b>{{ __('Fax') }}:</b>
                                                            <span class=""> {{ $branch->fax }} </span>
                                                        </div>
                                                    </li>
                                                @endif
                                                @if($branch->website)
                                                    <li class="row">
                                                        <div class="col-md-2">
                                                            <i class="fas fa-globe-americas"></i>
                                                        </div>
                                                        <div class="col-md-10 mt-2">
                                                            <b>{{ __('Website') }}:</b>
                                                            <span class=""> {{ $branch->website }} </span>
                                                        </div>
                                                    </li>
                                                @endif
                                                <li class="row">
                                                    <div class="col-md-2">
                                                        <i class="fas fa-map-marker-alt"></i>
                                                    </div>
                                                    <div class="col-md-10 mt-2">
                                                        <b>{{ __('Address') }}:</b>
                                                        <span class=""> {{ $branch->address }} </span>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                            {{ $branches->links() }}
                        @else
                            <h4>{{ __('You do not have any branches') }}</h4>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('extraScripts')
    <script type="text/javascript">
        $(".btn-add-cart").on('click', function(){
            let url = $(this).data('url');

            $.ajax({
                type: 'POST',
                url: url,
                data: { _token: '{{ csrf_token() }}' }
            })
            .done(function(response) {
                $('#cartCount').html(response.count);
                $('#cartTotal').html(response.total);
                toastr.success(response.message);
            })
            .fail(function(response) {
                toastr.error(response.responseJSON.message);
            })
        })

        $(".btn-add-wishlist").on('click', function(){
            let url = $(this).data('url');

            $.ajax({
                type: 'POST',
                url: url,
                data: { _token: '{{ csrf_token() }}' }
            })
                .done(function(response) {
                    if(response.status)
                        toastr.success(response.message);
                    else
                        toastr.warning(response.message)


                    console.log(response);
                })
                .fail(function(response) {
                    toastr.error(response.responseJSON.message);
                })
        })
    </script>
@endsection

