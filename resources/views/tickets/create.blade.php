{{-- Use our main layout --}}
@extends('layouts.app')

{{-- Contect section --}}
@section('content')
    <h1 class="mt-5">Maak een ticket aan</h1>

    {{-- Form gemaakt met https://laravelcollective.com/ --}}
    {!! Form::open(['action' => 'TicketsController@store', 'method' => 'POST']) !!}
        <div class="form-group">
            {{Form::label('title', 'Titel')}}
            {{Form::text('title', '', ['class' => 'form-control', 'placeholder' => 'Titel'])}}
        </div>
        <div class="form-group">
            {{Form::label('body', 'Omschrijving')}}
            {{Form::textarea('body', '', ['id' => 'article-ckeditor', 'class' => 'form-control', 'placeholder' => 'Omschrijving'])}}
        </div>
        <div class="form-group">
            {{Form::label('level', 'Moeilijkheidsgraad')}}
            {{Form::select('level', ['easy' => 'Makkelijk', 'medium' => 'Gemiddeld', 'hard' => 'Moeilijk', 'expert' => 'Expert'], 'easy', ['class' => 'form-control'])}}
        </div>
        {{Form::submit('Toevoegen', ['class' => 'btn btn-primary'])}}
    {!! Form::close() !!}
@endsection

<script src="/vendor/unisharp/laravel-ckeditor/ckeditor.js"></script>
<script>
    CKEDITOR.replace('article-ckeditor');
</script>