@extends('vendorAdmin.layouts.master')
@section('title')
    <title>{{__('vendorAdmin.create_shipping_group')}}</title>
@endsection
@section('content')
    <section class="content pt-2">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <h4>{{__('vendorAdmin.create_shipping_group')}}</h4>
                    <div class="card">
                        <form action="{{route('vendor.shipping-group.store')}}" method="post">
                            {{csrf_field()}}
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="name">{{__('vendorAdmin.name')}}</label>
                                    <input type="text" class="form-control" name="name" id="name">
                                </div>

                                <div class="card">
                                    <div class="card-header card-youmats">
                                        <h3 class="card-title">{{__('vendorAdmin.specific_shipping_terms')}}</h3>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-12" id="clone-container"></div>
                                            <div class="col-md-12">
                                                <button type="button" id="clone-add" class="btn btn-youmats btn-block">{{__('vendorAdmin.add')}}</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="card">
                                    <div class="card-header card-youmats">
                                        <h3 class="card-title">{{__('vendorAdmin.default_for_all_cities') . ' ' . __('vendorAdmin.optional')}}</h3>
                                    </div>
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label for="price">{{__('vendorAdmin.default_price')}}</label>
                                            <input type="number" class="form-control" id="price" name="default_price" min="0" step="0.05" />
                                        </div>
                                        <div class="form-group">
                                            <label for="time">{{__('vendorAdmin.default_time')}}</label>
                                            <input type="number" class="form-control" id="time" name="default_time" min="1" step="1" />
                                        </div>
                                        <div class="form-group">
                                            <label for="format">{{__('vendorAdmin.default_format')}}</label>
                                            <select class="form-control" id="format" name="default_format">
                                                <option value="" disabled selected>{{__('vendorAdmin.format_placeholder')}}</option>
                                                <option value="hour">{{__('vendorAdmin.hour')}}</option>
                                                <option value="day">{{__('vendorAdmin.day')}}</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-youmats">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('js_additional')
<script>
    $(document).ready(function () {
        var clone_element = `<div class="clone-element">
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="cities">{{__('vendorAdmin.cities')}}</label>
                            <select class="form-control" id="cities" name="cities[]">
                                <option value="" disabled selected>{{__('vendorAdmin.cities_placeholder')}}</option>
                                @foreach($cities as $city)
                                    <option value="{{$city->id}}">{{$city->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="price">{{__('vendorAdmin.price')}}</label>
                            <input type="number" class="form-control" id="price" name="price[]" min="0" step="0.05" />
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="time">{{__('vendorAdmin.time')}}</label>
                            <input type="number" class="form-control" id="time" name="time[]" min="1" step="1" />
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="format">{{__('vendorAdmin.format')}}</label>
                            <select class="form-control" id="format" name="format[]">
                                <option value="" disabled selected>{{__('vendorAdmin.format_placeholder')}}</option>
                                <option value="hour">{{__('vendorAdmin.hour')}}</option>
                                <option value="day">{{__('vendorAdmin.day')}}</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-1">
                <div class="form-group">
                    <label>{{__('vendorAdmin.remove')}}</label>
                    <button class="form-control btn btn-danger btn-xs clone-remove">
                        <i class="fas fa-trash"></i>
                    </button>
                </div>
            </div>
                </div>
            </div>`;
        $('#clone-add').on('click', function () {
            $('#clone-container').append(clone_element);
        });
        $(document).on('click', '.clone-remove', function () {
            $(this).closest('.clone-element').remove();
        });
    });
</script>
@endsection
