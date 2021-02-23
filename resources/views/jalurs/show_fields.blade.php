<!-- Id Field -->
<div class="col-sm-12">
    {!! Form::label('id', 'Id:') !!}
    <p>{{ $jalur->id }}</p>
</div>

<!-- Jalur Field -->
<div class="col-sm-12">
    {!! Form::label('jalur', 'Jalur:') !!}
    <p>{{ $jalur->jalur }}</p>
</div>

<!-- Created At Field -->
<div class="col-sm-12">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{{ $jalur->created_at }}</p>
</div>

<!-- Updated At Field -->
<div class="col-sm-12">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p>{{ $jalur->updated_at }}</p>
</div>

