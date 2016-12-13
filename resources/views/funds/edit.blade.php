@extends('app')

@section('content')

    <h1> Редактирате: {{ $fund->name }}</h1>

    {!! Form::model($fund,['method' => 'PATCH','action' => ['FundsController@update', $fund->id]]) !!}

    @include('funds.form', ['submitFormText' => 'Запис'])

    {!! Form::close() !!}

    @include('errors.list')


@stop