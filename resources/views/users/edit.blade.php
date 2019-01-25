@extends('layouts.app')

@section('content')

<h1 class="mt-5">Pas uw gegevens aan</h1>

    {{-- Form gemaakt met https://laravelcollective.com/ --}}
    {!! Form::open(['action' => ['UsersController@update', $user->id], 'method' => 'POST']) !!}
        <div class="form-group">
            {{Form::label('name', 'Naam')}}
            {{Form::text('name', $user->name, ['class' => 'form-control', 'value' => Auth::user()->name])}}
        </div>
        <div class="form-group">
            {{Form::label('email', 'Email')}}
            {{Form::email('email', $user->email, ['class' => 'form-control', 'value' => Auth::user()->email])}}
        </div>
        <div class="form-group">
            {{Form::label('password', '(Nieuw) wachtwoord')}}
            {{Form::password('password', ['class' => 'form-control'])}}
        </div>
        <div class="form-group">
            {{Form::label('password_confirmation', 'Vul uw wachtwoord opnieuw in')}}
            {{Form::password('password_confirmation', ['class' => 'form-control'])}}
        </div>
        {{Form::hidden('_method', 'PUT')}}
        {{Form::submit('Aanpassen', ['class' => 'btn btn-primary'])}}
    {!! Form::close() !!}

@endsection