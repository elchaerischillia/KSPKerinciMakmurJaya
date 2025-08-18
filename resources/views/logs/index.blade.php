@extends('layouts.app')

@section('content')
<div class="container">
    <h4>Activity Log</h4>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>User</th>
                <th>Action</th>
                <th>Module</th>
                <th>Description</th>
                <th>IP</th>
                <th>User Agent</th>
                <th>Waktu</th>
            </tr>
        </thead>
        <tbody>
            @foreach($logs as $log)
            <tr>
                <td>{{ $log->user->name ?? 'Guest' }}</td>
                <td>{{ $log->action }}</td>
                <td>{{ $log->module }}</td>
                <td>{{ $log->description }}</td>
                <td>{{ $log->ip_address }}</td>
                <td>{{ $log->user_agent }}</td>
                <td>{{ $log->created_at }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    {{ $logs->links() }}
</div>
@endsection
