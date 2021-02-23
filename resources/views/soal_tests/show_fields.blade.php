<!-- Id Field -->
<div class="col-sm-12">
    {!! Form::label('id', 'Id:') !!}
    <p>{{ $soalTest->id }}</p>
</div>

<!-- Soal Field -->
<div class="col-sm-12">
    {!! Form::label('soal', 'Soal:') !!}
    <p>{{ $soalTest->soal }}</p>
</div>

<!-- Pilihan A Field -->
<div class="col-sm-12">
    {!! Form::label('pilihan_a', 'Pilihan A:') !!}
    <p>{{ $soalTest->pilihan_a }}</p>
</div>

<!-- Pilihan B Field -->
<div class="col-sm-12">
    {!! Form::label('pilihan_b', 'Pilihan B:') !!}
    <p>{{ $soalTest->pilihan_b }}</p>
</div>

<!-- Pilihan C Field -->
<div class="col-sm-12">
    {!! Form::label('pilihan_c', 'Pilihan C:') !!}
    <p>{{ $soalTest->pilihan_c }}</p>
</div>

<!-- Pilihan D Field -->
<div class="col-sm-12">
    {!! Form::label('pilihan_d', 'Pilihan D:') !!}
    <p>{{ $soalTest->pilihan_d }}</p>
</div>

<!-- Jawaban Field -->
<div class="col-sm-12">
    {!! Form::label('jawaban', 'Jawaban:') !!}
    <p>{{ $soalTest->jawaban }}</p>
</div>

<!-- Image Field -->
<div class="col-sm-12">
    {!! Form::label('image', 'Image:') !!}
    <p>{{ $soalTest->image }}</p>
</div>

<!-- Created At Field -->
<div class="col-sm-12">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{{ $soalTest->created_at }}</p>
</div>

<!-- Updated At Field -->
<div class="col-sm-12">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p>{{ $soalTest->updated_at }}</p>
</div>

