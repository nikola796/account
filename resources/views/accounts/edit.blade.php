@extends('app')

@section('content')

    <h1>Edit: {{ $account->title }}</h1>

    {!! Form::model($account,['method' => 'PATCH', 'action' =>['AccountsController@update', $account->id]]) !!}

   @include('accounts.form', ['submitButtonText' => 'Edit Article'])

    {!! Form::close() !!}

    @include('errors.list')

    @stop