@extends('app')


@section('content')

    <h2>{{ $fund->name }}</h2>

    <article>

        <div class="body">{{ $fund->comment }}</div>

        <div class="body">Сума: {{ ($fund->amount) / 100 }} лв.</div>

        <div class="body">Събитието е възникнало на: {{ $fund->published_at }}</div>

    </article>



@stop