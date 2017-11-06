@extends('app')


@section('content')
    <h1>All Articles For {{ $tg }}</h1>
    <hr>

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

    <input type="hidden" class="page" name="page_name" value="articles">

@stop