@extends('layouts.master')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Welcome</div>

                <div class="card-body">
                    @if (Auth::user())
                        <a class="dropdown-item" href="{{ route('todo.index') }}">
                            {{ __('Todos') }}
                        </a>
                        @if (Auth::user()->is_authorized('admin'))
                            <a class="dropdown-item" href="{{ route('log.index') }}">
                                {{ __('Logs') }}
                            </a>
                        @endif
                    @else
                        Please <a href="{{route('login')}}">Login</a> to use this app.
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
