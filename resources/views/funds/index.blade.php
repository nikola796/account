@extends('app')


@section('content')

    <h1>Движения</h1>
    <hr>

    @foreach($funds as $fund)
    <article>
        <h2>
            <a href="{{ url('/funds', $fund->id) }}" >{{ $fund->name }}</a>
        </h2>

        <div class="body"> <h5>{{ $fund->comment }}</h5></div>

        <div class="body">Сума: {{ $fund->amount }} лв.</div>

        <div class="body"><h5>Събитието е възникнало на: {{ $fund->published_at }}</h5></div>
    </article>

    @endforeach

@stop