{{-- Use our main layout --}}
@extends('layouts.app')

{{-- Contect section --}}
@section('content')
    <h1 class="mt-5">Pas dit ticket aan</h1>

    {{-- Form gemaakt met https://laravelcollective.com/ --}}
    {!! Form::open(['action' => ['TicketsController@update', $ticket->id], 'method' => 'POST']) !!}
        <div class="form-group">
            {{Form::label('title', 'Titel')}}
            {{Form::text('title', $ticket->title, ['class' => 'form-control', 'placeholder' => 'Titel'])}}
        </div>
        <div class="form-group">
            {{Form::label('body', 'Omschrijving')}}
            {{Form::textarea('body', $ticket->body, ['id' => 'article-ckeditor', 'class' => 'form-control', 'placeholder' => 'Omschrijving'])}}
        </div>
        <div class="form-group">
            {{Form::label('level', 'Moeilijkheidsgraad')}}
            {{Form::select('level', ['easy' => 'Makkelijk', 'medium' => 'Gemiddeld', 'hard' => 'Moeilijk', 'expert' => 'Expert'], $ticket->level, ['class' => 'form-control'])}}
        </div>
        {{Form::hidden('_method', 'PUT')}}
        {{Form::submit('Aanpassen', ['class' => 'btn btn-primary'])}}
    {!! Form::close() !!}
@endsection
