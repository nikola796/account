@extends('app')


@section('content')
    <h1>All Tag From {{ Auth::user()->name }}</h1>
    <hr>
@if(isset($articles))
    @foreach($articles as $key => $tag)

        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading"><a href="{{ url('/tags', $key) }}">{{ strtoupper($key) }}</a></div>

                    <div class="panel-body">
                        @foreach($tag as $key => $article)
                            <article>
                                <h3>
                                    <a href="{{ url('/articles', $article->id) }}">{{ $article->title }}</a>
                                </h3>

                                <div class="body"><h5>{{ $article->body }}</h5></div>

                                <div class="body"><h5>{{ $article->published_at }}</h5></div>

                                @unless ($article->tags->isEmpty())

                                    <h5>Tags:

                                        @foreach($article->tags as $tag)
                                            <strong>{{ $tag->name }}</strong>
                                        @endforeach

                                    </h5>
                            </article>

                            @endunless

                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@else
    <h3>No Tags</h3>
@endif

    {{--<div class="body"><h5>{{ $article->body }}</h5></div>--}}

    {{--<div class="body"><h5>{{ $article->published_at }}</h5></div>--}}

    {{--@unless ($article->tags->isEmpty())--}}

    {{--<h5>Tags:--}}

    {{--@foreach($article->tags as $tag)--}}
    {{--<strong>{{ $tag->name }}</strong>--}}
    {{--@endforeach--}}

    {{--</h5>--}}
    {{--@endunless--}}





    <input type="hidden" class="page" name="page_name" value="tags">

@stop/