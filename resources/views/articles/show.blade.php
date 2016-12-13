@extends('app')


@section('content')

    <h2>{{ $article->title }}</h2>

    <article>

        <div class="body">{{ $article->body }}</div>

    </article>



@stop