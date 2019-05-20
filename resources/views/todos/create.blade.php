@extends('layouts.master')

@section('content')
    <div class="container" style="margin-top:50px"> 
        <h3>New Todo</h3>
        <hr>
        {!! Form::open(['route' => ['todo.store'], 'method' => 'post']) !!}

        {!! Form::bsText('title', 'Title') !!}
        {!! Form::bsDate('deadline', 'Deadline') !!}

        {!! Form::bsSubmit('SAVE') !!}
        {!! Form::close() !!}
        <hr>
    </div>
@endsection