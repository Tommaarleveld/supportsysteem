{{-- Use our main layout --}}
@extends('layouts.app')

{{-- Contect section --}}
@section('content')
    <h1 class=mt-5>{{$ticket->title}}</h1>
    <div>
        {!!$ticket->body!!}
    </div>
    <hr>
    <small>Aangemaakt op {{$ticket->created_at}}</small>
    <div class="mt-2">
        <a href=/tickets class="btn btn-primary">Ga Terug</a>
    </div>
@endsection