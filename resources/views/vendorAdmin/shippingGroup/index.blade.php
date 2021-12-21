@extends('vendorAdmin.layouts.master')
@section('title')
    <title>{{__('vendorAdmin.shipping_groups')}}</title>
@endsection
@section('content')
    <div class="pt-2">
        <div class="col-md-12">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">{{__('vendorAdmin.shipping_groups')}}</h3>
                </div>
                <div class="card-body">
                    <div class="float-right">
                        <a href="{{route('vendor.shipping-group.create')}}" class="btn btn-sm mb-3 btn-primary">{{__('vendorAdmin.add_button')}}</a>
                    </div>
                    <table class="table table-bordered table-striped" style="width: 100%">
                        <thead>
                            <tr>
                                <th class="text-center">#</th>
                                <th class="text-center">{{__('vendorAdmin.name')}}</th>
                                <th class="text-center">{{__('vendorAdmin.price')}}</th>
                                <th class="text-center">{{__('vendorAdmin.time')}}</th>
                                <th class="text-center">{{__('vendorAdmin.format')}}</th>
                                <th class="text-center">{{__('vendorAdmin.actions')}}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($shipping_prices as $shipping_price)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{$shipping_price->name}}</td>
                                    <td>{{$shipping_price->default_price}}</td>
                                    <td>{{$shipping_price->default_time}}</td>
                                    <td>{{$shipping_price->default_format}}</td>
                                    <td>
                                        <a href="{{route('vendor.shipping-group.edit', [$shipping_price->id])}}" class="btn btn-warning btn-xs">{{__('vendorAdmin.edit_button')}}</a>
                                        <a href="{{route('vendor.shipping-group.delete', [$shipping_price->id])}}" class="btn btn-danger btn-xs">{{__('vendorAdmin.delete_button')}}</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="mt-3">
                        {{$shipping_prices->links()}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
