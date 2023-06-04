@extends('statistics.layout')
@section('content')
    <div>
        <form action="{{route('statistics.log.get')}}" method="GET">
            <select id="vendors" name="vendor_id" class="form-control">
                <option value="" selected disabled>Select Vendor</option>
                @foreach($subscribed_vendors as $subscribed_vendor)
                    <option value="{{ $subscribed_vendor->id }}">{{ $subscribed_vendor->name }}</option>
                @endforeach
            </select>

            <input id="date_from" type="date" name="date_from" class="form-control" />
            <input id="date_to" type="date" name="date_to" class="form-control"/>
            <button class="btn btn-primary" type="submit">Filter</button>
        </form>
    </div>

    <div class="content">
        <table id="myTable" class="display" data-order='[[ 3, "asc" ]]'>
            <thead>
            <tr>
                <th>IP</th>
                <th>Country</th>
                <th>City</th>
                <th>Date</th>
            </tr>
            </thead>
            <tbody>
            @foreach($logs as $log)
                <tr>
                    <td><a href="{{route('statistics.log.ip', [$log->ip])}}">{{$log->ip}}</a></td>
                    <td>{{$log->country}}</td>
                    <td>{{$log->city}}</td>
                    <td>{{date('d-M-Y-H-i-s', strtotime($log->created_at))}}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
