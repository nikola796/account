@extends('app')

@section('content')
<h1>Добавете нов разход</h1>

<hr>

{!! Form::model($account = new \App\Account, ['url' => '/accounts']) !!}

@include('accounts.form', ['submitButtonText' => 'Добави'])

{!! Form::close() !!}


@include('errors.list')
@stop