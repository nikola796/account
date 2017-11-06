@extends('app')


@section('content')
    <h1>Всички разходи за {{ $cat_name }}</h1>
    <hr>

    @foreach($funds as $fund)
        <article>
            <h2>
                <a href="{{ url('/funds', $fund->id) }}">{{ $fund->name }}</a>
            </h2>

            <div class="body"><h5>{{ $fund->comment }}</h5></div>

            <div class="body"><h5>{{ $fund->published_at }}</h5></div>

            @unless ($fund->categories->isEmpty())

                <h5>Tags:

                    @foreach($fund->categories as $tag)
                        <strong>{{ $tag->name }}</strong>
                    @endforeach

                </h5>
            @endunless

        </article>

    @endforeach

    <input type="hidden" class="page" name="page_name" value="articles">

@stop