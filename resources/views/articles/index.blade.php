@extends('app')


@section('content')
    <h1>Статии</h1>
    <hr>

    {!! link_to('articles/create', 'Нова статия', [ 'class' => "btn btn-default active", 'role' =>" button"]) !!}
@if(count($articles) > 0)
    @foreach($articles as $article)
        <article>
            <h2>
                <a href="{{ url('/articles', $article->id) }}">{{ $article->title }}</a>
            </h2>

            <div class="body"><h5>{{ $article->body }}</h5></div>

            <div class="body"><h5>{{ $article->published_at }}</h5></div>

            @unless ($article->tags->isEmpty())

                <h5>Tags:

                    @foreach($article->tags as $tag)
                        <strong>{{ $tag->name }}</strong>
                    @endforeach

                </h5>
            @endunless

        </article>

    @endforeach
@else
    <h3>Нямата добавени статии</h3>
@endif
    <input type="hidden" class="page" name="page_name" value="articles">
@stop