@extends('layouts.master')

@section('content')
    <div class="container" style="margin-top:50px"> 
        <h3>Logs</h3>
        <hr>
        @if (count($logs) == 0)
            <div class="alert alert-warning" role="alert">
                There is no log.
            </div>
        @else
            <table class="table table-hover">
                <thead>
                    <tr>
                    <th scope="col">#</th>
                    <th scope="col">Log Date</th>
                    <th scope="col">Message</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($logs as $log)
                        <tr>
                            <th scope="row">{{$log->id}}</th>
                            <td>{{$log->created_at}}</td>
                            <td>{{$log->message}}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {{$logs->links()}}
        @endif
    </div>
@endsection