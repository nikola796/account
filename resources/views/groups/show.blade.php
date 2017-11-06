@extends('app')

@section('content')

    <h1>Всички сметки към група {{ $group_name }}</h1>

    <hr>

    @foreach($accounts as $account)

        <article>

            <h2><a href="{{ url('/accounts', $account->id) }}">{{ $account->name }}</a></h2>

            <div class="body"><h5><strong>Коментар: </strong>{{ $account->comment }}</h5></div>

            <div class="body"><h5><strong>Сума: </strong>{{ $account->amount }}</h5></div>

            <div class="body"><h5><strong>Вид:</strong>
                    @if($account->type === 1)
                        Приход
                    @else
                        Разход
                    @endif
                </h5></div>
            <div class="body"><h5><strong>Публикация: </strong>{{ $account->published_at }}</h5></div>
        </article>

    @endforeach

@stop