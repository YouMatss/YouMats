@extends('vendorAdmin.layouts.master')
@section('title')
    <title>{{__('vendorAdmin.edit_branch')}}</title>
@endsection
@section('content')
    <section class="content pt-2">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12 mb-2">
                    <h4>{{__('vendorAdmin.edit_branch')}} ({{$branch->name}})</h4>
                    <form action="{{route('vendor.branch.update', [$branch->id])}}" method="post">
                        <div class="card">
                            {{csrf_field()}}
                            {{method_field('PUT')}}
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="name">{{__('vendorAdmin.name')}}</label>
                                    <input type="text" class="form-control" name="name"
                                           id="name" value="{{$branch->name}}">
                                </div>
                                <div class="form-group">
                                    <label for="city">{{__('vendorAdmin.city')}}</label>
                                    <select class="form-control" name="city_id" id="city">
                                        <option value="" selected disabled>{{__('vendorAdmin.city_placeholder')}}</option>
                                        @foreach($cities as $city)
                                            <option value="{{$city->id}}" @if($city->id == $branch->city_id) selected @endif>{{$city->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="phone">{{__('vendorAdmin.phone')}}</label>
                                    <input type="text" class="form-control" name="phone_number"
                                           id="phone" value="{{$branch->phone_number}}">
                                </div>
                                <div class="form-group">
                                    <label for="fax">{{__('vendorAdmin.fax')}}</label>
                                    <input type="text" class="form-control" name="fax"
                                           id="fax" value="{{$branch->fax}}">
                                </div>
                                <div class="form-group">
                                    <label for="website">{{__('vendorAdmin.website')}}</label>
                                    <input type="text" class="form-control" name="website"
                                           id="website" value="{{$branch->website}}">
                                </div>
                                <div class="form-group">
                                    <label for="address">{{__('vendorAdmin.address')}}</label>
                                    <input type="text" class="form-control" name="address"
                                           id="address" value="{{$branch->address}}">
                                </div>
                                <div class="form-group">
                                    <label for="location">{{__('vendorAdmin.location')}}</label>
                                    {!! generate_map() !!}
                                    <input type="hidden" value="{{$branch->latitude}}" class="lat" readonly name="latitude" required>
                                    <input type="hidden" value="{{$branch->longitude}}" class="lng" readonly name="longitude" required>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-youmats">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('js_additional')
    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key={{env('NOVA_MAPS_ADDRESS_KEY')}}&libraries=places&sensor=false"></script>
    <script src="{{front_url()}}/assets/js/map.js"></script>
@endsection
