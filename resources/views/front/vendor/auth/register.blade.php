@extends('front.layouts.master')
@section('metaTags')
    <title>{{env('APP_NAME')}} | {{__('auth.register')}}</title>
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
            <div class="my-md-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-3 flex-nowrap flex-xl-wrap overflow-auto overflow-xl-visble">
                        <li class="breadcrumb-item flex-shrink-0 flex-xl-shrink-1"><a href="{{route('home')}}">{{__('general.home')}}</a></li>
                        <li class="breadcrumb-item flex-shrink-0 flex-xl-shrink-1 active" aria-current="page">{{ __('auth.vendor_register') }}</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="mb-8">
                    <div class="position-relative position-md-static px-md-6">
                        <ul class="nav nav-classic nav-tab nav-tab-lg justify-content-xl-center flex-nowrap flex-xl-wrap overflow-auto overflow-xl-visble border-0 pb-1 pb-xl-0 mb-n1 mb-xl-0" id="pills-tab-8" role="tablist">
                            <li class="nav-item flex-shrink-0 flex-xl-shrink-1 z-index-2">
                                <a class="nav-link active" id="Jpills-one-example1-tab" data-toggle="pill" href="#Jpills-one-example1" role="tab" aria-controls="Jpills-one-example1" aria-selected="true">{{ __('auth.vendor_register') }}</a>
                            </li>
                        </ul>
                    </div>
                    <div class="borders-radius-17 border p-4 mt-4 mt-md-0 px-lg-10 py-lg-9">
                        <div class="tab-content" id="Jpills-tabContent">
                            <div class="tab-pane fade active show" id="Jpills-one-example1" role="tabpanel" aria-labelledby="Jpills-one-example1-tab">
                                <form method="POST" action="{{ route('vendor.register') }}" enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="js-form-message form-group mb-5">
                                                <label for="name_en" class="form-label">{{ __('auth.name') }} <span class="text-danger">({{ __('auth.in_english') }})*</span></label>
                                                <input type="text" class="form-control @error('name_en') is-invalid @enderror" id="name_en" name="name_en" value="{{ old('name_en') }}" required autocomplete="name_en" autofocus>
                                                @error('name_en')
                                                <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="js-form-message form-group mb-5">
                                                <label for="name_ar" class="form-label">{{ __('auth.name') }} <span class="text-danger">({{ __('auth.in_arabic') }})*</span></label>
                                                <input type="text" class="form-control @error('name_ar') is-invalid @enderror" id="name_ar" name="name_ar" value="{{ old('name_ar') }}" required autocomplete="name_ar" autofocus>
                                                @error('name_ar')
                                                <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="js-form-message form-group mb-5">
                                                <label for="email" class="form-label">{{ __('auth.email') }} <span class="text-danger">*</span></label>
                                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
                                                @error('email')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="js-form-message form-group mb-5">
                                                <label for="phone" class="form-label">{{ __('auth.phone') }} <span class="text-danger">*</span></label>
                                                <input type="tel" id="phone" class="form-control phoneNumber @error('phone') is-invalid @enderror"
                                                       value="{{ old('phone') }}" required>
                                                <input type="hidden" class="fullPhoneNumber" name="phone">
                                                @error('phone')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="js-form-message form-group mb-5">
                                                <label for="country" class="form-label">{{ __('auth.country') }} <span class="text-danger">*</span></label>
                                                <select class="form-control @error('country_id') is-invalid @enderror" id="country" name="country_id" required>
                                                    @foreach($countries as $country)
                                                        <option value="{{ $country->id }}">{{ $country->name }}</option>
                                                    @endforeach
                                                </select>
                                                @error('country_id')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="js-form-message form-group mb-5">
                                                <label for="type" class="form-label">{{ __('auth.type') }} <span class="text-danger">*</span></label>
                                                <select class="form-control @error('type') is-invalid @enderror" id="type" name="type" required>
                                                    <option value="factory" @if(old('type') == 'factory') selected @endif>{{__('auth.type_factory')}}</option>
                                                    <option value="distributor" @if(old('type') == 'distributor') selected @endif>{{__('auth.type_distributor')}}</option>
                                                    <option value="wholesales" @if(old('type') == 'wholesales') selected @endif>{{__('auth.type_wholesales')}}</option>
                                                    <option value="retail" @if(old('type') == 'retail') selected @endif>{{__('auth.type_retail')}}</option>
                                                </select>
                                                @error('type')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="js-form-message form-group mb-5">
                                                <label for="address" class="form-label">{{ __('auth.address') }} <span class="text-danger">*</span></label>
                                                <input id="address" type="text" class="form-control @error('address') is-invalid @enderror" name="address" value="{{ old('address') }}" autocomplete="address" required>
                                                @error('address')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            {!! generate_map() !!}
                                            <input type="hidden" class="lat" value="{{old('latitude')}}" readonly name="latitude" required>
                                            <input type="hidden" class="lng" value="{{old('longitude')}}" readonly name="longitude" required>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="js-form-message mb-3">
                                                <label class="form-label mb-3">
                                                    {{ __('vendor.licenses') }}
                                                </label>
                                                <div class="row">
                                                    <div class="col-md-3 imgUp">
                                                        <div class="imagePreview"></div>
                                                        <label class="btn btn-primary">
                                                            {{ __('vendor.choose_a_file') }} <input type="file" name="licenses[]" class="uploadFile img" value="Upload Photo" style="width: 0px;height: 0px;overflow: hidden;">
                                                        </label>
                                                    </div>
                                                    <i class="fa fa-plus imgAdd"></i>
                                                </div>
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
                                                <label for="password" class="form-label">{{ __('auth.password_input') }} <span class="text-danger">*</span></label>

                                                <div class="eye_show">
                                                    <input type="password" class="form-control @error('password') is-invalid @enderror" id="passwordInput" name="password" required autocomplete="new-password">
                                                    <span href="#" class="showPassword fa fa-eye fa-lg" data-toggle="#passwordInput"></span>
                                                </div>
                                                @error('password')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="js-form-message form-group mb-5">
                                                <label for="password-confirm" class="form-label">{{ __('auth.confirm_password') }} <span class="text-danger">*</span></label>
                                                <div class="eye_show">
                                                    <input type="password" class="form-control" id="passwordConfirmInput" name="password_confirmation" required autocomplete="new-password">
                                                    <span href="#" class="showPassword fa fa-eye fa-lg" data-toggle="#passwordConfirmInput"></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <input class="checkModal" type="checkbox" name="contract" />&nbsp;
                                            <label class="checkModal" style="cursor: pointer">{{__('auth.contract_check_label')}}</label>
                                            @error('contract')
                                            <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <button type="submit" class="btn btn-primary-dark-w px-5 text-white">{{ __('auth.register') }}</button>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <h3 class="font-size-18 mb-3">{{__('auth.signup_headline')}} :</h3>
                                            <ul class="list-group list-group-borderless">
                                                <li class="list-group-item px-0"><i class="fas fa-check mr-2 text-green font-size-16"></i> {{ __('auth.speed_checkout') }}</li>
                                                <li class="list-group-item px-0"><i class="fas fa-check mr-2 text-green font-size-16"></i> {{ __('auth.track_orders') }}</li>
                                                <li class="list-group-item px-0"><i class="fas fa-check mr-2 text-green font-size-16"></i> {{ __('auth.keep_records') }}</li>
                                            </ul>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="termsModal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document" style="max-width: 1000px">
            <div class="modal-content st_model_new">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">{{nova_get_setting_translate('vendor_terms_title')}}</h5>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="modalText">
                                {!! nova_get_setting_translate('vendor_terms_text') !!}
                            </div>
                        </div>
                    </div>
                    <button type="button" class="modalButton" data-dismiss="modal">{{nova_get_setting_translate('vendor_terms_button')}}</button>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('extraScripts')
    <style>
        .modalText{
            overflow-y: auto;
            max-height: 55vh;
        }
        .modalButton{
            border-radius: 5px;
            margin: 30px auto;
            width: auto;
            padding: 15px;
            display: block;
            border: 2px solid #003f91;
            font-weight: bold;
        }
    </style>
    <script defer type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key={{env('FRONT_MAPS_KEY')}}&libraries=places&sensor=false"></script>
    <script defer src="{{front_url()}}/assets/js/map.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {

            $(document).ready(function() {
                $('.checkModal').on('click', function () {
                    $('#termsModal').modal({
                        backdrop: 'static',
                        keyboard: false
                    });
                });
            });

            // upload Licenses
            $(".imgAdd").click(function(){
                $(this).closest(".row").find('.imgAdd').before('<div class="col-md-3 imgUp"><div class="imagePreview"></div><label class="btn btn-primary">Upload<input name="licenses[]" type="file" class="uploadFile img" value="Upload Photo" style="width:0px;height:0px;overflow:hidden;"></label><i class="fa fa-times del"></i></div>');
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

                    var reader = new FileReader(); // instance of the FileReader

                    if (/^image/.test( files[0].type)){ // only image file
                        reader.readAsDataURL(files[0]); // read the local file

                        reader.onloadend = function(){ // set image data as background of div
                            //alert(uploadFile.closest(".upimage").find('.imagePreview').length);
                            uploadFile.closest(".imgUp").find('.imagePreview').css("background-image", "url("+this.result+")");
                        }
                    } else {
                        reader.readAsDataURL(files[0]); // read the local file

                        reader.onloadend = function(){ // set image data as background of div
                            //alert(uploadFile.closest(".upimage").find('.imagePreview').length);
                            uploadFile.closest(".imgUp").find('.imagePreview').css("background-image", "url('/public/assets/img/pdf.svg')");
                        }
                    }
                });
            });
        });
    </script>
@endsection
