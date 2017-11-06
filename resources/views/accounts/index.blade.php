@extends('app')


@section('content')

    <h1>Сметки</h1>

    @if(count($accounts) > 0)

        @foreach($accounts as $account)
            <article>
                <h2>
                    <a href="{{ url('/accounts', $account->id) }}">{{ $account->name }}</a>
                </h2>

                <div class="body"><h5>{{ $account->comment }}</h5></div>

                <div class="body"><h5>{{ $account->published_at }}</h5></div>

                <div class="body"><h5>{{ $account->group->name }}</h5></div>

                {{--@unless ($account->group->isEmpty())--}}

                    {{--<h5>Tags:--}}

                        {{--@foreach($account->group as $tag)--}}
                            {{--<strong>{{ $tag->name }}</strong>--}}
                        {{--@endforeach--}}

                    {{--</h5>--}}
                {{--@endunless--}}

            </article>

        @endforeach

    @else
    <p>Нямате добавени сметки</p>
    @endif

@stop

@section('footer')