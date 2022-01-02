@extends('vendorAdmin.layouts.master')
@section('title')
    <title>{{__('vendorAdmin.products')}}</title>
@endsection
@section('content')
    <div class="pt-2">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header card-youmats">
                    <h3 class="card-title">{{__('vendorAdmin.products')}}</h3>
                </div>
                <div class="card-body">
                    <div class="float-right">
                        <a href="{{route('vendor.product.create')}}" class="btn btn-sm mb-3 btn-youmats">{{__('vendorAdmin.add_button')}}</a>
                    </div>
                    <table class="table" style="width: 100%">
                        <thead>
                            <tr>
                                <th class="text-center">#</th>
                                <th class="text-center">{{__('vendorAdmin.name')}}</th>
                                <th class="text-center">{{__('vendorAdmin.category')}}</th>
                                <th class="text-center">{{__('vendorAdmin.price')}}</th>
                                <th class="text-center">{{__('vendorAdmin.views')}}</th>
                                <th class="text-center">{{__('vendorAdmin.actions')}}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($products as $product)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{$product->name}}</td>
                                    <td>{{$product->category->name}}</td>
                                    <td>{{$product->price}} {{__('vendorAdmin.sar')}}</td>
                                    <td>{{$product->views}}</td>
                                    <td>
                                        <a href="{{route('vendor.product.edit', [$product->id])}}" class="btn btn-youmats btn-xs">{{__('vendorAdmin.edit_button')}}</a>
                                        @if($product->active)
                                        <a target="_blank" href="{{route('front.product', [generatedNestedSlug($product->category->ancestors()->pluck('slug')->toArray(), $product->category->slug), $product->slug])}}" class="btn btn-success btn-xs">{{__('vendorAdmin.view_front')}}</a>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="mt-3">
                        {{$products->links()}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
