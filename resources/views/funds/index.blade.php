@extends('app')


@section('content')

    <h1>Движения</h1>
    <hr>
    {!! link_to('funds/create', 'Добави запис', [ 'class' => "btn btn-default active", 'role' =>" button"]) !!}
    @if(count($funds) > 0)
        @foreach($funds as $fund)
            <article>
                <h2>
                    <a href="{{ url('/funds', $fund->id) }}">{{ $fund->name }}</a>
                </h2>

                <div class="body"><h5>{{ $fund->comment }}</h5></div>

                <div class="body">Сума: {{ $fund->amount }} лв.</div>

                <div class="body"><h5>Събитието е възникнало на: {{ $fund->published_at }}</h5></div>

                @unless ($fund->categories->isEmpty())

                    <h5>Категория:

                        @foreach($fund->categories as $tag)
                            <a href="{{ action('CategoriesController@show', $tag->name, [$tag->name]) }}" style="border:1px solid black;padding:3px;background-color: cornflowerblue; border-radius: 5px; color:white">{{ $tag->name }}</a>
                        @endforeach

                    </h5>
                @endunless
            </article>

        @endforeach
    @else
        <h3>Нямате добавен запис</h3>
    @endif
    <input type="hidden" class="page" name="page_name" value="funds">
@stop