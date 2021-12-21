@extends('vendorAdmin.layouts.master')
@section('title')
    <title>{{__('vendorAdmin.edit_info')}}</title>
@endsection
@section('content')
<section class="content pt-2">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">{{__('vendorAdmin.edit_info')}}</h3>
                    </div>
                    <form>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="name-ar">{{__('vendorAdmin.name_ar')}}</label>
                                        <input type="text" class="form-control" name="name_ar"
                                               id="name-ar" value="{{$vendor->getTranslation('name','ar')}}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="name-en">{{__('vendorAdmin.name_en')}}</label>
                                        <input type="text" class="form-control" name="name_en"
                                               id="name-en" value="{{$vendor->getTranslation('name','en')}}">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="email">{{__('vendorAdmin.main_email')}}</label>
                                <input type="email" class="form-control" name="email"
                                       id="email" value="{{$vendor->email}}">
                            </div>
                            <div class="form-group">
                                <label for="address">{{__('vendorAdmin.address')}}</label>
                                <input type="text" class="form-control" name="address"
                                       id="address" value="{{$vendor->address}}">
                            </div>
                            <div class="form-group">
                                <label for="type">{{__('vendorAdmin.type')}}</label>
                                <select class="form-control" name="type" id="type">
                                    <option selected disabled>{{__('vendor.type_placeholder')}}</option>
                                    <option value="factory" @if($vendor->type == 'factory') selected @endif>{{__('vendor.type_factory')}}</option>
                                    <option value="distributor" @if($vendor->type == 'distributor') selected @endif>{{__('vendor.type_distributor')}}</option>
                                    <option value="wholesales" @if($vendor->type == 'wholesales') selected @endif>{{__('vendor.type_wholesales')}}</option>
                                    <option value="retail" @if($vendor->type == 'retail') selected @endif>{{__('vendor.type_retail')}}</option>
                                </select>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="logo">{{__('vendorAdmin.logo')}}</label>
                                        <div class="input-group">
                                            <div class="custom-file">
                                                <input type="file" name="logo" class="custom-file-input" id="logo">
                                                <label class="custom-file-label">{{__('vendorAdmin.choose_file')}}</label>
                                            </div>
                                        </div>
                                        <div class="mt-1">
                                            <img class="img-thumbnail" width="200" src="{{ $vendor->getFirstMediaUrlOrDefault(VENDOR_LOGO)['url'] }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="cover">{{__('vendorAdmin.cover')}}</label>
                                        <div class="input-group">
                                            <div class="custom-file">
                                                <input type="file" name="cover" class="custom-file-input" id="cover">
                                                <label class="custom-file-label">{{__('vendorAdmin.choose_file')}}</label>
                                            </div>
                                        </div>
                                        <div class="mt-1">
                                            <img class="img-thumbnail" width="200" src="{{ $vendor->getFirstMediaUrlOrDefault(VENDOR_COVER)['url'] }}">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="licenses">{{__('vendorAdmin.licenses')}}</label>
                                <div class="input-group">
                                    <div class="custom-file">
                                        <input type="file" multiple name="licenses" class="custom-file-input" id="licenses">
                                        <label class="custom-file-label">{{__('vendorAdmin.choose_file')}}</label>
                                    </div>
                                </div>
                                <div class="mt-1">
                                    @foreach($vendor->getMedia(VENDOR_PATH) as $license)
                                    <img class="img-thumbnail" width="200" src="{{ $license->getUrl() }}">
                                    @endforeach
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="location">{{__('vendorAdmin.location')}}</label>
                                {!! generate_map() !!}
                                <input type="hidden" class="lat" value="{{$vendor->latitude}}" readonly name="latitude" required>
                                <input type="hidden" class="lng" value="{{$vendor->longitude}}" readonly name="longitude" required>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="facebook">{{__('vendorAdmin.facebook')}}</label>
                                        <input type="url" class="form-control" name="facebook"
                                               id="facebook" value="{{$vendor->facebook}}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="twitter">{{__('vendorAdmin.twitter')}}</label>
                                        <input type="url" class="form-control" name="twitter"
                                               id="twitter" value="{{$vendor->twitter}}">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="youtube">{{__('vendorAdmin.youtube')}}</label>
                                        <input type="url" class="form-control" name="youtube"
                                               id="youtube" value="{{$vendor->youtube}}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="instagram">{{__('vendorAdmin.instagram')}}</label>
                                        <input type="url" class="form-control" name="instagram"
                                               id="instagram" value="{{$vendor->instagram}}">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="pinterest">{{__('vendorAdmin.pinterest')}}</label>
                                        <input type="url" class="form-control" name="pinterest"
                                               id="pinterest" value="{{$vendor->pinterest}}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="website">{{__('vendorAdmin.website')}}</label>
                                        <input type="url" class="form-control" name="website"
                                               id="website" value="{{$vendor->website}}">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="password">{{__('vendorAdmin.password')}}</label>
                                        <input type="password" class="form-control" name="password"
                                               id="password" placeholder="{{__('vendorAdmin.password_leave_it_blank')}}" ">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="password_confirmation">{{__('vendorAdmin.password_confirmation')}}</label>
                                        <input type="password" class="form-control" name="password_confirmation"
                                               id="password_confirmation">
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
@section('js_additional')
    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key={{env('NOVA_MAPS_ADDRESS_KEY')}}&libraries=places&sensor=false"></script>
    <script src="{{front_url()}}/assets/js/map.js"></script>
@endsection
