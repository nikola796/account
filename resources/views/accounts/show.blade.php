@extends('app')


@section('content')


    <h2>{{ $account->name }}</h2>

    <article>

        <div class="body">Коментар: {{ $account->comment }}</div>

        <div class="body">Сума: {{ $account->amount }}лв.</div>

        <p>Вид:
        @if($account->type === 1)
            <span>Приход</span>
            @else
                <span>Разход</span>
            @endif
            </p>

    </article>

        <h5>Категория: <strong>{!! link_to_action('GroupsController@show', $account->group->name, [$account->group->name]) !!}</strong></h5>

                {{--<li>{!! link_to_action('TagsController@show', $tag->name, [$tag->name]) !!}</li>--}}
 {{----}}
{{--{!! link_to('articles/'.$article->id.'/edit', 'Edit', [ 'class' => "btn btn-default active", 'role' =>" button"]) !!}--}}
@stop