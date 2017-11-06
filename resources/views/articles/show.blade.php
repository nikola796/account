@extends('app')


@section('content')

    <h2>{{ $article->title }}</h2>

    <article>

        <div class="body">{{ $article->body }}</div>

    </article>

    @unless ($article->tags->isEmpty())

        <h5>Tags:</h5>
        <ul>
            @foreach($article->tags as $tag)
                <li>{!! link_to_action('TagsController@show', $tag->name, [$tag->name]) !!}</li>
            @endforeach
        </ul>

    @endunless
{!! link_to('articles/'.$article->id.'/edit', 'Edit', [ 'class' => "btn btn-default active", 'role' =>" button"]) !!}
@stop