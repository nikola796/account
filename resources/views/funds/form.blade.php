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

<!-- Parent Form Input -->
<div class="form-group">
    {!! Form::label('depth', 'Родител:') !!}
    {!! Form::select('depth',array(null => 'Няма') + App\Fund::lists('name', 'id'), null, ['id'=> 'depth','class' => 'form-control']) !!}
</div>

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
