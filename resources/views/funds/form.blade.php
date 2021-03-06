<!-- Name Form Input -->
<div class="form-group">
    {!! Form::label('name', 'Име:') !!}
    {!! Form::text('name', null, ['class' => 'form-control']) !!}
</div>

<!-- Comment Form Input -->
<div class="form-group">
    {!! Form::label('comment', 'Коментар:') !!}
    {!! Form::textarea('comment', null, ['class' => 'form-control']) !!}
</div>

<!-- Category Form Input -->
<div class="form-group">
    {!! Form::label('category_list', 'Категория:') !!}
    {!! Form::select('category_list[]', $categories, null, ['id'=> 'category_list','class' => 'form-control', 'multiple']) !!}
</div>

<!-- Parent Category Form Input -->
{{--<div class="form-group">--}}
    {{--{!! Form::label('grant_parent', 'Родител на Категория:') !!}--}}
    {{--{!! Form::select('grant_parent[]', $categories, null, ['id'=> 'grant_parent','class' => 'form-control', 'multiple']) !!}--}}
{{--</div>--}}

<!-- Amount Form Input -->
<div class="form-group">
    {!! Form::label('amount', 'Сума:') !!}
    {!! Form::input('number','amount', null, ['class' => 'form-control', 'step' => "0.01", 'placeholder' => 0.00]) !!}
</div>

<!-- Published_at Form Input -->
<div class="form-group">
    {!! Form::label('published_at', 'Дата на събитие:') !!}
    {!! Form::input('date', 'published_at', date('Y-m-d'), ['class' => 'form-control']) !!}
</div>

<!-- Type Form Input -->
<div class="form-group">
    {!! Form::label('type', 'Вид:') !!}
    {!! Form::select('type', [1 => 'приход', -1 => 'разход'], null, ['class' => 'form-control']) !!}
</div>

<!-- Add Article Form Input -->
<div class="form-group">
    {!! Form::submit($submitFormText, ['class' => 'btn btn-primary form-control']) !!}
</div>

@section('footer')

    <script>
        $('#category_list').select2({
            placeholder : 'Изберете категория',
            tags: true
        });
//        $('#grant_parent').select2({
//            placeholder : 'Изберете родител на категорията',
//            tags: true
//        });
    </script>

@endsection