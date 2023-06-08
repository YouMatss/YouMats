@extends('statistics.layout')
@section('content')
    <div>
        <form action="{{route('statistics.log.get')}}" method="GET">
            <select id="vendors" name="vendor_id" class="form-control select2">
                <option value="" selected>Select Vendor</option>
                @foreach($vendors as $vendor)
                    <option value="{{ $vendor->id }}" @if(isset($_GET['vendor_id']) && $_GET['vendor_id'] == $vendor->id) selected @endif>{{ $vendor->name }}</option>
                @endforeach
            </select>
            <select id="categories" name="category_id" class="form-control select2">
                <option value="" selected>Select Category</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" @if(isset($_GET['category_id']) && $_GET['category_id'] == $category->id) selected @endif>{{ $category->name }}</option>
                @endforeach
            </select>

            <input id="date_from" type="date" name="date_from" value="{{ isset($_GET['date_from']) ? $_GET['date_from'] : null }}" class="form-control" />
            <input id="date_to" type="date" name="date_to" value="{{ isset($_GET['date_to']) ? $_GET['date_to'] : null }}" class="form-control"/>
            <button class="btn btn-primary" type="submit">Filter</button>
        </form>
    </div>

    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-3">
                    <div class="card card-stats mb-4 mb-xl-0">
                        <div class="card-body bg-primary text-white">
                            <div class="row">
                                <div class="col">
                                    <h5 class="card-title text-uppercase mb-0">Visits</h5>
                                    <span class="h2 font-weight-bold mb-0">{{ $visits }}</span>
                                </div>
                                <div class="col-auto">
                                    <div class="icon icon-shape text-white rounded-circle shadow">
                                        <i class="fas fa-chart-bar"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card card-stats mb-4 mb-xl-0">
                        <div class="card-body bg-primary text-white">
                            <div class="row">
                                <div class="col">
                                    <h5 class="card-title text-uppercase mb-0">Calls</h5>
                                    <span class="h2 font-weight-bold mb-0">{{ $calls }}</span>
                                </div>
                                <div class="col-auto">
                                    <div class="icon icon-shape text-white rounded-circle shadow">
                                        <i class="fas fa-chart-bar"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card card-stats mb-4 mb-xl-0">
                        <div class="card-body bg-primary text-white">
                            <div class="row">
                                <div class="col">
                                    <h5 class="card-title text-uppercase mb-0">Chats</h5>
                                    <span class="h2 font-weight-bold mb-0">{{ $chats }}</span>
                                </div>
                                <div class="col-auto">
                                    <div class="icon icon-shape text-white rounded-circle shadow">
                                        <i class="fas fa-chart-bar"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card card-stats mb-4 mb-xl-0">
                        <div class="card-body bg-primary text-white">
                            <div class="row">
                                <div class="col">
                                    <h5 class="card-title text-uppercase mb-0">E-Mails</h5>
                                    <span class="h2 font-weight-bold mb-0">{{ $emails }}</span>
                                </div>
                                <div class="col-auto">
                                    <div class="icon icon-shape text-white rounded-circle shadow">
                                        <i class="fas fa-chart-bar"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
