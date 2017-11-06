<!-- Body Form Input -->
<div class="form-group">
    {!! Form::label('name', 'Име:') !!}
    {!! Form::text('name', null, ['class' => 'form-control']) !!}
</div>

<!-- Category Form Input -->
<div class="form-group">
    {!! Form::label('group_id', 'Родител:') !!}
    {!! Form::select('group_id', [null => ''] + $groups, null, ['id'=> 'group_id','class' => 'form-control']) !!}
</div>


<!-- Add Article Form Input -->
<div class="form-group">
    {!! Form::submit($submitButtonText, ['class' => 'btn btn-primary form-control']) !!}
</div>

@section('footer')

    <script>
        $('#group_id').select2({
            placeholder : 'Няма родител',
            tags: true

        });
    </script>

@endsection