@extends('vendorAdmin.layouts.master')
@section('title')
    <title>{{__('vendorAdmin.products')}}</title>
@endsection
@section('content')
    <div class="pt-2">
        <div class="col-md-12">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">{{__('vendorAdmin.products')}}</h3>
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-striped" style="width: 100%">
                        <thead>
                        <tr>
                            <th class="text-center">{{__('vendorAdmin.order_id')}}</th>
                            <th class="text-center">{{__('vendorAdmin.name')}}</th>
                            <th class="text-center">{{__('vendorAdmin.price')}}</th>
                            <th class="text-center">{{__('vendorAdmin.status')}}</th>
                            <th class="text-center">{{__('vendorAdmin.payment_status')}}</th>
                            <th class="text-center">{{__('vendorAdmin.date')}}</th>
                            <th class="text-center">{{__('vendorAdmin.actions')}}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($items as $item)
                            <tr>
                                <td>{{$item->order->order_id}}</td>
                                <td>{{$item->order->name}}</td>
                                <td>{{$item->price}}</td>
                                <td>
                                    <label class="badge
                                    @if($item->status == 'pending')
                                        badge-warning
                                    @elseif($item->status == 'shipping')
                                        badge-primary
                                    @elseif($item->status == 'completed')
                                        badge-success
                                    @elseif($item->status == 'refused')
                                        badge-danger
                                    @endif
                                    ">
                                        {{$item->status}}
                                    </label>
                                </td>
                                <td>
                                    <label class="badge
                                    @if($item->payment_status == 'pending')
                                        badge-warning
                                    @elseif($item->payment_status == 'refunded')
                                        badge-danger
                                    @elseif($item->payment_status == 'completed')
                                        badge-success
                                    @endif
                                    ">
                                        {{$item->payment_status}}
                                    </label>
                                </td>
                                <td>{{date('d M Y H:i A', strtotime($item->order->created_at))}}</td>
                                <td>
                                    <a href="{{route('vendor.order.edit', [$item->order->id])}}" class="btn btn-warning btn-xs">{{__('vendorAdmin.edit_button')}}</a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <div class="mt-3">
                        {{$items->links()}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
