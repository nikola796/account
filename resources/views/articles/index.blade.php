@extends('app')


@section('content')
    <h1>Articles</h1>
    <hr>

    @foreach($articles as $article)
    <article>
        <h2>
            <a href="{{ url('/articles', $article->id) }}" >{{ $article->title }}</a>
        </h2>

        <div class="body"> <h5>{{ $article->body }}</h5></div>

        <div class="body"> <h5>{{ $article->published_at }}</h5></div>
    </article>

    @endforeach

@stop