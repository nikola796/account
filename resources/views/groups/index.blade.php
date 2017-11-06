@extends('app')

@section('content')

    <h1>Всички Групи на {{ Auth::user()->name }}</h1>
    <hr>
    @if(isset($accounts))
        @foreach($accounts as $key => $group)

            <div class="row">
                <div class="col-md-10 col-md-offset-1">
                    <div class="panel panel-default">
                        <div class="panel-heading"><a href="{{ url('/groups', $key) }}">{{ mb_strtoupper($key) }}</a></div>

                        <div class="panel-body">
                            @foreach($group as $key => $account)
                                <article>
                                    <h3>
                                        <a href="{{ url('/accounts', $account->id) }}">{{ $account->name }}</a>
                                    </h3>

                                    <div class="body"><h5><strong>Коментар: </strong>{{ $account->comment }}</h5></div>

                                    <div class="body"><h5><strong>Сума: </strong>{{ $account->amount }}</h5></div>

                                    <div class="body"><h5><strong>Публикувана: </strong>{{ $account->published_at }}</h5></div>

                                </article>

                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    @else
        <h3>Не са добавени групи</h3>
    @endif




@stop