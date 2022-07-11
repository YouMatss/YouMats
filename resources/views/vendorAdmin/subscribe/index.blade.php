@extends('vendorAdmin.layouts.master')
@section('title')
    <title>{{__('vendorAdmin.subscribe_title')}}</title>
@endsection
@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">{{__('vendorAdmin.subscribe_title')}}</h1>
                    <p>{{__('vendorAdmin.membership_price')}}</p>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('home')}}">{{__('vendorAdmin.home')}}</a></li>
                        <li class="breadcrumb-item active">{{__('vendorAdmin.subscribe_title')}}</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <section class="content content-vendor-edit pt-2">
        <div class="container-fluid">
            <div class="row">
                @foreach($memberships as $membership)
                <div class="col-md-4 mb-2">
                    <form action="{{route('vendor.subscribe.upgrade')}}" method="get" enctype="multipart/form-data">
                        <input type="hidden" name="membership_id" value="{{$membership->id}}">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <p><strong>{{$membership->name . ' (' . $membership->price . ' ' . getCurrency('symbol') . ')'}}</strong></p>
                                    </div>
                                    <div class="col-md-12">
                                        <span>{!! $membership->desc !!}</span>
                                    </div>
{{--                                    @if($current_subscribe_id == $membership->id)--}}
{{--                                    <div class="col-md-12">--}}
{{--                                        <label class="label label-success">{{__('vendorAdmin.already_subscribed')}}</label>--}}
{{--                                    </div>--}}
{{--                                    @endif--}}
                                    <div class="col-md-12 mt-2">
                                        @if($current_subscribe_id == $membership->id)
                                            <button type="submit" class="btn btn-warning" form="cancel_subscribe">{{__('vendorAdmin.cancel_subscribe')}}</button>
                                        @else
                                            <button type="submit" class="btn btn-youmats">{{__('vendorAdmin.subscribe_now')}}</button>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                @endforeach
            </div>
        </div>
    </section>
    <form action="{{route('vendor.subscribe.cancel')}}" method="post" id="cancel_subscribe">
        {{csrf_field()}}
    </form>
@endsection
