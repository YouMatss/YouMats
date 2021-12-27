@extends('vendorAdmin.layouts.master')
@section('title')
    <title>{{__('vendorAdmin.branches')}}</title>
@endsection
@section('content')
    <div class="pt-2">
        <div class="col-md-12">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">{{__('vendorAdmin.branches')}}</h3>
                </div>
                <div class="card-body">
                    <div class="float-right">
                        <a href="{{route('vendor.branch.create')}}" class="btn btn-sm mb-3 btn-primary">{{__('vendorAdmin.add_button')}}</a>
                    </div>
                    <table class="table table-bordered table-striped" style="width: 100%">
                        <thead>
                            <tr>
                                <th class="text-center">#</th>
                                <th class="text-center">{{__('vendorAdmin.name')}}</th>
                                <th class="text-center">{{__('vendorAdmin.city')}}</th>
                                <th class="text-center">{{__('vendorAdmin.actions')}}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($branches as $branch)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{$branch->name}}</td>
                                    <td>{{$branch->city->name}}</td>
                                    <td>
                                        <a href="{{route('vendor.branch.edit', [$branch->id])}}" class="btn btn-warning btn-xs">{{__('vendorAdmin.edit_button')}}</a>
                                        <a href="{{route('vendor.branch.delete', [$branch->id])}}" class="btn btn-danger btn-xs">{{__('vendorAdmin.delete_button')}}</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="mt-3">
                        {{$branches->links()}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
