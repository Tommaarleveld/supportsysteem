{{-- Use our main layout --}}
@extends('layouts.app')

{{-- Contect section --}}
@section('content')
    <h1 class="mt-5">Tickets</h1>
    @if (count($tickets) > 0)
        @foreach($tickets as $ticket)
            <div class="card">
                <div class="card-body">
                <h5 class="card-title"><a href="/tickets/{{$ticket->id}}">{{$ticket->title}}</a></h5>
                    <small>Aangemaakt op {{$ticket->created_at}}</small>
                </div>
            </div>
        @endforeach
        <div class="mt-2">
        {{$tickets->links()}}
        </div>
    @else
        <p>Er zijn geen tickets beschikbaar op dit moment</p>
    @endif
@endsection