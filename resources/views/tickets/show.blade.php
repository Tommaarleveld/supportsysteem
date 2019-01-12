{{-- Use our main layout --}}
@extends('layouts.app')

{{-- Contect section --}}
@section('content')
    <h1 class=mt-5>{{$ticket->title}}</h1>
    <div>
        {!!$ticket->body!!}
    </div>
    <hr>
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <small>Aangemaakt op {{$ticket->created_at}}</small>
            </div>
            <div class="col-md-4 offset-md-4 clearfix">
                {!!Form::open(['action' => ['TicketsController@destroy', $ticket->id], 'method' => 'POST', 'class' => 'float-right'])!!}
                    {{Form::hidden('_method', 'DELETE')}}
                    {{Form::submit('Verwijderen', ['class' => 'btn btn-outline-danger'])}}
                {!!Form::close()!!}
                <a href="/tickets/{{$ticket->id}}/edit" class="btn btn-outline-primary float-right mr-1">Edit</a>
            </div>
        </div>
    </div>
    <hr>
    <div class="mt-2">
        <a href=/tickets class="btn btn-primary">Ga Terug</a>
    </div>
@endsection