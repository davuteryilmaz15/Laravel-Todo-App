@extends('layouts.master')

@section('content')
    <div class="container" style="margin-top:50px"> 
        <h3>Edit Todo</h3>
        <hr>
        {!! Form::model($todo,["route" => ["todo.update",$todo->id], "method" => "PUT"]) !!}

        {!! Form::bsText('title', 'Title') !!}
        {!! Form::bsDate('deadline', 'Deadline') !!}

        {!! Form::bsSubmit('SAVE') !!}
        {!! Form::close() !!}
        <hr>
    </div>
@endsection