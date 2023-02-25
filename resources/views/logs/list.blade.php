@extends('layout.base')

@section('content')
    <p class="text-center">Pagination isn't implemented to simplify the task</p>

    <table class="table container">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Message</th>
            <th scope="col">Level</th>
            <th scope="col">LevelName</th>
            <th scope="col">Channel</th>
            <th scope="col">Remote address</th>
        </tr>
        </thead>
        <tbody>
        @foreach($logs as $log)
            <tr>
                <th scope="row">{{$log->id}}</th>
                <th scope="row">{{$log->message}}</th>
                <th scope="row">{{$log->level}}</th>
                <th scope="row">{{$log->level_name}}</th>
                <th scope="row">{{$log->channel}}</th>
                <th scope="row">{{$log->remote_addr}}</th>
            </tr>
        @endforeach
        </tbody>
    </table>

@endsection
