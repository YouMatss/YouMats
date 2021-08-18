@extends('front.layouts.master')
@section('metaTags')
    <title>YouMats | {{ $vendor->name . ' ' . _('Profile') }}</title>
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
                        <li class="breadcrumb-item flex-shrink-0 flex-xl-shrink-1 active" aria-current="page">{{ __('Vendor Profile') }}</li>
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
                            <a class="nav-link active" id="Jpills-one-example1-tab" data-toggle="pill" href="#Jpills-one-example1" role="tab" aria-controls="Jpills-one-example1" aria-selected="true">{{ __('vendor.main_info') }}</a>
                        </li>
                        <li class="nav-item flex-shrink-0 flex-xl-shrink-1 z-index-2">
                            <a class="nav-link" id="Jpills-shipping-example1-tab" data-toggle="pill" href="#Jpills-shipping-example1" role="tab" aria-controls="Jpills-shipping-example1" aria-selected="false">{{ __('vendor.shipping') }}</a>
                        </li>
                        <li class="nav-item flex-shrink-0 flex-xl-shrink-1 z-index-2">
                            <a class="nav-link" id="Jpills-contacts-example1-tab" data-toggle="pill" href="#Jpills-contacts-example1" role="tab" aria-controls="Jpills-contacts-example1" aria-selected="false">{{ __('vendor.contacts') }}</a>
                        </li>
                        <li class="nav-item flex-shrink-0 flex-xl-shrink-1 z-index-2">
                            <a class="nav-link" id="Jpills-two-example1-tab" data-toggle="pill" href="#Jpills-two-example1" role="tab" aria-controls="Jpills-two-example1" aria-selected="false">{{ __('vendor.products') }}</a>
                        </li>
                        <li class="nav-item flex-shrink-0 flex-xl-shrink-1 z-index-2">
                            <a class="nav-link" id="Jpills-three-example1-tab" data-toggle="pill" href="#Jpills-three-example1" role="tab" aria-controls="Jpills-three-example1" aria-selected="false">{{ __('vendor.branches') }}</a>
                        </li>
                        <li class="nav-item flex-shrink-0 flex-xl-shrink-1 z-index-2">
                            <a class="nav-link" id="Jpills-four-example1-tab" data-toggle="pill" href="#Jpills-four-example1" role="tab" aria-controls="Jpills-four-example1" aria-selected="false">
                                {{ __('vendor.orders') }} </a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-md-12">
                <div class="borders-radius-17 border p-4 mt-4 mt-md-0 px-lg-10 py-lg-9 mb-5">
                    <div class="tab-content" id="Jpills-tabContent">
                        @if(!$vendor->active)
                            <div class="alert alert-warning">{{ __('vendor.account_not_active') }}</div>
                        @endif
                        <div class="tab-pane fade active show" id="Jpills-one-example1" role="tabpanel" aria-labelledby="Jpills-one-example1-tab">
                            <div class="block_info_vendor">
                                @if(Session::has('message'))<div class="alert alert-success">{{ Session::get('message') }}</div>@endif
                                <form method="POST" action="{{ route('vendor.update') }}" enctype="multipart/form-data">
                                    <input name="id" type="hidden" value="{{$vendor->id}}">
                                    @csrf
                                    @method('PATCH')
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="box_img_v">
                                                <img src="{{ $vendor->getFirstMediaUrlOrDefault(VENDOR_COVER)['url'] }}" class="photo_cover_vendor">
                                            </div>
                                        </div>
                                        <div class="col-md-3 ml-auto">
                                            <div class="box_img_profile">
                                                <img src="{{ $vendor->getFirstMediaUrlOrDefault(VENDOR_LOGO)['url'] }}" class="photo_cover_vendor">
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="js-form-message form-group mb-5">
                                                <label class="form-label"> {{ __('vendor.image_cover') }} <span class="text-danger">*</span></label>
                                                <div class="box">
                                                    <input type="file" name="cover" id="file-7" class="inputfile inputfile-6" data-multiple-caption="{count} files selected" />
                                                    <label for="file-7">
                                                        <span></span>
                                                        <strong>{{ __('vendor.choose_a_file') }}&hellip;</strong>
                                                    </label>
                                                </div>
                                                @error('cover')
                                                <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="js-form-message form-group mb-5">
                                                <label class="form-label"> {{ __('vendor.profile_image') }} <span class="text-danger">*</span></label>
                                                <div class="box">
                                                    <input type="file" name="logo" id="file-8" class="inputfile inputfile-6" data-multiple-caption="{count} files selected" />
                                                    <label for="file-8">
                                                        <span></span>
                                                        <strong>{{ __('vendor.choose_a_file') }}&hellip;</strong>
                                                    </label>
                                                </div>
                                                @error('logo')
                                                <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="js-form-message form-group mb-5">
                                                <label class="form-label">{{ __('vendor.full_name') }}<span class="text-danger"> ({{ __('vendor.english') }})*</span></label>
                                                <input type="text" class="form-control @error('name_en') is-invalid @enderror" name="name_en" value="{{ $vendor->getTranslation('name','en') }}" placeholder="{{__('vendor.name_en_placeholder')}}" required="">
                                                @error('name_en')
                                                <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="js-form-message form-group mb-5">
                                                <label class="form-label">{{ __('vendor.full_name') }}<span class="text-danger">({{ __('vendor.arabic') }})*</span></label>
                                                <input type="text" class="form-control @error('name_ar') is-invalid @enderror" name="name_ar" value="{{ $vendor->getTranslation('name','ar') }}" placeholder="{{__('vendor.name_ar_placeholder')}}" required="">
                                                @error('name_ar')
                                                <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="js-form-message form-group mb-5">
                                                <label class="form-label">{{__('vendor.email')}} <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $vendor->email }}" placeholder="{{__('vendor.email_placeholder')}}" required="">
                                                @error('email')
                                                <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="js-form-message form-group mb-5">
                                                <label class="form-label">{{__('vendor.address')}}</label>
                                                <input type="text" class="form-control @error('address') is-invalid @enderror" name="address" value="{{ $vendor->address }}" placeholder="{{__('vendor.address_placeholder')}}">
                                                @error('address')
                                                <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="js-form-message form-group mb-5">
                                                <label class="form-label">{{__('vendor.type')}}</label>
                                                <select class="form-control @error('type') is-invalid @enderror" name="type">
                                                    <option selected disabled>{{__('vendor.type_placeholder')}}</option>
                                                    <option value="factory" @if($vendor->type == 'factory') selected @endif>{{__('vendor.type_factory')}}</option>
                                                    <option value="distributor" @if($vendor->type == 'distributor') selected @endif>{{__('vendor.type_distributor')}}</option>
                                                    <option value="wholesales" @if($vendor->type == 'wholesales') selected @endif>{{__('vendor.type_wholesales')}}</option>
                                                    <option value="retail" @if($vendor->type == 'retail') selected @endif>{{__('vendor.type_retail')}}</option>
                                                </select>
                                                @error('type')
                                                <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-12 contactsRegion">
                                            <div class="r-group row">
                                                <div class="col-md-3">
                                                    <p>
                                                        <label data-pattern-text="{{__('vendor.contact_person_name')}} ++:">{{ __('vendor.contact_person_name') }}:</label>
                                                        <input class="form-control @error('contacts.*.person_name') is-invalid @enderror" @if(count($vendor->contacts) > 0)value="{{ $vendor->contacts[0]['person_name'] }}" @endif type="text" name="contacts[0][person_name]" data-pattern-name="contacts[++][person_name]" data-pattern-id="contacts_++_person_name" />
                                                    </p>
                                                </div>

                                                <div class="col-md-3">
                                                    <p>
                                                        <label data-pattern-text="{{ __('vendor.contact_phone') }} ++:">{{ __('vendor.contact_phone') }}:</label>
                                                        <input type="text" name="contacts[0][phone]" class="form-control @error('contacts.*.phone') is-invalid @enderror" @if(count($vendor->contacts) > 0) value="{{ $vendor->contacts[0]['phone'] }}" @endif  data-pattern-name="contacts[++][phone]" data-pattern-id="contacts_++_phone" />
                                                    </p>
                                                </div>

                                                <div class="col-md-3">
                                                    <p>
                                                        <label data-pattern-text="{{ __('vendor.contact_email') }} ++:">{{ __('vendor.contact_email') }}:</label>
                                                        <input type="email" name="contacts[0][email]" class="form-control @error('contacts.*.email') is-invalid @enderror" @if(count($vendor->contacts) > 0) value="{{ $vendor->contacts[0]['email'] }}" @endif data-pattern-name="contacts[++][email]" data-pattern-id="contacts_++_email" />
                                                    </p>
                                                </div>

                                                <div class="col-md-3">
                                                    <p>
                                                        <label data-pattern-text="{{ __('vendor.contact_position') }} ++:">{{ __('vendor.contact_position') }}:</label>
                                                        <input type="text" name="contacts[0][position]" class="form-control @error('contacts.*.position') is-invalid @enderror" @if(count($vendor->contacts) > 0) value="{{ $vendor->contacts[0]['position'] }}" @endif data-pattern-name="contacts[++][position]" data-pattern-id="contacts_++_position" />
                                                    </p>
                                                </div>

                                                <p>
                                                    <!-- Manually a remove button for the item. -->
                                                    <!-- If one didn't exist, it would be added to overall group -->
                                                    <button style="margin-top: 35px;" type="button" class="r-btnRemove btn btn-sm btn-danger">
                                                        {{ __('general.remove') }} -</button>
                                                </p>
                                            </div>
                                            <div class="col-md-4">
                                                <!-- The add button -->
                                                <button type="button" class="r-btnAdd btn btn-sm btn-primary">{{ __('vendor.add_contact') }} +</button>
                                            </div>
                                        </div>
                                        <div class="col-md-12 mb-3">
                                            <hr>
                                            <div class="js-form-message form-group mb-5">
                                                <label class="form-label">{{ __('vendor.location') }}</label>
                                                {!! generate_map() !!}
                                                <input type="hidden" class="lat" value="{{$vendor->latitude}}" readonly name="latitude" required>
                                                <input type="hidden" class="lng" value="{{$vendor->longitude}}" readonly name="longitude" required>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="js-form-message mb-3">
                                                <label class="form-label mb-3">
                                                    {{ __('vendor.licenses') }}*
                                                </label>

                                                <div class="row">
                                                    @if(!count($vendor->getMedia(VENDOR_PATH)))
                                                        <div class="col-sm-2 imgUp">
                                                            <div class="imagePreview"></div>
                                                            <label class="btn btn-primary">
                                                                {{ __('vendor.choose_a_file') }} <input type="file" name="licenses[]" class="uploadFile img" value="Upload Photo" style="width: 0px;height: 0px;overflow: hidden;">
                                                            </label>
                                                        </div><!-- col-2 -->
                                                    @endif

                                                    @foreach($vendor->getMedia(VENDOR_PATH) as $license)
                                                        <div class="col-sm-2 imgUp">
                                                            <div class="imagePreview" style="background-image: url('{{ $license->getFullUrl() }}')"></div>
                                                            <i class="fa fa-times deleteImg" style="position: absolute;top: 0px;right: 15px;width: 30px; height: 30px;text-align: center;line-height: 30px;background-color: rgba(255,255,255,0.6);cursor: pointer;" data-url="{{route('vendor.deleteLicense', ['vendor' => $vendor, 'media' => $license])}}"></i>
                                                        </div>
                                                    @endforeach
                                                    <i class="fa fa-plus imgAdd"></i>



                                                </div><!-- row -->
                                                @if ($errors->has('licenses.*') || $errors->has('licenses'))
                                                    <div class="alert alert-danger">
                                                        <ul role="alert" style="list-style: list-unstyled">
                                                            @if($errors->has('licenses.*'))
                                                                <li>{{ $errors->first('licenses.*') }}</li>
                                                            @else
                                                                <li>{{ $errors->first('licenses') }}</li>
                                                            @endif
                                                        </ul>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="js-form-message form-group mb-5">
                                                <label class="form-label">{{ __('vendor.facebook_url') }}</label>
                                                <input type="text" class="form-control @error('facebook_url') is-invalid @enderror" name="facebook_url" value="{{ $vendor->facebook_url }}" placeholder="Enter your facebook">
                                                @error('facebook_url')
                                                <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="js-form-message form-group mb-5">
                                                <label class="form-label">{{ __('vendor.twitter_url') }}</label>
                                                <input type="text" class="form-control @error('twitter_url') is-invalid @enderror" name="twitter_url" value="{{ $vendor->twitter_url }}" placeholder="Enter your twitter">
                                                @error('twitter_url')
                                                <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="js-form-message form-group mb-5">
                                                <label class="form-label">{{ __('vendor.youtube_url') }}</label>
                                                <input type="text" class="form-control @error('youtube_url') is-invalid @enderror" name="youtube_url" value="{{ $vendor->youtube_url }}" placeholder="Enter your youtube">
                                                @error('youtube_url')
                                                <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="js-form-message form-group mb-5">
                                                <label class="form-label">{{ __('vendor.instagram_url') }}</label>
                                                <input type="text" class="form-control @error('instagram_url') is-invalid @enderror" name="instagram_url" value="{{ $vendor->instagram_url }}" placeholder="Enter your instagram">
                                                @error('instagram_url')
                                                <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="js-form-message form-group mb-5">
                                                <label class="form-label">{{ __('vendor.pinterest_url') }}</label>
                                                <input type="text" class="form-control @error('pinterest_url') is-invalid @enderror" name="pinterest_url" value="{{ $vendor->pinterest_url }}" placeholder="Enter your pinterest">
                                                @error('pinterest_url')
                                                <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="js-form-message form-group mb-5">
                                                <label class="form-label">{{ __('vendor.website_url') }}</label>
                                                <input type="text" class="form-control @error('website_url') is-invalid @enderror" name="website_url" value="{{ $vendor->website_url }}" placeholder="Enter your website">
                                                @error('website_url')
                                                <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="js-form-message form-group mb-5">
                                                <label class="form-label">{{ __('vendor.password') }}<span class="text-danger">*</span></label>
                                                <input type="text" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="Change the password">
                                                @error('password')
                                                <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="js-form-message form-group mb-5">
                                                <label class="form-label">{{ __('vendor.password_confirmation') }}<span class="text-danger">*</span></label>
                                                <input type="text" class="form-control @error('password_confirmation') is-invalid @enderror" name="password_confirmation" placeholder="Confirm your password">
                                                @error('password_confirmation')
                                                <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="mb-6">
                                                <button type="submit" class="btn btn-primary-dark-w px-5 text-white mr-2"> <i class="fas fa-save"></i> {{ __('general.save_changes') }}</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="Jpills-shipping-example1" role="tabpanel" aria-labelledby="Jpills-shipping-example1-tab">
                            <div class="container">
                                @if($vendor->active)
                                    <form method="POST" action="{{ route('vendor.updateShippingPrices') }}">
                                        <input name="id" type="hidden" value="{{$vendor->id}}">
                                        @csrf
                                        @method('PATCH')
                                        <div class="clone_container">
                                            @if(isset($shipping_prices))
                                            @foreach($shipping_prices as $shipping_price)
                                            <div class="row clone_item">
                                                <div class="col-md-3">
                                                    <div class="js-form-message form-group mb-5">
                                                        <label class="form-label">{{__('vendor.shipping_cities')}} <span class="text-danger">*</span></label>
                                                        <select name="cities[]" class="form-control @error("cities[]") is-invalid @enderror" required>
                                                            @foreach($cities as $city)
                                                                <option value="{{$city->id}}" @if($shipping_price['cities'] == $city->id) selected @endif>{{$city->name}}</option>
                                                            @endforeach
                                                        </select>
                                                        @error("cities[]")
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="js-form-message form-group mb-5">
                                                        <label class="form-label">{{ __('vendor.shipping_price') }} <span class="text-danger">*</span></label>
                                                        <input type="number" class="form-control @error("price[]") is-invalid @enderror" name="price[]" value="{{$shipping_price['price']}}" required>
                                                        @error("price[]")
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="js-form-message form-group mb-5">
                                                        <label class="form-label">{{ __('vendor.shipping_time') }} <span class="text-danger">*</span></label>
                                                        <input type="number" class="form-control @error("time[]") is-invalid @enderror" name="time[]" value="{{$shipping_price['time']}}" required>
                                                        @error("time[]")
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="js-form-message form-group mb-5">
                                                        <label class="form-label">{{ __('vendor.shipping_format') }} <span class="text-danger">*</span></label>
                                                        <select name="format[]" class="form-control @error("format[]") is-invalid @enderror" required>
                                                            <option value="hour" @if($shipping_price['format'] == 'hour') selected @endif>{{ __('vendor.hour') }}</option>
                                                            <option value="day" @if($shipping_price['format'] == 'day') selected @endif>{{ __('vendor.day') }}</option>
                                                        </select>
                                                        @error("format[]")
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="mt-4">
                                                        <button type="button" class="btn btn-danger px-5 text-white mr-2 btn_clone_remove">{{ __('general.delete') }}</button>
                                                    </div>
                                                </div>
                                            </div>
                                            @endforeach
                                            @else
                                                <h4>{{ __('vendor.no_shipping_prices') }}</h4>
                                            @endif
                                        </div>
                                        <div class="col-md-12">
                                            <div class="mb-6">
                                                <button type="button" class="btn btn-primary-dark-w px-5 text-white mr-2 btn_clone_add"> <i class="fas fa-plus"></i> {{ __('vendor.add_price') }}</button>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="mb-6">
                                                <button type="submit" class="btn btn-primary-dark-w px-5 text-white mr-2"> <i class="fas fa-save"></i>
                                                    {{ __('general.save_changes') }}</button>
                                            </div>
                                        </div>
                                    </form>
                                @endif
                            </div>
                        </div>
                        <div class="tab-pane fade" id="Jpills-contacts-example1" role="tabpanel" aria-labelledby="Jpills-contacts-example1-tab">
                            <div class="container">
                                <ul class="list-unstyled">
                                    @foreach($vendor->contacts as $contact)
                                        <li>{{ __('vendor.contact_person_name') }}: {{ $contact['person_name'] }}</li>
                                        <li>{{ __('vendor.contact_phone') }}: {{ $contact['phone'] }}</li>
                                        <li>{{ __('vendor.contact_email') }}: {{ $contact['email'] }}</li>
                                        <li>{{ __('vendor.contact_position') }}: {{ $contact['position'] }}</li>
                                        <hr />
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="Jpills-two-example1" role="tabpanel" aria-labelledby="Jpills-two-example1-tab">
                            @if($vendor->active)
                                <a href="{{ route('vendor.addProduct') }}" class="btn btn-primary-dark-w px-5 text-white mr-2">
                                    {{ __('vendor.add_product') }}
                                </a>
                            @endif
                            @if(count($products) > 0)
                                <ul class="row list-unstyled products-group no-gutters">
                                    @foreach($products as $product)
                                    <li class="col-6 col-md-3 col-wd-2gdot4 product-item">
                                        <div class="product-item__outer h-100">
                                            <div class="product-item__inner px-xl-2 p-3">
                                                <div class="product-item__body pb-xl-2">
                                                    <div class="mb-2"><a href="{{ route('front.category', [$product->category->slug]) }}" class="font-size-12 text-gray-5">{{ $product->category->name }}</a></div>
                                                    <h5 class="mb-1 product-item__title"><a href="{{ route('front.product', [$product->category->slug, $product->slug]) }}" class="text-blue font-weight-bold">{{ $product->name }}</a></h5>
                                                    <div class="mb-2">
                                                        <a href="{{ route('front.product', [$product->category->slug, $product->slug]) }}" class="d-block text-center"><img class="img-fluid" src="{{ $product->getFirstMediaUrlOrDefault(PRODUCT_PATH)['url'] }}" alt="{{ $product->getFirstMediaUrlOrDefault(PRODUCT_PATH)['alt'] }}"></a>
                                                    </div>
                                                    <div class="mb-3">
                                                        <div class="text-warning mr-2">
                                                            @for($i = 1; $i <= 5; $i++)
                                                                @if($i <= $product->rate)
                                                                    <small class="fas fa-star"></small>
                                                                @else
                                                                    <small class="far fa-star text-muted"></small>
                                                                @endif
                                                            @endfor
                                                        </div>
                                                        @if($product->views > 0)
                                                            <span class="text-secondary">({{ $product->views }})</span>
                                                        @endif
                                                    </div>
                                                    <div class="font-size-12 p-0 text-gray-110 mb-4">
                                                        {!! Str::limit($product->short_desc, 100, '...') !!}
                                                    </div>
                                                    <div class="text-gray-20 mb-2 font-size-12">{{ __('SKU:') . ' ' .$product->SKU }}</div>
                                                    @if($product->type === 'product')
                                                        <div class="flex-center-between mb-1">
                                                            <div class="prodcut-price">
                                                                <div class="text-gray-100">{{ getCurrency('symbol') .' '. $product->price }}</div>
                                                            </div>
                                                        </div>
                                                    @endif
                                                    @if($vendor->active)
                                                        <a href="{{ route('vendor.editProduct', ['product' => $product]) }}" class="btn btn-primary-dark-w px-5 text-white mr-2">
                                                            {{ __('Edit Product') }}
                                                        </a>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    @endforeach
                                </ul>
                            {{ $products->links() }}
                            @else
                                <h4>{{ __('vendor.no_products') }}</h4>
                            @endif
                        </div>
                        <div class="tab-pane fade" id="Jpills-three-example1" role="tabpanel" aria-labelledby="Jpills-three-example1-tab">
                            <div class="container">
                                @if($vendor->active)
                                <!-- Button trigger modal -->
                                <button type="button" class="btn btn-primary-dark-w px-5 text-white mr-2" data-toggle="modal" data-target="#branchModal">
                                    {{ __('vendor.add_branch') }}
                                </button>
                                <!-- Modal -->
                                <div class="modal fade" id="branchModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" style="max-width: 700px;" role="document">
                                        <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">{{ __('vendor.add_branch') }}</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{ route('vendor.addBranch') }}" method="POST" id="addBranchForm">
                                                @csrf
                                                <div class="row mb-5">
                                                <div class="col-md-6">
                                                    <div class="js-form-message form-group mb-5">
                                                        <label for="name" class="form-label">{{ __('vendor.branch_name') }} <span class="text-danger">*</span></label>
                                                        <input type="text" class="form-control" id="name" name="name" required autocomplete="name" autofocus>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="js-form-message form-group mb-5">
                                                        <label for="city" class="form-label">{{ __('vendor.branch_city') }} <span class="text-danger">*</span></label>
                                                        <select class="form-control" id="city" name="city_id" required>
                                                            @foreach($cities as $city)
                                                                <option value="{{$city->id}}">{{$city->name}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="js-form-message form-group mb-5">
                                                        <label for="phone_number" class="form-label">{{ __('vendor.branch_phone') }} <span class="text-danger">*</span></label>
                                                        <div class="input-group mb-3">
                                                            <span class="input-group-text" id="basic-addon1" style="border-radius: 1.4rem 0 0 1.4rem">+966</span>
                                                            <input type="text" class="form-control" id="phone_number" name="phone_number" required autocomplete="phone_number">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="js-form-message form-group mb-5">
                                                        <label for="fax" class="form-label">{{ __('vendor.branch_fax') }}</label>
                                                        <input type="text" class="form-control" id="fax" name="fax" autocomplete="fax">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="js-form-message form-group mb-5">
                                                        <label for="website" class="form-label">{{ __('vendor.branch_website') }}</label>
                                                        <input type="text" class="form-control" id="website" name="website" autocomplete="website">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="js-form-message form-group mb-5">
                                                        <label for="address" class="form-label">{{ __('vendor.branch_address') }} <span class="text-danger">*</span></label>
                                                        <input type="text" class="form-control" id="address" name="address" required autocomplete="address">
                                                    </div>
                                                </div>
                                                {!! generate_map_branch() !!}
                                                <input type="hidden" class="lat" readonly name="latitude" required>
                                                <input type="hidden" class="lng" readonly name="longitude" required>
                                                </div>
                                                <button id="addBranchBtn" class="btn btn-primary-dark-w px-5 text-white" style="cursor:pointer;">{{ __('general.save_changes') }}</button>
                                            </form>
                                        </div>
                                        </div>
                                    </div>
                                </div>
                                @endif
                                @if(count($branches) > 0)
                                    @foreach($branches as $branch)
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="border-bottom border-color-1 mb-5">
                                                <h3 class="section-title mb-0 pb-2 font-size-25"> {{ $branch->name }} ( {{$branch->city->name}} ) </h3>
                                            </div>
                                        </div>
                                        <div class="col-md-8 col-xl-8">
                                            <div class="map_branches">
                                                <iframe src="https://maps.google.com/maps?q={{ $branch->latitude }},{{ $branch->longitude }}&hl=es&z=14&amp;output=embed" width="100%" height="250" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-xl-4">
                                            <h5 class="font-size-14 font-weight-bold mb-3">{{ __('vendor.main_information') }}</h5>
                                            <div class="">
                                                <ul class="list-unstyled-branches mb-6">
                                                    <li class="row">
                                                        <div class="col-md-2">
                                                            <i class="fas fa-phone"></i>
                                                        </div>
                                                        <div class="col-md-10 mt-2">
                                                            <b>{{ __('vendor.branch_phone') }}:</b>
                                                            <span class=""> {{ $branch->phone_number }} </span>
                                                        </div>
                                                    </li>
                                                    @if($branch->fax)
                                                        <li class="row">
                                                            <div class="col-md-2">
                                                                <i class="fas fa-fax"></i>
                                                            </div>
                                                            <div class="col-md-10 mt-2">
                                                                <b>{{ __('vendor.branch_fax') }}:</b>
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
                                                            <b>{{ __('vendor.branch_website') }}:</b>
                                                            <span class=""> {{ $branch->website }} </span>
                                                        </div>
                                                    </li>
                                                    @endif
                                                    <li class="row">
                                                        <div class="col-md-2">
                                                            <i class="fas fa-map-marker-alt"></i>
                                                        </div>
                                                        <div class="col-md-10 mt-2">
                                                            <b>{{ __('vendor.branch_address') }}:</b>
                                                            <span class=""> {{ $branch->address }} </span>
                                                        </div>
                                                    </li>
                                                    <li class="row mt-5">
                                                        <a class="btn btn-primary btn-block" href="{{ route('vendor.deleteBranch', ['branch' => $branch]) }}"
                                                           onclick="event.preventDefault();
                                                            document.getElementById('delete-branch-{{ $branch->id }}').submit();">
                                                            {{ __('general.delete') }}
                                                        </a>

                                                        <form id="delete-branch-{{ $branch->id }}" action="{{ route('vendor.deleteBranch', ['branch' => $branch]) }}" method="POST" style="display: none;">
                                                            @csrf
                                                            @method('DELETE')
                                                        </form>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                    {{ $branches->links() }}
                                @else
                                    <h4>{{ __('vendor.no_branches') }}</h4>
                                @endif
                            </div>
                        </div>
                        <div class="tab-pane fade" id="Jpills-four-example1" role="tabpanel" aria-labelledby="Jpills-four-example1-tab">
                            <div class="container">
                                @if(count($items) > 0)
                                <div class="row">
                                    <table class="table table-bordered">
                                        <thead>
                                        <tr>
                                            <th scope="col">{{ __('order.id') }}</th>
                                            <th scope="col">{{ __('order.name') }}</th>
                                            <th scope="col">{{ __('order.price') }}</th>
                                            <th scope="col">{{ __('order.status') }}</th>
                                            <th scope="col">{{ __('order.payment_status') }}</th>
                                            <th scope="col">{{ __('order.date') }}</th>
                                            <th scope="col" class="text-center">{{ __('order.details') }}</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($items as $item)
                                            <tr>
                                                <th scope="row">{{ $item->order->order_id }}</th>
                                                <td>{{ $item->order->name }}</td>
                                                <td>{{ $item->price }}</td>
                                                <td>{{ $item->status }}</td>
                                                <td>{{ $item->payment_status }}</td>
                                                <td>{{ $item->order->created_at }}</td>
                                                <td class="text-center"><a class="toggleModal" data-url="{{ route('order.get', ['order' => $item->id]) }}" href="#" data-toggle="modal" data-target="#exampleModal"> View <i class="far fa-eye"></i></a></td>
                                            </tr>
                                        @endforeach


                                        </tbody>
                                    </table>
                                </div>
                                <!-- Modal -->
                                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">{{ __('order.details') }}</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="alert alert-danger d-none">{{ __('order.could_not_find_order') }}</div>
                                                <div class="row">
                                                    <div class="col-md-12 col-xl-12">
                                                        <form method="POST" action="{{ route('vendor.order.update', ['vendor' => $vendor->id]) }}">
                                                            @csrf
                                                            @method('PATCH')
                                                            <input type="hidden" name="id" id="formOrder" value="" />
                                                            <div class="">
                                                                <ul class="list-unstyled-branches list_order_vendor mb-6">
                                                                    <li class="row">
                                                                        <div class="col-md-4">
                                                                            <b>{{ __('order.id') }}:</b>
                                                                        </div>
                                                                        <div class="col-md-8">
                                                                            <span class="" id="id"></span>
                                                                        </div>
                                                                    </li>
                                                                    <li class="row">
                                                                        <div class="col-md-4">
                                                                            <b>{{ __('order.order_id') }}:</b>
                                                                        </div>
                                                                        <div class="col-md-8">
                                                                            <span class="" id="order_id"></span>
                                                                        </div>
                                                                    </li>
                                                                    <li class="row">
                                                                        <div class="col-md-4">
                                                                            <b>{{ __('order.date') }}:</b>
                                                                        </div>
                                                                        <div class="col-md-8">
                                                                            <span class="" id="date"></span>
                                                                        </div>
                                                                    </li>
                                                                    <li class="row">
                                                                        <div class="col-md-4">
                                                                            <b>{{ __('order.user') }}:</b>
                                                                        </div>
                                                                        <div class="col-md-8">
                                                                            <span class="" id="user"></span>
                                                                        </div>
                                                                    </li>
                                                                    <li class="row">
                                                                        <div class="col-md-4">
                                                                            <b>{{ __('order.name') }}:</b>
                                                                        </div>
                                                                        <div class="col-md-8">
                                                                            <span class="" id="name"></span>
                                                                        </div>
                                                                    </li>
                                                                    <li class="row">
                                                                        <div class="col-md-4">
                                                                            <b>{{ __('order.email') }}:</b>
                                                                        </div>
                                                                        <div class="col-md-8">
                                                                            <span class="" id="email"></span>
                                                                        </div>
                                                                    </li>
                                                                    <li class="row">
                                                                        <div class="col-md-4">
                                                                            <b>{{ __('order.phone') }}:</b>
                                                                        </div>
                                                                        <div class="col-md-8">
                                                                            <span class="" id="phone"></span>
                                                                        </div>
                                                                    </li>
                                                                    <li class="row">
                                                                        <div class="col-md-4">
                                                                            <b>{{ __('order.address') }}:</b>
                                                                        </div>
                                                                        <div class="col-md-8">
                                                                            <span class="" id="address"></span>
                                                                        </div>
                                                                    </li>
                                                                    <li class="row">
                                                                        <div class="col-md-4">
                                                                            <b>{{ __('order.building_number') }}:</b>
                                                                        </div>
                                                                        <div class="col-md-8">
                                                                            <span class="" id="buildingNo"></span>
                                                                        </div>
                                                                    </li>
                                                                    <li class="row">
                                                                        <div class="col-md-4">
                                                                            <b>{{ __('order.street') }}:</b>
                                                                        </div>
                                                                        <div class="col-md-8">
                                                                            <span class="" id="street"></span>
                                                                        </div>
                                                                    </li>
                                                                    <li class="row">
                                                                        <div class="col-md-4">
                                                                            <b>{{ __('order.district') }}:</b>
                                                                        </div>
                                                                        <div class="col-md-8">
                                                                            <span class="" id="district"></span>
                                                                        </div>
                                                                    </li>
                                                                    <li class="row">
                                                                        <div class="col-md-4">
                                                                            <b>{{ __('order.city') }}:</b>
                                                                        </div>
                                                                        <div class="col-md-8">
                                                                            <span class="" id="city"></span>
                                                                        </div>
                                                                    </li>
                                                                    <li class="row">
                                                                        <div class="col-md-4">
                                                                            <b>{{ __('order.payment_status') }}:</b>
                                                                        </div>
                                                                        <div class="col-md-8">
                                                                            <select class="form-control" name="payment_status" id="paymentStatus">
                                                                                <option value="pending" selected>{{ __('order.payment_pending') }}</option>
                                                                                <option value="refunded">{{ __('order.payment_refunded') }}</option>
                                                                                <option value="completed">{{ __('order.payment_completed') }}</option>
                                                                            </select>
                                                                            @error('payment_status')
                                                                                <span class="invalid-feedback" role="alert">
                                                                                    <strong>{{ $message }}</strong>
                                                                                </span>
                                                                            @enderror
                                                                        </div>
                                                                    </li>
                                                                    <li class="row">
                                                                        <div class="col-md-4">
                                                                            <b>{{ __('order.status') }}:</b>
                                                                        </div>
                                                                        <div class="col-md-8">
                                                                            <select class="form-control" name="status" id="orderStatus">
                                                                                <option value="pending" selected>{{ __('order.pending') }}</option>
                                                                                <option value="shipping">{{ __('order.shipping') }}</option>
                                                                                <option value="completed">{{ __('order.completed') }}</option>
                                                                                <option value="refused">{{ __('order.refused') }}</option>
                                                                            </select>
                                                                            @error('status')
                                                                            <span class="invalid-feedback" role="alert">
                                                                                    <strong>{{ $message }}</strong>
                                                                                </span>
                                                                            @enderror
                                                                        </div>
                                                                    </li>
                                                                    <li class="row">
                                                                        <div class="col-md-4">
                                                                            <b>{{ __('order.notes') }}:</b>
                                                                        </div>
                                                                        <div class="col-md-8">
                                                                            <span class="" id="notes"></span>
                                                                        </div>
                                                                    </li>
                                                                    <li class="row">
                                                                        <div class="col-md-4">
                                                                            <b>{{ __('order.refused_notes') }}:</b>
                                                                        </div>
                                                                        <div class="col-md-8">
                                                                            <textarea class="form-control" name="refused_note" id="refusedNotes" rows="3"></textarea>
                                                                            @error('refused_notes')
                                                                            <span class="invalid-feedback" role="alert">
                                                                                    <strong>{{ $message }}</strong>
                                                                                </span>
                                                                            @enderror
                                                                        </div>
                                                                    </li>
                                                                    <li class="row">
                                                                        <div class="col-md-4">
                                                                            <b>{{ __('order.total') }}:</b>
                                                                        </div>
                                                                        <div class="col-md-8">
                                                                            <span class="" id="total"></span>
                                                                        </div>
                                                                    </li>
                                                                    <li class="row mt-5">
                                                                        <div class="col-md-4">
                                                                            <b>{{ __('order.payment_method') }}:</b>
                                                                        </div>
                                                                        <div class="col-md-8">
                                                                            <span id="paymentMethod"></span>
                                                                        </div>
                                                                    </li>
                                                                    <div class="col-md-12">
                                                                        <button type="submit" class="btn btn-primary-dark-w px-5 text-white mr-2"> <i class="fas fa-paper-plane"></i>
                                                                            {{ __('general.submit') }} </button>
                                                                    </div>
                                                                </ul>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @else
                                    <h4>{{ __('order.no_orders') }}</h4>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('extraScripts')
    <script type="text/javascript">
        $('#addBranchBtn').on('click', function(e) {
            e.preventDefault();

            $.ajax({
                url: "{{ route('vendor.addBranch') }}",
                type: 'POST',
                data: $("#addBranchForm").serialize()
            })
            .done(function(response) {
                if(response.status) {
                    toastr.success(response.message);
                    window.location.reload();
                } else
                    toastr.warning(response.message);
            })
            .fail(function(response) {
                toastr.error(response.responseJSON.message);
                let errors = response.responseJSON.errors;

                $.each(errors, function(key, value) {
                    toastr.error(value, key);
                })
            })
        });

        $(".toggleModal").on('click', function() {
            //Reset the fields
            $("#id").html('');
            $("#formOrder").val();
            $("#order_id").html('');
            $("#date").html('');
            $("#user").html('');
            $("#name").html('');
            $("#email").html('');
            $("#phone").html('');
            $("#address").html('');
            $("#buildingNo").html('');
            $("#street").html('');
            $("#district").html('');
            $("#city").html('');
            $("#notes").html('');
            $("#total").html('');
            $("#refusedNotes").html('');
            $("#paymentMethod").html('');

            //Get the URL
            let url = $(this).data('url');

            //Create the request
            $.ajax({
                url: url,
                type: 'GET'
            })
            .done(function(response) {
                console.log(response.order);
                $('.alert-danger').addClass('d-none');
                $("#id").html(response.order.id);
                $("#formOrder").val(response.item.id);
                $("#order_id").html(response.order.order_id);
                $("#date").html(response.item.created_at);
                $("#user").html(response.order.name);
                $("#name").html(response.order.name);
                $("#email").html(response.order.email);
                $("#phone").html(response.order.phone);
                $("#address").html(response.order.address);
                $("#buildingNo").html(response.order.building_number);
                $("#street").html(response.order.street);
                $("#district").html(response.order.distract);
                $("#notes").html(response.order.notes);
                $("#city").html(response.order.city);
                $("#refusedNotes").html(response.item.refused_note);
                $("#total").html(response.item.price);
                $("#paymentMethod").html(response.order.payment_method);
                $("#orderStatus").val(response.item.status);
                $("#paymentStatus").val(response.item.payment_status);
            })
            .fail(function() {
                $('.alert-danger').removeClass('d-none');
            });
        });

        // upload Licenses
        $(".imgAdd").click(function(){
            $(this).closest(".row").find('.imgAdd').before('<div class="col-sm-2 imgUp"><div class="imagePreview"></div><label class="btn btn-primary">Upload<input name="licenses[]" type="file" class="uploadFile img" value="Upload Photo" style="width:0px;height:0px;overflow:hidden;"></label><i class="fa fa-times del"></i></div>');
        });
        $(document).on("click", "i.del" , function() {
            $(this).parent().remove();
        });
        $(function() {
            $(document).on("change",".uploadFile", function()
            {
                var uploadFile = $(this);
                var files = !!this.files ? this.files : [];
                if (!files.length || !window.FileReader) return; // no file selected, or no FileReader support

                if (/^image/.test( files[0].type)){ // only image file
                    var reader = new FileReader(); // instance of the FileReader
                    reader.readAsDataURL(files[0]); // read the local file

                    reader.onloadend = function(){ // set image data as background of div
                        //alert(uploadFile.closest(".upimage").find('.imagePreview').length);
                        uploadFile.closest(".imgUp").find('.imagePreview').css("background-image", "url("+this.result+")");
                    }
                }
            });
        });
        $('.deleteImg').on('click', function() {
            let url = $(this).data('url'),
                btn = $(this);

            $.ajax({
                type: 'DELETE',
                url: url,
                data: { _token: '{{ csrf_token() }}' }
            })
                .done(function(response) {
                    if(response.status) {
                        toastr.success(response.message);
                        btn.parent().remove();
                    }
                    else
                        toastr.error(response.message)
                })
                .fail(function(response) {
                    toastr.error(response.responseJSON.message);
                })
        })
        // upload Licenses

    </script>
    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC0jFnIKr5fjHZlmeY3QoiyelAGLrd-Fnc&libraries=places&sensor=false"></script>
    <script src="{{front_url()}}/assets/js/map.js"></script>
    <script src="{{front_url()}}/assets/js/map-branch.js"></script>
    <script src="{{front_url()}}/assets/js/jquery.form-repeater.js"></script>
    <script>
        $(document).ready(function () {
            $('.contactsRegion').repeater({
                btnAddClass: 'r-btnAdd',
                btnRemoveClass: 'r-btnRemove',
                groupClass: 'r-group',
                minItems: {{ count($vendor->contacts) > 0 ? count($vendor->contacts) : 1 }},
                maxItems: 3,
                startingIndex: 1,
                showMinItemsOnLoad: true,
                reindexOnDelete: true,
                repeatMode: 'insertAfterLast',
                animation: null,
                animationSpeed: 400,
                animationEasing: 'swing',
                clearValues: true
            });
            $(".btn_clone_add").click(function(){
                var clone_item = `<div class="row clone_item">
                                                <div class="col-md-3">
                                                    <div class="js-form-message form-group mb-5">
                                                        <label class="form-label">Cities <span class="text-danger">*</span></label>
                                                        <select name="cities[]" class="form-control @error("cities[]") is-invalid @enderror" required>
                                                            @foreach($cities as $city)
                <option value="{{$city->id}}">{{$city->name}}</option>
                                                            @endforeach
                </select>
@error("cities[]")
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                                                        </span>
                                                        @enderror
                </div>
            </div>
            <div class="col-md-2">
                <div class="js-form-message form-group mb-5">
                    <label class="form-label">Price <span class="text-danger">*</span></label>
                    <input type="number" class="form-control @error("price[]") is-invalid @enderror" name="price[]" required>
                                                        @error("price[]")
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                                                        </span>
                                                        @enderror
                </div>
            </div>
            <div class="col-md-2">
                <div class="js-form-message form-group mb-5">
                    <label class="form-label">Time <span class="text-danger">*</span></label>
                    <input type="number" class="form-control @error("time[]") is-invalid @enderror" name="time[]" required>
                                                        @error("time[]")
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                                                        </span>
                                                        @enderror
                </div>
            </div>
            <div class="col-md-3">
                <div class="js-form-message form-group mb-5">
                    <label class="form-label">Format <span class="text-danger">*</span></label>
                    <select name="format[]" class="form-control @error("format[]") is-invalid @enderror" required>
                                                            <option value="hour">Hour</option>
                                                            <option value="day">Day</option>
                                                        </select>
                                                        @error("format[]")
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                                                        </span>
                                                        @enderror
                </div>
            </div>
            <div class="col-md-2">
                <div class="mt-4">
                    <button type="button" class="btn btn-danger px-5 text-white mr-2 btn_clone_remove">Delete</button>
                </div>
            </div>
        </div>`;
                // var new_item = $(".clone_item").first().clone();
                $(".clone_container").append(clone_item);
                return false;
            });
            $(document).on('click', '.btn_clone_remove', function () {
                $(this).closest('.clone_item').remove();
            });
        });
    </script>
@endsection
