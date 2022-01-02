@extends('vendorAdmin.layouts.master')
@section('title')
    <title>{{__('vendorAdmin.shipping_groups')}}</title>
@endsection
@section('content')
    <div class="pt-2">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header card-youmats">
                    <h3 class="card-title">{{__('vendorAdmin.shipping_groups')}}</h3>
                </div>
                <div class="card-body">
                    <div class="float-right">
                        <a href="{{route('vendor.shipping-group.create')}}" class="btn btn-sm mb-3 btn-youmats">{{__('vendorAdmin.add_button_shipping')}}</a>
                    </div>
                    <table class="table" style="width: 100%">
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
                                        <a href="{{route('vendor.shipping-group.edit', [$shipping_price->id])}}" class="btn btn-youmats btn-xs">{{__('vendorAdmin.edit_button')}}</a>
                                        <form style="display: inline-block" method="post" action="{{route('vendor.shipping-group.delete', [$shipping_price->id])}}">
                                            {{csrf_field()}}
                                            {{method_field('DELETE')}}
                                            <button class="btn btn-danger btn-xs" type="submit">{{__('vendorAdmin.delete_button')}}</button>
                                        </form>
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
