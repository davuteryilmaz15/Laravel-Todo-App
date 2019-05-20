@extends('layouts.master')

@section('content')
    <div class="container" style="margin-top:50px"> 
        <h3>Todo List</h3>
        <hr>
        <a href="{{ route('todo.create') }}" class="btn btn-danger">+ Add New Todo</a>
        <hr>
        @if (count($todos) == 0)
            <div class="alert alert-warning" role="alert">
                There is no todo.
            </div>
        @else
            <table class="table">
                <thead>
                    <tr>
                    <th scope="col">#</th>
                    <th scope="col">Title</th>
                    <th scope="col">Deadline</th>
                    <th scope="col">Status</th>
                    <th scope="col"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($todos as $todo)
                        <tr @if ($todo->deadline < date('Y-m-d')) 
                                class="alert alert-danger"
                            @elseif (!$todo->completed)
                                class="alert alert-warning"
                            @endif >
                            <th scope="row">{{$todo->id}}</th>
                            <td>{{$todo->title}}</td>
                            <td>{{$todo->deadline}}</td>
                            <td>@if ($todo->completed)
                                    Done
                                @elseif ($todo->deadline < date('Y-m-d'))
                                    Expired
                                @else
                                    On wait
                                @endif</td>
                            <td>@if (!$todo->completed)
                                    <a href="/todo/complete/{{$todo->id}}" class="btn btn-success">Complete</a>
                                @else
                                    <a href="/todo/complete/{{$todo->id}}" class="btn btn-warning">Incomplete</a>
                                @endif
                            <a href="{{route('todo.edit', ['todo'=>$todo->id])}}" class="btn btn-primary" data-toggle="tooltip" title="Edit">Edit</a>
                            <form action="{{ route('todo.destroy',['todo'=>$todo->id])}}" method="POST" style="display:inline">
                                {{csrf_field()}}
                                {{method_field('DELETE')}}
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure to delete this todo?')">Delete</button>
                            </form>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
@endsection