<!-- Name Form Input -->
<div class="form-group">
    {!! Form::label('name', 'Име:') !!}
    {!! Form::text('name', null, ['class' => 'form-control']) !!}
</div>

<!-- Category Form Input -->
<div class="form-group">
    {!! Form::label('parent_id', 'Главна категория:') !!}
    {!! Form::select('parent_id', $categories, null, ['id'=> 'parent_id','class' => 'form-control']) !!}
</div>

<!-- Parent Category Form Input -->
{{--<div class="form-group">--}}
{{--{!! Form::label('grant_parent', 'Родител на Категория:') !!}--}}
{{--{!! Form::select('grant_parent[]', $categories, null, ['id'=> 'grant_parent','class' => 'form-control', 'multiple']) !!}--}}
{{--</div>--}}

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
        //$('#parent_id').select2({
        //    placeholder : 'Изберете родител на категория'
           // tags: true
        //});
        //        $('#grant_parent').select2({
        //            placeholder : 'Изберете родител на категорията',
        //            tags: true
        //        });
    </script>

@endsection