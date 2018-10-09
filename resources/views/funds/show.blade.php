@extends('app')


@section('content')

    <h2>{{ $fund->name }}</h2>

    <article>

        <div class="body">{{ $fund->comment }}</div>

        <div class="body">Сума: {{ ($fund->amount) }} лв.</div>

        <div class="body">Събитието е възникнало на: {{ $fund->published_at }}</div>

    </article>

    @unless ($fund->categories->isEmpty())

        <h5>Tags:</h5>
        <ul>
            @foreach($fund->categories as $category)
                <li>{!! link_to_action('FundsController@show', $category->name, [$category->name]) !!}</li>
            @endforeach
        </ul>

    @endunless

    {!! link_to('funds/'.$fund->id.'/edit', 'Edit', [ 'class' => "btn btn-default active", 'role' =>" button"]) !!}
@stop