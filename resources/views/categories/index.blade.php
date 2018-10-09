@extends('app')


@section('content')
    <h1>Всички категории на {{ Auth::user()->name }}</h1>
    <hr>

    {!! link_to('categories/create', 'Нова категория', [ 'class' => "btn btn-default active", 'role' =>" button"]) !!}

    @if(isset($funds))
        @foreach($funds as $key => $tag)

            <div class="row">
                <div class="col-md-10 col-md-offset-1">
                    <div class="panel panel-default">
                        <div class="panel-heading"><a href="{{ url('/categories', $key) }}">{{ mb_strtoupper($key) }}</a></div>

                        <div class="panel-body">
                            @foreach($tag as $key => $fund)
                                <article>
                                    <h3>
                                        <a href="{{ url('/funds', $fund->id) }}">{{ $fund->name }}</a>
                                    </h3>

                                    <div class="body"><h5>{{ $fund->comment }}</h5></div>

                                    <div class="body"><h5>Сума: {{ $fund->amount }}</h5></div>

                                    <div class="body"><h5>Вид:
                                    @if($fund->type == -1)
                                        Разход
                                    @else
                                        Приход
                                    @endif
                                    </h5></div>
                                    <div class="body"><h5>Дата: {{ $fund->published_at }}</h5></div>

                                    {{--@unless ($article->tags->isEmpty())--}}

                                        {{--<h5>Tags:--}}

                                            {{--@foreach($article->tags as $tag)--}}
                                                {{--<strong>{{ $tag->name }}</strong>--}}
                                            {{--@endforeach--}}

                                        {{--</h5>--}}
                                </article>

                                {{--@endunless--}}

                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    @else
        <h3>Не са добавени категории</h3>
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





    <input type="hidden" class="page" name="page_name" value="categories">

@stop/