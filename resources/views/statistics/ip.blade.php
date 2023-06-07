@extends('statistics.layout')
@section('content')
    <h2>IP: {{$ip}} - {{$country}} - {{$city}}</h2>

    <div class="content">
        <table id="myTable" class="display" data-order='[[ 4, "desc" ]]'>
            <thead>
            <tr>
                <th>URL</th>
                <th>Type</th>
                <th>Model</th>
                <th>Model Type</th>
                <th>Subscribed?</th>
                <th>Date</th>
            </tr>
            </thead>
            <tbody>
            @foreach($logs as $log)
                <tr>
                    <td>
                        <a href="{{$log->url}}" target="_blank" title="{{$log->url}}">
                            {{\Illuminate\Support\Str::limit($log->url, 30)}}
                        </a>
                    </td>
                    <td>{{$log->type}}</td>
                    <td>{{$log->page_type}}</td>
                    <td>
                        <label title="{{$log->page->name}}">
                            {{\Illuminate\Support\Str::limit($log->page->name, 50)}}
                        </label>
                    </td>
                    <td>
                        {!! $log->is_subscribed ? '<span class="badge bg-success">Yes</span>': '<span class="badge bg-danger">No</span>' !!}
                    </td>
                    <td>{{date('d-F-Y H:i:s', strtotime($log->created_at))}}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
