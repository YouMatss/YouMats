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
                <div class="col-md-12 mb-2">
                    <form action="{{route('vendor.subscribe.upgrade')}}" method="get" enctype="multipart/form-data">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <p>{!! __('vendorAdmin.subscribe_text') !!}</p>
                                    </div>
                                    <div class="col-md-12">
                                        <span>{{__('vendorAdmin.membership_price')}}:</span>
                                        <strong>{{$membership->name . ' (' . $membership->price . ' ' . getCurrency('symbol') . ')'}}</strong>
                                    </div>
                                    <div class="col-md-12 mt-2">
                                        <button type="submit" class="btn btn-youmats">{{__('vendorAdmin.subscribe_now')}}</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
