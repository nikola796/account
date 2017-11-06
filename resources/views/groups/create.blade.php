@extends('app')

@section('content')
    <h1>Добавете нова група</h1>

    <hr>

    {!! Form::model($group = new \App\Group, ['url' => '/groups']) !!}

    @include('groups.form', ['submitButtonText' => 'Добави групата'])

    {!! Form::close() !!}

    @include('errors.list')

@stop