@extends('app')

@section('content')




    <h1>Добави нова категория</h1>

    <hr>
    {!! Form::model($fund = new \App\Category, ['url' => '/categories']) !!}

    @include('categories.form', ['submitFormText' => 'Запис'])

    {!! Form::close() !!}

    @include('errors.list')

@stop