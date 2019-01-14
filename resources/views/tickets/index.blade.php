{{-- Use our main layout --}}
@extends('layouts.app')

{{-- Contect section --}}
@section('content')
    <h1 class="mt-5">Tickets</h1>
    @if (count($tickets) > 0)
        @foreach($tickets as $ticket)
            <div class="card">
                <div class="card-body">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-9">
                                <h5 class="card-title"><a href="/tickets/{{$ticket->id}}">{{$ticket->title}}</a></h5>
                            </div>
                            <div class="col-md-3">
                                {{-- {!! Form::open(['action' => ['TicketsController@addUser', $ticket->id], 'method' => 'POST']) !!}
                                {{Form::hidden('ticket_id', $ticket->id)}}
                                {{Form::hidden('_method', 'PUT')}}
                                {{Form::submit('Claim ticket', ['class' => 'btn btn-primary'])}}
                                {!! Form::close() !!} --}}

                                <a class="btn btn-primary float-right" href="/tickets/claimTicket/{{$ticket->id}}">Claim ticket</a>
                            </div>  
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                            <small>Aangemaakt op {{$ticket->created_at}}</small>
                            </div>
                        </div>  
                    </div>
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