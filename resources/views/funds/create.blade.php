@extends('app')

@section('content')




    <h1>Добави нова транзакция</h1>

    <hr>

    {!! Form::open(['url' => '/funds']) !!}

   @include('funds.form', ['submitFormText' => 'Запис'])

    {!! Form::close() !!}

    @include('errors.list')

@stop